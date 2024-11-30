<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Helpers\Favorites;
use App\Models\Categorie;
use App\Models\HeadBand;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $products = Product::with("labels")
            ->whereDoesntHave("flash_offers")
            ->where("is_top", false)
            ->take(10)
            ->get();
        $topProducts = Product::with("labels")->where("is_top", true)->get();
        $theMonthProducts = Product::with("labels")->where("is_the_month", true)->get();
        $categories = Categorie::all();
        $flashOffers = Product::whereHas('flash_offers', function ($query) {
            $query->where('is_showing', true)
                ->where('is_active', true);
        })->with(['flash_offers' => function ($query) {
            $query->where('is_showing', true)
                ->where('is_active', true);
        }])->get();

        Favorites::get($user, $products);
        Favorites::get($user, $topProducts);

        return view('home', [
            "products" => $products,
            "topProducts" => $topProducts,
            "flashOffers" => $flashOffers,
            "categories" => $categories,
            "theMonthProducts" => $theMonthProducts,
        ]);
    }

    public function acceptAllCookies(Request $request)
    {

        Cookie::queue('accept_cookies', true, 60 * 24 * 365);
        if (Auth::check()) {
            Auth::login(Auth::user(), true);
        }

        return response()->json(["success" => "Cookies aceptadas"]);
    }

    public function showCookies()
    {
        return view("store.policy-cookies");
    }
}
