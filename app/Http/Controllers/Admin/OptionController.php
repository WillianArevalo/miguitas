<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductOption;
use App\Models\ProductOptionValue;
use Illuminate\Support\Facades\DB;

class OptionController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            $option = ProductOption::create([
                'name' => $request->name,
                'product_id' => $request->product_id,
            ]);
            DB::commit();
            return back()->with('success', 'Atributo creado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function search(Request $request)
    {
        $optionParent = ProductOption::with("values")->find($request->option_id);
        $options = $optionParent->values;
        if (!$options) {
            return response()->json([
                'error' => 'No se encontraron resultados.'
            ], 404);
        }

        return response()->json([
            "html" => view("layouts.__partials.ajax.admin.options.list-options", compact('options', 'optionParent'))->render()
        ], 200);
    }

    public function destroy(string $id, Request $request)
    {
        DB::beginTransaction();
        try {
            $product = Product::findOrFail($request->product_id);
            $option = ProductOption::findOrFail($id);
            if (!$product || !$option) {
                return back()->with('error', 'No se encontró el producto o la opción.');
            }

            $childOptionValueIds = ProductOptionValue::where('product_option_id', $option->id)
                ->pluck('id')
                ->toArray();

            if (empty($childOptionValueIds)) {
                return back()->with('error', 'No hay valores asociados a esta opción para eliminar.');
            }

            $product->options()->detach($childOptionValueIds);
            DB::commit();
            return back()->with('success', 'Atributo y opciones relacionadas eliminados correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}