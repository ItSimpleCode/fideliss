@extends('dashboard')

@section('title', 'Chronologie - ??')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist\css\pages\time_line\showTable.css') }}">
@endsection


@section('content')
    {{-- <pre>
    {{ var_dump($data) }}
</pre> --}}
    <section class="outer-bg h-100">
        <div class="part-bg row head">
            <div class="title">
                <a class="return-link" href="{{ route('timeLine', ['d' => $data['date']['targetMonth']]) }}">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 12H8M8 12L11 9M8 12L11 15" class="stroke" stroke-width="1.5" stroke-linecap="round"
                              stroke-linejoin="round"/>
                        <path
                            d="M22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C21.5093 4.43821 21.8356 5.80655 21.9449 8"
                            class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </a>
                <span>Chronologie ({{$data['date']['target']}})</span>
            </div>
            <div class="options">
                <a class="head-button switcher"
                   href="{{ Route('timeLine.show', ['table' => $data['table'],'d' => $data['date']['now']]) }}">ce
                    mois-ci</a>
                <a class="head-border-button switcher"
                   href="{{ Route('timeLine.show', ['table' => $data['table'],'d' => $data['date']['previousDay']]) }}">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 19L9 12L10.5 10.25M15 5L13 7.33333" class="stroke" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
                <a class="head-border-button switcher"
                   href="{{ Route('timeLine.show', ['table' => $data['table'],'d' => $data['date']['nextDay']]) }}">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 5L11 7.33333M9 19L15 12L13.5 10.25" class="stroke" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
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
            @if (!count($data['rows']))
                <div class="no-data">la table est vide</div>
            @endif
        </div>
    </section>
@endsection

@section('script')

@endsection
