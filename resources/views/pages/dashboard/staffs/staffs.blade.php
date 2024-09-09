@extends('dashboard')

@section('title', 'Personnel')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist/css/pages/staffs/staffs.css') }}">
@endsection

@section('content')
    <section class="outer-bg h-100">
        <div class="head">
            <div class="title">les personnels ({{ $data['rows']->count() }})</div>
            <a class="head-button add" href="{{ route("staffs.create") }}">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="10" cy="6" r="4" class="stroke" stroke-width="1.5"/>
                    <path d="M21 10H19M19 10H17M19 10L19 8M19 10L19 12" class="stroke" stroke-width="1.5"
                          stroke-linecap="round"/>
                    <path
                        d="M17.9975 18C18 17.8358 18 17.669 18 17.5C18 15.0147 14.4183 13 10 13C5.58172 13 2 15.0147 2 17.5C2 19.9853 2 22 10 22C12.231 22 13.8398 21.8433 15 21.5634"
                        class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
            </a>
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
                    <th class="fit-width">
                        <div>Actions</div>
                    </th>
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
                        <td>
                            <div class="actions">
                                <a href={{ route('staffs.edit', ['id' => $item['id']]) }} class="edit-button"
                                   title="Modifier les informations agence">
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M2 12C2 16.714 2 19.0711 3.46447 20.5355C4.92893 22 7.28595 22 12 22C16.714 22 19.0711 22 20.5355 20.5355C22 19.0711 22 16.714 22 12V10.5M13.5 2H12C7.28595 2 4.92893 2 3.46447 3.46447C2.49073 4.43821 2.16444 5.80655 2.0551 8"
                                            class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                                        <path
                                            d="M16.652 3.45506L17.3009 2.80624C18.3759 1.73125 20.1188 1.73125 21.1938 2.80624C22.2687 3.88124 22.2687 5.62415 21.1938 6.69914L20.5449 7.34795M16.652 3.45506C16.652 3.45506 16.7331 4.83379 17.9497 6.05032C19.1662 7.26685 20.5449 7.34795 20.5449 7.34795M16.652 3.45506L10.6872 9.41993C10.2832 9.82394 10.0812 10.0259 9.90743 10.2487C9.70249 10.5114 9.52679 10.7957 9.38344 11.0965C9.26191 11.3515 9.17157 11.6225 8.99089 12.1646L8.41242 13.9M20.5449 7.34795L17.5625 10.3304M14.5801 13.3128C14.1761 13.7168 13.9741 13.9188 13.7513 14.0926C13.4886 14.2975 13.2043 14.4732 12.9035 14.6166C12.6485 14.7381 12.3775 14.8284 11.8354 15.0091L10.1 15.5876M10.1 15.5876L8.97709 15.9619C8.71035 16.0508 8.41626 15.9814 8.21744 15.7826C8.01862 15.5837 7.9492 15.2897 8.03811 15.0229L8.41242 13.9M10.1 15.5876L8.41242 13.9"
                                            class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                                    </svg>
                                </a>
                                <a href={{ route('staffs.changeStatus', ['id' => $item['id']]) }} class="{{ $item['active'] ? 'disactivited-button' : 'active-button' }}"
                                   title="désactiver l'agence">
                                    @if ($item['active'])
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9 16C9 16.5523 8.55228 17 8 17C7.44772 17 7 16.5523 7 16C7 15.4477 7.44772 15 8 15C8.55228 15 9 15.4477 9 16Z"
                                                class="fill"/>
                                            <path
                                                d="M13 16C13 16.5523 12.5523 17 12 17C11.4477 17 11 16.5523 11 16C11 15.4477 11.4477 15 12 15C12.5523 15 13 15.4477 13 16Z"
                                                class="fill"/>
                                            <path
                                                d="M17 16C17 16.5523 16.5523 17 16 17C15.4477 17 15 16.5523 15 16C15 15.4477 15.4477 15 16 15C16.5523 15 17 15.4477 17 16Z"
                                                class="fill"/>
                                            <path
                                                d="M6 10V8C6 7.65929 6.0284 7.32521 6.08296 7M18 10V8C18 4.68629 15.3137 2 12 2C10.208 2 8.59942 2.78563 7.5 4.03126"
                                                class="stroke"
                                                stroke-width="1.5" stroke-linecap="round"/>
                                            <path
                                                d="M11 22H8C5.17157 22 3.75736 22 2.87868 21.1213C2 20.2426 2 18.8284 2 16C2 13.1716 2 11.7574 2.87868 10.8787C3.75736 10 5.17157 10 8 10H16C18.8284 10 20.2426 10 21.1213 10.8787C22 11.7574 22 13.1716 22 16C22 18.8284 22 20.2426 21.1213 21.1213C20.2426 22 18.8284 22 16 22H15"
                                                class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                                        </svg>
                                    @else
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11 22H8C5.17157 22 3.75736 22 2.87868 21.1213C2 20.2426 2 18.8284 2 16C2 13.1716 2 11.7574 2.87868 10.8787C3.75736 10 5.17157 10 8 10H16C18.8284 10 20.2426 10 21.1213 10.8787C22 11.7574 22 13.1716 22 16C22 18.8284 22 20.2426 21.1213 21.1213C20.2426 22 18.8284 22 16 22H15"
                                                class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                                            <path
                                                d="M6 10V8C6 7.65929 6.0284 7.32521 6.08296 7M17.811 6.5C17.1449 3.91216 14.7958 2 12 2C10.223 2 8.62643 2.7725 7.52779 4"
                                                class="stroke"
                                                stroke-width="1.5" stroke-linecap="round"/>
                                        </svg>
                                    @endif
                                </a>
                            </div>
                        </td>
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
