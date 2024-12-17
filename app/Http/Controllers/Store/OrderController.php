<?php

namespace App\Http\Controllers\Store;

use App\Helpers\Cart;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Traits\HandlesOrders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    use HandlesOrders;

    public function index()
    {
        if (auth()->user()->customer && auth()->user()->customer->orders) {
            $orders = auth()->user()->customer->orders;

            $orders = $orders->filter(function ($order) {
                return $order->status === "pending" || $order->status === "completed" || $order->status === "sent";
            });
        } else {
            $orders = collect([]);
        }

        return view("store.orders.index", compact("orders"));
    }

    public function cancelReturn()
    {
        if (auth()->user()->customer && auth()->user()->customer->orders) {
            $orders = auth()->user()->customer->orders;
            $orders = $orders->filter(function ($order) {
                return $order->status === "canceled" || $order->status === "returned";
            });
        } else {
            $orders = collect([]);
        }
        return view("store.orders.cancel-return", compact("orders"));
    }

    public function store()
    {
        try {
            $this->createOrder();
            return redirect()->route("store")->with("success", "Orden creada correctamente");
        } catch (\Exception $e) {
            return back()->with("error", "Error al crear la orden: " . $e->getMessage());
        }
    }

    public function show(string $numberOrder)
    {
        $order = Order::with(
            "items.product",
            "customer",
            "address",
            "currency",
            "shipping_method",
            "payment_method",
            "payments"
        )->where("number_order", $numberOrder)->firstOrFail();

        $payment_methods = PaymentMethod::where("active", true)->get();
        $shippingAdress = $order->address
            && $order->address->type === "shipping_address"
            ? $order->address->address_line_1
            : null;

        return view("store.orders.show", compact("order", "shippingAdress", "payment_methods"));
    }

    public function cancel(string $id)
    {
        DB::beginTransaction();
        try {
            $order = Order::findOrFail($id);
            $order->update([
                "status" => "canceled",
                "cancelled_at" => now(),
                "reason_canceled" => request("reason_canceled")
            ]);
            DB::commit();
            return back()->with("success", "Pedido cancelado correctamente");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with("error", "Error al cancelar la orden: " . $e->getMessage());
        }
    }

    public function addComment(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $order = Order::findOrFail($id);
            $order->update([
                "customer_notes" => $request->customer_notes,
            ]);
            DB::commit();
            return back()->with("success", "Comentario agregado correctamente");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with("error", "Error al agregar el comentario: " . $e->getMessage());
        }
    }

    public function removeComment(string $id)
    {
        DB::beginTransaction();
        try {
            $order = Order::findOrFail($id);
            $order->update([
                "customer_notes" => null,
            ]);
            DB::commit();
            return back()->with("success", "Comentario eliminado correctamente");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with("error", "Error al eliminar el comentario: " . $e->getMessage());
        }
    }

    public function generateNumberOrder()
    {
        return "ORD" . date("Ymd") . rand(1000, 9999);
    }

    public function generateTrackingNumber()
    {
        return "TRK" . date("Ymd") . rand(1000, 9999);
    }

    public function search(Request $request)
    {
        $query = Order::query()->where("user_id", auth()->id());
        $search = $request->input("search-order");
        $status = $request->input("order");

        if ($search) {
            $query->where("number_order", "like", "%$search%")
                ->orWhere("tracking_number", "like", "%$search%")
                ->orWhere("status", "like", "%$search%");
        }

        if ($status) {
            if ($status === "mas_reciente") {
                $query->orderBy("created_at", "desc");
            }

            if ($status === "mas_antiguo") {
                $query->orderBy("created_at", "asc");
            }

            if ($status === "ultimo_mes") {
                $query->where("created_at", ">=", now()->subMonth());
            }

            if ($status === "ultimo_año") {
                $query->where("created_at", ">=", now()->subYear());
            }
        }

        $orders = $query->get();

        if ($request->ajax()) {
            return response()->json([
                "html" => view("layouts.__partials.ajax.store.row-order", compact("orders"))->render(),
                "html_mobile" => view("layouts.__partials.ajax.store.row-order-mobile", compact("orders"))->render(),
            ], 200);
        }
    }
}