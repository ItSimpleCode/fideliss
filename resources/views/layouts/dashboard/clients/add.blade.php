@extends('dashboard')
@section('title', 'add client')
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
                <a href="{{ route('clients') }}">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <span>Add client</span>
            </h1>
        </div>


        <form action={{ route('clients.add.store') }} method="POST">
            @csrf
            <input type="text" name="first_name">
            <input type="text" name="last_name">
            <input type="date" name="birth_date">
            <input type="text" name="phone_number">
            <select name="gender">
                <option value="male">male</option>
                <option value="female">female</option>
            </select>
            <input type="text" name="address">
            <input type="email" name="email">
            <input type="password" name="password">

            <button type="submit">save</button>
        </form>

    </section>
@endsection
