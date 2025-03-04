@extends('dashboard')

@section('title', 'Demande - Modifier')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist/css/pages/demandes/edit.css') }}">
@endsection

@section('content')
    <section class="outer-bg">
        <div class="head">
            <a href={{ route('transaction.demande') }}>
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div class="title">Edite cette domande</div>
        </div>

        <div class="form body">
            <form action={{ route('transaction.demande.edit.store', ['id' => $data['id']]) }} method="POST">
                @csrf
                <div class="part">
                    <div class="double-fields">
                        <div class="field disabled">
                            <label for="first-name">Prénom</label>
                            <input type="text" id="first-name" value={{ $data['first_name'] }} disabled>
                        </div>
                        <div class="field disabled">
                            <label for="last-name">Nom</label>
                            <input type="text" id="last-name" value={{ $data['last_name'] }} disabled>
                        </div>
                    </div>
                    <div class="double-fields">
                        <div class="field disabled">
                            <label for="email">Email</label>
                            <input type="text" id="email" value={{ $data['email'] }} disabled>
                        </div>
                        <div class="field disabled">
                            <label for="phone">Numéro de téléphone</label>
                            <input type="text" id="phone" value={{ $data['phone_number'] }} disabled>
                        </div>
                    </div>
                    <div class="double-fields">
                        <div class="field disabled">
                            <label for="card_serial">Numéro de la carte</label>
                            <input type="text" id="card_serial" value={{ $data['card_serial'] }} disabled>
                        </div>
                        <div class="field disabled">
                            <label for="expiry-date">Date d'expiration</label>
                            <input type="text" id="expiry-date" value={{ $data['expiry_date'] }} disabled>
                        </div>
                    </div>
                    <div class="field disabled">
                        <label for="wallet">Portefeuille</label>
                        <input type="text" id="wallet" value={{ $data['wallet'] }} disabled>
                    </div>
                    <div class="field">
                        <label for="add_points">Points</label>
                        <input type="text" name="points" id="add_points" value={{ $data['points'] }} autofocus>
                    </div>
                    <div class="field">
                        <label for="description">Description</label>
                        <input type="text" name="description" id="description" value={{ $data['description'] }}>
                    </div>
                </div>

                <div class="part">
                    <button class="button-add" type="submit"><i class="fa-regular fa-credit-card"></i><span>Ajouter des points</span></button>
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
                                    <span class="wallet">{{ $data['wallet'] }}</span>
                                </div>
                                <div class="qr-code">{{ $data['qrCode'] }}</div>
                            </div>
                            <div class="serial">{{ $data['card_serial'] }}</div>
                        </div>
                        <div class="down flex-row">
                            <div class="flex-column">
                                <div class="type-of-card">{{ $data['type_card'] }}</div>
                                <div class="flex-row">
                                    <div class="name">{{ "{$data['first_name']} {$data['last_name']}" }}</div>
                                    <div class="expiry">{{ $data['expiry_date'] }}</div>
                                </div>
                            </div>
                            <div class="paypass">
                                <img src="{{ asset('img/paypass.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
