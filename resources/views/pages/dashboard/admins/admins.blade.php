@extends('dashboard')

@section('title', $table)

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist\css\pages\admins\admins.css') }}">
@endsection

@section('content')
    <section class="dark-bg users">
        <div class="head">
            <div class="title">{{ $table }} ({{ $data->count() }})</div>
            {{-- <a class="add" href="{{ route("$table.add.show") }}"> <i class="fa-solid fa-plus"></i><span>add new row</span></a> --}}
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

                            {{-- <th class="actions btn-1">Actions</th> --}}
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

                                {{-- <td>
                                    <div class="actions btn-1">
                                        <a href={{ route("$table.edit.show", ['id' => $item['id']]) }}>
                                            <i class="fa-regular fa-pen-to-square"></i>
                                            <span>edit</span>
                                        </a>
                                    </div>
                                </td> --}}

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="no_data">
                    <p>no data exist</p>
                </div>
            @endif
        </div>
    </section>
@endsection
