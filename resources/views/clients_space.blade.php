<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>clients space</title>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@100..800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{ asset('dist\css\pages\clients_space\clients_space.css') }}">
</head>

<body>
    <div class="container">
        <header class="card">
            <div class="card-2 front">
                <div class="info flex-column">
                    <div class="up flex-column">
                        <div class="flex-row">
                            <div class="flex-row">
                                <span class="logo">
                                    <img src="{{ asset('img/logo2.png') }}" alt="">
                                </span>
                            </div>
                            <div class="qr-code"> <img src="{{ asset('img/qr_code.png') }}" alt=""> </div>
                        </div>
                        <div class="serial">xxxx xxxx xxxx xxxx</div>
                    </div>
                    <div class="down flex-row">
                        <div class="flex-column">
                            <div class="type-of-card">Carte de membre standard</div>
                            <div class="flex-row">
                                <div class="name">youssef elqayedy</div>
                                <div class="expiry">03/30</div>
                            </div>
                        </div>
                        <div class="paypass">
                            <img src="{{ asset('img/paypass.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <section class="body">
            <div class="title">
                <div class="text">portefeuille</div>
                <div class="wallet">{{ rand(1000, 5000) }} poins</div>
            </div>
            <div class="list">
                <div class="nav">
                    <ul>
                        <li><a class="selected" href="">rewords</a></li>
                        <li><a href="">histoire</a></li>
                    </ul>
                </div>
                <div class="data">
                    <ul>
                        @for ($i = 0; $i < 20; $i++)
                            <li>
                                <a href="">
                                    <div class="service">
                                        {{-- <img class="img" src="" alt="" width="50" height="50"> --}}
                                        <div class="img"></div>
                                        <span>xxxxxxxx</span>
                                    </div>
                                    <div class="cost">{{ rand(100, 1000) }} points</div>
                                </a>
                            </li>
                        @endfor
                    </ul>
                </div>
            </div>
        </section>
    </div>


</body>

</html>
