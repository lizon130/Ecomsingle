<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;

class HomeController extends Controller
{
    public function index()
    {
        $allproducts = Product::latest()->get();
        return view('user_template.home', compact('allproducts'));
    }
}
