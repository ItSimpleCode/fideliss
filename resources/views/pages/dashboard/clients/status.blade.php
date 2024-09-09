@extends('dashboard')

@section('title', 'Clients - Statut du client')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist/css/pages/clients/status.css') }}">
@endsection

@section('content')
    <section class="parts-bg mh-100">
        <div class="part-bg row head">
            <div class="title">
                <a class="return-link" href="{{ route('clients') }}">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 12H8M8 12L11 9M8 12L11 15" class="stroke" stroke-width="1.5" stroke-linecap="round"
                              stroke-linejoin="round"/>
                        <path
                            d="M22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C21.5093 4.43821 21.8356 5.80655 21.9449 8"
                            class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </a>
                <span>statut de </span>
            </div>
            <div class="options">
                
            </div>
        </div>
        <div class="part-bg column form body">
            <div class="part">
                <div class="title">informations client</div>
                <div class="field disabled">
                    <label for="cin">CIN</label>
                    <input type="text" name="cin" id="cin" minlength="5" maxlength="10"
                           value="{{ $data['row']['cin'] }}" disabled>
                </div>
                <div class="double-fields">
                    <div class="field disabled">
                        <label for="first-name">Prénom</label>
                        <input type="text" name="first_name" id="first-name" minlength="2" maxlength="50"
                               value="{{ $data['row']['first_name'] }}">
                    </div>
                    <div class="field disabled">
                        <label for="last-name">Nom</label>
                        <input type="text" name="last_name" id="last-name" minlength="2" maxlength="50"
                               value="{{ $data['row']['last_name'] }}">
                    </div>
                </div>
                <div class="double-fields">
                    <div class="field disabled">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" value="{{ $data['row']['email'] }}">
                    </div>
                    <div class="field disabled">
                        <label for="phone">Numéro de téléphone</label>
                        <input type="text" name="phone_number" id="phone" minlength="10" maxlength="15"
                               value="{{ $data['row']['phone_number'] }}">
                    </div>
                </div>
                <div class="double-fields">
                    @php
                        $sexe = ['male' => 'Homme', 'female' => 'Femme'];
                    @endphp
                    <div class="field disabled">
                        <label for="gender">Genre</label>
                        <input type="text" id="gender" value="{{ $sexe[$data['row']['gender']] }}">
                    </div>
                    <div class="field disabled">
                        <label for="birth_date">Date de naissance</label>
                        <input type="text" name="birth_date" id="birth_date" value="{{ $data['row']['birth_date'] }}">
                    </div>
                </div>
                <div class="field disabled">
                    <label for="address">Adresse</label>
                    <input type="text" name="address" id="address" minlength="5" maxlength="255"
                           value="{{ $data['row']['address'] }}">
                </div>
            </div>

            @if (Auth::guard('admin')->check())
                <div class="part">
                    <div class="title">informations sur l'agence</div>
                    <div class="field disabled">
                        <label for="agency_id">Agence</label>
                        <input class="front" type="text" id="agency_id" value="{{ $data['row']['agency_name'] }}">
                    </div>
                </div>
            @endif

            <div class="part">
                <div class="title">informations sur la carte</div>
                <div class="double-fields">
                    <div class="field disabled">
                        <label for="type">type de carte</label>
                        <input class="front" type="text" id="type" value="{{ $data['row']['card_name'] }}">
                    </div>
                    <div class="field disabled">
                        <label for="optional_name">Nom facultatif</label>
                        <input type="text" name="optional_name" id="optional_name"
                               value="{{ $data['row']['optional_name'] }}">
                    </div>
                </div>
                <div class="field disabled">
                    <label for="wallet">Portefeuille</label>
                    <input type="text" name="wallet" id="wallet" value="{{ $data['row']['wallet'] }}">
                </div>
            </div>
        </div>
        <div class="part-bg column form body">

        </div>

    </section>
@endsection
