@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <!-- Row -->
        <div class="row">
            <div class="row">
                <div class="col-xlg-4 col-lg-4 co-md-12">

                </div>
                <div class="col-xlg-4 col-lg-4 co-md-12">

                </div>
                <div class="col-xlg-4 col-lg-4 co-md-12">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('fail'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('fail') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </div>
            <!-- Column -->
            <div class="col-lg-4 col-xlg-5 col-md-12">
                <form action="{{ route('admin#userUpdate', $user->id) }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" value="{{ $user->id }}" name="p_id">
                    <div class="mb-2">
                        <input type="file"
                            class="form-control @error('image')
                        is-invalid
                        @enderror"
                            name="image">
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    @csrf
                    <div class="white-box">
                        <div class="">
                            <img class="img-fluid" src="{{ asset('storage/' . $user->image) }}">
                        </div>
                    </div>
                    <a href="{{ route('admin#product') }}">
                        <button type="button" class="btn btn-dark text-light mb-3">Back</button>
                    </a>

            </div>

            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-8 col-xlg-7 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal form-material">
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Name</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" name="name" value="{{ $user->name }}"
                                        placeholder="Johnathan Doe"
                                        class="@error('name')
                                        is-invalid
                                        @enderror form-control p-0 border-0">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group mb-4">
                                <label for="example-email" class="col-md-12 ">email</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" name="email"
                                        class="@error('email')
                                    is-invalid
                                @enderror  form-control p-0 border-0"
                                        value={{ $user->email }}>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="example-email" class="col-md-12 p-0">Address</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" value="{{ $user->address }}" placeholder=""
                                        class="@error('address')
                                    is-invalid
                                        @enderror form-control p-0 border-0"
                                        name="address" id="example-email">
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="example-email" class="col-md-12 p-0">Phone</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" value="{{ $user->phone }}" placeholder=""
                                        class="@error('phone')
                                    is-invalid
                                        @enderror form-control p-0 border-0"
                                        name="phone" id="example-email">
                                    @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="role" class="col-md-12 p-0">Role</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <select name="role" id="role"
                                        class="form-control p-0 border-0 @error('role') is-invalid @enderror">
                                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin
                                        </option>
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group mb-4">

                                <div class="col-sm-12">
                                    <button class="btn btn-success text-light">Update </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </form>
            <!-- Column -->
        </div>
        <!-- Row -->
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
        <!-- password-section -->




    </div>
@endsection
