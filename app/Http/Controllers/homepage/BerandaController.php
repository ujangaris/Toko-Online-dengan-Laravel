<?php

namespace App\Http\Controllers\homepage;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\User;

class BerandaController extends Controller
{
    protected $category;
    public function __construct()
    {
        $this->category = Category::where('parent_id', null)->get();//parent_id tidak null maka diambildatanya
    }

    public function index()
    {
        $category = $this->category;
        $title = "Toko Online";
        $products = Product::take(8)->orderBy('id', 'DESC')->get();
        return view('homepage.homepage', compact('title', 'products', 'category'));
    }

    public function product()
    {

        $category = $this->category;
        $title = "All Product";
        $products = Product::orderBy('id', 'DESC')->paginate(4);
        return view('homepage.product', compact('title', 'products', 'category'));
    }

    public function productbycategory($slug)
    {
        $categorys = Category::where('slug', $slug)->first();
        $id       = $categorys->id;
        $category = $this->category;
        $title = "Product Category";
        $name       = $categorys->name;
        $products = Product::orderBy('id', 'DESC')->where('category_id', $id)->get();
        return view('homepage.productbycategory', compact('title', 'products', 'category', 'name'));
    }

    public function detail($slug)
    {
        $products = Product::where('slug', $slug)->first();
        $category = $this->category;
        return view('homepage.detail', compact('products', 'category'));

    }

    public function supplier()
    {
        $category = $this->category;
        $users = User::orderBy('id', 'DESC')->where('status', 1)->where('role', '!=', 'member')->get();

        return view('homepage.supplier',compact('category', 'users'));
    }
}
