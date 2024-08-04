<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fidelis - @yield('title')</title>
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" href="{{ asset('img/logo.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('img/logo.png') }}">

    <link rel="stylesheet" href="{{ asset('dist/css/fontAwesome/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/fontAwesome/solid.css') }}">

    @yield('stylesheet')

</head>

<body>
    @include('layouts.aside')

    <main>
        @include('layouts.navigation')
        @yield('content')
    </main>

    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
    <script src="{{ asset('dist/js/smooth-scrollbar.js') }}"></script>
    <script src="{{ asset('dist/js/main.js') }}"></script>

    @yield('script')
</body>

</html>
