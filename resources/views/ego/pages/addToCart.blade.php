@extends('layouts.ego-app')
@push('style')
<link rel="stylesheet" href="{{ asset('ego-assets/css/addToCart.css') }}">
@endpush
@section('content')
<style>
    .imageAlbum {
        margin-bottom: 10px;
        /* Default spacing */
    }

    .vertical-slider {
        padding: 10px;
        /* Default padding */
    }

    /* Mobile Styles */
    @media (max-width: 768px) {

        /* Adjust the max-width as needed */
        .imageAlbum {
            margin-bottom: 5px;
            /* Reduce spacing for mobile */
        }

        .vertical-slider {
            padding: 5px;
            /* Reduce padding for mobile */
        }
    }

    .tab-container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        margin-top: 10px;
    }
</style>
<br>
@php
use App\Helpers\TranslationHelper;
$preferredLanguage = session('preferredLanguage');
$noPower = TranslationHelper::translateText('No Power', $preferredLanguage);
$withPower = TranslationHelper::translateText('With Power', $preferredLanguage);
$pcs = TranslationHelper::translateText('Pcs', $preferredLanguage);
$powerBtn = TranslationHelper::translateText('I need 2 different powers', $preferredLanguage);
$firstEye = TranslationHelper::translateText('First eye', $preferredLanguage);
$secondEye = TranslationHelper::translateText('Second eye', $preferredLanguage);
$selectPower = TranslationHelper::translateText('Select Power', $preferredLanguage);
$addToCart = TranslationHelper::translateText('Add to Cart', $preferredLanguage);

$description = TranslationHelper::translateText('Description', $preferredLanguage);
$moreInfo = TranslationHelper::translateText('More Information', $preferredLanguage);
$powerRange = TranslationHelper::translateText('Power Range', $preferredLanguage);
$lensParam = TranslationHelper::translateText('Lens Parameters', $preferredLanguage);

$pack = TranslationHelper::translateText('Pack Content ', $preferredLanguage);
$diameter = TranslationHelper::translateText('Diameter', $preferredLanguage);
$base = TranslationHelper::translateText('Base curve', $preferredLanguage);
$material = TranslationHelper::translateText('Material', $preferredLanguage);
$water = TranslationHelper::translateText('Water content', $preferredLanguage);
$replacement = TranslationHelper::translateText('Replacement', $preferredLanguage);
$tone = TranslationHelper::translateText('Tones', $preferredLanguage);
$lensdesign = TranslationHelper::translateText('Lens Design', $preferredLanguage);
$step = TranslationHelper::translateText('Steps', $preferredLanguage);
$plano = TranslationHelper::translateText('Plano', $preferredLanguage);
$myopia = TranslationHelper::translateText('Myopia', $preferredLanguage);
$hyperopia = TranslationHelper::translateText('Hyperopia', $preferredLanguage);
$relatedProduct = TranslationHelper::translateText('Related Products', $preferredLanguage);
@endphp
<div class="row" style="margin-top:150px">
    <div class="col-md-1">
        <div class="vertical-slider" style="cursor: pointer; padding: 10px;">
            <div class="d-flex justify-content-end">
                <img src="{{ asset($product->image_path) }}" class="img-fluid imageAlbum" style="margin-bottom: 10px; margin-left: 0; margin-right: 0">
            </div>
            @foreach ($product->images as $image)
            <div class="d-flex justify-content-end">
                <img src="{{ asset($image->image_path) }}" class="img-fluid imageAlbum" style="margin-bottom: 10px; margin-left: 0; margin-right: 0">
            </div>
            @endforeach
        </div>
    </div>

    <style>
        .main-image-container {
    overflow: hidden;
    position: relative;
}

.main-image-container .main-image {
    transition: transform 0.3s ease; /* Smooth transition */
    cursor: zoom-in;
}

.main-image-container:hover .main-image {
    transform: scale(1.5); /* Adjust scale as needed */
}

    </style>
    <!-- Middle Column - Vertical Images -->
    <div class="col-md-6">
        <div class="main-image-container">
            <img id="mainImage" src="{{ asset($product->image_path) }}" class="main-image img-fluid w-100"
                alt="Main Display" />
        </div>
    </div>


    <!-- Right Column - Add to Cart Section -->
    <div class="col-md-5 right-column py-5">
        <div class="add-to-cart-section">
            <h1>
                <span>{{ $product->name }}</span>
            </h1>
            <div>
                {!! $product->product_intro !!}
            </div>
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="tab-container mx-auto">
                @if ($product->product_type == 'normal')
                <div class="tab p-4" id="tab1" onclick="selectTab('tab1-radio')">
                    <div class="tab-content">
                        <input type="radio" id="tab1-radio" name="power_type" value="no_power" @if($product->product_type == 'normal') checked @endif
                        style="width: 20px; height: 15px;" />
                        <label for="tab1-radio" style="font-size: 14px">{{$noPower}}</label>
                    </div>
                </div>

                <div class="tab p-4 mx-2" id="tab2" onclick="selectTab('tab2-radio')">
                    <div class="tab-content">
                        <input type="radio" id="tab2-radio" name="power_type" value="with_power"
                            style="width: 20px; height: 15px;" />
                        <label for="tab2-radio" style="font-size: 14px">{{$withPower}}</label>
                    </div>
                </div>
                @endif
                <div class="tab p-4" id="tab1" style="visibility: hidden; height: 0; margin-bottom: 0">
                    <div class="tab-content">
                        <input type="radio" id="tab1-radio" name="power_type" value="no_power"
                            style="width: 20px; height: 20px; margin: 10px" @if($product->product_type == 'accessories') checked @endif/>
                        <label for="tab1-radio">Accessories</label>
                    </div>
                </div>
            </div>

            <div class="mt-2" id="pair-state" style="background-color: #f5f5f5">
                <div class="p-3">
                    <fieldset class="pair-fieldset">
                        <legend class="float-none w-auto">{{$pcs}}</legend>
                        <div class="product-count">
                            <button id="decrement" style="font-size: 10px;">
                                <span style="font-size: 25px">-</span>
                            </button>
                            <span id="quantity" style="font-size: 20px" data-quantity="1">1</span>
                            <button id="increment">
                                <span style="font-size: 25px">+</span>
                            </button>
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="with-power-state mt-2" id="with-power-state">
                <div class="container">
                    <div class="d-flex align-items-center">
                        <button type="button" class="toggle-btn big-btn" data-target="#home" aria-controls="home">
                            <i class="fas fa-toggle-off"></i>
                        </button>
                        <p class="ml-3 mb-0">{{$powerBtn}}</p>
                    </div>
                </div>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="eye-section open-content">
                                    <h6 class="text-center">{{$firstEye}}</h6>
                                    <form>
                                        <select class="power-select" id="firstPower">
                                            <option value="">{{$selectPower}}</option>
                                            @foreach ($powers as $power)
                                            <option value="{{ $power }}">
                                                {{ $power }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </form>
                                    <div class="power-section">
                                        <span class="power-value">0.50</span>
                                        <div class="adjustment-btns text-center">
                                            <fieldset class="pair-fieldset-main">
                                                <legend class="float-none w-auto p-2">{{$pcs}}</legend>
                                                <div class="product-count">
                                                    <button class="btn decrease-btn">-</button>
                                                    <span class="quantity-btn" data-quantity="1"
                                                        id="firstPair">1</span>
                                                    <button class="btn increase-btn">+</button>
                                                </div>
                                            </fieldset>
                                            <h6 class="text-center mt-3 total-price-section"></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="eye-section closed-content">
                                    <h6 class="text-center">{{$secondEye}}</h6>
                                    <form>
                                        <select class="power-select" id="secondPower">
                                            <option value="">{{$selectPower}}</option>
                                            @foreach ($powers as $power)
                                            <option value="{{ $power }}">
                                                {{ $power }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </form>
                                    <div class="power-section">
                                        <span class="power-value">0.50</span>
                                        <div class="adjustment-btns text-center">
                                            <fieldset class="pair-fieldset-main">
                                                <legend class="float-none w-auto p-2">{{$pcs}}</legend>
                                                <div class="product-count">
                                                    <button class="btn decrease-btn-two">-</button>
                                                    <span class="quantity-btn-two" data-quantity="1"
                                                        id="secondPair">1</span>
                                                    <button class="btn increase-btn-two">+</button>
                                                </div>
                                            </fieldset>
                                            <h6 class="text-center mt-3 total-price-section"></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <button class="add-to-cart-button w-100 mt-4" id="add-to-cart">{{$addToCart}} - <span
                    id="total-price">{{ $product->no_power_price }}</span> BDT</button>
        </div>
        <!-- description -->
        <div
            style="
                width: 100%;
                margin: 50px auto;
                border-top: 1px solid #ddd;
                border-bottom: 1px solid #ddd;
                position: relative;
                ">
            <!-- Vertical Center Border -->
            <div
                style="
                position: absolute;
                top: 0;
                bottom: 0;
                left: 50%;
                width: 1px;
                background-color: #ddd;
                transform: translateX(-50%);
                ">
            </div>

            <!-- First Row -->
            <div
                style="
                display: flex;
                justify-content: space-between;
                border-bottom: 1px solid #ddd;
                padding: 10px 0;
                ">
                <div style="flex: 1;">
                    <a class="open-custom-sidebar" href="#"
                        style="text-decoration: none; color: black;">{{$description}}</a>
                </div>

                <!-- Custom Sidebar Modal -->
                <div class="custom-sidebar">
                    <div class="sidebar-header"
                        style="border-bottom: 1px solid #e0e0e0; display: flex; justify-content: space-between; align-items: center; padding: 10px;">
                        <a class="navbar-brand" href="#"
                            style="font-size: 18px; display: flex; align-items: center; text-decoration: none; color: #000;">
                            <span style="font-size: 18px; margin-left: 10px; margin-top:-55px">{{$description}}</span>
                        </a>
                        <span class="custom-closebtn" style="font-size: 24px; cursor: pointer;">&times;</span>
                    </div>
                    <div class="custom-accordion">
                        {!! $product->description !!}
                    </div>
                </div>

                <div
                    style="
                    width: 30px;
                    font-weight: bold;
                    padding-left: 10px;
                ">
                    +
                </div>
                <div style="flex: 1; padding-left: 20px;">
                    <a class="open-custom-sidebar" href="#" style="text-decoration: none; color: black;">{{$moreInfo}}</a>
                </div>
                <div
                    style="
                    width: 30px;
                    font-weight: bold;
                    padding-left: 10px;
                ">
                    +
                </div>
            </div>

            <!-- More Information Sidebar -->
            <div class="custom-sidebar">
                <div class="sidebar-header"
                    style="border-bottom: 1px solid #e0e0e0; display: flex; justify-content: space-between; align-items: center; padding: 10px;">
                    <a class="navbar-brand" href="#"
                        style="font-size: 18px; display: flex; align-items: center; text-decoration: none; color: #000;">
                        <span style="font-size: 18px; margin-left: 10px; margin-top:-55px">{{$moreInfo}}</span>
                    </a>
                    <span class="custom-closebtn" style="font-size: 24px; cursor: pointer;">&times;</span>
                </div>
                <div class="custom-accordion">
                    <!-- Content for More Information -->
                    <table class="table mt-2">
                        <tbody>
                            <tr>
                                <td class="table-secondary">{{$pack}}</td>
                                <td>{{$product->pack_content}}</td>
                            </tr>
                            <tr>
                                <td class="table-secondary">{{$diameter}}</td>
                                <td>{{@$product->diameter->name}}</td>
                            </tr>
                            <tr>
                                <td class="table-secondary">{{$base}}</td>
                                <td>{{@$product->baseCurve->name}}</td>
                            </tr>
                            <tr>
                                <td class="table-secondary">{{$material}}</td>
                                <td>{{@$product->material->name}}</td>
                            </tr>
                            <tr>
                                <td class="table-secondary">{{$water}}</td>
                                <td>{{@$product->water_content}}</td>
                            </tr>
                            <tr>
                                <td class="table-secondary">{{$replacement}}</td>
                                <td>{{@$product->duration->name}}</td>
                            </tr>
                            <tr>
                                <td class="table-secondary">{{$tone}}</td>
                                <td>{{@$product->tone->name}}</td>
                            </tr>
                            <tr>
                                <td class="table-secondary">{{$lensdesign}}</td>
                                <td>{{@$product->lensDesign->name}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div
                style="
                display: flex;
                justify-content: space-between;
                padding: 10px 0;
                ">
                <div style="flex: 1;">
                    <a class="open-custom-sidebar" href="#" style="text-decoration: none; color: black;">{{$powerRange}}</a>
                </div>
                <div
                    style="
                    width: 30px;
                    font-weight: bold;
                    padding-left: 10px;
                ">
                    +
                </div>
                <div style="flex: 1; padding-left: 20px;">
                    <a class="open-custom-sidebar" href="#" style="text-decoration: none; color: black;">{{$lensParam}}</a>
                </div>
                <div
                    style="
                    width: 30px;
                    font-weight: bold;
                    padding-left: 10px;
                ">
                    +
                </div>
            </div>

            <div class="custom-sidebar">
                <div class="sidebar-header"
                    style="border-bottom: 1px solid #e0e0e0; display: flex; justify-content: space-between; align-items: center; padding: 10px;">
                    <a class="navbar-brand" href="#"
                        style="font-size: 18px; display: flex; align-items: center; text-decoration: none; color: #000;">
                        <span style="font-size: 18px; margin-left: 10px; margin-top:-55px">{{$powerRange}}</span>
                    </a>
                    <span class="custom-closebtn" style="font-size: 24px; cursor: pointer;">&times;</span>
                </div>
                <div class="custom-accordion">

                    <table class="table mt-4">
                        <tbody>
                            <tr class="table-dark">
                                <td></td>
                                <td>{{$powerRange}}</td>
                                <td>{{$step}}</td>
                            </tr>
                            <tr class="table-secondary">
                                <td>{{$plano}}</td>
                                <td>0.00</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td rowspan="2">{{$myopia}}</td>
                                <td>-0.50 to -6.00</td>
                                <td>in 0.25 {{$step}}</td>
                            </tr>
                            <tr>
                                <td>-6.50 to -10.00</td>
                                <td>in 0.50 {{$step}}</td>
                            </tr>
                            <tr class="table-secondary">
                                <td rowspan="2">{{$hyperopia}}</td>
                                <td>+0.50 to +6.00</td>
                                <td>in 0.25 {{$step}}</td>
                            </tr>
                            <tr class="table-secondary">
                                <td>+6.50 to +10.00</td>
                                <td>in 0.50 {{$step}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Lens Parameters Sidebar -->
            <div class="custom-sidebar">
                <div class="sidebar-header"
                    style="border-bottom: 1px solid #e0e0e0; display: flex; justify-content: space-between; align-items: center; padding: 10px;">
                    <a class="navbar-brand" href="#"
                        style="font-size: 18px; display: flex; align-items: center; text-decoration: none; color: #000;">
                        <span style="font-size: 18px; margin-left: 10px; margin-top:-55px">{{$lensParam}}</span>
                    </a>
                    <span class="custom-closebtn" style="font-size: 24px; cursor: pointer;">&times;</span>
                </div>
                <div class="custom-accordion">
                    <!-- Content for Lens Parameters -->
                    {!! $product->lens_params !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mt-5 container-fluid">
    <div class="row">
    <div class="col-1"></div>
        <div class="col-11">
            <h1>
                <span>{{$relatedProduct}}</span>
            </h1>
        </div>
        <div class="col-1"></div>
        <div class="col-10">
            <div class="product-slider d-flex flex-nowrap overflow-hidden ">
                @foreach($relatedProducts as $relatedProduct)
                <div class="card-product-slider mx-2 mb-5">

                    <div class="card-product-slider-img-wrapper ">
                        <img src="{{asset($relatedProduct->image_path)}}" style="width: 100%; height: auto" class="card-product-slider-img-top" alt="...">
                        <a href="{{ route('addToCart.index', $relatedProduct->id) }}" class="stretched-link"></a>
                        <div class="card-product-slider-icons">
                            <i class="fas fa-heart"></i>
                            <i class="fas fa-share"></i>
                        </div>
                    </div>
                    <div class="card-product-slider-body">
                        <h5 class="card-product-slider-title">{{ $relatedProduct->name }}</h5>
                        <small class="price">{{ $relatedProduct->price }} BDT</small>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-1"></div>
    </div>
</div>
<div class="lightbox" id="lightbox">
    <img src="" alt="Lightbox Image" id="lightbox-img" />
</div>
<!-- <div class="overlay-sidebar" style="z-index: 1;" id="overlay-sidebar"></div> -->
@endsection
@push('script')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

<!-- Quantity update js -->
<script>
    const productPrice = {{ $product->price ?? 0 }};
    const productNoPowerPrice = {{ $product->no_power_price ?? 0 }};
    let globalTotalPrice = productNoPowerPrice;
    const addToCartButton = document.getElementById("total-price");
    const addBtn = document.getElementById('add-to-cart');
    let quantity = 1;

    function selectTab(tabId) {
        document.getElementById(tabId).checked = true;
        if (tabId === 'tab1-radio') {
            updateSimpleTotalPrice();
            quantity = 1;
            document.getElementById("quantity").textContent = quantity;
        } else {
            addToCartButton.textContent = productPrice.toFixed(2);
            globalTotalPrice = productPrice;
            quantity = 0;
            document.getElementById("quantity").textContent = quantity;
        }
        updateAddToCartButton();
    }

    function updateSimpleTotalPrice() {
        globalTotalPrice = (quantity * productNoPowerPrice).toFixed(2);
        addToCartButton.textContent = globalTotalPrice;
        updateAddToCartButton();
    }

    function updateAddToCartButton() {
        addToCartButton.textContent = parseFloat(globalTotalPrice).toFixed(2);
        addBtn.disabled = globalTotalPrice === 0;
    }

    document.getElementById("increment").addEventListener("click", () => {
        quantity++;
        document.getElementById("quantity").textContent = quantity;
        updateSimpleTotalPrice();
    });

    document.getElementById("decrement").addEventListener("click", () => {
        if (quantity > 1) {
            quantity--;
            document.getElementById("quantity").textContent = quantity;
            updateSimpleTotalPrice();
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        updateSimpleTotalPrice();

        document.querySelectorAll(".toggle-btn").forEach((button) => {
            button.addEventListener("click", calculateGlobalTotalPrice);
        });

        attachQuantityListeners();
    });

    function attachQuantityListeners() {
        document.querySelectorAll(".increase-btn, .increase-btn-two").forEach((button) => {
            button.addEventListener("click", function() {
                const quantityClass = button.classList.contains('increase-btn') ? '.quantity-btn' : '.quantity-btn-two';
                const quantityElement = this.parentElement.querySelector(quantityClass);
                let currentQuantity = parseInt(quantityElement.textContent) || 1;
                quantityElement.textContent = ++currentQuantity;
                updateDisplayedTotal(this, quantityClass);
            });
        });

        document.querySelectorAll(".decrease-btn, .decrease-btn-two").forEach((button) => {
            button.addEventListener("click", function() {
                const quantityClass = button.classList.contains('decrease-btn') ? '.quantity-btn' : '.quantity-btn-two';
                const quantityElement = this.parentElement.querySelector(quantityClass);
                let currentQuantity = parseInt(quantityElement.textContent) || 1;
                if (currentQuantity > 1) quantityElement.textContent = --currentQuantity;
                updateDisplayedTotal(this, quantityClass);
            });
        });
    }

    function updateDisplayedTotal(button, quantityClass) {
        const quantityElement = button.parentElement.querySelector(quantityClass);
        const currentQuantity = parseInt(quantityElement.textContent) || 1;
        const totalPriceElement = button.closest('.adjustment-btns').querySelector('.total-price-section');
        const calculatedTotal = (currentQuantity * productPrice).toFixed(2);
        totalPriceElement.textContent = `Taka: ${calculatedTotal} BDT`;
        calculateGlobalTotalPrice();
    }

    function calculateGlobalTotalPrice() {
        globalTotalPrice = 0;
        document.querySelectorAll(".total-price-section").forEach((priceElement) => {
            const totalText = priceElement.textContent.match(/([\d.]+)/);
            if (totalText) globalTotalPrice += parseFloat(totalText[1]);
        });
        updateAddToCartButton();
    }
</script>

<script>
    $(document).ready(function() {
        $('.imageAlbum').click(function() {
            let imagePath = $(this).attr('src');
            $('#mainImage').attr('src', imagePath)
        });
    });
</script>

<script>
    // Function to handle selector change and button visibility
    function handlePowerSelectChange(select) {
        const selectedValue = select.value;
        const powerValueSpan = select.parentElement.nextElementSibling.querySelector(".power-value");
        powerValueSpan.textContent = selectedValue;

        const adjustmentBtns = select.parentElement.nextElementSibling.querySelector(".adjustment-btns");
        adjustmentBtns.style.display = "block";
    }

    // Add event listeners for power selectors
    document.querySelectorAll(".power-select").forEach((select) => {
        select.addEventListener("change", function() {
            handlePowerSelectChange(this);
        });
    });

    // Toggle content visibility
    document.querySelectorAll(".toggle-btn").forEach((button) => {
        button.addEventListener("click", function() {
            const target = document.querySelector(this.getAttribute("data-target"));
            const openContent = target.querySelector(".open-content");
            const closedContent = target.querySelector(".closed-content");

            if (closedContent.style.display === "none" || closedContent.style.display === "") {
                closedContent.style.display = "block"; // Show the closed content
                this.querySelector("i").classList.remove("fa-toggle-off");
                this.querySelector("i").classList.add("fa-toggle-on");
            } else {
                closedContent.style.display = "none"; // Hide the closed content
                this.querySelector("i").classList.remove("fa-toggle-on");
                this.querySelector("i").classList.add("fa-toggle-off");
            }
        });
    });
</script>




<script>
    $(document).ready(function() {
        // Initialize vertical slider
        $(".vertical-slider").slick({
            slidesToShow: 5,
            slidesToScroll: 3,
            vertical: true,
            verticalSwiping: true,
            arrows: false,
            responsive: [{
                breakpoint: 768,
                settings: {
                    vertical: false,
                    verticalSwiping: false,
                },
            }, ],
        });
        $(".vertical-slider img").click(function() {
            var imgSrc = $(this).attr("data-src");
            $(".main-image").attr("src", imgSrc);
        });

        // Show lightbox on main image click
        $(".main-image").click(function() {
            var imgSrc = $(this).attr("src");
            $("#lightbox-img").attr("src", imgSrc);
            $("#lightbox").addClass("active");
        });

        // Hide lightbox on click
        $("#lightbox").click(function() {
            $(this).removeClass("active");
        });
    });

    document.querySelectorAll(".tab").forEach((tab) => {
        tab.addEventListener("click", () => {
            document
                .querySelectorAll(".tab")
                .forEach((t) => t.classList.remove("selected"));
            tab.classList.add("selected");

            // Hide all sections initially
            document.getElementById("pair-state").style.display = "none";
            document.getElementById("with-power-state").style.display = "none";

            // Check which tab is selected and show respective section
            if (tab.id === "tab1") {
                document.getElementById("pair-state").style.display = "block";
            } else if (tab.id === "tab2") {
                document.getElementById("with-power-state").style.display = "block";
            }
        });
    });
</script>

<script>
    const openSidebarBtns = document.querySelectorAll('.open-custom-sidebar');
    const closeSidebarBtns = document.querySelectorAll('.custom-closebtn');
    const sidebars = document.querySelectorAll('.custom-sidebar');

    const overlay = document.getElementById('overlay-sidebar');

    openSidebarBtns.forEach((btn, index) => {
        btn.addEventListener('click', function(event) {
            event.preventDefault();
            sidebars[index].classList.add('show');
            overlay.classList.add('show');
        });
    });

    closeSidebarBtns.forEach((btn, index) => {
        btn.addEventListener('click', function(event) {
            event.preventDefault();
            sidebars[index].classList.remove('show');
            overlay.classList.remove('show');
        });

        overlay.addEventListener('click', function(event) {
            event.preventDefault();
            sidebars[index].classList.remove('show');
        });
    });
</script>

<script>
    document.getElementById('add-to-cart').addEventListener('click', function() {
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var productId = document.querySelector('input[name="product_id"]').value;
        var powerType = document.querySelector('input[name="power_type"]:checked').value;
        var nopairQuantity = document.getElementById('quantity').innerText.trim();

        var firstEyePower = document.getElementById('firstPower').value;
        var firstEyeQuantityElement = document.getElementById('firstPair');
        var firstEyeQuantity = firstEyeQuantityElement ? firstEyeQuantityElement.innerText.trim() : null;

        var secondEyePower = document.getElementById('secondPower').value;
        var secondEyeQuantityElement = document.getElementById('secondPair');
        var secondEyeQuantity = secondEyeQuantityElement ? secondEyeQuantityElement.innerText.trim() : null;

        var data = {
            productId: productId,
            powerType: powerType,
            nopairQuantity: nopairQuantity,
            firstEyePower: firstEyePower,
            firstEyeQuantity: firstEyeQuantity,
            secondEyePower: secondEyePower,
            secondEyeQuantity: secondEyeQuantity,
            _token: csrfToken
        };

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/cart/add-to-cart', true);
        xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4) {
                console.log(xhr.responseText); // Log the raw response
                try {
                    var response = JSON.parse(xhr.responseText);

                    if (response.success) {
                        sessionStorage.setItem('cartMessage', response.message);
                        fetchCartCount();
                        window.location.reload();
                    } else {
                        sessionStorage.setItem('cartError', response.error || 'Unknown error');
                        alert('Failed to add to cart: ' + (response.error || 'Unknown error'));
                    }
                } catch (e) {
                    console.error('Invalid JSON response:', xhr.responseText);
                    alert('An error occurred while processing your request.');
                }
            }
        };
        xhr.send(JSON.stringify(data));
    });

    window.onload = function() {
        var message = sessionStorage.getItem('cartMessage');
        var error = sessionStorage.getItem('cartError');

        if (message) {
            alert(message);
            sessionStorage.removeItem('cartMessage');
        }

        if (error) {
            alert(error);
            sessionStorage.removeItem('cartError');
        }
    };
</script>


<script>
const mainImageContainer = document.querySelector('.main-image-container');
const mainImage = document.querySelector('.main-image');

mainImageContainer.addEventListener('mousemove', (e) => {
    const rect = mainImageContainer.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;
    mainImage.style.transformOrigin = `${x}px ${y}px`;
    mainImage.style.transform = 'scale(1.8)'; // Zoom in
});

mainImageContainer.addEventListener('mouseleave', () => {
    mainImage.style.transform = 'scale(1)'; // Reset zoom when mouse leaves
});
    </script>
@endpush