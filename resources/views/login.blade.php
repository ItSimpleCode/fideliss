<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fidelis - Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist/css/log_in.css') }}">
</head>

<body>
    @error('error')
        <div class="message"><span>{{ $message }}</span><button class="close_error">x</button></div>
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
