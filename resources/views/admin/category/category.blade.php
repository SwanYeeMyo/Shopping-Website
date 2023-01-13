@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-lg-4 col-sm-12">
                <div class="card">
                    <div class="my-2 p-2">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                    <div class="card-header">
                        Create Category
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin#createCategory') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name">Category Name</label>
                                <input type="text" value="{{ old('name') }}" name="name"
                                    class="@error('name')
                                is-invalid
                                @enderror form-control">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-8 col-sm-12">
                <div class="white-box">
                    <div class="table-responsive">
                        <table class="table no-wrap">
                            <thead>
                                <tr>
                                    <th class="border-top-0">ID</th>
                                    <th class="border-top-0">Category Name</th>
                                    <th class="border-top-0">Create Date</th>
                                    <th class="border-top-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $c)
                                    <tr>
                                        <td>{{ $c->category_id }}</td>
                                        <td>{{ $c->name }}</td>
                                        <td>{{ $c->created_at->format('j-F-Y') }}</td>
                                        <td class="d-flex">
                                            <form action="{{ route('admin#editCategory') }}" method="POST" class="mx-2">
                                                <input type="hidden" name="category_id" value="{{ $c->category_id }}">
                                                @csrf
                                                <button class="btn btn-primary text-light"><i
                                                        class="fa-solid fa-pen-to-square"></i></button>
                                            </form>
                                            <button class="btn btn-danger text-light deleteBtn" data-bs-toggle="modal"
                                                data-bs-target="#deleteBtn" title="{{ $c->name }}"
                                                value="{{ $c->category_id }}"><i class="fa-solid fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach







                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteBtn" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <form action="{{ route('admin#deleteCategory') }}" method="POST">
                @csrf
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" class="form-control" name="category_id" id="category_id">
                            <h5>Are you sure do you want to delete <span class="deleteText"></span> category ?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Delete</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.deleteBtn').click(function() {
                var proudctId = $(this).val();
                var title = $(this).attr('title');
                $('.deleteText').text(title);
                $('#category_id').val(proudctId);
            });
        });
    </script>
@endsection
