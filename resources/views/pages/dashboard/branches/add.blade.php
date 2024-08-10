@extends('dashboard')

@section('title', 'ajouter une branche')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist/css/pages/branches/add.css') }}">
@endsection

@section('content')
    <section class="dark-bg">
        <div class="head">
            <h1 class="title">
                <a href="{{ route('branches') }}">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span>Ajouter une branche</span>
            </h1>
        </div>

        <form action={{ route('branches.add.store') }} method="POST">
            @csrf
            <div class="part">
                <div class="field">
                    <label for="name">nom</label>
                    <input type="text" name="name" id="name">
                </div>
                <div class="field">
                    <label for="address">adresse</label>
                    <input type="text" name="address" id="address">
                </div>
            </div>

            <div class="part">
                <button type="submit"><i class="fa-solid fa-code-branch"></i><span>ajouter la branche</span></button>
            </div>
        </form>

    </section>
@endsection

@section('script')
    <script src="{{ asset('dist/js/utils/form.js') }}"></script>
@endsection
