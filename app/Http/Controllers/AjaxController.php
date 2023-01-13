<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\Order;
use App\Models\orderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function order(Request $request)
    {
        $total = 0;
        foreach ($request->all() as $item) {
            $data = orderList::create([
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'total' => $item['total'],
                'order_code' => $item['order_code'],
            ]);
            $total += $data->total;
        }
        logger($data);
        Order::create([
            'order_id' => $data->id,
            'user_id' => Auth::user()->id,
            'product_id' => $data->product_id,
            'total_price' => $total + 3000,
        ]);
        cart::where('user_id', Auth::user()->id)->delete();
        return \response()->json([
            'status' => 'true',
            'message' => 'order completed',
        ], 200);

    }
}
