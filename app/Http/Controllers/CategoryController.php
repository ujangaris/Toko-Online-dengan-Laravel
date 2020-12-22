<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categorys = Category::where('parent_id', null)->get();
        return view('admin.category.index', compact('categorys'));;
    }
    public function store(Request $request)
    {
       $category = new Category;
       $category->slug = $request->slug;
       $category->name = $request->name;
       $category->icon = $request->icon;
       $category->parent_id = $request->parent_id;
       $category->save();
       return redirect()->back();
    }
}
