@extends('dashboard')

@section('title', 'Clients - Modifier')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist/css/pages/clients/edit.css') }}">
@endsection

@section('content')
    <section class="outer-bg mh-100">
        <div class="head">
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
                <span>
                    Modifier les informations de
                    <span class="bold underline">
                        {{ "{$data['row']['first_name']} {$data['row']['last_name']}" }}
                    </span>
                </span>
            </div>
        </div>
        <form class="form body" action="{{ route('clients.update', ['id' => $data['row']['id']]) }}" method="POST">
            @csrf
            <div class="part">
                <div class="title">informations client</div>
                <div class="field">
                    <label for="cin">CIN</label>
                    <input type="text" name="cin" id="cin" minlength="5" maxlength="10"
                           value="{{ $data['row']['cin'] }}">
                </div>
                <div class="double-fields">
                    <div class="field">
                        <label for="first-name">Prénom</label>
                        <input type="text" name="first_name" id="first-name" minlength="2" maxlength="50"
                               value="{{ $data['row']['first_name'] }}">
                    </div>
                    <div class="field">
                        <label for="last-name">Nom</label>
                        <input type="text" name="last_name" id="last-name" minlength="2" maxlength="50"
                               value="{{ $data['row']['last_name'] }}">
                    </div>
                </div>
                <div class="double-fields">
                    <div class="field">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" value="{{ $data['row']['email'] }}">
                    </div>
                    <div class="field">
                        <label for="phone">Numéro de téléphone</label>
                        <input type="text" name="phone_number" id="phone" minlength="10" maxlength="15"
                               value="{{ $data['row']['phone_number'] }}">
                    </div>
                </div>
                <div class="double-fields">
                    <div class="selection-field">
                        @php
                            $sexe = ['male' => 'Homme', 'female' => 'Femme'];
                        @endphp
                        <div class="field">
                            <label for="gender">Genre</label>
                            <input class="back" type="hidden" name="gender" value="{{ $data['row']['gender'] }}">
                            <input class="front" type="text" id="gender"
                                   value="{{ $sexe[$data['row']['gender']] }}">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 9L12 15L10.25 13.5M5 9L7.33333 11" class="stroke" stroke-width="1.5"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                        </div>
                        <div class="options">
                            @foreach ($sexe as $key => $val)
                                <span class="option" data-hidden="{{ $key }}">{{ $val }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="field">
                        <label for="birth_date">Date de naissance</label>
                        <input type="text" name="birth_date" id="birth_date"
                               value="{{ $data['row']['birth_date'] }}">
                    </div>
                </div>
                <div class="field">
                    <label for="address">Adresse</label>
                    <input type="text" name="address" id="address" minlength="5" maxlength="255"
                           value="{{ $data['row']['address'] }}">
                </div>
            </div>

            @if (Auth::guard('admin')->check())
                <div class="part">
                    <div class="title">informations sur l'agence</div>
                    <div class="selection-field">
                        <div class="field">
                            <label for="agency_id">Agence</label>
                            <input class="back" type="hidden" name="agency_id"
                                   value="{{ $data['row']['agency_id'] }}">
                            <input class="front" type="text" id="agency_id"
                                   value="{{ $data['row']['agency_name'] }}">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 9L12 15L10.25 13.5M5 9L7.33333 11" class="stroke" stroke-width="1.5"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="options">
                            @foreach ($data['agencies'] as $agency)
                                <span class="option" data-hidden="{{ $agency->id }}">{{ $agency->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <div class="part">
                <div class="title">informations sur la carte</div>
                <div class="double-fields">
                    <div class="selection-field">
                        <div class="field">
                            <label for="type">type de carte</label>
                            <input class="back" type="hidden" name="card_id" value="{{ $data['row']['card_id'] }}">
                            <input class="front" type="text" id="type" value="{{ $data['row']['card_name'] }}">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 9L12 15L10.25 13.5M5 9L7.33333 11" class="stroke" stroke-width="1.5"
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="options">
                            @foreach ($data['cards'] as $card)
                                <span class="option" data-hidden="{{ $card['id'] }}">{{ $card['name'] }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="field">
                        <label for="optional_name">Nom facultatif</label>
                        <input type="text" name="optional_name" id="optional_name"
                               value="{{ $data['row']['optional_name'] }}">
                    </div>
                </div>
                <div class="field">
                    <label for="wallet">porte-monnaie</label>
                    <input type="text" name="wallet" id="wallet" value="{{ $data['row']['wallet'] }}">
                </div>
                <div class="textarea">
                    <label for="message">Message*</label>
                    <textarea name="message" id="message"></textarea>
                </div>
            </div>


            <div class="part">
                <button class="button-add" type="submit">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="10" cy="6" r="4" class="stroke" stroke-width="1.5"/>
                        <path d="M21 10H19M19 10H17M19 10L19 8M19 10L19 12" class="stroke" stroke-width="1.5"
                              stroke-linecap="round"/>
                        <path
                            d="M17.9975 18C18 17.8358 18 17.669 18 17.5C18 15.0147 14.4183 13 10 13C5.58172 13 2 15.0147 2 17.5C2 19.9853 2 22 10 22C12.231 22 13.8398 21.8433 15 21.5634"
                            class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                    <span>Ajouter un client</span>
                </button>
            </div>

        </form>
    </section>
@endsection

@section('script')
    <script src="{{ asset('dist/js/utils/form.js') }}"></script>
@endsection
