<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $category = Category::all();
        $products = Product::select('products.*', 'categories.name as category_name')->LeftJoin('categories', 'categories.category_id', 'products.category_id')->When(request('Key'), function ($query) {
            $searchKey = \request('Key');
            $query->where('products.name', 'like', '%' . $searchKey . '%')
                ->orWhere('categories.name', 'like', '%' . $searchKey . '%');
        })->paginate(5);

        $products->appends(request()->all());

        return view('admin.products.products', \compact('products', 'category'));
    }
    //create Data
    public function create(Request $request)
    {
        $this->getValidationData($request);
        $data = $this->getRequestData($request);
        if ($request->hasFile('image')) {
            $fileName = \uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }
        Product::create($data);
        return \redirect()->route('admin#product')->with(['success' => 'Create Success']);

    }
    //edit
    public function edit(Request $request, $id)
    {
        $category = Category::all();
        $product = Product::where('product_id', $id)->first();
        //$product = Product::select('products.*', 'categories.name as category_name')->join('categories', 'products.category_id', 'categories.category_id')->where('product_id', $id)->first();
        //dd($product->toArray());
        return view('admin.products.productsEdit', compact('product', 'category'));
    }
    public function update(Request $request)
    {
        $this->getValidationUpdateData($request);
        $data = $this->getRequestData($request);
        $id = $request->p_id;
        if ($request->hasFile('image')) {
            $dbImage = Product::select('image')->where('product_id', $id)->first();
            $dbImage = $dbImage->image;
            if ($dbImage != null) {
                Storage::delete('public/' . $dbImage);
            }
            $fileName = \uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }
        Product::where('product_id', $id)->update($data);
        return \redirect()->route('admin#product')->with(['success' => ' Product Update Success']);

    }
    //delete
    public function delete(Request $request)
    {
        $id = $request->id;
        $dbImage = Product::select('image')->where('product_id', $id)->first();
        $dbImage = $dbImage->image;
        Storage::delete('public/' . $dbImage);
        Product::where('product_id', $id)->delete($id);
        return redirect()->route('admin#product')->with(['success' => 'Delete Successfully']);
    }
    private function getRequestData($request)
    {
        return [
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price' => $request->price,
        ];
    }
    private function getValidationData($request)
    {
        $validationRule = [
            'name' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required',
        ];
        Validator::make($request->all(), $validationRule)->validate();
    }
    private function getValidationUpdateData($request)
    {
        $validationRule = [
            'name' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'price' => 'required',
        ];
        Validator::make($request->all(), $validationRule)->validate();
    }
}
