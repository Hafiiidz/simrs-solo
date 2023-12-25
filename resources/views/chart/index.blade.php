@extends('layouts.index')
@section('css')
@endsection
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
                <!--begin::Toolbar wrapper-->
                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                    <!--begin::Page title-->
                    <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">
                            Dashboard</h1>
                        <!--end::Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">
                                <a href="#" class="text-muted text-hover-primary">Menu</a>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">Dashboard</li>
                            <!--end::Item-->
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page title-->
                </div>
                <!--end::Toolbar wrapper-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="d-flex flex-wrap flex-stack mb-6" data-select2-id="select2-data-136-zz50">
                    <!--begin::Title-->
                    <h3 class="fw-bold my-2">
                        Tes Chart
                    </h3>
                    <!--end::Title-->
                </div>
                <div class="row g-6 g-xl-9">
                    <div>
                        <figure class="highcharts-figure">
                            <div id="container"></div>
                            <p class="highcharts-description">
                                Chart demonstrating more advanced accessibility configuration, using
                                a custom series type based on the boxplot series.
                                The chart is depicting monthly earnings for people with higher education
                                during part-time employment. The level of education the numbers represent are,
                                <b>first and second stage of tertiary education, graduate and postgraduate level</b>.
                                <br>* Missing numbers are not published in order to avoid identifying persons or
                                companies (SSB).
                            </p>
                        </figure>
                    </div>
                </div>
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
@endsection
@section('js')
    <script>
        // Define custom series type for displaying low/med/high values using boxplot as a base
        Highcharts.seriesType('lowmedhigh', 'boxplot', {
            keys: ['low', 'high'],
            tooltip: {
                pointFormat: '<span style="color:{point.color}">\u25CF</span> {series.name}: ' +
                    'Low <b>{point.low}  NOK</b> - High <b>{point.high} NOK</b><br/>'
            }
        }, {
            // Change point shape to a line with three crossing lines for low/median/high
            // Stroke width is hardcoded to 1 for simplicity
            drawPoints: function() {
                const series = this;
                this.points.forEach(function(point) {
                    let graphic = point.graphic;
                    const verb = graphic ? 'animate' : 'attr',
                        shapeArgs = point.shapeArgs,
                        width = shapeArgs.width,
                        left = Math.floor(shapeArgs.x) + 0.5,
                        right = left + width,
                        crispX = left + Math.round(width / 2) + 0.5,
                        highPlot = Math.floor(point.highPlot) + 0.5,
                        // medianPlot = Math.floor(point.medianPlot) + 0.5,
                        // Sneakily draw low marker even if 0
                        lowPlot = Math.floor(point.lowPlot) +
                        0.5 - (point.low === 0 ? 0 : 0);

                    if (point.isNull) {
                        return;
                    }

                    if (!graphic) {
                        point.graphic = graphic = series.chart.renderer
                            .path('point')
                            .add(series.group);
                    }

                    graphic.attr({
                        stroke: point.color || series.color,
                        'stroke-width': 2
                    });

                    graphic[verb]({
                        d: [
                            'M', left, highPlot,
                            'H', right,
                            // 'M', left, medianPlot,
                            // 'H', right,
                            'M', left, lowPlot,
                            'H', right,
                            'M', crispX, highPlot,
                            'V', lowPlot
                        ]
                    });
                });
            }
        });

        // Create chart
        const chart = Highcharts.chart('container', {
            chart: {
                type: 'lowmedhigh'
            },
            title: {
                text: 'Monthly earnings, by level of education in Norway',
                align: 'left'
            },
            subtitle: {
                text: 'Source: ' +
                    '<a href="https://www.ssb.no/en/statbank/table/11420/" target="_blank">SSB</a>',
                align: 'left'
            },
            accessibility: {
                point: {
                    descriptionFormat: '{#unless isNull}{category}, low {low}, high {high}{/unless}'
                },
                series: {
                    descriptionFormat: '{series.name}, series {seriesNumber} of {chart.series.length} with {series.points.length} data points.'
                },
                typeDescription: 'Low, median, high. Each data point has a low, high value, depicted vertically as small ticks.' // Describe the chart type to screen reader users, since this is not a traditional boxplot chart
            },
            xAxis: [{
                    accessibility: {
                        description: ''
                    },
                    gridLineWidth: 1,
                    labels: {
                        enabled: false
                    },
                    tickPositions: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15,
                        16, 17, 18, 19, 20, 21, 22, 23
                    ],
                },
                {
                    accessibility: {
                        description: 'Year2'
                    },
                    linkedTo: 0,
                    opposite: true,
                    crosshair: false,
                    categories: ["01:00", "02:00", "03:00", "04:00", "05:00", "06:00", "07:00",
                        "08:00", "09:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00",
                        "16:00", "17:00", "18:00", "19:00", "20:00", "21:00", "22:00", "23:00", "24:00"
                    ],
                    tickPositions: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15,
                        16, 17, 18, 19, 20, 21, 22, 23
                    ],
                },

            ],
            yAxis: [{
                title: {
                    text: 'Monthly earnings (NOK)'
                },
                gridLineWidth: 1,
                tickPositions: [60, 70, 80, 90, 100, 110, 120, 130, 140, 150, 160, 170]
            }],
            tooltip: {
                shared: true,
                stickOnContact: true
            },
            plotOptions: {
                series: {
                    stickyTracking: true,
                    whiskerWidth: 1
                }
            },
            series: [{
                    name: 'Tekanan Darah',
                    data: [
                        [120, 80],
                        [0, 0],
                        [160, 110],
                        [0, 0],
                        [0, 0],
                        [0, 0],
                        [0, 0],
                        [0, 0],
                        [0, 0],
                        [0, 0],
                        [0, 0],
                        [0, 0],
                        [0, 0],
                        [0, 0],
                        [0, 0],
                        [0, 0],
                        [0, 0],
                        [0, 0],
                        [0, 0],
                        [0, 0],
                        [0, 0],
                        [0, 0],
                        [0, 0],
                        [0, 0],
                    ]
                },
                {
                    name: 'Nadi',
                    type: 'spline',
                    data: [
                        [1,60],
                        [3,70],
                        [5,80],
                    ],
                    tooltip: {
                        valueSuffix: ' °C'
                    }
                }

            ],

        });

        // Remove click events on container to avoid having "clickable" announced by AT
        // These events are needed for custom click events, drag to zoom, and navigator
        // support.
        chart.container.onmousedown = null;
        chart.container.onclick = null;
    </script>
@endsection
