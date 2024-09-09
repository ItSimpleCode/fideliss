<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fidelis - @yield('title')</title>

    <link rel="icon" href="{{ asset('img/logo.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('img/logo.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@100..800&display=swap" rel="stylesheet">

    @yield('stylesheet')
</head>

<body>
@include('layouts.navigation')

<main>
    @include('layouts.aside')
    <section class="content">
        @error('error')
        <div class="error">
            <span class="message">{{ $message }}</span>
            <button class="close_error">x</button>
        </div>
        @enderror
        @yield('content')
    </section>
</main>

<script src="{{ asset('dist/js/utils/message.js') }}"></script>
<script src="{{ asset('dist/js/main.js') }}"></script>
@yield('script')
</body>

</html>
