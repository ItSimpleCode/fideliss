@extends('dashboard')

@section('title', 'add staffs')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist\css\pages\staffs\add.css') }}">
@endsection

@section('content')
    <section class="dark-bg">
        <div class="head">
            <h1 class="title">
                <a href={{ route('staffs') }}>
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span>Add staff</span>
            </h1>
        </div>
        <div class="form">
            <form action='' method="POST">
                @csrf
                <div class="part">
                    <h2 class="title">staff information</h2>
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
                    <div class="double-fields">
                        <div class="selection-field">
                            <div class="field">
                                <label for="type">gender</label>
                                <input class="back" type="hidden" name="gender">
                                <input class="front" type="text" id="type">
                                <i class="fa-solid fa-angle-down"></i>
                            </div>
                            <div class="options">
                                @foreach (['male', 'female'] as $gender)
                                    <span class="option">{{ $gender }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="field">
                            <label for="birth_date">birth_date</label>
                            <input type="text" name="birth_date" id="birth_date">
                        </div>
                    </div>
                    <div class="field">
                        <label for="address">address</label>
                        <input type="text" name="address" id="address">
                    </div>

                </div>

                <div class="part">
                    <h2 class="title">work information</h2>
                    <div class="double-fields">
                        <div class="selection-field">
                            <div class="field">
                                <label for="branch">branch</label>
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
                            <label for="password">password</label>
                            <input type="text" name="password" id="password">
                        </div>
                    </div>
                </div>

                <div class="part">
                    <button type="submit"><i class="fa-solid fa-users"></i><span>new staff</span></button>
                </div>

            </form>
        </div>

    </section>
@endsection
