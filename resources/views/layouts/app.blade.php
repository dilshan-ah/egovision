<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $pageTitle }}</title>
    <link rel="shortcut icon" type="image/png" href="{{getImage(getFilePath('logoIcon') .'/favicon.png')}}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Prata&display=swap" rel="stylesheet">
    @stack('style')
    @include('ego.include.css')
</head>

<body>
    <div id="app">
        @include('ego.include.header')
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <style>
            .dashboard .nav-link {
                font-size: 0.9rem;
                font-weight: 400;
                color: #555;
                margin-bottom: 10px;
                padding-left: 0;
                padding-top: 10px;
                padding-bottom: 10px;
                text-decoration: none;
                position: relative;
                display: block;
            }

        </style>

        <div class="container-fluid dashboard">
            <div class="row">
                <!-- Sidebar -->
                <nav class="col-md-4 col-lg-3 d-md-block accountbar">
                    <div class="position-sticky">
                        <ul class="nav flex-column ">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('user.home')}}"> MY ACCOUNT </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('ego.orders')}}">My Orders</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('ego.wishlist')}}">Wishlist</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('ticket.index') }}">My Tickets</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('user.upload.prescription')}}">Upload Prescription</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="#">Compare Products</a>
                            </li> -->
                            <li class="nav-item">
                                <a class="nav-link" href="#">Address Book</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.profile.setting') }}">Account Information</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="#">Privacy Settings</a>
                            </li> -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('ego.giftCard')}}">Gift Card</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('ego.newsLetter')}}">Newsletter Subscriptions</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>
                            </li>
                            <form id="logout-form" action="{{ route('user.logout') }}" method="get" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </div>
                </nav>

                <main class="col-md-8 col-lg-9 ms-sm-auto px-md-4">
                    @include('partials.notify')
                    @yield('content')
                </main>

            </div>
        </div>
    </div>
    @include('ego.include.footer')
    @include('ego.include.js')

</body>

</html>