<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\ProductOptionValue;
use Illuminate\Support\Facades\DB;

class OptionValueController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "option_id" => "required|integer",
            "product_id" => "required|integer",
            "value" => "required|string",
            "price" => "required|numeric",
            "stock" => "required|integer"
        ]);
        DB::beginTransaction();
        try {
            $option = ProductOption::findOrFail($request->input("option_id"));
            $product = Product::findOrFail($request->input("product_id"));
            $value =
                ProductOptionValue::create([
                    "product_option_id" => $option->id,
                    "value" => $request->input("value")
                ]);

            if (!$value) {
                return back()->with("error", "No se pudo crear la opción");
            }

            $product->options()->attach($value->id, [
                "price" => $request->input("price"),
                "stock" => $request->input("stock"),
            ]);

            DB::commit();
            return back()->with("success", "Opción creada correctamente.");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with("error", "Error: " . $e->getMessage());
            dd($e);
        }
    }

    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            ProductOptionValue::destroy($id);
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