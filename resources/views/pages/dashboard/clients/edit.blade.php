@extends('dashboard')

@section('title', 'Clients - Modifier')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist/css/pages/clients/edit.css') }}">
@endsection

@section('content')
    <section class="outer-bg mh-100">
        <div class="head">
            <div class="title">
                <a href="{{ route('clients') }}">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span>{{ $client['first_name'] . ' ' . $client['last_name'] }}</span>
            </div>
        </div>

        <form action={{ route('clients.edit.store', ['id' => $client['id']]) }} method="POST">
            @csrf
            <div class="part">
                <div class="double-fields">
                    <div class="field">
                        <label for="first-name">prénom</label>
                        <input type="text" name="first_name" id="first-name" value="{{ $client['first_name'] }}">
                    </div>
                    <div class="field">
                        <label for="last-name">nom</label>
                        <input type="text" name="last_name" id="last-name" value="{{ $client['last_name'] }}">
                    </div>
                </div>
                <div class="double-fields">
                    <div class="field">
                        <label for="email">CIN</label>
                        <input type="text" name="cin" id="cin" value="{{ $client['cin'] }}">
                    </div>
                    <div class="field">
                        <label for="phone">numéro de téléphone</label>
                        <input type="text" name="phone_number" id="phone" value="{{ $client['phone_number'] }}">
                    </div>
                </div>
                <div class="double-fields">
                    <div class="field">
                        <label for="email">email</label>
                        <input type="email" name="email" value="{{ $client['email'] }}">
                    </div>
                </div>
                <div class="selection-field">
                    <div class="field">
                        <label for="type">genre</label>
                        <input class="back" type="hidden" name="gender" value="{{ $client['gender'] }}">
                        <input class="front" type="text" id="type" value="{{ $client['gender'] }}">
                        <i class="fa-solid fa-angle-down"></i>
                    </div>
                    <div class="options">
                        @foreach (['male', 'female'] as $gender)
                            <span class="option" data-hidden="{{ $gender }}">{{ $gender }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="field">
                    <label for="birth_date">date de naissance</label>
                    <input type="text" name="birth_date" value="{{ $client['birth_date'] }}">
                </div>
                <div class="field">
                    <label for="address">adresse</label>
                    <input type="text" name="address" id="address" value="{{ $client['address'] }}">
                </div>
            </div>

            <div class="part">
                <button class="button-add" type="submit">Modifier</button>
            </div>
        </form>

    </section>
@endsection

@section('script')
    <script src="{{ asset('dist/js/utils/form.js') }}"></script>
@endsection
