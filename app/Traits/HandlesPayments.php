<?php
// app/Traits/HandlesOrders.php

namespace App\Traits;

use App\Helpers\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\DB;

trait HandlesPayments
{
    public function createPayment($order, $amount, $transacctionId, $data, $status = "approved")
    {
        try {
            DB::beginTransaction();
            $payment = new Payment();
            $payment->user_id = auth()->id();
            $payment->order_id = $order->id;
            $payment->payment_method_id = $order->payment_method_id;
            $payment->amount = $amount;
            $payment->status = $status;
            $payment->transaction_id = $transacctionId;
            $payment->reference_number = $order->number_order;
            $payment->paid_at = now();
            $payment->data = $data;
            $payment->save();
            DB::commit();
            return $payment;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception("Error al procesar el pago. " . $e->getMessage());
        }
    }
}