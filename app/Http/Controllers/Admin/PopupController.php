<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Helpers\RouteHelper;
use App\Http\Requests\PopupRequest;
use App\Models\HeadBand;
use App\Models\Popup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PopupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $popups = Popup::all();
        $headbands = HeadBand::all();
        $popups = $popups->map(function ($popup) {
            $popup->type = 'popup';
            return $popup;
        });

        $headbands = $headbands->map(function ($headband) {
            $headband->type = 'headband';
            return $headband;
        });

        $adversiments = $popups->concat($headbands);

        return view("admin.popups.index", compact("adversiments"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $routes = RouteHelper::getRoutes();
        return view("admin.popups.create", compact("routes"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PopupRequest $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $popup = Popup::create($validated);
            if ($popup) {
                DB::commit();
                return redirect()->route('admin.popups.index')->with('success', 'Popup creado correctamente');
            } else {
                return redirect()->route('admin.popups.index')->with('error', 'Error al crear el popup');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.popups.index')->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $popup = Popup::find($id);
        if ($popup) {
            return response()->json(["popup" => $popup]);
        } else {
            return response()->json(["error" => "Popup no encontrado"], 404);
        }
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
            $popup = Popup::find($id);
            if ($popup) {
                $popup->delete();
                DB::commit();
                return redirect()->route('admin.popups.index')->with('success', 'Anuncio eliminado correctamente');
            } else {
                return redirect()->route('admin.popups.index')->with('error', 'Error al eliminar el anuncio');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.popups.index')->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function changeStatus(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $type = $request->type;

            if ($type === "popup") {
                $popup = Popup::find($id);
                if ($popup) {
                    $status = $request->status === "active" ? 1 : 0;
                    $popup->active = $status;
                    $popup->save();
                    DB::commit();
                    return redirect()->route('admin.popups.index')->with('success', 'Estado del anuncio cambiado correctamente');
                } else {
                    return redirect()->route('admin.popups.index')->with('error', 'Error al cambiar el estado del anuncio');
                }
            } else {
                $headband = HeadBand::find($id);
                if ($headband) {
                    $status = $request->status === "active" ? 1 : 0;
                    $headband->active = $status;
                    $headband->save();
                    DB::commit();
                    return redirect()->route('admin.popups.index')->with('success', 'Estado del anuncio cambiado correctamente');
                } else {
                    return redirect()->route('admin.popups.index')->with('error', 'Error al cambiar el estado del anuncio');
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.popups.index')->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
