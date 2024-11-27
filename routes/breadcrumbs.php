<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.

use App\Models\Policy;
use App\Models\Product;
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Illuminate\Support\Facades\Blade;

// Admin
Breadcrumbs::for('admin.index', function (BreadcrumbTrail $trail) {
    $icon = Blade::render("<x-icon icon='dashboard-square' class='w-4 h-4' />");
    $trail->push('Administrador', route('admin.index'));
    $trail->push($icon . 'Dashboard', route('admin.index'));
});

// Admin => Categories
Breadcrumbs::for('admin.categories.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $icon = Blade::render("<x-icon icon='bookmark' class='w-4 h-4' />");
    $trail->push($icon . 'Categorías', route('admin.categories.index'));
});

// Admin > Brands
Breadcrumbs::for('admin.brands.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $icon = Blade::render("<x-icon icon='brand-medium' class='w-4 h-4' />");
    $trail->push($icon . 'Marcas', route('admin.brands.index'));
});

// Admin > Products
Breadcrumbs::for('admin.products.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $icon = Blade::render("<x-icon icon='cube' class='w-4 h-4' />");
    $trail->push($icon . 'Productos', route('admin.products.index'));
});

// Admin > Products > Create
Breadcrumbs::for('admin.products.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.products.index');
    $icon = Blade::render("<x-icon icon='cube-plus' class='w-4 h-4' />");
    $trail->push($icon . 'Nuevo producto', route('admin.products.create'));
});

//Admin > Products > Detalles > {product}
Breadcrumbs::for('admin.products.show', function (BreadcrumbTrail $trail, $product) {
    $trail->parent('admin.products.index');
    $icon = Blade::render("<x-icon icon='list-details' class='w-4 h-4' />");
    $trail->push($icon . 'Detalles del producto', route('admin.products.show', $product));
});

// Admin > Products > Edit > {product}
Breadcrumbs::for('admin.products.edit', function (BreadcrumbTrail $trail, $product) {
    $trail->parent('admin.products.index');
    $icon = Blade::render("<x-icon icon='edit' class='w-4 h-4' />");
    $trail->push($icon . 'Editar producto', route('admin.products.edit', $product));
});

//Admin > Flash Offers
Breadcrumbs::for('admin.flash-offers.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Ofertas Flash', route('admin.flash-offers.index'));
});

//Admin > Flash Offers > Create
Breadcrumbs::for('admin.flash-offers.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.flash-offers.index');
    $trail->push('Crear nueva', route('admin.flash-offers.create'));
});

//Admin > Flash Offers > Edit > {flashOffer}
Breadcrumbs::for('admin.flash-offers.edit', function (BreadcrumbTrail $trail, $flashOffer) {
    $trail->parent('admin.flash-offers.index');
    $trail->push('Editar', route('admin.flash-offers.edit', $flashOffer));
});

//Admin > Popups
Breadcrumbs::for('admin.popups.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Popups', route('admin.popups.index'));
});

//Admin > Popups > Create
Breadcrumbs::for('admin.popups.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.popups.index');
    $trail->push('Crear nuevo', route('admin.popups.create'));
});

//Admin > Users
Breadcrumbs::for('admin.users.index', function (BreadcrumbTrail $trail) {
    $icon = Blade::render("<x-icon icon='user' class='w-4 h-4' />");
    $trail->parent('admin.index');
    $trail->push($icon . 'Usuarios', route('admin.users.index'));
});

//Admin > Users > Create
Breadcrumbs::for('admin.users.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.users.index');
    $icon = Blade::render("<x-icon icon='user-plus' class='w-4 h-4' />");
    $trail->push($icon . 'Nuevo usuario', route('admin.users.create'));
});

//Admin > Users > Edit > {user}
Breadcrumbs::for('admin.users.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('admin.users.index');
    $icon = Blade::render("<x-icon icon='user-edit' class='w-4 h-4' />");
    $trail->push($icon . 'Editar usuario', route('admin.users.edit', $user));
});

//Admin > Users > Show > {user}
Breadcrumbs::for('admin.users.show', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('admin.users.index');
    $icon = Blade::render("<x-icon icon='user-search' class='w-4 h-4' />");
    $trail->push($icon . 'Detalles del usuario', route('admin.users.show', $user));
});

//Admin > Customers
Breadcrumbs::for('admin.customers.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $icon = Blade::render("<x-icon icon='user-group' class='w-4 h-4' />");
    $trail->push($icon . 'Clientes', route('admin.customers.index'));
});

//Admin > Customers > Create
Breadcrumbs::for('admin.customers.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.customers.index');
    $icon = Blade::render("<x-icon icon='user-plus' class='w-4 h-4' />");
    $trail->push($icon . 'Nuevo cliente', route('admin.customers.create'));
});

//Admin > Customers > Edit > {customer}
Breadcrumbs::for('admin.customers.edit', function (BreadcrumbTrail $trail, $customer) {
    $trail->parent('admin.customers.index');
    $trail->push('Editar', route('admin.customers.edit', $customer));
});

//Admin > General Settings
Breadcrumbs::for('admin.general-settings.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Ajustes generales', route('admin.general-settings.index'));
});


//Admin > Settings
Breadcrumbs::for('admin.settings.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $icon = Blade::render("<x-icon icon='settings' class='w-4 h-4' />");
    $trail->push($icon . 'Configuración', route('admin.settings.index'));
});

//Admin > Policies
Breadcrumbs::for('admin.policies.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Políticas', route('admin.policies.index'));
});

//Admin > FAQ 
Breadcrumbs::for('admin.faq.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Preguntas frecuentes', route('admin.faq.index'));
});

//Admin > Support Tickets
Breadcrumbs::for('admin.support-tickets.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Tickets de soporte', route('admin.support-tickets.index'));
});

//Admin > Support Tickets > Show
Breadcrumbs::for('admin.support-tickets.show', function (BreadcrumbTrail $trail, $supportTicket) {
    $trail->parent('admin.support-tickets.index');
    $trail->push('Detalles', route('admin.support-tickets.show', $supportTicket));
});

//Admin > Orders
Breadcrumbs::for('admin.orders.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $icon = Blade::render("<x-icon icon='orders' class='w-4 h-4' />");
    $trail->push($icon . 'Pedidos', route('admin.orders.index'));
});

//Admin > Orders > Show
Breadcrumbs::for('admin.orders.show', function (BreadcrumbTrail $trail, $order) {
    $trail->parent('admin.orders.index');
    $icon = Blade::render("<x-icon icon='shopping-bag-search' class='w-4 h-4' />");
    $trail->push($icon . 'Detalles del pedido', route('admin.orders.show', $order));
});

//Admin > Orders > Edit
Breadcrumbs::for('admin.orders.edit', function (BreadcrumbTrail $trail, $order) {
    $trail->parent('admin.orders.index');
    $icon = Blade::render("<x-icon icon='shopping-bag-edit' class='w-4 h-4' />");
    $trail->push($icon . 'Editar pedido', route('admin.orders.edit', $order));
});


//Admin > Sales Strategies
Breadcrumbs::for('admin.sales-strategies.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Estrategias de venta', route('admin.sales-strategies.index'));
});

//Admin > Sales Strategies > New Coupon
Breadcrumbs::for('admin.sales-strategies.coupon.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.sales-strategies.index');
    $trail->push("Cupón", route('admin.sales-strategies.index'));
    $trail->push('Nuevo', route('admin.sales-strategies.coupon.create'));
});

//Admin > Sales Strategies > Show Coupon > {coupon}
Breadcrumbs::for('admin.sales-strategies.coupon.show', function (BreadcrumbTrail $trail, $coupon) {
    $trail->parent('admin.sales-strategies.index');
    $trail->push("Cupón", route('admin.sales-strategies.index'));
    $trail->push('Detalles', route('admin.sales-strategies.coupon.show', $coupon));
});

//Admin > Sales Strategies > Edit Coupon > {coupon}
Breadcrumbs::for('admin.sales-strategies.coupon.edit', function (BreadcrumbTrail $trail, $coupon) {
    $trail->parent('admin.sales-strategies.index');
    $trail->push("Cupón", route('admin.sales-strategies.index'));
    $trail->push('Editar', route('admin.sales-strategies.coupon.edit', $coupon));
});

//Admin > Sales Strategies > Shipping Methods
Breadcrumbs::for('admin.sales-strategies.shipping-methods.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.sales-strategies.index');
    $trail->push('Métodos de envío', route('admin.sales-strategies.shipping-methods.index'));
});

//Admin > Sales Strategies > Payment Methods
Breadcrumbs::for("admin.sales-strategies.payment-methods.index", function (BreadcrumbTrail $trail) {
    $trail->parent("admin.sales-strategies.index");
    $trail->push("Métodos de pago", route("admin.sales-strategies.payment-methods.index"));
});

//Admin > Sales Strategies > Currencies
Breadcrumbs::for("admin.sales-strategies.currencies.index", function (BreadcrumbTrail $trail) {
    $trail->parent("admin.sales-strategies.index");
    $trail->push("Monedas", route("admin.sales-strategies.currencies.index"));
});

//Admin > Reviews
Breadcrumbs::for("admin.reviews.index", function (BreadcrumbTrail $trail) {
    $trail->parent("admin.index");
    $icon = Blade::render("<x-icon icon='message' class='w-4 h-4' />");
    $trail->push($icon . "Reseñas", route("admin.reviews.index"));
});



/* BREADCRUMBS STORE */

//Home
Breadcrumbs::for("home", function (BreadcrumbTrail $trail) {
    $trail->push("Inicio", route("home"));
});

//Tienda
Breadcrumbs::for("store", function (BreadcrumbTrail $trail) {
    $trail->parent("home");
    $icon = Blade::render("<x-icon-store icon='shop' class='w-4 h-4' />");
    $trail->push($icon . "Tienda", route("store"));
});


//Products 
Breadcrumbs::for("store.products", function (BreadcrumbTrail $trail) {
    $trail->parent("store");
    $trail->push("PAWstry eShop", route("store.products"));
});

//Products > {product}
Breadcrumbs::for("products.details", function (BreadcrumbTrail $trail, $product) {
    $trail->parent("store.products");
    $product = Product::where('slug', $product)->first()->name;
    $trail->push($product, route("products.details", $product));
});


//Cart 
Breadcrumbs::for("cart", function (BreadcrumbTrail $trail) {
    $trail->parent("store");
    $icon = Blade::render("<x-icon-store icon='cart' class='w-4 h-4' />");
    $trail->push($icon . "Carrito de compras", route("cart"));
});

//Checkout
Breadcrumbs::for("checkout", function (BreadcrumbTrail $trail) {
    $trail->parent("cart");
    $icon = Blade::render("<x-icon-store icon='bag' class='w-4 h-4' />");
    $trail->push($icon . "Checkout", route("checkout"));
});

//FAQ
Breadcrumbs::for("faq", function (BreadcrumbTrail $trail) {
    $trail->parent("store");
    $icon = Blade::render("<x-icon-store icon='question' class='w-4 h-4' />");
    $trail->push($icon . "Preguntas frecuentes", route("faq"));
});

//About
Breadcrumbs::for("about", function (BreadcrumbTrail $trail) {
    $trail->parent("store");
    $icon = Blade::render("<img src='" . asset('img/logo.png') . "' alt='Conócenos' class='w-4 h-4' />");
    $trail->push($icon . "Conócenos", route("about"));
});

//Contact
Breadcrumbs::for("contact", function (BreadcrumbTrail $trail) {
    $trail->parent("store");
    $icon = Blade::render("<x-icon-store icon='message' class='w-4 h-4' />");
    $trail->push($icon . "Contactanos", route("contact"));
});

//Favorites
Breadcrumbs::for("favorites", function (BreadcrumbTrail $trail) {
    $trail->parent("store");
    $icon = Blade::render("<x-icon-store icon='heart' class='w-4 h-4' />");
    $trail->push($icon . "Favoritos", route("favorites"));
});

//Account 
Breadcrumbs::for("account.index", function (BreadcrumbTrail $trail) {
    $trail->parent("store");
    $icon = Blade::render("<x-icon-store icon='user' class='w-4 h-4' />");
    $trail->push($icon . "Mi cuenta", route("account.index"));
});

//Order show
Breadcrumbs::for("orders.show", function (BreadcrumbTrail $trail, $order) {
    $trail->parent("account.index");
    $trail->push("Pedidos", route("account.index"));
    $trail->push($order, route("orders.show", $order));
});

//Edit address
Breadcrumbs::for("account.addresses.edit", function (BreadcrumbTrail $trail, $address) {
    $trail->parent("account.index");
    $trail->push("Direcciones", route("account.index"));
    $icon = Blade::render("<x-icon-store icon='map-point' class='w-4 h-4' />");
    $trail->push($icon . "Editar dirección", route("account.addresses.edit", $address));
});

//Blog
Breadcrumbs::for("blog", function (BreadcrumbTrail $trail) {
    $trail->parent("store");
    $trail->push("Blog", route("blog"));
});

//Galery
Breadcrumbs::for("galery", function (BreadcrumbTrail $trail) {
    $trail->parent("store");
    $trail->push("Galería", route("galery"));
});

//Terms of use
Breadcrumbs::for("terms-and-conditions", function (BreadcrumbTrail $trail, $slug) {
    $trail->parent("store");
    $policy = Policy::where('slug', $slug)->first();
    $trail->push("Términos y condiciones", route("store"));
    $trail->push($policy->name, route("terms-and-conditions", $slug));
});

//Orders
Breadcrumbs::for("orders.index", function (BreadcrumbTrail $trail) {
    $trail->parent("account.index");
    $trail->push("Pedidos", route("orders.index"));
});


//Adress 
Breadcrumbs::for("account.addresses.index", function (BreadcrumbTrail $trail) {
    $trail->parent("account.index");
    $trail->push("Direcciones", route("account.addresses.index"));
});

//Address create
Breadcrumbs::for("account.addresses.create", function (BreadcrumbTrail $trail) {
    $trail->parent("account.addresses.index");
    $trail->push("Nueva dirección", route("account.addresses.create"));
});

//Settings
Breadcrumbs::for("account.settings", function (BreadcrumbTrail $trail) {
    $trail->parent("account.index");
    $trail->push("Datos personales", route("account.settings"));
});

//Settings edit
Breadcrumbs::for("account.settings-edit", function (BreadcrumbTrail $trail) {
    $trail->parent("account.index");
    $trail->push("Editar datos personales", route("account.settings-edit"));
});

//Support tickets
Breadcrumbs::for("account.tickets.index", function (BreadcrumbTrail $trail) {
    $trail->parent("account.index");
    $trail->push("Soporte técnico", route("account.tickets.index"));
});

//Support tickets create
Breadcrumbs::for("account.tickets.create", function (BreadcrumbTrail $trail) {
    $trail->parent("account.tickets.index");
    $trail->push("Nuevo ticket", route("account.tickets.create"));
});

//Support tickets show
Breadcrumbs::for("account.tickets.show", function (BreadcrumbTrail $trail, $supportTicket) {
    $trail->parent("account.tickets.index");
    $trail->push("Detalles", route("account.tickets.show", $supportTicket));
});

//Support tickets close
Breadcrumbs::for("account.tickets.close", function (BreadcrumbTrail $trail, $supportTicket) {
    $trail->parent("account.tickets.index");
    $trail->push("Cerrar", route("account.tickets.close", $supportTicket));
});

//Cancel return
Breadcrumbs::for("cancel-return", function (BreadcrumbTrail $trail) {
    $trail->parent("account.index");
    $trail->push("Cancelaciones y devoluciones", route("cancel-return"));
});

//Login
Breadcrumbs::for("login", function (BreadcrumbTrail $trail) {
    $trail->parent("store");
    $trail->push("Iniciar sesión", route("login"));
});

//Register
Breadcrumbs::for("register", function (BreadcrumbTrail $trail) {
    $trail->parent("store");
    $trail->push("Registrarse", route("register"));
});

//Change password
Breadcrumbs::for("account.change-password", function (BreadcrumbTrail $trail) {
    $trail->parent("account.index");
    $trail->push("Cambiar contraseña", route("account.change-password"));
});
