@extends('dashboard')

@section('title', 'Personnel - Modifier')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist\css\pages\staffs\edit.css') }}">
@endsection

@section('content')
    @php

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
                <span>Modifier le membre du personnel</span>
            </div>
        </div>
        <form class="form body" action={{ route('staffs.edit', ['id' => $data['row']->id]) }} method="POST">
            @csrf
            <div class="part">
                <h2 class="title">l'informations sur le personnel</h2>
                <div class="double-fields">
                    <div class="field">
                        <label for="first-name">Prénom</label>
                        <input type="text" name="first_name" id="first-name" value="{{ $data['row']->first_name }}">
                    </div>
                    <div class="field">
                        <label for="last-name">Nom</label>
                        <input type="text" name="last_name" id="last-name" value="{{ $data['row']->last_name }}">
                    </div>
                </div>
                <div class="double-fields">
                    <div class="field">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" value="{{ $data['row']->email }}">
                    </div>
                    <div class="field">
                        <label for="phone">Numéro de téléphone</label>
                        <input type="text" name="phone_number" id="phone" value="{{ $data['row']->phone_number }}">
                    </div>
                </div>
                <div class="double-fields">
                    <div class="selection-field">
                        <div class="field">
                            <label for="type">Sexe</label>
                            <input class="back" type="hidden" name="gender" value="{{ $data['row']->gender }}">
                            <input class="front" type="text" id="type" value="{{ $data['row']->gender }}">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 9L12 15L10.25 13.5M5 9L7.33333 11" class="stroke" stroke-width="1.5"
                                      stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>
                        <div class="options">
                            @foreach (['male', 'female'] as $gender)
                                <span class="option" data-hidden="{{ $gender }}">{{ $gender }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="field">
                        <label for="birth_date">Date de naissance</label>
                        <input type="text" name="birth_date" id="birth_date" value="{{ $data['row']->birth_date }}">
                    </div>
                </div>

            </div>

            <div class="part">
                <h2 class="title">l'informations sur le travail</h2>
                <div class="double-fields">
                    <div class="selection-field">
                        <div class="field">
                            <label for="branch">Agence</label>
                            <input class="back" type="hidden" name="agency_id" value="{{ $data['row']->agency_id }}">
                            <input class="front" type="text" id="branch" value="{{ $data['row']->agency_name }}">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 9L12 15L10.25 13.5M5 9L7.33333 11" class="stroke" stroke-width="1.5"
                                      stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>
                        <div class="options">
                            @foreach ($data['agencies'] as $agency)
                                <span class="option" data-hidden="{{ $agency->id }}">{{ $agency->name }}</span>
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
                <button class="button-add" type="submit"><i class="fa-solid fa-users"></i><span>Modifier le membre du personnel</span>
                </button>
            </div>

        </form>
    </section>
@endsection

@section('script')
    <script src="{{ asset('dist/js/utils/form.js') }}"></script>
@endsection
