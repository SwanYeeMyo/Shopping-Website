@extends('layouts.master')
@section('content')

    <section id="hero" class="d-flex align-items-center" style="min-height: 100vh; background: #fdf6f0;">
        <div class="container py-5">
            <div class="row align-items-center">

                <!-- Hero Image -->
                <div class="col-lg-6 mb-4 mb-lg-0 text-center">
                    <div class="hero-image-wrapper"
                        style="height: 100%; display: flex; justify-content: center; align-items: center;">
                        <img src="{{ asset('user/img9827.webp') }}" alt="Hero Image" class="img-fluid rounded shadow"
                            style="height: 100%; object-fit: cover; width: 100%; max-width: 600px;"
                            onerror="this.src='{{ asset('images/default-product.png') }}'">
                    </div>
                </div>

                <!-- Hero Text -->
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold mb-4 floral-text">
                        Hanna Flower Shop – Fresh Blooms, Delivered with Love
                    </h1>
                    <p class="lead mb-4 floral-paragraph">
                        Welcome to Hanna Flower Shop, your destination for beautiful, handcrafted floral arrangements. From
                        vibrant bouquets that brighten any room to delicate arrangements that celebrate love, joy, and
                        special
                        moments, we create each design with passion and care. Explore our seasonal flowers, exotic blooms,
                        and
                        custom creations perfect for weddings, birthdays, or simply to bring a smile. Let Hanna Flower Shop
                        make every occasion bloom with natural beauty.
                    </p>
                    <a href="#shop" class="btn btn-primary btn-lg floral-gradient-btn">Shop Now</a>
                </div>

            </div>
        </div>
    </section>


    <section id="about" class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <img src={{ asset('user/8903604.webp') }} class="img-fluid rounded shadow" alt="About Us">
                </div>
                <div class="col-lg-6">
                    <h2 class="floral-text mb-3">Our Story</h2>
                    <p class="lead floral-paragraph">
                        Hanna Flower Shop has been creating beautiful bouquets and floral arrangements for over 10 years.
                        Our passion is helping you celebrate every special moment with stunning, fresh flowers that bring
                        joy and color.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <div id="products" class="container py-16">
        <div class="container">

            <!-- Recently Added Products -->
            <div class="mb-5">
                <h2 class="text-center mb-4 floral-text">Recently Added Products</h2>
            </div>

            <div class="row g-4">
                @if ($recentlyAddedProducts->count() > 0)
                    @foreach ($recentlyAddedProducts as $product)
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="card h-100 shadow-sm border-0 rounded hover-scale">
                                <div class="card-body d-flex justify-content-center align-items-center p-3"
                                    style="height: 220px;">
                                    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid"
                                        alt="{{ $product->name }}"
                                        style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                </div>
                                <div class="card-footer border-0 text-center py-2 bg-light">
                                    <h5 class="mb-1">{{ $product->name }}</h5>

                                    <p class="text-slate-300 mb-2">{{ $product->price }} kyats</p>
                                    <a href="{{ url('product/filter/' . $product->category_id) }}"
                                        class="btn btn-primary btn-sm floral-gradient-btn">Check Product</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Popular Products -->
            <div class="mt-5 mb-4">
                <h2 class="text-center mb-4 floral-text">Popular Products</h2>
            </div>

            <div class="row g-4">
                @if ($popularProducts->count() > 0)
                    @foreach ($popularProducts as $product)
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                            <div class="card h-100 shadow rounded hover-scale">
                                <div class="card-header bg-light border-0 text-center py-2">
                                    <strong>{{ $product->product_name }}</strong>
                                </div>
                                <div class="card-body d-flex justify-content-center align-items-center p-3"
                                    style="height: 220px;">
                                    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid"
                                        alt="{{ $product->product_name }}"
                                        style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                </div>
                                <div class="card-footer border-0 text-center py-2 bg-light">
                                    <a href="{{ url('product/details/' . $product->product_id) }}"
                                        class="btn btn-primary btn-sm floral-gradient-btn">Check Product</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

        </div>
    </div>

    <section id="reviews" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5 floral-text">What Our Customers Say</h2>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 rounded p-4 text-center">
                        <div class="mb-3">
                            <i class="fa-solid fa-star text-warning"></i>
                            <i class="fa-solid fa-star text-warning"></i>
                            <i class="fa-solid fa-star text-warning"></i>
                            <i class="fa-solid fa-star text-warning"></i>
                            <i class="fa-regular fa-star text-warning"></i>
                        </div>
                        <p class="mb-3">"Beautiful bouquet! The flowers arrived fresh and bright, just like the picture."
                        </p>
                        <strong>– Emily R.</strong>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 rounded p-4 text-center">
                        <div class="mb-3">
                            <i class="fa-solid fa-star text-warning"></i>
                            <i class="fa-solid fa-star text-warning"></i>
                            <i class="fa-solid fa-star text-warning"></i>
                            <i class="fa-solid fa-star-half-stroke text-warning"></i>
                            <i class="fa-regular fa-star text-warning"></i>
                        </div>
                        <p class="mb-3">"Quick delivery and amazing arrangements! I will order again for special
                            occasions."</p>
                        <strong>– Michael K.</strong>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 rounded p-4 text-center">
                        <div class="mb-3">
                            <i class="fa-solid fa-star text-warning"></i>
                            <i class="fa-solid fa-star text-warning"></i>
                            <i class="fa-solid fa-star text-warning"></i>
                            <i class="fa-solid fa-star text-warning"></i>
                            <i class="fa-solid fa-star text-warning"></i>
                        </div>
                        <p class="mb-3">"Absolutely loved it! The floral arrangements were elegant and beautifully
                            crafted."</p>
                        <strong>– Sarah L.</strong>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="services" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5 floral-text">Our Services</h2>
            <div class="row g-4 text-center">
                <div class="col-md-4">
                    <i class="fa-solid fa-truck fa-3x mb-3 text-pink-400"></i>
                    <h5>Fast Delivery</h5>
                    <p>Same-day delivery for orders in your city, ensuring fresh flowers every time.</p>
                </div>
                <div class="col-md-4">
                    <i class="fa-solid fa-heart fa-3x mb-3 text-pink-400"></i>
                    <h5>Custom Bouquets</h5>
                    <p>Design your own bouquet or let us craft something unique for your occasion.</p>
                </div>
                <div class="col-md-4">
                    <i class="fa-solid fa-calendar-days fa-3x mb-3 text-pink-400"></i>
                    <h5>Event Arrangements</h5>
                    <p>We provide beautiful floral arrangements for weddings, parties, and corporate events.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="subscribe" class="py-5 mt-5 bg-pink-50 text-center">
        <div class="container">
            <h3 class="mb-3 floral-text">Stay Updated</h3>
            <p>Subscribe to our newsletter to get fresh flower deals and tips!</p>
            <form class="d-flex justify-content-center">
                <input type="email" class="form-control w-50 me-2" placeholder="Enter your email">
                <button class="btn btn-primary">Subscribe</button>
            </form>
        </div>
    </section>

@endsection
