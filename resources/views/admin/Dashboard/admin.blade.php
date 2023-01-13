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
                <form action="{{ route('admin#update') }}" method="POST" enctype="multipart/form-data">
                    <div class="mb-2">
                        <input type="file" class="form-control" name="image">
                    </div>
                    @csrf
                    <div class="white-box">
                        <div class="user-bg"> <img width="100%" alt="user"
                                src="{{ asset('storage/' . Auth::user()->image) }}">
                            <div class="overlay-box">
                                <div class="user-content">
                                    <a href="javascript:void(0)"><img src="{{ asset('storage/' . Auth::user()->image) }}"
                                            class="thumb-lg img-circle" alt="img"></a>
                                    <h4 class="text-white mt-2">{{ Auth::user()->name }}</h4>
                                    <h5 class="text-white mt-2">{{ Auth::user()->email }}</h5>

                                </div>
                            </div>

                        </div>
                    </div>
                    <button type="button" class="btn btn-dark text-light mb-3" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">
                        Change Password
                    </button>

            </div>

            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-8 col-xlg-7 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal form-material">
                            <div class="form-group mb-4">
                                <label class="col-md-12 p-0">Full Name</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" name="name" value="{{ Auth::user()->name }}"
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
                                <label for="example-email" class="col-md-12 p-0">Email</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="email" value="{{ Auth::user()->email }}"
                                        placeholder="johnathan@admin.com"
                                        class="@error('email')
                                        is-invalid
                                        @enderror form-control p-0 border-0"
                                        name="email" id="example-email">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group mb-4">
                                <label for="example-email" class="col-md-12 p-0">Phone</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="text" value="{{ Auth::user()->phone }}" placeholder=""
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
                                <label for="example-email" class="col-md-12 p-0">Address</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <textarea name="address" id=""
                                        class="@error('address')
                                    is-invalid
                                    @enderror form-control"
                                        cols="30" rows="10">
                                        {{ Auth::user()->address }}
                                    </textarea>
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>


                            </div>
                            <div class="form-group mb-4">
                                <label for="example-email" class="col-md-12 p-0">Role</label>
                                <div class="col-md-12 border-bottom p-0">
                                    <input type="email" disabled value="{{ Auth::user()->role }}"
                                        placeholder="johnathan@admin.com"
                                        class="@error('role')
                                        is-invalid
                                        @enderror form-control p-0 border-0"
                                        name="role" id="example-role">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group mb-4">

                                <div class="col-sm-12">
                                    <button class="btn btn-primary">Update Profile</button>
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


        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Password Change</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin#chgPassword') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Old Password</label>
                                    <input type="password" value="{{ old('oldPassword') }}"
                                        class="@error('oldPassword')
                                    is-invalid
                                @enderror form-control"
                                        name="oldPassword">
                                    @error('oldPassword')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">News Password</label>
                                    <input type="password" value="{{ old('newPassword') }}"
                                        class="@error('newPassword')
                                    is-invalid
                                @enderror form-control"
                                        name="newPassword">
                                    @error('newPassword')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Confirm Password</label>
                                    <input type="password"
                                        class="@error('confirmPassword')
                                    is-invalid
                                @enderror() form-control"
                                        name="confirmPassword">
                                    @error('confirmPassword')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
