@extends('dashboard')

@section('content')
    <h2>Users</h2>
    @foreach ($data as $item)
        <div>{{ $item->username }}</div>
    @endforeach
    <div></div>
@endsection
