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
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Template</h1>
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
                        <li class="breadcrumb-item text-muted">Template Operasi</li>
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
                        <h5 class="card-title">Data Template Anastesi</h5>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ route('create.template-anastesi') }}" class="btn btn-sm btn-primary">Tambah Template</a>
                    </div>
                </div>
                <!--begin::Body-->
                <div class="card-body p-lg-15">
                    <table id="tbl-ruangan" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                        <thead class="border">
                            <tr class="fw-bold fs-6 text-gray-800 px-7">
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Template</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Opsi</th>
                            </tr>
                        </thead>
                        <tbody class="border">
                            @foreach ($data as $val)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $val->nama }}</td>
                                    <td class="text-center">
                                        @if ($val->status == 1)
                                            <span class="badge badge-primary">Aktif</span>
                                        @else
                                            <span class="badge badge-danger">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('edit.edit_anastesi', $val->id) }}" class="btn btn-success btn-sm">Ubah Data</a>
                                        @if ($val->status == 1)
                                            <a href="{{ route('update-status.template', [$val->id,2]) }}" class="btn btn-sm btn-warning">Ubah Status</a>
                                        @else
                                            <a href="{{ route('update-status.template', [$val->id,1]) }}" class="btn btn-sm btn-warning">Ubah Status</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
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

        $("#tbl-ruangan").DataTable({
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
            search: {
                return: true
            },
            orderable: true,
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
