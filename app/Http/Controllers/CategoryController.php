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
}
