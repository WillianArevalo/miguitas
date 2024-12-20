<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index()
    {
        $faqs = Faq::where("active", true)->get();
        return view("store.faq.index", compact("faqs"));
    }
}