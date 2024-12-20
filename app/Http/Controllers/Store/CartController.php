<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ShippingMethod;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Cart as CartHelper;
use App\Models\Address;
use App\Models\Coupon;
use App\Models\Currency;
use App\Models\PaymentMethod;
use App\Models\ProductOptionValue;
use App\Models\Rate;
use App\Utils\CouponRules;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public $symbol;

    public function __construct()
    {
        $this->symbol = Currency::getDefault()->symbol ?? "$";
    }

    public function index()
    {
        $cart = CartHelper::get();
        $currency = Currency::getDefault();
        if (auth()->check()) {
            $cart = Cart::with("items.product")->with("items.options")->firstOrCreate(["user_id" => auth()->id()]);
        } else {
            $cart = session()->get('cart', null);
        }
        $shipping_methods = ShippingMethod::all();
        $products = Product::where("is_active", true)->take(10)->get();
        $carts_totals = CartHelper::totals();
        return view("store.cart.index", [
            "cart" => $cart,
            "currency" => $currency,
            "shipping_methods" => $shipping_methods,
            "products" => $products,
            "carts_totals" => $carts_totals
        ]);
    }

    public function add(Request $request, string $id)
    {
        $product = Product::find($id);
        $user = auth()->user();
        $optionValues = $request->input("options_values", []);
        $quantity = $request->input("quantity") ?? 1;
        $price = $request->input("price") ?? 0;
        DB::beginTransaction();

        try {
            $cart = Cart::firstOrCreate(["user_id" => $user->id]);
            $subTotal = 0;
            $itemPrice = 0;

            if (!empty($optionValues)) {
                foreach ($optionValues as $optionId) {
                    $optionValue = $product->options->where("id", $optionId)->first();
                    if ($optionValue) {
                        $optionPrice = $price;
                        $itemPrice = $optionPrice;
                    }
                }
                $subTotal = $itemPrice * $quantity;
            } else {
                $itemPrice = $product->offer_price ?? $product->price;
                $subTotal = $itemPrice * $quantity;
            }

            $cartItemQuery = $cart->items()->where("product_id", $product->id);

            if (!empty($optionValues)) {
                $cartItemQuery->whereHas(
                    "options",
                    function ($query) use ($optionValues) {
                        $query->whereIn("product_option_value_id", $optionValues);
                    },
                    "=",
                    count($optionValues)
                );
            }

            $cartItem = $cartItemQuery->first();

            if ($cartItem) {
                $cartItem->quantity += $quantity;
                $cartItem->sub_total += $subTotal;
                $cartItem->price = $itemPrice;
                $cartItem->save();
                DB::commit();
                return $this->responseJson("success", "Cantidad de producto actualizada");
            } else {
                $cartItem = $cart->items()->create([
                    "product_id" => $product->id,
                    "quantity" => $quantity,
                    "sub_total" => $subTotal,
                    "price" => $itemPrice
                ]);

                if (!empty($optionValues)) {
                    foreach ($optionValues as $optionId) {
                        $optionValue = $product->options->where("id", $optionId)->first();
                        if ($optionValue) {
                            $optionPrice = $price;
                            $cartItem->options()->create([
                                "product_option_value_id" => $optionValue->id,
                                "option_price" => $optionPrice,
                            ]);
                        }
                    }

                    $cartItem->save();
                }
            }

            DB::commit();
            return $this->responseJson("success", "Producto añadido al carrito");
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseJson("error", "An error occurred while adding product to cart. Error: " . $e->getMessage());
        }
    }


    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        DB::beginTransaction();
        try {
            $cart = Cart::firstOrCreate(["user_id" => auth()->id()]);
            $cartItem = $cart->items()->where("product_id", $product->id)->first();
            $price = $cartItem->price;
            if ($cartItem) {
                if ($request->input("action") === "plus") {
                    $cartItem->quantity += 1;
                    $cartItem->sub_total += $price;
                    $cartItem->save();
                    DB::commit();
                    return $this->responseJson("success", "Product quantity updated");
                } else {
                    if ($cartItem->quantity > 1) {
                        $cartItem->quantity -= 1;
                        $cartItem->sub_total -= $price;
                        $cartItem->save();
                        DB::commit();
                        return $this->responseJson("success", "Product quantity updated");
                    } else {
                        $cartItem->delete();
                        DB::commit();
                        return $this->responseJson("success", "Product removed from cart");
                    }
                }
            } else {
                return $this->responseJson("error", "Product not found in cart");
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseJson("error", "An error occurred while updating product quantity");
        }
    }

    public function remove(string $id)
    {
        $product = Product::find($id);
        DB::beginTransaction();
        try {
            $cart = Cart::firstOrCreate(["user_id" => auth()->id()]);
            $cartItem = $cart->items()->where("product_id", $product->id)->first();
            if ($cartItem) {
                $cartItem->delete();
                DB::commit();
                return $this->responseJson("success", "Product removed from cart");
            } else {
                return $this->responseJson("error", "Product not found in cart");
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseJson("error", "An error occurred while removing product from cart");
        }
    }

    public function responseJson($status, $message)
    {
        $cart = CartHelper::get();
        return response()->json([
            "status" => $status,
            "message" => $message,
            "total" => CartHelper::count(),
            "totalPrice" => $this->priceFormat(CartHelper::total()),
            "totalTaxes" => $this->priceFormat(CartHelper::totalTaxes()),
            "totalWithTaxes" => $this->priceFormat(CartHelper::totalWithTaxes()),
            "totalDiscount" => $this->priceFormat(CartHelper::totalDiscount()),
            "subtotal" => $this->priceFormat(CartHelper::subtotal()),
            "totalWithShippingMethod" => $this->priceFormat(CartHelper::totalWithShippingMethod()),
            "html" => view("layouts.__partials.ajax.store.row-cart", compact("cart"))->render(),
        ]);
    }

    public function priceFormat($number)
    {
        return $this->symbol . number_format($number, 2) ?? 0;
    }

    public function appliedCoupon(string $code)
    {
        $coupon = Coupon::where("code", $code)->first();
        if (!$coupon) return redirect()->route("cart");
        return redirect()->route("cart")->with("coupon", $coupon);
    }

    public function applyCoupon(Request $request)
    {
        $couponRules = new CouponRules();
        $cart = CartHelper::get();

        if (!$cart) {
            return response()->json(["error" => "No puedes aplicar un cupón a un carrito vacío"]);
        }

        $coupon = Coupon::with("rule")->where("code", "=", $request->input("code"))->first();
        if ($coupon) {
            $user = Auth::user();
            $conditions = [
                'user' => $user,
                "products",
                "cart_with_offers" => false,
                "cart_count" => CartHelper::count(),
                "cart_amount",
                "current_date",
                "time_of_day",
                "categories",
                "products",
                "brands",
                "labels",
                "payment_methods",
                "shipping_methods",
                "parameter" => 5
            ];
            $isValid = $couponRules->validateCoupon($coupon->rule->predefined_rule, $conditions);
            if ($isValid) {
                DB::beginTransaction();
                try {

                    $cart->coupon()->associate($coupon);
                    $cart->save();
                    DB::commit();
                    return response()->json([
                        "success" => "Cupón válido",
                        "discount" => $this->priceFormat(CartHelper::totalDiscount()),
                        "total" => $this->priceFormat(CartHelper::subtotal()),
                        "totalWithShippingMethod" => $this->priceFormat(CartHelper::totalWithShippingMethod()),
                        "html" => view("layouts.__partials.ajax.store.form-coupon", ["cart" => CartHelper::get()])->render()
                    ]);
                } catch (\Exception $e) {
                    return response()->json(["error" => "An error occurred while applying the coupon. Error: " . $e->getMessage()]);
                }
            } else {
                return response()->json(["error" => "Cupón no válido."]);
            }
        } else {
            return response()->json(["error" => "Not found coupon"]);
        }
    }

    public function removeCoupon(string $id)
    {
        $cart = CartHelper::get();
        $coupon = Coupon::find($id);
        DB::beginTransaction();
        try {
            $cart->coupon()->dissociate($coupon);
            $cart->save();
            DB::commit();
            return response()->json([
                "success" => "Cupón eliminado",
                "discount" => $this->priceFormat(CartHelper::totalDiscount()),
                "total" => $this->priceFormat(CartHelper::subtotal()),
                "totalWithShippingMethod" => $this->priceFormat(CartHelper::totalWithShippingMethod()),
                "html" => view("layouts.__partials.ajax.store.form-coupon", ["cart" => CartHelper::get()])->render()
            ]);
        } catch (\Exception $e) {
            return response()->json(["error" => "An error occurred while removing the coupon. Error: " . $e->getMessage()]);
        }
    }

    public function applyShippingMethod(string $id, Request $request)
    {
        $user = auth()->user();
        $shipping_method = ShippingMethod::find($id);
        if (!$shipping_method) return response()->json(["status" => "error", "message" => "Shipping method not found"]);
        $cart = CartHelper::get();

        $cost = null;
        parse_str($request->input("form"), $form);

        if ($user->customer) {
            $addressShipping = Address::where("customer_id", $user->customer->id)->where("type", "shipping_address")->first();
            if (!$addressShipping && $shipping_method->name === "Envío a domicilio") {
                return response()->json([
                    "status" => "error",
                    "message" => "Debes tener una dirección de envío para calcular la tarifa de envío a tu dirección."
                ], 400);
            } else if ($addressShipping && $shipping_method->name === "Envío a domicilio") {
                $department = $form["department"];
                $municipality = $form["municipality"];
                $district = $form["district"];

                $rate = Rate::where("department", $department)
                    ->where("municipality", $municipality)
                    ->where("district", $district)
                    ->first();

                if ($rate) {
                    $cost = $rate->cost;
                } else {
                    return response()->json([
                        "status" => "error",
                        "price" => $this->priceFormat(0),
                        "message" => "No se encontró una tarifa de envío para tu dirección."
                    ], 400);
                }
            }
        }

        DB::beginTransaction();
        try {
            $cart->shippingMethod()->associate($shipping_method);
            $cart->shipping_cost = $cost;
            $cart->save();
            DB::commit();
            return response()->json([
                "status" => "success",
                "message" => "Shipping method applied",
                "price" => $this->priceFormat($cost),
                "total" => $this->priceFormat(CartHelper::totalWithShippingMethod()),
                "rate" => $rate ?? null,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An error occurred while applying the shipping method. Error: " . $e->getMessage()
            ]);
        }
    }

    public function applyPaymentMethod(string $id)
    {
        $cart = CartHelper::get();
        if ($id == 0) {
            $cart->paymentMethod()->dissociate();
            $cart->save();
            return response()->json([
                "status" => "success",
                "message" => "Payment method removed",
            ]);
        }

        $payment_method = PaymentMethod::find($id);
        if (!$payment_method) return response()->json(["status" => "error", "message" => "Payment  method not found"]);

        DB::beginTransaction();
        try {
            $cart->paymentMethod()->associate($payment_method);
            $cart->save();
            DB::commit();
            return response()->json([
                "status" => "success",
                "message" => "Payment method applied",
            ]);
        } catch (\Exception $e) {
            return response()->json(["status" => "error", "message" => "An error occurred while applying the payment method. Error: " . $e->getMessage()]);
        }
    }

    public function destroy()
    {
        CartHelper::clear();
        return redirect()->route("cart")->with("success", "Carrito vaciado");
    }
}