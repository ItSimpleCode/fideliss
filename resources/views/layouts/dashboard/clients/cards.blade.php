@extends('dashboard')
@section('title', $client[1] . ' - cards')
@section('content')
    <section class="dark-bg">
        <div class="head">
            <div class="title">
                <a href="{{ route('clients') }}">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>{{ $client[1] }}</span>
                </a>
            </div>
            <button>
                <a href="/dashboard/client/{{ $client[0] }}/cards/add">Add</a>
            </button>
        </div>

        <div class="main-table">
            @if ($data && $data->count() > 0)
                <div class="table_columns">
                    <span>#</span>
                    <span>Card Serial</span>
                    <span>Wallet</span>
                    <span>Card Type</span>
                    <span>Expiry Date</span>
                    <span>Actions</span>
                </div>

                <div class="table_rows" data-scrollbar>
                    @foreach ($data as $index => $item)
                        <div class="row">
                            <span>{{ $index + 1 }}</span>
                            <span>{{ $item['card_serial'] }}</span>
                            <span>{{ $item['wallet'] }} dh</span>
                            <span>{{ $item['cards']['name'] }}</span>
                            <span>{{ $item['expiry_date'] }}</span>
                            <span>
                                -
                            </span>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="no_data">
                    <p>No data exist</p>
                </div>
            @endif
        </div>

    </section>
@endsection
