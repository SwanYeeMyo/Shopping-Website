@extends('layouts.master')
@section('content')
    <div class="container">
        <ol class="breadcrumb mt-5">
            <li class="breadcrumb-item"><a class="text-dark" href="{{ route('user#home') }}">Home</a></li>
            <li class="breadcrumb-item"><a class="text-dark" href="{{ route('user#products') }}">products</a></li>
            <li class="breadcrumb-item"><a class="text-dark" href="{{ route('user#cart') }}">cart</a></li>

        </ol>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                @if (session('success'))
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <i class="mx-1 fa-solid fa-circle-check"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

            </div>
        </div>
        <div class="row px-xl-5 my-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Product Image</th>
                            <th>name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($carts as $cart)
                            <tr>
                                {{-- <input type="hidden" id="pizzaPrice" value="{{ $cart->pizza_price }}" > --}}
                                <input type="hidden" class="orderId" value="{{ $cart->id }}">
                                <input type="hidden" class="productId" value="{{ $cart->product_id }}">
                                <input type="hidden" class="userId" value="{{ $cart->user_id }}">
                                <td class="align-middle">
                                    <img src="{{ asset('storage/' . $cart->product_image) }}" style="width: 100px"
                                        alt="">
                                </td>
                                <td class="align-middle"><img src="" alt="" style="width: 50px;">
                                    {{ $cart->name }}</td>
                                <td class="align-middle" id="pizzaPrice">{{ $cart->product_price }} kyats</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">


                                        <input type="text" disabled
                                            class="form-control form-control-sm  border-0 text-center" id="qty"
                                            value="{{ $cart->qty }}">

                                    </div>
                                </td>
                                <td class="align-middle" id="total">{{ $cart->qty * $cart->product_price }}kyats
                                </td>
                                <td>
                                    <button type="button"class="deleteBtn  btn btn-link btn-sm px-3"
                                        value="{{ $cart->cart_id }}" title="{{ $cart->name }}" data-ripple-color="dark">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
                @if (count($carts) != 0)
                    <div class="float-end">
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAllModel">Clear
                            All</button>
                    </div>
                @endif
            </div>
            <div class="modal fade  " id="deleteModel" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
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
            <div class="col-lg-4">
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
                            <button type="button" @if (count($carts) == 0) disabled @endif
                                class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="orderBtn">Proceed
                                To
                                Checkout</button>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade  " id="deleteAllModel" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
@endsection
@section('scriptSource')
    <script src=" {{ asset('js/cart.js') }}"></script>
    <script>
        $('.deleteBtn').click(function() {
            var productId = $(this).val();
            var title = $(this).attr('title');
            $('#deleteName').text(title);
            $('#cart_id').val(productId);
            $('#deleteModel').modal('show');
        });
        $('#orderBtn').click(function() {

            // $parentNode = $(this).parents("tr");
            // $price = $parentNode.find('#pizzaPrice').text().replace("kyats", "");
            // $qty = Number($parentNode.find('#qty').val());
            // $total = $price * $qty;
            // console.log($total);
            // $parentNode.find('#total').html($total + " kyats")
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
            $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/ajax/order',
                data: Object.assign({}, $orderList),
                dataType: 'json',
                success: function(response) {
                    if (response.status == 'true') {
                        window.location.href = 'http://127.0.0.1:8000/history';
                    }
                }
            })
            // $('#subTotal').html(`${$totalPrice} kyats`);
            // $('#finalPrice').html(`${$totalPrice+3000} kyats`);

        })
    </script>
    <!-- Modal -->
    {{-- Delete All model --}}
@endsection

<!-- Cart End -->


<!-- Footer Start -->

<!-- Footer End -->


<!-- Back to Top -->
