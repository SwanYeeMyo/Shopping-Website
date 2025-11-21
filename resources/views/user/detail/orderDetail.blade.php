@extends('layouts.master')

@section('content')
    <div class="container mt-5">

        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('user#home') }}" class="text-dark">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user#history') }}" class="text-dark">Pending Orders</a></li>
            <li class="breadcrumb-item active">Order Detail</li>
        </ol>

        <div class="card shadow p-4">
            <h4 class="mb-3">Order Detail (Order #{{ $order->id }})</h4>

            <p>
                <strong>User:</strong> {{ $order->user->name }} <br>
                <strong>Status:</strong>
                @if ($order->status == 0)
                    <span class="text-warning">Pending</span>
                @elseif ($order->status == 1)
                    <span class="text-success">Success</span>
                @elseif ($order->status == 2)
                    <span class="text-danger">Rejected</span>
                @endif
                <br>
                <strong>Total Price:</strong> {{ number_format($order->total_price) }} Kyats <br>
                <strong>Date:</strong> {{ $order->created_at->format('d M Y') }}
            </p>

            <hr>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderItems as $item)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $item->product->image) }}" width="80">
                                </td>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->product->price) }}</td>
                                <td>{{ number_format($item->product->price * $item->quantity) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <a href="{{ route('user#history') }}" class="btn btn-secondary mt-3">Back</a>

        </div>
    </div>
@endsection
