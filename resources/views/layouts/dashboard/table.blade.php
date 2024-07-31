@extends('dashboard')
@section('content')
    <section class="dark-bg users">
        <div class="head">
            <div class="title">admins ({{ $admins->count() }})</div>
            <button>
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </button>
        </div>
        <div class="main-table">
            <div class="table_columns">
                <span>#</span>
                <span>Username</span>
                <span>email</span>
                <span>Dete</span>
                <span>Dete de creation</span>
                <span>Actions</span>
            </div>
            <div class="table_rows" data-scrollbar>
                @foreach ($admins as $index => $item)
                    @for ($i = 0; $i < 100; $i++)
                        <div class="row">
                            <span>{{ $index + 1 }}</span>
                            <span>{{ $item->username }}</span>
                            <span>{{ $item->email }}</span>
                            <span>{{ $item->created_at->format('d-m-Y') }}</span>
                            <span>{{ $item->created_at->diffForHumans() }}</span>
                            <span>-</span>
                        </div>
                    @endfor
                @endforeach
            </div>
        </div>
    </section>
@endsection
