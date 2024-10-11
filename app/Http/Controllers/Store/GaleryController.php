<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GaleryController extends Controller
{
    public function index()
    {
        return view("store.galery.index");
    }
}
