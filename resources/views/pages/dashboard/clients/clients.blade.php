@extends('dashboard')

@section('title', 'Clients')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist/css/pages/clients/clients.css') }}">
@endsection

@section('search')
    <div class="search">
        <i class="fa-solid fa-magnifying-glass"></i>
        <span class="bar"></span>
        <input type="text" id="nav-searcher" placeholder="chercher">
    </div>
@endsection

@section('content')
    @php
        $status = [
            'invalid' => 'invalide',
            'active' => 'actif',
            'expire' => 'expiré',
            'disactivited' => 'désactivé',
        ];
    @endphp
    <section class="outer-bg h-100">
        <div class="head">
            <div class="title">clients ({{ $data['rows']->count() }})</div>
            <div class="options">
                <form class="search-form" action="{{ Route('clients.searchForCard')  }}" method="post">
                    @csrf
                    <input type="text" name="card_serial" placeholder="série de carte" minlength="16"
                           maxlength="16">
                    <button class="search-button">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.5 18.5L22 22" class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                            <path
                                d="M6.75 3.27093C8.14732 2.46262 9.76964 2 11.5 2C16.7467 2 21 6.25329 21 11.5C21 16.7467 16.7467 21 11.5 21C6.25329 21 2 16.7467 2 11.5C2 9.76964 2.46262 8.14732 3.27093 6.75"
                                class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    </button>
                </form>
                <a class="head-button add" href="{{ route('clients.create') }}">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="10" cy="6" r="4" class="stroke" stroke-width="1.5"/>
                        <path d="M21 10H19M19 10H17M19 10L19 8M19 10L19 12" class="stroke" stroke-width="1.5"
                              stroke-linecap="round"/>
                        <path
                            d="M17.9975 18C18 17.8358 18 17.669 18 17.5C18 15.0147 14.4183 13 10 13C5.58172 13 2 15.0147 2 17.5C2 19.9853 2 22 10 22C12.231 22 13.8398 21.8433 15 21.5634"
                            class="stroke"
                            stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </a>
                <a class="head-button add" href="{{ route('clients.create') }}">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2 12C2 15.7712 2 17.6569 3.17157 18.8284C4.34315 20 6.22876 20 10 20H14C17.7712 20 19.6569 20 20.8284 18.8284C22 17.6569 22 15.7712 22 12C22 8.22876 22 6.34315 20.8284 5.17157C19.6569 4 17.7712 4 14 4H10C6.22876 4 4.34315 4 3.17157 5.17157C2.51839 5.82475 2.22937 6.69989 2.10149 8"
                            class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M10 16H6" class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M14 13H18" class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M14 16H12.5" class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M9.5 13H11.5" class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M18 16H16.5" class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M6 13H7" class="stroke" stroke-width="1.5" stroke-linecap="round"/>
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
                                            <span class="status {{$row[$db_col]}}">{{$row[$db_col]}}</span>
                                        @else
                                            {{ $row[$db_col] }}
                                        @endif
                                    </div>
                                </td>
                            @endif
                        @endforeach
                        <td>
                            <div class="actions">
                                @if($row->status === 'pending')
                                    <a href={{ route('clients.renew', ['id' => $row['id']]) }} class="pending-button"
                                       title="renouveler la carte">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9.5 19.75C9.91421 19.75 10.25 19.4142 10.25 19C10.25 18.5858 9.91421 18.25 9.5 18.25V19.75ZM11 5V5.75C11.3033 5.75 11.5768 5.56727 11.6929 5.28701C11.809 5.00676 11.7448 4.68417 11.5303 4.46967L11 5ZM9.53033 2.46967C9.23744 2.17678 8.76256 2.17678 8.46967 2.46967C8.17678 2.76256 8.17678 3.23744 8.46967 3.53033L9.53033 2.46967ZM1.25 12C1.25 12.4142 1.58579 12.75 2 12.75C2.41421 12.75 2.75 12.4142 2.75 12H1.25ZM3.86991 15.5709C3.63293 15.2312 3.16541 15.1479 2.82569 15.3849C2.48596 15.6219 2.40267 16.0894 2.63965 16.4291L3.86991 15.5709ZM9.5 18.25H9.00028V19.75H9.5V18.25ZM9 5.75H11V4.25H9V5.75ZM11.5303 4.46967L9.53033 2.46967L8.46967 3.53033L10.4697 5.53033L11.5303 4.46967ZM2.75 12C2.75 8.54822 5.54822 5.75 9 5.75V4.25C4.71979 4.25 1.25 7.71979 1.25 12H2.75ZM2.63965 16.4291C4.03893 18.435 6.36604 19.75 9.00028 19.75V18.25C6.87703 18.25 5.00068 17.1919 3.86991 15.5709L2.63965 16.4291Z"
                                                class="fill"/>
                                            <path
                                                d="M13 19V18.25C12.6967 18.25 12.4232 18.4327 12.3071 18.713C12.191 18.9932 12.2552 19.3158 12.4697 19.5303L13 19ZM14.4697 21.5303C14.7626 21.8232 15.2374 21.8232 15.5303 21.5303C15.8232 21.2374 15.8232 20.7626 15.5303 20.4697L14.4697 21.5303ZM14.5 4.25C14.0858 4.25 13.75 4.58579 13.75 5C13.75 5.41421 14.0858 5.75 14.5 5.75V4.25ZM22.75 12C22.75 11.5858 22.4142 11.25 22 11.25C21.5858 11.25 21.25 11.5858 21.25 12H22.75ZM20.1302 8.42907C20.3671 8.76881 20.8347 8.85211 21.1744 8.61514C21.5141 8.37817 21.5974 7.91066 21.3604 7.57093L20.1302 8.42907ZM15 18.25H13V19.75H15V18.25ZM12.4697 19.5303L14.4697 21.5303L15.5303 20.4697L13.5303 18.4697L12.4697 19.5303ZM14.5 5.75H15V4.25H14.5V5.75ZM21.25 12C21.25 15.4518 18.4518 18.25 15 18.25V19.75C19.2802 19.75 22.75 16.2802 22.75 12H21.25ZM21.3604 7.57093C19.9613 5.56497 17.6342 4.25 15 4.25V5.75C17.1232 5.75 18.9995 6.80806 20.1302 8.42907L21.3604 7.57093Z"
                                                class="fill"/>
                                        </svg>
                                    </a>
                                @endif
                                @if ($row->status === 'invalid')
                                    <a href={{ route('clients.edit', ['id' => $row['id']]) }} class="edit-button"
                                       title="Modifier les informations client">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M2 12C2 16.714 2 19.0711 3.46447 20.5355C4.92893 22 7.28595 22 12 22C16.714 22 19.0711 22 20.5355 20.5355C22 19.0711 22 16.714 22 12V10.5M13.5 2H12C7.28595 2 4.92893 2 3.46447 3.46447C2.49073 4.43821 2.16444 5.80655 2.0551 8"
                                                class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                                            <path
                                                d="M16.652 3.45506L17.3009 2.80624C18.3759 1.73125 20.1188 1.73125 21.1938 2.80624C22.2687 3.88124 22.2687 5.62415 21.1938 6.69914L20.5449 7.34795M16.652 3.45506C16.652 3.45506 16.7331 4.83379 17.9497 6.05032C19.1662 7.26685 20.5449 7.34795 20.5449 7.34795M16.652 3.45506L10.6872 9.41993C10.2832 9.82394 10.0812 10.0259 9.90743 10.2487C9.70249 10.5114 9.52679 10.7957 9.38344 11.0965C9.26191 11.3515 9.17157 11.6225 8.99089 12.1646L8.41242 13.9M20.5449 7.34795L17.5625 10.3304M14.5801 13.3128C14.1761 13.7168 13.9741 13.9188 13.7513 14.0926C13.4886 14.2975 13.2043 14.4732 12.9035 14.6166C12.6485 14.7381 12.3775 14.8284 11.8354 15.0091L10.1 15.5876M10.1 15.5876L8.97709 15.9619C8.71035 16.0508 8.41626 15.9814 8.21744 15.7826C8.01862 15.5837 7.9492 15.2897 8.03811 15.0229L8.41242 13.9M10.1 15.5876L8.41242 13.9"
                                                class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                                        </svg>
                                    </a>
                                    @if (Auth::guard('admin')->check())
                                        <a href={{ route('clients.active', ['id' => $row['id']]) }} class="active-button"
                                           title="valider le client">
                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M11 12C11 13.3807 9.88071 14.5 8.5 14.5C7.11929 14.5 6 13.3807 6 12C6 10.6193 7.11929 9.5 8.5 9.5C9.88071 9.5 11 10.6193 11 12Z"
                                                    class="stroke"
                                                    stroke-width="1.5"/>
                                                <path
                                                    d="M11 12H15.5M15.5 12H17C17.5523 12 18 12.4477 18 13V14M15.5 12V13.5"
                                                    class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                                                <path
                                                    d="M22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C21.5093 4.43821 21.8356 5.80655 21.9449 8"
                                                    class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                                            </svg>
                                        </a>
                                    @endif
                                @endif
                                @if ($row->status === 'active')
                                    <a href={{ route('clients.wallet', ['card_serial' => $row['card_serial']]) }} class="wallet-button"
                                       title="portefeuille">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15 5L9 5C6.19108 5 4.78661 5 3.77772 5.67412C3.34096 5.96596 2.96596 6.34096 2.67412 6.77772C2 7.78661 2 9.19108 2 12C2 14.8089 2 16.2134 2.67412 17.2223C2.96596 17.659 3.34096 18.034 3.77772 18.3259C4.12468 18.5577 4.51843 18.7098 5 18.8096M9 19H15C17.8089 19 19.2134 19 20.2223 18.3259C20.659 18.034 21.034 17.659 21.3259 17.2223C22 16.2134 22 14.8089 22 12C22 9.19108 22 7.78661 21.3259 6.77772C21.034 6.34096 20.659 5.96596 20.2223 5.67412C19.8753 5.44229 19.4816 5.29018 19 5.19039"
                                                class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                                            <path
                                                d="M12 9C13.6569 9 15 10.3431 15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9Z"
                                                class="stroke"
                                                stroke-width="1.5"/>
                                            <path d="M18.5 15L18.5 14M18.5 9L18.5 11.5" class="stroke"
                                                  stroke-width="1.5" stroke-linecap="round"/>
                                            <path d="M5.5 9L5.5 10M5.5 15L5.5 12.5" class="stroke" stroke-width="1.5"
                                                  stroke-linecap="round"/>
                                        </svg>
                                    </a>
                                @endif
                                @if ($row->status === 'disactivited')
                                    @if (Auth::guard('admin')->check())
                                        <a href={{ route('clients.active', ['id' => $row['id']]) }} class="active-button"
                                           title="Activer le client">
                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M11 22H8C5.17157 22 3.75736 22 2.87868 21.1213C2 20.2426 2 18.8284 2 16C2 13.1716 2 11.7574 2.87868 10.8787C3.75736 10 5.17157 10 8 10H16C18.8284 10 20.2426 10 21.1213 10.8787C22 11.7574 22 13.1716 22 16C22 18.8284 22 20.2426 21.1213 21.1213C20.2426 22 18.8284 22 16 22H15"
                                                    class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                                                <path
                                                    d="M6 10V8C6 7.65929 6.0284 7.32521 6.08296 7M17.811 6.5C17.1449 3.91216 14.7958 2 12 2C10.223 2 8.62643 2.7725 7.52779 4"
                                                    class="stroke"
                                                    stroke-width="1.5" stroke-linecap="round"/>
                                            </svg>
                                        </a>
                                    @endif
                                    <a href="{{ Route('clients.status', ['id' => $row->id]) }}" class="message-button"
                                       title="message">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8 12H9M16 12H12" class="stroke" stroke-width="1.5"
                                                  stroke-linecap="round"/>
                                            <path d="M16 8H15M12 8H8" class="stroke" stroke-width="1.5"
                                                  stroke-linecap="round"/>
                                            <path d="M8 16H13" class="stroke" stroke-width="1.5"
                                                  stroke-linecap="round"/>
                                            <path
                                                d="M3 14V10C3 6.22876 3 4.34315 4.17157 3.17157C5.34315 2 7.22876 2 11 2H13C16.7712 2 18.6569 2 19.8284 3.17157C20.4816 3.82476 20.7706 4.69989 20.8985 6M21 10V14C21 17.7712 21 19.6569 19.8284 20.8284C18.6569 22 16.7712 22 13 22H11C7.22876 22 5.34315 22 4.17157 20.8284C3.51839 20.1752 3.22937 19.3001 3.10149 18"
                                                class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                                        </svg>
                                    </a>
                                @elseif ($row->status !== 'expired')
                                    <a href={{ route('clients.deactivate', ['id' => $row['id']]) }} class="disactivited-button"
                                       title="désactiver le client">
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
                                    </a>
                                @endif
                                <a href={{ route('clients.history', ['id' => $row['id']]) }} class="history-button"
                                   title="historique du client">
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 12H9M16 12H12" class="stroke" stroke-width="1.5"
                                              stroke-linecap="round"/>
                                        <path d="M16 8H15M12 8H8" class="stroke" stroke-width="1.5"
                                              stroke-linecap="round"/>
                                        <path d="M8 16H13" class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                                        <path
                                            d="M3 14V10C3 6.22876 3 4.34315 4.17157 3.17157C5.34315 2 7.22876 2 11 2H13C16.7712 2 18.6569 2 19.8284 3.17157C20.4816 3.82476 20.7706 4.69989 20.8985 6M21 10V14C21 17.7712 21 19.6569 19.8284 20.8284C18.6569 22 16.7712 22 13 22H11C7.22876 22 5.34315 22 4.17157 20.8284C3.51839 20.1752 3.22937 19.3001 3.10149 18"
                                            class="stroke" stroke-width="1.5" stroke-linecap="round"/>
                                    </svg>

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
