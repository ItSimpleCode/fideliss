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

        <div class="form">
            <form action="{{ route('scanner.addPoints.store', ['id' => $data['id']]) }}" method="POST">
                @csrf
                <div class="part">
                    <div class="double-fields">
                        <div class="field disabled">
                            <label for="first-name">first name</label>
                            <input type="text" id="first-name" value={{ $data['client']['first_name'] }} disabled>
                        </div>
                        <div class="field disabled">
                            <label for="last-name">last name</label>
                            <input type="text" id="last-name" value={{ $data['client']['last_name'] }} disabled>
                        </div>
                    </div>
                    <div class="double-fields">
                        <div class="field disabled">
                            <label for="email">email</label>
                            <input type="text" id="email" value={{ $data['client']['email'] }} disabled>
                        </div>
                        <div class="field disabled">
                            <label for="phone">phone number</label>
                            <input type="text" id="phone" value={{ $data['client']['phone_number'] }} disabled>
                        </div>
                    </div>
                    <div class="double-fields">
                        <div class="field disabled">
                            <label for="card_serial">Card serial</label>
                            <input type="text" id="card_serial" value={{ $data['card_serial'] }} disabled>
                        </div>
                        <div class="field disabled">
                            <label for="expiry-date">expiry date</label>
                            <input type="text" id="expiry-date" value={{ $data['expiry_date'] }} disabled>
                        </div>
                    </div>
                    <div class="field disabled">
                        <label for="wallet">wallet</label>
                        <input type="text" id="wallet" value={{ $data['wallet'] }} disabled>
                    </div>
                    <div class="field">
                        <label for="add_points">add points</label>
                        <input type="text" name="points" id="add_points" autofocus>
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
                <div class="card-2 front">
                    <img class="bg-img" src="{{ asset('img/VIrus4 1.png') }}" alt="">
                    <div class="info flex-column">
                        <div class="up flex-column">
                            <div class="flex-row">
                                <div class="flex-row">
                                    <span class="logo">
                                        <img src="{{ asset('img/logo2.png') }}" alt="">
                                    </span>
                                    <span class="wallet">{{ $data['wallet'] }}</span>
                                </div>
                                <div class="qr-code">{{ $data['qrCode'] }}</div>
                            </div>
                            <div class="serial">xxxx xxxx xxxx xxxx</div>
                        </div>
                        <div class="down flex-row">
                            <div class="flex-column">
                                <div class="type-of-card">{{ $data['type'] }}</div>
                                <div class="flex-row">
                                    <div class="name">{{ "{$data['client']['first_name']} {$data['client']['last_name']}" }}</div>
                                    <div class="expiry">{{ $data['expiry_date'] }}</div>
                                </div>
                            </div>
                            <div class="paypass">
                                <img src="{{ asset('img/paypass.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
