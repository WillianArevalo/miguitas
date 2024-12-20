<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Helpers\Favorites;
use App\Models\Brand;
use App\Models\Categorie;
use App\Models\Label;
use App\Models\Product;
use App\Models\SubCategorie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{

    public $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function index()
    {
        $products = Product::where("is_active", 1)->where("is_top", 1)->paginate(16);
        $categories = Categorie::all();
        Favorites::get($this->user, $products);
        return view('store.index', [
            "products" => $products,
            "categories" => $categories
        ]);
    }

    public function products(Request $request)
    {
        $search = $request->input("search");
        $filter = $request->input("filter");

        if ($request->has("filter")) {
            if ($filter == "category") {
                $category = Categorie::where("slug", $search)->first();
                $products = Product::where("is_active", 1)
                    ->where("categorie_id", $category->id)
                    ->paginate(12);
            }

            if ($filter == "subcategory") {
                $subcategory = SubCategorie::where("slug", $search)->first();
                $products = Product::where("is_active", 1)->whereHas("subcategories", function ($query) use ($subcategory) {
                    $query->where("subcategorie_id", $subcategory->id);
                })->paginate(12);
            }

            if ($filter == "name") {
                $products = Product::where("is_active", 1)->where("name", "like", "%$search%")->paginate(12);
            }
        } else {
            $products = Product::where("is_active", 1)->paginate(12);
        }

        $categories = Categorie::all();
        $subcategories = SubCategorie::select('name', "slug")->distinct()->get();
        $labels = Label::all();
        Favorites::get($this->user, $products);
        return view("store.products", [
            "products" => $products,
            "categories" => $categories,
            "subcategories" => $subcategories,
            "labels" => $labels
        ]);
    }
}