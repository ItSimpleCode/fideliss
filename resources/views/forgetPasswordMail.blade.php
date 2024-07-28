<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap');

        body {
            overflow: hidden;
        }

        .email-container {
            background-color: #218cb32b;
            width: 100%;
            padding: 5px;
        }

        .email-wrraper {
            width: 50%;
            margin: 0 auto;
            padding: 10px 5px;
            font-family: 'Poppins', sans-serif;
            background-color: white;
            border-radius: 5px;
        }

        h1 {
            font-size: 15px;
            margin-left: 10px;
            color: black;
        }

        .email-body h3 {
            background-color: #218cb32b;
            width: fit-content;
            margin: 40px auto;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 25px;
            font-weight: 600
        }

        .email-body p {
            font-size: 10px;
            /* font-weight: 600; */
            color: rgb(66, 66, 66);
        }

        footer p {
            font-size: 10px
        }
    </style>
    <title>Document</title>
</head>

<body>
    <div class="email-container">
        <div class="email-wrraper">
            <h1>That's your Password</h3>
                <div class="email-body">
                    <h3>{{ $code }}</h3>
                    <p>
                        Vous avez recus ce code par [Fidelis team] pour verifier votre address e-mail, Ne partage pas ce
                        code
                    </p>
                </div>
                <footer>
                    <p>© 2024 Fidelis International Ltd.</p>
                </footer>

        </div>
    </div>


</body>

</html>
