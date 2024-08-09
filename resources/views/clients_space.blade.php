<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>clients space</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{ asset('dist\css\pages\clients_space\clients_space.css') }}">
</head>

<body>
    <header class="card owl-carousel">
        @for ($i = 0; $i < 5; $i++)
            <div class="card-2 front">
                <img class="bg-img" src="{{ asset('img/VIrus4 1.png') }}" alt="">
                <div class="info flex-column">
                    <div class="up flex-column">
                        <div class="flex-row">
                            <div class="flex-row">
                                <span class="logo">
                                    <img src="{{ asset('img/logo2.png') }}" alt="">
                                </span>
                                <span class="wallet">0</span>
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
        @endfor
    </header>

    <section class="body">
        <div class="title">
            <div class="text">portefeuille</div>
            <div class="wallet">898,00 poins</div>
        </div>
        <div>
            <div class="nav">
                <ul>
                    <li>rewords</li>
                    <li>histoire</li>
                </ul>
            </div>
            <div class="data">
                <ul>
                    <li>
                        <div>
                            <img src="" alt="">
                            <h2>xxxxxxxx</h2>
                        </div>
                        <div>1000 points</div>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        $('.owl-carousel').owlCarousel({
            center: true,
            items: 1,
            loop: true,
        });
    </script>

</body>

</html>
