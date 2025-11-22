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

        .btn-primary {
            color: #fff;
            /* Text color */
            background: linear-gradient(135deg, #ff9a9e, #fad0c4, #fad0c4, #ffecd2);
            border: none;
            /* Remove default border or match gradient if needed */
            font-weight: bold;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
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
        <a class="navbar-brand floral-text " href="#">H<b class="floral-text ">anna Flower Shop</b> </a>
        <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><i class="mt-1 fa-solid fa-bars"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mx-auto floral-text  ">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('user#home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user#products') }}">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user#history') }}">Pending Orders</a>
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



<section>
    @yield('content')
</section>


<footer class="bg-pink-50 text-dark pt-5 pb-3">
    <div class="container">
        <div class="row">

            <!-- About / Brand -->
            <div class="col-md-4 mb-4">
                <h5 class="floral-text mb-3">Hanna Flower Shop</h5>
                <p class="small">
                    Bringing the beauty of fresh flowers to your home, office, and special events.
                    Handcrafted bouquets with love and care.
                </p>
            </div>

            <!-- Quick Links -->
            <div class="col-md-4 mb-4">
                <h5 class="floral-text mb-3">Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="#shop" class="text-dark text-decoration-none">Shop</a></li>
                    <li><a href="#about" class="text-dark text-decoration-none">About Us</a></li>
                    <li><a href="#services" class="text-dark text-decoration-none">Services</a></li>
                    <li><a href="#subscribe" class="text-dark text-decoration-none">Newsletter</a></li>
                    <li><a href="#contact" class="text-dark text-decoration-none">Contact</a></li>
                </ul>
            </div>

            <!-- Contact & Social -->
            <div class="col-md-4 mb-4">
                <h5 class="floral-text mb-3">Contact Us</h5>
                <p class="small mb-1"><i class="fa-solid fa-location-dot me-2"></i>123 Flower Street, Your City</p>
                <p class="small mb-1"><i class="fa-solid fa-phone me-2"></i>+1 234 567 890</p>
                <p class="small mb-1"><i class="fa-solid fa-envelope me-2"></i>info@hannaflowershop.com</p>

                <div class="mt-3">
                    <a href="#" class="text-dark me-3"><i class="fa-brands fa-facebook fa-lg"></i></a>
                    <a href="#" class="text-dark me-3"><i class="fa-brands fa-instagram fa-lg"></i></a>
                    <a href="#" class="text-dark me-3"><i class="fa-brands fa-pinterest fa-lg"></i></a>
                    <a href="#" class="text-dark"><i class="fa-brands fa-twitter fa-lg"></i></a>
                </div>
            </div>

        </div>

        <hr class="my-3">

        <div class="text-center small">
            &copy; {{ date('Y') }} Hanna Flower Shop. All rights reserved.
        </div>
    </div>
</footer>

<style>
    .floral-text {
        background: linear-gradient(135deg, #ff9a9e, #fad0c4, #fad0c4, #ffecd2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: bold;
    }

    footer a:hover {
        color: #ff6b81;
        text-decoration: underline;
    }
</style>

@yield('scriptSource')

</html>
