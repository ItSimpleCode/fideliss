<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fidelis - Forget Password</title>
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
    <h1>forget password page</h1>
    <form action={{ route('forgetPassword.sendPassword') }} method="POST">
        @csrf

        @error('error')
            <div class="error">
                {{ $message }}
            </div>
        @enderror

        <label for="email">Email: </label>
        <input type="text" id="email" name="email" value="{{ old('email') }}" autofocus>
        <br>
        <button>Send</button>
        <a href={{ route('login.show') }}>back to login page</a>
    </form>
</body>

</html>
