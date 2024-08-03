@extends('dashboard')
@section('title', 'add branch')

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
                <span>Add branch</span>
            </h1>
        </div>


        <form action={{ route('branchs.add.store') }} method="POST">
            @csrf
            <input type="text" name="name">
            <input type="text" name="address">

            <button type="submit">save</button>
        </form>

    </section>
@endsection
