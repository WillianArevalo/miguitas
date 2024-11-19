<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FAQController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = Faq::all();
        $faqCategories = FaqCategory::all();
        return view("admin.faq.index", compact("faqs", "faqCategories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'faq_category_id' => 'required|exists:faq_category,id',
            'active' => 'required|boolean'
        ]);

        DB::beginTransaction();
        try {
            Faq::create($request->only('question', 'answer', 'faq_category_id'));
            DB::commit();
            return redirect()->route("admin.faq.index")->with("success", "FAQ creada correctamente");
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error al crear la FAQ: ' . $th->getMessage());
            return redirect()->route("admin.faq.index")->with("error", "Error al crear la FAQ");
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $faq = Faq::find($id);
        if (!$faq) {
            return back()->with("error", "No se pudo encontrar la FAQ");
        }
        return response()->json(["faq" => $faq]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'faq_category_id' => 'required|exists:faq_category,id',
        ]);

        DB::beginTransaction();
        try {
            $active = $request->has('active') ? 1 : 0;
            $request->merge(['active' => $active]);
            Faq::find($id)->update($request->all());
            DB::commit();
            return redirect()->route("admin.faq.index")->with("success", "FAQ actualizada correctamente");
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error al actualizar la FAQ: ' . $th->getMessage());
            return redirect()->route("admin.faq.index")->with("error", "Error al actualizar la FAQ");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            Faq::find($id)->delete();
            DB::commit();
            return redirect()->route("admin.faq.index")->with("success", "FAQ eliminada correctamente");
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error al eliminar la FAQ: ' . $th->getMessage());
            return redirect()->route("admin.faq.index")->with("error", "Error al eliminar la FAQ");
        }
    }
}