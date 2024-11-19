<?php

namespace App\Providers;

use App\Models\Categorie;
use App\Models\SubCategorie;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class NavStoreProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer("layouts.__partials.store.navbar", function ($view) {
            $categories = Categorie::all();
            $subcategories = SubCategorie::all()->unique('name');
            $view->with([
                "categories" => $categories,
                "subcategories" => $subcategories
            ]);
        });
    }
}