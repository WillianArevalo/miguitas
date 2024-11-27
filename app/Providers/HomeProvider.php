<?php

namespace App\Providers;

use App\Models\HeadBand;
use App\Models\Settings;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class HomeProvider extends ServiceProvider
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
        View::composer("layouts.template", function ($view) {
            $headBands = HeadBand::where("active", true)->get();
            $favicon = Settings::where('key', 'store_favicon')->first()->value ?? '';
            $view->with([
                "headBands" => $headBands,
                "favicon" => $favicon,
            ]);
        });

        View::composer("layouts.login-template", function ($view) {
            $favicon = Settings::where('key', 'store_favicon')->first()->value ?? '';
            $view->with([
                "favicon" => $favicon,
            ]);
        });
    }
}
