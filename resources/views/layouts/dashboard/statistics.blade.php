@extends('dashboard')
@section('stylesheet', 'dist/css/statistics.css')

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
                <table>
                    <thead>
                        <tr>
                            <th>creator</th>
                            <th>offer</th>
                            <th>cost</th>
                            <th>duration</th>
                            <th>reacts</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < 15; $i++)
                            <tr>
                                <td>batata</td>
                                <td>youssef elqayedy</td>
                                <td>500</td>
                                <td>2 years</td>
                                <td>50k</td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
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
                <table>
                    <thead>
                        <tr>
                            <th>creator</th>
                            <th>offer</th>
                            <th>cost</th>
                            <th>duration</th>
                            <th>react</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < 15; $i++)
                            <tr>
                                <td>ad.youssef elqayedy</td>
                                <td>batata</td>
                                <td>500</td>
                                <td>07/26/2024</td>
                                <td>5127</td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </section>

        <section class="dark-bg transactions-static">
            <div class="head">
                <div class="title">transactions static</div>
                <button>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
            </div>
            <div style="width: 100%;height:calc(100% - 28px - 24px); margin: auto;">
                <canvas id="myChart"></canvas>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line', // Change this to 'line', 'pie', etc. for different chart types
                        data: {
                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
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
