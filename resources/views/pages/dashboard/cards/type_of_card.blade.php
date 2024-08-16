@extends('dashboard')

@section('title', 'Cardes - Ajouter')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist/css/pages/cards/type_of_card.css') }}">
@endsection

@section('content')
    <section class="outer-bg mh-100">
        <div class="head">
            <div class="title">
                <a href="{{ Route('cards') }}">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span>Ajouter Une Nouvelle Carte</span>
            </div>
        </div>

        <div class="form body">
            <form action={{ route('cards.store.type.of.card') }} method="POST">
                @csrf
                <div class="part">

                    <div class="field">
                        <label for="">type de carte</label>
                        <input type="text" name="name" id="">
                    </div>
                    <div class="field">
                        <label for="">Coût</label>
                        <input type="text" name="cost" id="">
                    </div>
                    <div class="field">
                        <label for="">période ( En jours )</label>
                        <input type="text" name="period" id="">
                    </div>

                    <div class="selection-field">
                        <div class="field">
                            <label for="">Statut</label>
                            <input class="back" type="hidden" name="active" value="1">
                            <input class="front" type="text" id="pay-method" value="Active">
                            <i class="fa-solid fa-angle-down"></i>
                        </div>
                        <div class="options">
                            <span class="option" data-hidden="1">active</span>
                            <span class="option" data-hidden="0">inactif</span>
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
                                </div>
                                <div class="qr-code"> <img src="{{ asset('img/qr_code.png') }}" alt=""> </div>
                            </div>
                            <div class="serial">xxxx xxxx xxxx xxxx</div>
                        </div>
                        <div class="down flex-row">
                            <div class="flex-column">
                                <div class="type-of-card">xxxxxxxxxxxxxxxx</div>
                                <div class="flex-row">
                                    <div class="name">xxxxxx xxxxxx</div>
                                    <div class="expiry">XX/XX</div>
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
