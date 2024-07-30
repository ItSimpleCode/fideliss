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
        <section class="table Transactions">
            <div class="table_head">
                <div class="title">transactions</div>
                <button>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
            </div>
            <table class="main-table">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">name</th>
                        <th scope="col">points</th>
                        <th scope="col">staff</th>
                        <th scope="col">date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>id4589</td>
                        <td>youssef elqayedy</td>
                        <td>500</td>
                        <td>youssef elqayedy</td>
                        <td>07/26/2024</td>
                    </tr>
                    <tr>
                        <td>id4589</td>
                        <td>youssef elqayedy</td>
                        <td>500</td>
                        <td>youssef elqayedy</td>
                        <td>07/26/2024</td>
                    </tr>
                    <tr>
                        <td>id4589</td>
                        <td>youssef elqayedy</td>
                        <td>500</td>
                        <td>youssef elqayedy</td>
                        <td>07/26/2024</td>
                    </tr>

                </tbody>
            </table>
        </section>

        <section class="table rewards">
            <div class="table_head">
                <div class="title">rewards</div>
                <button>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
            </div>
            <table class="main-table">
                <thead>
                    <tr>
                        <th scope="col">creator</th>
                        <th scope="col">offer</th>
                        <th scope="col">cost</th>
                        <th scope="col">duration</th>
                        <th scope="col">react</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>ad.youssef elqayedy</td>
                        <td>batata</td>
                        <td>500</td>
                        <td>07/26/2024</td>
                        <td>5127</td>
                    </tr>
                    <tr>
                        <td>st.youssef elqayedy</td>
                        <td>batata</td>
                        <td>500</td>
                        <td>07/26/2024</td>
                        <td>5127</td>
                    </tr>
                    <tr>
                        <td>st.youssef elqayedy</td>
                        <td>batata</td>
                        <td>500</td>
                        <td>07/26/2024</td>
                        <td>5127</td>
                    </tr>
                    <tr>
                        <td>st.youssef elqayedy</td>
                        <td>batata</td>
                        <td>500</td>
                        <td>07/26/2024</td>
                        <td>5127</td>
                    </tr>
                    <tr>
                        <td>ad.youssef elqayedy</td>
                        <td>batata</td>
                        <td>500</td>
                        <td>07/26/2024</td>
                        <td>5127</td>
                    </tr>
                    <tr>
                        <td>st.youssef elqayedy</td>
                        <td>batata</td>
                        <td>500</td>
                        <td>07/26/2024</td>
                        <td>5127</td>
                    </tr>
                    <tr>
                        <td>ad.youssef elqayedy</td>
                        <td>batata</td>
                        <td>500</td>
                        <td>07/26/2024</td>
                        <td>5127</td>
                    </tr>
                    <tr>
                        <td>ad.youssef elqayedy</td>
                        <td>batata</td>
                        <td>500</td>
                        <td>07/26/2024</td>
                        <td>5127</td>
                    </tr>
                    <tr>
                        <td>st.youssef elqayedy</td>
                        <td>batata</td>
                        <td>500</td>
                        <td>07/26/2024</td>
                        <td>5127</td>
                    </tr>
                </tbody>
            </table>
        </section>
        
        <section class="table Transactions-static">
            <div class="table_head">
                <div class="title">transactions static</div>
                <button>
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
            </div>

        </section>
    </div>
@endsection
