@extends('dashboard')

@section('title', 'Scanner - Ajouter des points')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist/css/pages/clients/wallet.css') }}">
@endsection

@section('content')
    <form class="parts-bg mh-100"
          action="{{ Route('clients.transaction',['card_serial' => $data['clients']['row']->card_serial]) }}"
          method="post">
        @csrf
        <div class="part-bg row head">
            <div class="title">
                <a class="return-link" href="{{ route('clients') }}">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 12H8M8 12L11 9M8 12L11 15" class="stroke" stroke-width="1.5"
                              stroke-linecap="round"
                              stroke-linejoin="round"/>
                        <path
                            d="M22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C21.5093 4.43821 21.8356 5.80655 21.9449 8"
                            class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </a>
                <span>???</span>
            </div>
            <div class="options">
                <button type="submit" class="head-button send">
                    {{--                                   href="{{ Route('pending_transaction.edit', ['id' => $row['id']]) }}"--}}
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M16.2116 8.84823C16.5061 8.55696 16.5087 8.0821 16.2174 7.78758C15.9262 7.49307 15.4513 7.49044 15.1568 7.78171L16.2116 8.84823ZM10.6626 14.336L16.2116 8.84823L15.1568 7.78171L9.60787 13.2695L10.6626 14.336Z"
                            class="fill"/>
                        <path
                            d="M18.6357 15.6701C17.4255 19.3008 16.8204 21.1161 15.933 21.6319C15.0889 22.1227 14.0463 22.1227 13.2022 21.6319C12.3148 21.1161 11.7097 19.3008 10.4995 15.6701C10.3052 15.0872 10.208 14.7957 10.0449 14.5521C9.88687 14.316 9.68404 14.1131 9.44793 13.9551C9.2043 13.792 8.91282 13.6948 8.32987 13.5005C4.69923 12.2903 2.88392 11.6852 2.36806 10.7978C1.87731 9.95369 1.87731 8.91112 2.36806 8.06698C2.88392 7.17964 4.69923 6.57453 8.32987 5.36432M20.0257 11.5L20.3521 10.5208C21.8516 6.02242 22.6013 3.77322 21.414 2.58595C20.2268 1.39869 17.9776 2.14842 13.4792 3.64788L12.4228 4"
                            class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="part-bg column form body">
            <div class="part">
                <div class="title">client</div>
                <div class="field disabled">
                    <label for="cin">CIN</label>
                    <input type="text" id="cin" minlength="5" maxlength="10"
                           value="{{ $data['clients']['row']['cin'] }}" disabled>
                </div>
                <div class="double-fields">
                    <div class="field disabled">
                        <label for="first-name">Prénom</label>
                        <input type="text" id="first-name" minlength="2" maxlength="50"
                               value="{{ $data['clients']['row']['first_name'] }}">
                    </div>
                    <div class="field disabled">
                        <label for="last-name">Nom</label>
                        <input type="text" id="last-name" minlength="2" maxlength="50"
                               value="{{ $data['clients']['row']['last_name'] }}">
                    </div>
                </div>
                <div class="double-fields">
                    <div class="field disabled">
                        <label for="email">Email</label>
                        <input type="text" id="email" value="{{ $data['clients']['row']['email'] }}">
                    </div>
                    <div class="field disabled">
                        <label for="phone">Numéro de téléphone</label>
                        <input type="text" id="phone" minlength="10" maxlength="15"
                               value="{{ $data['clients']['row']['phone_number'] }}">
                    </div>
                </div>
                <div class="double-fields">
                    @php
                        $sexe = ['male' => 'Homme', 'female' => 'Femme'];
                    @endphp
                    <div class="field disabled">
                        <label for="gender">Genre</label>
                        <input type="text" id="gender"
                               value="{{ $sexe[$data['clients']['row']['gender']] }}">
                    </div>
                    <div class="field disabled">
                        <label for="birth_date">Date de naissance</label>
                        <input type="text" id="birth_date"
                               value="{{ $data['clients']['row']['birth_date'] }}">
                    </div>
                </div>
                <div class="field disabled">
                    <label for="address">Adresse</label>
                    <input type="text" id="address" minlength="5" maxlength="255"
                           value="{{ $data['clients']['row']['address'] }}">
                </div>
            </div>

            @if (Auth::guard('admin')->check())
                <div class="part">
                    <div class="title">l'agence</div>
                    <div class="field disabled">
                        <label for="agency_id">Agence</label>
                        <input class="front" type="text" id="agency_id"
                               value="{{ $data['clients']['row']['agency_name'] }}">
                    </div>
                </div>
            @endif

            <div class="part">
                <div class="title">carte</div>
                <div class="double-fields">
                    <div class="field disabled">
                        <label for="type">type de carte</label>
                        <input class="front" type="text" id="type"
                               value="{{ $data['clients']['row']['card_name'] }}">
                    </div>
                    <div class="field disabled">
                        <label for="optional_name">Nom facultatif</label>
                        <input type="text" id="optional_name"
                               value="{{ $data['clients']['row']['optional_name'] }}">
                    </div>
                </div>
                <div class="field disabled">
                    <label for="wallet">Portefeuille</label>
                    <input type="text" id="wallet" value="{{ $data['clients']['row']['wallet'] }}">
                </div>
            </div>
        </div>
        <div class="part-bg column form body">
            @php
                $value = fn($key) => Auth::guard('admin')->check() ? $data['admins']['row'][$key] : ( Auth::guard('staff')->check() ? $data['staffs']['row'][$key] : '');
            @endphp
            <div class="part">
                <div class="title">informations personnel</div>
                <div class="double-fields">
                    <div class="field disabled">
                        <label for="first-name">Prénom</label>
                        <input type="text" id="first-name" minlength="2" maxlength="50"
                               value="{{ $value('first_name') }}">
                    </div>
                    <div class="field disabled">
                        <label for="last-name">Nom</label>
                        <input type="text" id="last-name" minlength="2" maxlength="50"
                               value="{{ $value('last_name') }}">
                    </div>
                </div>
                <div class="double-fields">
                    <div class="field disabled">
                        <label for="email">Email</label>
                        <input type="text" id="email" value="{{ $value('email') }}">
                    </div>
                    <div class="field disabled">
                        <label for="phone">Numéro de téléphone</label>
                        <input type="text" id="phone" minlength="10" maxlength="15"
                               value="{{ $value('phone_number') }}">
                    </div>
                </div>
                <div class="double-fields">
                    @php
                        $sexe = ['male' => 'Homme', 'female' => 'Femme'];
                    @endphp
                    <div class="field disabled">
                        <label for="gender">Genre</label>
                        <input type="text" id="gender"
                               value="{{ $value('gender') }}">
                    </div>
                    @if (Auth::guard('staff')->check())
                        <div class="field disabled">
                            <label for="agency_id">Agence</label>
                            <input class="front" type="text" id="agency_id"
                                   value="{{ $data['staffs']['row']['agency_name'] }}">
                        </div>
                    @endif
                </div>
            </div>
            <div class="part">
                <div class="title">transaction</div>
                <div class="field">
                    <label for="add_points">Ajouter des points*</label>
                    <input type="text" name="points" id="add_points" required>
                </div>
                <div class="textarea">
                    <label for="message">Message*</label>
                    <textarea name="message" id="message" required></textarea>
                </div>
            </div>
        </div>
    </form>
@endsection
