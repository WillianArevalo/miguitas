<?php
// app/Traits/HandlesOrders.php

namespace App\Traits;

use App\Helpers\Cart;
use App\Models\Order;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\DB;

trait HandlesOrders
{
    public function createOrder($statusPayment = "pending", $shippingCost = null)
    {
        DB::beginTransaction();
        $cart = Cart::get();
        $currency = session()->get("currency");
        try {
            $data = [
                "number_order" => $this->generateNumberOrder(),
                "status" => "pending",
                "subtotal" => Cart::total(),
                "total" => Cart::totalWithShippingMethod(),
                "tax" => Cart::totalTaxes(),
                "discount" => Cart::totalDiscount(),
                "customer_id" => auth()->user()->customer->id,
                "currency_id" => $currency->id,
                "user_id" => auth()->id(),
                "shipping_method_id" => $cart->shipping_method_id,
                "payment_method_id" =>  $cart->payment_method_id,
                "address_id" => auth()->user()->customer->address->id,
                "payment_status" => $statusPayment,
                "shipping_cost" => $shippingCost,
            ];

            $order = Order::create($data);

            foreach ($cart->items as $item) {
                $order->items()->create([
                    "product_id" => $item->product->id,
                    "quantity" => $item->quantity,
                    "price" => $item->price,
                    "total" => $item->price * $item->quantity
                ]);
            }

            $admins = User::where("role", "admin")->get();

            foreach ($admins as $admin) {
                Notification::create([
                    "user_id" => $admin->id,
                    "reference_id" => $order->id,
                    "type" => "App\Models\Order",
                    "message" => "Se ha creado una nueva orden de compra: " . $order->number_order,
                ]);
            }

            Cart::clear();
            DB::commit();
            return $order;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception("Error al crear la orden: " . $e->getMessage());
        }
    }

    private function generateNumberOrder()
    {
        return now()->timestamp . rand(100, 999);
    }
}