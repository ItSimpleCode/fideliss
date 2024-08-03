@extends('dashboard')
@section('title', "{$client[1]} - cards")
@section('content')
    <section class="dark-bg">
        <div class="head">
            <div class="title">
                <a href="{{ route('clients') }}">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>{{ $client[1] }}</span>
                </a>
            </div>
            <a class="add" href="/dashboard/client/{{ $client[0] }}/cards/add"><i class="fa-solid fa-plus"></i><span>add new row</span></a>
        </div>
        @if ($data && $data->count() > 0)
            <div class="cards">
                @foreach ($data as $index => $item)
                    <div class="card">
                        <img class="bg-img" src="{{ asset('img/card1.png') }}" alt="">
                        <div class="info">
                            <div>
                                <div class="type-of-card">{{ $item['cards']['name'] }}</div>
                                <img class="qr-code" src="{{ asset('img/qr_code.png') }}" alt="">
                            </div>
                            <div>
                                <div class="client">
                                    <div class="name">{{ $client[1] }}</div>
                                    <div class="serial">{{ $item['card_serial'] }}</div>
                                </div>
                                <div class="expiry-date">
                                    <div class="expiry">expiry</div>
                                    <div class="date">{{ $item['expiry_date'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="no_data">
                <p>No data exist</p>
            </div>
        @endif
    </section>
@endsection
