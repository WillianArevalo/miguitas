<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\ProductOptionValue;
use Illuminate\Support\Facades\DB;
use phpseclib3\Crypt\RC2;

class OptionValueController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "option_id" => "required|integer",
            "product_id" => "required|integer",
            "value" => "required|string",
        ]);

        DB::beginTransaction();
        try {
            $product = Product::findOrFail($request->input("product_id"));
            $optionParent = ProductOption::findOrFail($request->input("option_id"));

            if (!$product || !$optionParent) {
                return back()->with("error", "No se encontró el producto o la opción.");
            }

            $existingOptionValue = ProductOptionValue::where("product_option_id", $optionParent->id)
                ->where("value", $request->input("value"))
                ->first();

            if ($existingOptionValue) {
                if (!$product->options()->where("product_option_value_id", $existingOptionValue->id)->exists()) {
                    $product->options()->attach($existingOptionValue->id);
                }
                DB::commit();
                return redirect()->route("admin.products.edit", $product->id)->with("success", "Opción asignada correctamente.");
            }

            $newOptionValue = ProductOptionValue::create([
                "product_option_id" => $optionParent->id,
                "value" => $request->input("value"),
            ]);

            if (!$newOptionValue) {
                DB::rollBack();
                return back()->with("error", "No se pudo crear la opción.");
            }

            $product->options()->attach($newOptionValue->id);
            DB::commit();
            return redirect()->route("admin.products.edit", $product->id)->with("success", "Opción creada correctamente.");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with("error", "Error: " . $e->getMessage());
        }
    }

    public function destroy(string $id, Request $request)
    {
        DB::beginTransaction();
        try {
            $product = Product::findOrFail($request->input("product_id"));
            if (!$product) {
                return back()->with("error", "No se encontró el producto.");
            }

            $product->options()->detach($id);
            DB::commit();
            return back()->with("success", "Opción eliminada correctamente.");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with("error", "Error: " . $e->getMessage());
        }
    }

    public function edit(string $id, Request $request)
    {
        $option = ProductOptionValue::findOrFail($id);
        $pivotValues = DB::table("product_product_option_value")
            ->where("product_id", $request->id_product)
            ->where("id", $request->id_option)
            ->select("stock", "price", "id")
            ->first();
        return response()->json([
            "option" => $option,
            "values" => $pivotValues
        ]);
    }

    public function update(string $id, Request $request)
    {
        $request->validate([
            "option_id" => "required|integer",
            "product_id" => "required|integer",
            "option_value_id" => "required|integer",
            "value" => "required|string",
            "price" => "required|numeric",
            "stock" => "required|integer"
        ]);

        DB::beginTransaction();
        try {
            $product = Product::findOrFail($request->input("product_id"));
            $value = ProductOptionValue::findOrFail($request->input("option_id"));
            $product->options()->updateExistingPivot($value->id, [
                "price" => $request->input("price"),
                "stock" => $request->input("stock")
            ]);
            $value->update([
                "value" => $request->input("value")
            ]);
            DB::commit();
            return back()->with("success", "Opción actualizada correctamente.");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with("error", "Error: " . $e->getMessage());
        }
    }
}