@extends('dashboard')

@section('title', 'Clients - Cardes')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist/css/pages/clients/cards.css') }}">
@endsection

@section('content')
    <section class="outer-bg mh-100">
        <div class="head">
            <div class="title">
                <a href="{{ route('clients') }}">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span>{{ $client[1] }}</span>
            </div>
            <a class="button-add" href="{{ Route('cards.create.show', ['id' => $client[0]]) }}"><i class="fa-solid fa-plus"></i></a>
        </div>

        <div class="cards body">
            @foreach ($data as $index => $item)
                <a class="card-2" href={{ route('scanner.addPoints.show', ['cardsSerial' => $item['card_serial']]) }}>
                    {{-- <img class="bg-img" src="{{ asset('img/VIrus4 1.png') }}" alt=""> --}}
                    <div class="info flex-column">
                        <div class="up flex-column">
                            <div class="flex-row">
                                {{--  <div class="flex-row">
                                        <span class="logo">
                                            <img src="{{ asset('img/logo2.png') }}" alt="">
                                        </span>
                                    </div> --}}
                                <span class="wallet">{{ $item['wallet'] }}</span>
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
            @if (!$data)
                <div class="no-data">la table est vide</div>
            @endif
        </div>
    </section>
@endsection
