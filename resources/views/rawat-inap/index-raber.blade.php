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
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0"></h1>
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
                            <li class="breadcrumb-item text-muted">Rawat Inap (Raber)</li>
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
                <div class="card card-flush">
                    <div class="card-header">
                        <h3 class="card-title">Pasien Raber</h3>
                        <div class="card-toolbar">
                            {{-- <a href="{{ route('index.rawat-inap') }}" class="btn btn-sm btn-secondary me-2">Kembali</a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="tbl-rekap" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                            <thead class="border">
                                <tr class="fw-bold fs-7 text-gray-800 px-7">
                                    <th>No</th>
                                    <th>No RM</th>
                                    <th>Nama Pasien</th>
                                    <th>Usia Pasien</th>
                                    <th>Tgl Masuk</th>
                                    <th>Ruangan</th>
                                    <th>Penanggung</th>
                                    <th>Deatil</th>
                                </tr>
                            </thead>
                            <tbody class="border">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js"></script>
    <script>
        $(function() {
            $("#tbl-rekap").DataTable({
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
                        "data": "id",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'no_rm',
                        name: 'rawat.no_rm'
                    },
                    {
                        data: 'nama_pasien',
                        name: 'pasien.nama_pasien'
                    },
                    {
                        data: 'usia_tahun',
                        name: 'pasien.usia_tahun'
                    },
                    {
                        data: 'tglmasuk',
                        name: 'rawat.tglmasuk'
                    },
                    {
                        data: 'nama_ruangan',
                        name: 'ruangan.nama_ruangan'
                    },
                    {
                        data: 'bayar',
                        name: 'rawat_bayar.bayar'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searcheable: false
                    },
                ]
            });


        });

        @if ($message = session('gagal'))
            Swal.fire({
                text: '{{ $message }}',
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });
        @endif
        @if ($message = session('berhasil'))
            Swal.fire({
                text: '{{ $message }}',
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "Ok",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });
        @endif
    </script>
@endsection
