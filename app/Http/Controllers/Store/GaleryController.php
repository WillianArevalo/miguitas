<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings;

class GaleryController extends Controller
{
    public function index()
    {
        $whatsApp = Settings::where("key", "store_whatsapp")->first();
        return view("store.galery.index", compact("whatsApp"));
    }
}
