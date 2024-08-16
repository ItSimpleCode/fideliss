@extends('dashboard')

@section('title', 'Actions')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist/css/pages/actions/actions.css') }}">
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
                        <th>
                            <div>#</div>
                        </th>
                        @foreach ($columns as $column)
                            <th>
                                <div>{{ $column }}</div>
                            </th>
                        @endforeach
                        <th class="actions btn-2">
                            <div>Actions</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $item)
                        <tr>
                            <td>
                                <div>{{ $index + 1 }}</div>
                            </td>
                            @foreach ($fields as $field)
                                <td>
                                    <div>{{ $item[$field] }}</div>
                                </td>
                            @endforeach
                            <td>
                                <div class="actions btn-2">
                                    <a href={{ route('actions.valider', ['id' => $item['id']]) }} class='active'>
                                        <i class="fa-solid fa-user"></i><span>Valider</span>
                                    </a>
                                    <a href={{ route('actions.invalider', ['id' => $item['id']]) }} class='disactive'>
                                        <i class="fa-solid fa-user-slash"></i><span>Invalider</span>
                                    </a>
                                </div>
                            </td>
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
