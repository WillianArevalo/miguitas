import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/store.css",
                "resources/css/admin.css",
                "resources/css/store/galeria.css",
                "resources/js/app.js",
                "resources/js/select-address.js",
                "resources/js/admin/admin.js",
                "resources/js/admin/brand.js",
                "resources/js/admin/categorie.js",
                "resources/js/admin/chart.js",
                "resources/js/admin/customer.js",
                "resources/js/admin/drawer.js",
                "resources/js/admin/faq.js",
                "resources/js/admin/flash-offers.js",
                "resources/js/admin/login.js",
                "resources/js/admin/general-settings.js",
                "resources/js/admin/modal-image.js",
                "resources/js/admin/order.js",
                "resources/js/admin/policies.js",
                "resources/js/admin/popup.js",
                "resources/js/admin/product.js",
                "resources/js/admin/sales-strategies.js",
                "resources/js/admin/settings.js",
                "resources/js/admin/ticket.js",
                "resources/js/admin/toast-admin.js",
                "resources/js/admin/user.js",
                "resources/js/admin/order-table.js",
                "resources/js/admin/reviews.js",
                "resources/js/admin/search.js",
                "resources/js/store/account.js",
                "resources/js/store/cart.js",
                "resources/js/store/checkout.js",
                "resources/js/store/faq.js",
                "resources/js/store/filters-store.js",
                "resources/js/store/loader.js",
                "resources/js/store/order.js",
                "resources/js/store/product-view.js",
                "resources/js/store/register.js",
                "resources/js/store/store.js",
                "resources/js/store/toast.js",
                "resources/js/store/slider-pack.js",
                "resources/js/store/password.js",
                "resources/js/store/payment.js",
                "resources/js/store/ticket.js",
            ],
            refresh: true,
        }),
    ],
});
