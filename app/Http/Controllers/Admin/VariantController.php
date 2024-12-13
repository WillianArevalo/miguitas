<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductVariation;
use App\Models\ProductVariationValue;
use Illuminate\Support\Facades\DB;

class VariantController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            "product_id" => "required|integer|exists:products,id",
            "price_variation" => "required|numeric|min:0",
            "stock_variation" => "required|integer|min:0",
            "options" => "required|array",
        ]);

        try {
            DB::beginTransaction();

            $productVariation = ProductVariation::create([
                "product_id" => $validated["product_id"],
                "price" => $validated["price_variation"],
                "stock" => $validated["stock_variation"],
            ]);

            foreach ($validated["options"] as $option) {
                ProductVariationValue::create([
                    "product_variation_id" => $productVariation->id,
                    "product_option_value_id" => $option,
                ]);
            }

            DB::commit();
            return redirect()->route("admin.products.edit", $validated["product_id"])
                ->with("success", "Variante creada correctamente");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route("admin.products.edit", $validated["product_id"])
                ->with("error", "Ocurrió un error al crear la variante. Error: {$e->getMessage()}");
        }
    }

    public function destroy(string $id)
    {
        $variation = ProductVariation::find($id);
        $product_id = $variation->product_id;
        try {
            DB::beginTransaction();
            $variation->delete();
            DB::commit();
            return redirect()->route("admin.products.edit", $product_id)
                ->with("success", "Variante eliminada correctamente");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route("admin.products.edit", $product_id)
                ->with("error", "Ocurrió un error al eliminar la variante. Error: {$e->getMessage()}");
        }
    }

    public function edit(string $id)
    {
        $variation = ProductVariation::find($id);
        if (!$variation) {
            return response()->json(["error" => "Variante no encontrada"], 404);
        }
        return response()->json($variation);
    }

    public function update(string $id, Request $request)
    {
        $validated = $request->validate([
            "price" => "required|numeric|min:0",
            "stock" => "required|integer|min:0",
        ]);

        $variation = ProductVariation::find($id);
        if (!$variation) {
            return response()->json(["error" => "Variante no encontrada"], 404);
        }

        try {
            DB::beginTransaction();
            $product_id = $variation->product_id;
            $variation->price = $validated["price"];
            $variation->stock = $validated["stock"];
            $variation->save();
            DB::commit();
            return redirect()->route("admin.products.edit", $product_id)
                ->with("success", "Variante actualizada correctamente");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route("admin.products.edit", $product_id)
                ->with("error", "Ocurrió un error al actualizar la variante.");
        }
    }
}
