@extends('layouts.ego-app')
@section('content')
<style>
    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: white;
        background-color: black;
    }

    .card {
        box-shadow: unset;
    }

    .card:hover {
        box-shadow: unset;
    }
</style>

<form action="{{ url('/pay') }}" method="POST" class="needs-validation">
    @csrf
    <div class="container" id="shipping">
        <nav class="nav nav-pills flex-column flex-sm-row" style="margin-top: 180px; margin-bottom: 50px">
            <a class="flex-sm-fill text-sm-center nav-link active" aria-current="page" href="#">Shipping</a>
            <a class="flex-sm-fill text-sm-center nav-link text-black ms-3" href="#">Payment</a> <!-- Added margin using Bootstrap -->
        </nav>

        <div class="row justify-content-between">
            <div class="col-lg-7 col-md-12">
                <div class="card p-4 mb-4">
                    <h2>Shipping Address</h2>
                </div>
                <div class="card p-4 mb-4">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control w-100" id="first_name" placeholder="First Name"
                            name="first_name" value="{{@$userDetail->firstname}}" required>
                        <label for="first_name">First Name*</label>
                        <div class="invalid-feedback">Please enter your first name.</div> <!-- Validation message -->
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control w-100" id="last_name" placeholder="Last Name"
                            name="last_name" value="{{@$userDetail->lastname}}" required>
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
                            name="address_one" value="{{@$userDetail->address->address}}" required>
                        <label for="address_one">Street Address 1*</label>
                        <div class="invalid-feedback">Please enter your street address.</div>
                    </div>
                    <div class="form-floating">
                        <select class="form-select" id="countrySelect" aria-label="Floating label select example" name="country" required>
                            <option value="">Select a country</option>
                            @foreach ($countries as $country)
                            @if ($country['name'] != 'Israel')
                            <option value="{{ $country['name'] }}"
                                data-states="{{ json_encode($country['states']) }}" @if($country['name']=='Bangladesh' ) selected @endif>
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
                            @foreach($countries as $country)
                            @if($country['name'] == 'Bangladesh')
                            @foreach($country['states'] as $state)
                            <option value="{{$state['name']}}" @if($state['name']=='Dhaka District' ) selected @endif>{{$state['name']}}</option>
                            @endforeach
                            @endif
                            @endforeach
                        </select>
                        <label for="stateSelect">State*</label>
                        <div class="invalid-feedback">Please select a state.</div>
                    </div>

                    <div class="form-floating">
                        <input type="text" class="form-control w-100" id="city" placeholder="City"
                            name="city" value="{{@$userDetail->address->city}}" required>
                        <label for="city">City*</label>
                        <div class="invalid-feedback">Please enter your city.</div>
                    </div>

                    <div class="form-floating">
                        <input type="text" class="form-control w-100" id="zip" placeholder="Zip code"
                            name="zip" value="{{@$userDetail->address->zip}}" required>
                        <label for="zip">Zip code*</label>
                        <div class="invalid-feedback">Please enter your zip code.</div>
                    </div>

                    <div class="form-floating">
                        <input type="email" class="form-control w-100" id="email" placeholder="Email Address"
                            name="email" value="{{@$userDetail->email}}" required>
                        <label for="email">Email*</label>
                        <div class="invalid-feedback">Please enter a valid email.</div>
                    </div>

                    <div class="input-group mb-3">
                        <select class="form-select" id="dial_code" aria-label="Floating label select example" name="dial_code" required>
                            @foreach ($dialdatas as $dialdata)
                            <option value="{{ $dialdata['dial_code'] }}" @if($dialdata['dial_code']=='+880' ) selected @endif>({{ $dialdata['dial_code'] }})<span
                                    style="font-size: 10px; margin-left: 10px">{{ $dialdata['name'] }}</span>
                            </option>
                            @endforeach
                        </select>
                        <input type="text" class="form-control" style="width: 70%"
                            aria-label="Text input with dropdown button" name="phone" placeholder="Phone Number" value="{{@$userDetail->mobile}}" required>
                        <div class="invalid-feedback">Please enter your phone number.</div>
                    </div>
                </div>

                <div class="card p-4">
                    <h2>Shipping Methods</h2>
                    @foreach($shippingMethods as $shippingMethod)
                    <div class="form-check d-flex align-items-center gap-4 py-3 mt-3 border-top border-bottom">
                        <input class="form-check-input" type="radio" name="delivery" value="{{@$shippingMethod->fee}}" id="flexRadioDefault{{@$shippingMethod->fee}}" required>
                        <label class="form-check-label" for="flexRadioDefault{{@$shippingMethod->fee}}">
                            {{$shippingMethod->title}} <span style="font-size: 18px">({{$shippingMethod->fee}} BDT)</span>
                        </label>
                        <label for="flexRadioDefault{{@$shippingMethod->fee}}">
                            {{$shippingMethod->place}}
                        </label>
                        <div class="invalid-feedback">Please select a shipping method.</div>
                    </div>
                    @endforeach
                    <button type="button" id="next" class="btn btn-dark mt-4">Next</button>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card p-4">
                    <h2>Order Summary</h2>
                    <h6>{{ @$carts->sum('pair') }} items in cart</h6>
                    @foreach ($carts as $cart)
                    <div class="cart-item"
                        style="display: flex; align-items: stretch; margin-bottom: 20px; height: 100%; border: 1px solid #e0e0e0; border-radius: 8px; padding: 10px;">
                        <div class="image-container"
                            style="width: 90px; height: 90px; position: relative; flex-shrink: 0;">
                            <img src="{{ asset(@$cart->product->image_path) }}" alt="Random Image"
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
                                    {{ ($cart->power_type == 'with_power' ? $cart->product->price : $cart->product->no_power_price) * $cart->pair }}  BDT</span>
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
                        <label class="form-check-label" for="bkash">
                            Online Payment
                        </label>
                        <div class="invalid-feedback">Please select a payment method.</div>
                    </div>
                </div>

                <div class="card p-4 mb-4">
                    <div id="promoShow"></div>
                    <div id="promoSection">
                        <div id="promoInputGroup" class="form-floating">
                            <input type="text" id="promo_code" placeholder="Enter Promo Code" class="form-control w-100" name="promo_code">
                            <label for="promo_code">Promo Code</label>
                            <button type="button" id="applyPromo" class="btn btn-outline-dark">Apply Promo</button>
                        </div>

                        <p id="promoMessage" class="mb-0"></p>
                    </div>
                </div>


                <div class="card p-4 mb-4">
                    <button type="submit" class="btn" style="background: black;color:white">Confirm Order</button>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="card p-4">
                    <h2>Order Summary</h2>
                    <h6>{{ $carts->sum('pair') }} items in cart</h6>
                    @foreach ($carts as $cart)
                    <div class="cart-item"
                        style="display: flex; align-items: stretch; margin-bottom: 20px; height: 100%; border: 1px solid #e0e0e0; border-radius: 8px; padding: 10px;">
                        <div class="image-container"
                            style="width: 90px; height: 90px; position: relative; flex-shrink: 0;">
                            <img src="{{ asset(@$cart->product->image_path) }}" alt="Random Image"
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
                                    {{ ($cart->power_type == 'with_power' ? $cart->product->price : $cart->product->no_power_price) * $cart->pair }}  BDT</span>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <div class="d-flex justify-content-between">
                        <h4>Subtotal</h4>
                        <b>{{ $carts->sum(function($cart) {
                            $price = $cart->power_status == 'no_power' ? $cart->product->no_power_price : $cart->product->price;
                            return $price * $cart->pair;
                        }) }} BDT</b>

                    </div>
                    <div class="d-flex justify-content-between">
                        <h4>Discount</h4>
                        <b>- <span id="discount">{{ $carts->filter(function($cart) { return $cart->product->is_free == 1; })->sum(function($cart) { return $cart->product->no_power_price * $cart->pair; }) ?? 0 }}</span> BDT</b>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h4>Delivery Free</h4>
                        <b id="deliveryFee">60 BDT</b>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h4>Tax</h4>
                        <b id="tax">{{number_format($taxprice,0)}}  BDT</b>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h4>Total</h4>
                        <b id="total">
                            {{
                                $carts->sum(function($cart) {
                                    $price = $cart->power_status == 'no_power' ? $cart->product->no_power_price : $cart->product->price;
                                    return $price * $cart->pair;
                                }) 
                                + 60 
                                - $carts->filter(function($cart) {
                                    return $cart->product->is_free == 1;
                                })->sum(function($cart) {
                                    $price = $cart->power_status == 'no_power' ? $cart->product->no_power_price : $cart->product->price;
                                    return $price * $cart->pair;
                                }) + $taxprice
                            }} BDT
                        </b>

                    </div>
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
<script>
    $(document).ready(function() {

        // Function to apply promo code
        function applyPromoCode() {
            var promoCode = $('#promo_code').val();
            
            var subtotal = {{ $carts->sum(function($cart) { 
                $price = $cart->power_status == 'no_power' ? $cart->product->no_power_price : $cart->product->price; 
                return $price * $cart->pair; 
            }) }};

            var existingDiscount = {{ $carts->filter(function($cart) { 
                return $cart->product->is_free == 1; 
            })->sum(function($cart) { 
                $price = $cart->power_status == 'no_power' ? $cart->product->no_power_price : $cart->product->price;
                return $price * $cart->pair; 
            }) }};

            var deliveryFee = $('#deliveryFee').text();

            var tax = $('#tax').text();

            if (promoCode) {
                $.ajax({
                    url: "{{ route('promo.verify') }}", // Promo code verification route
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        promo_code: promoCode,
                        subtotal: subtotal
                    },
                    success: function(response) {
                        if (response.success) {
                            // Apply promo discount and add existing discount
                            var discountAmount = parseFloat(response.discount) + parseFloat(existingDiscount);
                            var newTotal = parseFloat(subtotal) + parseFloat(deliveryFee) - discountAmount + parseFloat(tax);

                            // Round and format the values properly
                            discountAmount = discountAmount.toFixed(2); // Round to 2 decimal places
                            newTotal = newTotal.toFixed(2); // Round to 2 decimal places

                            // Update the discount and total on the page
                            $('#promoMessage').text(response.message).removeClass('text-danger').addClass('text-success');
                            $('#discount').text(discountAmount); // Display discount
                            $('#total').text(newTotal + ' BDT'); // Display total price

                            $('#promoInputGroup').css('display', 'none');

                            var promoInfoHtml = `
                                <div id="promoInfo" class="alert alert-success mt-3">
                                    <p>Promo code <strong>${promoCode}</strong> applied! You saved ${discountAmount} BDT.</p>
                                    <button id="removePromo" class="btn btn-danger">Remove Promo Code</button>
                                </div>
                            `;
                            $('#promoShow').html(promoInfoHtml);

                            $('#removePromo').on('click', function() {
                                removePromoCode(subtotal, deliveryFee);
                            });
                        } else {
                            $('#promoMessage').text(response.message).removeClass('text-success').addClass('text-danger');
                        }
                    },
                    error: function() {
                        $('#promoMessage').text('Error applying promo code. Please try again.').addClass('text-danger');
                    }
                });
            }
        }

        // Delivery fee change event
        $('input[name="delivery"]').on('change', function() {
            var selectedDeliveryFee = parseFloat($(this).val());

            $('#deliveryFee').text(selectedDeliveryFee + ' BDT');

            var subtotal = {{ $carts->sum(function($cart) {
                $price = $cart->power_status == 'no_power' ? $cart->product->no_power_price : $cart->product->price;
                return $price * $cart->pair;
            }) }};

            var existingDiscount = {{ $carts->filter(function($cart) { 
                return $cart->product->is_free == 1; 
            })->sum(function($cart) {
                $price = $cart->power_status == 'no_power' ? $cart->product->no_power_price : $cart->product->price;
                return $price * $cart->pair;
            }) }};

            var tax = $('#tax').text();

            var deliveryFee = selectedDeliveryFee;

            var newTotal = selectedDeliveryFee + subtotal - existingDiscount + parseFloat(tax);
            $('#total').text(newTotal.toFixed(2) + ' BDT'); // Update total

            // Automatically apply the promo code whenever the delivery fee changes
            applyPromoCode(); // Call the function to apply the promo code
        });
        
        // Apply Promo Code button event
        $('#applyPromo').on('click', applyPromoCode);

        // Remove Promo Code Function (Client-side only)
        function removePromoCode(subtotal, deliveryFee) {
            
            var existingDiscount = {{ $carts->filter(function($cart) { 
                return $cart->product->is_free == 1; 
            })->sum(function($cart) {
                $price = $cart->power_status == 'no_power' ? $cart->product->no_power_price : $cart->product->price;
                return $price * $cart->pair;
            }) }};
            $('#discount').text(existingDiscount);
            var tax = $('#tax').text();
            var resetTotal = parseFloat(subtotal) + parseFloat(deliveryFee) + parseFloat(tax) -existingDiscount; // Reset total
            $('#total').text(resetTotal.toFixed(2) + ' BDT'); // Update total

            // Show the promo input and button again
            $('#promoInputGroup').css('display', 'block'); // Show promo input

            // Remove the promo info card
            $('#promoInfo').remove();

            // Optionally show a message that the promo code was removed
            $('#promoMessage').text('Promo code removed successfully.').removeClass('text-danger').addClass('text-success');
        }
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