@extends('dashboard')

@section('content')
@section('content')
    <section class="dark-bg">
        <div class="head">
            <div class="title">cards of {{ $clientname }}</div>
            <button>
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </button>
        </div>
        <div class="cards">
            @foreach ($data as $item)
                <div class="card">
                    <img class="bg-img" src="{{ asset('img/card1.png') }}" alt="">
                    <img class="qr-code" src="{{ asset('img/qr_code.png') }}" alt="">
                    <div class="card-info">
                        <div class="user">
                            <div class="name">{{ $clientname }}</div>
                            <?php
                            $serial = $item['card_serial'];
                            $part1 = substr($serial, 0, 4);
                            $part2 = substr($serial, 4, 4);
                            $part3 = substr($serial, 8, 4);
                            $part4 = substr($serial, 12, 4);
                            ?>
                            <div class="serial">
                                <span>{{ $part1 }}</span><span>{{ $part2 }}</span><span>{{ $part3 }}</span><span>{{ $part4 }}</span>
                            </div>
                        </div>
                        <div class="expiry-date">
                            <div class="expiry">expiry</div>
                            <div class="date">07/30</div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </section>
@endsection
@endsection
