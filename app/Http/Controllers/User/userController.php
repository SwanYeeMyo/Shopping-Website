<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\cart;
use App\Models\CartTopping;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\orderList;
use App\Models\Product;
use App\Models\Topping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    public function index()
    {
        // 3 Recently Added Products
        $recentlyAddedProducts = Product::orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        // 3 Most Popular Products (by number of times ordered)
        $popularProductIds = OrderItem::select('product_id')
            ->selectRaw('COUNT(*) as total_ordered')
            ->groupBy('product_id')
            ->orderByDesc('total_ordered')
            ->limit(3)
            ->pluck('product_id');

        $popularProducts = Product::whereIn('product_id', $popularProductIds)->get();

        return view('user.Home', compact('recentlyAddedProducts', 'popularProducts'));
    }
    public function product()
    {
        $products = Product::with('ratingsWithComment')->select('products.*')->When(request('Key'), function ($query) {
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
        $topping = Topping::get();

        $product = Product::with('category', 'ratings')->where('product_id', $id)->first();

        return view('user.detail.detail', compact('product', 'randomNumber', 'topping'));
    }

    public function cart()
    {

        $carts = Cart::with([
            'product',
            'toppings.topping'
        ])
            ->where('user_id', Auth::id())
            ->get();

        $totalPrice = 0;

        foreach ($carts as $cart) {

            $productTotal = $cart->product->price;


            $toppingTotal = $cart->toppings->sum(function ($t) {
                return $t->topping->price;
            });

            $totalPrice += ($productTotal + $toppingTotal) * $cart->qty;
        }

        $total = $totalPrice;
        $Total = $total + 3000;

        return view('user.detail.newCart', compact('carts', 'total', 'Total'));
    }


    public function createCart(Request $request)
    {

        foreach ($request->items as $item) {
            $cart = Cart::create([
                'user_id'    => Auth::id(),
                'product_id' => $item['product_id'],
                'qty'        => $item['qty'],
                'color'      => $item['color'] ?? null,
            ]);

            if (!empty($item['toppings'])) {
                foreach ($item['toppings'] as $toppingId) {
                    CartTopping::create([
                        'cart_id'    => $cart->id,
                        'topping_id' => $toppingId,
                        'price'      => Topping::find($toppingId)->price,
                    ]);
                }
            }
        }

        return redirect()
            ->route('user#products')
            ->with(['success' => 'Items added to cart successfully!']);
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

        $history = Order::with('orderItems')->where('user_id', Auth::user()->id)->get();

        return view('user.detail.history', \compact('history'));
    }
}
