@extends('layouts.master')
@section('content')
    <div class="container">
        <ol class="breadcrumb mt-5">
            <li class="breadcrumb-item"><a class="text-dark" href="{{ route('user#home') }}">Home</a></li>
            <li class="breadcrumb-item"><a class="text-dark" href="{{ route('user#products') }}">products</a></li>
            <li class="breadcrumb-item"><a class="text-dark" href="{{ route('user#home') }}">cart</a></li>
            <li class="breadcrumb-item"><a class="" href="{{ route('user#history') }}">Pending Orders</a></li>
        </ol>
        <div class="row mt-lg-5 g-5">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        @if (session('success'))
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                <i class="mx-1 fa-solid fa-circle-check"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col">Order_id</th>
                                <th scope="col">Image</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Product Name</th>
                                <th>Total</th>
                                <th>Action</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @csrf
                            @foreach ($history as $h)
                                <tr>
                                    <td>{{ $h->order_id }}</td>
                                    <td><img src="{{ asset('storage/' . $h->image) }}" width="100" alt=""></td>
                                    <td>{{ $h->user_name }}</td>
                                    <td>{{ $h->product_name }}</td>
                                    <td>{{ $h->total_price }}</td>
                                    <td>
                                        @if ($h->status == 0)
                                            <h6 class="text-warning">Pending</h6>
                                        @elseif ($h->status == 1)
                                            <span class="text-success">Success</span>
                                        @elseif ($h->status == 2)
                                            <h6 class="text-danger">Rejected</h6>
                                        @endif
                                    </td>
                                    <td>{{ $h->created_at->format('d.m.Y') }}</td>

                                </tr>
                            @endforeach




                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!-- Modal -->
        {{-- Delete All model --}}
    @endsection
