@extends('dashboard')

@section('title', $table)

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist/css/pages/clients/clients.css') }}">
@endsection

@section('content')
    <section class="dark-bg users">
        <div class="head">
            <div class="title">{{ $table }} ({{ $data->count() }})</div>
            <a class="add" href="{{ route("$table.add.show") }}"> <i class="fa-solid fa-plus"></i><span>Ajouter une nouvelle client</span></a>
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

                            <th class="actions">Actions</th>
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
                                        @if ($table == 'clients')
                                            <a href="/dashboard/client/{{ $item['id'] }}/cards">
                                                <i class="fa-regular fa-credit-card"></i>
                                                <span>Cartes</span>
                                            </a>
                                        @endif
                                        <a href={{ route("$table.edit.show", ['id' => $item['id']]) }} cless="edit">
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
            @else
                <div class="no_data">
                    <p>Aucune donnée disponible</p>
                </div>
            @endif
        </div>
    </section>
@endsection


@section('script')
    <script src="{{ asset('dist/js/utils/table.js') }}"></script>
@endsection
