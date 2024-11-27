<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Cart as CartHelper;
use App\Models\Address;
use App\Models\Customer;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\ShippingMethod;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function index()
    {
        $cart = CartHelper::get();
        $user = auth()->user();
        //$countries = $this->getAllCountries();
        $shipping_methods = ShippingMethod::where("active", true)->get();
        $payment_methods = PaymentMethod::all();

        if (!$user || !$cart || $cart->items->count() == 0) {
            return redirect()->route("cart")->with("info", "Agrega productos al carrito para continuar con la compra.");
        }

        $customer = $user->customer;
        if ($customer) {
            $address = $customer->address()->where("type", "shipping_address")->first();
        } else {
            $address = null;
        }

        return view("store.checkout.index", [
            "user" => $user,
            "cart" => $cart,
            "customer" => $customer,
            "address" => $address ?? null,
            //"countries" => $countries,
            "payment_methods" => $payment_methods,
            "shipping_methods" => $shipping_methods,
            "cart_totals" => CartHelper::totals()
        ]);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        try {

            $user = auth()->user();
            $user->name = $request->name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->save();

            $customer = $user->customer;
            if ($customer) {
                $customer->phone = $request->phone;
                $customer->save();
            } else {
                $customer = new Customer();
                $customer->user_id = $user->id;
                $customer->save();
            }

            $address = $customer ? $customer->address()->where("type", "shipping_address")->first() : null;

            if (!$address) {
                $address = new Address();
                $address->customer_id = $customer->id;
                $address->type = "shipping_address";
            }

            $address->address_line_1 = $request->address;
            $address->city = $request->city;
            $address->state = $request->state;
            $address->save();
            DB::commit();

            $cart = CartHelper::get();
            $address = $customer ? $customer->address()->where("type", "shipping_address")->first() : null;
            return response()->json([
                "status" => "success",
                "message" => "Datos actualizados correctamente.",
                "html" => view(
                    "layouts.__partials.ajax.store.checkout-confirm",
                    [
                        "user" => $user,
                        "cart" => $cart,
                        "address" => $address ?? null,
                    ]
                )->render()
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                "status" => "error",
                "message" => "Ocurrió un error al actualizar los datos. " . $e->getMessage()
            ], 500);
        }
    }

    public function getAllCountries()
    {
        $reponse = $this->client->request('GET', 'https://restcountries.com/v3.1/all');
        $countries = json_decode($reponse->getBody()->getContents(), true);
        $countryNames = array_map(function ($country) {
            return $country['name']['common'];
        }, $countries);
        $countryArray = array_combine($countryNames, $countryNames);
        ksort($countryArray);
        return $countryArray;
    }


    public function wompi(Request $request)
    {

        dd($request->all());
        $request->validate([
            'IdCuenta' => 'required|string',
            'IdTransaccion' => 'required|string',
            'ResultadoTransaccion' => 'required|string',
            'Monto' => 'required|numeric',
            'Cliente.Nombre' => 'required|string',
            'Cliente.EMail' => 'required|email',
            'number_order' => 'required|string',
        ]);

        DB::beginTransaction();
        try {

            $order = Order::where("number_order", $request->number_order)->first();

            if (!$order) {
                return response()->json([
                    "status" => "error",
                    "message" => "Orden no encontrada."
                ], 404);
            }

            if ($request->ResultadoTransaccion == "ExitosaAprobada") {
                $order->status = "pending";
                $order->payment_status = "paid";
                $order->save();
            }

            DB::commit();

            return redirect()->route("orders.index")->with("success", "Orden procesada correctamente.");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route("orders.index")->with("error", "Ocurrió un error al procesar el pago. " . $e->getMessage());
        }
    }
}
