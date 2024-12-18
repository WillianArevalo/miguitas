<?php

namespace App\Http\Controllers\Store;

use App\Helpers\Cart;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Traits\HandlesOrders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class PaymentController extends Controller
{
    use HandlesOrders;

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
        if (!$paymentMethod) {
            return redirect()->route('cart')->with('info', 'Método de pago no encontrado.');
        }

        $cart->payment_method_id = $paymentMethod->id;
        $cart->save();

        return view("store.account.payments.create", [
            'cart' => $cart,
            'stripeKey' => $stripeKey,
            "cart_totals" => Cart::totals(),
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
                    $payment = new Payment();
                    $payment->user_id = auth()->id();
                    $payment->order_id = $order->id;
                    $payment->payment_method_id = $cart->payment_method_id;
                    $payment->amount = $amount / 100;
                    $payment->status = "approved";
                    $payment->transaction_id = $paymentIntent->id;
                    $payment->reference_number = $order->number_order;
                    $payment->paid_at = now();
                    $payment->data = $paymentIntent->toArray();
                    $payment->save();
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
