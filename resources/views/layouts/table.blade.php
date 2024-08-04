@extends('dashboard')
@section('title', $table)

@section('stylesheet', 'dist/css/users.css')

@section('content')
    <section class="dark-bg users">
        <div class="head">
            <div class="title">{{ $table }} ({{ $data->count() }})</div>
            <a class="add" href="{{ route("$table.add.show") }}"> <i class="fa-solid fa-plus"></i><span>add new
                    row</span></a>
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
                                    <div class="actions">
                                        @foreach ($btnd as $btn)
                                            <a href={{ route("$table.edit.show", ['id' => $item['id']]) }}>
                                                <i class="fa-regular fa-pen-to-square"></i>
                                                <span>edit</span>
                                            </a>
                                        @endforeach
                                        {{-- @if ($table == 'clients')
                                            <a href="/dashboard/client/{{ $item['id'] }}/cards">
                                                <i class="fa-regular fa-credit-card"></i>
                                                <span>cards</span>
                                            </a>
                                        @endif
                                        <a href={{ route("$table.edit.show", ['id' => $item['id']]) }}>
                                            <i class="fa-regular fa-pen-to-square"></i>
                                            <span>edit</span>
                                        </a>
                                        <a href=""><i class="fa-solid fa-user-slash"></i><span>disactive</span></a> --}}
                                    </div>
                                </td>

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
