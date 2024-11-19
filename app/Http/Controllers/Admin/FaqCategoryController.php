<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FaqCategoryController extends Controller
{


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'active' => 'required|boolean'
        ]);

        DB::beginTransaction();
        try {
            FaqCategory::create($request->only('name', 'active'));
            DB::commit();
            return redirect()->route('admin.faq.index')->with('success', 'Categoría creada correctamente');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error al crear la categoría: ' . $th->getMessage());
            return redirect()->route('admin.faq.index')->with('error', 'Error al crear la categoría. ');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $faqCategory = FaqCategory::find($id);
        return response()->json($faqCategory);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            FaqCategory::find($id)->update($request->all());
            DB::commit();
            return redirect()->route('admin.faq.index')->with('success', 'Categoría actualizada correctamente');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('admin.faq.index')->with('error', 'Error al actualizar la categoría');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {

            if (Faq::where('faq_category_id', $id)->exists()) {
                return redirect()->route('admin.faq.index')->with('error', 'No se puede eliminar la categoría porque tiene preguntas asociadas');
            }

            FaqCategory::find($id)->delete();
            DB::commit();
            return redirect()->route('admin.faq.index')->with('success', 'Categoría eliminada correctamente');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('admin.faq.index')->with('error', 'Error al eliminar la categoría');
        }
    }
}