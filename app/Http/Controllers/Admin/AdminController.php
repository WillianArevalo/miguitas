<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;

class AdminController extends Controller
{

    public function index()
    {
        $orders = Order::all();
        return view('admin.index', compact('orders'));
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