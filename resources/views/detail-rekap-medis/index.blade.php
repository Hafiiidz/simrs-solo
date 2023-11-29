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
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">List Rekam Medis Pasien</h1>
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
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Rekam Medis</li>
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
                        <h5 class="card-title">Data Rekam Medis Pasien</h5>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ route('rekap-medis-index', $pasien->id) }}" class="btn btn-sm btn-secondary">Kembali</a>
                    </div>
                </div>
                <!--begin::Body-->
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="p-0">
                            <!--begin::Underline-->
                            <span class="d-inline-block position-relative mb-5">
                                <!--begin::Label-->
                                <span class="d-inline-block mb-2 fs-2 fw-bold">
                                    Detail Pasien
                                </span>
                                <!--end::Label-->

                                <!--begin::Line-->
                                <span class="d-inline-block position-absolute h-5px bottom-0 end-0 start-0 bg-primary translate rounded"></span>
                                <!--end::Line-->
                            </span>
                            <!--end::Underline-->
                        </div>
                        <div class="p-2">
                            @canany(['dokter', 'perawat'])
                                <form action="{{ route('detail-rekap-medis-create') }}" method="GET">
                                    <input type="hidden" name="id_rekapmedis" value="{{ $id_rekapmedis }}">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        Tambah Data Rekam Medis
                                    </button></form>
                            @endcanany
                        </div>
                    </div>

                    <div class="row">
                        <div class="row mb-3">
                            <div class="col-lg-8">
                                <span class="fw-bold fs-4">{{ $pasien->nama_pasien }}</span>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <!--begin::Label-->
                            <label class="col-lg-1 fw-semibold text-muted">No.RM</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800">{{ $pasien->no_rm }}</span>
                            </div>
                            <!--end::Col-->
                        </div>
                        <div class="row mb-5">
                            <!--begin::Label-->
                            <label class="col-lg-1 fw-semibold text-muted">NIK</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800">{{ $pasien->nik }}</span>
                            </div>
                            <!--end::Col-->
                        </div>
                        <div class="row mb-5">
                            <!--begin::Label-->
                            <label class="col-lg-1 fw-semibold text-muted">No BPJS</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800">{{ $pasien->no_bpjs }}</span>
                            </div>
                            <!--end::Col-->
                        </div>
                        <div class="row mb-5">
                            <!--begin::Label-->
                            <label class="col-lg-1 fw-semibold text-muted">No Handphone</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800">{{ $pasien->nohp }}</span>
                            </div>
                            <!--end::Col-->
                        </div>
                        <div class="row mb-5">
                            <!--begin::Label-->
                            <label class="col-lg-1 fw-semibold text-muted">Alamat</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800">{{ $pasien->alamat->alamat }}</span>
                            </div>
                            <!--end::Col-->
                        </div>
                        <div class="row mb-5">
                            <!--begin::Label-->
                            <label class="col-lg-1 fw-semibold text-muted">Kategori</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800">{{ $kategori->nama }} - {{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('l, d F Y'); }}</span>
                            </div>
                            <!--end::Col-->
                        </div>
                    </div>
                    <div class="separator separator-dashed border-secondary mb-5"></div>
                    <table id="tbl-rekap" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                        <thead class="border">
                            <tr class="fw-bold fs-6 text-gray-800 px-7">
                                <th>No</th>
                                <th>Diagnosa</th>
                                <th>Kategori</th>
                                <th>Tanggal</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="border">

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
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js">
</script>
<script>
    $(function(){
        $("#tbl-rekap").DataTable({
            "language": {
                "lengthMenu": "Show _MENU_",
            },
            "dom":
                "<'row'" +
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
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'diagnosa', name: 'diagnosa'},
                    { data: 'kategori', name: 'rekapMedis.kategori.nama' },
                    { data: 'tanggal', name: 'tanggal' },
                    { data: 'opsi', name: 'opsi', orderable: false, searcheable: false },
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
