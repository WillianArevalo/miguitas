import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/store.css",
                "resources/css/store/index.css",
                "resources/css/store/404.css",
                "resources/css/store/blog.css",
                "resources/css/store/carrito.css",
                "resources/css/store/category.css",
                "resources/css/store/conocenos.css",
                "resources/css/store/contactanos.css",
                "resources/css/store/facturacion.css",
                "resources/css/store/faq.css",
                "resources/css/store/favorite.css",
                "resources/css/store/galeria.css",
                "resources/css/store/info-productos.css",
                "resources/css/store/login-signup.css",
                "resources/css/store/product-info.css",
                "resources/css/store/profile.css",
                "resources/css/store/shop.css",
                "resources/css/store/terms-conditions.css",
                "resources/js/app.js",
            ],
            refresh: true,
        }),
    ],
});
