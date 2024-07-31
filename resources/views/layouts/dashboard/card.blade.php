@extends('dashboard')

@section('content')
@section('content')
    <section class="dark-bg cards">
        <div class="head">
            <div class="title">cards</div>
            <button>
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </button>
        </div>
        <div class="main-table">
            <div class="card">
                <img src="{{ asset('img/card1.png') }}" alt="">
                <div class="user">
                    <div class="name">youssef elqayedy</div>
                    <div class="serial"><span>5195</span><span>1495</span><span>1989</span><span>1561</span></div>
                </div>
                <div class="expiry-date">
                    <div class="expiry">expiry</div>
                    <div class="date">07/30</div>
                </div>
            </div>
        </div>
    </section>
@endsection
@endsection
