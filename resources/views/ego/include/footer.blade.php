<style>
    .footer h5 {
        color: black;
    }

    .footer .col-md-4 {
        padding: 10px;
    }

    .footer .form-control {
        border-radius: 0;
    }

    .footer .btn-primary {
        background-color: rgba(132, 98, 170, 1);
        border-color: rgba(132, 98, 170, 1);
    }

    .footer a {
        color: black;
    }

    .footer a:hover {
        text-decoration: underline;
    }

    @keyframes glance {

        0%,
        100% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }
    }

    .footer {
        background: #f5f5f5;
        background-size: 200% 200%;
        animation: glance 5s ease infinite;
    }
</style>

<style>
    .footer {
        position: relative;
        /* background-color: #f5f5f5; */
        overflow: hidden;
        padding-top: 20px;
        /* Adjust if needed */
    }

    @keyframes moveLine {
        0% {
            left: -100%;
        }

        100% {
            left: 100%;
        }
    }

    .hidden {
        display: none;
    }

    .form-check-input:checked+.form-check-label .bi {
        color: #6c6c85;
        ;
    }

    .form-check-input:checked {
        background-color: black;
        border-color: black;
    }

    .btn-primary:disabled {
        background-color: #ccc;
        border-color: #ccc;
    }



    .form-control::placeholder {
        color: black;
        opacity: 1;
        /* Override browser default */
    }

    .form-control {
        background-color: #f5f5f5;
        border: 1px solid #8669AE;
    }

    .accordion-button {
        background-color: #f5f5f5;
        color: black;
    }

    .accordion-item {
        background-color: #f5f5f5;
        color: black;
    }

    .accordion-button:not(.collapsed) {
        background-color: #f5f5f5;
        color: black;


    }


    footer h5 {
        margin-bottom: 20px;
        font-size: 1.2rem;
        color: #fff;
    }

    .social-icons a {
        margin: 0 10px;
        font-size: 1.5rem;
        transition: color 0.3s;
    }

    .social-icons a:hover {
        color: #E9814C;
    }

    .payment-icons img {
        width: 60px;
        margin: 10px;
        transition: transform 0.3s;
    }

    .payment-icons img:hover {
        transform: scale(1.1);
    }

    .payment-icons img {
        width: 45px;
        /* Adjust size as needed */
        margin: 10px;
        /* Add spacing between icons */
        border-radius: 5px;
        /* Rounded corners for a card-like effect */
        box-shadow: 0 0 10px rgba(15, 15, 15, 0.1);
        /* Subtle shadow for depth */
        background-color: #f5f5f5;

        padding: 10px;
        /* Padding inside the card */
    }
</style>

<footer class="footer mt-5">
    <div class="mt-2"></div>
    <div class="container">
        <div class="row">
            <!-- Left Side -->
            <div class="col-md-4">
                <h5>@lang('messages.first_order')</h5>
                <p class="text-black">
                    @lang('messages.PROMOTION')
                </p>
                <div class="input-group mb-3">
                    <input id="emailInput" type="email" class="form-control" placeholder="Email address" aria-label="Email address" style=" border: 1px solid black;">
                </div>
                <div id="subscribeSection" class="hidden">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" value="" id="privacyPolicyCheck">
                        <label class="form-check-label text-white" for="privacyPolicyCheck">
                            <i class="bi .bi-check-circle-fill"></i> <span class="text-dark">@lang('messages.promotion_next')</span>
                        </label>
                    </div>
                    <button id="subscribeButton" class="btn btn-dark" type="button" disabled>@lang('messages.SUBSCRIBE')</button>
                </div>
            </div>
            <!-- Middle Side -->
            <div class="col-md-4">
                <!-- <div class="dropdown ">
                    <a style="border-radius: 0px;text-decoration: none" class=" dropdown-toggle " type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        @lang('messages.Currency')
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <small class="dropdown-item "> @lang('messages.Dollar')</small>
                        <small class="dropdown-item ">@lang('messages.Euro')</small>
                    </div>
                </div> -->
                <div class="dropdown mt-2">
                    <a style="border-radius: 0px;text-decoration: none;" class=" dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        @lang('messages.language')

                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <small class="dropdown-item">English</small>
                        <small class="dropdown-item">Bangla</small>
                        <small class="dropdown-item">India</small>
                        <small class="dropdown-item">chineess</small>
                        <small class="dropdown-item">Russia</small>
                    </div>
                </div>
            </div>
            <!-- Right Side -->
            <div class="col-md-4">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed text-white" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                <span class="text-dark">@lang('messages.company_name')</span>
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <a href="{{ route('policy.pages', ['id' => 43, 'slug' => 'terms_and_conditions']) }}" style="text-decoration: none;">Terms and Conditions</a><br>
                                <a href="{{ route('policy.pages', ['id' => 42, 'slug' => 'policy_pages']) }}" style="text-decoration: none;">Privacy Policy</a><br>
                                <a href="#" style="text-decoration: none;">Cookie Policy</a><br>
                                <a href="#" style="text-decoration: none;">Cookie Settings</a><br>
                                <a href="#" style="text-decoration: none;">Counterfeit Education</a><br>
                                <a href="#" style="text-decoration: none;">Store Locator</a>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed text-white" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                <span class="text-dark">@lang('messages.CUSTOMER')</span>
                            </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <a href="#" style="text-decoration: none;">How To Order</a><br>
                                <a href="#" style="text-decoration: none;">FAQ</a><br>
                                <a href="{{ route('policy.pages', ['id' => 46, 'slug' => 'shipping-and-delivery']) }}" style="text-decoration: none;">Shipping & Delivery</a><br>
                                <a href="#" style="text-decoration: none;">Currency Converter</a><br>
                                <a href="{{ route('policy.pages', ['id' => 45, 'slug' => 'returns-exchanges-refund-policy']) }}" style="text-decoration: none;">Return Policy</a><br>
                                <a href="#" style="text-decoration: none;">Contact us</a>
                                <a href="#" style="text-decoration: none;">Promotions</a>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed text-white" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                <span class="text-dark">@lang('messages.More_about_lenses')</span>
                            </button>
                        </h2>
                        <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <a href="#" style="text-decoration: none;">How to Use your Lenses</a><br>
                                <a href="#" style="text-decoration: none;">How To Read Your Prescription</a><br>
                                <a href="#" style="text-decoration: none;">Package Insert & fitting guides</a><br>
                                <a href="#" style="text-decoration: none;">RX Verification for US residents</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container text-center">
            <div class="row">
                <div class="col-md-12">
                    <h5>@lang('messages.follow')</h5>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-pinterest"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <h5>@lang('messages.payment')</h5>
                    <!-- <div class="payment-icons">
                        <img src="{{asset('ego/gplay.svg')}}" alt="Visa">
                        <img src="{{asset('ego/iphone.svg')}}" alt="American Express">
                        <img src="{{asset('ego/american.svg')}}" alt="Google Pay">
                        <img src="{{asset('ego/american2.svg')}}" alt="Apple Pay">
                        <img src="{{asset('ego/anoutherbank1.svg')}}" alt="Mastercard">
                        <img src="{{asset('ego/visa.svg')}}" alt="PayPal">
                        <img src="{{asset('ego/express.svg')}}" alt="Discover">
                    </div> -->
                    <img src="{{asset('ego/footer_pay.png')}}" width="100%" height="auto" alt="">
                </div>
            </div>
        </div>
    </div>
</footer>