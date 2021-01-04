<?php

namespace App\Http\Controllers\homepage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class BerandaController extends Controller
{
    public function index()
    {   $title = "Toko Online";
        $products = Product::take(8)->orderBy('id', 'DESC')->get();
        return view('homepage.homepage', compact('title', 'products'));
    }

    public function product()
    {
        $title = "All Product";
        $products = Product::orderBy('id', 'DESC')->paginate(2);
        return view('homepage.product', compact('title', 'products'));
    }
}
