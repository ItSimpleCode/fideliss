@extends('dashboard')
@section('title', 'add card to ' . $client['first_name'] . ' ' . $client['last_name'])

@section('stylesheet', 'dist/css/cards_create.css')

@section('content')
    <section class="dark-bg new-card">
        @error('error')
            <div class="message">
                <span>{{ $message }}</span>
                <button class="close_error"><i class="fa-solid fa-xmark"></i></button>
            </div>
        @enderror

        <div class="head">
            <h1 class="title">
                <a href="{{ route('client.cards', ['id' => $client['id']]) }}">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span>Cards</span>
            </h1>
        </div>
        <div class="form">
            <form action="{{ route('cards.create.store', ['id' => $client['id']]) }}" method="POST">
                @csrf
                <div class="part">
                    <h2 class="title">card information</h2>
                    <div class="double-fields">
                        <div class="selection-field">
                            <div class="field">
                                <label for="type">type of card</label>
                                <input type="text" name="card_type" id="type">
                                <i class="fa-solid fa-angle-down"></i>
                            </div>
                            <div class="options">
                                @foreach ($cards as $card)
                                    <span class="option">{{ $card['name'] }}</span>
                                @endforeach

                            </div>
                        </div>
                        <div class="selection-field">
                            <div class="field">
                                <label for="pay-method">pay method</label>
                                <input type="text" name="" id="pay-method">
                                <i class="fa-solid fa-angle-down"></i>
                            </div>
                            <div class="options">
                                <span class="option">cash</span>
                                <span class="option">card bank</span>
                                @foreach ($clientCards as $card)
                                    <span class="option">{{ $card['card_serial'] }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="double-fields">
                        <div class="field">
                            <label for="pay">Card serial</label>
                            <input type="text" name="card_serial" id="pay">
                        </div>
                        <div class="field">
                            <label for="wallet">wallet</label>
                            <input type="text" name="wallet" id="wallet">
                        </div>
                    </div>
                </div>
                <div class="part">
                    <h2 class="title">client information</h2>
                    <div class="double-fields">
                        <div class="field">
                            <label for="first-name">first name</label>
                            <input type="text" name="" id="first-name" value={{ $client['first_name'] }} disabled>
                        </div>
                        <div class="field">
                            <label for="last-name">last name</label>
                            <input type="text" name="" id="last-name"value={{ $client['last_name'] }} disabled>
                        </div>
                    </div>
                    <div class="double-fields">
                        <div class="field">
                            <label for="email">email</label>
                            <input type="text" name="" id="email" value={{ $client['email'] }} disabled>
                        </div>
                        <div class="field">
                            <label for="phone">phone number</label>
                            <input type="text" name="" id="phone"value={{ $client['phone_number'] }} disabled>
                        </div>
                    </div>
                    {{-- <div class="field">
                        <label for="address">adderss</label>
                        <input type="text" name="" id="address">
                    </div> --}}
                </div>

                <div class="part">
                    <button type="submit"><i class="fa-regular fa-credit-card"></i><span>add card</span></button>
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
