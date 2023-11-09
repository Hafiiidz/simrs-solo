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
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Ruangan</h1>
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
                        <li class="breadcrumb-item text-muted">Ruangan</li>
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
                        <h5 class="card-title">Data Ruangan</h5>
                    </div>
                    <div class="card-toolbar">
                        @canany(['dokter', 'perawat'])
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tambah-ruangan">
                                Tambah Data Ruangan
                            </button>
                        @endcanany
                    </div>
                </div>
                <!--begin::Body-->
                <div class="card-body p-lg-15">
                    <table id="tbl-ruangan" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                        <thead class="border">
                            <tr class="fw-bold fs-6 text-gray-800 px-7">
                                <th>No</th>
                                <th>Nama Ruangan</th>
                                <th>Kelas</th>
                                <th>Ruangan Jenis</th>
                                <th>Gender</th>
                                <th>Kapasitas</th>
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

<!-- Modal -->
<div class="modal fade" id="tambah-ruangan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Ruangan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="frm-data" action="{{ route('store.ruangan') }}" method="POST" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <label class="form-label">Jenis Ruangan</label>
                        <select class="form-select" name="jenis_ruangan" data-control="select2" data-placeholder="Pilih Jenis Ruangan" data-dropdown-parent="#tambah-ruangan" required>
                            <option></option>
                            @foreach ($jenis as $val)
                                <option value="{{ $val->id }}">{{ $val->ruangan_jenis }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12">
                        <label class="form-label">Nama Ruangan</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12">
                        <label class="form-label">Ruangan Untuk</label>
                        <select class="form-select" name="gender" data-control="select2" data-placeholder="Pilih Ruangan" data-dropdown-parent="#tambah-ruangan" required>
                            <option></option>
                            @foreach ($gender as $val)
                                <option value="{{ $val->id }}">{{ $val->gender }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12">
                        <label class="form-label">Kelas Ruangan</label>
                        <select class="form-select" name="kelas" data-control="select2" data-placeholder="Pilih Kelas Ruangan" data-dropdown-parent="#tambah-ruangan" required>
                            <option></option>
                            @foreach ($kelas as $val)
                                <option value="{{ $val->id }}">{{ $val->kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12">
                        <label class="form-label">Status</label>
                        <div class="d-flex">
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input" name="status" type="radio" value="1" id="flexRadioDefault" required/>
                                <label class="form-check-label" for="flexRadioDefault">
                                    Aktif
                                </label>
                            </div>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <div class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input" name="status" type="radio" value="0" id="flexRadioDefault" required/>
                                <label class="form-check-label" for="flexRadioDefault">
                                    Tidak Aktif
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12">
                        <label class="form-label">Keterangan</label>
                        <textarea name="keterangan" rows="3" class="form-control"></textarea>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
                <button type="submit" class="btn btn-success">Tambah</button>
            </form>
        </div>
        </div>
    </div>
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
            processing: true,
            serverSide: true,
            search: {
                return: true
            },
            ajax: '{{ url()->current() }}',
            columns: [
                {
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                { data: 'nama_ruangan', name: 'nama_ruangan' },
                { data: 'kelas', name: 'kelas' },
                { data: 'ruangan_jenis', name: 'ruangan_jenis' },
                { data: 'gender', name: 'gender' },
                { data: 'kapasitas', name: 'kapasitas' },
                { data: 'opsi', name: 'opsi', orderable: false, searcheable: false },
            ]
        });

        $("#frm-data").on( "submit", function(event) {
            event.preventDefault();
            var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
            Swal.fire({
                title: 'Simpan Data',
                text: "Apakah Anda yakin akan menyimpan data ini ?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan Data',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.blockUI({
                        css: {
                            border: 'none',
                            padding: '15px',
                            backgroundColor: '#000',
                            '-webkit-border-radius': '10px',
                            '-moz-border-radius': '10px',
                            opacity: .5,
                            color: '#fff',
                            fontSize: '16px'
                        },
                        message: "<img src='{{ asset('assets/img/loading.gif') }}' width='10%' height='auto'> Tunggu . . .",
                        baseZ: 9000,
                    });
                    this.submit();
                }
            });
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
