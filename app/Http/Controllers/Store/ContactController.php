<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index()
    {
        $settings = Settings::all();
        return view("store.contact.index", compact("settings"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:255",
            "last_name" => "required|string|max:255",
            "email" => "required|email|max:255",
            "phone" => "required|string|max:255",
            "message" => "required|string|max:1000",
        ]);

        DB::beginTransaction();
        try {
            ContactMessage::create($request->all());
            DB::commit();
            return redirect()->route("contact")->with("success", "Mensaje enviado correctamente");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route("contact")->with("error", "Error al enviar el mensaje");
        }
    }
}