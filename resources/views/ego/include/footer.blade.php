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
        background-color: transparent;
        color: black;
    }

    .accordion-item {
        background-color: transparent;
        color: black;
    }

    .accordion-button:not(.collapsed) {
        background-color: transparent;
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
@php
use App\Helpers\TranslationHelper;
$preferredLanguage = session('preferredLanguage');

$getOffer = TranslationHelper::translateText('Get 10% OFF on your first order!', $preferredLanguage);
$subsTitle = TranslationHelper::translateText('By signing up for, we will keep you informed by email on all the latest news and promotions.', $preferredLanguage);

$policyTExt = TranslationHelper::translateText('I have read and accept the privacy policy', $preferredLanguage);
$subsBtn = TranslationHelper::translateText('SUBSCRIBE', $preferredLanguage);

$companyInfo = TranslationHelper::translateText('COMPANY INFORMATION', $preferredLanguage);
$terms = TranslationHelper::translateText('Terms and Conditions', $preferredLanguage);
$policy = TranslationHelper::translateText('Privacy Policy', $preferredLanguage);
$cookieP = TranslationHelper::translateText('Cookie Policy', $preferredLanguage);
$cookieS = TranslationHelper::translateText('Cookie Settings', $preferredLanguage);
$store = TranslationHelper::translateText('Store Locator', $preferredLanguage);


$cusCare = TranslationHelper::translateText('CUSTOMER CARE', $preferredLanguage);

$Hto = TranslationHelper::translateText('How To Order', $preferredLanguage);
$faq = TranslationHelper::translateText('FAQ', $preferredLanguage);
$shippingDel = TranslationHelper::translateText('Shipping & Delivery', $preferredLanguage);
$deletionPolicy = TranslationHelper::translateText('Deletion Policy', $preferredLanguage);
$return = TranslationHelper::translateText('Return Policy', $preferredLanguage);
$contactPromo = TranslationHelper::translateText('Contact us', $preferredLanguage);

$moreAbourLenses = TranslationHelper::translateText('More about lenses', $preferredLanguage);
$howtouse = TranslationHelper::translateText('How to Use your Lenses', $preferredLanguage);
$howtoread = TranslationHelper::translateText('How To Read Your Prescription', $preferredLanguage);
$packageInsert = TranslationHelper::translateText('Package Insert & fitting guides', $preferredLanguage);
$rxVer = TranslationHelper::translateText('RX Verification for US residents', $preferredLanguage);

$followUs = TranslationHelper::translateText('Follow Us', $preferredLanguage);
$acceptPay = TranslationHelper::translateText('Accepted Payment Methods', $preferredLanguage);
@endphp
<footer class="footer mt-5">
    <div class="mt-2"></div>
    <div class="container d-block">
        <div class="row">
            <!-- Left Side -->
            <div class="col-md-4">
                <form action="{{route('subscribe.store.email')}}" method="post">
                    @csrf
                    <h5 class="getoffer">{{$getOffer}}</h5>
                    <p class=" subsTitle">
                        {{$subsTitle}}
                    </p>
                    <div class="input-group mb-3">
                        <input id="emailInput" type="email" class="form-control" placeholder="Email address" aria-label="Email address" style=" border: 1px solid black;" name="email">
                    </div>
                    <div id="subscribeSection" class="hidden">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="privacyPolicyCheck" required>
                            <label class="form-check-label " for="privacyPolicyCheck">
                                <i class="bi .bi-check-circle-fill"></i> <span class="policyTExt">{{$policyTExt}}</span>
                            </label>
                        </div>
                        <button id="subscribeButton" class="btn btn-dark" type="submit" disabled>{{$subsBtn}}</button>
                    </div>
                </form>
            </div>
            <!-- Middle Side -->
            <div class="col-md-4">
                <div class="dropdown mt-2 d-flex justify-content-center">
                    <form id="lang-form" style="width: max-content" action="{{route('change.lang')}}" method="post">
                        @csrf
                        <select onchange="document.getElementById('lang-form').submit();" name="code" style="width: 100%; background-color: transparent !important; border: 0; padding: 0 20px">
                            <option value="en" {{ session('preferredLanguage') == 'en' ? 'selected' : '' }}>English</option>
                            <option value="hi" {{ session('preferredLanguage') == 'hi' ? 'selected' : '' }}>Hindi</option>
                            <option value="ru" {{ session('preferredLanguage') == 'ru' ? 'selected' : '' }}>Russian</option>
                            <option value="zh" {{ session('preferredLanguage') == 'zh' ? 'selected' : '' }}>Chinese</option>
                            <option value="bn" {{ session('preferredLanguage') == 'bn' ? 'selected' : '' }}>Bengali</option>
                        </select>
                    </form>

                </div>
            </div>
            <!-- Right Side -->
            <div class="col-md-4 " style="background-color:transform">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                <span >{{$companyInfo}}</span>
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <a href="{{ route('policy.pages', ['id' => 43, 'slug' => 'terms_and_conditions']) }}" style="text-decoration: none;">{{$terms}}</a><br>
                                <a href="{{ route('policy.pages', ['id' => 42, 'slug' => 'policy_pages']) }}" style="text-decoration: none;">{{$policy}}</a><br>
                                <a href="{{ route('policy.pages', ['id' => 43, 'slug' => 'terms_and_conditions']) }}#cookie" style="text-decoration: none;">{{$cookieP}}</a><br>
                                <a href="#" style="text-decoration: none;">{{$cookieS}}</a><br>
                                <a href="#" style="text-decoration: none;">{{$store}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                <span >{{$cusCare}}</span>
                            </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <a href="#" style="text-decoration: none;">{{$Hto}}</a><br>
                                <a href="#" style="text-decoration: none;">{{$faq}}</a><br>
                                <a href="{{ route('policy.pages', ['id' => 46, 'slug' => 'shipping-and-delivery']) }}" style="text-decoration: none;">{{$shippingDel}}</a><br>
                                <a href="{{ route('policy.pages', ['id' => 47, 'slug' => 'deletion-policy']) }}" style="text-decoration: none;">{{$deletionPolicy}}</a><br>
                                <a href="{{ route('policy.pages', ['id' => 45, 'slug' => 'returns-exchanges-refund-policy']) }}" style="text-decoration: none;">{{$return}}</a><br>
                                <a href="{{route('contact')}}" style="text-decoration: none;">{{$contactPromo}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                <span >{{$moreAbourLenses}}</span>
                            </button>
                        </h2>
                        <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <a href="#" style="text-decoration: none;">{{$howtouse}}</a><br>
                                <a href="#" style="text-decoration: none;">{{$howtoread}}</a><br>
                                <a href="#" style="text-decoration: none;">{{$packageInsert}}</a><br>
                                <a href="#" style="text-decoration: none;">{{$rxVer}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container d-block text-center">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="followUs">{{$followUs}}</h5>
                    <div class="social-icons">
                        <a href="https://www.facebook.com/fashionoptics.store"><i class="fab fa-facebook-f" target="_blank"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.instagram.com/fashionoptics.store"><i class="fab fa-instagram" target="_blank"></i></a>
                        <a href="https://www.linkedin.com/company/76647866/admin/dashboard/" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-pinterest"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    <h5 class="acceptPay">{{$acceptPay}}</h5>
                    <img src="{{asset('ego/footer_pay.png')}}" width="100%" height="auto" alt="">
                </div>
            </div>
        </div>
    </div>
</footer>