<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fidelis - Login</title>
    <link rel="icon" href="{{ asset('img/logo.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('img/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/log_in.css') }}">
</head>

<body>
    @error('error')
        <div class="message">
            <span>{{ $message }}</span>
            <button class="close_error"><i class="fa-solid fa-xmark"></i></button>
        </div>
    @enderror
    <div class="log_in">
        <div class="head">
            <img class="logo" src="{{ asset('img/logo.png') }}" alt="fediles logo">
            <h1>Log in</h1>
        </div>
        <form class="form" action={{ route('login') }} method="POST">
            @csrf
            <div>
                <label for="email">email</label>
                <input type="text" id="email" name="email" autofocus required>
            </div>
            <div>
                <label for="password">password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button>connect</button>
            {{-- <a href={{ route('forgetPassword.show') }}>forget password</a> --}}
        </form>
    </div>

    <script>
        window.addEventListener('load', () => {
            const messages = document.querySelectorAll('.message');
            const messagesCloseError = document.querySelectorAll('.message .close_error');

            messages.forEach(e => (e?.classList.add('show'), console.log(e)));

            messagesCloseError.forEach(btn => {
                btn.onclick = () => {
                    messages.forEach(parent => {

                        if (parent.contains(btn)) parent.classList.remove('show');

                    })
                };

            });;
        });
    </script>

</body>

</html>
