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
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Input
                            Hasil Lab</h1>
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
                            <li class="breadcrumb-item text-muted">Input Hasil Lab</li>
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
                <div class="row">
                    <div class="col-md-6 mb-5">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <h5 class="card-title">Data Pasien</h5>
                                </div>
                            </div>
                            <!--begin::Body-->
                            <div class="card-body p-lg-15">
                                <div class="row p-2">
                                    <!--begin::Label-->
                                    <label class="col-md-4 fw-semibold text-muted">No RM</label>
                                    <div class="col-md-8">
                                        <span class="md-bold fs-6 text-gray-800">{{ $rawat->pasien->no_rm }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row p-2">
                                    <label class="col-md-4 fw-semibold text-muted">Nama Pasien</label>
                                    <div class="col-md-8">
                                        <span class="md-bold fs-6 text-gray-800">{{ $rawat->pasien->nama_pasien }}</span>
                                    </div>
                                </div>
                                <div class="row p-2">
                                    <label class="col-md-4 fw-semibold text-muted">Usia</label>
                                    <div class="col-md-8">
                                        <span class="md-bold fs-6 text-gray-800">
                                            {{ $rawat->pasien->usia_tahun }}Th {{ $rawat->pasien->usia_bulan }}Bln
                                            {{ $rawat->pasien->usia_hari }}Hr</span>
                                    </div>
                                </div>
                                <div class="row p-2">
                                    <label class="col-md-4 fw-semibold text-muted">No BPJS</label>
                                    <div class="col-md-8">
                                        <span class="md-bold fs-6 text-gray-800">{{ $rawat->pasien->no_bpjs }}</span>
                                    </div>
                                </div>
                                <div class="row p-2">
                                    <label class="col-md-4 fw-semibold text-muted">NIK</label>
                                    <div class="col-md-8">
                                        <span class="md-bold fs-6 text-gray-800">{{ $rawat->pasien->nik }}</span>
                                    </div>
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                    <div class="col-md-6 mb-5">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <h5 class="card-title">Data Berobat</h5>
                                </div>
                            </div>
                            <!--begin::Body-->
                            <div class="card-body p-lg-15">
                                <div class="row mb-2">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">Poli</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800">{{ $rawat->poli?->poli }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-2">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">Dokter</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800">{{ $rawat->dokter?->nama_dokter }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-2">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">Tgl.Berobat</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        @php
                                            setlocale(LC_ALL, 'IND');
                                        @endphp
                                        <span
                                            class="fw-bold fs-6 text-gray-800">{{ \Carbon\Carbon::parse($rawat->tglmasuk)->formatLocalized('%A %d %B %Y') }}
                                            {{ date('H:i:s', strtotime($rawat->tglmasuk)) }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-2">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">Penanggung</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">

                                        <span class="fw-bold fs-6 text-gray-800">{{ $rawat->bayar->bayar }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card mb-5">
                            <div class="card-header">
                                <h5 class="card-title">Input Pemeriksaan {{ $pemeriksaan->nama_pemeriksaan }}</h5>
                            </div>
                            <div class="card-body">
                                @if ($pemeriksaan->status == 2)
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Nilai</th>
                                                <th>Satuan</th>
                                                <th>Nilai Rujukan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <form action="{{ route('penunjang.lab-post-hasil', $pemeriksaan->id) }}"
                                                id='frmLabhasil' method="post">
                                                @csrf
                                                @foreach ($lab_form as $lf)
                                                    <tr>
                                                        <td>{{ $lf->item }}</td>
                                                        <td>
                                                            {{ $lf->hasil }}
                                                        </td>
                                                        <td>{{ $lf->satuan }}</td>
                                                        <td>{{ $lf->nilai_rujukan }}</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="5">
                                                        <a href="{{ route('penunjang.detail', [$rawat->id, 'Lab']) }}"
                                                            class="btn btn-primary">Kembali</a>
                                                    </td>
                                            </form>

                                        </tbody>
                                    </table>
                                @else
                                    <form action="{{ route('penunjang.lab-post-hasil', $pemeriksaan->id) }}"
                                        id='frmLabhasil' method="post">
                                        @csrf
                                        <div id="lab_repeater">
                                            <!--begin::Form group-->
                                            <div class="form-group">
                                                <div data-repeater-list="lab">
                                                    @foreach ($lab_form as $val)
                                                        <div data-repeater-item>
                                                            <div class="form-group row mb-2">
                                                                <div class="col-md-3">
                                                                    <label for="">Item</label>
                                                                    <input type="hidden"
                                                                        class="form-control form-control-solid" readonly
                                                                        name='id_item' value="{{ $val->id }}">
                                                                    <input type="text"
                                                                        class="form-control form-control-solid" readonly
                                                                        name='item' value="{{ $val->form }}">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label for="">Hasil</label>
                                                                    <input type="text" class="form-control"
                                                                        name='hasil'>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label for="">Satuan</label>
                                                                    <input type="text"
                                                                        class="form-control form-control-solid" readonly
                                                                        value="{{ $val->satuan }}" name='satuan'>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label for="">Nilai Normal</label>
                                                                    <input type="text"
                                                                        class="form-control form-control-solid" readonly
                                                                        value="{{ $rawat->pasien->jenis_kelamin == 'L' ? $val->nilai_normallaki : $val->nilai_normalp }}"
                                                                        name='nilai_normal'>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach


                                                </div>
                                            </div>
                                            <!--end::Form group-->

                                            <!--begin::Form group-->
                                            {{-- <div class="form-group mt-5">
                                        <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                            <i class="ki-duotone ki-plus fs-3"></i>
                                            Tambah Lab
                                        </a>
                                    </div> --}}
                                            <!--end::Form group-->
                                        </div>
                                        <br>
                                        <button class="btn btn-primary">Simpan</button>
                                    </form>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                <!--end::FAQ card-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js"></script>
    <script>
        $(function() {

            $('#lab_repeater').repeater({
                initEmpty: false,

                show: function() {
                    $(this).slideDown();

                    $(this).find('[data-kt-repeater="select2lab"]').select2();
                },

                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                },

                ready: function() {
                    $('[data-kt-repeater="select2lab"]').select2();
                }
            });
            $("#frmLabhasil").on("submit", function(event) {
                event.preventDefault();
                var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
                Swal.fire({
                    title: 'Simpan Data',
                    text: "Apakah Anda yakin akan mengerjakan pemeriksaan ini ? ",
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
        });
    </script>
@endsection
