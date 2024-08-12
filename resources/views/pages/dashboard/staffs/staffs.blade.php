@extends('dashboard')

@section('title', $table)

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
    <section class="dark-bg users">
        <div class="head">
            <div class="title">{{ $table }} ({{ $data->count() }})</div>
            <a class="add" href="{{ route("$table.add.show") }}"> <i class="fa-solid fa-plus"></i><span>ajouter une nouvelle staff</span></a>
        </div>
        <div class="main-table">
            @if ($data->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            @foreach ($columns as $column)
                                @if ($column !== '-')
                                    <th>{{ $column }}</th>
                                @endif
                            @endforeach
                            <th class="actions btn-2">Actions</th>
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
                                <td>
                                    <div class="actions btn-2">
                                        <a href={{ route("$table.edit.show", ['id' => $item['id']]) }} class="edit">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                            <span>modifier</span>
                                        </a>
                                        @if ($item['active'])
                                            <a href={{ route('staffs.edit.status', ['id' => $item['id']]) }} class='active'>
                                                <i class="fa-solid fa-user"></i><span>actif</span>
                                            </a>
                                        @else
                                            <a href={{ route('staffs.edit.status', ['id' => $item['id']]) }} class='disactive'>
                                                <i class="fa-solid fa-user-slash"></i><span>inactif</span>
                                            </a>
                                        @endif
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="no_data">
                    <p>aucune donnée disponible</p>
                </div>
            @endif
        </div>
    </section>
@endsection


@section('script')
    <script src="{{ asset('dist/js/utils/table.js') }}"></script>
@endsection
