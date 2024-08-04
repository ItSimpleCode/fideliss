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

        <h1>current points - {{ $card['wallet'] }}</h1>
        <form action={{ route('scanner.addPoints.store', ['id' => $card['id']]) }} method="POST">
            @csrf
            <label for="points">How much point You want to add</label>
            <input type="number" name="points" id="points">
            <button>Save</button>
        </form>

    </section>
@endsection
