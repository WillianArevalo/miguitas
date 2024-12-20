<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Helpers\Favorites;
use App\Models\Categorie;
use App\Models\HeadBand;
use App\Models\Popup;
use App\Models\Product;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $referencesIdsPopups = Cookie::get("popup");
        $referencesIds = json_decode($referencesIdsPopups, true);
        $popups = Popup::where("active", true)
            ->when(!empty($referencesIds), function ($query) use ($referencesIds) {
                $query->whereNotIn("reference_id", $referencesIds);
            })
            ->take(1)
            ->get();

        Favorites::get($user, $products);
        Favorites::get($user, $topProducts);

        return view('home', [
            "products" => $products,
            "topProducts" => $topProducts,
            "flashOffers" => $flashOffers,
            "categories" => $categories,
            "theMonthProducts" => $theMonthProducts,
            "popups" => $popups
        ]);
    }

    public function cookies(Request $request)
    {;
        $action = $request->input("action");
        if ($action === "accept-all") {
            Cookie::queue('accept_cookies', true, 60 * 24 * 365);
            if (Auth::check()) {
                Auth::login(Auth::user(), true);
            }
            return response()->json(["success" => "Cookies aceptadas"]);
        } else if ($action === "deny-all") {
            Cookie::queue('deny_cookies', true, 60 * 24 * 365);
            return response()->json(["success" => "Cookies rechazadas"]);
        } else {
            return response()->json(["error" => "Acción no válida"], 400);
        }
    }

    public function showCookies()
    {
        return view("store.policy-cookies");
    }

    public function showPopup(Request $request)
    {
        $reference = $request->input("reference_id");
        $existingPopups = json_decode(Cookie::get("popup", "[]", true));

        if (!in_array($reference, $existingPopups)) {
            $existingPopups[] = $reference;
        }

        $popup = Popup::where("reference_id", $reference)->first();
        if ($popup) {
            Cookie::queue(
                'popup',
                json_encode($existingPopups), // Convertir a JSON
                60 * 24 * 365,               // Duración: 1 año
                '/',
                null,
                true,                        // HTTPS
                true,                        // HttpOnly
                'lax'
            );
            return response()->json(["success" => "Popup visto"]);
        } else {
            return response()->json(["error" => "Popup no encontrado"], 404);
        }
    }

    public function acceptPopup(Request $request)
    {
        DB::beginTransaction();
        try {
            $reference = $request->input("reference_id");
            $content = $request->input("content");
            Subscription::create([
                "reference_id" => $reference,
                "value" => $content,
            ]);
            DB::commit();
            return response()->json(["success" => "Subscripción creada"]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(["error" => "Error al crear la subscripción"], 500);
        }
    }
}
