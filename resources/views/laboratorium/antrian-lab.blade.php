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
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Antrian
                            Laboratorium</h1>
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
                            <li class="breadcrumb-item text-muted">Antrian Laboratorium</li>
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
                            <h5 class="card-title">Antrian Laboratorium</h5>
                        </div>
                        <div class="card-toolbar">
                            {{-- <a href="{{ route('pasien.tambah-pasien') }}" class="btn btn-primary">Tambah Pasien</a> --}}
                        </div>
                    </div>
                    <!--begin::Body-->
                    <div class="card-body p-lg-15">
                        <div class="row">
                            <div class="col-md-4 mb-5">
                                <div class="card card-bordered">
                                    <div class="card-body ribbon ribbon-end ribbon-clip">
                                        <div class="ribbon-label">
                                            Antrian
                                            <span class="ribbon-inner bg-danger"></span>
                                        </div>
                                        <h3>{{ $antrian }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-5">
                                <div class="card card-bordered">
                                    <div class="card-body ribbon ribbon-end ribbon-clip">
                                        <div class="ribbon-label">
                                            Pemeriksaan
                                            <span class="ribbon-inner bg-warning"></span>
                                        </div>
                                        <h3>{{ $pemeriksaan }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-5">
                                <div class="card card-bordered">
                                    <div class="card-body ribbon ribbon-end ribbon-clip">
                                        <div class="ribbon-label">
                                            Selesai
                                            <span class="ribbon-inner bg-primary"></span>
                                        </div>
                                        <h3>{{ $selesai }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table id="tbl-pasien" class="table table-striped gy-5 gs-7  rounded">
                            <thead class="">
                                <tr class="text-center">
                                    {{-- <th>
                                        <input type="text" class="form-control form-control-sm" name='no_rm'
                                            id='no_rm' placeholder="NO RM" />
                                    </th>
                                    <th>
                                        <input type="text" class="form-control form-control-sm" name='nama_pasien'
                                            id='nama_pasien' placeholder="nama_pasien" />
                                    </th> --}}
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>
                                        <select name="asal" class="form-select form-select-sm" id="asal">
                                            <option value="" class="text-muted">Jenis Rawat</option>
                                            <option value="1">Rawat Jalan</option>
                                            <option value="2">Rawat Inap</option>
                                            <option value="3">UGD</option>
                                        </select>
                                    </th>
                                    <th>
                                        <select name="status" class="form-select form-select-sm" id="status">
                                            <option value="" class="text-muted">Status Antrian</option>
                                            <option value="Antrian">Antrian</option>
                                            <option value="Pemeriksaan">Pemeriksaan</option>
                                            <option value="Selesai">Selesai</option>
                                        </select>
                                    </th>
                                </tr>
                                <tr class="fw-bold fs-7 text-gray-800 px-7">
                                    <th>No RM</th>
                                    <th>Nama Pasien</th>
                                    <th>Pemeriksaan</th>
                                    <th>Poli / Ruangan</th>
                                    <th>Asal</th>
                                    <th width=150>Status</th>
                                    <th>Tgl</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="fs-8">

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
            let table = $("#tbl-pasien").DataTable({
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
                    url: '{{ url()->current() }}',
                    data: function(d) {
                        d.no_rm = $('#no_rm').val(),
                            d.nama_pasien = $('#nama_pasien').val(),
                            d.asal = $('#asal').val(),
                            d.status = $('#status').val(),
                            d.search = $('input[type="search"]').val()
                    }
                },
                columns: [{
                        data: 'no_rm',
                        name: 'no_rm'
                    },
                    {
                        data: 'nama_pasien',
                        name: 'pasien.nama_pasien'
                    },
                    {
                        data: 'pemeriksaan',
                        name: 'pemeriksaan'
                    },
                    {
                        data: 'poliruangan',
                        name: 'poliruangan'
                    },
                    {
                        data: 'jenis',
                        name: 'rawat_jenis.jenis',
                        "render": function(data, type, row) {
                            if (row['idjenisrawat'] == 1) {
                                return "<span class='badge badge-light-success'>" + data +
                                    "</span>";
                            } else if (row['idjenisrawat'] == 2) {
                                return "<span class='badge badge-light-warning'>" + data +
                                    "</span>";
                            } else {
                                return "<span class='badge badge-light-danger'>" + data +
                                    "</span>";
                            }
                        },
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searcheable: false
                    },
                ]
            });
            $('#status').change(function() {
                table.draw();
            });
            $('#asal').change(function() {
                table.draw();
            });
        });
    </script>
@endsection
