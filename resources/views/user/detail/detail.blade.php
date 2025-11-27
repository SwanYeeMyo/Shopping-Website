@extends('layouts.master')
@section('content')
    <div class="container">
        <nav aria-label="breadcrumb " class="mt-5 p-lg-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user#home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Flowers</a></li>
                <li class="breadcrumb-item"><a href="#">{{ $product->category_name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>

        </nav>

        <div class="row my-auto  g-3">
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="card border " style="overflow:hidden">
                    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid w-100 "
                        alt="{{ $product->name }}">
                </div>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <div class="card shadow-sm  border-0">
                    <div class="card-body ">
                        <h6>{{ $product->name }}</h6>
                        <h5 class="floral-text text-left"><b>{{ $product->price }}</b> Ks .</h5>

                        <div class="mt-4">
                            <p>{{ $product->description }}</p>
                        </div>
                        <form action="{{ route('user#cartCreate') }}" method="POST">
                            @csrf

                            <div id="group-wrapper">
                                <!-- One group (template) -->
                                <div class="item-group mb-4 border p-3 rounded">
                                    <label class="form-label fw-bold">Quantity</label>
                                    <select class="form-select mb-2" name="items[0][qty]">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>

                                    <input type="hidden" name="items[0][product_id]" value="{{ $product->product_id }}">

                                    <label class="form-label fw-bold">Toppings:</label>

                                    @foreach ($topping as $t)
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="items[0][toppings][]"
                                                value="{{ $t->id }}" id="item0_topping{{ $t->id }}">

                                            <label class="form-check-label" for="item0_topping{{ $t->id }}">
                                                {{ $t->name }} ({{ number_format($t->price) }} ks)
                                            </label>
                                        </div>
                                    @endforeach

                                    <button type="button" class="btn btn-danger mt-2 remove-group d-none">Remove</button>
                                </div>
                            </div>

                            <button type="button" id="addMore" class="btn btn-secondary mt-2">+ Add More</button>

                            <button type="submit" class="btn btn-primary mt-2">Submit All</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mt-5 col-md-6 col-sm-12">
                <div class="card shadow border ">
                    <div class="card-header border-0 text-muted">
                        Delivery
                    </div>
                    <div class="card-body  ">
                        <p style="font-size: 12px">
                            Same Day Delivery ဝန်ဆောင်မှုအား (ရန်ကုန်နှင့်မန္တလေး)သာ ရရှိနိုင်ပါသည်။
                            အခြားမြို့များအတွက် မှာယူသည့်နေ့တွင် သက်ဆိုင်ရာ Delivery Service အပ်ပေးပါသည်။
                        </p>
                        <span class="text-muted"> Return</span>
                        <p style="font-size: 12px" class="my-1">
                            ၇ရက်အတွင်းဖြစ်ပေါ်သော မူလချို့ယွင်းမှုများ အတွက် 24နာရီ အတွင်း အာမခံအပြည့်ပါသော ပစ္စည်းများဖြင့်
                            အစားထိုးပေးပါသည်။
                        </p>
                        <span class="text-muted"> We Accept</span>
                        <p style="font-size: 12px" class="my-1">
                            <img src="{{ asset('user/isure_sidebar_payment-copy.webp') }}" class="img-fluid"
                                alt="">
                        </p>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-outline-primary w-100">Call Us 09770774800</button>
                        <span class="text-center d-block my-2" style="font-size: 10px">
                            Operating Hour 9:00am to 8:00pm
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <h5>Rating & Reviews</h5>

                <!-- Average Rating -->
                <h6 class="mt-3">Average Rating:
                    <span id="avgRating">
                        {{ number_format($product->ratings->avg('rating'), 1) ?? 0 }}
                    </span> / 5
                </h6>

                <!-- User Rating Form -->
                @auth
                    <div class="card mt-3">
                        <div class="card-body">
                            <h6>Leave a Review</h6>

                            <div class="d-flex align-items-center">
                                <select id="rating" class="form-select w-auto">
                                    <option value="1">⭐ 1</option>
                                    <option value="2">⭐ 2</option>
                                    <option value="3">⭐ 3</option>
                                    <option value="4">⭐ 4</option>
                                    <option value="5">⭐ 5</option>
                                </select>
                            </div>

                            <textarea id="comment" class="form-control mt-2" placeholder="Write your comment..."></textarea>

                            <button class="btn btn-primary mt-2" id="submitReview">Submit</button>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info mt-3">Please login to leave a review.</div>
                @endauth

                <div class="mt-4" id="reviewList">
                    @foreach ($product->ratingsWithComment as $r)
                        <div class="card p-3 mb-2">
                            <strong>{{ $r->user->name }}</strong>
                            <span class="text-warning">
                                @for ($i = 1; $i <= $r->rating; $i++)
                                    ⭐
                                @endfor
                            </span>
                            <p class="mb-0">{{ $r->comment }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row mt-5 g-3">
            <div class="col-12">
                <h5>Similar Items</h5>
            </div>

            @foreach ($randomNumber as $rN)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="card h-100 border-none shadow-sm">
                        <!-- Image -->
                        <a href="{{ route('user#detail', $rN->product_id) }}" class="d-block">
                            <div class="card-img-top d-flex justify-content-center align-items-center"
                                style="height: 180px; overflow: hidden;">
                                <img src="{{ asset('storage/' . $rN->image) }}" class="img-fluid"
                                    alt="{{ $rN->name }}"
                                    style="object-fit: contain; max-width: 100%; max-height: 100%;">
                            </div>
                        </a>

                        <!-- Card Body -->
                        <div class="card-body text-center py-2 d-flex flex-column justify-content-between">
                            <h6 class="mb-1">{{ $rN->name }}</h6>
                            <p class="mb-2 text-primary">{{ $rN->price }}</p>
                            <div class="text-warning">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

        $('#submitReview').click(function() {
            let rating = $('#rating').val();
            let comment = $('#comment').val().trim();
            let product_id = "{{ $product->product_id }}";

            if (!rating) {
                alert('Please select a rating before submitting.');
                return;
            }

            $.ajax({
                type: 'POST',
                url: "{{ route('product.review.create') }}",
                data: {
                    rating: rating,
                    comment: comment,
                    product_id: product_id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    $('#comment').val('');

                    if (comment) {
                        // Only show review card if comment exists
                        $('#reviewList').prepend(`
                    <div class="card p-3 mb-2">
                        <strong>${res.user}</strong>
                        <span class="text-warning">${'⭐'.repeat(res.rating)}</span>
                        <p class="mb-0">${res.comment}</p>
                    </div>
                `);
                    } else {

                        alert('Thank you for giving a rating!');
                    }

                    // Update average rating
                    $('#avgRating').text(res.average);
                },
                error: function(err) {
                    alert('Something went wrong. Please try again.');
                }
            });
        });

        let index = 1;

        document.getElementById('addMore').addEventListener('click', function() {
            let wrapper = document.getElementById('group-wrapper');
            let firstGroup = wrapper.querySelector('.item-group');
            let newGroup = firstGroup.cloneNode(true);

            newGroup.querySelectorAll('select, input[type="hidden"], input[type="checkbox"]').forEach(el => {
                el.name = el.name.replace('[0]', '[' + index + ']');

                if (el.type === 'checkbox') {
                    el.checked = false;
                }
            });

            newGroup.querySelectorAll('input[type="checkbox"]').forEach((el) => {
                let oldId = el.id;
                el.id = 'item' + index + '_' + oldId.split('_').pop();

                let label = newGroup.querySelector(`label[for="${oldId}"]`);
                if (label) {
                    label.setAttribute('for', el.id);
                }
            });

            newGroup.querySelector('.remove-group').classList.remove('d-none');

            wrapper.appendChild(newGroup);

            index++;
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-group')) {
                e.target.closest('.item-group').remove();
            }
        });
    </script>
@endsection
