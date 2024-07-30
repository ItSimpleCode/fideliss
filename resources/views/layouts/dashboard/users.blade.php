@extends('dashboard')

@section('content')
    <section class="table Transactions">
        <div class="table_head">
            <div class="title">{{ $staffs->count() }} Users</div>
            <button>
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </button>
        </div>
        <table class="main-table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Username</th>
                    <th scope="col">email</th>
                    <th scope="col">Dete de creation</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($staffs as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->created_at->diffForHumans() }}</td>
                        <td>-</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection
