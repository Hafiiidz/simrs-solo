@extends('layouts.index')
@section('css')
    <style>
        .spoiler {
            color: transparent;
            background-color: #c5c5c5;
            filter: blur(1px);
            transition: filter 0.3s;
            opacity: 0.9;
            cursor: pointer;
            border-radius: 3px;
            padding: 0 5px;
        }

        .spoiler:hover,
        .spoiler.revealed {
            color: black;
            filter: blur(0px);
            opacity: 1;
            background-color: transparent;
        }
    </style>    
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
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">List
                            Pasien</h1>
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
                            <li class="breadcrumb-item text-muted">Pasien</li>
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
                <!--begin::FAQ card-->
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h5 class="card-title">Data Pasien</h5>
                        </div>
                        <div class="card-toolbar">
                            <a href="{{ route('pasien.tambah-pasien') }}" class="btn btn-primary">Tambah Pasien</a>
                        </div>
                    </div>
                    <!--begin::Body-->
                    <div class="card-body p-lg-15">
                        <table id="tbl-pasien" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                            <thead class="border">
                                <tr class="fw-bold fs-6 text-gray-800 px-7">
                                    <th>No RM</th>
                                    <th>Nik</th>
                                    <th>No BPJS</th>
                                    <th>Nama</th>
                                    <th>Tempat Lahir</th>
                                    <th>No Handphone.</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody class="border fs-6">

                            </tbody>
                        </table>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::FAQ card-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
@endsection
@section('js')
    <script>
        $(function() {
            $("#tbl-pasien").DataTable({
                "language": {
                    "lengthMenu": "Show _MENU_",
                },
                "dom": "<'row'" +
                    "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                    "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                    ">" +

                    "<'table-responsive'tr>" +

                    "<'row'" +
                    "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                    "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                    ">",
                processing: true,
                serverSide: true,
                search: {
                    return: true
                },
                ajax: '{{ url()->current() }}',
                columns: [{
                        data: 'no_rm',
                        name: 'no_rm'
                    },
                    {
                        data: 'nik',
                        name: 'nik',
                        render: function(data, type, row) {
                            return '<span class="spoiler">' + data + '</span>';
                        }   
                    },
                    {
                        data: 'no_bpjs',
                        name: 'no_bpjs',
                        render: function(data, type, row) {
                            return '<span class="spoiler">' + data + '</span>';
                        }   
                    },
                    {
                        data: 'nama_pasien',
                        name: 'nama_pasien'
                    },
                    {
                        data: 'tempat_lahir',
                        name: 'tempat_lahir'
                    },
                    {
                        data: 'nohp',
                        name: 'nohp',
                        render: function(data, type, row) {
                            return '<span class="spoiler">' + data + '</span>';
                        }   
                    },
                    {
                        data: 'opsi',
                        name: 'opsi',
                        orderable: false,
                        searcheable: false
                    },
                ]
            });
        });
    </script>
@endsection
