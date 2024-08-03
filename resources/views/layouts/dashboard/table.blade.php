@extends('dashboard')
@section('title', $table)

@section('content')
    <section class="dark-bg users">

        <div class="head">
            <div class="title">{{ $table }} ({{ $data->count() }})</div>
            <button>
                <a href={{ route($table . '.add.show') }}>Add</a>
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

                            <span>
                                @if ($table == 'clients')
                                    <a href="/dashboard/client/{{ $item['id'] }}/cards">cards</a>
                                @endif
                                <a href={{ route($table . '.edite.show', ['id' => $item['id']]) }}>cards</a>
                                <a>Desactivate</a>
                            </span>
                        </div>
                    @endforeach
                </div>

            @else
                <div class="no_data">
                    <p>no data exist</p>
                </div>
            @endif

        </div>
    </section>
@endsection
