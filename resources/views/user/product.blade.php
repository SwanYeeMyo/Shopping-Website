@extends('layouts.master')
@section('content')
    <div class="container-fluid my-5">
        <div class="container">
            <div class="row">

                <!-- Category Sidebar -->
                <div class="col-lg-4 col-md-4 col-sm-12 col-12 mb-3">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between">
                            <div>Products Category</div>
                            <div><span class="badge btn-primary rounded-pill">{{ count($categories) }}</span></div>
                        </div>

                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    <i class="mx-1 fa-solid fa-cart-plus"></i> {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <ul class="list-group my-2">
                                @if (url()->current() != route('user#products'))
                                    <a href="{{ route('user#products') }}" class="text-light">
                                        <li class="list-group-item my-1">All</li>
                                    </a>
                                @endif

                                @foreach ($categories as $c)
                                    <a href="{{ route('user#filter', $c->category_id) }}" class="text-light">
                                        <li class="list-group-item my-1">{{ $c->name }}</li>
                                    </a>
                                @endforeach

                                <li class="list-group-item my-1">
                                    @if (Auth::user())
                                        <a href="{{ route('user#cart') }}">
                                            <button type="button" class="btn btn-primary position-relative w-100">
                                                <i class="fa-solid fa-cart-shopping"></i>
                                                <span
                                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                    {{ count($carts) }}
                                                </span>
                                            </button>
                                        </a>
                                    @else
                                        <button onclick="myFunction()" type="button"
                                            class="btn btn-primary position-relative w-100">
                                            <i class="fa-solid fa-cart-shopping"></i>
                                            <span
                                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                0
                                            </span>
                                        </button>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Products Section -->
                <div class="col-lg-8 col-md-8 col-sm-12 col-12">

                    <!-- Search & Pagination -->
                    <div class="row g-2 mb-3 align-items-center">
                        <div class="col-lg-5 col-sm-12">
                            <form action="{{ route('user#products') }}">
                                <div class="d-flex">
                                    <input type="text" value="{{ request('Key') }}" name="Key" class="form-control"
                                        placeholder="Search">
                                    <button class="mx-2 btn btn-primary">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-2 col-sm-12"></div>
                        <div class="col-lg-5 col-sm-12 text-end">{{ $products->links() }}</div>
                    </div>

                    <!-- Product Cards -->
                    <div class="row g-3">
                        @if (count($products) != 0)
                            @foreach ($products as $p)
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                                    <a href="{{ route('user#detail', $p->product_id) }}"
                                        class="text-dark text-decoration-none">
                                        <div class="card h-100 border-0 shadow-sm cardHover">
                                            <div class="card-img-top d-flex justify-content-center align-items-center"
                                                style="height: 200px; overflow: hidden;">
                                                <img src="{{ asset('storage/' . $p->image) }}" class="img-fluid"
                                                    alt="{{ $p->name }}"
                                                    style="object-fit: contain; max-height: 100%; max-width: 100%;">
                                            </div>
                                            <div class="card-body text-center py-2">
                                                <h6 class="mb-1">{{ $p->name }}</h6>
                                                <p class="mb-1 text-primary">{{ $p->price }}</p>
                                                <div class="text-warning">
                                                    @php

                                                        $avgRating = $p->ratings->avg('rating') ?? 0;
                                                        $fullStars = floor($avgRating);
                                                        $halfStar = $avgRating - $fullStars >= 0.5 ? true : false;
                                                        $emptyStars = 5 - ceil($avgRating);
                                                    @endphp


                                                    @for ($i = 0; $i < $fullStars; $i++)
                                                        <i class="fa-solid fa-star"></i>
                                                    @endfor


                                                    @if ($halfStar)
                                                        <i class="fa-solid fa-star-half-stroke"></i>
                                                    @endif


                                                    @for ($i = 0; $i < $emptyStars; $i++)
                                                        <i class="fa-regular fa-star"></i>
                                                    @endfor
                                                </div>

                                                <small class="text-muted">
                                                    {{ number_format($avgRating, 1) }} / 5 ({{ $p->ratings->count() }}
                                                    reviews)
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <h5 class="text-center text-secondary my-5">
                                <i class="fs-5 mx-2 fa-solid fa-magnifying-glass"></i>No Products Found

                            </h5>
                        @endif
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
