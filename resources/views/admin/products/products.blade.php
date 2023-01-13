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
                        <form action="{{ route('admin#product') }}">
                            <div class="d-flex mb-3">
                                <input type="text" value="{{ request('Key') }}" name="Key" class="form-control">
                                <button class="btn btn-outline-primary mx-2"><i
                                        class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                        <div class="col-md-3 col-sm-4 col-xs-6">
                            <button type="button " class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#ModalEdit" data-bs-whatever=""><i
                                    class="mx-1 fa-solid fa-plus"></i>Create</button>

                        </div>
                    </div>
                    @if (count($products) != 0)
                        <div class="table-responsive">
                            <table id="datatable" class="table no-wrap">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">ID</th>
                                        <th class="border-top-0">Name</th>
                                        <th class="border-top-0">Category</th>
                                        <th class="border-top-0">Description</th>
                                        <th class="border-top-0">Image</th>
                                        <th class="border-top-0">Price</th>
                                        <th class="border-top-0">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($products as $p)
                                        <tr>
                                            <td>{{ $p->product_id }}</td>
                                            <td class="txt-oflo">{{ $p->name }}</td>
                                            <td class="txt-oflo">{{ $p->category_name }}</td>
                                            <td>{{ Str::words($p->description, 10, '...') }}</td>
                                            <td>
                                                <img src="{{ asset('storage/' . $p->image) }}" width="100px"
                                                    alt="">
                                            </td>
                                            <td><span class="text-dark">{{ $p->price }} kyats</span></td>
                                            <td>
                                                <a href="{{ route('product#edit', $p->product_id) }}">
                                                    <button class="btn btn-success text-light edit " data-bs-whatever=""><i
                                                            class=" fa-solid fa-pen-to-square"></i></button>
                                                </a>

                                                <button class="btn btn-danger  deleteProudctBtn"
                                                    title="{{ $p->name }}" value="{{ $p->product_id }}"><i
                                                        class="fa-solid fa-trash-can text-light"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <div class="text-center">
                                        <h5>No Data for <span class="text-danger">{{ request('Key') }}</span></h5>
                                        <a href="{{ route('admin#product') }}">
                                            <button class="btn btn-dark">
                                                <i class="fa fa-backward" aria-hidden="true"></i>
                                            </button>
                                        </a>
                                    </div>
                    @endif



                    </tbody>
                    </table>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- Model create -->
    <div class="modal fade p-2" id="ModalEdit" tabindex="-1" aria-labelledby="ModalEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h1 class="modal-title  fs-3" id="ModalEditLabel">Create Prouducts </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal form-material" action="{{ route('product#productCreate') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3 border-bottom p-0">
                            <label for="recipient-name" class="col-form-label">Name:</label>
                            <input type="text" value="{{ old('name') }}" name="name"
                                class="@error('name')
                            is-invalid
                            @enderror  form-control p-0 border-0 "
                                id="recipient-name">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class=" form-group mb-3 border-bottom p-0">
                            <label for="message-text" class="col-form-label">Description:</label>
                            <textarea name="description" value="{{ old('description') }}"
                                class="@error('description')
                            is-invalid
                            @enderror  form-control p-0 border-0 "
                                id="message-text"></textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class=" mb-3 ">
                            <label for="message-text" class="col-form-label">Image:</label>
                            <input name="image" type="file"
                                class="@error('image')
                                is-invalid
                            @enderror  form-control "
                                id="recipient-name">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class=" mb-3 ">
                            <label for="">Select Cateogry:</label>
                            <select
                                class="@error('category_id')
                                is-invalid
                            @enderror form-select form-select-sm "
                                name="category_id" aria-label=".form-select-sm example">
                                <option value=" " selected>Select Cateogry</option>
                                @foreach ($category as $c)
                                    <option value="{{ $c->category_id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3 border-bottom p-0">
                            <label for="message-text" class="col-form-label">Price:</label>
                            <input name="price" value="{{ old('price') }}" type="text"
                                class="@error('price')
                                is-invalid
                            @enderror form-control p-0 border-0"
                                id="recipient-name">
                            @error('price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary text-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Model create End -->

    <!-- Model Delete-->
    <div class="modal fade p-2" id="modelUpdate" tabindex="-1" aria-labelledby="ModalEditLabel" aria-hidden="true">
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
                        <h4 class="text-center">Are you sure do you want to Delete ? <span id="deleteName"></span></h4>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary text-light"
                            data-bs-dismiss="modal">Close</button>
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
                $('#modelUpdate').modal('show');
            })
        });
    </script>

@endsection
