@extends('layouts.ego-app')
@section('content')
    <form action="{{ url('/pay') }}" method="POST" class="needs-validation">
        @csrf
        <div class="container" id="shipping">
            <nav class="nav nav-pills flex-column flex-sm-row" style="margin-top: 180px; margin-bottom: 50px">
                <a class="flex-sm-fill text-sm-center nav-link active" aria-current="page" href="#">Shipping</a>
                <a class="flex-sm-fill text-sm-center nav-link text-black" href="#">Payment</a>
            </nav>
            <div class="row justify-content-between">
                <div class="col-7">
                    <div class="card p-4 mb-4">
                        <h2>Shipping Address</h2>
                    </div>
                    <div class="card p-4 mb-4">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control w-100" id="first_name" placeholder="First Name"
                                name="first_name" required>
                            <label for="first_name">First Name*</label>
                        </div>
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="last_name" placeholder="Last Name"
                                name="last_name" required>
                            <label for="last_name">Last Name*</label>
                        </div>
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="company" placeholder="Company"
                                name="company">
                            <label for="company">Company</label>
                        </div>
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="address_one" placeholder="Steet Address"
                                name="address_one" required>
                            <label for="address_one">Steet Address 1*</label>
                        </div>
                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="address_two" placeholder="Steet Address"
                                name="address_two">
                            <label for="address_two">Steet Address 2</label>
                        </div>
                        <div class="form-floating">
                            <select class="form-select" id="countrySelect" aria-label="Floating label select example" name="country">
                                <option value="">Select a country</option>
                                @foreach ($countries as $country)
                                    @if ($country['name'] != 'Israel')
                                        <option value="{{ $country['name'] }}"
                                            data-states="{{ json_encode($country['states']) }}">
                                            {{ $country['name'] }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                            <label for="countrySelect">Country*</label>
                        </div>

                        <div class="form-floating">
                            <select class="form-select" id="stateSelect" aria-label="Floating label select example" name="state">
                                <option value="">Select a country first</option>
                            </select>
                            <label for="stateSelect">State*</label>
                        </div>

                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="city" placeholder="City"
                                name="city" required>
                            <label for="city">City</label>
                        </div>

                        <div class="form-floating">
                            <input type="text" class="form-control w-100" id="zip" placeholder="Zip code"
                                name="zip" required>
                            <label for="zip">Zip code</label>
                        </div>

                        <div class="form-floating">
                            <input type="email" class="form-control w-100" id="zip" placeholder="Email Address"
                                name="email" required>
                            <label for="zip">Email</label>
                        </div>

                        <div class="input-group mb-3">
                            <select class="form-select" id="stateSelect" aria-label="Floating label select example" name="dial_code">
                                @foreach ($dialdatas as $dialdata)
                                    <option value="{{ $dialdata['dial_code'] }}">({{ $dialdata['dial_code'] }})<span
                                            style="font-size: 10px; margin-left: 10px">{{ $dialdata['name'] }}</span>
                                    </option>
                                @endforeach

                            </select>
                            <input type="text" class="form-control" style="width: 70%"
                                aria-label="Text input with dropdown button" name="phone" placeholder="Phone Number">
                        </div>
                    </div>

                    <div class="card p-4">
                        <h2>Shipping Methods</h2>
                        <div class="form-check d-flex align-items-center gap-4 py-3 mt-3 border-top border-bottom">
                            <input class="form-check-input" type="radio" name="delivery" value="60" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                STANDARD EXPRESS <span style="font-size: 18px">(60৳)</span>
                            </label>
                        </div>
                        <button type="button" id="next" class="btn btn-dark mt-4">Next</button>
                    </div>

                </div>

                <div class="col-4">
                    <div class="card p-4">
                        <h2>Order Summery</h2>
                        <h6>{{ $carts->count() }} items in cart</h6>
                        @foreach ($carts as $cart)
                            <div class="cart-item"
                                style="display: flex; align-items: stretch; margin-bottom: 20px; height: 100%; border: 1px solid #e0e0e0; border-radius: 8px; padding: 10px;">
                                <div class="image-container"
                                    style="width: 90px; height: 90px; position: relative; flex-shrink: 0;">
                                    <img src="{{ asset($cart->product->image_path) }}" alt="Random Image"
                                        style="width: 100%; height: 100%; object-fit: cover;">

                                </div>

                                <div class="cart-details"
                                    style="flex-grow: 1; padding-left: 15px; display: flex; flex-direction: column; justify-content: left;">
                                    <div>
                                        <h5 style="font-size: 16px; font-weight: 600; margin: 0 0 6px 0;">
                                            {{ $cart->product->name }}</h5>
                                        <h5>{{ $cart->power }}</h5>
                                    </div>

                                    <div
                                        style="margin-top: 10px; display: flex; align-items: center; justify-content: space-between;">

                                        <span style="font-size: 14px; margin-left: 10px;">{{ $cart->pair }}QTY <span
                                                style="width: 20px; display: inline-block"></span>
                                            {{ $cart->product->price * $cart->pair }} ৳</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

        <div class="container" id="payment">
            <nav class="nav nav-pills flex-column flex-sm-row" style="margin-top: 180px; margin-bottom: 50px">
                <a id="back" class="flex-sm-fill text-sm-center nav-link active" aria-current="page" href="#">Shipping</a>
                <a class="flex-sm-fill text-sm-center nav-link active" href="#">Payment</a>
            </nav>
            <div class="row justify-content-between">
                <div class="col-7">
                    <div class="card p-4 mb-4">
                        <h2>Payment Method</h2>
                        <div class="form-check d-flex align-items-center gap-4 py-3 mt-3 border-top border-bottom">
                            <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod">
                            <label class="form-check-label" for="cod">
                                Cash on delivery</span>
                            </label>
                        </div>
                        <div class="form-check d-flex align-items-center gap-4 py-3 mt-3 border-top border-bottom">
                            <input class="form-check-input" type="radio" name="payment_method" id="ssl" value="ssl">
                            <label class="form-check-label" for="ssl">
                                SSL Commerze
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Return Policy*
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                I have read and accept the privacy policy
                            </label>
                        </div>
                       
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout (Hosted)</button>
                    </div>
                </div>

                <div class="col-4">
                    <div class="card p-4">
                        <h2>Order Summery</h2>
                        <h6>{{ $carts->count() }} items in cart</h6>
                        <div class="d-flex justify-content-between mb-2">
                            <p>Cart Subtotal</p>
                            <p>{{ $carts->sum(function ($cart) {
                                return $cart->pair * $cart->product->price;
                            }) }}৳
                            </p>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <p>Discount</p>
                            <p>-50৳</p>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <p>Shipping SHIPPING - STANDARD EXPRESS</p>
                            <p>60৳</p>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <p>Order Total</p>
                            <p>{{ $carts->sum(function ($cart) {
                                return $cart->pair * $cart->product->price + 60 - 50;
                            }) }}৳
                            </p>
                        </div>
                        @foreach ($carts as $cart)
                            <div class="cart-item"
                                style="display: flex; align-items: stretch; margin-bottom: 20px; height: 100%; border: 1px solid #e0e0e0; border-radius: 8px; padding: 10px;">
                                <div class="image-container"
                                    style="width: 90px; height: 90px; position: relative; flex-shrink: 0;">
                                    <img src="{{ asset($cart->product->image_path) }}" alt="Random Image"
                                        style="width: 100%; height: 100%; object-fit: cover;">

                                </div>

                                <div class="cart-details"
                                    style="flex-grow: 1; padding-left: 15px; display: flex; flex-direction: column; justify-content: left;">
                                    <div>
                                        <h5 style="font-size: 16px; font-weight: 600; margin: 0 0 6px 0;">
                                            {{ $cart->product->name }}</h5>
                                        <h5>{{ $cart->power }}</h5>
                                    </div>

                                    <div
                                        style="margin-top: 10px; display: flex; align-items: center; justify-content: space-between;">

                                        <span style="font-size: 14px; margin-left: 10px;">{{ $cart->pair }}QTY <span
                                                style="width: 20px; display: inline-block"></span>
                                            {{ $cart->product->price * $cart->pair }} ৳</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </form>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#countrySelect').change(function() {
                var selectedCountry = $(this).find(':selected');
                var states = selectedCountry.data('states');

                // Clear previous states
                $('#stateSelect').html('<option value="">Select a state</option>');

                if (states) {
                    states.forEach(function(state) {
                        var stateOption = '<option value="' + state.name + '">' + state.name +
                            '</option>';
                        $('#stateSelect').append(stateOption);
                    });
                } else {
                    $('#stateSelect').html('<option value="">No states found</option>');
                }
            });
        });
    </script>

    <script>
        document.getElementById('payment').style.display = 'none';

        document.getElementById('next').addEventListener('click', function(event) {
            event.preventDefault();

            // Hide the shipping section
            document.getElementById('shipping').style.display = 'none';

            // Show the payment section
            document.getElementById('payment').style.display = 'block';
        });

        document.getElementById('back').addEventListener('click', function(event) {
            event.preventDefault();

            // Hide the shipping section
            document.getElementById('payment').style.display = 'none';

            // Show the payment section
            document.getElementById('shipping').style.display = 'block';
        });
    </script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
@endsection
