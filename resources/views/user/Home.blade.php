@extends('layouts.master')
@section('content')
    <div class="px-4 py-5 my-5 text-center">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <img class="d-block mx-auto mb-4 rounded img-fluid" src="{{ asset('user/m1_macs_banner.jpg') }}"
                    alt="">
            </div>
            <div class="col-lg-6 mx-auto my-auto">
                <p class="lead mb-4">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s
                    most
                    popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system,
                    extensive prebuilt components, and powerful JavaScript plugins.</p>
            </div>
        </div>
    </div>

    <div id="products" class="container-fluid py-16">
        <div class="container">

            <!-- Recently Added Products -->
            <div class="row mb-5">
                <div class="col-12">
                    <h2 class="text-center mb-4">Recently Added Products</h2>
                </div>

                @if ($recentlyAddedProducts->count() > 0)
                    @foreach ($recentlyAddedProducts as $product)
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                            <div class="card border-0 mh-100">


                                <div class="card-body d-flex justify-content-center align-items-center p-2"
                                    style="height: 220px;">
                                    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid"
                                        alt="{{ $product->name }}"
                                        style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                </div>
                                <div class="card-footer border-0 text-center py-2">
                                    <div class="card-header bg-light border-0 text-center py-2">
                                        <span class="d-block">{{ $product->name }}</span>
                                        <span>{{ $product->price }}</span>
                                    </div>
                                    <a href="{{ url('product/filter/' . $product->category_id) }}"
                                        class="btn btn-outline-primary btn-sm">
                                        Check Product Here
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Popular Products -->
            <div class="row mb-5">
                <div class="col-12">
                    <h2 class="text-center mb-4">Popular Products</h2>
                </div>

                @if ($popularProducts->count() > 0)
                    @foreach ($popularProducts as $product)
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-header bg-light border-0 text-center py-2">
                                    <strong>{{ $product->product_name }}</strong>
                                </div>
                                <div class="card-body d-flex justify-content-center align-items-center p-2"
                                    style="height: 220px;">
                                    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid"
                                        alt="{{ $product->product_name }}"
                                        style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                </div>
                                <div class="card-footer border-0 text-center py-2">
                                    <a href="{{ url('product/details/' . $product->product_id) }}"
                                        class="btn btn-outline-dark btn-sm">
                                        Check Product Here
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

        </div>
    </div>


@endsection
