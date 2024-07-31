@extends('dashboard')

@section('content')
    <section class="statistics-cards">
        @for ($i = 0; $i < 5; $i++)
            <div class="card">
                <div class="up">
                    <i class="fa-solid fa-circle-dollar-to-slot"></i>
                    <div class="number">249k</div>
                </div>
                <div class="down">
                    <span class="card-name">vists</span>
                    <span class="percent">10% <i class="fa-solid fa-arrow-trend-down"></i></span>
                </div>
            </div>
        @endfor
    </section>


    <div class="tables">

        <section class="dark-bg transactions">
            <div class="head">
                <div class="title">transactions</div>
                <button>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
            </div>
            <div class="main-table">
                <div class="table_columns">
                    <span>creator</span>
                    <span>offer</span>
                    <span>cost</span>
                    <span>duration</span>
                    <span>reacts</span>
                </div>
                <div class="table_rows" data-scrollbar>
                    @for ($i = 0; $i < 15; $i++)
                        <div class="row">
                            <span>batata</span>
                            <span>youssef elqayedy</span>
                            <span>500</span>
                            <span>2 years</span>
                            <span>50k</span>
                        </div>
                    @endfor
                </div>
            </div>
        </section>

        <section class="dark-bg rewards">
            <div class="head">
                <div class="title">rewards</div>
                <button>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
            </div>
            <div class="main-table">
                <div class="table_columns">
                    <span>creator</span>
                    <span>offer</span>
                    <span>cost</span>
                    <span>duration</span>
                    <span>react</span>
                </div>
                <div class="table_rows" data-scrollbar>
                    @for ($i = 0; $i < 15; $i++)
                        <div class="row">
                            <span>ad.youssef elqayedy</span>
                            <span>batata</span>
                            <span>500</span>
                            <span>07/26/2024</span>
                            <span>5127</span>
                        </div>
                    @endfor
                </div>
            </div>
        </section>

        <section class="dark-bg transactions-static">
            <div class="head">
                <div class="title">transactions static</div>
                <button>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
            </div>
        </section>
    </div>
@endsection
