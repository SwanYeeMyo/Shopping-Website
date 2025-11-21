<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\orderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function order(Request $request)
    {
        $total = 0;

        $order = Order::create([
            'user_id' => Auth::user()->id,
            'total_price' => 0,
            'status' => 0,
        ]);

        foreach ($request->all() as $item) {

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['qty'],
                'total' => $item['total'],
                'order_code' => $item['order_code'],
            ]);

            $total += $item['total'];
        }

        $order->update([
            'total_price' => $total + 3000,
        ]);

        cart::where('user_id', Auth::user()->id)->delete();
        return \response()->json([
            'status' => 'true',
            'message' => 'order completed',
        ], 200);
    }
}
