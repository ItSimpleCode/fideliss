@extends('dashboard')

@section('title', 'Statistiques')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist\css\pages\statistics\statistics.css') }}">
@endsection

@section('date')
    <form class="date">
        <i class="fa-regular fa-calendar"></i>
        <input type="date" name="dateStart" value="{{ $date['dateStart'] }}" onfocus="this.showPicker();">
        <input type="date" name="dateEnd" value="{{ $date['dateEnd'] }}" onfocus="this.showPicker();">
        <button type="submit"><i class="fa-solid fa-angle-right"></i></button>
    </form>
@endsection

@section('content')
    <section class="statistics-cards">
        <div class="card">
            <div class="up">
                <i class="fa-solid fa-circle-dollar-to-slot"></i>
                <div class="number">249k</div>
            </div>
            <div class="down">
                <span class="card-name">clients</span>
                <span class="percent">10% <i class="fa-solid fa-arrow-trend-down"></i></span>
            </div>
        </div>
        <div class="card">
            <div class="up">
                <i class="fa-solid fa-circle-dollar-to-slot"></i>
                <div class="number">249k</div>
            </div>
            <div class="down">
                <span class="card-name">cards</span>
                <span class="percent">10% <i class="fa-solid fa-arrow-trend-down"></i></span>
            </div>
        </div>
        <div class="card">
            <div class="up">
                <i class="fa-solid fa-circle-dollar-to-slot"></i>
                <div class="number">249k</div>
            </div>
            <div class="down">
                <span class="card-name">visites</span>
                <span class="percent">10% <i class="fa-solid fa-arrow-trend-down"></i></span>
            </div>
        </div>
        <div class="card">
            <div class="up">
                <i class="fa-solid fa-circle-dollar-to-slot"></i>
                <div class="number">249k</div>
            </div>
            <div class="down">
                <span class="card-name">visites</span>
                <span class="percent">10% <i class="fa-solid fa-arrow-trend-down"></i></span>
            </div>
        </div>
        <div class="card">
            <div class="up">
                <i class="fa-solid fa-circle-dollar-to-slot"></i>
                <div class="number">249k</div>
            </div>
            <div class="down">
                <span class="card-name">visites</span>
                <span class="percent">10% <i class="fa-solid fa-arrow-trend-down"></i></span>
            </div>
        </div>
    </section>


    <div class="wrapper">

        <section class="dark-bg transactions">
            <div class="head">
                <div class="title">transactions</div>

            </div>
            <div class="main-table">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            @foreach ($columns as $column)
                                @if ($column !== '-')
                                    <th>{{ $column }}</th>
                                @endif
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $index => $item)
                            <tr>
                                <td scope="row">{{ $index + 1 }}</td>
                                @foreach ($fields as $field)
                                    <td>{{ $item[$field] }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <section class="dark-bg rewards">
            <div class="head">
                <div class="title">récompenses</div>

            </div>

            <div class="main-table">
                <table>
                    <thead>
                        <tr>
                            <th>créateur</th>
                            <th>offre</th>
                            <th>coût</th>
                            <th>durée</th>
                            <th>réaction</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < 15; $i++)
                            <tr>
                                <td>ad.youssef elqayedy</td>
                                <td>batata</td>
                                <td>500</td>
                                <td>26/07/2024</td>
                                <td>5127</td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </section>

        <section class="dark-bg transactions-static">
            <div class="head">
                <div class="title">statistiques des transactions</div>

            </div>
            <div class="chart">
                <canvas id="myChart"></canvas>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line', // Changez ceci en 'line', 'pie', etc. pour différents types de graphiques
                        data: {
                            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jui', 'Juil'],
                            datasets: [{
                                label: 'transactions',
                                data: [12, 19, 3, 5, 2, 3, 7],
                                backgroundColor: 'rgba(75, 192, 192, 0.45)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
            </script>
        </section>
    </div>
@endsection
