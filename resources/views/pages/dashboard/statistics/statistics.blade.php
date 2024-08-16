@extends('dashboard')

@section('title', 'Statistiques')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('dist\css\pages\statistics\statistics.css') }}">
@endsection

@section('add-options')
    <button class="nav-btn pdf-btn">
        <i class="fa-solid fa-file-pdf"></i>
    </button>
    <form class="date">
        <button type="button" class="nav-btn date-btn">
            <i class="fa-regular fa-calendar"></i>
        </button>
        <div class="sub-list">
            <div>
                <label for="dateStart">from</label>
                <input type="date" name="dateStart" id="dateStart" value="{{ $date['dateStart'] }}" onfocus="this.showPicker();">
            </div>
            <div>
                <label for="dateEnd">to</label>
                <input type="date" name="dateEnd" id="dateEnd" value="{{ $date['dateEnd'] }}" onfocus="this.showPicker();">
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
        @foreach ($cards as $name => $card)
            @php
                if ($card['new'] === $card['before']) {
                    $p = 0;
                    $c = 'fa-minus';
                } elseif ($card['new'] > $card['before']) {
                    $p = $card['before'] === 0 ? 100 : ($card['before'] * 100) / $card['new'];
                    $c = 'fa-arrow-trend-up';
                } elseif ($card['new'] < $card['before']) {
                    $p = $card['before'] === 0 ? -100 : ($card['new'] * 100) / $card['before'];
                    $c = 'fa-arrow-trend-down';
                }
            @endphp
            <div class="outer-bg card">
                <div class="up">
                    <i class="fa-solid fa-circle-dollar-to-slot"></i>
                    <div class="number">{{ shortNumber($card['new']) }}</div>
                </div>
                <div class="down">
                    <span class="card-name">{{ $name }}</span>
                    <span class="percent">{{ number_format($p, 2) }}%
                        {{-- <span class="percent">{{ $card['new'] === $card['before'] ? 0 : ($card['new'] > $card['before'] ? ($card['before'] * 100) / $card['new'] : ($card['new'] * 100) / $card['before']) }}% --}}
                        <i class="fa-solid {{ $c }}"></i></span>
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
                        @foreach ($branchTable['columns'] as $col)
                            <th>
                                <div>{{ $col }}</div>
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($branchTable['rows'] as $row)
                        <tr>
                            @foreach ($branchTable['columns'] as $key => $col)
                                <td>
                                    <div>{{ $row->$key }}</div>
                                </td>
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
    {{-- <script src="{{ asset('dist/js/amCharts/index.js') }}"></script> --}}
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
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
        am5.ready(function() {
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

            series.bullets.push(function() {
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
                @foreach ($charts['transactions'] as $chart)
                    {
                        date: new Date('{{ $chart['created_at'] }}').getTime(),
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
                    @foreach ($charts['typeCards'] as $card)
                        {
                            typeOFCard: '{{ $card['name'] }}',
                            value: {{ $card['clientcards_count'] }},
                        },
                    @endforeach
                ]
            },
            {
                id: 'top-type-services-chart',
                data: [
                    @foreach ($charts['typeCards'] as $card)
                        {
                            typeOFCard: '{{ $card['name'] }}',
                            value: {{ $card['clientcards_count'] }},
                        },
                    @endforeach
                ]
            },
        ];

        data.forEach(obj => {
            // top-type-cards
            am5.ready(function() {

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
        am5.ready(function() {

            // Create root element
            var root = am5.Root.new("cards-chart");

            // Set themes
            root.setThemes([
                am5themes_Animated.new(root)
            ]);

            // Create chart
            var chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: true,
                panY: true,
                wheelX: "panX",
                wheelY: "zoomX",
                pinchZoomX: true,
                paddingLeft: 0,
                paddingRight: 1
            }));

            // Add cursor
            var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
            cursor.lineY.set("visible", false);

            // Function to set responsive label sizes and padding
            function setLabelConfig() {
                let labelFontSize = 12;
                let paddingBottom = 5;

                if (window.innerWidth < 768) { // Small screens
                    labelFontSize = 10;
                    paddingBottom = 3;
                } else if (window.innerWidth < 1024) { // Medium screens
                    label
                    labelFontSize = 11;
                    paddingBottom = 4;
                }

                xRenderer.labels.template.setAll({
                    rotation: 0, // Keep labels horizontal
                    textAlign: "center", // Center-align text horizontally
                    textValign: "middle", // Center-align text vertically
                    centerY: am5.p50,
                    centerX: am5.p50,
                    paddingBottom: paddingBottom, // Adjust padding as needed
                    fontSize: labelFontSize + "px" // Adjust font size based on screen size
                });
            }

            // Create axes
            var xRenderer = am5xy.AxisRendererX.new(root, {
                minGridDistance: 30,
                minorGridEnabled: true
            });

            setLabelConfig();

            xRenderer.grid.template.setAll({
                location: 1
            });

            var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                maxDeviation: 0.3,
                categoryField: "cardName",
                renderer: xRenderer,
                tooltip: am5.Tooltip.new(root, {})
            }));

            var yRenderer = am5xy.AxisRendererY.new(root, {
                strokeOpacity: 0.1
            });

            var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                maxDeviation: 0.3,
                renderer: yRenderer
            }));

            // Create series
            var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                name: "Series 1",
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "value",
                sequencedInterpolation: true,
                categoryXField: "cardName",
                tooltip: am5.Tooltip.new(root, {
                    labelText: "{valueY}"
                })
            }));

            series.columns.template.setAll({
                cornerRadiusTL: 5,
                cornerRadiusTR: 5,
                strokeOpacity: 0
            });
            series.columns.template.adapters.add("fill", function(fill, target) {
                return chart.get("colors").getIndex(series.columns.indexOf(target));
            });

            series.columns.template.adapters.add("stroke", function(stroke, target) {
                return chart.get("colors").getIndex(series.columns.indexOf(target));
            });

            // Set data
            var data = [
                @foreach ($charts['cards'] as $card)
                    {
                        cardName: '{{ $card['card_name'] }}',
                        value: {{ $card['total_points'] }}
                    },
                @endforeach
            ];

            xAxis.data.setAll(data);
            series.data.setAll(data);

            // Make stuff animate on load
            series.appear(1000);
            chart.appear(1000, 100);

            // Adjust the chart on window resize
            window.addEventListener('resize', function() {
                setLabelConfig();
                chart.appear(1000, 100); // Reapply animations if necessary
            });

        });
    </script>
@endsection
