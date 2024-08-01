@extends('dashboard')
@section('content')
    <section class="dark-bg users">
        <div class="head">
            <div class="title">{{ $table }} ({{ $data->count() }})</div>
            <button>
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </button>
        </div>
        <div class="main-table">

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
                        @foreach (array_flip($columns) as $key => $val)
                            @if ($key !== '-')
                                @if ($val == 'created_at')
                                    <span>{{ $item[$val]->diffForHumans() }}</span>
                                @else
                                    <span>{{ $item[$val] }}</span>
                                @endif
                            @endif
                        @endforeach
                        <span>-</span>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
@endsection
