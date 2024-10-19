<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index()
    {
        return view("store.blog.index");
    }

    public function show(string $slug)
    {
        return view("store.blog.show", compact("slug"));
    }
}
