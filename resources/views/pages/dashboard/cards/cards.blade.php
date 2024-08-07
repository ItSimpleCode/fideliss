@extends('dashboard')

@section('title', $table)

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist/css/pages/cards/cards.css') }}">
@endsection

@section('content')
    <section class="dark-bg">
        <div class="head">
            <div class="title">cartes</div>

            <a class="add" href="{{ Route('cards.add.type.of.card') }}"> <i class="fa-solid fa-plus"></i><span>ajouter une nouvelle carte</span></a>
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
                                        <a href={{ route("$table.edit.show", ['id' => $item['id']]) }}>
                                            <i class="fa-regular fa-pen-to-square"></i>
                                            <span>modifier</span>
                                        </a>
                                        {{-- <a href=""><i class="fa-solid fa-user-slash"></i><span>désactiver</span></a> --}}


                                        @if ($item['active'])
                                            <a href={{ route('cards.edit.status', ['id' => $item['id']]) }} class='active'>
                                                <i class="fa-solid fa-user"></i><span>actif</span>
                                            </a>
                                        @else
                                            <a href={{ route('cards.edit.status', ['id' => $item['id']]) }}
                                                class='disactive'>
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
