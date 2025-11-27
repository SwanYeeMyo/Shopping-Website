<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\CartTopping;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemToppings;
use App\Models\orderList;
use App\Models\Topping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function order(Request $request)
    {
        $total = 0;

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => 0,
            'status' => 0,
        ]);

        foreach ($request->toArray() as $item) {

            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['qty'],
                'total' => $item['total'],
                'order_code' => $item['order_code'],
            ]);

            if (!empty($item['toppings'])) {
                foreach ($item['toppings'] as $tp) {
                    $topping = Topping::find($tp['topping_id']);
                    OrderItemToppings::create([
                        'order_item_id' => $orderItem->id,
                        'topping_id' => $tp['topping_id'],
                        'price' => $topping->price,
                    ]);
                }
            }

            $total += $item['total'];
        }

        $order->update([
            'total_price' => $total + 3000,
        ]);

        $carts = Cart::select('cart_id', 'user_id')->get();

        foreach ($carts as $cart) {
            $cart->where('user_id', Auth::user()->id)->delete();
            CartTopping::where('cart_id', $cart->cart_id)->delete();
        }

        return response()->json([
            'status' => 'true',
            'message' => 'order completed',
        ], 200);
    }
}
