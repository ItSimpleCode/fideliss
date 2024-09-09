@extends('dashboard')

@section('title', 'Personnel - Ajouter')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist\css\pages\staffs\add.css') }}">
@endsection

@section('content')
    @php
        $genders = [
            'male' => 'homme',
            'female' => 'femme'
            ];
    @endphp
    <section class="outer-bg mh-100">
        <div class="head">
            <div class="title">
                <a class="return-link" href={{ route('staffs') }}>
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 12H8M8 12L11 9M8 12L11 15" class="stroke" stroke-width="1.5" stroke-linecap="round"
                              stroke-linejoin="round"></path>
                        <path
                            d="M22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C21.5093 4.43821 21.8356 5.80655 21.9449 8"
                            class="stroke" stroke-width="1.5" stroke-linecap="round"></path>
                    </svg>
                </a>
                <span>ajouter une nouvelle personnel</span>
            </div>
        </div>
        <form class="form body" action={{ route('staffs.insert') }} method="POST">
            @csrf
            <div class="part">
                <h2 class="title">l'informations sur le personnel</h2>
                <div class="double-fields">
                    <div class="field">
                        <label for="first-name">Prénom</label>
                        <input type="text" name="first_name" id="first-name">
                    </div>
                    <div class="field">
                        <label for="last-name">Nom</label>
                        <input type="text" name="last_name" id="last-name">
                    </div>
                </div>
                <div class="double-fields">
                    <div class="field">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email">
                    </div>
                    <div class="field">
                        <label for="phone">Numéro de téléphone</label>
                        <input type="text" name="phone_number" id="phone">
                    </div>
                </div>
                <div class="double-fields">
                    <div class="selection-field">
                        <div class="field">
                            <label for="type">Sexe</label>
                            <input class="back" type="hidden" name="gender">
                            <input class="front" type="text" id="type">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 9L12 15L10.25 13.5M5 9L7.33333 11" class="stroke" stroke-width="1.5"
                                      stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>
                        <div class="options">
                            @foreach ($genders as $key => $val)
                                <span class="option" data-hidden="{{ $key }}">{{ $val }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="field">
                        <label for="birth_date">Date de naissance</label>
                        <input type="text" name="birth_date" id="birth_date">
                    </div>
                </div>
                <div class="field">
                    <label for="address">Adresse</label>
                    <input type="text" name="address" id="address">
                </div>

            </div>

            <div class="part">
                <h2 class="title">l'informations sur le travail</h2>
                <div class="double-fields">
                    <div class="selection-field">
                        <div class="field">
                            <label for="branch">Agence</label>
                            <input class="back" type="hidden" name="agency_id">
                            <input class="front" type="text" id="branch">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 9L12 15L10.25 13.5M5 9L7.33333 11" class="stroke" stroke-width="1.5"
                                      stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>
                        <div class="options">
                            @foreach ($data['agencies'] as $agency)
                                <span class="option" data-hidden="{{ $agency['id'] }}">{{ $agency['name'] }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="field">
                        <label for="password">Mot de passe</label>
                        <input type="text" name="password" id="password">
                    </div>
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
                    <span>Ajouter un personnel</span>
                </button>
            </div>

        </form>
    </section>
@endsection

@section('script')
    <script src="{{ asset('dist/js/utils/form.js') }}"></script>
@endsection
