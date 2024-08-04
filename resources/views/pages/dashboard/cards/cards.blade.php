@extends('dashboard')

@section('title', $table)

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist\css\pages\cards\cards.css') }}">
@endsection

@section('content')
    <section class="dark-bg">
        <div class="head">
            <div class="title">cards</div>
            <a class="add" href=""> <i class="fa-solid fa-plus"></i><span>add new card</span></a>
        </div>
        <div class="cards">
            @for ($i = 0; $i < 15; $i++)
                <div class="card">
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
            @endfor
        </div>
    </section>
@endsection
