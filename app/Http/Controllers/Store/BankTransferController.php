<?php

namespace App\Http\Controllers\Store;

use App\Helpers\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BankTransferRequest;
use App\Models\Order;
use App\Traits\HandlesOrders;
use App\Traits\HandlesPayments;
use Illuminate\Support\Facades\DB;

class BankTransferController extends Controller
{

    use HandlesOrders;
    use HandlesPayments;

    public function store(BankTransferRequest $request)
    {
        $validated = $request->validated();
        $cart = Cart::get();
        try {
            DB::beginTransaction();
            if (!$request->has("order_id")) {
                $order = $this->createOrder("pending", $cart->shipping_cost);
            } else {
                $order = Order::find($request->order_id);
            }

            if ($order) {
                $file = $request->file("file");
                $directory = "bank_transfers/{$order->number_order}";
                $fileName = $file->getClientOriginalName();
                $path = $file->storeAs($directory, $fileName, "public");

                $transfer = $order->bankTransfer()->create([
                    "bank_detail_id" => $validated["bank_detail_id"],
                    "document" => $path,
                    "reference" => $order->number_order,
                    "status" => "pending"
                ]);

                if ($transfer) {
                    $this->createPayment($order, $order->total, $order->number_order, $validated, "pending");
                }

                DB::commit();
                return redirect()->route("account.orders")->with("success", "Transferencia bancaria registrada correctamente");
            } else {
                return redirect()->route("checkout")->with("error", "¡Oops! No se ha encontrado la orden");
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route("checkout")->with("error", "Error al procesar la transacción");
        }
    }
}