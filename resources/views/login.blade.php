<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fidelis - Login</title>
    <style>
        form {
            width: fit-content;
        }

        .error {
            background-color: rgba(247, 105, 105, 0.464);
            color: red;
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            padding: 5px 0;
        }
    </style>
</head>

<body>
    <h1>Login page</h1>
    <form action={{ route('login') }} method="POST">
        @csrf

        @error('error')
            <div class="error">
                {{ $message }}
            </div>
        @enderror

        <label for="email">Email: </label>
        <input type="text" id="email" name="email" autofocus>
        <br>
        <label for="password">Password: </label>
        <input type="text" id="password" name="password">
        <br>
        <button>Login</button>
        {{-- <a href={{ route('forgetPassword.show') }}>forget password</a> --}}
    </form>

</body>

</html>
