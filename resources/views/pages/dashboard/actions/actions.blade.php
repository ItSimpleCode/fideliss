@extends('dashboard')

@section('title', $table)

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist/css/pages/actions/actions.css') }}">
@endsection

<h2>actions</h2>


@section('script')
    <script src="{{ asset('dist/js/utils/table.js') }}"></script>
@endsection
