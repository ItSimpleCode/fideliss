@extends('dashboard')

@section('content')
    <section class="dark-bg new-card">
        <div class="head">
            <h1 class="title">
                <a href="">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span>transactions</span>
            </h1>
        </div>
        <div class="form">
            <form action="">
                <div class="part">
                    <h2 class="title">card information</h2>
                    <div class="double-fields">
                        <div class="selection-field">
                            <div class="field">
                                <label for="type">type of card</label>
                                <input type="text" name="" id="type">
                                <i class="fa-solid fa-angle-down"></i>
                            </div>
                            <div class="options">
                                <span class="option">Gold Card</span>
                                <span class="option">Silver Card</span>
                                <span class="option">Platinum Card</span>
                                <span class="option">Basic Card</span>
                                <span class="option">Premium Card</span>
                                <span class="option">Elite Card</span>
                                <span class="option">Standard Card</span>
                                <span class="option">Business Card</span>
                                <span class="option">Student Card</span>
                                <span class="option">Senior Card</span>

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
                                <span class="option">card 1</span>
                            </div>
                        </div>
                    </div>
                    <div class="double-fields">
                        <div class="field">
                            <label for="pay">client pay</label>
                            <input type="text" name="" id="pay">
                        </div>
                        <div class="field">
                            <label for="wallet">wallet</label>
                            <input type="text" name="" id="wallet">
                        </div>
                    </div>
                </div>
                <div class="part">
                    <h2 class="title">client information</h2>
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
                    <div class="field">
                        <label for="address">adderss</label>
                        <input type="text" name="" id="address">
                    </div>
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
                                <div class="serial"><span>5195</span><span>1495</span><span>1989</span><span>1561</span></div>
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
