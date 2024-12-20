<?php

namespace App\Http\Controllers\Store;

use App\Helpers\Cart;
use App\Http\Controllers\Controller;
use App\Models\BankDetail;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Traits\HandlesOrders;
use App\Traits\HandlesPayments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class PaymentController extends Controller
{
    use HandlesOrders;
    use HandlesPayments;

    public  function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    public function showPaymentForm(Request $request)
    {
        $cart = Cart::get();
        $stripeKey = config('services.stripe.key');

        $id = $request->input("id");
        $paymentMethod = PaymentMethod::find($id);
        $banks = BankDetail::first();
        if (!$paymentMethod) {
            return redirect()->route('cart')->with('info', 'Método de pago no encontrado.');
        }

        $cart->payment_method_id = $paymentMethod->id;
        $cart->save();

        return view("store.account.payments.create", [
            'cart' => $cart,
            'stripeKey' => $stripeKey,
            'paymentMethod' => $paymentMethod,
            "cart_totals" => Cart::totals(),
            "bank" => $banks
        ]);
    }

    public function index()
    {
        $payments = Payment::byUser(auth()->user())->get();
        return view("store.account.payments.index", compact("payments"));
    }

    public function createPaymentIntent(Request $request)
    {
        try {
            $amount = intval(Cart::totalWithShippingMethod() * 100);
            $cart = Cart::get();

            if ($amount < 50) {
                return response()->json(['error' => 'El monto mínimo permitido es 0.50 USD. Monto actual:' . Cart::total()], 400);
            }

            $paymentIntent = PaymentIntent::create([
                'amount' => $amount,
                'currency' => 'usd',
                'description' => 'Compra en ' . config('app.name'),
                'payment_method' => $request->payment_method,
                'confirm' => true,
                'return_url' => route('home'), // URL para redirección
            ]);

            if ($paymentIntent->status === 'succeeded') {
                try {
                    DB::beginTransaction();
                    $order = $this->createOrder("paid", $cart->shipping_cost);
                    $this->createPayment($order, $amount, $paymentIntent->id, $paymentIntent->toArray());
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                    return response()->json(['error' => $e->getMessage()]);
                }
            } else {
                $this->createOrder("failed", $cart->shipping_cost);
            }

            return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
            ]);
        } catch (ApiErrorException $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}