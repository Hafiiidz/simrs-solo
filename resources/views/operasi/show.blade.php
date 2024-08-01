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
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Antrian Operasi</h1>
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
                        <li class="breadcrumb-item text-muted">Operasi</li>
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
                        <h5 class="card-title">Operasi</h5>
                    </div>
                    <div class="card-toolbar">

                    </div>
                </div>
                <!--begin::Body-->
                <div class="card-body p-lg-15">
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
                                <span
                                    class="d-inline-block position-absolute h-5px bottom-0 end-0 start-0 bg-primary translate rounded"></span>
                                <!--end::Line-->
                            </span>
                            <!--end::Underline-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row mb-3">
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-4">{{ $data->rawat->pasien->nama_pasien }}</span>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <!--begin::Label-->
                                <label class="col-lg-3 fw-semibold text-muted">NO RM</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">{{ $data->rawat->pasien->no_rm }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-5">
                                <!--begin::Label-->
                                <label class="col-lg-3 fw-semibold text-muted">NIK</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">{{ $data->rawat->pasien->nik }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-5">
                                <!--begin::Label-->
                                <label class="col-lg-3 fw-semibold text-muted">No BPJS</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">{{ $data->rawat->pasien->no_bpjs }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-5">
                                <!--begin::Label-->
                                <label class="col-lg-3 fw-semibold text-muted">No Handphone</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">{{ $data->rawat->pasien->nohp }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-5">
                                <!--begin::Label-->
                                <label class="col-lg-3 fw-semibold text-muted">Alamat</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">{{ $data->rawat->pasien->alamat->alamat }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                        </div>
                    </div>
                    <div class="separator separator-dashed border-secondary mb-5"></div>
                    <div class="rounded border p-5">
                        <span class="d-inline-block position-relative mb-7">
                            <!--begin::Label-->
                            <span class="d-inline-block mb-2 fs-4 fw-bold">
                                Detail Operasi
                            </span>
                            <!--end::Label-->

                            <!--begin::Line-->
                            <span class="d-inline-block position-absolute h-5px bottom-0 end-0 start-0 bg-success translate rounded"></span>
                            <!--end::Line-->
                        </span>
                        <form id="frm-data" action="{{ route('update.operasi', $data->id) }}" method="POST" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="" class="form-label">Tanggal Operasi</label>
                                    <input class="form-control" placeholder="Pilih Tanggal Operasi" id="tgl_operasi" name="tgl_operasi" value="{{ $data->tgl_operasi }}" required disabled/>
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="form-label">Jam Mulai</label>
                                    <input class="form-control" placeholder="Pilih Jam Mulai" id="mulai_jam" name="mulai_jam" value="{{ $data->mulai_jam }}" required disabled/>
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="form-label">Jam Selesai</label>
                                    <input class="form-control" placeholder="Pilih Jam Mulai" id="selesai_jam" name="selesai_jam" value="{{ $data->selesai_jam }}" required disabled/>
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="form-label">Lama Operasi</label>
                                    <input class="form-control" type="text" placeholder="Masukan Lama Operasi" id="lama_operasi" name="lama_operasi" value="{{ $data->lama_operasi }}" required disabled/>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <!--begin::Repeater-->
                                        <div id="dokter_bedah">
                                            <!--begin::Form group-->
                                            <div class="form-group">
                                                <div data-repeater-list="dokter_bedah">
                                                    @if ($data->dokter_bedah)
                                                        @foreach (json_decode($data->dokter_bedah) as $val)
                                                            <div data-repeater-item>
                                                                <div class="form-group row mb-5">
                                                                    <div class="col-md-12">
                                                                        <label class="form-label">Dokter Bedah</label>
                                                                        <input type="text" name="dokter_bedah" class="form-control mb-2 mb-md-0" placeholder="Masukan Nama" value="{{ $val->dokter_bedah }}" disabled/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div data-repeater-item>
                                                            <div class="form-group row mb-5">
                                                                <div class="col-md-12">
                                                                    <label class="form-label">Dokter Bedah</label>
                                                                    <input type="text" name="dokter_bedah" class="form-control mb-2 mb-md-0" placeholder="Masukan Nama" disabled/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--end::Form group-->
                                        </div>
                                        <!--end::Repeater-->
                                    </div>
                                    <div class="col-md-4">
                                        <!--begin::Repeater-->
                                        <div id="perawat_bedah">
                                            <!--begin::Form group-->
                                            <div class="form-group">
                                                <div data-repeater-list="perawat_bedah">
                                                    @if ($data->perawat_bedah)
                                                        @foreach (json_decode($data->perawat_bedah) as $val)
                                                            <div data-repeater-item>
                                                                <div class="form-group row mb-5">
                                                                    <div class="col-md-12">
                                                                        <label class="form-label">Perawat Bedah</label>
                                                                        <input type="text" name="perawat_bedah" class="form-control mb-2 mb-md-0" placeholder="Masukan Nama" value="{{ $val->perawat_bedah }}" disabled/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div data-repeater-item>
                                                            <div class="form-group row mb-5">
                                                                <div class="col-md-12">
                                                                    <label class="form-label">Perawat Bedah</label>
                                                                    <input type="text" name="perawat_bedah" class="form-control mb-2 mb-md-0" placeholder="Masukan Nama" disabled/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    </div>
                                            </div>
                                            <!--end::Form group-->
                                        </div>
                                        <!--end::Repeater-->
                                    </div>
                                    <div class="col-md-4">
                                        <!--begin::Repeater-->
                                        <div id="asisten">
                                            <!--begin::Form group-->
                                            <div class="form-group">
                                                <div data-repeater-list="asisten">
                                                    @if ($data->asisten)
                                                        @foreach (json_decode($data->asisten) as $val)
                                                            <div data-repeater-item>
                                                                <div class="form-group row mb-5">
                                                                    <div class="col-md-12">
                                                                        <label class="form-label">Asisten</label>
                                                                        <input type="text" name="asisten" class="form-control mb-2 mb-md-0" placeholder="Masukan Nama" value="{{ $val->asisten }}" disabled/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div data-repeater-item>
                                                            <div class="form-group row mb-5">
                                                                <div class="col-md-12">
                                                                    <label class="form-label">Asisten</label>
                                                                    <input type="text" name="asisten" class="form-control mb-2 mb-md-0" placeholder="Masukan Nama" disabled/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--end::Form group-->
                                        </div>
                                        <!--end::Repeater-->
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="" class="form-label">Diagnosis Prabedah</label>
                                        <textarea name="diagnosis_prabedah" id="diagnosis_prabedah" rows="5" class="form-control" required disabled>{{ $data->diagnosis_prabedah }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <label for="" class="form-label">Jenis Operasi</label>
                                    <select name="jenis_operasi" class="form-select" data-control="select2" data-placeholder="Pilih Jenis Operasi" disabled>
                                        <option></option>
                                        <option value="Kecil" {{ ($data->jenis_operasi == 'Kecil') ? 'selected' : '' }}>Kecil</option>
                                        <option value="Sedang" {{ ($data->jenis_operasi == 'Sedang') ? 'selected' : '' }}>Sedang</option>
                                        <option value="Bersih" {{ ($data->jenis_operasi == 'Bersih') ? 'selected' : '' }}>Bersih</option>
                                        <option value="Besar" {{ ($data->jenis_operasi == 'Besar') ? 'selected' : '' }}>Besar</option>
                                        <option value="Khusus" {{ ($data->jenis_operasi == 'Khusus') ? 'selected' : '' }}>Khusus</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="" class="form-label">Diagnosis Pasca Bedah</label>
                                        <textarea name="diagnosis_pasca_bedah" id="diagnosis_pasca_bedah" rows="5" class="form-control" required disabled>{{ $data->diagnosis_pasca_bedah }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <!--begin::Repeater-->
                                        <div id="tindakan_bedah">
                                            <!--begin::Form group-->
                                            <div class="form-group">
                                                <div data-repeater-list="tindakan_bedah">
                                                    @if ($data->tindakan_bedah)
                                                        @foreach (json_decode($data->tindakan_bedah) as $val)
                                                            <div data-repeater-item>
                                                                <div class="form-group row mb-5">
                                                                    <div class="col-md-12">
                                                                        <label class="form-label">Tindakan Bedah</label>
                                                                        <select name="tindakan_bedah" class="form-select"
                                                                            data-kt-repeater="tindakan_bedah_select" data-placeholder="Pilih Tindakan Bedah"
                                                                            required disabled>
                                                                            <option value="{{ $val->tindakan_bedah }}" selected>{{ $val->tindakan_bedah }}</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div data-repeater-item>
                                                            <div class="form-group row mb-5">
                                                                <div class="col-md-12">
                                                                    <label class="form-label">Tindakan Bedah</label>
                                                                    <select name="tindakan_bedah" class="form-select"
                                                                        data-kt-repeater="tindakan_bedah_select" data-placeholder="Pilih Tindakan Bedah"
                                                                        required disabled>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--end::Form group-->
                                        </div>
                                        <!--end::Repeater-->
                                    </div>
                                    <div class="col-md-4">
                                        <!--begin::Repeater-->
                                        <div id="ahli_anastesi">
                                            <!--begin::Form group-->
                                            <div class="form-group">
                                                <div data-repeater-list="ahli_anastesi">
                                                @if ($data->ahli_anastesi)
                                                    @foreach (json_decode($data->ahli_anastesi) as $val)
                                                        <div data-repeater-item>
                                                            <div class="form-group row mb-5">
                                                                <div class="col-md-12">
                                                                    <label class="form-label">Ahli Anastesi</label>
                                                                    <input type="text" name="ahli_anastesi" class="form-control mb-2 mb-md-0" placeholder="Masukan Nama" value="{{ $val->ahli_anastesi }}" disabled/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div data-repeater-item>
                                                        <div class="form-group row mb-5">
                                                            <div class="col-md-12">
                                                                <label class="form-label">Ahli Anastesi</label>
                                                                <input type="text" name="ahli_anastesi" class="form-control mb-2 mb-md-0" placeholder="Masukan Nama" disabled/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                </div>
                                            </div>
                                            <!--end::Form group-->

                                        </div>
                                        <!--end::Repeater-->
                                    </div>
                                    <div class="col-md-4">
                                        <!--begin::Repeater-->
                                        <div id="obat_anastesi">
                                            <!--begin::Form group-->
                                            <div class="form-group">
                                                <div data-repeater-list="obat_anastesi">
                                                    @if ($data->obat_anastesi)
                                                        @foreach (json_decode($data->obat_anastesi) as $val)
                                                            <div data-repeater-item>
                                                                <div class="form-group row mb-5">
                                                                    <div class="col-md-12">
                                                                        <label class="form-label">Obat Anastesi</label>
                                                                        <input type="text" name="obat_anastesi" class="form-control mb-2 mb-md-0" placeholder="Masukan Nama" value="{{ $val->obat_anastesi }}" disabled/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div data-repeater-item>
                                                            <div class="form-group row mb-5">
                                                                <div class="col-md-12">
                                                                    <label class="form-label">Obat Anastesi</label>
                                                                    <input type="text" name="obat_anastesi" class="form-control mb-2 mb-md-0" placeholder="Masukan Nama" disabled/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--end::Form group-->
                                        </div>
                                        <!--end::Repeater-->
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="" class="form-label">Jumlah Pendarahan</label>
                                        <input type="text" name="jumlah_pendarahan" id="jumlah_pendarahan" class="form-control" placeholder="Masukan Jumlah Pendarahan" value="{{ $data->jumlah_pendarahan }}" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="form-label">Kamar Operasi</label>
                                        <input type="text" name="kamar_operasi" id="kamar_operasi" class="form-control" placeholder="Masukan Kamar Operasi" value="{{ $data->kamar_operasi }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="" class="form-label">Uraian Pembedahan</label>
                                        <textarea name="uraian_pembedahan" id="uraian_pembedahan" rows="5" class="form-control" placeholder="Masukan Uraian Pembedahan" disabled>{{ $data->uraian_pembedahan }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::FAQ card-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>

<div class="modal fade" tabindex="-1" id="modal_status">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Ubah Status</h3>
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                            class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <form id="frm-status" action="{{ route('update-status.operasi', $data->id) }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label for="" class="form-label required">Status</label>
                            <select name="status" class="form-select" data-control="select2" data-placeholder="Pilih Status">
                                <option></option>
                                <option value="antrian" {{ ($data->status == 'antrian') ? 'selected' : '' }} >Antrian</option>
                                <option value="operasi" {{ ($data->status == 'operasi') ? 'selected' : '' }} >Operasi</option>
                                <option value="batal" {{ ($data->status == 'batal') ? 'selected' : '' }} >Batal</option>
                                <option value="selesai" {{ ($data->status == 'selesai') ? 'selected' : '' }} >Selesai</option>
                            </select>
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
                </form>
        </div>
    </div>
</div>

@endsection
@section('js')
<script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js"></script>
<script>
    $(function(){
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

        $("#frm-status").on( "submit", function(event) {
            event.preventDefault();
            var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
            Swal.fire({
                title: 'Simpan Data',
                text: "Apakah Anda yakin akan menyimpan status ini ?",
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

        $("#tgl_operasi").flatpickr({
            altInput: true,
            altFormat: "d-m-Y",
            dateFormat: "Y-m-d"
        });

        $("#mulai_jam").flatpickr({
            noCalendar : true,
            enableTime : true,
            time_24hr : true
        });

        $("#selesai_jam").flatpickr({
            noCalendar : true,
            enableTime : true,
            time_24hr : true
        });

        $('#dokter_bedah').repeater({
            initEmpty: false,

            show: function () {
                $(this).slideDown();
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });

        $('#perawat_bedah').repeater({
            initEmpty: false,

            show: function () {
                $(this).slideDown();
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });

        $('#asisten').repeater({
            initEmpty: false,

            show: function () {
                $(this).slideDown();
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });

        $('#tindakan_bedah').repeater({
            initEmpty: false,

            show: function() {
                $(this).slideDown();

                $(this).find('[data-kt-repeater="tindakan_bedah_select"]').select2({
                    ajax: {
                        url: 'https://new-simrs.rsausulaiman.com/auth/listprosedur2',
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {

                            return {
                                q: params.term, // search term
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: data.map(function(user) {
                                    return {
                                        id: user.id,
                                        text: user.text
                                    };
                                })
                            };
                        },
                        cache: true
                    },
                    minimumInputLength: 1,
                    placeholder: 'Pilih Tindakan Bedah'
                });
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            },

            ready: function() {
                $('[data-kt-repeater="tindakan_bedah_select"]').select2({
                    ajax: {
                        url: 'https://new-simrs.rsausulaiman.com/auth/listprosedur2',
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {

                            return {
                                q: params.term, // search term
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: data.map(function(user) {
                                    return {
                                        id: user.id,
                                        text: user.text
                                    };
                                })
                            };
                        },
                        cache: true
                    },
                    minimumInputLength: 1,
                    placeholder: 'Pilih Tindakan Bedah'
                });
            }
        });

        $('#ahli_anastesi').repeater({
            initEmpty: false,

            show: function () {
                $(this).slideDown();
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });

        $('#obat_anastesi').repeater({
            initEmpty: false,

            show: function () {
                $(this).slideDown();
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
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
</script>
@endsection
