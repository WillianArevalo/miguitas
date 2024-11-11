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
        $products = Product::where("is_active", 1)->take(20)->get();
        $categories = Categorie::all();
        Favorites::get($this->user, $products);
        return view('store.index', ["products" => $products, "categories" => $categories]);
    }

    public function products()
    {
        $products = Product::where("is_active", 1)->get();
        $categories = Categorie::all();
        $subcategories = SubCategorie::select('name')->distinct()->get();
        $labels = Label::all();
        Favorites::get($this->user, $products);
        return view("store.products", ["products" => $products, "categories" => $categories, "subcategories" => $subcategories, "labels" => $labels]);
    }

    public function search(string $search, string $value)
    {
        $products = Product::where($search, $value)->get();
        $categories = Categorie::all();
        $subcategories = SubCategorie::all();
        $labels = Label::all();
        $brands = Brand::all();
        Favorites::get($this->user, $products);
        return view('store.products', ["products" => $products, "categories" => $categories, "subcategories" => $subcategories, "labels" => $labels, "brands" => $brands]);
    }
}
