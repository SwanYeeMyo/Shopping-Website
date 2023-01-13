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
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                            <div class="card border-0 shadow p-1  h-100 w-100">
                                <div class="card-header border-0">
                                    <span class="d-block text-center">Iphone</span>
                                </div>
                                <div class="card-body border-0">
                                    <img src="{{ asset('user/maxresdefault (1).jpg') }}" class="img-fluid" alt="">
                                </div>

                                <div class="card-footer border-0 d-flex justify-content-center">
                                    <a href="{{ url('http://127.0.0.1:8000/product/filter/1') }}">
                                        <button class="btn btn-outline-dark">Check Product Here</button>
                                    </a>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                            <div class="card border-0 shadow p-1  h-100 w-100">
                                <div class="card-header border-0">
                                    <span class="d-block text-center">Apple Watches</span>
                                </div>
                                <div class="card-body border-0">
                                    <img src="{{ asset('user/maxresdefault (2).jpg') }}" class="img-fluid" alt="">
                                </div>

                                <div class="card-footer border-0 d-flex justify-content-center">
                                    <a href="{{ url('http://127.0.0.1:8000/product/filter/3') }}">
                                        <button class="btn btn-outline-dark">Check Product Here</button>
                                    </a>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                            <div class="card border-0 shadow p-1 h-100 w-100">
                                <div class="card-header border-0">
                                    <span class="d-block text-center">MacBooks</span>
                                </div>
                                <div class="card-body">
                                    <img src="{{ asset('user/maxresdefault.jpg') }}" class="img-fluid" alt="">
                                </div>

                                <div class="card-footer border-0 d-flex justify-content-center">
                                    <a href="{{ url('http://127.0.0.1:8000/product/filter/2') }}">
                                        <button class="btn btn-outline-dark">Check Product Here</button>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
