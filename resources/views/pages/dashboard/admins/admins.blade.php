@extends('dashboard')

@section('title', 'Administrateurs')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist\css\pages\admins\admins.css') }}">
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
            <div class="title">administrateurs ({{ $data['rows']->count() }})</div>
        </div>

        <div class="main-table body">
            <table>
                <thead>
                <tr>
                    <th class="fit-width">
                        <div>#</div>
                    </th>
                    @foreach ($data['columns'] as $db_col => $arr)
                        @if(!empty($arr))
                            <th {{ !empty($arr['th_class']) ? "class={$arr['th_class']}" : '' }}>
                                <div>{{ $arr['text'] }}</div>
                            </th>
                        @endif
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @foreach ($data['rows'] as $index => $item)
                    <tr>
                        <td>
                            <div>{{ $index + 1 }}</div>
                        </td>
                        @foreach ($data['columns'] as $db_col => $arr)
                            @if(!empty($arr))
                                <td>
                                    <div>{{ $item[$db_col] }}</div>
                                </td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
            @if (!$data['rows']->count())
                <div class="no-data">la table est vide</div>
            @endif
        </div>

    </section>
@endsection

@section('script')
    <script src="{{ asset('dist/js/utils/table.js') }}"></script>
@endsection
