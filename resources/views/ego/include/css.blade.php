<link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet" />
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
<!-- for topbar -->
<link
    rel="stylesheet"
    type="text/css"
    href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
<link
    rel="stylesheet"
    type="text/css"
    href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />

<link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
<style>

body {
    overflow-x: hidden; /* Disable horizontal scroll */
}
    .dropdown-menu {
        --bs-dropdown-zindex: 1000;
        --bs-dropdown-min-width: 10rem;
        --bs-dropdown-padding-x: 0;
        --bs-dropdown-padding-y: 0.5rem;
        --bs-dropdown-spacer: 0.125rem;
        --bs-dropdown-font-size: 1rem;
        --bs-dropdown-color: var(--bs-body-color);
        --bs-dropdown-bg: white;
        --bs-dropdown-border-color: var(--bs-border-color-translucent);
        --bs-dropdown-border-radius: var(--bs-border-radius);
        --bs-dropdown-border-width: var(--bs-border-width);
        --bs-dropdown-inner-border-radius: calc(var(--bs-border-radius) - var(--bs-border-width));
        --bs-dropdown-divider-bg: var(--bs-border-color-translucent);
        --bs-dropdown-divider-margin-y: 0.5rem;
        --bs-dropdown-box-shadow: var(--bs-box-shadow);
        --bs-dropdown-link-color: var(--bs-body-color);
        --bs-dropdown-link-hover-color: var(--bs-body-color);
        --bs-dropdown-link-hover-bg: var(--bs-tertiary-bg);
        --bs-dropdown-link-active-color: #fff;
        --bs-dropdown-link-active-bg: #8669AE;
        --bs-dropdown-link-disabled-color: var(--bs-tertiary-color);
        --bs-dropdown-item-padding-x: 1rem;
        --bs-dropdown-item-padding-y: 0.25rem;
        --bs-dropdown-header-color: #6c757d;
        --bs-dropdown-header-padding-x: 1rem;
        --bs-dropdown-header-padding-y: 0.5rem;
        position: absolute;
        z-index: var(--bs-dropdown-zindex);
        display: none;
        min-width: var(--bs-dropdown-min-width);
        padding: var(--bs-dropdown-padding-y) var(--bs-dropdown-padding-x);
        margin: 0;
        font-size: var(--bs-dropdown-font-size);
        color: var(--bs-dropdown-color);
        text-align: left;
        list-style: none;
        background-color: var(--bs-dropdown-bg);
        background-clip: padding-box;
        border: var(--bs-dropdown-border-width) solid var(--bs-dropdown-border-color);
        border-radius: var(--bs-dropdown-border-radius);
    }

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
        font-family: 'Cambria', serif;
    }

    /* Applying to headings */
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: 'Cambria', serif;
    }


    @media (max-width: 768px) {
        .hd {
            color: white;
        }
    }



    @media (max-width: 768px) {
        .navbar-nav {
            background: white;
            color: black;
        }
    }


    /* Applying to paragraphs */
    p {
        font-family: 'Cambria', serif;
    }

    /* Custom CSS */
    .navbar-nav {
        justify-content: center;
        /* Centering the nav items */
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

    .carousel-caption {
        bottom: 20px;
        right: 20px;
        text-align: right;
        z-index: 2;
        color: white;
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

    .navbar-dark .navbar-nav .nav-link {
        color: white;
    }

    @media (max-width: 768px) {
        .navbar-dark .navbar-nav .nav-link {
            color: black;
            /* White color for mobile devices */
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
    }

    .nav-item:hover .mega-box {
        opacity: 1;
        visibility: visible;
    }

    .mega-box .content {
        /* background-color: white; */
        padding: 25px 20px;
        display: flex;
        width: 100%;
        justify-content: space-between;
        font-size: 14px;

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

    /* ---------------------loader------------------ */
</style>

<style>
    .card {
        background: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), 0 8px 16px rgba(0, 0, 0, 0.4);

        transition: box-shadow 0.3s ease-in-out;
        border-radius: 5px;
    }

    .card:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4), 0 12px 24px rgba(0, 0, 0, 0.6);
    }
</style>

<style>
    /* .content {
        max-width: 100%;
        margin: auto;
        overflow: hidden;
    } */

    .multiple-items .slider {
        text-align: center;
        /* Centering the content within the slide */
    }

    .slick-slide {
        display: flex;
        justify-content: center;
    }

    .card-body-slider {
        text-align: left;
        width: 220px;
    }

    @media (max-width: 768px) {
        .card-body-slider {
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .card-body-slider {
            width: 100%;
        }
    }


    .slider {
        margin: 0 auto;
        max-width: 100%;
    }

    .icon-wrapper {
        color: #FFD700;
    }

    .card-body p {
        margin: 0;
    }

    .text-gray-500 {
        color: #6B7280;
        /* Tailwind gray-500 */
    }

    .text-gray-700 {
        color: #374151;
        /* Tailwind gray-700 */
    }

    .font-bold {
        font-weight: 700;
    }

    .mb-1 {
        margin-bottom: 0.25rem;
    }

    .mb-2 {
        margin-bottom: 0.5rem;
    }

    .mb-4 {
        margin-bottom: 1rem;
    }

    .text-lg {
        font-size: 1.125rem;
    }

    .text-sm {
        font-size: 0.875rem;
    }

    .d-flex {
        display: flex;
    }

    .align-items-center {
        align-items: center;
    }


    .slider .slick-slide {
        padding: 10px;
    }

    .font-bold {
        font-weight: 700;
    }

    .mb-1 {
        margin-bottom: 0.25rem;
    }

    .mb-2 {
        margin-bottom: 0.5rem;
    }

    .mb-4 {
        margin-bottom: 1rem;
    }

    .text-lg {
        font-size: 1.125rem;
    }

    .text-sm {
        font-size: 0.875rem;
    }

    .d-flex {
        display: flex;
    }

    .align-items-center {
        align-items: center;
    }

    .ml-2 {
        margin-left: 0.5rem;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    /* Style for navigation buttons */
    .slick-prev,
    .slick-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 1;
        font-size: 1.5rem;
        cursor: pointer;
        /* color: #000; */
        /* background-color: rgba(255, 255, 255, 0.7); */
        border: none;
        outline: none;
        padding: 10px;
    }

    .slick-prev:before,
    .slick-next:before {
        font-family: 'slick';
        font-size: 30px;
        line-height: 1;
        opacity: .75;
        color: black;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .slick-prev:before,
    .slick-next:before {
        font-family: 'slick';
        font-size: 30px;
        line-height: 1;
        opacity: .75;
        color: black;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        margin-left: -14px;
    }


    @media (max-width: 768px) {

        .slick-prev:before,
        .slick-next:before {
            font-family: 'slick';
            font-size: 30px;
            line-height: 1;
            opacity: .75;
            color: black;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            margin-left: -50px;
        }
    }


    @media (max-width: 768px) {

        .slick-prev {
            left: 50px;
        }

        .slick-next {
            right: 5px;
        }
    }
</style>

<!-- instragram  -->
<style>
    .wrapper {
        display: flex;
        justify-content: center;
        /* Center the card horizontally */
        width: 100%;
    }

    .cardd {
        position: relative;
        display: flex;
        align-items: center;
        /* Center content vertically */
        justify-content: center;
        /* Center content horizontally */
        padding: 2rem 1rem;
        background-color: #fff;
        box-shadow: 0px 7px 10px rgba(0, 0, 0, 0.5);
        transition: 0.5s ease-in-out;
        width: 100%;
        /* Ensure card takes full width */
    }

    .cardd:hover {
        transform: translateY(-20px);
    }

    .cardd::before {
        content: "";
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom,
                rgba(45, 91, 169, 0.5),
                rgba(132, 98, 170, 1));
        z-index: 2;
        transition: 0.5s all;
        opacity: 0;
    }

    .cardd:hover::before {
        opacity: 1;
    }

    .cardd img,
    video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .cardd .overlay {
        position: relative;
        z-index: 3;
        color: #fff;
        opacity: 0;
        transform: translateY(30px);
        transition: 0.5s all;
        padding: 30px 0px;
        text-align: center;
        /* Center text */
    }

    .cardd:hover .overlay {
        opacity: 1;
        transform: translateY(0);
    }

    .title {
        color: white;
    }

    .text-p {
        display: flex;
        justify-content: center;
        align-items: center;
        letter-spacing: 1px;
        margin-top: 8px;
        margin-bottom: 10px;
        text-align: center;
        /* Center text */
    }



    .icon-wrapper i {
        color: #00b67a;
        font-size: 15px;
        line-height: 20px;
    }

    .details {
        display: inline-block;
        text-align: center;
    }

    .details i {
        color: white;
        margin-right: 10px;
    }

    .details .text-white {
        margin-right: 10px;
    }

    .link-a {
        padding: 0.5rem 1rem;
        background-color: #fff;
        color: #000;
        cursor: pointer;
        transition: 0.4s ease-in-out;
    }

    .link-a:hover {
        box-shadow: 0px 7px 10px rgba(0, 0, 0, 0.5);
    }

    @media (max-width: 768px) {
        .col-mb-2 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
</style>

<!-- Add to cart section  -->
<style>
    .card-product-slider {
        position: relative;
        overflow: hidden;
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .card-product-slider-img-top {
        transition: transform 0.5s ease;
        width: 100%;
        border-radius: 10px 10px 0 0;
    }

    .card-product-slider:hover .card-product-slider-img-top {
        transform: scale(1.2);
    }

    .card-product-slider-img-wrapper {
        position: relative;
        overflow: hidden;
        border-radius: 10px 10px 0 0;
    }

    .card-product-slider-img-wrapper::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle,
                rgba(0, 0, 0, 0) 0%,
                rgba(0, 0, 0, 0.05) 50%,
                rgba(49, 46, 46, 0.5) 75%,
                rgba(48, 46, 46, 0.7) 100%);
        filter: blur(5px);
        clip-path: circle(80% at center);
        transition: opacity 0.5s ease;
        opacity: 0;
        z-index: 1;
    }

    .card-product-slider:hover .card-product-slider-img-wrapper::before {
        opacity: 1;
    }

    .card-product-slider-body {
        text-align: center;
        background-color: #fff;
        border-radius: 0 0 10px 10px;
        height: 75px;
    }

    .card-product-slider-title {
        font-weight: bold;
        color: #333;
    }

    .price {
        font-size: 14px;
        color: black;
        /* Using user's preferred color */
        margin: 10px 0;

    }

    .rating {
        color: gold;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 10px 0;
    }

    .rating i {
        margin: 0 2px;
        font-size: 1.2em;
    }

    .rating i.filled {
        color: gold;
    }

    .rating i.unfilled {
        color: #ddd;
    }

    .card-product-slider-icons {
        position: absolute;
        top: 10px;
        right: 10px;
        display: flex;
        flex-direction: column;
        gap: 5px;
        opacity: 0;
        transition: opacity 0.5s ease;
    }

    .card-product-slider:hover .card-product-slider-icons {
        opacity: 1;
    }

    .card-product-slider-icons i {
        color: #fff;
        font-size: 1.5em;
        background: rgba(0, 0, 0, 0.5);
        padding: 5px;
        border-radius: 50%;
    }

    a.stretched-link {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 10;
    }

    a {
        text-decoration: none;
        color: inherit;
    }
</style>
<style>
    /* Add your custom styles here */
    .cart-sidebar {
        position: fixed;
        top: 0;
        left: -300px;
        /* Initially off-screen */
        width: 300px;
        height: 100%;
        background-color: #f8f9fa;
        /* Example background color */
        transition: all 0.3s ease;
        padding: 20px;
    }
</style>


<style>
    .card-product-slider {
        position: relative;
        overflow: hidden;
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .card-product-slider-img-top {
        transition: transform 0.5s ease;
        width: 100%;
        border-radius: 10px 10px 0 0;
    }

    .card-product-slider:hover .card-product-slider-img-top {
        transform: scale(1.2);
    }

    .card-product-slider-img-wrapper {
        position: relative;
        overflow: hidden;
        border-radius: 10px 10px 0 0;
    }

    .card-product-slider-img-wrapper::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle,
                rgba(0, 0, 0, 0) 0%,
                rgba(0, 0, 0, 0.05) 50%,
                rgba(49, 46, 46, 0.5) 75%,
                rgba(48, 46, 46, 0.7) 100%);
        filter: blur(5px);
        clip-path: circle(80% at center);
        transition: opacity 0.5s ease;
        opacity: 0;
        z-index: 1;
    }

    .card-product-slider:hover .card-product-slider-img-wrapper::before {
        opacity: 1;
    }

    .card-product-slider-body {
        text-align: center;
        background-color: #fff;
        border-radius: 0 0 10px 10px;
        height: 75px;
    }

    .card-product-slider-title {
        font-weight: bold;
        color: #333;
    }

    .price {
        font-size: 14px;
        color: black;
        /* Using user's preferred color */
        margin: 10px 0;
    }

    .rating {
        color: gold;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 10px 0;
    }

    .rating i {
        margin: 0 2px;
        font-size: 1.2em;
    }

    .rating i.filled {
        color: gold;
    }

    .rating i.unfilled {
        color: black;
    }

    .card-product-slider-icons {
        position: absolute;
        top: 10px;
        right: 10px;
        display: flex;
        flex-direction: column;
        gap: 5px;
        opacity: 0;
        transition: opacity 0.5s ease;
    }

    .card-product-slider:hover .card-product-slider-icons {
        opacity: 1;
    }

    .card-product-slider-icons i {
        color: black;
        font-size: 1.5em;
        background: rgba(0, 0, 0, 0.5);
        padding: 5px;
        border-radius: 50%;
    }

    a.stretched-link {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 10;
    }

    a {
        text-decoration: none;
        color: inherit;
    }

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

    .col-6 {
        flex: 0 0 auto;
        width: 50%;
        margin-bottom: 15px;
    }
</style>



<!-- chat boot -->
<style>
    #chatbot {
        width: 300px;
        height: 450px;
        position: fixed;
        bottom: 80px;
        right: 30px;
        background-color: #000000;
        /* Black background */
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        display: none;
        flex-direction: column;
        overflow: hidden;
        z-index: 1000;
        transition: opacity 0.3s ease;
    }

    @media screen (547) {}

    #chatbot-header {
        background-color: #1a1a1a;
        /* Darker black for header */
        color: white;
        padding: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    #chatbot-header span {
        font-weight: bold;
    }

    #close-chatbot {
        background: none;
        border: none;
        color: white;
        font-size: 16px;
        cursor: pointer;
    }

    #chatbot-body {
        padding: 10px;
        flex-grow: 1;
        overflow-y: auto;
        color: white;
        display: flex;
        flex-direction: column;
    }

    #chatbot-body .message {
        margin-bottom: 10px;
        opacity: 0;
        animation: fadeInUp 0.5s ease forwards;
        padding: 8px;
        border-radius: 10px;
        max-width: 80%;
        word-break: break-word;
    }

    #chatbot-body .message.user {
        align-self: flex-end;
        background-color: #333333;
        /* Dark grey background for user */
        color: white;
    }

    #chatbot-body .message.bot {
        align-self: flex-start;
        background-color: #1a1a1a;
        /* Slightly darker grey background for bot */
        color: white;
    }

    #chatbot-body .message.user:hover,
    #chatbot-body .message.bot:hover {
        background-color: #000000;
        /* Black on hover */
        transition: background-color 0.3s ease;
    }

    #chatbot-input {
        background-color: #000000;
        /* Black input area */
        padding: 10px;
        display: flex;
        align-items: center;
        border-top: 1px solid #333333;
    }

    #chatbot-input input {
        flex-grow: 1;
        padding: 5px;
        border: none;
        border-radius: 5px;
        background-color: #333333;
        /* Dark grey input background */
        color: white;
        margin-right: 10px;
    }

    #chatbot-input button {
        padding: 5px 10px;
        background-color: #1a1a1a;
        /* Darker button background */
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    #chatbot-button {
        width: 60px;
        height: 60px;
        position: fixed;
        bottom: 10px;
        right: 30px;
        background-color: #000000;
        /* Black background for the button */
        border-radius: 50%;
        border: none;
        cursor: pointer;
        z-index: 1001;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #chatbot-button img {
        width: 30px;
        height: 30px;
        filter: invert(100%);
        /* Makes the chat icon white */
    }

    .option {
        cursor: pointer;
        color: #ffffff;
        /* White text for options */
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
        transition: color 0.3s ease;
    }

    .option:hover {
        color: #cccccc;
        /* Light grey on hover */
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive styles */
    @media (max-width: 600px) {
        #chatbot {
            width: 300px;
            height: 400px;
            bottom: 10px;
            right: 10px;
        }

        #chatbot-body .message {
            max-width: 90%;
        }

        #chatbot-button {
            width: 50px;
            height: 50px;
            bottom: 10px;
            right: 10px;
        }

        #chatbot-button img {
            width: 25px;
            height: 25px;
        }
    }
</style>

<!-- privacy policy -->
<style>
    #recaptcha-sidebar {
        position: fixed;
        bottom: 10px;
        left: 10px;
        z-index: 1002;
        height: 50px;
        width: 50px;
        background-color: white;
        border-radius: 5px;
        overflow: hidden;
        display: flex;
        align-items: center;
        transition: width 0.3s ease;
    }

    #recaptcha-content {
        display: flex;
        align-items: center;
        height: 100%;
        transition: padding-left 0.3s ease;
    }

    #recaptcha-text {
        display: none;
        align-items: center;
        background-color: #007BFF;
        color: white;
        height: 100%;
        font-size: 14px;
        white-space: nowrap;
        padding-left: 10px;
        flex-grow: 1;
        transition: opacity 0.3s ease;
    }

    #recaptcha-icon {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: margin-left 0.3s ease;
    }

    #recaptcha-sidebar.expanded {
        width: 400px;
        /* Expand to fit the text content */
    }

    #recaptcha-sidebar.expanded #recaptcha-text {
        display: flex;
        opacity: 1;
    }

    #recaptcha-sidebar.expanded #recaptcha-icon {
        margin-left: 20px;
        /* Adjust spacing as needed */
    }



    @media (max-width: 768px) {
        #chatbot-button {
            width: 50px;
            height: 50px;
            bottom: 10px;
            right: 15px;
        }
    }
</style>