<?php

/** Routes Admin */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    AddressController,
    AdminController,
    BrandController,
    CategorieController,
    ConfigurationController,
    ContactMessageController,
    CouponController,
    CurrencyController,
    CustomerController,
    FaqCategoryController,
    FAQController,
    FlashOfferController,
    HeadBandController,
    LabelController,
    OptionController,
    OptionValueController,
    OrderController,
    PaymentController,
    PoliciesController,
    PopupController,
    ProductController,
    ReviewController,
    SaleStrategyController,
    SettingsController,
    SettingsGeneralController,
    ShippingController,
    SocialNetworkController,
    SubCategorieController,
    SupportTicketController,
    TaxController,
    TicketCommentController,
    UserController
};


// Public Admin Routes
Route::get("/admin/login", [AdminController::class, "login"])->name("admin.login");

// Admin Routes with Middleware
Route::middleware("role:admin")->prefix("admin")->name("admin.")->group(function () {

    // Dashboard
    Route::get("/", [AdminController::class, "index"])->name("index");
    Route::get("/search", [AdminController::class, "search"])->name("search");

    // Categories
    Route::resource("/categories", CategorieController::class);
    Route::post("/categories/search", [CategorieController::class, "search"])->name("categories.search");

    // Subcategories
    Route::resource("/subcategories", SubCategorieController::class);
    Route::post("/subcategories/search", [SubCategorieController::class, "search"])->name("subcategories.search");

    // Brands
    Route::resource("/brands", BrandController::class);
    Route::post("/brands/search", [BrandController::class, "search"])->name("brands.search");

    // Products
    Route::resource("/products", ProductController::class);
    Route::delete("/products-delete", [ProductController::class, "deleteSelected"])->name("products.deleteSelected");
    Route::post("/products/import", [ProductController::class, "import"])->name("products.import");
    Route::get("/products/export", [ProductController::class, "export"])->name("products.export");
    Route::get("/products/delete-image/{id}", [ProductController::class, "deleteImage"])->name("products.delete-image");
    Route::post("/products/search", [ProductController::class, "search"])->name("products.search");

    // Contact Messages
    Route::resource("/contact-messages", ContactMessageController::class);
    Route::delete("/contact-messages/destroy/{id}", [ContactMessageController::class, "destroy"])->name("contact-messages.delete");

    // Taxes
    Route::resource("/taxes", TaxController::class);

    // Labels
    Route::resource("/labels", LabelController::class);

    //Options products
    Route::resource("/options", OptionController::class);
    Route::resource("/options-values", OptionValueController::class);

    // Flash Offers
    Route::resource("/flash-offers", FlashOfferController::class);
    Route::prefix("/flash-offers")->name("flash-offers.")->group(function () {
        Route::post("/add-flash-offer", [FlashOfferController::class, "addFlashOffer"])->name("add-flash-offer");
        Route::post("/change-show/{id}", [FlashOfferController::class, "changeShow"])->name("change-show");
        Route::post("/change-status/{id}", [FlashOfferController::class, "changeStatus"])->name("change-status");
    });

    // Popups
    Route::resource("/popups", PopupController::class);
    Route::post("/popups/change-status/{id}", [PopupController::class, "changeStatus"])->name("popups.change-status");
    Route::resource("/headbands", HeadBandController::class);

    // Users
    Route::resource("/users", UserController::class);

    // Customers
    Route::resource("/customers", CustomerController::class);

    // Addresses
    Route::resource("/addresses", AddressController::class);

    // Policies
    Route::resource("/policies", PoliciesController::class);
    Route::get("/policies/download/{policy}", [PoliciesController::class, "download"])->name("policies.download");

    // FAQ
    Route::resource("/faq-categories", FaqCategoryController::class);
    Route::resource("/faq", FAQController::class);

    // Locale
    Route::get("locale/{locale}", [ConfigurationController::class, "setLocale"])->name("locale");

    // Settings
    Route::prefix("settings")->name("settings.")->group(function () {
        Route::get("/", [SettingsController::class, "index"])->name("index");
        Route::post("/update", [SettingsController::class, "update"])->name("update");
        Route::post("/change-color", [SettingsController::class, "changeColor"])->name("change-color");
        Route::post("/change-theme", [SettingsController::class, "changeTheme"])->name("change-theme");
        Route::post("/change-profile", [SettingsController::class, "changeProfilePhoto"])->name("change-profile");
        Route::post("/change-password", [SettingsController::class, "changePassword"])->name("change-password");
        Route::post("/change-email", [SettingsController::class, "changeEmail"])->name("change-email");
    });

    // Support Tickets
    Route::resource("/support-tickets", SupportTicketController::class);
    Route::resource("/ticket-comment", TicketCommentController::class);
    Route::post("/support-tickets/asign/{id}", [SupportTicketController::class, "asign"])->name("support-tickets.asign");


    // Orders
    Route::resource("/orders", OrderController::class);
    Route::post("/order/status/{id}", [OrderController::class, "changeStatus"])->name("orders.status");
    Route::post("/orders/payment-status/{id}", [OrderController::class, "changePaymentStatus"])->name("orders.payment-status");

    // Sales Strategies
    Route::prefix("sales-strategies")->name("sales-strategies.")->group(function () {
        Route::get("/", [SaleStrategyController::class, "index"])->name("index");
        Route::resource("/coupon", CouponController::class);
        Route::resource("/shipping-methods", ShippingController::class);
        Route::resource("/payment-methods", PaymentController::class);
        Route::resource("/currencies", CurrencyController::class);
    });

    // General Settings
    Route::prefix("general-settings")->name("general-settings.")->group(function () {
        Route::get("/", [SettingsGeneralController::class, "index"])->name("index");
        Route::post("/", [SettingsGeneralController::class, "store"])->name("store");
        Route::post("/maintenance/update", [SettingsGeneralController::class, "maintenanceUpdate"])->name("maintenance.update");
    });

    // Social Networks
    Route::resource("/social-networks", SocialNetworkController::class);

    // Reviews
    Route::resource("/reviews", ReviewController::class);
    Route::post("/reviews/status/{id}", [ReviewController::class, "changeStatus"])->name("reviews.status");
});