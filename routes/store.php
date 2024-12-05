<?php

/** Routes Store */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PoliciesController;
use App\Http\Controllers\Store\{
    CategoryController,
    FAQController,
    OrderController,
    ProductController,
    AboutController,
    AccountController,
    AddressController,
    BlogController,
    CheckoutController,
    ContactController,
    CouponController,
    CustomerController,
    FavoriteController,
    HomeController,
    ReviewController,
    StoreController,
    CartController,
    GaleryController,
    PaymentController,
    SupportTicketController,
    TermsAndConditionsController
};

// Public Routes
Route::get("/", [HomeController::class, "index"])->name("home");

// Pages
Route::get("/conócenos", [AboutController::class, "index"])->name("about");
Route::get("/preguntas-frecuentes", [FAQController::class, "index"])->name("faq");
Route::get("/galería", [GaleryController::class, "index"])->name("galery");
Route::get("/contactanos", [ContactController::class, "index"])->name("contact");
Route::post("/contactanos", [ContactController::class, "store"])->name("contact.store");


/* Route::get("/blog", [BlogController::class, "index"])->name("blog");
Route::get("/blog/{slug}", [BlogController::class, "show"])->name("blog.show"); */

// Products
Route::controller(ProductController::class)->group(function () {
    Route::get("/producto/{slug}/detalles", "details")->name("products.details");
    Route::post("/products/filter", [ProductController::class, "filter"])->name("products.filter");
    Route::post("/products/search", [ProductController::class, "search"])->name("products.search");
    Route::get("/product/get-option", [ProductController::class, "getOption"])->name("product.get-option");
});

// Policies
Route::get("/polices/{slug}", [PoliciesController::class, "showPolicy"])->name("policies.show");

// Store
Route::controller(StoreController::class)->group(function () {
    Route::get("/tienda", "index")->name("store");
    Route::get("/tienda/productos", "products")->name("store.products");
});

// Cart
Route::controller(CartController::class)->group(function () {
    Route::get("/carrito", "index")->name("cart");
    Route::post("/cart/add/{id}", "add")->name("cart.add");
    Route::post("/cart/remove/{id}", "remove")->name("cart.remove");
    Route::post("/cart/update/{id}", "update")->name("cart.update");
    Route::get("/cart/applied-coupon/{id}", "appliedCoupon")->name("cart.applied-coupon");
    Route::post("/cart/apply-coupon", "applyCoupon")->name("cart.apply-coupon");
    Route::get("/cart/apply-shipping-method/{id}", "applyShippingMethod")->name("cart.apply-shipping-method");
    Route::get("/cart/apply-payment-method/{id}", "applyPaymentMethod")->name("cart.apply-payment-method");
    Route::post("/cart/remove-coupon/{id}", "removeCoupon")->name("cart.remove-coupon");
    Route::post("/cart/destroy", "destroy")->name("cart.destroy");
});

// Categories
Route::get("/categories", [CategoryController::class, "showCategoriesStore"])->name("categories");

// Terms and conditions
Route::get("/terminos-y-condiciones/{slug}", [TermsAndConditionsController::class, "getPolicy"])->name("terms-and-conditions");
Route::get("/policies/{policy}/download-pdf", [TermsAndConditionsController::class, "downloadPdf"])->name("policies.download-pdf");

// Authenticated Routes
Route::middleware("auth")->group(function () {
    // Account Management
    Route::prefix("cuenta")->name("account.")->group(function () {
        Route::get("/", [AccountController::class, "index"])->name("index");
        Route::get("/settings", [AccountController::class, "settings"])->name("settings");
        Route::get("/editar-datos", [AccountController::class, "settingsEdit"])->name("settings-edit");
        Route::post("/settings-update", [AccountController::class, "settingsUpdate"])->name("settings-update");
        Route::get("/change-password", [AccountController::class, "changePassword"])->name("change-password");
        Route::post("/edit-password", [AccountController::class, "editPassword"])->name("edit-password");
        Route::post("/change-profile", [AccountController::class, "changeProfile"])->name("change-profile");

        Route::prefix("direcciones")->name("addresses.")->group(function () {
            Route::get("/", [AddressController::class, "index"])->name("index");
            Route::get("/nueva", [AddressController::class, "create"])->name("create");
            Route::post("/", [AddressController::class, "store"])->name("store");
            Route::get("/{id}/editar", [AddressController::class, "edit"])->name("edit");
            Route::put("/{id}/update", [AddressController::class, "update"])->name("update");
            Route::delete("/destroy/{id}", [AddressController::class, "destroy"])->name("destroy");
        });

        Route::resource("/tickets", SupportTicketController::class);
        Route::post("/tickets/{id}/close", [SupportTicketController::class, "close"])->name("tickets.close");
    });

    // Orders
    Route::post("/orders/info-add", [CustomerController::class, "store"])->name("customer.store");
    Route::post("/order/cancel/{id}", [OrderController::class, "cancel"])->name("order.cancel");
    Route::post("/order/add-comment/{id}", [OrderController::class, "addComment"])->name("order.add-comment");
    Route::post("/order-remove-comment/{id}", [OrderController::class, "removeComment"])->name("order.remove-comment");
    Route::resource("/pedidos", OrderController::class)->names("orders");
    Route::get("/cancelaciones-devoluciones", [OrderController::class, "cancelReturn"])->name("cancel-return");
    Route::post("/pedidos/buscar", [OrderController::class, "search"])->name("orders.search");


    // Payments
    Route::resource("/pagos", PaymentController::class)->names("payments");

    // Favorites
    Route::controller(FavoriteController::class)->group(function () {
        Route::get("/favoritos", "index")->name("favorites");
        Route::post("/favorites/add/{id}", "addFavorite")->name("favorites.add");
        Route::post("/favorites/remove/{id}", "removeFavorite")->name("favorites.remove");
    });

    // Coupons
    Route::get("/my-coupons", [CouponController::class, "index"])->name("mycoupons");

    // Checkout
    Route::get("/facturación", [CheckoutController::class, "index"])->name("checkout");
    Route::post("/facturación/update", [CheckoutController::class, "update"])->name("checkout.update");

    // Reviews
    Route::resource("/reviews", ReviewController::class);
});

Route::post("/billing/wompi", [CheckoutController::class, "wompi"])->name("checkout.wompi");
Route::post("/billing/wompi/link", [CheckoutController::class, "get_wompi_link"])->name("link.wompi");

Route::post("/accept-all-cookies", [HomeController::class, "acceptAllCookies"])->name("accept-all-cookies");
Route::get("/politica-de-cookies", [HomeController::class, "showCookies"])->name("cookies");

Route::get("/show-popup", [HomeController::class, "showPopup"])->name("show-popup");
Route::get("/popup/guardar-datos", [HomeController::class, "acceptPopup"])->name("popup.store");
