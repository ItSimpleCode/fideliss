<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap');


        .email-container {
            background-color: #218cb32b;
            width: 100%;
            padding: 5px;
            overflow: hidden;
            max-width: 100%;
            width: 100%;
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
            width: fit-content;
            text-transform: capitalize;
            margin: 40px 0;
            font-size: 25px;
            font-weight: 600
        }

        .email-body p {
            font-size: 12px;
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
            <h1>Alerte de Sécurité</h3>
                <div class="email-body">
                    <h3>Bonjour, {{ $fullName }}</h3>
                    <p>
                        Vous vous êtes connecté avec succès à votre tableau de bord le {{ $currentDateTime }}.
                        Si ce n'était pas vous, veuillez contacter immédiatement le support.
                    </p>
                </div>
                <footer>
                    <p>© 2024 Fidelis International Team.</p>
                </footer>

        </div>
    </div>


</body>

</html>
