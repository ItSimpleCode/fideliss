@extends('dashboard')

@section('title', 'Personnel')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist/css/pages/staffs/staffs.css') }}">
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
            <a class="button-add" href="{{ route("$table.add.show") }}"><i class="fa-solid fa-plus"></i></a>
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
                                    <div>{{ $field == 'created_at' ? $item[$field]->diffForHumans() : $item[$field] }}</div>
                                </td>
                            @endforeach
                            <td>
                                <div class="actions btn-2">
                                    <a href={{ route("$table.edit.show", ['id' => $item['id']]) }} class="edit">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                        <span>modifier</span>
                                    </a>
                                    <a href={{ route('staffs.edit.status', ['id' => $item['id']]) }} class='{{ $item['active'] ? 'active' : 'disactive' }}'>
                                        <i class="fa-solid fa-user{{ $item['active'] ? '' : '-slash' }}"></i>
                                        <span>{{ $item['active'] ? 'actif' : 'inactif' }}</span>
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
