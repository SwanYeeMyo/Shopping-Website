<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::select('products.*')->paginate(6);
        $categories = Category::all();
        //dd($images->toArray());
        $products->appends(request()->all());

        return view('user.Home', compact('products', 'categories'));
    }
}
