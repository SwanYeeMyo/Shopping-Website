<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('admin.category.category', compact('category'));
    }
    public function create(Request $request)
    {
        $data = [
            'name' => $request->name,
        ];
        Validator::make($request->all(), [
            'name' => 'required',
        ])->validate();
        Category::create($data);
        return \redirect()->route('admin#category')->with(['success' => 'Create Success']);
    }
    public function Edit(Request $request)
    {
        $categories = Category::all();
        $category = Category::where('category_id', $request->category_id)->first();
        return view('admin.category.categoryUpdate', compact('category', 'categories'));
    }
    public function update(Request $request)
    {
        $id = $request->id;
        $data = [
            'name' => $request->name,
        ];
        Category::where('category_id', $id)->update($data);
        return redirect()->route('admin#category')->with(['success' => 'Update success']);

    }
    public function delete(Request $request)
    {
        $id = $request->category_id;
        Category::where('category_id', $id)->delete($id);
        return redirect()->route('admin#category')->with(['success' => 'delete success']);
    }
}
