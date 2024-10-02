<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $pageTitle }}</title>
    <link rel="shortcut icon" type="image/png" href="{{getImage(getFilePath('logoIcon') .'/favicon.png')}}">

    <!-- @include('admin.include.css') -->
    <!-- @stack('style-lib')
    @stack('style') -->

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
                                <a class="nav-link" href="#">Gift Card</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Newsletter Subscriptions</a>
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

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{asset('assets/global/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/global/js/bootstrap.bundle.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    @stack('script-lib')

    @stack('script')


</body>

</html>