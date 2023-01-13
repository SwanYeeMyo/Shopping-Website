<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    public function index()
    {
        return view('user.Home');
    }
    public function product()
    {
        $products = Product::select('products.*')->When(request('Key'), function ($query) {
            $searchKey = \request('Key');
            $query->where('name', 'like', '%' . $searchKey . '%');
        })->orderBy('product_id', 'desc')->paginate(6);
        $categories = Category::all();
        //dd($images->toArray());
        $products->appends(request()->all());
        if (Auth::user()) {
            $carts = cart::where('user_id', Auth::user()->id)->get();
            return view('user.product', compact('products', 'categories', 'carts'));

        }
        return view('user.product', compact('products', 'categories'));

    }
    public function filter($id)
    {
        $products = Product::where('category_id', $id)->paginate(6);
        $categories = Category::all();

        $products->appends(request()->all());
        if (Auth::user()) {
            $carts = cart::where('user_id', Auth::user()->id)->get();
            return view('user.product', compact('products', 'categories', 'carts'));

        } else {
            return view('user.product', compact('products', 'categories'));

        }

    }
    public function details(Request $request, $id)
    {
        $category_id = $request->category_id;
        $randomNumber = Product::inRandomOrder()->limit(4)->get();
        $product = Category::select('categories.*', 'categories.name as category_name', 'products.*')->leftJoin('products', 'categories.category_id', 'products.category_id')
            ->where('product_id', $id)->first();

        return view('user.detail.detail', compact('product', 'randomNumber'));
    }
    //cart
    public function cart()
    {
        $carts = cart::select('carts.*', 'products.name', 'products.image as product_image', 'products.price as product_price', 'users.name as user_name')
            ->leftJoin('products', 'carts.product_id', 'products.product_id')
            ->leftJoin('users', 'carts.user_id', 'users.id')->where('user_id', Auth::user()->id)->get();

        $totalPrice = 0;
        foreach ($carts as $cart) {
            $totalPrice += $cart->product_price * $cart->qty;
        }
        $total = $totalPrice;
        $Total = $totalPrice + 3000;
        //dd($total);
        //dd($carts->toArray());

        return view('user.detail.newCart', compact('carts', 'total', 'Total'));
    }
    public function createCart(Request $request)
    {

        $data = [
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id,
            'qty' => $request->qty,
            'color' => $request->color,
        ];
        cart::create($data);

        return \redirect()->route('user#products')->with(['success' => 'Added to Cart']);
    }
    public function deleteCart(Request $request)
    {
        $id = $request->cart_id;
        cart::where('cart_id', $id)->delete();
        return \redirect()->route('user#cart')->with(['success' => 'Delete Success']);
    }
    public function cartDeleteAll()
    {
        cart::truncate();
        return \redirect()->route('user#cart')->with(['success' => 'Delete Success']);

    }
    //order
    public function history(Request $request)
    {
        $history = Order::select('orders.*', 'users.name as user_name', 'products.name as product_name', 'products.image')
            ->join('products', 'orders.product_id', 'products.product_id')
            ->join('users', 'orders.user_id', 'users.id')->orderBy('order_id', 'desc')->where('user_id', Auth::user()->id)->get();
        // dd($history->toArray());
        return view('user.detail.history', \compact('history'));
    }

}
