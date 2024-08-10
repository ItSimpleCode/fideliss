@extends('dashboard')

@section('title', $table)

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist/css/pages/actions/actions.css') }}">
@endsection

@section('content')
    <section class="dark-bg users">
        <div class="head">
            <div class="title">{{ $table }} (0)</div>
            <a class="add" href=""> <i class="fa-solid fa-plus"></i><span>ajouter une nouvelle branche</span></a>
        </div>

        <div class="main-table">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="actions btn-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td>
                            <div class="actions btn-2">
                                <a href=>
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    <span>éditer</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
@endsection

@section('script')
    <script src="{{ asset('dist/js/utils/table.js') }}"></script>
@endsection
