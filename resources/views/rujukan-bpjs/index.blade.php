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
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">List
                            Rujukan BPJS</h1>
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
                            <li class="breadcrumb-item text-muted">Vclaim</li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">Rujukan BPJS</li>
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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List Rujujan</h3>
                        <div class="card-toolbar">
                            <button class="btn btn-success btn-sm">Buat Rujukan</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="tbl-pasien" class="table table-striped table-row-bordered gy-3 gs-5 border rounded">
                            <thead class="border">
                                <tr class="fw-bold fs-8 text-gray-800 px-7">
                                    <th>No Rujukan </th>
                                    <th>Tgl Rujukan </th>
                                    <th>RI/RJ </th>
                                    <th>No Sep </th>
                                    <th>No Kartu </th>
                                    <th>Nama</th>
                                    <th>Nama Ppk Dirujuk</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js"></script>
    <script>
        $(function() {
            var table = $("#tbl-pasien").DataTable({
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
                ajax: {
                    url: '{{ url()->current() }}'
                }, // memanggil route yang menampilkan data json
                columns: [
                    {
                        data: 'noRujukan',
                        name: 'noRujukan'
                    },
                    {
                        data: 'tglRujukan',
                        name: 'tglRujukan'
                    },
                    {
                        data: 'jnsPelayanan',
                        name: 'jnsPelayanan',
                        // render: function(data, type, row) {
                        //     if(data == 1){
                        //         return "Rawat Inap";
                        //     }else{
                        //         return "Rawat Jalan";
                        //     }
                        // }   
                    },
                    {
                        data: 'noSep',
                        name: 'noSep'
                    },
                    {
                        data: 'noKartu',
                        name: 'noKartu'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'namaPpkDirujuk',
                        name: 'namaPpkDirujuk'
                    },
                    
                ]
            });


        });
    </script>
@endsection
