@extends('dashboard')

@section('title', $table)

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist\css\pages\cards\cards.css') }}">
@endsection

@section('content')
    <section class="dark-bg">
        <div class="head">
            <div class="title">cards</div>
            <a class="add" href=""> <i class="fa-solid fa-plus"></i><span>add new card</span></a>
        </div>
        <div class="main-table">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">0</td>
                        <td>
                            <div class="actions">
                                <a href=>
                                    <span>-</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
@endsection
