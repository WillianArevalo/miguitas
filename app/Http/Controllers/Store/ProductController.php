<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Helpers\Favorites;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function details(string $slug)
    {
        $user = Auth::check() ? Auth::user() : null;
        $product = Product::with([
            'categories',
            'taxes',
            'labels',
            'images',
            'reviews',
            'options.option'
        ])
            ->where('slug', $slug)
            ->firstOrFail();

        $categoryId = $product->categorie_id;

        if ($user && $user->customer) {
            $purchase = $user ? $this->userHasPurchaseProduct($user->id, $product->id) : false;
        } else {
            $purchase = false;
        }

        $product->images->prepend((object)['image' => $product->main_image]);

        $products = Product::with([
            'categories',
            'subcategories',
            'taxes',
            'labels',
            'images',
            'reviews'
        ])
            ->where("id", "!=", $product->id)
            ->where("categorie_id", $categoryId)
            ->take(25)
            ->paginate(10);

        $reviews = $product->reviews->where('is_approved', 1);
        $userReview = null;

        if ($user) {
            $userReview = $product->reviews->where('user_id', $user->id)->first();
            Favorites::get($user, $products);
            Favorites::get($user, collect([$product]));
        }
        return view('store.products.view', compact('product', 'products', 'reviews', 'userReview', 'purchase'));
    }


    private function userHasPurchaseProduct($userId, $productId)
    {
        $user = User::find($userId);
        $customer = $user->customer;
        return Order::where("customer_id", $customer->id)->whereHas("items", function ($query) use ($productId) {
            $query->where("product_id", $productId);
        })->exists();
    }

    public function filter(Request $request)
    {
        $filters = json_decode($request->input("filters"), true);
        $query = Product::query();

        if (isset($filters["offert_type"])) {

            if (in_array("offers", $filters["offert_type"])) {
                $query->where("offer_active", true);
            }

            if (in_array("flash_offers", $filters["offert_type"])) {
                $query->whereHas("flash_offers", function ($q) {
                    $q->where("is_active", true)
                        ->where("start_date", "<=", now())
                        ->where("end_date", ">=", now())
                        ->where("is_showing", true);
                });
            }
        }

        if (isset($filters['price_range'])) {
            $priceRange = $filters['price_range'];

            if (isset($priceRange['min']) && is_numeric($priceRange['min'])) {
                $query->where('price', '>=', $priceRange['min']);
            }
            if (isset($priceRange['max']) && is_numeric($priceRange['max'])) {
                $query->where('max_price', '<=', $priceRange['max']);
            }
        }

        if (isset($filters['category'])) {
            $query->whereIn('categorie_id', $filters['category']);
        }

        if (isset($filters['subcategorie'])) {
            $query->whereIn('subcategorie_id', $filters['subcategorie']);
        }

        if (isset($filters["label"])) {
            $query->whereHas("labels", function ($q) use ($filters) {
                $q->whereIn("labels.id", $filters["label"]);
            });
        }

        if (isset($filters['brand'])) {
            $query->whereIn('brand_id', $filters['brand']);
        }

        if (isset($filters["older"])) {
            $query->orderBy("created_at", "asc");
        }

        if (isset($filters["order"])) {
            if ($filters["order"] === "recent") {
                $query->orderBy("created_at", "desc");
            }

            if ($filters["order"] === "price_asc") {
                $query->orderBy("price", "asc");
            }

            if ($filters["order"] === "price_desc") {
                $query->orderBy("price", "desc");
            }

            if ($filters["order"] === "offer") {
                $query->where("offer_price", ">", 0)->orderBy("offer_price", "asc");
            }
        }
        $products = $query->where("is_active", 1)->paginate(12);
        return response()->json(["html" => view('layouts.__partials.ajax.store.product-list', compact('products'))->render()]);
    }

    public function search(Request $request)
    {
        $search = $request->input("search");
        $products = Product::where("name", "like", "%$search%")->where("is_active", 1)->paginate(12);
        return response()->json([
            "html" => view('layouts.__partials.ajax.store.product-list', compact('products'))->render()
        ]);
    }

    public function getOption(Request $request)
    {
        $productId = $request->input("product_id");
        $optionIds = $request->input("options");
        $optionIds = is_array($optionIds) ? $optionIds : [$optionIds];

        try {
            $variation = ProductVariation::where('product_id', $productId)
                ->whereHas('values', function ($query) use ($optionIds) {
                    $query->whereIn('product_option_value_id', $optionIds);
                }, '=', count($optionIds)) // Verifica que tenga exactamente el número de opciones
                ->whereDoesntHave('values', function ($query) use ($optionIds) {
                    $query->whereNotIn('product_option_value_id', $optionIds);
                }) // Asegura que no tenga más opciones que las proporcionadas
                ->first();

            // Si no se encuentra una variación, devolver un mensaje de error
            if (!$variation) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se encontró una variación con las opciones seleccionadas.',
                ]);
            }

            // Si se encuentra una variación, devolver la información
            return response()->json([
                'success' => true,
                'variation' => [
                    'id' => $variation->id,
                    'price' => $variation->price,
                    'stock' => $variation->stock,
                ],
            ]);
        } catch (\Exception $e) {
            // Manejar errores inesperados
            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al buscar la variación.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
