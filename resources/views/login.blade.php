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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

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
        <h1>Connectez-vous à votre compte</h1>
    </div>
    <form class="form" action={{ route('login') }} method="POST">
        @csrf
        <div class="field">
            <label for="email">Adresse email</label>
            <div class="input">
                <input type="text" id="email" name="email" placeholder="fidelis@email.com" value="y" autofocus required>
                <i class="fa-solid fa-envelope"></i>
            </div>
        </div>
        <div class="field">
            <label for="password">mot de passe</label>
            <div class="input">
                <input type="password" id="password" name="password" placeholder="Enter your password" value="y"
                       required>
                <i class="fa-solid fa-lock"></i>
            </div>
            <div class="link">
                <a href={{ route('forgetPassword.show') }}>mot de passe oublié?</a>
            </div>
        </div>
        <button type="submit">Connectez-vous maintenant</button>
    </form>
</div>

<script src="{{ asset('dist/js/utils/message.js') }}"></script>
</body>

</html>
