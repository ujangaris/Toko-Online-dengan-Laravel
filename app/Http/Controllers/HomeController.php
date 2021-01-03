<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
        $category = Category::all()->count();
        $user = User::all()->count();
        $product = Product::all()->count();
        $transaction = Transaction::all()->count();
        return view('admin.dashboard', compact('category', 'user', 'product', 'transaction'));
    }
}
