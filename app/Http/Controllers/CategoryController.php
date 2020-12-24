<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
// use Alert;
use RealRashid\SweetAlert\Facades\Alert;

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
        Alert::success('Success Message', 'Category Berhasi ditambahkan!');

        return redirect('admin/category');
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
        Alert::success('Success Message', 'Category Berhasi diperbaharui!');

        return redirect()->route('category.index');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        Alert::success('Success Message', 'Category Berhasi dihapus!');
        return redirect()->route('category.index');
    }
}
