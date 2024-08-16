@extends('dashboard')

@section('title', 'Personnel - Ajouter')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist\css\pages\staffs\add.css') }}">
@endsection

@section('content')
    <section class="outer-bg mh-100">
        <div class="head">
            <div class="title">
                <a href={{ route('staffs') }}>
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span>Ajouter un membre du personnel</span>
            </div>
        </div>
        <div class="form body">
            <form action={{ route('staffs.add.store') }} method="POST">
                @csrf
                <div class="part">
                    <h2 class="title">informations sur le personnel</h2>
                    <div class="double-fields">
                        <div class="field">
                            <label for="first-name">prénom</label>
                            <input type="text" name="first_name" id="first-name">
                        </div>
                        <div class="field">
                            <label for="last-name">nom de famille</label>
                            <input type="text" name="last_name" id="last-name">
                        </div>
                    </div>
                    <div class="double-fields">
                        <div class="field">
                            <label for="email">email</label>
                            <input type="text" name="email" id="email">
                        </div>
                        <div class="field">
                            <label for="phone">numéro de téléphone</label>
                            <input type="text" name="phone_number" id="phone">
                        </div>
                    </div>
                    <div class="double-fields">
                        <div class="selection-field">
                            <div class="field">
                                <label for="type">genre</label>
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
                            <label for="birth_date">date de naissance</label>
                            <input type="text" name="birth_date" id="birth_date">
                        </div>
                    </div>
                    <div class="field">
                        <label for="address">adresse</label>
                        <input type="text" name="address" id="address">
                    </div>

                </div>

                <div class="part">
                    <h2 class="title">informations sur le travail</h2>
                    <div class="double-fields">
                        <div class="selection-field">
                            <div class="field">
                                <label for="branch">branche</label>
                                <input class="back" type="hidden" name="id_branch">
                                <input class="front" type="text" id="branch">
                                <i class="fa-solid fa-angle-down"></i>
                            </div>
                            <div class="options">
                                @foreach ($branches as $branch)
                                    <span class="option" data-hidden="{{ $branch['id'] }}">{{ $branch['name'] }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="field">
                            <label for="password">mot de passe</label>
                            <input type="text" name="password" id="password">
                        </div>
                    </div>
                </div>

                <div class="part">
                    <button class="button-add" type="submit"><i class="fa-solid fa-users"></i><span>nouveau membre du
                            personnel</span></button>
                </div>

            </form>
        </div>

    </section>
@endsection

@section('script')
    <script src="{{ asset('dist/js/utils/form.js') }}"></script>
@endsection
