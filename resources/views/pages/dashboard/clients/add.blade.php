@extends('dashboard')

@section('title', 'Ajouter un client')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist/css/pages/clients/add.css') }}">
@endsection

@section('content')
    <section class="dark-bg">
        <div class="head">
            <h1 class="title">
                <a href="{{ route('clients') }}">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span>Ajouter un client</span>
            </h1>
        </div>
        <div class="form">
            <form action="{{ route('clients.add.store') }}" method="POST">
                @csrf
                <div class="part">
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
                    <div class="selection-field">
                        <div class="field">
                            <label for="type">Genre</label>
                            <input class="back" type="hidden" name="gender">
                            <input class="front" type="text" id="type">
                            <i class="fa-solid fa-angle-down"></i>
                        </div>
                        <div class="options">
                            @foreach (['male', 'female'] as $gender)
                                <span class="option" data-hidden="{{ $gender }}">{{ $gender }}</span>
                            @endforeach

                        </div>
                    </div>
                    <div class="field">
                        <label for="address">Adresse</label>
                        <input type="text" name="address" id="address">
                    </div>
                    <div class="field">
                        <label for="birth_date">Date de naissance</label>
                        <input type="text" name="birth_date" id="birth_date">
                    </div>
                </div>

                <div class="part">
                    <button type="submit"><i class="fa-regular fa-credit-card"></i><span>Ajouter un client</span></button>
                </div>

            </form>
        </div>
    </section>
@endsection

@section('script')
    <script type="module" src="{{ asset('dist/js/main.js') }}"></script>
@endsection
