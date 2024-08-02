@extends('dashboard')
@section('title', $table)
@section('content')
    <section class="dark-bg users">
        <div class="head">
            <div class="title">{{ $table }} ({{ $data->count() }})</div>
            <button>
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </button>
        </div>
        <div class="main-table">
            @if ($data->count() > 0)
                <div class="table_columns">
                    <span>#</span>
                    @foreach ($columns as $column)
                        @if ($column !== '-')
                            <span>{{ $column }}</span>
                        @endif
                    @endforeach
                    <span>Actions</span>
                </div>

                <div class="table_rows" data-scrollbar>
                    @foreach ($data as $index => $item)
                        <div class="row">
                            <span>{{ $index + 1 }}</span>

                            @foreach ($fields as $field)
                                @if ($field == 'created_at')
                                    <span>{{ $item[$field]->diffForHumans() }}</span>
                                @else
                                    <span>{{ $item[$field] }}</span>
                                @endif
                            @endforeach

                            <span>-</span>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- <div class="no_data">
                    <p>no data exist</p>
                </div> --}}
            @endif

        </div>
    </section>
@endsection
