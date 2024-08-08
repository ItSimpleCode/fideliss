@extends('dashboard')

@section('title', $branch['name'])

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist/css/pages/branches/edit.css') }}">
@endsection

@section('content')
    <section class="dark-bg">
        <div class="head">
            <h1 class="title">
                <a href="{{ route('branches') }}">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span>{{ $branch['name'] }}</span>
            </h1>
        </div>

        <form action={{ route('branches.edit.store', ['id' => $branch['id']]) }} method="POST">
            @csrf
            <div class="part">
                <div class="field">
                    <label for="name">nom</label>
                    <input type="text" name="name" id="name" value={{ $branch['name'] }}>
                </div>
                <div class="field">
                    <label for="address">adresse</label>
                    <input type="text" name="address" id="address" value={{ $branch['address'] }}>
                </div>
            </div>

            <div class="part">
                <button type="submit"><i class="fa-solid fa-code-branch"></i><span>Modifier la branche</span></button>
            </div>
        </form>

    </section>
@endsection
