@extends('layouts.ego-app')
@push('style')
<link rel="stylesheet" href="{{ asset('ego-assets/css/addToCart.css') }}">
@endpush
@section('content')
<style>
    .imageAlbum {
    margin-bottom: 10px; /* Default spacing */
}

.vertical-slider {
    padding: 10px; /* Default padding */
}

/* Mobile Styles */
@media (max-width: 768px) { /* Adjust the max-width as needed */
    .imageAlbum {
        margin-bottom: 5px; /* Reduce spacing for mobile */
    }

    .vertical-slider {
        padding: 5px; /* Reduce padding for mobile */
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
    margin: -126px;
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
    <div class="col-md-5 right-column p-5" >
        <div class="add-to-cart-section">
            <h1>
                <span>{{ $product->name }}</span>
            </h1>
            <div>
                {!! $product->product_intro !!}
            </div>
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="tab-container mx-auto" >
                @if ($product->product_type == 'normal')
                <div class="tab p-4" id="tab1" onclick="selectTab('tab1-radio')">
                    <div class="tab-content">
                        <input type="radio" id="tab1-radio" name="power_type" value="no_power" checked
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
            
                <div class="tab p-4" id="tab3" style="visibility: hidden;">
                    <div class="tab-content">
                        <input type="radio" id="tab3-radio" name="power_type" value="no_power" checked
                            style="width: 20px; height: 20px; margin: 10px" />
                        <label for="tab3-radio">Accessories</label>
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
                            <span id="quantity" style="font-size: 20px" data-quantity="0">0</span>
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
                                            @foreach ($product->variations as $variation)
                                            <option value="{{ $variation->power }}"
                                                @if ($variation->stock == 0) disabled @endif>
                                                {{ $variation->power }} @if ($variation->stock == '0')
                                                Sold out
                                                @endif
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
                                                    <span class="quantity-btn" data-quantity="0"
                                                        id="firstPair">0</span>
                                                    <button class="btn increase-btn">+</button>
                                                </div>
                                            </fieldset>
                                            <h6 class="text-center mt-3 total-price-section">Taka:{{ $product->price }}
                                                ৳</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="eye-section closed-content">
                                    <h6 class="text-center">Second eye</h6>
                                    <form>
                                        <select class="power-select" id="secondPower">
                                            <option value="">Select power</option>
                                            @foreach ($product->variations as $variation)
                                            <option value="{{ $variation->power }}"
                                                @if ($variation->stock == 0) disabled @endif>
                                                {{ $variation->power }} @if ($variation->stock == '0')
                                                Sold out
                                                @endif
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
                                                    <span class="quantity-btn-two" data-quantity="0"
                                                        id="secondPair">0</span>
                                                    <button class="btn increase-btn-two">+</button>
                                                </div>
                                            </fieldset>
                                            <h6 class="text-center mt-3 total-price-section">
                                                Taka:{{ $product->price }} ৳</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- {{-- <div class="closed-content">
                                <div class="eye-section">
                                    <h6 class="text-center">First eye</h6>
                                    <form>
                                        <select class="power-select" id="singlePower">
                                            <option value="">Select power</option>
                                            @foreach ($product->variations as $variation)
                                                <option value="{{ $variation->power }}"
                                                    @if ($variation->stock == 0) disabled @endif>
                                                    {{ $variation->power }} @if ($variation->stock == '0')
                                                        Sold out
                                                    @endif
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
                                                    <span class="quantity-btn" id="singleFirstPair"
                                                        data-quantity="0">1</span>
                                                    <button class="btn increase-btn">+</button>
                                                </div>
                                            </fieldset>
                                            <h6 class="text-center mt-3 total-price-section">Taka: {{ $product->price }} ৳
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div> --}} -->
                    </div>
                </div>
            </div>
            @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


            <button class="add-to-cart-button w-100 mt-4" id="add-to-cart">Add to Cart - <span
                    id="total-price">{{ $product->price }}</span> ৳</button>


            <form class="mt-5">
                <label for="country">CHECK WHAT IS OUT OF STOCK</label>
                <select id="country" name="country" class="form-control">
                    <option value="">Please Choose an option</option>
                    <option value="">+0.50</option>
                    <option value="">+0.50</option>
                    <option value="">+0.50</option>
                    <option value="">+0.50</option>
                    <option value="">+0.50</option>
                    <option value="">+0.50</option>
                    <option value="">+0.50</option>
                    <option value="">+0.50</option>
                    <option value="">+0.50</option>
                    <option value="">+0.50</option>
                    <option value="">+0.50</option>
                    <option value="">+0.50</option>
                </select>
                <input type="submit" style="border: 1px solid black; background-color: white; color: black;"
                    value="NOTIFY ME" />
            </form>
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
                    <p>More Information content goes here.</p>
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
                    <p>Power Range content goes here.</p>
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
    function selectTab(tabId) {
        document.getElementById(tabId).checked = true;
        const totalPriceElement = document.getElementById("total-price");
        totalPriceElement.textContent = '0.00';

        // document.querySelectorAll(".quantity-btn, .quantity-btn-two, #quantity").forEach((quantityElement) => {
        //     quantityElement.textContent = 0;
        // });
    }
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
    let globalTotalPrice = 0; // Total price across all sections
    const productPrice = {{ $product->price }}; // Product price
    const addToCartButton = document.getElementById("total-price"); // The price span inside the "Add to Cart" button
    const addBtn = document.getElementById('add-to-cart'); // The actual Add to Cart button element

    // Function to update the total price in the "Add to Cart" button
    function updateAddToCartButton() {
        addToCartButton.textContent = globalTotalPrice.toFixed(2);

        // Disable the "Add to Cart" button if the global total is 0
        addBtn.disabled = globalTotalPrice === 0;
    }

    // Function to update total price for a specific section and recalculate the global total
    function updateDisplayedTotal(button, quantityClass) {
        const quantityElement = button.parentElement.querySelector(quantityClass);
        const currentQuantityValue = parseInt(quantityElement.textContent) || 0; // Handle NaN
        const totalPriceElement = button.closest('.adjustment-btns').querySelector('.total-price-section');
        const calculatedTotal = (currentQuantityValue * productPrice).toFixed(2);

        // Update the displayed total for the specific section
        totalPriceElement.textContent = `Taka: ${calculatedTotal} ৳`;

        // Recalculate the global total price
        calculateGlobalTotalPrice();
    }

    // Function to recalculate the global total price based on all sections
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

        globalTotalPrice = 0; // Reset global total price
        updateAddToCartButton(); // Update the add to cart button to show reset value
    }

    // Attach event listeners for quantity buttons
    function attachQuantityListeners() {
        document.querySelectorAll(".increase-btn, .increase-btn-two").forEach((increaseButton) => {
            increaseButton.addEventListener("click", function() {
                const quantityClass = increaseButton.classList.contains('increase-btn') ? '.quantity-btn' : '.quantity-btn-two';
                const quantityElement = this.parentElement.querySelector(quantityClass);
                let currentQuantityValue = parseInt(quantityElement.textContent) || 0; // Handle NaN
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
                if (currentQuantityValue > 0) {
                    currentQuantityValue -= 1;
                    quantityElement.textContent = currentQuantityValue;
                    updateDisplayedTotal(this, quantityClass);
                }
            });
        });
    }

    // Initialize each section's total price on page load
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".total-price-section").forEach((priceElement) => {
            const quantityElement = priceElement.closest('.adjustment-btns').querySelector('.quantity-btn, .quantity-btn-two');
            const initialQuantity = parseInt(quantityElement.textContent) || 0; // Handle NaN
            const initialTotal = (initialQuantity * productPrice).toFixed(2);
            priceElement.textContent = `Taka: ${initialTotal} ৳`;
        });

        // Calculate and update the initial global total price
        calculateGlobalTotalPrice();

        // Attach click event to the reset button
        const toggleButton = document.querySelector(".toggle-btn");
        toggleButton.addEventListener("click", resetAllValues);

        attachQuantityListeners(); // Attach quantity listeners
    });

    // Separate functionality for simple increment/decrement control (if applicable)
    let quantity = 0;
    const totalPriceElement = document.getElementById("total-price");

    function updateSimpleTotalPrice() {
        const total = (quantity * productPrice).toFixed(2);
        globalTotalPrice = parseFloat(total); // Ensure it's a number
        totalPriceElement.textContent = total;
        updateAddToCartButton(); // Update global button state based on total
    }

    document.getElementById("increment").addEventListener("click", () => {
        quantity++;
        document.getElementById("quantity").textContent = quantity;
        updateSimpleTotalPrice();
    });

    document.getElementById("decrement").addEventListener("click", () => {
        if (quantity > 0) {
            quantity--;
            document.getElementById("quantity").textContent = quantity;
            updateSimpleTotalPrice();
        }
    });

    updateSimpleTotalPrice(); // Initialize the simple price update
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

    openSidebarBtns.forEach((btn, index) => {
        btn.addEventListener('click', function(event) {
            event.preventDefault();
            sidebars[index].classList.add('show');
        });
    });

    closeSidebarBtns.forEach((btn, index) => {
        btn.addEventListener('click', function(event) {
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
            var response = JSON.parse(xhr.responseText);

            // Store the message in session storage
            if (response.success) {
                sessionStorage.setItem('cartMessage', response.message);
                fetchCartCount();
                window.location.reload();
            } else {
                sessionStorage.setItem('cartError', response.error || 'Unknown error');
                alert('Failed to add to cart: ' + (response.error || 'Unknown error'));
            }
        }
    };
    xhr.send(JSON.stringify(data));
});

// Check for messages in session storage and display them
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