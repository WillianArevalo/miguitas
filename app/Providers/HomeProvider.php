<?php

namespace App\Providers;

use App\Models\HeadBand;
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
            $view->with("headBands", $headBands);
        });
    }
}