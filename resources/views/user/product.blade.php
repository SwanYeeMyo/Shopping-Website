@extends('layouts.master')
@section('content')
    <div class="container-fluid my-5">
        <div class="row">
            <div class="col-12">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4  col-md-4 col-sm-12 col-12">
                            <div class="card">
                                <div class="card-header  d-flex justify-content-between">
                                    <div>Products Category</div>
                                    <div><span class="badge bg-primary rounded-pill">{{ count($categories) }}</span>
                                    </div>

                                </div>

                                <div class="card-body">
                                    @if (session('success'))
                                        <div class="alert alert-primary  alert-dismissible fade show" role="alert">
                                            <i class="mx-1 fa-solid fa-cart-plus"></i> {{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif



                                    <ul class="list-group my-2">
                                        @if (url()->current() != 'http://127.0.0.1:8000/user/products')
                                            <a href="{{ route('user#products') }}" class="text-light">
                                                <li class="list-group-item my-1">
                                                    <label class="form-check-label" for="secondCheckbox">All</label>
                                                </li>
                                            </a>
                                        @endif

                                        @foreach ($categories as $c)
                                            <a href="{{ route('user#filter', $c->category_id) }}" class="text-light">
                                                <li class="list-group-item my-1">
                                                    <label class="form-check-label"
                                                        for="secondCheckbox">{{ $c->name }}</label>
                                                </li>
                                            </a>
                                        @endforeach

                                        <li class="list-group-item my-1">
                                            @if (Auth::user())
                                                <a href="{{ route('user#cart') }}">
                                                    <button type="button" class="btn btn-primary position-relative">
                                                        <i class="fa-solid fa-cart-shopping"></i>
                                                        <span
                                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                            {{ count($carts) }}
                                                            <span class="visually-hidden">unread messages</span>
                                                        </span>
                                                    </button>
                                                </a>
                                            @else
                                                <button onclick="myFunction()" type="button"
                                                    class="btn btn-primary position-relative">
                                                    <i class="fa-solid fa-cart-shopping"></i>
                                                    <span
                                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                        0
                                                        <span class="visually-hidden">unread messages</span>
                                                    </span>
                                                </button>
                                            @endif
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12 col-12">
                            <div class="row g-2">
                                <div class="col-lg-5 col-sm-12">
                                    <form action="{{ route('user#products') }}">
                                        <div class="d-flex my-3">
                                            <input type="text" value="{{ request('Key') }}" name="Key"
                                                class="form-control" placeholder="Search">
                                            <button class="mx-2 btn btn-primary">
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </button>
                                        </div>


                                    </form>
                                </div>
                                <div class="col-lg-2 col-sm-12"></div>
                                <div class="col-lg-5 col-sm-12 ">{{ $products->links() }}</div>
                            </div>
                            <div class="row g-3 my-3  ">
                                @if (count($products) != 0)
                                    @foreach ($products as $p)
                                        <div class="col-lg-4 col-md-6 col-sm-6 col-12 ">
                                            <a href="{{ route('user#detail', $p->product_id) }}" class="text-dark">

                                                <div class="card w-100 h-100 cardHover border-0 shadow-sm">
                                                    <img src="{{ asset('storage/' . $p->image) }}" class="card-img-top"
                                                        alt="">
                                                    <div class="card-body text-center">
                                                        <span class="d-block">{{ $p->name }}</span>
                                                        <span class="d-block">{{ $p->price }}</span>
                                                        <span class="mx-2 text-primary">
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                        </span>
                                                    </div>

                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                @else
                                    <h5 class="text-center text-primary my-auto "><i
                                            class="fs-5 mx-2  fa-solid fa-magnifying-glass"></i>No Proudcts For this Items
                                        {{ request('Key') }}
                                    </h5>
                                @endif


                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function myFunction() {
            alert("Please Login To View the cart");
        }
    </script>
@endsection
