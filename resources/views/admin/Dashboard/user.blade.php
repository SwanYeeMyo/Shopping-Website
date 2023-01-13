@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid">


        <!-- ============================================================== -->
        <!-- RECENT SALES -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="row">

                    <div class="col-lg-4 col-md-3 col-sm-4 col-xs-6">

                    </div>
                    <div class="col-lg-4 col-md-3 col-sm-4 col-xs-6">

                    </div>
                    <div class="col-lg-4 col-md-3 col-sm-4 col-xs-6">
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
                    <div class="d-md-flex justify-content-between mb-3">
                        <form action="{{ route('admin#users') }}">
                            <div class="d-flex mb-3">
                                <input type="text" value="{{ request('Key') }}" name="Key" class="form-control">
                                <button class="btn btn-outline-primary mx-2"><i
                                        class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>

                    </div>

                    <div class="table-responsive">
                        <table id="datatable" class="table no-wrap">
                            <thead>
                                <tr>
                                    <th class="border-top-0">ID</th>
                                    <th class="border-top-0">user_id</th>
                                    <th class="border-top-0">product_id</th>
                                    <th class="border-top-0">qty</th>
                                    <th class="border-top-0">total</th>
                                    <th class="border-top-0">order_code</th>
                                    <th class="border-top-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($users as $u)
                                    <tr>
                                        <td>{{ $u->id }}</td>
                                        <td>{{ $u->name }}</td>
                                        <td>{{ $u->phone }}</td>
                                        <td>{{ $u->address }}</td>
                                        <td>{{ $u->role }}</td>
                                        <td>{{ $u->created_at->format('d.m.Y') }}</td>
                                        <td>
                                            <button class="btn btn-danger  deleteProudctBtn" title="{{ $u->name }}"
                                                value="{{ $u->id }}"><i
                                                    class="fa-solid fa-trash-can text-light"></i></button>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Model create -->

    <!-- Model create End -->

    <!-- Model Delete-->
    <div class="modal fade p-2" id="deleteUser" tabindex="-1" aria-labelledby="ModalEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <form action="{{ route('product#delete') }}" method="POST">
                    @csrf
                    <div class="modal-header text-center">
                        <h1 class="modal-title  fs-3" id="ModalEditLabel">Delete </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" class="form-control" value="" name="id" id="product_id">
                        <h4 class="text-center">Are you sure do you want to Delete <span id="deleteName"></span>?</h4>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary text-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger text-light">Delete</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
    <!-- Model Update End -->
    <script>
        //model pop up
        $(document).ready(function() {
            $('.deleteProudctBtn').click(function(e) {
                e.preventDefault();
                var product_id = $(this).val();
                var title = $(this).attr('title');
                $('#deleteName').text(title);
                $('#product_id').val(product_id);
                $('#deleteUser').modal('show');
            })
        });
    </script>
@endsection
