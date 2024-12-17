<?php

namespace App\Http\Controllers\Store;

use App\Helpers\Cart;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Traits\HandlesOrders;
use Illuminate\Http\Request;
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

    public function showPaymentForm()
    {
        $cart = Cart::get();
        $stripeKey = config('services.stripe.key');
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
                $this->createOrder("paid");
            } else {
                $this->createOrder("failed");
            }

            return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
            ]);
        } catch (ApiErrorException $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}