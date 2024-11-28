<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\Cart;
use App\Http\Requests\InfoOrderRequest;
use App\Mail\OrderEmail;
use App\Models\Address;
use App\Models\Customer;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\ShippingMethod;
use App\Models\User;
use App\Utils\Addresses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{

    public function showOrdersStore()
    {
        return view("orders.index");
    }

    public function index()
    {
        $orders = Order::with("customer", "currency", "shipping_method", "payment_method")->get();
        return view("admin.orders.index", compact("orders"));
    }

    public function show(string $id)
    {
        $order = Order::with("items.product", "customer", "address", "currency", "shipping_method", "payment_method")->find($id);
        return view("admin.orders.show", compact("order"));
    }

    public function edit(string $id)
    {
        $order = Order::with("items.product", "customer", "address", "currency", "shipping_method", "payment_method")->find($id);
        $customers = Customer::with("user")->get();
        $paymentMethods = PaymentMethod::all();
        $shippingMethods = ShippingMethod::all();
        $addresses = Addresses::getAddresses();
        return view("admin.orders.edit", compact(
            "order",
            "customers",
            "paymentMethods",
            "shippingMethods",
            "addresses"
        ));
    }

    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $order = Order::find($id);
            if ($order) {
                $order->delete();
                DB::commit();
                return redirect()->route("admin.orders.index")->with("success", "Orden eliminada correctamente");
            }
            throw new \Exception("Orden no encontrada");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with("error", "Error al eliminar la orden: " . $e->getMessage());
        }
    }

    public function changeStatus(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $order = Order::find($id);
            if ($order) {
                $dateNow = date("Y-m-d H:i:s");
                switch ($request->status) {
                    case "pending":
                        $order->update([
                            "cancelled_at" => null,
                            "completed_at" => null,
                            "shipped_at" => null,
                            "delivered_at" => null
                        ]);
                        break;
                    case "completed":
                        $order->update(["completed_at" => $dateNow, "cancelled_at" => null]);
                        break;
                    case "sent":
                        $order->update(["shipped_at" => $dateNow, "cancelled_at" => null]);
                        break;
                    case "canceled":
                        $order->update(["cancelled_at" => $dateNow, "completed_at" => null]);
                        break;
                    default:
                        throw new \Exception("Estado de la orden no válido");
                }

                //Send email to customer
                $customer = $order->customer;
                $email = $customer->user->email;
                $order->update(["status" => $request->status]);
                DB::commit();

                Mail::to($email)->send(new OrderEmail(
                    $order->number_order,
                    $this->mapStatus($request->status),
                    $customer->user->name,
                    $email
                ));

                return redirect()->route("admin.orders.index")->with("success", "Estado de la orden actualizado correctamente");
            }
            throw new \Exception("Orden no encontrada");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with("error", "Error al actualizar el estado de la orden: " . $e->getMessage());
        }
    }


    public function mapStatus($status)
    {
        return match ($status) {
            'pending' => 'pendiente',
            'canceled' => 'cancelado',
            'completed' => 'completado',
            'sent' => 'enviado',
            'returned' => 'devolviendo',
            default => 'desconocido',
        };
    }

    public function changePaymentStatus(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $order = Order::find($id);
            if ($order) {
                $order->update(["payment_status" => $request->status]);
                DB::commit();
                return redirect()->route("admin.orders.index")->with("success", "Estado de pago de la orden actualizado correctamente");
            }
            throw new \Exception("Orden no encontrada");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with("error", "Error al actualizar el estado de pago de la orden: " . $e->getMessage());
        }
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            "shipped_at" => "nullable|date",
            "completed_at" => "nullable|date",
            "cancelled_at" => "nullable|date",
            "admin_notes" => "nullable|string|max:255",
            "estimated_delivery" => "nullable|string",
        ]);

        DB::beginTransaction();
        try {
            $order = Order::find($id);
            $order->update($request->all());
            DB::commit();
            return redirect()->route("admin.orders.index")->with("success", "Orden actualizada correctamente");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with("error", "Error al actualizar la orden: " . $e->getMessage());
        }
    }
}