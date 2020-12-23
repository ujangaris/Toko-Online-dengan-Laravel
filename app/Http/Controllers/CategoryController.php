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

    public function edit(Request $request,$id)
    {
        $category = Category::find($id);
        $categorys = Category::where('parent_id', null)->get();

        return view('admin.category.edit', compact('category', 'categorys'));
    }
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->slug = $request->slug;
        $category->name = $request->name;
        $category->icon = $request->icon;
        $category->parent_id = $request->parent_id;
        $category->save();
        return redirect()->route('category.index');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('category.index');
    }
}
