@extends('dashboard')

@section('title', $table)

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist/css/pages/staffs/staffs.css') }}">
@endsection

@section('content')
    <section class="dark-bg users">
        <div class="head">
            <div class="title">{{ $table }} ({{ $data->count() }})</div>
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
                            {{-- <th class="actions btn-2">Actions</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index => $item)
                            <tr>
                                <td scope="row">{{ $index + 1 }}</td>
                                @foreach ($fields as $field)
                                    @if ($field == 'status')
                                        <td class="{{ $field }}">{{ $item[$field] }}</td>
                                    @else
                                        <td>{{ $item[$field] }}</td>
                                    @endif
                                @endforeach
                                {{-- <td>
                                    <div class="actions btn-2">
                                        <a href=''>
                                            <i class="fa-regular fa-pen-to-square"></i>
                                            <span>modifier</span>
                                        </a>
                                    </div>
                                </td> --}}

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
