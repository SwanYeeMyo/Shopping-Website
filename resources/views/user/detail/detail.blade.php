@extends('layouts.master')
@section('content')
    <div class="container">
        <nav aria-label="breadcrumb " class="mt-5 p-lg-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user#home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Devices</a></li>
                <li class="breadcrumb-item"><a href="#">{{ $product->category_name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>

        </nav>

        <div class="row my-auto  g-3">
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="card border " style="overflow:hidden">
                    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid w-100 "
                        alt="{{ $product->name }}">
                </div>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <div class="card shadow-sm  border-0">
                    <div class="card-body ">
                        <h6>{{ $product->name }}</h6>
                        <h5 class="text-primary text-left"><b>{{ $product->price }}</b> Ks .</h5>
                        {{-- <button type="button" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="right"
                            data-bs-title="Apple 1 Year Limited Warranty was included.">
                            <span>
                                1 Year Warranty
                            </span>
                        </button> --}}
                        <div class="mt-4">
                            <p>{{ $product->description }}</p>
                        </div>
                        <div>

                            <form action="{{ route('user#cartCreate') }}" method="GET">
                                @csrf

                                <input type="hidden" name="product_id" class="form-control "
                                    value="{{ $product->product_id }}">
                                <div class="d-flex">
                                    <select class="form-select mx-1" name="qty" aria-label="Default select example">
                                        <option selected value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>

                                    </select>
                                    <div>
                                        <button type="submit" class="mx-2 btn btn-outline-primary"><i
                                                class="fa-solid fa-cart-plus"></i></button>
                                    </div>

                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card shadow border ">
                    <div class="card-header border-0 text-muted">
                        Delivery
                    </div>
                    <div class="card-body  ">
                        <p style="font-size: 12px">
                            Same Day Delivery ဝန်ဆောင်မှုအား (ရန်ကုန်နှင့်မန္တလေး)သာ ရရှိနိုင်ပါသည်။
                            အခြားမြို့များအတွက် မှာယူသည့်နေ့တွင် သက်ဆိုင်ရာ Delivery Service အပ်ပေးပါသည်။
                        </p>
                        <span class="text-muted"> Return</span>
                        <p style="font-size: 12px" class="my-1">
                            ၇ရက်အတွင်းဖြစ်ပေါ်သော မူလချို့ယွင်းမှုများ အတွက် 24နာရီ အတွင်း အာမခံအပြည့်ပါသော ပစ္စည်းများဖြင့်
                            အစားထိုးပေးပါသည်။
                        </p>
                        <span class="text-muted"> We Accept</span>
                        <p style="font-size: 12px" class="my-1">
                            <img src="{{ asset('user/isure_sidebar_payment-copy.webp') }}" class="img-fluid"
                                alt="">
                        </p>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-outline-primary w-100">Call Us 09950314865</button>
                        <span class="text-center d-block my-2" style="font-size: 10px">
                            Operating Hour 9:00am to 8:00pm
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5 g-3">
            <div class="col-12">
                <h5>Similar Items</h5>
            </div>

            @foreach ($randomNumber as $rN)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card h-100 border-none shadow-sm">
                        <!-- Image -->
                        <a href="{{ route('user#detail', $rN->product_id) }}" class="d-block">
                            <div class="card-img-top d-flex justify-content-center align-items-center"
                                style="height: 180px; overflow: hidden;">
                                <img src="{{ asset('storage/' . $rN->image) }}" class="img-fluid"
                                    alt="{{ $rN->name }}"
                                    style="object-fit: contain; max-width: 100%; max-height: 100%;">
                            </div>
                        </a>

                        <!-- Card Body -->
                        <div class="card-body text-center py-2 d-flex flex-column justify-content-between">
                            <h6 class="mb-1">{{ $rN->name }}</h6>
                            <p class="mb-2 text-primary">{{ $rN->price }}</p>
                            <div class="text-warning">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
@endsection
