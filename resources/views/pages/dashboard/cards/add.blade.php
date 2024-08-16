@extends('dashboard')

@section('title', 'Cardes - Ajouter')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist/css/pages/cards/add.css') }}">
@endsection

@section('content')
    <section class="outer-bg h-100">
        <div class="head">
            <div class="title">
                <a href="{{ route('client.cards', ['id' => $client['id']]) }}">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span>Cartes</span>
            </div>
        </div>
        <div class="form body">
            <form action="{{ route('cards.create.store', ['id' => $client['id']]) }}" method="POST">
                @csrf
                <div class="part">
                    <h2 class="title">Informations sur la carte</h2>
                    <div class="double-fields">
                        <div class="selection-field">
                            <div class="field">
                                <label for="type">type de carte</label>
                                <input class="back" type="hidden" name="card_type">
                                <input class="front" type="text" id="type">
                                <i class="fa-solid fa-angle-down"></i>
                            </div>
                            <div class="options">
                                @foreach ($cards as $card)
                                    <span class="option" data-hidden="{{ $card['id'] }}">{{ $card['name'] }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="field">
                            <label for="wallet">porte-monnaie</label>
                            <input type="text" name="wallet" id="wallet">
                        </div>
                    </div>
                </div>
                <div class="part">
                    <h2 class="title">Informations sur le client</h2>
                    <div class="double-fields">
                        <div class="field disabled">
                            <label for="first-name">prénom</label>
                            <input type="text" name="" id="first-name" value="{{ $client['first_name'] }}" disabled>
                        </div>
                        <div class="field disabled">
                            <label for="last-name">nom</label>
                            <input type="text" name="" id="last-name" value="{{ $client['last_name'] }}" disabled>
                        </div>
                    </div>
                    <div class="double-fields">
                        <div class="field disabled">
                            <label for="email">email</label>
                            <input type="text" name="" id="email" value="{{ $client['email'] }}" disabled>
                        </div>
                        <div class="field disabled">
                            <label for="phone">numéro de téléphone</label>
                            <input type="text" name="" id="phone" value="{{ $client['phone_number'] }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="part">
                    <button class="button-add" type="submit"><i class="fa-regular fa-credit-card"></i><span>ajouter une carte</span></button>
                </div>

            </form>
            <div class="preview">
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
                <div class="card-2 back">
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ asset('dist/js/utils/form.js') }}"></script>
@endsection
