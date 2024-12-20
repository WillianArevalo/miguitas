<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Cart as CartHelper;
use App\Models\Address;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Rate;
use App\Models\ShippingMethod;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use App\Utils\WompiService;

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
        $shipping_methods = ShippingMethod::where("active", true)->get();
        $payment_methods = PaymentMethod::where("active", true)->get();

        if (!$user || !$cart || $cart->items->count() == 0) {
            return redirect()->route("cart")->with("info", "Agrega productos al carrito para continuar con la compra.");
        }

        $data = resource_path("data/elsalvador.json");
        $data = json_decode(file_get_contents($data), true);
        $departamentos = array_reduce($data, function ($carry, $item) {
            $carry[$item["departamento"]] = $item["departamento"];
            return $carry;
        }, []);

        $customer = $user->customer;
        if ($customer) {
            $address = $customer->address()->where("type", "shipping_address")->first();
            $existingRate = Rate::where("department", $address->department)
                ->where("municipality", $address->municipality)
                ->where("district", $address->district)
                ->first();
            $this->calculateCostShipping($address);
        } else {
            $address = null;
        }

        return view("store.checkout.index", [
            "user" => $user,
            "cart" => $cart,
            "customer" => $customer,
            "address" => $address ?? null,
            "payment_methods" => $payment_methods,
            "shipping_methods" => $shipping_methods,
            "cart_totals" => CartHelper::totals(),
            "departamentos" => $departamentos,
            "existingRate" => $existingRate ?? null
        ]);
    }

    public function calculateCostShipping($address)
    {
        $cost = null;
        $cart = CartHelper::get();
        if ($address != null) {
            $department = $address->department;
            $municipality = $address->municipality;
            $district = $address->district;
            $rate = Rate::where("department", $department)
                ->where("municipality", $municipality)
                ->where("district", $district)
                ->first();

            if ($rate) {
                $cost = $rate->cost;
            }
        }
        $cart->shipping_cost = $cost;
        $cart->save();
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
                $customer->phone = $request->phone;
                $customer->save();
            }

            $address = $customer ? $customer->address()->where("type", "shipping_address")->first() : null;

            if (!$address) {
                $address = new Address();
                $address->customer_id = $customer->id;
                $address->type = "shipping_address";
            }

            $address->address_line_1 = $request->address;
            $address->department = $request->department;
            $address->municipality = $request->municipality;
            $address->district = $request->district;
            $address->save();

            DB::commit();
            $cart = CartHelper::get();
            $address = $customer ? $customer->address()->where("type", "shipping_address")->first() : null;

            $rate = Rate::where("department", $address->department)
                ->where("municipality", $address->municipality)
                ->where("district", $address->district)
                ->first();

            return response()->json([
                "status" => "success",
                "message" => "Datos actualizados correctamente.",
                "html" => view(
                    "layouts.__partials.ajax.store.checkout-confirm",
                    [
                        "user" => $user,
                        "cart" => $cart,
                        "address" => $address ?? null,
                        "rate" => $rate,
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
        $path = resource_path('data/countries.json');
        $countries = json_decode(file_get_contents($path), true);
        return $countries;
    }


    public function get_wompi_link(Request $request)
    {
        $request->validate([
            "number_order" => "required|string",
        ]);

        $order = Order::where("number_order", $request->number_order)->first();

        if (!$order) {
            return response()->json([
                "status" => "error",
                "message" => "Orden no encontrada."
            ], 404);
        }

        $wompi = new WompiService();
        $link = $wompi->get_link("Pago de orden", $order->number_order, $order->total);
        if (!$link) {
            return response()->json([
                "status" => "error",
                "message" => "No se pudo obtener el enlace de pago."
            ], 500);
        }
        return response()->json([
            "status" => "success",
            "link" => $link
        ], 200);
    }


    public function wompi(Request $request)
    {
        $request->validate([
            'IdCuenta' => 'required|string',
            'IdTransaccion' => 'required|string',
            'ResultadoTransaccion' => 'required|string',
            'Monto' => 'required|numeric',
            'Cliente.Nombre' => 'required|string',
            'Cliente.EMail' => 'required|email',
            "EnlacePago.IdentificadorEnlaceComercio" => 'required|string',
        ]);

        $number_order = $request->input('EnlacePago.IdentificadorEnlaceComercio');

        DB::beginTransaction();
        try {

            $order = Order::where("number_order", $number_order)->first();

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

                $payment = new Payment();
                $payment->user_id = $order->user_id;
                $payment->order_id = $order->id;
                $payment->payment_method_id = $order->payment_method_id ?? null;
                $payment->amount = $request->input('Monto');
                $payment->status = "approved";
                $payment->transaction_id = $request->input('IdTransaccion');
                $payment->reference_number = $request->input('EnlacePago.IdentificadorEnlaceComercio');
                $payment->paid_at = $request->input('FechaTransaccion');
                $payment->data = $request->all();
                $payment->save();
            }

            DB::commit();

            return response()->json([
                "status" => "success",
                "message" => "Orden actualizada correctamente."
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                "status" => "error",
                "message" => $e->getMessage()
            ], 500);
        }
    }
}
