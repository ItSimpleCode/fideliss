@extends('dashboard')

@section('title', $table)

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist/css/pages/actions/actions.css') }}">
@endsection

@section('content')
    <section class="dark-bg users">
        <div class="head">
            <div class="title">{{ $table }} ({{ $data->count() }})</div>
            <a class="add" href=""> <i class="fa-solid fa-plus"></i><span>ajouter une nouvelle branche</span></a>
        </div>

        <div class="main-table">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        @foreach ($columns as $column)
                            <th>{{ $column }}</th>
                        @endforeach
                        <th class="actions btn-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $item)
                        <tr>
                            <td scope="row">{{ $index + 1 }}</td>
                            @foreach ($fields as $field)
                                <td>{{ $item[$field] }}</td>
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
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ asset('dist/js/utils/table.js') }}"></script>
@endsection
