@extends('layouts.ego-app')
@section('content')
<link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/tutorials/accordions/accordion-6/assets/css/accordion-6.css">
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
    <div class="col-4 " style="background: #F5F5F5;">
        <div class="mt-5 p-4">
            <h1> Toric Lenses</h1>
            <small>23 PRODUCTS</small>
            <br>
            <a href="#" class="add-to-cart-button w-50 mt-4 text-nowrap" id="filterBtnSide">FILTER <i class="fas fa-plus mx-5"></i></a>

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
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    Base curve

                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="option1" value="8.7">
                                                        <label class="form-check-label" for="option1">
                                                            </i> 8.7 mm
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="option2" value="21">
                                                        <label class="form-check-label" for="option2">
                                                            21
                                                        </label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">

                                                    Diameter

                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="option1" value="8.7">
                                                        <label class="form-check-label" for="option1">
                                                            </i> 8.7 mm
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="option2" value="21">
                                                        <label class="form-check-label" for="option2">
                                                            21
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Add this in the head or before the closing body tag -->
                                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    Tones
                                                </button>
                                            </h2>
                                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="option1" value="8.7">
                                                        <label class="form-check-label" for="option1">
                                                            </i> 8.7 mm
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="option2" value="21">
                                                        <label class="form-check-label" for="option2">
                                                            21
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    <div class="col-8">
        <div class="row">
            <div class="col-6">
                <div class="card-product-slider mx-2">
                    <div class="card-product-slider-img-wrapper">
                        <img src="https://www.desiolens.com/media/catalog/product/cache/92138ab3c0818b7dd2dcb9466c666313/i/r/irresistible_blue3_desio_colored_contact_lenses.jpg" class="card-product-slider-img-top" alt="...">
                        <a href="#" class="stretched-link"></a>
                        <div class="card-product-slider-icons">
                            <i class="fas fa-heart"></i>
                            <i class="fas fa-share"></i>
                        </div>
                    </div>
                    <div class="card-product-slider-body">
                        <h5 class="card-product-slider-title">DELICIOUS HONEY</h5>
                        <small class="price">STARTING AT: 00.00 TK</small>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card-product-slider mx-2">
                    <div class="card-product-slider-img-wrapper">
                        <img src="https://www.desiolens.com/media/catalog/product/cache/92138ab3c0818b7dd2dcb9466c666313/i/r/irresistible_blue3_desio_colored_contact_lenses.jpg" class="card-product-slider-img-top" alt="...">
                        <a href="#" class="stretched-link"></a>
                        <div class="card-product-slider-icons">
                            <i class="fas fa-heart"></i>
                            <i class="fas fa-share"></i>
                        </div>
                    </div>
                    <div class="card-product-slider-body">
                        <h5 class="card-product-slider-title">DELICIOUS HONEY</h5>
                        <small class="price">STARTING AT: 00.00 TK</small>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card-product-slider mx-2">
                    <div class="card-product-slider-img-wrapper">
                        <img src="https://www.desiolens.com/media/catalog/product/cache/92138ab3c0818b7dd2dcb9466c666313/i/r/irresistible_blue3_desio_colored_contact_lenses.jpg" class="card-product-slider-img-top" alt="...">
                        <a href="#" class="stretched-link"></a>
                        <div class="card-product-slider-icons">
                            <i class="fas fa-heart"></i>
                            <i class="fas fa-share"></i>
                        </div>
                    </div>
                    <div class="card-product-slider-body">
                        <h5 class="card-product-slider-title">DELICIOUS HONEY</h5>
                        <small class="price">STARTING AT: 00.00 TK</small>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card-product-slider mx-2">
                    <div class="card-product-slider-img-wrapper">
                        <img src="https://www.desiolens.com/media/catalog/product/cache/92138ab3c0818b7dd2dcb9466c666313/i/r/irresistible_blue3_desio_colored_contact_lenses.jpg" class="card-product-slider-img-top" alt="...">
                        <a href="#" class="stretched-link"></a>
                        <div class="card-product-slider-icons">
                            <i class="fas fa-heart"></i>
                            <i class="fas fa-share"></i>
                        </div>
                    </div>
                    <div class="card-product-slider-body">
                        <h5 class="card-product-slider-title">DELICIOUS HONEY</h5>
                        <small class="price">STARTING AT: 00.00 TK</small>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card-product-slider mx-2">
                    <div class="card-product-slider-img-wrapper">
                        <img src="https://www.desiolens.com/media/catalog/product/cache/92138ab3c0818b7dd2dcb9466c666313/i/r/irresistible_blue3_desio_colored_contact_lenses.jpg" class="card-product-slider-img-top" alt="...">
                        <a href="#" class="stretched-link"></a>
                        <div class="card-product-slider-icons">
                            <i class="fas fa-heart"></i>
                            <i class="fas fa-share"></i>
                        </div>
                    </div>
                    <div class="card-product-slider-body">
                        <h5 class="card-product-slider-title">DELICIOUS HONEY</h5>
                        <small class="price">STARTING AT: 00.00 TK</small>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card-product-slider mx-2">
                    <div class="card-product-slider-img-wrapper">
                        <img src="https://www.desiolens.com/media/catalog/product/cache/92138ab3c0818b7dd2dcb9466c666313/i/r/irresistible_blue3_desio_colored_contact_lenses.jpg" class="card-product-slider-img-top" alt="...">
                        <a href="#" class="stretched-link"></a>
                        <div class="card-product-slider-icons">
                            <i class="fas fa-heart"></i>
                            <i class="fas fa-share"></i>
                        </div>
                    </div>
                    <div class="card-product-slider-body">
                        <h5 class="card-product-slider-title">DELICIOUS HONEY</h5>
                        <small class="price">STARTING AT: 00.00 TK</small>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card-product-slider mx-2">
                    <div class="card-product-slider-img-wrapper">
                        <img src="https://www.desiolens.com/media/catalog/product/cache/92138ab3c0818b7dd2dcb9466c666313/i/r/irresistible_blue3_desio_colored_contact_lenses.jpg" class="card-product-slider-img-top" alt="...">
                        <a href="#" class="stretched-link"></a>
                        <div class="card-product-slider-icons">
                            <i class="fas fa-heart"></i>
                            <i class="fas fa-share"></i>
                        </div>
                    </div>
                    <div class="card-product-slider-body">
                        <h5 class="card-product-slider-title">DELICIOUS HONEY</h5>
                        <small class="price">STARTING AT: 00.00 TK</small>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card-product-slider mx-2">
                    <div class="card-product-slider-img-wrapper">
                        <img src="https://www.desiolens.com/media/catalog/product/cache/92138ab3c0818b7dd2dcb9466c666313/i/r/irresistible_blue3_desio_colored_contact_lenses.jpg" class="card-product-slider-img-top" alt="...">
                        <a href="#" class="stretched-link"></a>
                        <div class="card-product-slider-icons">
                            <i class="fas fa-heart"></i>
                            <i class="fas fa-share"></i>
                        </div>
                    </div>
                    <div class="card-product-slider-body">
                        <h5 class="card-product-slider-title">DELICIOUS HONEY</h5>
                        <small class="price">STARTING AT: 00.00 TK</small>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card-product-slider mx-2">
                    <div class="card-product-slider-img-wrapper">
                        <img src="https://www.desiolens.com/media/catalog/product/cache/92138ab3c0818b7dd2dcb9466c666313/i/r/irresistible_blue3_desio_colored_contact_lenses.jpg" class="card-product-slider-img-top" alt="...">
                        <a href="#" class="stretched-link"></a>
                        <div class="card-product-slider-icons">
                            <i class="fas fa-heart"></i>
                            <i class="fas fa-share"></i>
                        </div>
                    </div>
                    <div class="card-product-slider-body">
                        <h5 class="card-product-slider-title">DELICIOUS HONEY</h5>
                        <small class="price">STARTING AT: 00.00 TK</small>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card-product-slider mx-2">
                    <div class="card-product-slider-img-wrapper">
                        <img src="https://www.desiolens.com/media/catalog/product/cache/92138ab3c0818b7dd2dcb9466c666313/i/r/irresistible_blue3_desio_colored_contact_lenses.jpg" class="card-product-slider-img-top" alt="...">
                        <a href="#" class="stretched-link"></a>
                        <div class="card-product-slider-icons">
                            <i class="fas fa-heart"></i>
                            <i class="fas fa-share"></i>
                        </div>
                    </div>
                    <div class="card-product-slider-body">
                        <h5 class="card-product-slider-title">DELICIOUS HONEY</h5>
                        <small class="price">STARTING AT: 00.00 TK</small>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card-product-slider mx-2">
                    <div class="card-product-slider-img-wrapper">
                        <img src="https://www.desiolens.com/media/catalog/product/cache/92138ab3c0818b7dd2dcb9466c666313/i/r/irresistible_blue3_desio_colored_contact_lenses.jpg" class="card-product-slider-img-top" alt="...">
                        <a href="#" class="stretched-link"></a>
                        <div class="card-product-slider-icons">
                            <i class="fas fa-heart"></i>
                            <i class="fas fa-share"></i>
                        </div>
                    </div>
                    <div class="card-product-slider-body">
                        <h5 class="card-product-slider-title">DELICIOUS HONEY</h5>
                        <small class="price">STARTING AT: 00.00 TK</small>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card-product-slider mx-2">
                    <div class="card-product-slider-img-wrapper">
                        <img src="https://www.desiolens.com/media/catalog/product/cache/92138ab3c0818b7dd2dcb9466c666313/i/r/irresistible_blue3_desio_colored_contact_lenses.jpg" class="card-product-slider-img-top" alt="...">
                        <a href="#" class="stretched-link"></a>
                        <div class="card-product-slider-icons">
                            <i class="fas fa-heart"></i>
                            <i class="fas fa-share"></i>
                        </div>
                    </div>
                    <div class="card-product-slider-body">
                        <h5 class="card-product-slider-title">DELICIOUS HONEY</h5>
                        <small class="price">STARTING AT: 00.00 TK</small>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card-product-slider mx-2">
                    <div class="card-product-slider-img-wrapper">
                        <img src="https://www.desiolens.com/media/catalog/product/cache/92138ab3c0818b7dd2dcb9466c666313/i/r/irresistible_blue3_desio_colored_contact_lenses.jpg" class="card-product-slider-img-top" alt="...">
                        <a href="#" class="stretched-link"></a>
                        <div class="card-product-slider-icons">
                            <i class="fas fa-heart"></i>
                            <i class="fas fa-share"></i>
                        </div>
                    </div>
                    <div class="card-product-slider-body">
                        <h5 class="card-product-slider-title">DELICIOUS HONEY</h5>
                        <small class="price">STARTING AT: 00.00 TK</small>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card-product-slider mx-2">
                    <div class="card-product-slider-img-wrapper">
                        <img src="https://www.desiolens.com/media/catalog/product/cache/92138ab3c0818b7dd2dcb9466c666313/i/r/irresistible_blue3_desio_colored_contact_lenses.jpg" class="card-product-slider-img-top" alt="...">
                        <a href="#" class="stretched-link"></a>
                        <div class="card-product-slider-icons">
                            <i class="fas fa-heart"></i>
                            <i class="fas fa-share"></i>
                        </div>
                    </div>
                    <div class="card-product-slider-body">
                        <h5 class="card-product-slider-title">DELICIOUS HONEY</h5>
                        <small class="price">STARTING AT: 00.00 TK</small>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card-product-slider mx-2">
                    <div class="card-product-slider-img-wrapper">
                        <img src="https://www.desiolens.com/media/catalog/product/cache/92138ab3c0818b7dd2dcb9466c666313/i/r/irresistible_blue3_desio_colored_contact_lenses.jpg" class="card-product-slider-img-top" alt="...">
                        <a href="#" class="stretched-link"></a>
                        <div class="card-product-slider-icons">
                            <i class="fas fa-heart"></i>
                            <i class="fas fa-share"></i>
                        </div>
                    </div>
                    <div class="card-product-slider-body">
                        <h5 class="card-product-slider-title">DELICIOUS HONEY</h5>
                        <small class="price">STARTING AT: 00.00 TK</small>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card-product-slider mx-2">
                    <div class="card-product-slider-img-wrapper">
                        <img src="https://www.desiolens.com/media/catalog/product/cache/92138ab3c0818b7dd2dcb9466c666313/i/r/irresistible_blue3_desio_colored_contact_lenses.jpg" class="card-product-slider-img-top" alt="...">
                        <a href="#" class="stretched-link"></a>
                        <div class="card-product-slider-icons">
                            <i class="fas fa-heart"></i>
                            <i class="fas fa-share"></i>
                        </div>
                    </div>
                    <div class="card-product-slider-body">
                        <h5 class="card-product-slider-title">DELICIOUS HONEY</h5>
                        <small class="price">STARTING AT: 00.00 TK</small>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card-product-slider mx-2">
                    <div class="card-product-slider-img-wrapper">
                        <img src="https://www.desiolens.com/media/catalog/product/cache/92138ab3c0818b7dd2dcb9466c666313/i/r/irresistible_blue3_desio_colored_contact_lenses.jpg" class="card-product-slider-img-top" alt="...">
                        <a href="#" class="stretched-link"></a>
                        <div class="card-product-slider-icons">
                            <i class="fas fa-heart"></i>
                            <i class="fas fa-share"></i>
                        </div>
                    </div>
                    <div class="card-product-slider-body">
                        <h5 class="card-product-slider-title">DELICIOUS HONEY</h5>
                        <small class="price">STARTING AT: 00.00 TK</small>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card-product-slider mx-2">
                    <div class="card-product-slider-img-wrapper">
                        <img src="https://www.desiolens.com/media/catalog/product/cache/92138ab3c0818b7dd2dcb9466c666313/i/r/irresistible_blue3_desio_colored_contact_lenses.jpg" class="card-product-slider-img-top" alt="...">
                        <a href="#" class="stretched-link"></a>
                        <div class="card-product-slider-icons">
                            <i class="fas fa-heart"></i>
                            <i class="fas fa-share"></i>
                        </div>
                    </div>
                    <div class="card-product-slider-body">
                        <h5 class="card-product-slider-title">DELICIOUS HONEY</h5>
                        <small class="price">STARTING AT: 00.00 TK</small>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card-product-slider mx-2">
                    <div class="card-product-slider-img-wrapper">
                        <img src="https://www.desiolens.com/media/catalog/product/cache/92138ab3c0818b7dd2dcb9466c666313/i/r/irresistible_blue3_desio_colored_contact_lenses.jpg" class="card-product-slider-img-top" alt="...">
                        <a href="#" class="stretched-link"></a>
                        <div class="card-product-slider-icons">
                            <i class="fas fa-heart"></i>
                            <i class="fas fa-share"></i>
                        </div>
                    </div>
                    <div class="card-product-slider-body">
                        <h5 class="card-product-slider-title">DELICIOUS HONEY</h5>
                        <small class="price">STARTING AT: 00.00 TK</small>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card-product-slider mx-2">
                    <div class="card-product-slider-img-wrapper">
                        <img src="https://www.desiolens.com/media/catalog/product/cache/92138ab3c0818b7dd2dcb9466c666313/i/r/irresistible_blue3_desio_colored_contact_lenses.jpg" class="card-product-slider-img-top" alt="...">
                        <a href="#" class="stretched-link"></a>
                        <div class="card-product-slider-icons">
                            <i class="fas fa-heart"></i>
                            <i class="fas fa-share"></i>
                        </div>
                    </div>
                    <div class="card-product-slider-body">
                        <h5 class="card-product-slider-title">DELICIOUS HONEY</h5>
                        <small class="price">STARTING AT: 00.00 TK</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection