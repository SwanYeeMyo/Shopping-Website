<?php

namespace App\Http\Controllers;

use App\Models\orderList;

class OrderListController extends Controller
{
    public function index()
    {
        $orders = orderList::when(request('Key'), function ($query) {
            $searchKey = request('Key');
            $query->where('order_code', 'like', '%' . $searchKey . '%');
        })->paginate(5);
        $orders->appends(request()->all());

        return view('admin.orders.orders', compact('orders'));
    }
}
