<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fidelis - Connexion</title>
    <link rel="icon" href="{{ asset('img/logo.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('img/logo.png') }}">

    <link rel="stylesheet" href="{{ asset('dist/css/fontAwesome/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/fontAwesome/solid.css') }}">

    <link rel="stylesheet" href="{{ asset('dist/css/pages/log_in/log_in.css') }}">
</head>

<body>
    @error('error')
        <div class="error">
            <span class="message">{{ $message }}</span>
            <button class="close_error"><i class="fa-solid fa-xmark"></i></button>
        </div>
    @enderror
    <div class="log_in">
        <div class="head">
            <img class="logo" src="{{ asset('img/logo.png') }}" alt="logo de Fidelis">
            <h1>Connexion</h1>
        </div>
        <form class="form" action={{ route('login') }} method="POST">
            @csrf
            <div>
                <label for="email">email</label>
                <input type="text" id="email" name="email" autofocus required value="y">
            </div>
            <div>
                <label for="password">mot de passe</label>
                <input type="password" id="password" name="password" required value="y">
            </div>
            <button>se connecter</button>
            {{-- <a href={{ route('forgetPassword.show') }}>mot de passe oublié</a> --}}
        </form>
    </div>

    <script src="{{ asset('dist/js/utils/message.js') }}"></script>
</body>

</html>
