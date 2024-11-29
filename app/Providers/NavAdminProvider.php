<?php

namespace App\Providers;

use App\Models\ContactMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class NavAdminProvider extends ServiceProvider
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
        View::composer("layouts.__partials.admin.navbar", function ($view) {
            $notifications = [];

            if (Auth::check()) {
                $notifications = auth()->user()->notifications->take(5)->sortByDesc('created_at');
            }

            $countNotRead = $notifications->where('read', false)->count();

            $notifications = $notifications->map(function ($notification) {
                $notification->icon = $this->mapIcon($notification);
                $notification->url = $this->getURL($notification);
                return $notification;
            });

            $messages = ContactMessage::all();
            $view->with([
                "notifications" => $notifications,
                "messages" => $messages,
                "countNotRead" => $countNotRead
            ]);
        });
    }

    public function mapIcon($notification)
    {
        $icons = [
            "App\Models\SupportTicket" => "headpones",
            "App\Models\Order" => "orders"
        ];

        return $icons[$notification->type] ?? "ticket";
    }

    public function getURL($notification)
    {
        $urls = [
            "App\Models\SupportTicket" => route('admin.support-tickets.show', $notification->reference_id),
            "App\Models\Order" => route('admin.orders.show', $notification->reference_id)
        ];

        return $urls[$notification->type] ?? route('admin.index');
    }
}