<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::all();
        return view('admin.subscriptions.index', compact("subscriptions"));
    }

    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            Subscription::findOrFail($id)->delete();
            DB::commit();
            return redirect()->route('admin.subscriptions.index')->with('success', 'Registro eliminado correctamente');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.subscriptions.index')->with('error', 'Error al eliminar el registro');
        }
    }
}
