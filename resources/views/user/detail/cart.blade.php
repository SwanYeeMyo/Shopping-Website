@extends('layouts.master')
@section('content')
    <div class="container">
        <ol class="breadcrumb mt-5">
            <li class="breadcrumb-item"><a class="text-dark" href="{{ route('user#home') }}">Home</a></li>
            <li class="breadcrumb-item"><a class="text-dark" href="{{ route('user#products') }}">products</a></li>
            <li class="breadcrumb-item"><a class="text-dark" href="{{ route('user#home') }}">cart</a></li>

        </ol>
        <div class="row mt-lg-5 g-5">
            <div class="col-lg-9 col-md-6 col-sm-12 col-12">
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

                                <th scope="col">Product Name</th>
                                <th scope="col">Image</th>
                                <th scope="col">User Name</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @csrf

                            @foreach ($carts as $c)
                                <tr>

                                    <td>{{ $c->name }}</td>
                                    <td>
                                        <img width="100" src="{{ asset('storage/' . $c->product_image) }}"
                                            alt="">
                                    </td>
                                    <td>{{ $c->user_name }}</td>
                                    <td>
                                        {{ $c->qty }}
                                    </td>
                                    <td>{{ $c->product_price }} Kyats</td>
                                    <td>
                                        <button type="button"class="deleteBtn  btn btn-link btn-sm px-3"
                                            value="{{ $c->cart_id }}" title="{{ $c->name }}"
                                            data-ripple-color="dark">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach

                            @if (count($carts) != 0)
                                <tr>
                                    <td colspan="5"></td>
                                    <td>
                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteAllModel">Clear All</button>
                                    </td>
                                </tr>
                            @endif


                        </tbody>
                    </table>
                </div>

            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                <div class="card ">
                    <div class="card-header">
                        <h6>Check Out</h6>
                    </div>
                    <div class="card-body ">
                        <div class="d-flex justify-content-between">
                            <div>
                                Items {{ count($carts) }}
                            </div>
                            <div>
                                {{ $total }} kyats
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                DeliFees
                            </div>
                            <div>
                                3000 kyats
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div>
                                Total
                            </div>
                            <div>

                                {{ $Total }} Kyats
                            </div>
                        </div>
                        <div class="card-footer my-2">
                            <button id="clickBtn" class="btn btn-outline-primary btn-block "><i
                                    class="mx-1 fa-solid fa-plus"></i>Order
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade  " id="deleteModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-light">
                        <h4 class="modal-title " id="exampleModalLabel">Wait !!</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">

                        <h6> Do you Want To Delete ?</h6> <span id="deleteName"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form action="{{ route('user#cartDelete') }}" method="GET">
                            @csrf
                            <input type="hidden" id="cart_id" name="cart_id" value="">
                            <button type="submit" class="btn btn-primary">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Delete All model --}}
        <div class="modal fade  " id="deleteAllModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-light">
                        <h4 class="modal-title " id="exampleModalLabel">Wait !!</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <h6 class="mt-2"> Do you Want To Clear All ?</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form action="{{ route('user#cartDAll') }}" method="GET">
                            @csrf
                            <button type="submit" class="btn btn-primary">Yes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('.deleteBtn').click(function() {
                    var productId = $(this).val();
                    var title = $(this).attr('title');
                    $('#deleteName').text(title);
                    $('#cart_id').val(productId);
                    $('#deleteModel').modal('show');
                });
                $('#clickBtn').click(function() {
                    $orderList = [];
                    $random = Math.floor(Math.random() * 10001);
                    $('#dataTable tbody tr').each(function(index, row) {
                        $orderList.push({
                            'user_id': $(row).find('.userId').val(),
                            'product_id': $(row).find('.productId').val(),
                            'qty': $(row).find('#qty').val(),
                            'total': $(row).find('#total').text().replace('kyats', '') * 1,
                            'order_code': 'POS' + $random,
                        });

                    });
                    console.log($orderList);
                });

            });
        </script>
    @endsection
