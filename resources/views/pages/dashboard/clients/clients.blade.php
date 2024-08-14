@extends('dashboard')

@section('title', $table)

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist/css/pages/clients/clients.css') }}">
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
                        <th><span>#</span></th>
                        @foreach ($columns as $column)
                            @if ($column !== '-')
                                <th><span>{{ $column }}</span></th>
                            @endif
                        @endforeach

                        <th class="actions"><span>Actions</span></th>
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
                                <div class="actions btn-3">
                                    <a href="{{ Route('client.cards', ['id' => $item['id']]) }}" class="show">
                                        <i class="fa-regular fa-credit-card"></i>
                                        <span>Cartes</span>
                                    </a>
                                    <a href={{ route("$table.edit.show", ['id' => $item['id']]) }} class="edit">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                        <span>Modifier</span>
                                    </a>

                                    @if ($item['active'])
                                        <a href={{ route('clients.edit.status', ['id' => $item['id']]) }} class='active'>
                                            <i class="fa-solid fa-user"></i><span>actif</span>
                                        </a>
                                    @else
                                        <a href={{ route('clients.edit.status', ['id' => $item['id']]) }} class='disactive'>
                                            <i class="fa-solid fa-user-slash"></i><span>inactif</span>
                                        </a>
                                    @endif
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
