<?php

namespace App\Providers;

use App\Models\Categorie;
use App\Models\Settings;
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
            $location = Settings::where('key', 'store_map_location')->first()->value ?? '';
            $whatsapp = Settings::where('key', 'store_whatsapp')->first()->value ?? '';
            $whatsapp = str_replace([' ', '+', '-', '(', ')'], '', $whatsapp);
            $logo = Settings::where('key', 'store_logo')->first()->value ?? '';
            $subcategories = SubCategorie::all()->unique('name');
            $view->with([
                "categories" => $categories,
                "subcategories" => $subcategories,
                "location" => $location,
                "whatsapp" => $whatsapp,
                "logo" => $logo,
            ]);
        });
    }
}