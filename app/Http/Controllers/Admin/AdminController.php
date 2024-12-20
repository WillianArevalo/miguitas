<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{

    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->take(5)->get();
        $customer = Customer::whereBetween("created_at", [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth(),
        ])->orderBy("created_at", "desc")->get();

        $ordersPending = Order::where("status", "pending")->count();
        $ordersCompleted = Order::where("status", "completed")->count();
        $ordersCanceled = Order::where("status", "canceled")->count();

        $users = User::all();
        $usersActives = User::where("status", true)->count();
        $usersInactives = User::where("status", false)->count();

        $sales = Payment::selectRaw("MONTH(created_at) as month, SUM(amount) as total")
            ->groupBy("month")
            ->orderBy("month")
            ->get()
            ->mapWithKeys(function ($sale) {
                return [Carbon::create()->month($sale->month)->translatedFormat("F") => $sale->total];
            });

        $salesTotal = Payment::sum('amount');

        return view('admin.index', compact(
            'orders',
            'customer',
            'ordersPending',
            'ordersCompleted',
            'ordersCanceled',
            'users',
            'usersActives',
            'usersInactives',
            'sales',
            'salesTotal'
        ));
    }

    public function login()
    {
        return view('admin.login');
    }

    public function search(Request $request)
    {

        $search = $request->input('search');

        $pages = [
            ["title" => "Dashboard", "url" => route("admin.index")],
            ["title" => "Pedidos", "url" => route("admin.orders.index")],
            ["title" => "Productos", "url" => route("admin.products.index")],
            ["title" => "Categorías", "url" => route("admin.categories.index")],
            ["title" => "Subcategorías", "url" => route("admin.categories.index")],
            ["title" => "Mensajes", "url" => route("admin.contact-messages.index")],
            ["title" => "Clientes", "url" => route("admin.customers.index")],
            ["title" => "Cupones", "url" => route("admin.sales-strategies.index")],
            ["title" => "Configuración", "url" => route("admin.settings.index")],
            ["title" => "Soporte", "url" => route("admin.support-tickets.index")],
            ["title" => "Métodos de envío", "url" => route("admin.sales-strategies.shipping-methods.index")],
            ["title" => "Métodos de pago", "url" => route("admin.sales-strategies.payment-methods.index")],
            ["title" => "Redes sociales", "url" => route("admin.general-settings.index")],
            ["title" => "Estrategias de venta", "url" => route("admin.sales-strategies.index")],
            ["title" => "Preguntas frecuentes", "url" => route("admin.faq.index")],
            ["title" => "Tickets", "url" => route("admin.support-tickets.index")],
            ["title" => "Ajustes generales", "url" => route("admin.general-settings.index")],
            ["title" => "Políticas", "url" => route("admin.policies.index")],
            ["title" => "Usuarios", "url" => route("admin.users.index")],
            ["title" => "Crear usuario", "url" => route("admin.users.create")],
            ["title" => "Crear cliente", "url" => route("admin.customers.create")],
            ["title" => "Crear producto", "url" => route("admin.products.create")],
            ["title" => "Reseñas", "url" => route("admin.reviews.index")],
        ];

        // Filtrar las páginas que coinciden con el término de búsqueda
        $results = array_filter($pages, function ($page) use ($search) {
            return stripos($page['title'], $search) !== false;
        });

        // Devolver los resultados en formato JSON
        return response()->json([
            "html" => view('layouts.__partials.ajax.admin.search', compact('results'))->render(),
        ]);

        return view('admin.search', compact('search'));
    }
}