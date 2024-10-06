@extends('layouts.ego-app')
@push('style')
<link rel="stylesheet" href="{{ asset('ego-assets/css/all_lenses.css') }}">
@endpush
@section('content')
<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
<style>
    @media (max-width: 768px) {
        .row {

            --bs-gutter-x: rebeccapurple;
            --bs-gutter-y: 0;
            display: flex;
            flex-wrap: wrap;
            margin-top: calc(-1* var(--bs-gutter-y));
            margin-right: calc(-.5* var(--bs-gutter-x));
            margin-left: calc(-.5* var(--bs-gutter-x));
        }
    }


    .sidebarButton {
        height: 100%;
        width: 0;
        position: fixed;
        top: 0;
        left: 0;
        background-color: #ffffff;
        overflow-x: hidden;
        transition: 0.3s;
        padding-top: 60px;
        z-index: 1000;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    }

    /* sidebarButton content styling */
    .sidebarButton h3 {
        padding: 8px 8px 8px 32px;
        font-size: 25px;
        color: #333;
        margin: 0;
    }

    .sidebar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        border-bottom: 1px solid #e0e0e0;
    }

    .close-btn {
        background: none;
        border: none;
        font-size: 30px;
        cursor: pointer;
        color: #333;
    }

    /* Open the sidebarButton */
    .sidebarButton.open {
        width: 450px;
        /* Adjust width as needed */
    }

    @media (max-width: 768px) {
        .sidebarButton.open {
            width: 250px;
        }
    }

    /* Overlay effect (optional) */
    #overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
        display: none;
    }

    .accordion-button {
        background: white;
    }

    .form-check-label {
        display: flex;
        align-items: center;
    }

    .form-check-input {
        margin-right: 8px;
    }

    .fa-check-circle {
        margin-right: 8px;
        color: #ccc;
    }

    .form-check-input:checked+.form-check-label .fa-check-circle {
        color: #000;
    }

    [type=button]:not(:disabled),
    [type=reset]:not(:disabled),
    [type=submit]:not(:disabled),
    button:not(:disabled) {
        cursor: pointer;
        background: white;
        border: none;
    }
</style>
<br>
<br>
<br>
<br>
<br>
<div class="row mt-5">
    <div class="col-lg-4 col-sm-12 col-mb-4" style="background: #f5f5f5">
        <div class="mt-5 p-4">
            <h1>{{$color->name}}</h1>
            <small>{{$color->products->count()}} PRODUCTS</small>
            <br />
            <a href="#" class="add-to-cart-button w-50 mt-2 text-nowrap" id="filterBtnSide">FILTER <i class="fas fa-plus mx-5"></i></a>
            <div id="sidebarButton" class="sidebarButton">
                <div class="sidebar-header">
                    <h3 class="sidebar-title">Filter</h3>
                    <button class="close-btn" id="closeBtn">&times;</button>
                </div>
                <div class="accordion" id="filterAccordion">
                    <!-- Accordion 6 - Bootstrap Brain Component -->
                    <section class="bsb-accordion-6 py-3 py-md-5 py-xl-8">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">

                                    <div class="accordion" id="accordionExample">

                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBaseCurve" aria-expanded="false" aria-controls="collapseOne">
                                                    Base curve

                                                </button>
                                            </h2>
                                            <div id="collapseBaseCurve" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    @foreach($baseCurves as $baseCurve)
                                                    <div class="form-check position-relative">
                                                        <input class="form-check-input" type="checkbox" id="base{{$baseCurve->id}}" value="{{$baseCurve->id}}" onchange="filterProducts()" @if(in_array($baseCurve->id, $baseArray)) checked @endif>
                                                        <label class="form-check-label" for="base{{$baseCurve->id}}">
                                                            </i> {{$baseCurve->name}}
                                                        </label>
                                                        <span class="count position-absolute" data-bind="text: count, visible: $parent.displayProductCount" style="right: 0; top: 0; bottom:0; margin: auto; font-size: 0.75rem;">({{$baseCurve->products->count()}})</span>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDiameter" aria-expanded="false" aria-controls="collapseTwo">
                                                    Diameter
                                                </button>
                                            </h2>
                                            <div id="collapseDiameter" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    @foreach($diameters as $diameter)
                                                    <div class="form-check position-relative">
                                                        <input class="form-check-input" type="checkbox" id="diameter{{$diameter->id}}" value="{{$diameter->id}}" onchange="filterProducts()" @if(in_array($diameter->id, $diameterArray)) checked @endif>
                                                        <label class="form-check-label" for="diameter{{$diameter->id}}">
                                                            </i> {{$diameter->name}}
                                                        </label>
                                                        <span class="count position-absolute" data-bind="text: count, visible: $parent.displayProductCount" style="right: 0; top: 0; bottom:0; margin: auto; font-size: 0.75rem;">({{$diameter->products->count()}})</span>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <!-- Add this in the head or before the closing body tag -->
                                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTone" aria-expanded="false" aria-controls="collapseThree">
                                                    Tones
                                                </button>
                                            </h2>
                                            <div id="collapseTone" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    @foreach($tones as $tone)
                                                    <div class="form-check position-relative">
                                                        <input class="form-check-input" type="checkbox" id="tone{{$tone->id}}" value="{{$tone->id}}" onchange="filterProducts()" @if(in_array($tone->id, $toneArray)) checked @endif>
                                                        <label class="form-check-label" for="tone{{$tone->id}}">
                                                            </i> {{$tone->name}}
                                                        </label>
                                                        <span class="count position-absolute" data-bind="text: count, visible: $parent.displayProductCount" style="right: 0; top: 0; bottom:0; margin: auto; font-size: 0.75rem;">({{$tone->products->count()}})</span>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseReplacement" aria-expanded="false" aria-controls="collapseThree">
                                                    Replacement
                                                </button>
                                            </h2>
                                            <div id="collapseReplacement" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    @foreach($replacements as $replacement)
                                                    <div class="form-check position-relative">
                                                        <input class="form-check-input" type="checkbox" id="replacement{{$replacement->id}}" value="{{$replacement->id}}" onchange="filterProducts()" @if(in_array($replacement->id, $replacementArray)) checked @endif>
                                                        <label class="form-check-label" for="replacement{{$replacement->id}}">
                                                            </i> {{$replacement->name}}
                                                        </label>
                                                        <span class="count position-absolute" data-bind="text: count, visible: $parent.displayProductCount" style="right: 0; top: 0; bottom:0; margin: auto; font-size: 0.75rem;">({{$replacement->products->count()}})</span>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMaterial" aria-expanded="false" aria-controls="collapseThree">
                                                    Material
                                                </button>
                                            </h2>
                                            <div id="collapseMaterial" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    @foreach($materials as $material)
                                                    <div class="form-check position-relative">
                                                        <input class="form-check-input" type="checkbox" id="material{{$material->id}}" value="{{$material->id}}" onchange="filterProducts()" @if(in_array($material->id, $materialArray)) checked @endif>
                                                        <label class="form-check-label" for="material{{$material->id}}">
                                                            </i> {{$material->name}}
                                                        </label>
                                                        <span class="count position-absolute" data-bind="text: count, visible: $parent.displayProductCount" style="right: 0; top: 0; bottom:0; margin: auto; font-size: 0.75rem;">({{$material->products->count()}})</span>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLens" aria-expanded="false" aria-controls="collapseThree">
                                                    Lens Design
                                                </button>
                                            </h2>
                                            <div id="collapseLens" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    @foreach($lenses as $lens)
                                                    <div class="form-check position-relative">
                                                        <input class="form-check-input" type="checkbox" id="lens{{$lens->id}}" value="{{$lens->id}}" onchange="filterProducts()" @if(in_array($lens->id, $lensArray)) checked @endif>
                                                        <label class="form-check-label" for="lens{{$lens->id}}">
                                                            </i> {{$lens->name}}
                                                        </label>
                                                        <span class="count position-absolute" data-bind="text: count, visible: $parent.displayProductCount" style="right: 0; top: 0; bottom:0; margin: auto; font-size: 0.75rem;">({{$lens->products->count()}})</span>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    function filterProducts() {
                                        const queryParameters = new URLSearchParams();
                                        const checkedColors = [];
                                        const baseCurves = [];
                                        const diameters = [];
                                        const tones = [];
                                        const replacements = [];
                                        const materials = [];
                                        const lensDesign = [];

                                        // Get all checked color inputs
                                        document.querySelectorAll('input[type="checkbox"][id^="color"]:checked').forEach((checkbox) => {
                                            checkedColors.push(checkbox.value);
                                        });

                                        // Get all checked base curve inputs
                                        document.querySelectorAll('input[type="checkbox"][id^="base"]:checked').forEach((checkbox) => {
                                            baseCurves.push(checkbox.value);
                                        });

                                        // Get all checked diameter inputs (if applicable)
                                        document.querySelectorAll('input[type="checkbox"][id^="diameter"]:checked').forEach((checkbox) => {
                                            diameters.push(checkbox.value);
                                        });

                                        // Get all checked tone inputs (if applicable)
                                        document.querySelectorAll('input[type="checkbox"][id^="tone"]:checked').forEach((checkbox) => {
                                            tones.push(checkbox.value);
                                        });

                                        document.querySelectorAll('input[type="checkbox"][id^="replacement"]:checked').forEach((checkbox) => {
                                            replacements.push(checkbox.value);
                                        });

                                        document.querySelectorAll('input[type="checkbox"][id^="material"]:checked').forEach((checkbox) => {
                                            materials.push(checkbox.value);
                                        });

                                        document.querySelectorAll('input[type="checkbox"][id^="lens"]:checked').forEach((checkbox) => {
                                            lensDesign.push(checkbox.value);
                                        });

                                        // Append checked colors to query parameters
                                        if (checkedColors.length) {
                                            queryParameters.append('colors', checkedColors.join(','));
                                        }

                                        // Append base curves to query parameters
                                        if (baseCurves.length) {
                                            queryParameters.append('base', baseCurves.join(','));
                                        }

                                        // Append diameters to query parameters
                                        if (diameters.length) {
                                            queryParameters.append('diameter', diameters.join(','));
                                        }

                                        // Append tones to query parameters
                                        if (tones.length) {
                                            queryParameters.append('tones', tones.join(','));
                                        }

                                        if (replacements.length) {
                                            queryParameters.append('replacement', replacements.join(','));
                                        }

                                        if (materials.length) {
                                            queryParameters.append('material', materials.join(','));
                                        }

                                        if (lensDesign.length) {
                                            queryParameters.append('lens', lensDesign.join(','));
                                        }

                                        // Redirect to the filtered page with query parameters
                                        window.location.href = "{{ route('color.single.color',$color->id) }}?" + queryParameters.toString();
                                    }
                                </script>


                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <script>
                document.getElementById("filterBtnSide").addEventListener("click", function(e) {
                    e.preventDefault();
                    toggleSidebar();
                });

                document.getElementById("closeBtn").addEventListener("click", function() {
                    toggleSidebar();
                });

                function toggleSidebar() {
                    var sidebarButton = document.getElementById("sidebarButton");
                    var overlay = document.getElementById("overlay");

                    if (sidebarButton.classList.contains("open")) {
                        sidebarButton.classList.remove("open");
                        overlay.style.display = "none";
                    } else {
                        sidebarButton.classList.add("open");
                        overlay.style.display = "block";
                    }

                    overlay.addEventListener("click", function() {
                        sidebarButton.classList.remove("open");
                        overlay.style.display = "none";
                    });
                }
                document.addEventListener("DOMContentLoaded", function() {
                    var overlay = document.createElement("div");
                    overlay.id = "overlay";
                    document.body.appendChild(overlay);
                });
            </script>
        </div>
    </div>
    <!-- ------------------------------------------------------------- -->
    <div class="col-12 col-md-8">
        <div class="row ">
            @foreach ($products as $product)
            <div class="col-12 col-sm-6 col-md-6 mt-4">
                <div class="card-product-slider mx-2">
                    <div class="card-product-slider-img-wrapper">
                        <img src="{{ asset($product->image_path) }}" class="card-product-slider-img-top">
                        <a href="{{ route('addToCart.index', $product->id) }}" class="stretched-link"></a>
                        <div class="card-product-slider-icons">
                            <form id="add-to-wishlist-{{ $product->id }}" action="{{ route('wishlist.add', $product->id) }}" method="post">
                                @csrf
                            </form>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('add-to-wishlist-{{ $product->id }}').submit();" class="add-to-wishlist" style="z-index: 9999;">
                                @if($product->wishlist && $product->wishlist->user_id == @auth()->id())
                                <i class="fas fa-heart" style="background-color: white; color: black; display: flex;"></i>
                                @else
                                <i class="fi fi-rr-heart" style="background-color: white; color: black; display: flex;"></i>
                                @endif

                            </a>
                            <a href="https://www.instagram.com/?url={{route('addToCart.index', $product->id)}}" style="z-index: 9999;">
                                <i class="fas fa-share" style="background-color: white; color: black"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-product-slider-body">
                        <h5 class="card-product-slider-title">{{ $product->name }}</h5>
                        <small class="price">STARTING AT : {{ $product->price }} {{ 'BDT' }}</small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection