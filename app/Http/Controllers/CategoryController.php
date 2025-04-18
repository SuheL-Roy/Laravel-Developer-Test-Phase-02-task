<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function create_category()
    {
        $category = Category::orderBy('id', 'DESC')->get();
        return view('Category.category_list',compact('category'));
    }
    public function store_category(Request $request)
    {
        $data = new Category();
        $data->category_name = $request->name;
        $data->save();
        return back()->with('success', 'Successfully Created');
    }

    public function destroy_category(Request $request)
    {
        $category = Category::find($request->id);
        if ($category) {
            $category->delete();
            return back()->with('danger', 'Successfully Deleted');
        }
    }
}
