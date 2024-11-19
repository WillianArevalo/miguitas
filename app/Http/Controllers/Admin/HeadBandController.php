<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HeadBand;
use Illuminate\Container\Attributes\Log;
use Illuminate\Support\Facades\DB;

class HeadBandController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'link_text' => 'nullable|string|max:255',
            'active' => 'required|boolean',
        ]);

        DB::beginTransaction();
        try {
            HeadBand::create($request->all());
            DB::commit();
            return redirect()->route('admin.popups.create')->with('success', 'Anuncio de cabecera creada correctamente');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error al crear el anuncio de cabecera: ' . $th->getMessage());
            return redirect()->route('admin.popups.create')->with('error', 'Error al crear el anuncio de cabecera');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            HeadBand::find($id)->delete();
            DB::commit();
            return redirect()->route('admin.popups.index')->with('success', 'Anuncio de cabecera eliminado correctamente');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Error al eliminar el anuncio de cabecera: ' . $th->getMessage());
            return redirect()->route('admin.popups.index')->with('error', 'Error al eliminar el anuncio de cabecera');
        }
    }
}