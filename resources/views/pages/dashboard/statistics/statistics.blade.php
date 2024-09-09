@extends('dashboard')

@section('title', 'Statistiques')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist\css\pages\statistics\statistics.css') }}">
@endsection

@section('add-options')
    <button class="nav-btn pdf-btn">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M9 10H6" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
            <path d="M19 14L5 14" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
            <circle cx="17" cy="10" r="1" fill="white"/>
            <path d="M15 16.5H9" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
            <path d="M13 19H9" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
            <path
                d="M22 12C22 14.8284 22 16.2426 21.1213 17.1213C20.48 17.7626 19.5535 17.9359 18 17.9827M6 17.9827C4.44655 17.9359 3.51998 17.7626 2.87868 17.1213C2 16.2426 2 14.8284 2 12C2 9.17157 2 7.75736 2.87868 6.87868C3.75736 6 5.17157 6 8 6H16C18.8284 6 20.2426 6 21.1213 6.87868C21.4211 7.17848 21.6186 7.54062 21.7487 8"
                stroke="white" stroke-width="1.5" stroke-linecap="round"/>
            <path
                d="M17.9827 6C17.9359 4.44655 17.7626 3.51998 17.1213 2.87868C16.2426 2 14.8284 2 12 2C9.17157 2 7.75736 2 6.87868 2.87868C6.23738 3.51998 6.06413 4.44655 6.01732 6M18 15V16C18 18.8284 18 20.2426 17.1213 21.1213C16.48 21.7626 15.5535 21.9359 14 21.9827M6 15V16C6 18.8284 6 20.2426 6.87868 21.1213C7.51998 21.7626 8.44655 21.9359 10 21.9827"
                stroke="white" stroke-width="1.5" stroke-linecap="round"/>
        </svg>
    </button>
    <form class="date">
        <button type="button" class="nav-btn date-btn">
            <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M14.7715 22.1804H10.7715C7.00024 22.1804 5.11463 22.1804 3.94305 21.0088C2.77148 19.8373 2.77148 17.9516 2.77148 14.1804V12.1804C2.77148 8.40918 2.77148 6.52357 3.94305 5.35199C5.11463 4.18042 7.00024 4.18042 10.7715 4.18042H14.7715C18.5427 4.18042 20.4284 4.18042 21.5999 5.35199C22.7715 6.52357 22.7715 8.40918 22.7715 12.1804V14.1804C22.7715 17.9516 22.7715 19.8373 21.5999 21.0088C20.9467 21.662 20.0716 21.951 18.7715 22.0789"
                    stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                <path d="M7.77148 4.18042V2.68042" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                <path d="M17.7715 4.18042V2.68042" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                <path d="M22.2715 9.18042H17.3965H11.5215M2.77148 9.18042H6.64648" stroke="white" stroke-width="1.5"
                      stroke-linecap="round"/>
                <path
                    d="M18.7715 17.1804C18.7715 17.7327 18.3238 18.1804 17.7715 18.1804C17.2192 18.1804 16.7715 17.7327 16.7715 17.1804C16.7715 16.6281 17.2192 16.1804 17.7715 16.1804C18.3238 16.1804 18.7715 16.6281 18.7715 17.1804Z"
                    fill="white"/>
                <path
                    d="M18.7715 13.1804C18.7715 13.7327 18.3238 14.1804 17.7715 14.1804C17.2192 14.1804 16.7715 13.7327 16.7715 13.1804C16.7715 12.6281 17.2192 12.1804 17.7715 12.1804C18.3238 12.1804 18.7715 12.6281 18.7715 13.1804Z"
                    fill="white"/>
                <path
                    d="M13.7715 17.1804C13.7715 17.7327 13.3238 18.1804 12.7715 18.1804C12.2192 18.1804 11.7715 17.7327 11.7715 17.1804C11.7715 16.6281 12.2192 16.1804 12.7715 16.1804C13.3238 16.1804 13.7715 16.6281 13.7715 17.1804Z"
                    fill="white"/>
                <path
                    d="M13.7715 13.1804C13.7715 13.7327 13.3238 14.1804 12.7715 14.1804C12.2192 14.1804 11.7715 13.7327 11.7715 13.1804C11.7715 12.6281 12.2192 12.1804 12.7715 12.1804C13.3238 12.1804 13.7715 12.6281 13.7715 13.1804Z"
                    fill="white"/>
                <path
                    d="M8.77148 17.1804C8.77148 17.7327 8.32376 18.1804 7.77148 18.1804C7.2192 18.1804 6.77148 17.7327 6.77148 17.1804C6.77148 16.6281 7.2192 16.1804 7.77148 16.1804C8.32376 16.1804 8.77148 16.6281 8.77148 17.1804Z"
                    fill="white"/>
                <path
                    d="M8.77148 13.1804C8.77148 13.7327 8.32376 14.1804 7.77148 14.1804C7.2192 14.1804 6.77148 13.7327 6.77148 13.1804C6.77148 12.6281 7.2192 12.1804 7.77148 12.1804C8.32376 12.1804 8.77148 12.6281 8.77148 13.1804Z"
                    fill="white"/>
            </svg>

        </button>
        <div class="sub-list">
            <div>
                <label for="dateStart">from</label>
                <input type="date" name="dateStart" id="dateStart" value="{{ $date['dateStart'] }}"
                       onfocus="this.showPicker();">
            </div>
            <div>
                <label for="dateEnd">to</label>
                <input type="date" name="dateEnd" id="dateEnd" value="{{ $date['dateEnd'] }}"
                       onfocus="this.showPicker();">
            </div>
            <button type="submit"><i class="fa-solid fa-angle-right"></i></button>
        </div>
    </form>
@endsection

@section('content')
    @php
        if (!function_exists('shortNumber')) {
            function shortNumber($number, $precision = 1)
            {
                if ($number < 1000) {
                    return $number;
                }

                $units = ['', 'K', 'M', 'B', 'T'];
                $power = floor(log($number, 1000));
                $shortNumber = $number / pow(1000, $power);

                return round($shortNumber, $precision) . $units[$power];
            }
        }

    @endphp

    <div class="result-cards">
        @php
            $svgs = [
                'clients' => '<svg width="24" height="24" viewBox="0 0 37 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.5 15C18.8137 15 21.5 12.3137 21.5 9C21.5 5.68629 18.8137 3 15.5 3C12.1863 3 9.5 5.68629 9.5 9C9.5 12.3137 12.1863 15 15.5 15Z" stroke="#1C274C" stroke-width="1.5"/>
                                    <path d="M32 15H29M29 15H26M29 15V12M29 15V18" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M27.4962 27C27.5 26.7537 27.5 26.5035 27.5 26.25C27.5 22.522 22.1275 19.5 15.5 19.5C8.87258 19.5 3.5 22.522 3.5 26.25C3.5 29.978 3.5 33 15.5 33C18.8465 33 21.2597 32.765 23 32.3451" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>',
                'cards' => '<svg width="24" height="24" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M33 18C33 12.3431 33 9.51472 31.2426 7.75735C29.4853 6 26.6568 6 21 6H15C9.34314 6 6.51473 6 4.75736 7.75735C3 9.51472 3 12.3431 3 18C3 23.6568 3 26.4853 4.75736 28.2426C6.51473 30 9.34314 30 15 30H21C26.6568 30 29.4853 30 31.2426 28.2426C32.2224 27.2628 32.6559 25.9501 32.8478 24" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                                <path d="M15 24H9" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                                <path d="M21 24H18.75" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                                <path d="M3 15H10.5M33 15H16.5" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>',
                'transactions' => '<svg width="24" height="24" viewBox="0 0 37 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.75 18C20.75 19.2426 19.7426 20.25 18.5 20.25C17.2574 20.25 16.25 19.2426 16.25 18C16.25 16.7574 17.2574 15.75 18.5 15.75C19.7426 15.75 20.75 16.7574 20.75 18Z" fill="#1C274C"/>
                                        <path d="M18.5 18V12" stroke="#1C274C" stroke-width="1.5"/>
                                        <path d="M18.5 18L23.75 20.25" stroke="#1C274C" stroke-width="1.5"/>
                                        <path d="M18.5 18L13.25 20.25" stroke="#1C274C" stroke-width="1.5"/>
                                        <path d="M7.25 10.5V15" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                                        <path d="M7.25 21V25.5" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                                        <path d="M33.5 18C33.5 25.071 33.5 28.6066 31.3032 30.8032C29.1066 33 25.571 33 18.5 33C11.4289 33 7.89339 33 5.6967 30.8032C3.5 28.6066 3.5 25.071 3.5 18C3.5 10.9289 3.5 7.39339 5.6967 5.1967C7.89339 3 11.4289 3 18.5 3C25.571 3 29.1066 3 31.3032 5.1967C32.7639 6.65731 33.2534 8.70983 33.4174 12" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                                        <path d="M18.5 7.5C13.5503 7.5 11.0754 7.5 9.53769 9.03769C8 10.5754 8 13.0503 8 18C8 22.9497 8 25.4245 9.53769 26.9623C11.0754 28.5 13.5503 28.5 18.5 28.5C23.4497 28.5 25.9245 28.5 27.4623 26.9623C29 25.4245 29 22.9497 29 18C29 13.0503 29 10.5754 27.4623 9.03769C26.4399 8.01526 25.0031 7.67266 22.7 7.55785" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                                        <path d="M15.5 12.8027C16.3824 12.2922 17.4071 12 18.5 12C21.8137 12 24.5 14.6863 24.5 18C24.5 21.3137 21.8137 24 18.5 24C15.1863 24 12.5 21.3137 12.5 18C12.5 17.4821 12.5656 16.9794 12.689 16.5" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                                    </svg>',
                'services' => '<svg width="24" height="24" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M31.5 9V5.25778C31.5 4.38294 30.4664 3.91876 29.8125 4.49998C28.8501 5.35543 27.3999 5.35543 26.4375 4.49998C25.4751 3.64453 24.0249 3.64453 23.0625 4.49998C22.1001 5.35543 20.6499 5.35543 19.6875 4.49998C18.7251 3.64453 17.2749 3.64453 16.3125 4.49998C15.3501 5.35543 13.8999 5.35543 12.9375 4.49998C11.9751 3.64453 10.5249 3.64453 9.5625 4.49998C8.60012 5.35543 7.14988 5.35543 6.1875 4.49998C5.53364 3.91876 4.5 4.38294 4.5 5.25778V21M31.5 15V30.7425C31.5 31.6173 30.4664 32.0814 29.8125 31.5003C28.8501 30.6448 27.3999 30.6448 26.4375 31.5003C25.4751 32.3557 24.0249 32.3557 23.0625 31.5003C22.1001 30.6448 20.6499 30.6448 19.6875 31.5003C18.7251 32.3557 17.2749 32.3557 16.3125 31.5003C15.3501 30.6448 13.8999 30.6448 12.9375 31.5003C11.9751 32.3557 10.5249 32.3557 9.5625 31.5003C8.60012 30.6448 7.14988 30.6448 6.1875 31.5003C5.53364 32.0814 4.5 31.6173 4.5 30.7425V27" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M11.25 23.25H17.25M24.75 23.25H21.75" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M24.75 18H18.75M11.25 18H14.25" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M11.25 12.75H24.75" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>',
            ];
        @endphp
        @foreach ($data['cards'] as $name => $card)
            @php
                if ($card['now'] === $card['before']) {
                    $p = 0;
                    $c = 'fa-minus';
                } elseif ($card['now'] > $card['before']) {
                    $p = $card['before'] === 0 ? 100 : ($card['before'] * 100) / $card['now'];
                    $c = 'fa-arrow-trend-up';
                } elseif ($card['now'] < $card['before']) {
                    $p = $card['before'] === 0 ? -100 : ($card['now'] * 100) / $card['before'];
                    $c = 'fa-arrow-trend-down';
                }
            @endphp
            <div class="outer-bg card">
                <div class="up">
                    <i>@php echo $svgs[$name] ?? '' @endphp</i>
                    <div class="number">{{ shortNumber($card['now']) }}</div>
                </div>
                <div class="down">
                    <span class="card-name">{{ $name }}</span>
                    <span class="percent">{{ number_format($p, 2) }}%<i class="fa-solid {{ $c }}"></i></span>
                </div>
            </div>
        @endforeach
    </div>

    <div class="outer-bg transactions">
        <div class="head">
            <span>transactions</span>
        </div>
        <div id="transactions-chart" class="body"></div>
    </div>
    <div class="outer-bg top-type-cards">
        <div class="head">
            <span>top type cards</span>
        </div>
        <div id="top-type-cards-chart" class="body"></div>
    </div>
    <div class="outer-bg cards">
        <div class="head">
            <span>cards</span>
        </div>
        <div id="cards-chart" class="body"></div>
    </div>
    <div class="outer-bg top-type-services">
        <div class="head">
            <span>top type services</span>
        </div>
        <div id="top-type-services-chart" class="body"></div>
    </div>
    <div class="outer-bg top-branches">
        <div class="head">
            <span>top branches</span>
        </div>
        <div class="main-table body">
            <table>
                <thead>
                <tr>
                    <th class="fit-width">
                        <div>#</div>
                    </th>
                    @foreach ($data['charts']['agencies']['columns'] as $db_col => $arr)
                        @if(!empty($arr))
                            <th {{ !empty($arr['th_class']) ? "class={$arr['th_class']}" : '' }}>
                                <div>{{ $arr['text'] }}</div>
                            </th>
                        @endif
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @foreach ($data['charts']['agencies']['rows'] as $index => $item)
                    <tr>
                        <td>
                            <div>{{ $index + 1 }}</div>
                        </td>
                        @foreach ($data['charts']['agencies']['columns'] as $db_col => $arr)
                            @if(!empty($arr))
                                <td>
                                    <div>{{ $item->$db_col }}</div>
                                </td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <!-- Resources -->
    <script src="{{ asset('dist/js/amCharts/index.js') }}"></script>
    <script src="{{ asset('dist/js/amCharts/xy.js') }}"></script>
    <script src="{{ asset('dist/js/amCharts/percent.js') }}"></script>
    <script src="{{ asset('dist/js/amCharts/Animated.js') }}"></script>

    <!-- Chart code -->
    <script>
        function getRandomColorHexCode() {
            // Generate a random number between 0x000000 and 0xFFFFFF
            const randomColor = Math.floor(Math.random() * 0xFFFFFF);

            // Return the number in the 0x format
            return randomColor;
        }

        // transactions
        am5.ready(function () {
            var root = am5.Root.new("transactions-chart");

            root.setThemes([
                am5themes_Animated.new(root)
            ]);

            var chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: true,
                panY: true,
                wheelX: "panX",
                wheelY: "zoomX",
                pinchZoomX: true,
                paddingLeft: 0
            }));

            var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
                behavior: "none"
            }));

            cursor.lineY.set("visible", false);

            var date = new Date();

            date.setHours(0, 0, 0, 0);

            var value = 200;

            function generateData() {
                value = Math.round((Math.random() * 10 - 5) + value);
                am5.time.add(date, "day", 1);
                return {
                    date: date.getTime(),
                    value: value
                };
            }

            var xAxis = chart.xAxes.push(am5xy.DateAxis.new(root, {
                maxDeviation: 0.5,
                baseInterval: {
                    timeUnit: "day",
                    count: 1
                },
                renderer: am5xy.AxisRendererX.new(root, {
                    minGridDistance: 80,
                    minorGridEnabled: true,
                    pan: "zoom"
                }),
                tooltip: am5.Tooltip.new(root, {})
            }));

            var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                maxDeviation: 1,
                renderer: am5xy.AxisRendererY.new(root, {
                    pan: "zoom"
                })
            }));
            var series = chart.series.push(am5xy.SmoothedXLineSeries.new(root, {
                name: "Series",
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "value",
                valueXField: "date",
                tooltip: am5.Tooltip.new(root, {
                    labelText: "{valueY}"
                })
            }));

            series.fills.template.setAll({
                visible: true,
                fillOpacity: 0.2
            });

            series.bullets.push(function () {
                return am5.Bullet.new(root, {
                    locationY: 0,
                    sprite: am5.Circle.new(root, {
                        radius: 4,
                        stroke: root.interfaceColors.get("background"),
                        strokeWidth: 2,
                        fill: series.get("fill")
                    })
                });
            });

            series.data.setAll([
                    @foreach ($data['charts']['transactions'] as $chart)
                {
                    date: new Date('{{ $chart['date'] }}').getTime(),
                    value: {{ $chart['points'] }}
                },
                @endforeach
            ]);

            series.appear(1000);
            chart.appear(1000, 100);

        });

        // top-type-cards, top-type-services
        const data = [{
            id: 'top-type-cards-chart',
            data: [
                    @foreach ($data['charts']['type_of_cards'] as $card)
                {
                    typeOFCard: '{{ $card['name'] }}',
                    value: {{ $card['cards_count'] }},
                },
                @endforeach
            ]
        },
        ];

        data.forEach(obj => {
            // top-type-cards
            am5.ready(function () {

                // Create root element
                var root = am5.Root.new(obj.id);

                // Set themes
                root.setThemes([
                    am5themes_Animated.new(root)
                ]);

                // Create chart
                var chart = root.container.children.push(am5percent.PieChart.new(root, {
                    layout: root.horizontalLayout, // Change layout to horizontal
                    innerRadius: am5.percent(50)
                }));

                // Create series
                var series = chart.series.push(am5percent.PieSeries.new(root, {
                    valueField: "value",
                    categoryField: "typeOFCard",
                    alignLabels: false
                }));

                // Disable tooltips for slices
                series.slices.template.setAll({
                    tooltipText: ""
                });

                // Hide labels on slices
                series.labels.template.setAll({
                    text: "", // No text on the slices
                    textType: "circular",
                    centerX: 0,
                    centerY: 0
                });

                // Hide ticks
                series.ticks.template.setAll({
                    disabled: true // Hides the ticks
                });

                // Disable tooltips for legend items
                var legend = chart.children.push(am5.Legend.new(root, {
                    centerY: am5.percent(50),
                    y: am5.percent(50),
                    layout: root.verticalLayout // Align legend items vertically
                }));

                // Remove tooltips from legend items
                legend.labels.template.setAll({
                    tooltipText: "" // Disable tooltips for legend labels
                });

                // Remove legend labels text if not needed
                legend.labels.template.setAll({
                    text: "" // Hide text in the legend if not needed
                });

                // Set colors for slices based on the data
                series.get("colors").set("colors", obj.data.map(e => am5.color(getRandomColorHexCode())));

                // Set data
                series.data.setAll(obj.data);

                // Create legend and position it beside the chart
                legend.data.setAll(series.dataItems);

                // Play initial series animation
                series.appear(1000, 100);

            });

        });


        // cards
        am5.ready(function () {

            // Create root element
            const root = am5.Root.new("cards-chart");

            // Set themes
            root.setThemes([am5themes_Animated.new(root)]);

            // Create chart
            const chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: true,
                panY: true,
                wheelX: "panX",
                wheelY: "zoomX",
                pinchZoomX: true,
                paddingLeft: 0,
                paddingRight: 1
            }));

            // Add cursor
            const cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
            cursor.lineY.set("visible", false);

            // Function to set responsive label sizes and padding
            const setLabelConfig = () => {
                let labelFontSize = 12;
                let paddingBottom = 5;

                if (window.innerWidth < 768) { // Small screens
                    labelFontSize = 10;
                    paddingBottom = 3;
                } else if (window.innerWidth < 1024) { // Medium screens
                    labelFontSize = 11;
                    paddingBottom = 4;
                }

                xRenderer.labels.template.setAll({
                    rotation: 0, // Keep labels horizontal
                    textAlign: "center", // Center-align text horizontally
                    textValign: "middle", // Center-align text vertically
                    centerY: am5.p50,
                    centerX: am5.p50,
                    paddingBottom, // Adjust padding as needed
                    fontSize: `${labelFontSize}px` // Adjust font size based on screen size
                });
            };

            // Create axes
            const xRenderer = am5xy.AxisRendererX.new(root, {minGridDistance: 30, minorGridEnabled: true});
            setLabelConfig();
            xRenderer.grid.template.setAll({location: 1});

            const xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                maxDeviation: 0.3,
                categoryField: "cardName",
                renderer: xRenderer,
                tooltip: am5.Tooltip.new(root, {})
            }));

            const yRenderer = am5xy.AxisRendererY.new(root, {strokeOpacity: 0.1});

            const yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                maxDeviation: 0.3,
                renderer: yRenderer
            }));

            // Create series
            const series = chart.series.push(am5xy.ColumnSeries.new(root, {
                name: "Series 1",
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "value",
                sequencedInterpolation: true,
                categoryXField: "cardName",
                tooltip: am5.Tooltip.new(root, {labelText: "{valueY}"})
            }));

            series.columns.template.setAll({
                cornerRadiusTL: 5,
                cornerRadiusTR: 5,
                strokeOpacity: 0
            });

            series.columns.template.adapters.add("fill", (fill, target) => {
                return chart.get("colors").getIndex(series.columns.indexOf(target));
            });

            series.columns.template.adapters.add("stroke", (stroke, target) => {
                return chart.get("colors").getIndex(series.columns.indexOf(target));
            });

            // Set data (replace PHP section with actual data for JavaScript use)
            const data = [
                    @foreach($data['charts']['cards'] as $card)
                {
                    "cardName": "{{ $card->card_name }}",
                    "value": {{ (integer)($card->total_points ?? 0) }},
                },
                @endforeach
            ];

            xAxis.data.setAll(data);
            series.data.setAll(data);

            // Make stuff animate on load
            series.appear(1000);
            chart.appear(1000, 100);

            // Adjust the chart on window resize
            window.addEventListener('resize', () => {
                setLabelConfig();
                chart.appear(1000, 100); // Reapply animations if necessary
            });

        });

    </script>
@endsection
