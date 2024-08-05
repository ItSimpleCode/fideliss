@extends('dashboard')

@section('title', 'add client')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist\css\pages\clients\add.css') }}">
@endsection

@section('content')
    <section class="dark-bg">
        @error('error')
            <div class="message">
                <span>{{ $message }}</span>
                <button class="close_error"><i class="fa-solid fa-xmark"></i></button>
            </div>
        @enderror

        <div class="head">
            <h1 class="title">
                <a href="{{ route('clients') }}">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span>Add client</span>
            </h1>
        </div>
        <div class="form">
            <form action="{{ route('clients.add.store') }}" method="POST">
                @csrf
                <div class="part">
                    <div class="double-fields">
                        <div class="field">
                            <label for="first-name">first name</label>
                            <input type="text" name="first_name" id="first-name">
                        </div>
                        <div class="field">
                            <label for="last-name">last name</label>
                            <input type="text" name="last_name" id="last-name">
                        </div>
                    </div>
                    <div class="double-fields">
                        <div class="field">
                            <label for="email">email</label>
                            <input type="text" name="email" id="email">
                        </div>
                        <div class="field">
                            <label for="phone">phone number</label>
                            <input type="text" name="phone_number" id="phone">
                        </div>
                    </div>
                    <div class="selection-field">
                        <div class="field">
                            <label for="type">gender</label>
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
                        <label for="address">address</label>
                        <input type="text" name="address" id="address">
                    </div>
                    <div class="field">
                        <label for="birth_date">birth_date</label>
                        <input type="text" name="birth_date" id="birth_date">
                    </div>
                </div>

                <div class="part">
                    <button type="submit"><i class="fa-regular fa-credit-card"></i><span>add client</span></button>
                </div>

            </form>
        </div>

    </section>
@endsection
