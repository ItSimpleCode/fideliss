@extends('dashboard')

@section('title', $table)

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist/css/pages/demandes/demandes.css') }}">
@endsection

@section('search')
    <div class="search">
        <i class="fa-solid fa-magnifying-glass"></i>
        <span class="bar"></span>
        <input type="text" id="nav-searcher" placeholder="chercher">
    </div>
@endsection

@section('content')
    <section class="outer-bg users">
        <div class="head">
            <div class="title">{{ $table }} ({{ $data->count() }})</div>
        </div>
        <div class="main-table body">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        @foreach ($columns as $column)
                            <th>{{ $column }}</th>
                        @endforeach
                        <th class="actions btn-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $item)
                        <tr>
                            <td scope="row">{{ $index + 1 }}</td>
                            @foreach ($fields as $field)
                                @if ($field == 'status')
                                    <td class={{ $item[$field] }}>{{ $item[$field] }}</td>
                                @else
                                    <td>{{ $item[$field] }}</td>
                                @endif
                            @endforeach
                            <td>
                                @if ($item['status'] != 'Done')
                                    <div class="actions btn-3">
                                        @if ($item['status'] != 'Waiting')
                                            <a href={{ route('transaction.demande.resend', ['id' => $item['id']]) }} class="send">
                                                <i class="fa-regular fa-paper-plane"></i>
                                                <span>renvoyer</span>
                                            </a>
                                        @endif
                                        <a href={{ route('transaction.demande.edit.show', ['id' => $item['id']]) }} class="edit">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                            <span>modifier</span>
                                        </a>
                                        <a href={{ route('transaction.demande.annuler', ['id' => $item['id']]) }} class="annulation">
                                            <i class="fa-regular fa-trash-can"></i>
                                            <span>annulation</span>
                                        </a>
                                    </div>
                                @else
                                    -
                                @endif
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
