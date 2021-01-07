<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    public function index($id)
    {
        Cart::destroy();/* hidupkan ini untuk menghapus */
        $product = Product::find($id);
        Cart::add(['id' => $product->id, 'name' => $product->name, 'qty' => $product->price, 'price' => $product->price]);
        return Cart::content();
    }
}
