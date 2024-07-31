<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="icon" href="{{ asset('img/logo.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('img/logo.png') }}">

    <link rel="preload" href="{{ asset('dist/css/all.min.css') }}" as="style">

    <link rel="preload" href="{{ asset('fonts/SF-Pro-Rounded-Black.otf') }}" as="font" type="font/otf" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('fonts/SF-Pro-Rounded-Bold.otf') }}" as="font" type="font/otf" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('fonts/SF-Pro-Rounded-Heavy.otf') }}" as="font" type="font/otf" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('fonts/SF-Pro-Rounded-Light.otf') }}" as="font" type="font/otf" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('fonts/SF-Pro-Rounded-Medium.otf') }}" as="font" type="font/otf" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('fonts/SF-Pro-Rounded-Regular.otf') }}" as="font" type="font/otf" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('fonts/SF-Pro-Rounded-Semibold.otf') }}" as="font" type="font/otf" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('fonts/SF-Pro-Rounded-Thin.otf') }}" as="font" type="font/otf" crossorigin="anonymous">
    <link rel="preload" href="{{ asset('fonts/SF-Pro-Rounded-Thin.otf') }}" as="font" type="font/otf" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('dist/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/statistics.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/users.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/cards.css') }}">
</head>

<body>
    @include('layouts.aside')

    <main>
        @include('layouts.navigation')
        @yield('content')
    </main>

    <script src="{{ asset('dist/js/smooth-scrollbar.js') }}"></script>
    <script src="{{ asset('dist/js/main.js') }}"></script>
</body>

</html>
