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
            <div class="col-lg-7 col-12">
                <div class="card p-4 mb-4">
                    <h2>Shipping Address</h2>
                </div>
                <div class="card p-4 mb-4">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control w-100" id="first_name" placeholder="First Name"
                            name="first_name" required>
                        <label for="first_name">First Name*</label>
                        <div class="invalid-feedback">Please enter your first name.</div> <!-- Validation message -->
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control w-100" id="last_name" placeholder="Last Name"
                            name="last_name" required>
                        <label for="last_name">Last Name*</label>
                        <div class="invalid-feedback">Please enter your last name.</div>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control w-100" id="company" placeholder="Company"
                            name="company">
                        <label for="company">Company</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control w-100" id="address_one" placeholder="Street Address"
                            name="address_one" required>
                        <label for="address_one">Street Address 1*</label>
                        <div class="invalid-feedback">Please enter your street address.</div>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control w-100" id="address_two" placeholder="Street Address"
                            name="address_two">
                        <label for="address_two">Street Address 2</label>
                    </div>
                    <div class="form-floating">
                        <select class="form-select" id="countrySelect" aria-label="Floating label select example" name="country" required>
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
                        <div class="invalid-feedback">Please select a country.</div>
                    </div>

                    <div class="form-floating">
                        <select class="form-select" id="stateSelect" aria-label="Floating label select example" name="state" required>
                            <option value="">Select a country first</option>
                        </select>
                        <label for="stateSelect">State*</label>
                        <div class="invalid-feedback">Please select a state.</div>
                    </div>

                    <div class="form-floating">
                        <input type="text" class="form-control w-100" id="city" placeholder="City"
                            name="city" required>
                        <label for="city">City*</label>
                        <div class="invalid-feedback">Please enter your city.</div>
                    </div>

                    <div class="form-floating">
                        <input type="text" class="form-control w-100" id="zip" placeholder="Zip code"
                            name="zip" required>
                        <label for="zip">Zip code*</label>
                        <div class="invalid-feedback">Please enter your zip code.</div>
                    </div>

                    <div class="form-floating">
                        <input type="email" class="form-control w-100" id="email" placeholder="Email Address"
                            name="email" required>
                        <label for="email">Email*</label>
                        <div class="invalid-feedback">Please enter a valid email.</div>
                    </div>

                    <div class="input-group mb-3">
                        <select class="form-select" id="dial_code" aria-label="Floating label select example" name="dial_code" required>
                            @foreach ($dialdatas as $dialdata)
                            <option value="{{ $dialdata['dial_code'] }}">({{ $dialdata['dial_code'] }})<span
                                    style="font-size: 10px; margin-left: 10px">{{ $dialdata['name'] }}</span>
                            </option>
                            @endforeach

                        </select>
                        <input type="text" class="form-control" style="width: 70%"
                            aria-label="Text input with dropdown button" name="phone" placeholder="Phone Number" required>
                        <div class="invalid-feedback">Please enter your phone number.</div>
                    </div>
                </div>

                <div class="card p-4">
                    <h2>Shipping Methods</h2>
                    <div class="form-check d-flex align-items-center gap-4 py-3 mt-3 border-top border-bottom">
                        <input class="form-check-input" type="radio" name="delivery" value="60" id="flexRadioDefault1" required>
                        <label class="form-check-label" for="flexRadioDefault1">
                            STANDARD EXPRESS <span style="font-size: 18px">(60৳)</span>
                        </label>
                        <div class="invalid-feedback">Please select a shipping method.</div>
                    </div>
                    <button type="button" id="next" class="btn btn-dark mt-4">Next</button>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="card p-4">
                    <h2>Order Summary</h2>
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
                                    {{ $cart->product->name }}
                                </h5>
                                <h5>{{ $cart->power }}</h5>
                            </div>

                            <div
                                style="margin-top: 10px; display: flex; align-items: center; justify-content: space-between;">
                                <span style="font-size: 14px; margin-left: 10px;">{{ $cart->pair }} QTY <span
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
            <div class="col-lg-7 col-12">
                <div class="card p-4 mb-4">
                    <h2>Payment Method</h2>
                    <div class="form-check d-flex align-items-center gap-4 py-3 mt-3 border-top border-bottom">
                        <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" required>
                        <label class="form-check-label" for="cod">
                            Cash on delivery
                        </label>
                        <div class="invalid-feedback">Please select a payment method.</div>
                    </div>
                    <div class="form-check d-flex align-items-center gap-4 py-3 mt-3 border-bottom">
                        <input class="form-check-input" type="radio" name="payment_method" id="bkash" value="ssl" required>
                        <label class="form-check-label" for="bkash" >
                            Online Payment
                        </label>
                        <div class="invalid-feedback">Please select a payment method.</div>
                    </div>
                    
                    <button type="submit" class="btn btn-dark mt-4">Confirm Order</button>
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
    // Initially hide the payment section
    document.getElementById('payment').style.display = 'none';

    document.getElementById('next').addEventListener('click', function(event) {
        event.preventDefault();

        // Check if all required fields in the shipping tab are filled
        var isValid = true;
        var requiredFields = document.querySelectorAll('#shipping [required]');

        requiredFields.forEach(function(field) {
            if (!field.value) {
                isValid = false;
                field.classList.add('is-invalid'); // Add Bootstrap's invalid class
            } else {
                field.classList.remove('is-invalid'); // Remove invalid class if valid
            }
        });

        if (isValid) {
            // Hide the shipping section
            document.getElementById('shipping').style.display = 'none';

            // Show the payment section
            document.getElementById('payment').style.display = 'block';
        } else {
            alert('Please fill out all required fields.');
        }
    });

    document.getElementById('back').addEventListener('click', function(event) {
        event.preventDefault();

        // Hide the payment section
        document.getElementById('payment').style.display = 'none';

        // Show the shipping section
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