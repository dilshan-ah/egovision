<style>
    input[type="text"],
    select {
        width: 228px;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    body {
        font-family: "Cambria", serif;
    }

    /* Applying to headings */
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: "Cambria", serif;
    }

    @media (max-width: 768px) {
        .hd {
            color: black;
        }
    }

    @media (max-width: 768px) {
        .navbar-nav {
            background: Black;
            color: black;
        }
    }

    /* Applying to paragraphs */
    p {
        font-family: "Cambria", serif;
    }

    /* Custom CSS */
    .navbar-nav {
        justify-content: center;
    }

    .nav-link {
        padding-right: 20px;
        padding-left: 20px;
    }

    .carousel-item {
        height: 100vh;
        min-height: 300px;
        background-size: cover;
        opacity: 0;
        transition: opacity 1s ease-in-out;
        background-position: center;
        /* Center the image */
    }

    @media (max-width: 768px) {
        .carousel-item {
            height: 50vh;
            /* Adjust height for smaller screens */
        }
    }

    .carousel-item.active {
        opacity: 1;
    }

    .header-content {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        z-index: 10;
    }

    @media (max-width: 768px) {

        /* Adjust max-width as needed for your mobile breakpoint */
        .carousel-caption {
            position: absolute;
            /* Ensures it overlays correctly */
            top: 80%;
            /* Positions the top of the caption at the vertical center */
            transform: translateY(-50%);
            /* Translates the caption up by half of its own height */
            left: 0;
            right: 0;
            text-align: center;
            /* Centers text horizontally */
        }
    }

    .carousel-inner::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1;
    }

    .navbar {
        background: transparent !important;
    }
    .nav-link {
        position: relative;
        padding-bottom: 5px;
        color: white;
        font-size: 15px;
        margin: 0 18px;
    }

    .navbar-dark .navbar-nav .nav-link {
        color: Black;
    }

    @media (max-width: 768px) {
        .navbar-dark .navbar-nav .nav-link {
            color: black;
            /* Black color for mobile devices */
        }
    }

    @media (max-width: 991.98px) {
        .navbar-collapse {
            background-color: rgba(0,
                    0,
                    0,
                    0.8);
            /* Optional: Background color for collapsed menu */
        }
    }

    .mega-box {
        position: absolute;
        top: 60px;
        background-color: white;
        width: 100%;
        left: 0;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
        /* Add transition for smooth animation */
    }

    .nav-item:hover .mega-box {
        opacity: 1;
        visibility: visible;
    }

    .mega-box .content {
        /* background-color: Black; */
        padding: 25px 20px;
        display: flex;
        width: 100%;
        justify-content: space-between;
    }

    .content .row {
        width: 100%;
        /* Adjust width as needed */
        line-height: 20px;
        /* text-align: center; */
        margin-left: 20px;

        padding: 20px 0;
        /* Add padding for spacing */
    }

    .mega-links {
        list-style-type: none;
        padding: 0;
    }

    .mega-links li {
        margin-bottom: 10px;
    }

    .mega-links li a {
        color: black;
        text-decoration: none;
    }
</style>

<style>
    /* Customize the button appearance */
    .navbar-toggler {
        border: none;
        background-color: transparent;
        cursor: pointer;
        padding: 0.5rem;
        transition: background-color 0.3s ease;
    }

    .navbar-toggler img {
        width: 30px;
        height: auto;
    }

    /* Hover effect */
    .navbar-toggler:hover {
        background-color: rgba(0, 0, 0, 0.1);
    }

    /* Logo styling */
    .navbar-brand-logo {
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1;
        margin: 0 auto;
        /* Ensure the link is centered */
    }

    /* Logo image styling */
    .navbar-brand-logo img {
        width: 200px;
        transition: transform 0.3s ease-in-out;
        transition: transform 0.3s ease-in-out;
        margin-left: 122px;
    }

    @media (max-width: 768px) {
        .navbar-brand-logo img {
            margin-left: 60px;
        }

        .navbar-brand-logo img {
            width: 148px;
            height: 60px;
        }
    }

    @media (max-width: 768px) {
        .navbar-nav {
            background: white;
            color: black;
        }
    }

    @media (max-width: 768px) {
        .navbar-toggler img {
            width: 30px;
        }
    }

    .badge {
        position: absolute;
        top: 0;
        right: 0;
        /* background-color:  black; */
        color: Black;
        border-radius: 50%;
        padding: 2px 6px;
        font-size: 10px;
        transform: translate(50%, -50%);
    }

    .nav-link {
        position: relative;
        padding-bottom: 5px;
        color: black;
        font-size: 14px;

    }

    .nav-link {
        position: relative;
        padding-bottom: 5px;
        color: white;
        font-size: 14px;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: .25px;
        display: block;
        margin-top: 5px;
        right: 0;
        background: black;
        margin-top: 13px;
    }

    .nav-link:hover::after {
        width: 100%;
        right: 0;
    }
</style>

<style>
    /* Background overlay */
    .search-popup {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 999;
    }

    /* Popup content */
    .search-popup-content {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        width: 90%;
        max-width: 500px;
        position: relative;
    }

    /* Close button */
    .close-button {
        position: absolute;
        top: 10px;
        right: 10px;
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
    }

    /* Input container */
    /* Search input field */
    #search-input {
        flex: 1;
        border: none;
        padding: 10px;
        font-size: 16px;
        outline: none;
        border-radius: 4px 0 0 4px;
        background: #f9f9f9;
    }

    /* Search icon */
    .search-icon {
        width: 20px;
        height: 20px;
        margin-left: 10px;
        cursor: pointer;
    }

    /* Hover and focus effects */
    #search-input:focus {
        border-bottom: 2px solid black;
    }

    .search-icon:hover {
        opacity: 0.7;
    }

    /* Hide the popup by default */
    .search-popup {
        display: none;
        position: fixed;
        top: 0;
        right: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Black background with opacity */
        justify-content: flex-end;
        align-items: flex-start;
        z-index: 1000;
        padding: 20px;
    }

    /* Style the popup content */
    .search-popup-content {
        background-color: white;
        padding: 10px;
        border-radius: 5px;
        width: 300px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    /* Style the input field */
    #search-input {
        width: 80%;
        padding: 5px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    /* Style the close button */
    #close-popup {
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
    }
</style>
<style>
    /* Modal Container */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }

    /* Modal Content */
    .navbar .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 50%;
        /* Could be more or less, depending on screen size */
        border-radius: 5px;
        position: relative;
        /* Relative positioning for close button */
    }

    .sidebar .modal-content {
        width: 100%;
    }

    /* Close Button */
    .close {
        position: absolute;
        top: 10px;
        right: 10px;
        /* Adjusted to top right */
        font-size: 25px;
        font-weight: bold;
        color: #888;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    /* Language Select Dropdown */
    #language-select {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 14px;
        margin-top: 10px;
    }
</style>
<style>
    .cart-icon {
        font-size: 14px;
        display: inline-block;
        cursor: pointer;
    }

    .sidebar {
        position: fixed;
        top: 0;
        right: -445px;
        /* Adjust the initial position if needed */
        width: 445px;
        /* Increase the width as per your requirement */
        height: 100%;
        background-color: white;
        color: black;
        transition: right 0.3s ease;
        z-index: 1000;
        overflow-y: auto;
    }


    .sidebar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;


    }

    .sidebar-header h2 {
        margin: 0;
    }

    .close-btn {
        font-size: 1.5rem;
        cursor: pointer;
    }

    .sidebar-content {
        padding: 1rem;
    }

    .overlay-sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: none;
        z-index: 999;
    }

    .overlay-sidebar.show {
        display: block;
    }

    .sidebar.show {
        right: 0;
    }

    @media (max-width: 768px) {
        .sidebar {
            position: fixed;
            top: 0;
            right: -300px;
            /* Adjust the initial position if needed */
            width: 300px;
            /* Increase the width as per your requirement */
            height: 100%;
            background-color: white;
            color: black;
            transition: right 0.3s ease;
            z-index: 1000;
            overflow-y: auto;
        }
    }
</style>
<style>
    .cart-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px;
        border-bottom: 1px solid #ddd;
    }

    .cart-item img {
        width: 100px;
        height: auto;
    }

    .footer-text {
        background-color: black;
        color: white;
        padding: 10px;
        text-align: center;

        .counter {
            display: flex;
            align-items: center;
        }

        .number {
            margin: 0 15px;
            font-size: 1.5rem;
        }
    }

    /* --------------------------------------------------- */

    .cart-item {
        display: flex;
        gap: 15px;
        /* Spacing between image and details */
        margin-bottom: 20px;
        /* Spacing below the cart item */
        position: relative;
    }

    .image-container {
        position: relative;
        width: 100px;
    }

    .image-container img {
        width: 100px;
        height: 130px;
    }

    .close-icon {
        position: absolute;
        top: -25px;
        left: -11px;
        color: black;
        padding: 2px 5px;
        cursor: pointer;
        font-size: 35px;
    }

    .cart-details {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .cart-details p,
    .cart-details h5 {
        margin-bottom: -6px;
        /* Decreased line spacing */
    }

    .counter-container {
        display: flex;
        align-items: center;
        gap: 10px;
        /* Spacing between buttons and number */
        margin-top: 15px;
        /* Spacing above the counter */
    }

    .counter-container .btn {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .counter-container .number {
        font-size: 20px;
        width: 40px;
        text-align: center;
    }

    .cart-subtotal,
    .footer-text {
        text-align: center;
    }

    .buttons {
        gap: 10px;
        /* Spacing between buttons */
    }

    .footer-text p {
        margin-bottom: 5px;
        /* Spacing between paragraphs */
    }

    .nav-link:hover::after {
        width: 100%;
        right: 0;
    }

    .nav-link.active::after {
        width: 100%;
        right: 0;
    }

    .search-popup-content {
        background-color: white;
        padding: 10px;
        border-radius: 5px;
        width: 350px !important;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    /* Style the input field */
    #search-input {
        width: 86% !important;
        padding: 5px;
        font-size: 14px;
        border: 0 !important;
        background-color: transparent !important;
        border-radius: 5px;
    }
</style>
</head>
@php
use App\Helpers\TranslationHelper;
$preferredLanguage = session('preferredLanguage');
$homeMenu = TranslationHelper::translateText('HOME', $preferredLanguage);
$collectionMenu = TranslationHelper::translateText('COLLECTIONS', $preferredLanguage);
$colorMenu = TranslationHelper::translateText('COLORS', $preferredLanguage);
$durationMenu = TranslationHelper::translateText('DURATIONS', $preferredLanguage);
$accessoryMenu = TranslationHelper::translateText('ACCESSORIES', $preferredLanguage);
$instaMenu = TranslationHelper::translateText('SHOP ON INSTAGRAM', $preferredLanguage);
$allLenseMenu = TranslationHelper::translateText('ALL LENSES', $preferredLanguage);
$aboutMenu = TranslationHelper::translateText('ABOUT US', $preferredLanguage);

@endphp
<header>
    <!-- Header content including Navbars -->
    <div class="header-content second_header_background " style="margin-top: 15px; padding-top: 15px">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light; container">
            <div class="container-fluid" style="padding: 5px">
                <!-- Left side: Toggle button -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <img src="{{ asset('ego/toggle_black.svg') }}" alt="Toggle Button" />
                </button>

                <a class="navbar-brand d-none d-sm-block" href="#" id="language-selector"
                    style="font-size: 14px; color: black">
                    <i class="fas fa-globe"></i> <span id="language-text">
                        @if(session('preferredLanguage') == 'en')
                        English
                        @elseif(session('preferredLanguage') == 'hi')
                        Hindi
                        @elseif(session('preferredLanguage') == 'ru')
                        Russian
                        @elseif(session('preferredLanguage') == 'zh')
                        Chinese
                        @elseif(session('preferredLanguage') == 'bn')
                        Bangla
                        @else
                        English
                        @endif
                    </span>
                </a>
                <div id="language-modal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <h3>@lang('messages.select_language')</h3>
                        <form id="lang-form" action="{{route('change.lang')}}" method="post">
                            @csrf
                            <select onchange="document.getElementById('lang-form').submit();" name="code" style="width: 100%;">
                                <option value="en" {{ session('preferredLanguage') == 'en' ? 'selected' : '' }}>English</option>
                                <option value="hi" {{ session('preferredLanguage') == 'hi' ? 'selected' : '' }}>Hindi</option>
                                <option value="ru" {{ session('preferredLanguage') == 'ru' ? 'selected' : '' }}>Russian</option>
                                <option value="zh" {{ session('preferredLanguage') == 'zh' ? 'selected' : '' }}>Chinese</option>
                                <option value="bn" {{ session('preferredLanguage') == 'bn' ? 'selected' : '' }}>Bengali</option>
                            </select>
                        </form>

                    </div>
                </div>
                <!-- Middle: Logo -->
                <div class="navbar-brand-container-logo ">
                    <a class="navbar-brand-logo" href="{{ route('ego.index') }}">
                        <img id="logo-mode" src="{{ asset('ego/ego_logo_black.png') }}" alt="Logo" />
                    </a>
                </div>
                <!-- Right side: Account link -->
                <div class="d-flex">
                    

                    <div id="search-popup" class="search-popup">
                        <div class="search-popup-content">
                            <button type="button" id="close-popup" style="opacity: 0;" class="close-button position-absolute">&times;</button>
                            <div class="input-container" style=" width: 100%">
                                <form action="{{ route('product.search') }}" method="GET" class="d-flex align-items-center">
                                    @csrf
                                    <input type="text" name="query" id="search-input" placeholder="Search..." />
                                    <button type="submit" style="border: 0; background: transparent"><img src="{{ asset('ego/search-icon_black.svg') }}" alt="Search"
                                            class="search-icon" /></button>

                                </form>


                            </div>
                        </div>
                    </div>

                    <!-- Wishlist Icon -->
                    <a class="navbar-brand mx-3 position-relative" href="{{route('ego.wishlist')}}"
                        style="display: flex; align-items: center; font-size: 14px;">
                        <img src="{{ asset('ego/love_shape_black.svg') }}" alt="Wishlist"
                            style="height: 18px; width: 18px; margin-right: 5px;" />
                        <span class="badge" style="font-size: 10px; position: absolute; top: 5px; right: 0; background-color: black; color: white; border-radius: 50%; width: 18px; height: 18px; display: flex; align-items: center; justify-content: center;">
                            {{@$wishlists->count()}}
                        </span>
                    </a>
                    <!-- Cart Icon -->
                    <a class="navbar-brand" href="#" id="openSidebar"
                        style="display: flex; align-items: center; font-size: 14px; position: relative;">
                        <img src="{{ asset('ego/cart_shape_black.svg') }}" alt="Cart"
                            style="height: 18px; width: 18px; margin-right: 5px;" />
                        <span class="badge" id="cart-count"
                            style="font-size: 10px; position: absolute; top: 5px; right: 0px; background-color: black; color: white; border-radius: 50%; width: 16px; height: 16px; display: flex; align-items: center; justify-content: center;">
                            <!-- Cart count will be dynamically added here -->
                        </span>
                    </a>

                    <!-- Search Bar Popup -->
                    <div id="search-popup" class="search-popup">
                        <div class="search-popup-content">
                            <button type="button" id="close-popup" class="close-button">&times;</button>
                            <div class="input-container">
                                <input type="text" id="search-input" placeholder="Search..." />
                                <img src="{{ asset('ego/search-icon_black.svg') }}" alt="Search"
                                    class="search-icon" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Secondary Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid" style="border-bottom: 1px solid #eee">
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav mx-auto p-2">
                        <!-- mx-auto will center the items -->
                        <li class="nav-item">
                            <a class="navbar-brand  d-lg-none responsive-link" href="#" id="search-icon"
                                style="display: flex; align-items: center; font-size: 14px;">
                                <img src="{{ asset('ego/search-icon_black.svg') }}" alt="Search"
                                    style="height: 18px; width: 18px; margin-right: 5px;" /> Search Lenses
                            </a>
                        </li>
                        <hr>
                        <li class="nav-item">
                            @if (!Auth::user())
                            <a class="navbar-brand d-block d-lg-none responsive-link " href="{{ route('ego.login') }}"
                                style="font-size: 14px; display: flex; align-items: center;">
                                <img class="responsive-img" src="{{ asset('ego/white_account.svg') }}" alt="Account"
                                    style="height: 14px; width: 14px; margin-right: 5px;" />ACCOUNT
                            </a>
                            @else
                            <a class="navbar-brand d-block d-lg-none responsive-link " href="{{ route('user.home') }}"
                                style="display: flex; align-items: center; font-size: 14px;">
                                <img class="responsive-img" src="{{ asset('ego/white_account.svg') }}" alt="Account"
                                    style="height: 14px; width: 14px; margin-right: 5px;" />
                                {{ Auth::user()->fullname }}
                            </a>
                            @endif
                        </li>

                        <style>
                            @media (max-width: 991.98px) {
                                .responsive-link {
                                    color: black !important;
                                    /* Changes text color to black */
                                }

                                .responsive-img {
                                    content: url('{{ asset(' ego/black_account.svg') }}');
                                    /* Changes image to black_account.svg */
                                }
                            }
                        </style>

                        <li class="nav-item">
                            <a class="nav-link hover-line {{ Route::is('ego.index') ? 'active' : '' }}"
                                href="{{ route('ego.index') }}">{{$homeMenu}}</a>
                        </li>


                        {{-- sm  devise -----------------------------------------------------------------------------------------------------------------}}
                        <style>
                            /* General styles for dropdown */
                            .mega-menu {
                                display: none;
                                position: absolute;
                                top: 60px;
                                /* Adjusted top position for better alignment */
                                left: 0;
                                background-color: #fff;
                                padding: 20px;
                                flex-wrap: wrap;
                                justify-content: space-between;
                                z-index: 1000;
                                /* Ensure the dropdown is above other elements */
                            }

                            .mega-column {
                                width: calc(33.33% - 20px);
                                /* Three columns with space */
                                padding: 10px;
                                /* Padding inside each column */
                            }

                            .sub-menu {
                                list-style: none;
                                padding-left: 0;
                                display: none;
                                /* Hide by default */
                            }

                            .toggle {
                                cursor: pointer;
                                margin-left: 10px;
                                /* Align the icon to the right */
                                font-size: 20px;
                                float: right;
                                /* Float the toggle to the right */
                                margin-top: -8px;
                            }

                            /* Responsive behavior */
                            @media screen and (max-width: 768px) {
                                .mega-menu {
                                    position: static;
                                    width: 100%;
                                    background: #f5f5f5;
                                }

                                .mega-column {
                                    width: 100%;
                                    /* Full width on mobile */
                                }
                            }

                            .flex-container {
                                display: flex;
                                /* Use flexbox for layout */
                                justify-content: space-between;
                                /* Space between items */
                                align-items: center;
                                /* Center items vertically */
                            }

                            .hover-link {
                                text-decoration: none;
                                /* Remove underline */
                                color: inherit;
                                /* Inherit color from parent */
                                transition: color 0.3s;
                                /* Smooth color transition */
                            }

                            .hover-link:hover {
                                color: #E9814C;
                                /* Change color on hover */
                            }

                            .custom-dropdown-item {
                                display: block;
                                /* Make link block-level for padding */
                                padding: 8px 12px;
                                /* Increased padding for better click area */
                                color: #333;
                                /* Set text color */
                                border-radius: 4px;
                                /* Rounded corners for items */
                                transition: background-color 0.3s;
                                /* Smooth background transition */
                            }

                            .custom-dropdown-item:hover {
                                background-color: #f2f2f2;
                            }

                            /* Additional styles for headers */
                            .section h3 {
                                display: flex;
                                /* Use flex to align items */
                                align-items: center;
                                /* Center items vertically */
                                justify-content: space-between;
                                /* Space between title and toggle */
                                margin-bottom: 10px;
                                /* Space below each section header */
                            }
                        </style>
                        <li class="nav-item custom-dropdown">
                        <li class="dropdown">
                            <a href="#" class="dropbtn nav-link hover-link d-block d-lg-none" onclick="toggleMenu('services', event)">
                                {{$collectionMenu}}
                                <span class="toggle">+</span>
                            </a>
                            <div class="mega-menu" id="services">
                                @foreach ($collectionSets as $collectionSet)
                                <div class="mega-column">
                                    <div class="section">
                                        <h3 class="flex-container">
                                            <a style="font-size: 13px" class="d-block mb-2 text-dark hover-link text-nowrap"
                                                href="{{route('collectionSet.single.collection',$collectionSet->id)}}"
                                                onclick="toggleSubmenu(event, 'web-dev-{{ $loop->index }}', this);"
                                                style="font-size: 14px; font-weight: 600;">
                                                {{ @$collectionSet->category->name ?? 'No Category' }}
                                                {{ @$collectionSet->tone->name ? '-' . $collectionSet->tone->name : '' }}
                                                {{ @$collectionSet->duration ? '-' . $collectionSet->duration->months .$collectionSet->duration->is_month ? ' months': 'days' : '' }}
                                            </a>
                                            <span class="toggle" onclick="toggleSection('web-dev-{{ $loop->index }}', this)">+</span>
                                        </h3>
                                    </div>
                                    <ul class="sub-menu" id="web-dev-{{ $loop->index }}">
                                        <a href="{{route('collectionSet.single.collection',$collectionSet->id)}}" style="float: right"><u>See Collection</u></a>

                                        @foreach ($collectionSet->products as $product)
                                        <li>
                                            <a style="font-size: 13px" class="custom-dropdown-item text-nowrap mt-2" href="{{ route('addToCart.index', $product->id) }}">
                                                {{ @$product->name }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endforeach
                            </div>
                        </li>
                        </li>

                        {{-- Color section --}}
                        <li class="nav-item custom-dropdown">
                        <li class="dropdown">
                            <a href="#" class="dropbtn nav-link hover-link d-block d-lg-none" onclick="toggleMenu('colorsDropdown', event)">
                                {{$colorMenu}}
                                <span class="toggle">+</span>
                            </a>
                            <div class="mega-menu" id="colorsDropdown" style="display: none;">
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="row mt-3">
                                        @foreach ($colors as $color)
                                        <div class="col-md-2 mb-3 position-relative">
                                            <a href="{{ route('color.single.color', $color->id) }}" target="_blank">
                                                {{ $color->name }}
                                            </a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </li>
                        </li>

                        {{-- Duration section --}}
                        <li class="nav-item custom-dropdown">
                        <li class="dropdown">
                            <a href="#" class="dropbtn nav-link hover-link d-block d-lg-none" onclick="toggleMenu('durationDropdown', event)">
                                {{$durationMenu}}
                                <span class="toggle">+</span>
                            </a>
                            <div class="mega-menu" id="durationDropdown" style="display: none;">
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="row mt-3">
                                        @foreach ($durations as $duration)
                                        <div class="col-md-2 mb-3 position-relative">
                                            <a href="{{ route('duration.single.duration', $duration->id) }}" class="duration-link">
                                                <span class="duration-text">{{ $duration->name }} - {{ $duration->months }} @if(@$duration->is_month == '1')MONTHS @else Days @endif</span>
                                            </a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </li>
                        </li>


                        <script>
                            function toggleMenu(menuId, event) {
                                event.preventDefault(); // Prevent the default anchor click behavior
                                const menu = document.getElementById(menuId);
                                if (menu.style.display === "flex" || menu.style.display === "block") {
                                    menu.style.display = "none";
                                    event.currentTarget.querySelector('.toggle').textContent = "+"; // Change to plus
                                } else {
                                    menu.style.display = "flex";
                                    event.currentTarget.querySelector('.toggle').textContent = "-"; // Change to minus
                                }
                            }

                            function toggleSection(sectionId, toggleElement) {
                                const section = document.getElementById(sectionId);
                                if (section.style.display === "block") {
                                    section.style.display = "none";
                                    toggleElement.textContent = "+"; // Change to plus
                                } else {
                                    section.style.display = "block";
                                    toggleElement.textContent = "-"; // Change to minus
                                }
                            }

                            function toggleSubmenu(event, sectionId, toggleElement) {
                                event.preventDefault(); // Prevent the default anchor click behavior
                                const submenu = document.getElementById(sectionId);
                                if (submenu.style.display === "block") {
                                    submenu.style.display = "none";
                                    toggleElement.querySelector('.toggle').textContent = "+"; // Change to plus
                                } else {
                                    submenu.style.display = "block";
                                    toggleElement.querySelector('.toggle').textContent = "-"; // Change to minus
                                }
                            }
                        </script>
                        {{-- ----------------------------------------------sm devise end--------------------------------------------------------------- --}}

                        {{-- lg devise --}}
                        <li class="nav-item">
                            <a class="nav-link hover-line collection d-none d-md-block" href="{{ route('ego.pages.collection.lense') }}">
                                {{$collectionMenu}}
                            </a>
                            <div class="mega-box">
                                <div class="content">
                                    <div class="row">
                                        @foreach ($collectionSets as $collectionSet)
                                        <div class="col-12 col-md-3 mb-3">
                                            <a class="d-block mb-2  hover-link"
                                                href="{{route('collectionSet.single.collection',$collectionSet->id)}}"
                                                style="font-size: 16px; font-weight: 600;">
                                                {{ @$collectionSet->category->name ?? 'No Category' }}
                                                {{ @$collectionSet->tone->name ? '-' . $collectionSet->tone->name : '' }}
                                                {{ @$collectionSet->duration ? '-' . $collectionSet->duration->months . ' months' : '' }}
                                            </a>
                                            <ul class="mega-links">
                                                @foreach ($collectionSet->products as $product)
                                                <li>
                                                    <a href="{{ route('addToCart.index', $product->id) }}"
                                                        
                                                        style="font-size: 12px;">
                                                        {{ $product->name }}
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link d-none d-md-block hover-line {{ Route::is('ego.pages.color.lense') ? 'active' : '' }}"
                                href="{{ route('ego.pages.color.lense') }}">{{$colorMenu}}</a>
                            <div class="mega-box">
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="row text-center mt-3">
                                        @foreach ($colors as $color)
                                        <div class="col-md-2 mb-3 position-relative">
                                            <a href="{{ route('color.single.color', $color->id) }}"
                                                target="_blank">
                                                <img class="card-img-top" style="width: 100%;"
                                                    src="{{ asset($color->image_path) }}" alt="Card image cap">
                                                <div class="image-text">{{ $color->name }}</div>
                                            </a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </li>
                        <style>
                            .duration-link {
                                display: block;
                                margin-top: 20px;
                            }

                            .duration-text {
                                text-align: left;
                                padding: 10px;
                                gap: 10px;
                            }
                        </style>

                        <li class="nav-item">
                            <a class="nav-link d-none d-md-block hover-line {{ Route::is('ego.pages.duration.lense') ? 'active' : '' }}"
                                href="{{ route('ego.pages.duration.lense') }}">{{$durationMenu}}</a>
                            <div class=" mega-box">
                                <div class="content">
                                    <div class="row">
                                        <ul class="mega-links text-Black">
                                            @foreach ($durations as $duration)
                                            <a href="{{ route('duration.single.duration', $duration->id) }}" class="duration-link">
                                                <span class="duration-text">{{ $duration->name }} - {{ $duration->months }} MONTHS</span>
                                            </a>
                                            <br />
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link hover-line {{ Route::is('ego.pages.accessories') ? 'active' : '' }}"
                                href="{{ route('ego.pages.accessories') }}">{{$accessoryMenu}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link hover-line {{ Route::is('ego.pages.shop.instagram') ? 'active' : '' }}"
                                href="{{ route('ego.pages.shop.instagram') }}">{{$instaMenu}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link hover-line {{ Route::is('ego.pages.all.lenses') ? 'active' : '' }}"
                                href="{{ route('ego.pages.all.lenses') }}">{{$allLenseMenu}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link hover-line"
                                href="{{ route('ego.pages.about.lense') }}">{{$aboutMenu}}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>


<!-- sidebar  -->
<div class="sidebar" id="sidebar"
    style="background-color: #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.1); color: #000;">
    <div class="sidebar-header"
        style="padding: 15px; border-bottom: 1px solid #e0e0e0; display: flex; justify-content: space-between; align-items: center;">
        <a class="navbar-brand" href="#" class="cart-icon"
            style="font-size: 18px; display: flex; align-items: center; text-decoration: none; color: #000;">
            <img src="{{ asset('ego/cart_shape_black.svg') }}" alt="Cart" style="width: 24px; height: 24px;" />
            <span style="font-size: 18px; margin-left: 10px; font-weight: 600;">Cart</span>
        </a>
        <span class="close-btn" id="closeSidebar" style="font-size: 24px; cursor: pointer;">&times;</span>
    </div>
    <div class="sidebar-content" style="padding: 15px;">
        @if ($carts->count() > 0)
        @foreach ($carts as $cart)
        <div class="cart-item"
            style="display: flex; align-items: stretch; margin-bottom: 20px; height: 150px; border: 1px solid #e0e0e0; border-radius: 8px; padding: 10px;">
            <div class="image-container"
                style="width: 80px; height: 100%; position: relative; flex-shrink: 0;">
                <img src="{{ asset($cart->product->image_path) }}" alt="Random Image"
                    style="width: 100%; height: 100%; object-fit: cover;">
                <span class="close-icon"
                    style="position: absolute; top: -10px; right: -10px; color: black; padding: 2px 6px; cursor: pointer; font-size: 18px;" type="button" data-bs-toggle="modal" data-bs-target="#deleteCart{{$cart->id}}">&times;</span>

                <div class="modal fade" id="deleteCart{{$cart->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Cart Item</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <form action="{{route('cart.delete',$cart->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" data-cart-id="{{ $cart->id }}" class="btn btn-dark delete-item">Delete</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="cart-details"
                style="flex-grow: 1; padding-left: 15px; display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <h5 style="font-size: 14px; font-weight: 600; margin: 0 0 6px 0;">
                        {{ $cart->product->name }} {{ $cart->power }}
                    </h5>
                </div>

                <!-- Price and Quantity Section -->
                <div
                    style="margin-top: 10px; display: flex; align-items: center; justify-content: space-between;">
                    <!-- Quantity Selector -->
                    <div class="quantity-selector"
                        style="display: inline-flex; align-items: center; border: 1px solid black; padding: 1px; font-size: 12px;">
                        <button class="quantity-btn decreaseQuantity" data-cart-id="{{ $cart->id }}"
                            style="padding: 4px 8px; background-color: transparent; border: none; cursor: pointer; font-size: 14px; font-weight: 600; color: black;">-</button>
                        <span class="quantity-number" id="quantityValue{{ $cart->id }}"
                            style="padding: 4px 8px; font-size: 12px; color: black;">{{ $cart->pair }}</span>
                        <button class="quantity-btn increaseQuantity" data-cart-id="{{ $cart->id }}"
                            style="padding: 4px 8px; background-color: transparent; border: none; cursor: pointer; font-size: 14px; font-weight: 600; color: black;">+</button>
                    </div>
                    <!-- Price -->
                    <span
                        style="font-size: 14px; font-weight: 600; margin-left: 10px;">{{ $cart->power_status == 'no_power' ? $cart->product->no_power_price : $cart->product->price }}
                        BDT</span>
                </div>
            </div>
        </div>
        @endforeach

        <div class="buttons d-flex justify-content-between my-3" style="margin-top: 25px;">
            <a href="{{route('addToCart.checkout')}}" class="add-to-cart-button" style="width: 45%;">Checkout</a>
        </div>

        <div class="cart-subtotal my-4"
            style="border-top: 1px solid #e0e0e0; padding-top: 20px; text-align: center;">
            <h4 style="font-size: 18px; font-weight: 600;">CART SUBTOTAL:
                <span
                    id="cartSubtotal">{{ $carts->sum(function ($cart) {
                            return $cart->pair * $cart->product->price;
                        }) }}</span>
                BDT
            </h4>
        </div>
        @else
        <h4 style="font-size: 16px; font-weight: 600;">You have no items in your shopping cart.
        </h4>
        @endif
    </div>
</div>

<style>
    .add-to-cart-button {
        padding: 10px 20px;
        background-color: black;
        color: white;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        cursor: pointer;
        border: 1px solid black;
        transition: background-color 0.3s, border-color 0.3s, color 0.3s;
    }

    .add-to-cart-button:hover {
        background-color: white;
        color: black;
        border: 1px solid black;
    }

    .add-to-cart-button-more {
        padding: 10px 20px;
        background-color: white;
        color: black;
        border: 1px solid black;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s, border-color 0.3s, color 0.3s;
    }

    .add-to-cart-button-more:hover {
        background-color: black;
        color: white;
        border: 1px solid black;
    }

    .close-icon {
        position: absolute;
        top: -5px;
        right: -5px;
        color: black;
        border-radius: 50%;
        padding: 2px 6px;
        cursor: pointer;
        font-size: 12px;
    }

    .cart-item {
        height: 150px;
        /* Ensure the same height across items */
    }

    /* Default width */
    .sidebar {
        width: 350px;
    }

    /* For screens smaller than 768px (e.g., tablets) */
    @media (max-width: 768px) {
        .sidebar {
            width: 300px;
        }
    }


    .quantity-btn {
        background-color: transparent;
        border: none;
        cursor: pointer;
        font-size: 18px;
        font-weight: bold;
        color: black;
    }

    .quantity-number {
        padding: 8px 16px;
        font-size: 16px;
        font-weight: bold;
        color: black;
        text-align: center;
        min-width: 30px;
    }

    .quantity-selector {
        display: inline-flex;
        align-items: center;
        border: 1px solid black;
    }

    .modal-backdrop {
        display: none;
    }
</style>
<div class="overlay-sidebar" id="overlay-sidebar"></div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var modal = document.getElementById('language-modal');
        var btn = document.getElementById('language-selector');
        var span = document.getElementsByClassName('close')[0];

        btn.onclick = function() {
            modal.style.display = 'block';
        };

        span.onclick = function() {
            modal.style.display = 'none';
        };

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        };
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Function to update cart quantity and price
    function updateCart(id, action) {
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/cart/update-quantity', true);
        xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);

                // Update the quantity and total price for this item in the UI
                document.getElementById('quantityValue' + id).innerText = response.pair;
                document.getElementById('totalPrice' + id).innerText = response.totalPrice + ' BDT';


            } else if (xhr.readyState == 4) {
                console.error('Failed to update cart quantity.');
            }
        };

        // Sending the cart ID and action (increment/decrement)
        xhr.send(JSON.stringify({
            id: id,
            action: action
        }));
    }

    document.querySelectorAll('.increaseQuantity').forEach(function(button) {
        button.addEventListener('click', function() {
            var cartId = this.getAttribute('data-cart-id');
            updateCart(cartId, 'increment');
            fetchCartTotalPrice();
            fetchCartCount();
        });
    });

    // Attach event listeners for all decrement buttons
    document.querySelectorAll('.decreaseQuantity').forEach(function(button) {
        button.addEventListener('click', function() {
            var cartId = this.getAttribute('data-cart-id');
            var currentQuantity = parseInt(document.getElementById('quantityValue' + cartId)
                .textContent);

            if (currentQuantity > 1) {
                updateCart(cartId, 'decrement');
                fetchCartTotalPrice();
                fetchCartCount();
            }
        });
    });

    function fetchCartCount() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/cart/count', true);

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);
                document.getElementById('cartCount').innerText = response.cartCount;
            }
        };

        xhr.send();
    }
</script>

<script>
    // Function to fetch the cart count and update the UI
    function fetchCartCount() {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/cart/get-cart-count', true); // Adjust URL as needed
        xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Parse the JSON response
                var response = JSON.parse(xhr.responseText);

                // Update the cart count in the UI
                document.getElementById('cart-count').innerText = response.cartCount;
            } else if (xhr.readyState == 4) {
                console.error('Failed to fetch cart count.');
            }
        };
        xhr.send();
    }

    // Call the function on page load
    document.addEventListener('DOMContentLoaded', function() {
        fetchCartCount();
    });
</script>

<script>
    function fetchCartTotalPrice() {
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/cart/total-price', true);
        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);
                document.getElementById('cartSubtotal').innerText = response
                    .cartTotal; // Update the total price in the UI
            } else if (xhr.readyState == 4) {
                console.error('Failed to fetch cart total price.');
            }
        };

        xhr.send();
    }

    // Call this function when the page loads to get the initial total
    document.addEventListener('DOMContentLoaded', fetchCartTotalPrice);
</script>

<!-- <script>
    document.querySelectorAll('.delete-item').forEach(function(icon) {
        icon.addEventListener('click', function() {
            var cartId = this.getAttribute('data-cart-id');
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Create an XMLHttpRequest to delete the cart item
            var xhr = new XMLHttpRequest();
            xhr.open('DELETE', '/cart/delete-cart/' + cartId, true);
            xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
            xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    var response = JSON.parse(xhr.responseText);
                    if (xhr.status == 200 && response.success) {
                        icon.closest('.cart-item').remove(); // Remove the item from the DOM
                        fetchCartTotalPrice(); // Update cart total
                        fetchCartCount(); // Update cart count
                        
                    } else {
                        console.error('Failed to delete cart item: ', response.message);
                    }
                    window.location.reload();
                }
            };

            // Send the request
            xhr.send();
        });
    });
</script> -->


<script>
    document.querySelectorAll("#search-icon").forEach(function(icon) {
        icon.addEventListener("click", function() {
            document.getElementById("search-popup").style.display = "flex";
        });
    });

    // Close popup when clicking the close button
    document.getElementById("close-popup").addEventListener("click", function() {
        document.getElementById("search-popup").style.display = "none";
    });

    // Optional: Close popup when clicking outside the search bar content
    document.getElementById("search-popup").addEventListener("click", function(e) {
        if (e.target == this) {
            document.getElementById("search-popup").style.display = "none";
        }
    });
</script>


<script>
    document.getElementById("search-icon").addEventListener("click", function() {
        document.getElementById("search-popup").style.display = "flex";
    });

    document.getElementById("close-popup").addEventListener("click", function() {
        document.getElementById("search-popup").style.display = "none";
    });

    // Optional: Close popup when clicking outside the search bar content
    document.getElementById("search-popup").addEventListener("click", function(e) {
        if (e.target == this) {

            document.getElementById("search-popup").style.display = "none";
        }
    });

    // Optional: Close popup when clicking outside the search bar content
    document.getElementById("search-popup").addEventListener("click", function(e) {
        if (e.target == this) {
            document.getElementById("search-popup").style.display = "none";
        }
    });
</script>

<script>
    const toggleSwitch = document.querySelector('.custom-checkbox');
    
    if (localStorage.getItem('darkMode') === 'enabled') {
            const logo = document.getElementById('logo-mode');
            logo.src = "{{ asset('ego/ego_main_log.png') }}";
        }

        toggleSwitch.addEventListener('change', () => {
            if (toggleSwitch.checked) {
                logo.src = "{{ asset('ego/ego_main_log.png') }}";
                
            } else {
                logo.src = "{{ asset('ego/ego_log_black.png') }}";
            }
        });
</script>