@extends('dashboard')

@section('title', $branch['name'])

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist/css/pages/branches/edit.css') }}">
@endsection

@section('content')
    <section class="outer-bg">
        <div class="head">
            <div class="title">
                <a href="{{ route('branches') }}">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span>{{ $branch['name'] }}</span>
            </div>
        </div>
        <div class="form body">
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
                    <button class="button-add" type="submit"><i class="fa-solid fa-code-branch"></i><span>Modifier la branche</span></button>
                </div>
            </form>
        </div>

    </section>
@endsection

@section('script')
    <script src="{{ asset('dist/js/utils/form.js') }}"></script>
@endsection
