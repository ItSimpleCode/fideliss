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
    <div class="result-cards">
        <div class="outer-bg card">
            <div class="up">
                <i class="fa-solid fa-circle-dollar-to-slot"></i>
                <div class="number">{{ rand(0, 999) }}k</div>
            </div>
            <div class="down">
                <span class="card-name">clients</span>
                <span class="percent">{{ rand(0, 100) }}% <i class="fa-solid fa-arrow-trend-{{ rand(0, 1) ? 'up' : 'down' }}"></i></span>
            </div>
        </div>
        <div class="outer-bg card">
            <div class="up">
                <i class="fa-solid fa-circle-dollar-to-slot"></i>
                <div class="number">{{ rand(0, 999) }}k</div>
            </div>
            <div class="down">
                <span class="card-name">cards</span>
                <span class="percent">{{ rand(0, 100) }}% <i class="fa-solid fa-arrow-trend-{{ rand(0, 1) ? 'up' : 'down' }}"></i></span>
            </div>
        </div>
        <div class="outer-bg card">
            <div class="up">
                <i class="fa-solid fa-circle-dollar-to-slot"></i>
                <div class="number">{{ rand(0, 999) }}k</div>
            </div>
            <div class="down">
                <span class="card-name">transactions</span>
                <span class="percent">{{ rand(0, 100) }}% <i class="fa-solid fa-arrow-trend-{{ rand(0, 1) ? 'up' : 'down' }}"></i></span>
            </div>
        </div>
        <div class="outer-bg card">
            <div class="up">
                <i class="fa-solid fa-circle-dollar-to-slot"></i>
                <div class="number">{{ rand(0, 999) }}k</div>
            </div>
            <div class="down">
                <span class="card-name">services react</span>
                <span class="percent">{{ rand(0, 100) }}% <i class="fa-solid fa-arrow-trend-{{ rand(0, 1) ? 'up' : 'down' }}"></i></span>
            </div>
        </div>
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
                        <th>
                            <div>créateur</div>
                        </th>
                        <th>
                            <div>offre</div>
                        </th>
                        <th>
                            <div>coût</div>
                        </th>
                        <th>
                            <div>durée</div>
                        </th>
                        <th>
                            <div>réaction</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 15; $i++)
                        <tr>
                            <td>
                                <div>ad.youssef elqayedy</div>
                            </td>
                            <td>
                                <div>batata</div>
                            </td>
                            <td>
                                <div>500</div>
                            </td>
                            <td>
                                <div>26/07/2024</div>
                            </td>
                            <td>
                                <div>5127</div>
                            </td>
                        </tr>
                    @endfor
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

            function generateDatas(count) {
                var data = [];
                for (var i = 0; i < count; ++i) {
                    data.push(generateData());
                }
                return data;
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

            var data = generateDatas(12);
            series.data.setAll(data);

            series.appear(1000);
            chart.appear(1000, 100);

        });

        // top-type-cards, top-type-services
        const data = [{
                id: 'top-type-cards-chart',
                data: [{
                        value: 3,
                        typeOFCard: "Visa"
                    },
                    {
                        value: 5,
                        typeOFCard: "MasterCard"
                    },
                    {
                        value: 2,
                        typeOFCard: "American Express"
                    },
                    {
                        value: 6,
                        typeOFCard: "Discover"
                    },
                ]
            },
            {
                id: 'top-type-services-chart',
                data: [{
                        value: 3,
                        typeOFCard: "Visa"
                    },
                    {
                        value: 5,
                        typeOFCard: "MasterCard"
                    },
                    {
                        value: 2,
                        typeOFCard: "American Express"
                    },
                    {
                        value: 6,
                        typeOFCard: "Discover"
                    },
                ]
            }
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

                // Show only the category names in the labels
                series.labels.template.setAll({
                    text: "{category}", // Displays only the category names
                    textType: "circular",
                    centerX: 0,
                    centerY: 0
                });

                // Remove the ticks if needed
                series.ticks.template.setAll({
                    disabled: true // Hides the ticks which might be used for displaying additional info
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

                series.labels.template.setAll({
                    textType: "circular",
                    centerX: 0,
                    centerY: 0
                });

                console.log(getRandomColorHexCode());

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
            // https://www.amcharts.com/docs/v5/getting-started/#Root_element
            var root = am5.Root.new("cards-chart");

            // Set themes
            // https://www.amcharts.com/docs/v5/concepts/themes/
            root.setThemes([
                am5themes_Animated.new(root)
            ]);

            // Create chart
            // https://www.amcharts.com/docs/v5/charts/xy-chart/
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
            // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
            var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
            cursor.lineY.set("visible", false);

            // Create axes
            // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
            var xRenderer = am5xy.AxisRendererX.new(root, {
                minGridDistance: 30,
                minorGridEnabled: true
            });

            xRenderer.labels.template.setAll({
                rotation: 0, // Make labels horizontal
                textAlign: "center", // Center-align text horizontally
                textValign: "middle", // Center-align text vertically
                centerY: am5.p50,
                centerX: am5.p50, // Center X-axis labels
                paddingRight: 15
            });

            xRenderer.grid.template.setAll({
                location: 1
            })

            var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                maxDeviation: 0.3,
                categoryField: "cardName", // Updated field name
                renderer: xRenderer,
                tooltip: am5.Tooltip.new(root, {})
            }));

            var yRenderer = am5xy.AxisRendererY.new(root, {
                strokeOpacity: 0.1
            })

            var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                maxDeviation: 0.3,
                renderer: yRenderer
            }));

            // Create series
            // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
            var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                name: "Series 1",
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "value",
                sequencedInterpolation: true,
                categoryXField: "cardName", // Updated field name
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

            const rand = () => Math.random() * 1000;

            // Set data
            var data = [{
                cardName: "Visa",
                value: rand()
            }, {
                cardName: "MasterCard",
                value: rand()
            }, {
                cardName: "American Express",
                value: rand()
            }, {
                cardName: "Discover",
                value: rand()
            }, {
                cardName: "Diners Club",
                value: rand()
            }];

            xAxis.data.setAll(data);
            series.data.setAll(data);

            // Make stuff animate on load
            // https://www.amcharts.com/docs/v5/concepts/animations/
            series.appear(1000);
            chart.appear(1000, 100);

        }); // end am5.ready()
    </script>
@endsection
