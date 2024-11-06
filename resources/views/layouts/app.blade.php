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
    <style>
        .card {
            box-shadow: unset;
        }

        .card:hover {
            box-shadow: unset;
        }
    </style>
</head>

<body>
    @php
    use App\Helpers\TranslationHelper;
    $preferredLanguage = session('preferredLanguage');
    $account = TranslationHelper::translateText('My account', $preferredLanguage);
    $order = TranslationHelper::translateText('My Orders', $preferredLanguage);
    $wishlist = TranslationHelper::translateText('Wishlist', $preferredLanguage);
    $ticket = TranslationHelper::translateText('My Tickets', $preferredLanguage);
    $upload = TranslationHelper::translateText('Upload Prescription', $preferredLanguage);
    $account = TranslationHelper::translateText('Account Information', $preferredLanguage);
    $subs = TranslationHelper::translateText('Newsletter Subscriptions', $preferredLanguage);
    $return = TranslationHelper::translateText('Returned Products', $preferredLanguage);
    $logout = TranslationHelper::translateText('Logout', $preferredLanguage);
    @endphp
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
                font-size: 16px !important;
                font-weight: 600 !important;
                color: #000;
                margin-bottom: 10px;
                padding-left: 0;
                padding-top: 10px;
                padding-bottom: 10px;
                text-decoration: none;
                position: relative;
                display: block;
            }

            .dashboard .nav-link:hover::after{
                width: 100%;
                transition: 0.5s;
            }

            .dashboard .nav-link::after{
                position: absolute;
                bottom: 0px;
                left: 0;
                height: 2px;
                width: 0px;
                display: block !important
            }
        </style>

        <div class="container dashboard">
            <div class="row">
                <!-- Sidebar -->
                <nav class="col-md-4 col-lg-3 d-md-block accountbar">
                    <div class="position-sticky">
                        <ul class="nav flex-column ">
                            <li class="nav-item">
                                <a class="nav-link text-uppercase" href="{{route('user.home')}}"> {{$account}} </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-uppercase" href="{{route('ego.orders')}}">{{$order}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-uppercase" href="{{route('ego.wishlist')}}">{{$wishlist}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-uppercase" href="{{ route('ticket.index') }}">{{$ticket}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-uppercase" href="{{route('user.upload.prescription')}}">{{$upload}}</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="#">Compare Products</a>
                            </li> -->
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="#">Address Book</a>
                            </li> -->
                            <li class="nav-item">
                                <a class="nav-link text-uppercase" href="{{ route('user.profile.setting') }}">{{$account}}</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="#">Privacy Settings</a>
                            </li> -->

                            <li class="nav-item">
                                <a class="nav-link text-uppercase" href="{{route('ego.newsLetter')}}">{{$subs}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-uppercase" href="{{route('return.show')}}">{{$return}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-uppercase" href="#" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">{{$logout}}</a>
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