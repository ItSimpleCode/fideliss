@extends('dashboard')

@section('title', $table)

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist\css\pages\admins\admins.css') }}">
@endsection

@section('search')
    <div class="search">
        <i class="fa-solid fa-magnifying-glass"></i>
        <span class="bar"></span>
        <input type="text" id="nav-searcher" placeholder="chercher">
    </div>
@endsection

@section('content')
    <section class="outer-bg h-100">
        <div class="head">
            <div class="title">{{ $table }} ({{ $data->count() }})</div>
        </div>

        <div class="main-table body">
            <table>
                <thead>
                    <tr>
                        <th><span>#</span></th>
                        @foreach ($columns as $column)
                            @if ($column !== '-')
                                <th><span>{{ $column }}</span></th>
                            @endif
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $item)
                        <tr>
                            <td scope="row">{{ $index + 1 }}</td>
                            @foreach ($fields as $field)
                                @if ($field == 'created_at')
                                    <td>{{ $item[$field]->diffForHumans() }}</td>
                                @else
                                    <td>{{ $item[$field] }}</td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if (!$data->count())
                <div class="no-data">la table est vide</div>
            @endif
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ asset('dist/js/utils/table.js') }}"></script>
@endsection
