@extends('dashboard')

@section('title', 'transactions en attente')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist/css/pages/actions/actions.css') }}">
@endsection

@section('content')
    @php
        $status = [
            'accepted' => 'accepté',
            'rejected' => 'rejeté',
            'pending' => 'en attente',
        ];
    @endphp
    <section class="outer-bg table h-100">
        <div class="head">
            <div class="title">les transactions en attente ({{ $data['rows']->count() }})</div>
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
                @foreach ($data['rows'] as $index => $row)
                    <tr>
                        <td>
                            <div>{{ $index + 1 }}</div>
                        </td>
                        @foreach ($data['columns'] as $db_col => $arr)
                            @if(!empty($arr))
                                <td>
                                    <div>
                                        @if($db_col === 'status')
                                            <span
                                                class="status {{$row[$db_col] ?? ''}}">{{$status[$row[$db_col]] ?? '-'}}</span>
                                        @else
                                            {{ $row[$db_col] ?? '-' }}
                                        @endif
                                    </div>
                                </td>
                            @endif
                        @endforeach
                        <td>
                            <div class="actions">
                                @if(Auth::guard('admin')->check())
                                    <a class="history-button"
                                       href="{{ Route('pending_transaction.edit', ['id' => $row['id']]) }}">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 8V12L14.5 14.5" class="stroke" stroke-width="1.5"
                                                  stroke-linecap="round" stroke-linejoin="round"/>
                                            <path
                                                d="M5.60423 5.60423L5.0739 5.0739V5.0739L5.60423 5.60423ZM4.33785 6.87061L3.58786 6.87438C3.58992 7.28564 3.92281 7.61853 4.33408 7.6206L4.33785 6.87061ZM6.87963 7.63339C7.29384 7.63547 7.63131 7.30138 7.63339 6.88717C7.63547 6.47296 7.30138 6.13549 6.88717 6.13341L6.87963 7.63339ZM5.07505 4.32129C5.07296 3.90708 4.7355 3.57298 4.32129 3.57506C3.90708 3.57715 3.57298 3.91462 3.57507 4.32882L5.07505 4.32129ZM3.75 12C3.75 11.5858 3.41421 11.25 3 11.25C2.58579 11.25 2.25 11.5858 2.25 12H3.75ZM16.8755 20.4452C17.2341 20.2378 17.3566 19.779 17.1492 19.4204C16.9418 19.0619 16.483 18.9393 16.1245 19.1468L16.8755 20.4452ZM19.1468 16.1245C18.9393 16.483 19.0619 16.9418 19.4204 17.1492C19.779 17.3566 20.2378 17.2341 20.4452 16.8755L19.1468 16.1245ZM5.14033 5.07126C4.84598 5.36269 4.84361 5.83756 5.13505 6.13191C5.42648 6.42626 5.90134 6.42862 6.19569 6.13719L5.14033 5.07126ZM18.8623 5.13786C15.0421 1.31766 8.86882 1.27898 5.0739 5.0739L6.13456 6.13456C9.33366 2.93545 14.5572 2.95404 17.8017 6.19852L18.8623 5.13786ZM5.0739 5.0739L3.80752 6.34028L4.86818 7.40094L6.13456 6.13456L5.0739 5.0739ZM4.33408 7.6206L6.87963 7.63339L6.88717 6.13341L4.34162 6.12062L4.33408 7.6206ZM5.08784 6.86684L5.07505 4.32129L3.57507 4.32882L3.58786 6.87438L5.08784 6.86684ZM12 3.75C16.5563 3.75 20.25 7.44365 20.25 12H21.75C21.75 6.61522 17.3848 2.25 12 2.25V3.75ZM12 20.25C7.44365 20.25 3.75 16.5563 3.75 12H2.25C2.25 17.3848 6.61522 21.75 12 21.75V20.25ZM16.1245 19.1468C14.9118 19.8483 13.5039 20.25 12 20.25V21.75C13.7747 21.75 15.4407 21.2752 16.8755 20.4452L16.1245 19.1468ZM20.25 12C20.25 13.5039 19.8483 14.9118 19.1468 16.1245L20.4452 16.8755C21.2752 15.4407 21.75 13.7747 21.75 12H20.25ZM6.19569 6.13719C7.68707 4.66059 9.73646 3.75 12 3.75V2.25C9.32542 2.25 6.90113 3.32791 5.14033 5.07126L6.19569 6.13719Z"
                                                class="fill"/>
                                        </svg>

                                    </a>
                                    @if(!$row->accepted)
                                        <a class="accepted-button"
                                           href="{{ Route('transaction.valid', ['id' => $row['id']]) }}">
                                            <svg viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M21 7V6.37006C21 5.17705 21 4.58055 20.842 4.09946C20.5425 3.18719 19.8468 2.47096 18.9606 2.16261C18.4933 2 17.9139 2 16.755 2H7.24502C6.08614 2 5.50671 2 5.03939 2.16261C4.15322 2.47096 3.45748 3.18719 3.15795 4.09946C3 4.58055 3 5.17705 3 6.37006V15M21 11V20.3742C21 21.2324 20.015 21.6878 19.3919 21.1176C19.0258 20.7826 18.4742 20.7826 18.1081 21.1176L17.625 21.5597C16.9834 22.1468 16.0166 22.1468 15.375 21.5597C14.7334 20.9726 13.7666 20.9726 13.125 21.5597C12.4834 22.1468 11.5166 22.1468 10.875 21.5597C10.2334 20.9726 9.26659 20.9726 8.625 21.5597C7.98341 22.1468 7.01659 22.1468 6.375 21.5597L5.8919 21.1176C5.52583 20.7826 4.97417 20.7826 4.6081 21.1176C3.985 21.6878 3 21.2324 3 20.3742V19"
                                                    class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                                                <path d="M9.5 10.4L10.9286 12L14.5 8" class="stroke" stroke-width="1.5"
                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M7.5 15.5H9M16.5 15.5H12" class="stroke" stroke-width="1.5"
                                                      stroke-linecap="round"/>
                                            </svg>
                                        </a>
                                        <a class="rejected-button"
                                           href="{{Route('transaction.invalid', ['id' => $row['id']])}}">
                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14 8.00003L10 12M10 8.00002L14 12" class="stroke"
                                                      stroke-width="1.5"
                                                      stroke-linecap="round"/>
                                                <path d="M7.5 15.5H9M16.5 15.5H12" class="stroke" stroke-width="1.5"
                                                      stroke-linecap="round"/>
                                                <path
                                                    d="M21 7V6.37006C21 5.17705 21 4.58055 20.842 4.09946C20.5425 3.18719 19.8468 2.47096 18.9606 2.16261C18.4933 2 17.9139 2 16.755 2H7.24502C6.08614 2 5.50671 2 5.03939 2.16261C4.15322 2.47096 3.45748 3.18719 3.15795 4.09946C3 4.58055 3 5.17705 3 6.37006V15M21 11V20.3742C21 21.2324 20.015 21.6878 19.3919 21.1176C19.0258 20.7826 18.4742 20.7826 18.1081 21.1176L17.625 21.5597C16.9834 22.1468 16.0166 22.1468 15.375 21.5597C14.7334 20.9726 13.7666 20.9726 13.125 21.5597C12.4834 22.1468 11.5166 22.1468 10.875 21.5597C10.2334 20.9726 9.26659 20.9726 8.625 21.5597C7.98341 22.1468 7.01659 22.1468 6.375 21.5597L5.8919 21.1176C5.52583 20.7826 4.97417 20.7826 4.6081 21.1176C3.985 21.6878 3 21.2324 3 20.3742V19"
                                                    class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                                            </svg>
                                        </a>
                                    @endif
                                @elseif(Auth::guard('staff')->check() && !$row->accepted)
                                    <a class="edit-button"
                                       href="{{ Route('pending_transaction.edit', ['id' => $row['id']]) }}">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M2 12C2 16.714 2 19.0711 3.46447 20.5355C4.92893 22 7.28595 22 12 22C16.714 22 19.0711 22 20.5355 20.5355C22 19.0711 22 16.714 22 12V10.5M13.5 2H12C7.28595 2 4.92893 2 3.46447 3.46447C2.49073 4.43821 2.16444 5.80655 2.0551 8"
                                                class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                                            <path
                                                d="M16.652 3.45506L17.3009 2.80624C18.3759 1.73125 20.1188 1.73125 21.1938 2.80624C22.2687 3.88124 22.2687 5.62415 21.1938 6.69914L20.5449 7.34795M16.652 3.45506C16.652 3.45506 16.7331 4.83379 17.9497 6.05032C19.1662 7.26685 20.5449 7.34795 20.5449 7.34795M16.652 3.45506L10.6872 9.41993C10.2832 9.82394 10.0812 10.0259 9.90743 10.2487C9.70249 10.5114 9.52679 10.7957 9.38344 11.0965C9.26191 11.3515 9.17157 11.6225 8.99089 12.1646L8.41242 13.9M20.5449 7.34795L17.5625 10.3304M14.5801 13.3128C14.1761 13.7168 13.9741 13.9188 13.7513 14.0926C13.4886 14.2975 13.2043 14.4732 12.9035 14.6166C12.6485 14.7381 12.3775 14.8284 11.8354 15.0091L10.1 15.5876M10.1 15.5876L8.97709 15.9619C8.71035 16.0508 8.41626 15.9814 8.21744 15.7826C8.01862 15.5837 7.9492 15.2897 8.03811 15.0229L8.41242 13.9M10.1 15.5876L8.41242 13.9"
                                                class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                                        </svg>
                                    </a>
                                    <a class="delete-button"
                                       href="{{Route('pending_transaction.delete', ['id' => $row['id']])}}">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9.17065 4C9.58249 2.83481 10.6937 2 11.9999 2C13.3062 2 14.4174 2.83481 14.8292 4"
                                                class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                                            <path d="M20.5 6H3.49988" class="stroke" stroke-width="1.5"
                                                  stroke-linecap="round"/>
                                            <path
                                                d="M18.3735 15.3991C18.1965 18.054 18.108 19.3815 17.243 20.1907C16.378 21 15.0476 21 12.3868 21H11.6134C8.9526 21 7.6222 21 6.75719 20.1907C5.89218 19.3815 5.80368 18.054 5.62669 15.3991L5.16675 8.5M18.8334 8.5L18.6334 11.5"
                                                class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                                            <path d="M9.5 11L10 16" class="stroke" stroke-width="1.5"
                                                  stroke-linecap="round"/>
                                            <path d="M14.5 11L14 16" class="stroke" stroke-width="1.5"
                                                  stroke-linecap="round"/>
                                        </svg>
                                    </a>
                                @endif
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
