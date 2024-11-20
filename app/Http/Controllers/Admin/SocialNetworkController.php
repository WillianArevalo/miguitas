<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SocialNetworkController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "network_name" => "required|string|max:255",
            "store_social_network_url" => "required|string|max:255",
        ]);

        DB::beginTransaction();
        try {
            SocialLink::create([
                "network_name" => $request->network_name,
                "url" => $request->store_social_network_url,
            ]);
            DB::commit();
            return redirect()->back()->with("success", "Red social agregada correctamente");
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with("error", "Error al agregar la red social");
        }
    }
}