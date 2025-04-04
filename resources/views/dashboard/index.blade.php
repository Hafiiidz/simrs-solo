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
                {{-- <div class="d-flex flex-wrap flex-stack mb-6" data-select2-id="select2-data-136-zz50">
                <!--begin::Title-->
                <h3 class="fw-bold my-2">
                    Ketersediaan Tempat Tidur
                </h3>
                <!--end::Title-->
            </div>
            <div class="row g-6 g-xl-9">
                @foreach ($ruangan as $val)
                    <div class="col-sm-6 col-xl-3">
                        <!--begin::Card-->
                        <div class="card shadow h-100" style="background-image:url('{{ asset('assets/media/patterns/vektor-2.png') }}');background-size: cover; ">
                            <!--begin::Card header-->
                            <div class="card-header flex-nowrap border-0 pt-9">
                                <!--begin::Card title-->
                                <div class="card-title m-0">
                                    <!--begin::Icon-->
                                    <div class="symbol me-5">
                                        <i class="fa-solid fa-bed fs-4"></i>
                                    </div>
                                    <!--end::Icon-->

                                    <!--begin::Title-->
                                    
                                    <a href="#" class="fs-4 fw-semibold text-hover-primary text-gray-600 m-0">
                                        {{ $val->nama_ruangan }} <br> ( {{ $val->bed_count }} BED )
                                    </a>
                                    <!--end::Title-->
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body d-flex flex-column px-9 pt-6 pb-8">
                                <!--begin::Heading-->
                                <div class="fs-2x fw-bold mb-3">
                                    {{ $val->bed_kosong_count }} KOSONG
                                </div>
                                <!--end::Heading-->
                                <!--begin::Stats-->
                                <div class="d-flex align-items-center flex-wrap mb-5 mt-auto fs-6">
                                    <i class="ki-outline ki-Up-right fs-3 me-1 text-danger"></i>
                                    <!--begin::Label-->
                                    <div class="fw-semibold text-gray-500">
                                        {{ $val->kelas->kelas }}
                                    </div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                @endforeach
            </div> --}}

                <div class="card ">
                    <div class="card-header card-header-stretch">
                        <h3 class="card-title">Dashboard</h3>
                        <div class="card-toolbar">
                            <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_7">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_8">Statistik</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_9">Ketersediaan Tempat
                                        Tidur</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="kt_tab_pane_7" role="tabpanel">
                                <div class="alert alert-dismissible bg-success d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                                    <!--begin::Icon-->
                                    <i class="ki-duotone ki-pencil fs-2hx text-light me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span></i>                    <!--end::Icon-->
                
                                    <!--begin::Content-->
                                    <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                                        <h4 class="mb-2 text-light">Selamat Datang</h4>
                                        <span>Selamat datang di Parakarta e-Clinic. Semoga hari Anda menyenangkan!</span>
                                    </div>
                                    <!--end::Content-->
                
                                    <!--begin::Close-->
                                    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                                        <i class="ki-duotone ki-cross fs-2x text-light"><span class="path1"></span><span class="path2"></span></i>                    </button>
                                    <!--end::Close-->
                                </div>
                            </div>

                            <div class="tab-pane fade" id="kt_tab_pane_8" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <figure class="highcharts-figure">
                                                    <div id="kunjungan"></div>
                                                    <p class="highcharts-description">

                                                    </p>
                                                </figure>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <figure class="highcharts-figure">
                                                    <div id="usia"></div>
                                                    <p class="highcharts-description">

                                                    </p>
                                                </figure>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <figure class="highcharts-figure">
                                                    <div id="container"></div>
                                                    <p class="highcharts-description">
                                                        
                                                    </p>
                                                </figure>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="kt_tab_pane_9" role="tabpanel">
                                <div class="row g-6 g-xl-9">
                                    @foreach ($ruangan as $val)
                                        <div class="col-sm-6 col-xl-3">
                                            <!--begin::Card-->
                                            <div class="card shadow h-100"
                                                style="background-image:url('{{ asset('assets/media/patterns/vektor-2.png') }}');background-size: cover; ">
                                                <!--begin::Card header-->
                                                <div class="card-header flex-nowrap border-0 pt-9">
                                                    <!--begin::Card title-->
                                                    <div class="card-title m-0">
                                                        <!--begin::Icon-->
                                                        <div class="symbol me-5">
                                                            <i class="fa-solid fa-bed fs-4"></i>
                                                        </div>
                                                        <!--end::Icon-->

                                                        <!--begin::Title-->

                                                        <a href="#"
                                                            class="fs-4 fw-semibold text-hover-primary text-gray-600 m-0">
                                                            {{ $val->nama_ruangan }} <br> ( {{ $val->bed_count }} BED )
                                                        </a>
                                                        <!--end::Title-->
                                                    </div>
                                                    <!--end::Card title-->
                                                </div>
                                                <!--end::Card header-->

                                                <!--begin::Card body-->
                                                <div class="card-body d-flex flex-column px-9 pt-6 pb-8">
                                                    <!--begin::Heading-->
                                                    <div class="fs-2x fw-bold mb-3">
                                                        {{ $val->bed_kosong_count }} KOSONG
                                                    </div>
                                                    <!--end::Heading-->
                                                    <!--begin::Stats-->
                                                    <div class="d-flex align-items-center flex-wrap mb-5 mt-auto fs-6">
                                                        <i class="ki-outline ki-Up-right fs-3 me-1 text-danger"></i>
                                                        <!--begin::Label-->
                                                        <div class="fw-semibold text-gray-500">
                                                            {{ $val->kelas->kelas }}
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <!--end::Stats-->
                                                </div>
                                                <!--end::Card body-->
                                            </div>
                                            <!--end::Card-->
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/highcart/highcharts.js') }}"></script>
    <script src="{{ asset('assets/js/highcart/exporting.js') }}"></script>
    <script src="{{ asset('assets/js/highcart/export-data.js') }}"></script>
    <script src="{{ asset('assets/js/highcart/accessibility.js') }}"></script>


    <script>
        Highcharts.chart('container', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: '10 Penyakit Terbanyak'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'ICDX',
                colorByPoint: true,
                data: [{
                    name: 'Diabetes mellitus (E10-E14)',
                    y: 15.0,
                    sliced: true,
                    selected: true
                }, {
                    name: 'Ischemic heart disease (I20-I25)',
                    y: 10.3
                }, {
                    name: 'Stroke (I60-I69)',
                    y: 6.2
                }, {
                    name: 'Chronic obstructive pulmonary disease (J44)',
                    y: 5.8
                }, {
                    name: 'Lower respiratory infections (J20-J22)',
                    y: 4.6
                }, {
                    name: 'Neonatal conditions (P00-P96)',
                    y: 3.8
                }, {
                    name: 'Trachea, bronchus, lung cancers (C33-C34)',
                    y: 3.6
                }, {
                    name: 'Alzheimer disease and other dementias (G30)',
                    y: 3.3
                }, {
                    name: 'Diarrhoeal diseases (A09)',
                    y: 3.2
                }, {
                    name: 'Diabetes mellitus (E10-E14)',
                    y: 2.8
                }]
            }]
        });
    </script>
    <script>
        Highcharts.chart('kunjungan', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Statistik Kunjungan Poli'
            },
            subtitle: {
                text: 'Kunjungan Poli Tahun 2021 - 2023'
            },
            xAxis: {
                categories: ['KIA', 'Poli Gigi', 'Poli Umum', 'Konsultasi Online'],
                title: {
                    text: null
                },
                gridLineWidth: 1,
                lineWidth: 0
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Population (millions)',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                },
                gridLineWidth: 0
            },
            tooltip: {
                valueSuffix: ' millions'
            },
            plotOptions: {
                bar: {
                    borderRadius: '50%',
                    dataLabels: {
                        enabled: true
                    },
                    groupPadding: 0.1
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 80,
                floating: true,
                borderWidth: 1,
                backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Tahun 2021',
                data: [632, 727, 3202, 721]
            }, {
                name: 'Tahun 2022',
                data: [814, 841, 3714, 726]
            }, {
                name: 'Tahun 2023',
                data: [1393, 1031, 4695, 745]
            }]
        });
    </script>
    <script>
        // Custom template helper
        Highcharts.Templating.helpers.abs = value => Math.abs(value);

        // Age categories
        const categories = [
            '0-4', '5-9', '10-14', '15-19', '20-24', '25-29', '30-34', '35-40', '40-45',
            '45-49', '50-54', '55-59', '60-64', '65-69', '70-74', '75-79', '80-84',
            '80+'
        ];

        Highcharts.chart('usia', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Statistik Berdasarkan Usia'
            },
            subtitle: {
                text: ''
            },
            accessibility: {
                point: {
                    valueDescriptionFormat: '{index}. Usia {xDescription}, {value}%.'
                }
            },
            xAxis: [{
                categories: categories,
                reversed: false,
                labels: {
                    step: 1
                },
                accessibility: {
                    description: 'Usia (Laki Laki)'
                }
            }, { // mirror axis on right side
                opposite: true,
                reversed: false,
                categories: categories,
                linkedTo: 0,
                labels: {
                    step: 1
                },
                accessibility: {
                    description: 'Usia (Perempuan)'
                }
            }],
            yAxis: {
                title: {
                    text: null
                },
                labels: {
                    format: '{abs value}%'
                },
                accessibility: {
                    description: 'Persentase',
                    rangeDescription: 'Range: 0 to 5%'
                }
            },

            plotOptions: {
                series: {
                    stacking: 'normal',
                    borderRadius: '50%'
                }
            },

            tooltip: {
                format: '<b>{series.name}, age {point.category}</b><br/>' +
                    'Populasi: {(abs point.y):.2f}%'
            },

            series: [{
                name: 'Laki Laki',
                data: [
                    -1.38, -2.09, -2.45, -2.71, -2.97,
                    -3.69, -4.04, -3.81, -4.19, -4.61,
                    -4.56, -4.21, -3.53, -2.55, -1.82,
                    -1.46, -0.78, -0.71
                ]
            }, {
                name: 'Perempuan',
                data: [
                    1.35, 1.98, 2.43, 2.39, 2.71,
                    3.02, 3.50, 3.52, 4.03, 4.40,
                    4.17, 3.88, 3.29, 2.42, 1.80,
                    1.39, 0.99, 1.15
                ]
            }]
        });
    </script>
@endsection
