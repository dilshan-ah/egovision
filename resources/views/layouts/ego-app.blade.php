<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $pageTitle }}</title>
    <link rel="shortcut icon" type="image/png"
        href="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQpCpNz-irG5IbwGxK6R7aIddZsHr1b6dqOXw&s">
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="Welcome to Ego Colored Contact Lens Official Store">
    <meta property="og:image"
        content="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQpCpNz-irG5IbwGxK6R7aIddZsHr1b6dqOXw&s">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Prata&display=swap" rel="stylesheet">
    @stack('style')
    @include('ego.include.css')
</head>

<body>
    <!-- @include('ego.include.loader') -->
    @if(session('success'))
    <div id="successAlert" class="alert alert-success alert-dismissible fade show position-fixed" style="top: 50px; right: 30px; z-index: 999" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <script>
        // Check if the alert exists
        const successAlert = document.getElementById('successAlert');
        if (successAlert) {
            // Set a timeout to hide the alert after 5 seconds (5000 milliseconds)
            setTimeout(() => {
                successAlert.classList.remove('show');
                successAlert.classList.add('fade');
                setTimeout(() => {
                    successAlert.remove();
                }, 500);
            }, 2500);
        }
    </script>


    @include('ego.include.topbar')
    @if (!Route::is('ego.index'))
    @include('ego.include.header')
    @endif

    <main>
        @include('partials.notify')
        @yield('content')
    </main>
    @include('ego.include.footer')
    @include('ego.include.chatbot')
    @include('ego.include.js')
    @stack('script')
</body>

</html>