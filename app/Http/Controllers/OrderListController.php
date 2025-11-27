<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderListController extends Controller
{
    public function index()
    {

        $orders = Order::with('user')->when(request('Key'), function ($query) {
            $searchKey = request('Key');
            $query->whereHas('user', function ($q) use ($searchKey) {
                $q->where('name', 'LIKE', '%' . $searchKey . '%');
            });
        })->paginate(5);

        $orders->appends(request()->all());

        return view('admin.orders.orders', compact('orders'));
    }


    public function detail($orderId)
    {
        $order = Order::with([
            'user',
            'orderItems.product',
            'orderItems.toppings.topping'
        ])->findOrFail($orderId);

        return view('admin.orders.detail', compact('order'));
    }


    public function changeStatus(Request $request)

    {
        $order = Order::find($request->id);

        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $order->status = $request->status;
        $order->save();

        return response()->json([
            'message' => 'Order status updated successfully',
            'new_status' => $order->status
        ]);
    }

    public function UserOrderDetail($id)
    {
        $order = Order::with([
            'orderItems.product',
            'orderItems.toppings.topping',
            'user'
        ])->find($id);

        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        return view('user.detail.orderDetail', compact('order'));
    }
}
