@extends('dashboard')

@section('title', $branch['name'])

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist/css/pages/branches/edit.css') }}">
@endsection

@section('content')
    <section class="dark-bg">
        @error('error')
            <div class="message">
                <span>{{ $message }}</span>
                <button class="close_error"><i class="fa-solid fa-xmark"></i></button>
            </div>
        @enderror

        <div class="head">
            <h1 class="title">
                <a href="{{ route('branchs') }}">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span>{{ $branch['name'] }}</span>
            </h1>
        </div>


        <form action={{ route('branchs.edite.store', ['id' => $branch['id']]) }} method="POST">
            @csrf
            <input type="text" name="name" value={{ $branch['name'] }}>
            <input type="text" name="address" value={{ $branch['address'] }}>

            <button type="submit">save</button>
        </form>

    </section>
@endsection
