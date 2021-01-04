<?php

namespace App\Http\Controllers\homepage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BerandaController extends Controller
{
    public function index()
    {
        return view('homepage.homepage',['title' =>'Toko Online' ]);
    }
}
