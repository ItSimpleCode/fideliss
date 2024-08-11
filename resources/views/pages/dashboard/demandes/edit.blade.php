@extends('dashboard')

@section('title', 'Editer une demande')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist/css/pages/demandes/edit.css') }}">
@endsection

@section('content')
    <section class="dark-bg">
        <div class="head">
            <div class="title">Edite cette domande</div>
        </div>

        <div class="form">
            <form action="" method="POST">
                @csrf
                <div class="part">
                    <div class="double-fields">
                        <div class="field disabled">
                            <label for="first-name">Prénom</label>
                            <input type="text" id="first-name" value="" disabled>
                        </div>
                        <div class="field disabled">
                            <label for="last-name">Nom</label>
                            <input type="text" id="last-name" value="" disabled>
                        </div>
                    </div>
                    <div class="double-fields">
                        <div class="field disabled">
                            <label for="email">Email</label>
                            <input type="text" id="email" value="" disabled>
                        </div>
                        <div class="field disabled">
                            <label for="phone">Numéro de téléphone</label>
                            <input type="text" id="phone" value="" disabled>
                        </div>
                    </div>
                    <div class="double-fields">
                        <div class="field disabled">
                            <label for="card_serial">Numéro de la carte</label>
                            <input type="text" id="card_serial" value="" disabled>
                        </div>
                        <div class="field disabled">
                            <label for="expiry-date">Date d'expiration</label>
                            <input type="text" id="expiry-date" value="" disabled>
                        </div>
                    </div>
                    <div class="field disabled">
                        <label for="wallet">Portefeuille</label>
                        <input type="text" id="wallet" value="" disabled>
                    </div>
                    <div class="field">
                        <label for="add_points">Ajouter des points</label>
                        <input type="text" name="points" id="add_points" value="">
                    </div>
                    <div class="field">
                        <label for="description">Description</label>
                        <input type="text" name="description" id="description" value="">
                    </div>
                </div>

                <div class="part">
                    <button type="submit"><i class="fa-regular fa-credit-card"></i><span>Ajouter des points</span></button>
                </div>

            </form>
            <div class="preview">
                {{-- <div class="card-2 front">
                    <img class="bg-img" src="{{ asset('img/VIrus4 1.png') }}" alt="">
                    <div class="info flex-column">
                        <div class="up flex-column">
                            <div class="flex-row">
                                <div class="flex-row">
                                    <span class="logo">
                                        <img src="{{ asset('img/logo2.png') }}" alt="">
                                    </span>
                                    <span class="wallet">{{ $data['wallet'] }}</span>
                                </div>
                                <div class="qr-code">{{ $data['qrCode'] }}</div>
                            </div>
                            <div class="serial">xxxx xxxx xxxx xxxx</div>
                        </div>
                        <div class="down flex-row">
                            <div class="flex-column">
                                <div class="type-of-card">{{ $data['type'] }}</div>
                                <div class="flex-row">
                                    <div class="name">{{ "{$data['client']['first_name']} {$data['client']['last_name']}" }}</div>
                                    <div class="expiry">{{ $data['expiry_date'] }}</div>
                                </div>
                            </div>
                            <div class="paypass">
                                <img src="{{ asset('img/paypass.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>

    </section>
@endsection
