{{-- <section class="table {{ yield ('table_class') }}"> --}}
<section>
    <div class="table_head">
        <div class="title">@yield ('table_title')</div>
        <button>
            <i class="fa-solid fa-ellipsis-vertical"></i>
        </button>
    </div>
    <table class="main-table">
            <thead>
                <tr>
                    @yield('table_columns')
                </tr>
            </thead>
        {{-- <tbody>
            @foreach ((yield 'table_rows') as $row)
                <tr>
                    @foreach ($row as $data)
                        <td>{{ $data }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody> --}}
    </table>
</section>
