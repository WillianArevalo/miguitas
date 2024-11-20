<?php

namespace App\Providers;

use App\Models\Currency;
use App\Models\PaymentMethod;
use App\Models\Policy;
use App\Models\Settings;
use App\Models\SocialLink;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class FooterProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer("layouts.__partials.store.footer", function ($view) {
            $currencies = Currency::where("active", true)->get();
            $settings = Settings::all();
            $logo = Settings::where('key', 'store_logo')->first()->value ?? '';
            $description = Settings::where('key', 'store_description')->first()->value ?? '';
            $currencyDefault = Currency::where("is_default", true)->first();
            $paymentMethods = PaymentMethod::where("active", true)->get();
            $socialLinks = SocialLink::all();
            $policies = Policy::all();
            $view->with(
                [
                    "currencies" => $currencies,
                    "currencyDefault" => $currencyDefault,
                    "paymentMethods" => $paymentMethods,
                    "policies" => $policies,
                    "settings" => $settings,
                    "logo" => $logo,
                    "description" => $description,
                    "socialLinks" => $socialLinks,
                ]
            );
        });
    }
}