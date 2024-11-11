<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductOption;
use Illuminate\Support\Facades\DB;

class OptionController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            ProductOption::create([
                'name' => $request->name,
            ]);
            DB::commit();
            $options = ProductOption::all();

            return response()->json([
                'success' => 'Opción creada correctamente.',
                'html' => view("layouts.__partials.ajax.admin.options.list-options", compact('options'))->render()
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
