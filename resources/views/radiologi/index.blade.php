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
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">List Radiologi Hasil</h1>
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
                        <li class="breadcrumb-item text-muted">Radiologi Hasil</li>
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
                        <h5 class="card-title">Data Hasil Radiologi</h5>
                    </div>
                    <div class="card-toolbar">
                        {{-- <a href="{{ route('pasien.tambah-pasien') }}" class="btn btn-primary">Tambah Pasien</a> --}}
                    </div>
                </div>
                <!--begin::Body-->
                <div class="card-body p-lg-15">
                    <table id="tbl-pasien" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                        <thead class="border">
                            <tr class="fw-bold fs-7 text-gray-800 px-7">
                                <th>No RM</th>
                                <th>Nama Pasien</th>
                                <th>Tgl Permintaan</th>
                                <th>Tgl Hasil</th>
                                <th>Jenis Rawat</th>
                                <th>Tindakan</th>
                                <th>Dokter Pengirim</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="border fs-8">
                            
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
    $(function(){
        $("#tbl-pasien").DataTable({
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
                { data: 'no_rm', name: 'rawat.no_rm' },
                { data: 'nama_pasien', name: 'pasien.nama_pasien' },
                { data: 'tgl_permintaan', name: 'soap_radiologi.tgl_permintaan' },
                { data: 'tgl_hasil', name: 'radiologi_hasildetail.tgl_hasil' },
                { data: 'jenis', name: 'rawat_jenis.jenis' },
                { data: 'nama_tindakan', name: 'radiologi_tindakan.nama_tindakan' },
                { data: 'nama_dokter', name: 'dokter.nama_dokter' },
                { data: 'action', name: 'action', orderable: false, searcheable: false },
            ]
        });
    });

</script>
@endsection
