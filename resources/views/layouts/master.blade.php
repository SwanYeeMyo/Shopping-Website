<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.css" rel="stylesheet" />
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.0/mdb.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif
        }

        .cardHover img {
            transform: scale(0.9);
        }

        .cardHover:hover {
            border: 1px solid black;
            transform: scale(1.1);
        }

        a {
            text-decoration: none
        }
    </style>
</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main>

    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>
<nav class="navbar navbar-expand-md navbar-light  shadow   ">
    <div class="container-fluid ">
        <a class="navbar-brand" href="#">M<b class="text-primary">Sure</b> </a>
        <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="mt-1 fa-solid fa-bars"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mx-auto ">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('user#home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user#products') }}">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user#history') }}">Pending Orders</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        More.
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#popular">Popular</a></li>
                        <li><a class="dropdown-item" href="#update">New Update</a></li>
                        <li><a class="dropdown-item" href="#recent">Recently Added</a></li>

                    </ul>
                </li>
            </ul>

            @if (Auth::user() && Auth::user()->role != 'admin')
                <ul class="navbar-nav">
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mx-1 fa-solid fa-user"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#popular">Setting</a></li>
                            <li data-bs-toggle="modal" data-bs-target="#exampleModal"><a class="dropdown-item"
                                    href="#recent"> Logout</a></li>

                        </ul>
                    </li>
                </ul>
                <div>


                </div>
            @else
                <div>
                    <a href="{{ route('login') }}">
                        <button class="btn btn-sm btn-outline-dark "><i
                                class="mx-1 fa-solid fa-right-to-bracket"></i>Login</button>
                    </a>
                    <a href="{{ route('register') }}">
                        <button class="btn btn-sm btn-outline-dark"><i
                                class="mx-1 fa-solid fa-user"></i>Register</button>
                    </a>
                </div>
            @endif

        </div>
    </div>
</nav>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-bottom-0 bg-danger">
                <h5 class="modal-title text-light">Confirm Logout Box</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mt-3">
                <p class="text-center">Are you sure do you want to logout?</p>
            </div>
            <div class="modal-footer ">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary  mx-0 mb-2">Logout</button>
                </form>
                <button type="button" class="btn  btn-light  mx-0" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



@yield('content')


<footer id="service">
    <div class="container mt-5 pt-5">
        <div class="row g-3">
            <div class="col-md-4">
                <h2>Quick Links</h2>
                <h5>Drinks</h5>
                <h5>Bundles</h5>
                <h5>Recipes</h5>
                <h5>About</h5>

            </div>
            <div class="col-md-4">
                <h2>Our mission</h2>
                <p>We offer sustainable access to delicious plant-base nutrition</p>
            </div>
            <div class="col-md-4">
                <button class="btn btn-outline-light text-light">DimiJuice</button>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-md-7">
                <form action="" class="d-flex  ">
                    <input type="text" class="form-control w-50">
                    <button class="btn btn-outline-light mx-4">SEND</button>
                </form>
            </div>
            <div class="col-md-5 float-right text-center my-3">
                <i class="fa-brands fa-facebook mx-3"></i>
                <i class="fa-brands fa-twitter mx-3"></i>
                <i class="fa-brands fa-instagram mx-3"></i>
                <i class="fa-brands fa-tiktok mx-3"></i>
                <i class="fa-brands fa-linkedin mx-3"></i>
            </div>
        </div>
        <hr>
        <p class="text-center">© 2022, theme-taste-demo Powered by Shopify</p>
    </div>
</footer>
@yield('scriptSource')

</html>
