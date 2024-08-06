@extends('dashboard')

@section('title', "{$client[1]} - cartes")

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist/css/pages/clients/cards.css') }}">
@endsection

@section('content')
    <section class="dark-bg">
        <div class="head">
            <div class="title">
                <a href="{{ route('clients') }}">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>{{ $client[1] }}</span>
                </a>
            </div>
            <a class="add" href="/dashboard/client/{{ $client[0] }}/cards/add"><i class="fa-solid fa-plus"></i><span>Ajouter une nouvelle
                    carte</span></a>
        </div>

        @if ($data && $data->count() > 0)
            <div class="cards">
                @foreach ($data as $index => $item)
                    <a class="card-2" href={{ route('scanner.addPoints.show', ['cardsSerial' => $item['card_serial']]) }}>
                        <img class="bg-img" src="{{ asset('img/VIrus4 1.png') }}" alt="">
                        <div class="info flex-column">
                            <div class="up flex-column">
                                <div class="flex-row">
                                    <div class="flex-row">
                                        <span class="logo">
                                            <img src="{{ asset('img/logo2.png') }}" alt="">
                                        </span>
                                        <span class="wallet">{{ $item['wallet'] }}</span>
                                    </div>
                                    <div class="qr-code">{{ $item['qrCode'] }}</div>
                                </div>
                                <div class="serial">{{ $item['card_serial'] }}</div>
                            </div>
                            <div class="down flex-row">
                                <div class="flex-column">
                                    <div class="type-of-card">{{ $item['cards']['name'] }}</div>
                                    <div class="flex-row">
                                        <div class="name">{{ $client[1] }}</div>
                                        <div class="expiry">{{ $item['expiry_date'] }}</div>
                                    </div>
                                </div>
                                <div class="paypass">
                                    <img src="{{ asset('img/paypass.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="no_data">
                <p>Aucune donnée disponible</p>
            </div>
        @endif
    </section>
@endsection
