<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Cart;
use Auth;
use Alert;


class CartController extends Controller
{
    protected $category;
    public function __construct()
    {
        $this->category = Category::where('parent_id', null)->get(); //parent_id tidak null maka diambildatanya
    }
    public function index(Request $request)
    {
        // Cart::destroy();/* hidupkan ini untuk menghapus */
        $product = Product::find($request->id);
        Cart::add(['id' => $product->id, 'name' => $product->name, 'qty' => $request->qty, 'price' => $product->price]);
        // return Cart::content();/* Menampilkan dalam bentuk json */
        return redirect('keranjang');
    }

    public function keranjang()
    {
        $category = $this->category;
        return view('homepage.keranjang', compact('category'));
    }

    public function update(Request $request)
    {
        Cart::update($request->rowid, $request->qty);
        $category = $this->category;
        Alert::success('', 'Keranjang Belanja Berhasil di perbaharui');
        return redirect('keranjang');
    }
    public function delete( $rowid)
    {
        Cart::remove($rowid);
        $category = $this->category;
        Alert::success('', 'Keranjang Belanja Berhasil di perbaharui');
        return redirect('keranjang');
    }
}
