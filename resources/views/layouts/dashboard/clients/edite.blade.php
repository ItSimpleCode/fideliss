@extends('dashboard')
@section('title',$client['first_name'] . ' ' . $client['last_name'])


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
                <span>{{ $client['first_name'] . ' ' . $client['last_name'] }}</span>
            </h1>
        </div>

        <form action={{ route('clients.edite.store', ['id' => $client['id']]) }} method="POST">
            @csrf
            <input type="text" name="first_name" value={{ $client['first_name'] }}>
            <input type="text" name="last_name" value={{ $client['last_name'] }}>
            <input type="date" name="birth_date" value={{ $client['birth_date'] }}>
            <input type="text" name="phone_number" value={{ $client['phone_number'] }}>
            <select name="gender">
                <option value="male" {{ $client['gender'] == 'male' ? 'selected' : '' }}>male</option>
                <option value="female" {{ $client['gender'] == 'female' ? 'selected' : '' }}>female</option>
            </select>
            <input type="text" name="address" value={{ $client['address'] }}>
            <input type="email" name="email" value={{ $client['email'] }}>
            <input type="password" name="password" value={{ $client['password'] }}>

            <button type="submit">save</button>
        </form>

    </section>
@endsection
