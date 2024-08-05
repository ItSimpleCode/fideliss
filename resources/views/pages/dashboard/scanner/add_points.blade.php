@extends('dashboard')

@section('title', 'add points')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist/css/pages/scanner/add_points.css') }}">
@endsection

@section('content')
    <section class="dark-bg">
        <div class="head">
            <div class="title">Add Points</div>
        </div>

        {{-- <label for="points">How much point You want to add</label>
            <input type="number" name="points" id="points">
            <button>Save</button> --}}
        <div class="form">
            <form action="{{ route('scanner.addPoints.store', ['id' => $card['id']]) }}" method="POST">
                @csrf
                <div class="part">
                    <div class="double-fields">
                        <div class="field">
                            <label for="first-name">first name</label>
                            <input type="text" name="" id="first-name">
                        </div>
                        <div class="field">
                            <label for="last-name">last name</label>
                            <input type="text" name="" id="last-name">
                        </div>
                    </div>
                    <div class="double-fields">
                        <div class="field">
                            <label for="email">email</label>
                            <input type="text" name="" id="email">
                        </div>
                        <div class="field">
                            <label for="phone">phone number</label>
                            <input type="text" name="" id="phone">
                        </div>
                    </div>
                    <div class="double-fields">
                        <div class="field">
                            <label for="pay">Card serial</label>
                            <input type="text" name="card_serial" id="pay">
                        </div>
                        <div class="field">
                            <label for="expiry-date">expiry date</label>
                            <input type="text" name="expiry-date" id="expiry-date">
                        </div>
                    </div>
                    <div class="field">
                        <label for="wallet">wallet</label>
                        <input type="text" name="" id="wallet">
                    </div>
                    <div class="field">
                        <label for="add_points">add points</label>
                        <input type="text" name="add_points" id="add_points">
                    </div>
                    <div class="field">
                        <label for="description">description</label>
                        <input type="text" name="description" id="description">
                    </div>
                </div>

                <div class="part">
                    <button type="submit"><i class="fa-regular fa-credit-card"></i><span>add points</span></button>
                </div>

            </form>
            <div class="preview">
                <div class="card front">
                    <img class="bg-img" src="{{ asset('img/card1.png') }}" alt="">
                    <div class="info">
                        <div>
                            <div class="type-of-card">Gold Card</div>
                            <img class="qr-code" src="{{ asset('img/qr_code.png') }}" alt="">
                        </div>
                        <div>
                            <div class="client">
                                <div class="name">youssef elqayedy</div>
                                <div class="serial"><span>5195</span><span>1495</span><span>1989</span><span>1561</span>
                                </div>
                            </div>
                            <div class="expiry-date">
                                <div class="expiry">expiry</div>
                                <div class="date">07/30</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card back">
                    <img class="bg-img" src="{{ asset('img/card1.png') }}" alt="">
                    <img class="logo" src="{{ asset('img/logo.png') }}" alt="">
                </div>
            </div>
        </div>

    </section>
@endsection
