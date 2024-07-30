<section class="table {{ section('table_class') }}">
    <div class="table_head">
        <div class="title">{{ section('table_title') }}</div>
        <button>
            <i class="fa-solid fa-ellipsis-vertical"></i>
        </button>
    </div>
    <table class="main-table">
        <thead>
            <tr>
                @foreach (section('table_columns') as $col)
                    <th scope="col">{{ $col }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach (section('table_rows') as $row)
                <tr>
                    @foreach ($row as $data)
                        <td>{{ $data }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</section>
