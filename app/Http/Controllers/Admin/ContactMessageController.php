<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactMessageController extends Controller
{
    public function index()
    {
        $contactMessages = ContactMessage::orderBy("created_at", "desc")->paginate(10);
        return view("admin.contact_messages.index", compact("contactMessages"));
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            ContactMessage::find($id)->delete();
            DB::commit();
            return redirect()->route("admin.contact-messages.index")->with("success", "Mensaje de contacto eliminado correctamente");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route("admin.contact-messages.index")->with("error", "Error al eliminar el mensaje de contacto");
        }
    }
}