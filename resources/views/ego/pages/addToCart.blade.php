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

<div class="row" style="margin-top:150px">
    <div class="col-md-2">
        <div class="vertical-slider" style="cursor: pointer; padding: 10px;">
            <div>
                <img src="{{ asset($product->image_path) }}" class="img-fluid imageAlbum" style="margin-bottom: 10px;">
            </div>
            @foreach ($product->images as $image)
            <div>
                <img src="{{ asset($image->image_path) }}" class="img-fluid imageAlbum" style="margin-bottom: 10px;">
            </div>
            @endforeach
        </div>
    </div>
    <!-- Middle Column - Vertical Images -->
    <div class="col-md-5">
        <div class="main-image-container">
            <img id="mainImage" src="{{ asset($product->image_path) }}" class="main-image img-fluid"
                alt="Main Display" />
        </div>
    </div>
    <!-- Right Column - Add to Cart Section -->
    <div class="col-md-5 right-column p-5">
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
                        <label for="tab1-radio" style="font-size: 14px">No Power</label>
                    </div>
                </div>

                <div class="tab p-4 mx-2" id="tab2" onclick="selectTab('tab2-radio')">
                    <div class="tab-content">
                        <input type="radio" id="tab2-radio" name="power_type" value="with_power"
                            style="width: 20px; height: 15px;" />
                        <label for="tab2-radio" style="font-size: 14px">With Power</label>
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
                        <legend class="float-none w-auto">Pair</legend>
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
                        <p class="ml-3 mb-0">I need 2 different powers</p>
                    </div>
                </div>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="eye-section open-content">
                                    <h6 class="text-center">First eye</h6>
                                    <form>
                                        <select class="power-select" id="firstPower">
                                            <option value="">Select power</option>
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
                                                <legend class="float-none w-auto p-2">Pair</legend>
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
                                    <h6 class="text-center">Second eye</h6>
                                    <form>
                                        <select class="power-select" id="secondPower">
                                            <option value="">Select power</option>
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
                                                <legend class="float-none w-auto p-2">pair</legend>
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


            <button class="add-to-cart-button w-100 mt-4" id="add-to-cart">Add to Cart - <span
                    id="total-price">{{ $product->no_power_price }}</span> ৳</button>
        </div>
        <!-- description -->
        <div
            style="
                width: 100%;
                max-width: 600px;
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
                        style="text-decoration: none; color: black;">Description</a>
                </div>

                <!-- Custom Sidebar Modal -->
                <div class="custom-sidebar">
                    <div class="sidebar-header"
                        style="border-bottom: 1px solid #e0e0e0; display: flex; justify-content: space-between; align-items: center; padding: 10px;">
                        <a class="navbar-brand" href="#"
                            style="font-size: 18px; display: flex; align-items: center; text-decoration: none; color: #000;">
                            <span style="font-size: 18px; margin-left: 10px; margin-top:-55px">Description</span>
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
                    <a class="open-custom-sidebar" href="#" style="text-decoration: none; color: black;">More
                        Information</a>
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
                        <span style="font-size: 18px; margin-left: 10px; margin-top:-55px">More Information</span>
                    </a>
                    <span class="custom-closebtn" style="font-size: 24px; cursor: pointer;">&times;</span>
                </div>
                <div class="custom-accordion">
                    <!-- Content for More Information -->
                    <table class="table mt-2">
                        <tbody>
                            <tr>
                                <td class="table-secondary">Pack Content</td>
                                <td>{{$product->pack_content}}</td>
                            </tr>
                            <tr>
                                <td class="table-secondary">Diameter</td>
                                <td>{{@$product->diameter->name}}</td>
                            </tr>
                            <tr>
                                <td class="table-secondary">Base curve</td>
                                <td>{{@$product->baseCurve->name}}</td>
                            </tr>
                            <tr>
                                <td class="table-secondary">Material</td>
                                <td>{{@$product->material->name}}</td>
                            </tr>
                            <tr>
                                <td class="table-secondary">Water content</td>
                                <td>{{@$product->water_content}}</td>
                            </tr>
                            <tr>
                                <td class="table-secondary">Replacement</td>
                                <td>{{@$product->duration->name}}</td>
                            </tr>
                            <tr>
                                <td class="table-secondary">Tones</td>
                                <td>{{@$product->tone->name}}</td>
                            </tr>
                            <tr>
                                <td class="table-secondary">Lens Design</td>
                                <td>{{@$product->lensDesign->name}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Second Row -->
            <div
                style="
                display: flex;
                justify-content: space-between;
                padding: 10px 0;
                ">
                <div style="flex: 1;">
                    <a class="open-custom-sidebar" href="#" style="text-decoration: none; color: black;">Power
                        Range</a>
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
                    <a class="open-custom-sidebar" href="#" style="text-decoration: none; color: black;">Lens
                        Parameters</a>
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

            <!-- Power Range Sidebar -->
            <div class="custom-sidebar">
                <div class="sidebar-header"
                    style="border-bottom: 1px solid #e0e0e0; display: flex; justify-content: space-between; align-items: center; padding: 10px;">
                    <a class="navbar-brand" href="#"
                        style="font-size: 18px; display: flex; align-items: center; text-decoration: none; color: #000;">
                        <span style="font-size: 18px; margin-left: 10px; margin-top:-55px">Power Range</span>
                    </a>
                    <span class="custom-closebtn" style="font-size: 24px; cursor: pointer;">&times;</span>
                </div>
                <div class="custom-accordion">
                    <!-- Content for Power Range -->
                    <h4>Monthly Spherical Lenses</h4>


                </div>
            </div>

            <!-- Lens Parameters Sidebar -->
            <div class="custom-sidebar">
                <div class="sidebar-header"
                    style="border-bottom: 1px solid #e0e0e0; display: flex; justify-content: space-between; align-items: center; padding: 10px;">
                    <a class="navbar-brand" href="#"
                        style="font-size: 18px; display: flex; align-items: center; text-decoration: none; color: #000;">
                        <span style="font-size: 18px; margin-left: 10px; margin-top:-55px">Lens Parameters</span>
                    </a>
                    <span class="custom-closebtn" style="font-size: 24px; cursor: pointer;">&times;</span>
                </div>
                <div class="custom-accordion">
                    <!-- Content for Lens Parameters -->
                    <p>Lens Parameters content goes here.</p>
                </div>
            </div>
        </div>
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

<!-- Quantity update js -->
<script>
    function selectTab(tabId) {
        document.getElementById(tabId).checked = true;
        const totalPriceElement = document.getElementById("total-price");
        if (tabId == 'tab1-radio') {
            updateSimpleTotalPrice()
        } else {
            totalPriceElement.textContent = productPrice;
        }

    }

    const productPrice = {{$product->price ?? 0}};
    const productNoPowerPrice = {{ $product->no_power_price ?? 0 }};
    let globalTotalPrice = productNoPowerPrice;
    const addToCartButton = document.getElementById("total-price");
    const addBtn = document.getElementById('add-to-cart');



    // Function to update the total price in the "Add to Cart" button
    function updateAddToCartButton() {
        addToCartButton.textContent = globalTotalPrice.toFixed(2);

        addBtn.disabled = globalTotalPrice === 0;
    }

    function updateDisplayedTotal(button, quantityClass) {
        const quantityElement = button.parentElement.querySelector(quantityClass);
        const currentQuantityValue = parseInt(quantityElement.textContent) || 0;
        const totalPriceElement = button.closest('.adjustment-btns').querySelector('.total-price-section');
        const calculatedTotal = (currentQuantityValue * productPrice).toFixed(2);

        totalPriceElement.textContent = `Taka: ${calculatedTotal} ৳`;

        calculateGlobalTotalPrice();
    }

    function calculateGlobalTotalPrice() {
        globalTotalPrice = 0;
        document.querySelectorAll(".total-price-section").forEach((priceElement) => {
            const totalText = priceElement.textContent.match(/([\d.]+)/);
            if (totalText) {
                globalTotalPrice += parseFloat(totalText[1]);
            }
        });

        updateAddToCartButton();
    }

    // Reset all values (quantities and totals) to 0
    function resetAllValues() {
        document.querySelectorAll(".quantity-btn, .quantity-btn-two").forEach((quantityBtn) => {
            quantityBtn.textContent = 0; // Reset quantity display to 0
        });

        document.querySelectorAll(".total-price-section").forEach((priceElement) => {
            priceElement.textContent = `Taka: 0.00 ৳`; // Reset price display
        });

        globalTotalPrice = 0;
        updateAddToCartButton();
    }

    function attachQuantityListeners() {
        document.querySelectorAll(".increase-btn, .increase-btn-two").forEach((increaseButton) => {
            increaseButton.addEventListener("click", function() {
                const quantityClass = increaseButton.classList.contains('increase-btn') ? '.quantity-btn' : '.quantity-btn-two';
                const quantityElement = this.parentElement.querySelector(quantityClass);
                let currentQuantityValue = parseInt(quantityElement.textContent) || 1; // Handle NaN
                currentQuantityValue += 1;
                quantityElement.textContent = currentQuantityValue;
                updateDisplayedTotal(this, quantityClass);
            });
        });

        document.querySelectorAll(".decrease-btn, .decrease-btn-two").forEach((decreaseButton) => {
            decreaseButton.addEventListener("click", function() {
                const quantityClass = decreaseButton.classList.contains('decrease-btn') ? '.quantity-btn' : '.quantity-btn-two';
                const quantityElement = this.parentElement.querySelector(quantityClass);
                let currentQuantityValue = parseInt(quantityElement.textContent) || 0; // Handle NaN
                if (currentQuantityValue > 1) {
                    currentQuantityValue -= 1;
                    quantityElement.textContent = currentQuantityValue;
                    updateDisplayedTotal(this, quantityClass);
                }
            });
        });
    }

    document.querySelectorAll(".toggle-btn").forEach((button) => {
        calculateGlobalTotalPrice();
    });

    document.addEventListener("DOMContentLoaded", function() {

        const quantityElement = document.querySelector('.quantity-btn');
        const initialQuantity = parseInt(quantityElement.textContent) || 0; // Handle NaN
        const initialTotal = (initialQuantity * productPrice).toFixed(2);

        calculateGlobalTotalPrice();

        attachQuantityListeners();
    });


    let quantity = 1;
    let totalPriceElement = document.getElementById("total-price");

    function updateSimpleTotalPrice() {
        const total = (quantity * productNoPowerPrice).toFixed(2);
        globalTotalPrice = parseFloat(total);
        totalPriceElement.textContent = total;

        updateAddToCartButton();
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
@endpush