@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid">

        <h3 class="mb-4">Order Detail (Order #{{ $order->id }})</h3>

        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">

                <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show " role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close mx-auto" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="white-box">

                    {{-- Order Summary --}}
                    <div class="mb-4 p-3 border rounded bg-light">
                        <h4 class="mb-3">Order Information</h4>
                        <p><strong>User:</strong> {{ $order->user->name }}</p>
                        <p><strong>Total Price:</strong> {{ number_format($order->total_price) }} kyats</p>

                        <p><strong>Status:</strong>
                            @if ($order->status == 0)
                                <span class="text-warning">Pending</span>
                            @elseif ($order->status == 1)
                                <span class="text-success">Success</span>
                            @elseif ($order->status == 2)
                                <span class="text-danger">Rejected</span>
                            @endif
                        </p>
                    </div>

                    {{-- Order Items Table --}}
                    <h4 class="mb-3">Order Items</h4>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class=" text-light">
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($order->orderItems as $item)
                                    @php
                                        $toppingTotal = $item->toppings->sum(fn($t) => $t->topping->price);
                                        $subtotal = ($item->product->price + $toppingTotal) * $item->quantity;
                                    @endphp
                                    <tr>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ number_format($item->product->price) }} kyats</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>
                                            @if ($item->toppings->count() > 0)
                                                <ul class="mb-0">
                                                    @foreach ($item->toppings as $t)
                                                        <li>{{ $t->topping->name }} ({{ number_format($t->topping->price) }}
                                                            ks)</li>
                                                    @endforeach
                                                </ul>
                                                <small class="text-success">Topping total:
                                                    {{ number_format($toppingTotal) }} ks</small>
                                            @else
                                                <span>-</span>
                                            @endif
                                        </td>
                                        <td>{{ number_format($subtotal) }} kyats</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>


    <script></script>
@endsection
