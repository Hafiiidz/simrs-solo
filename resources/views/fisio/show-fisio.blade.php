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
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Detail
                            Gizi</h1>
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
                            <li class="breadcrumb-item text-muted">Fisioterapi</li>
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
                            <a href="{{ route('penunjang.detail', [$rawat->id, 'Fisio']) }}"
                                class="btn btn-secondary btn-sm">Kembali</a>
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
                            <div class="p-2">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row mb-3">
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-4">{{ $pasien->nama_pasien }}</span>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <!--begin::Label-->
                                    <label class="col-lg-3 fw-semibold text-muted">NIK</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800">{{ $pasien->nik }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-5">
                                    <!--begin::Label-->
                                    <label class="col-lg-3 fw-semibold text-muted">No BPJS</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800">{{ $pasien->no_bpjs }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-5">
                                    <!--begin::Label-->
                                    <label class="col-lg-3 fw-semibold text-muted">No Handphone</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800">{{ $pasien->nohp }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-5">
                                    <!--begin::Label-->
                                    <label class="col-lg-3 fw-semibold text-muted">Alamat</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800">{{ $pasien->alamat->alamat }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row mb-3">
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-4">{{ $rawat->ruangan->nama_ruangan }}</span>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <!--begin::Label-->
                                    <label class="col-lg-3 fw-semibold text-muted">Tgl Masuk</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800">{{ $rawat->tglmasuk }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-5">
                                    <!--begin::Label-->
                                    <label class="col-lg-3 fw-semibold text-muted">Penanggung</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800">{{ $rawat->bayar->bayar }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-5">
                                    <!--begin::Label-->
                                    <label class="col-lg-3 fw-semibold text-muted">DPJP</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800">{{ $rawat->dokter->nama_dokter }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-5">
                                    <!--begin::Label-->
                                    <label class="col-lg-3 fw-semibold text-muted">Diagnosa Masuk</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800">{{ $rawat->icdx }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                            </div>

                        </div>
                        <div class="separator separator-dashed border-secondary mb-5"></div>
                        <form action="{{ route('fisio.post-asesmen', $rawat->id) }}" method="post" id='frmAsesmen'>
                            @csrf
                            <div class="row p-lg-5">
                                <div class="card card-bordered">
                                    <div class="card-header">
                                        <h5 class="card-title">Anamnese</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-5">
                                            <div class="col-md-4">
                                                <label class="form-label">Anamnese</label>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="d-flex justify-content-start">
                                                    <div class="form-check form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="radio" value="Autoanamnese"
                                                            id="riwayat-1" {{ $asesmen->anamnese =='Autoanamnese' ? 'checked':'' }} name="anamnese">
                                                        <label class="form-check-label" for="flexRadioDefault">
                                                            Autoanamnese
                                                        </label>
                                                    </div>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="radio"
                                                            value="Heteroanamnese" {{ $asesmen->anamnese =='Heteroanamnese' ? 'checked':'' }} id="riwayat-1" name="anamnese">
                                                        <label class="form-check-label" for="flexRadioDefault">
                                                            Heteroanamnese
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-5">
                                            <div class="col-md-12">
                                                <label class="form-label">Keluhan Utama</label>
                                                <textarea required name="keluhan_utama" required id="" class="form-control" rows=3>{{ $asesmen->keluhan_utama }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-5">
                                            <div class="col-md-12">
                                                <label class="form-label">Riwayat Penyakit Dahulu dan Penyerta</label>
                                                <textarea required name="riwayat_penyakit" required id="" class="form-control" rows=3>{{ $asesmen->riwayat_penyakit }}</textarea>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="row p-lg-5">
                                <div class="card card-bordered">
                                    <div class="card-header">
                                        <h5 class="card-title">Pemeriksaan Fisik</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row md-5">
                                            <div class="col-md-4">
                                                <label class="form-label">Tekanan Darah</label>
                                                <div class="input-group mb-5">
                                                    <input type="text" class="form-control" name="tekanan_darah"
                                                        value="{{ $pemeriksaan_fisik->tekanan_darah }}" placeholder="...." aria-label="...."
                                                        aria-describedby="tdarah">
                                                    <span class="input-group-text" id="tdarah">mmHg</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Nadi</label>
                                                <div class="input-group mb-5">
                                                    <input type="text" class="form-control" name="nadi"
                                                        value="{{ $pemeriksaan_fisik->nadi }}" placeholder="...." aria-label="...."
                                                        aria-describedby="nadi">
                                                    <span class="input-group-text" id="nadi">x/Menit</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Pernapasan</label>
                                                <div class="input-group mb-5">
                                                    <input type="text" class="form-control" name="pernapasan"
                                                        value="{{ $pemeriksaan_fisik->pernapasan }}" placeholder="...." aria-label="...."
                                                        aria-describedby="pernapasan">
                                                    <span class="input-group-text" id="pernapasan">x/Menit</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row md-5">
                                            <div class="col-md-4">
                                                <label class="form-label">Suhu</label>
                                                <div class="input-group mb-5">
                                                    <input type="text" class="form-control" name="suhu"
                                                        value="{{ $pemeriksaan_fisik->suhu }}" placeholder="...." aria-label="...."
                                                        aria-describedby="suhu">
                                                    <span class="input-group-text" id="suhu">Derajat</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Berat Badan</label>
                                                <div class="input-group mb-5">
                                                    <input type="text" class="form-control" onkeyup="calculateBMI()"
                                                        id="berat_badan_val" name="berat_badan" value="{{ $pemeriksaan_fisik->berat_badan }}"
                                                        placeholder="...." aria-label="...."
                                                        aria-describedby="berat_badan">
                                                    <span class="input-group-text" id="berat_badan">Kg</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Tinggi Badan</label>
                                                <div class="input-group mb-5">
                                                    <input type="text" class="form-control" onkeyup="calculateBMI()"
                                                        id="tinggi_badan_val" name="tinggi_badan" value="{{ $pemeriksaan_fisik->tinggi_badan }}"
                                                        placeholder="...." aria-label="....e"
                                                        aria-describedby="tinggi_badan">
                                                    <span class="input-group-text" id="tinggi_badan">Cm</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row col-md-4">
                                            <label class="form-label">BMI</label>
                                            <div class="input-group mb-5">
                                                <input type="text" class="form-control" id="bmi_val" name="bmi"
                                                    value="{{ $pemeriksaan_fisik->bmi }}" placeholder="...." aria-label="....e"
                                                    aria-describedby="bmi">
                                                <span class="input-group-text" id="bmi">Kg/M2</span>
                                            </div>
                                        </div>
                                        <div class="separator separator-dashed border-secondary mb-5"></div>

                                        <div class="row mb-5">
                                            <div class="col-md-4">
                                                <label class="form-label">Skor Nyeri</label>
                                                <input type="text" value="{{ $pemeriksaan_fisik->skor_nyeri }}" class="form-control" name="skor_nyeri">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Berkurang Saat</label>
                                                <input type="text" class="form-control" name="berkurang" value='{{ $pemeriksaan_fisik->berkurang }}'>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Bertambah Saat</label>
                                                <input type="text" class="form-control" name="bertambah" value='{{ $pemeriksaan_fisik->bertambah }}'>
                                            </div>
                                        </div>
                                        <div class="separator separator-dashed border-secondary mb-5"></div>
                                        <div class="row mb-5">
                                            <div class="col-md-4">
                                                <label class="form-label">Kemampuan Fungsional (ADL) </label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="d-flex justify-content-start">
                                                    <div class="form-check form-check-custom form-check-solid">
                                                        <input class="form-check-input" {{ $kemampuan->kemampuan == 0 ?'checked':''}} type="radio" value="0"
                                                            id="riwayat-1" name="kemampuan">
                                                        <label class="form-check-label" for="flexRadioDefault">
                                                            Mandiri
                                                        </label>
                                                    </div>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-custom form-check-solid">
                                                        <input class="form-check-input" {{ $kemampuan->kemampuan == 1 ?'checked':''}} type="radio" value="1"
                                                            id="riwayat-1" name="kemampuan">
                                                        <label class="form-check-label" for="flexRadioDefault">
                                                            Bantuan
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" name="value_kemampuan" id="value_kemampuan"
                                                    class="form-control"value="{{ $kemampuan->value_kemampuan }}" placeholder="...."
                                                    style="display: {{ $kemampuan->kemampuan == 1 ? '':'none'}};">
                                            </div>
                                        </div>
                                        <div class="row mb-5">
                                            <div class="col-md-4">
                                                <label class="form-label">Alat Bantu </label>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="d-flex justify-content-start">
                                                    <div class="form-check form-check-custom form-check-solid">
                                                        <input class="form-check-input" {{ $alat_bantu->alat_bantu == 0 ?'checked':''}} type="radio" value="0"
                                                            id="riwayat-1" name="alat_bantu">
                                                        <label class="form-check-label" for="flexRadioDefault">
                                                            Tidak
                                                        </label>
                                                    </div>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-custom form-check-solid">
                                                        <input class="form-check-input"  {{ $alat_bantu->alat_bantu == 1 ?'checked':''}} type="radio" value="1"
                                                            id="riwayat-1" name="alat_bantu">
                                                        <label class="form-check-label" for="flexRadioDefault">
                                                            Ya
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="value_alat_bantu" id="value_alat_bantu"
                                                    class="form-control"value="{{ $alat_bantu->value_alat_bantu }}" placeholder="...."
                                                    style="display:  {{ $alat_bantu->alat_bantu == 0 ? 'none':''}};">
                                            </div>
                                        </div>
                                        <div class="row mb-5">
                                            <div class="col-md-4">
                                                <label class="form-label">Riwayat Jatuh</label>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="d-flex justify-content-start">
                                                    <div class="form-check form-check-custom form-check-solid">
                                                        <input class="form-check-input" {{ $riwayat_jatuh->riwayat_jatuh == 0 ?'checked':''}}  type="radio" value="0"
                                                            id="riwayat-1" name="riwayat_jatuh">
                                                        <label class="form-check-label" for="flexRadioDefault">
                                                            Tidak
                                                        </label>
                                                    </div>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <div class="form-check form-check-custom form-check-solid">
                                                        <input class="form-check-input"  {{ $riwayat_jatuh->riwayat_jatuh == 1 ?'checked':''}} type="radio" value="1"
                                                            id="riwayat-1" name="riwayat_jatuh">
                                                        <label class="form-check-label" for="flexRadioDefault">
                                                            Ya
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="value_riwayat_jatuh" id="value_riwayat_jatuh"
                                                    class="form-control"value="{{ $riwayat_jatuh->value_riwayat_jatuh }}" placeholder="...."
                                                    style="display: {{ $riwayat_jatuh->riwayat_jatuh == 0 ?'none':''}};">
                                            </div>
                                        </div>
                                        <div class="separator separator-dashed border-secondary mb-5"></div>
                                        <div class="row mb-5">
                                            <div class="col-md-12">
                                                <label class="form-label">Pemeriksaan Umum</label>
                                                <textarea required name="pemeriksaan_umum" id="" class="form-control" rows=3>{{ $asesmen->pemeriksaan_umum }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-5">
                                            <div class="col-md-12">
                                                <label class="form-label">Pemeriksaan Khusus : (MMT, LGS, Kognitif, Asworth
                                                    Scale, Tes Sendi, dll)</label>
                                                <textarea required name="pemeriksaan_khusus" id="" class="form-control" rows=3>{{ $asesmen->pemeriksaan_khusus }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-5">
                                            <div class="col-md-12">
                                                <label class="form-label">Pemeriksaan Penunjang : (Radiologi, EKG, Lab,
                                                    EMG,dll)</label>
                                                <textarea required name="pemeriksaan_penunjang" id="" class="form-control" rows=3>{{ $asesmen->pemeriksaan_penunjang }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row p-lg-5">
                                <div class="card card-bordered">
                                    <div class="card-body">
                                        <div class="col-md-12">
                                            <label class="form-label">Diagnosis Fisioterapi</label>
                                            <textarea required name="diagnosis_fisio" id="" class="form-control" rows=3>{{ $asesmen->diagnosis_fisio_terapi }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-lg-5">
                                <div class="card card-bordered">
                                    <div class="card-body">
                                        <div class="col-md-12">
                                            <label class="form-label">Program/Rencana Terapi : (Tujuan, Modalitas,
                                                Frekuensi)</label>
                                            <textarea required name="program_rencana" id="" class="form-control" rows=5>{{ $asesmen->program_rencana }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-lg-5">
                                <div class="card card-bordered">
                                    <div class="card-body">
                                        <div class="col-md-12">
                                            <label class="form-label">Evaluasi</label>
                                            <textarea required name="evaluasi" id="" class="form-control" rows=5>{{ $asesmen->evaluasi }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success mt-10">Simpan</button>
                        </form>
                    </div>
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
        function calculateBMI() {
            // alert($('#tinggi_badan').val())
            // Ambil nilai tinggi dan berat badan dari input
            var height = parseFloat($('#tinggi_badan_val').val()) || 0;
            var weight = parseFloat($('#berat_badan_val').val()) || 0;

            // Hitung BMI
            var bmi = weight / ((height / 100) * (height / 100));
            // alert(bmi)
            // Tampilkan hasil BMI
            $('#bmi_val').val(bmi.toFixed(2));
        }
        $(function() {

            $('input[type=radio][name="kemampuan"]').change(function() {
                if ($(this).val() == '1') {
                    $('#value_kemampuan').show();
                } else {
                    $('#value_kemampuan').val("");
                    $('#value_kemampuan').hide();
                }
            })
            $('input[type=radio][name="alat_bantu"]').change(function() {
                if ($(this).val() == '1') {
                    $('#value_alat_bantu').show();
                } else {
                    $('#value_alat_bantu').val("");
                    $('#value_alat_bantu').hide();
                }
            })
            $('input[type=radio][name="riwayat_jatuh"]').change(function() {
                if ($(this).val() == '1') {
                    $('#value_riwayat_jatuh').show();
                } else {
                    $('#value_riwayat_jatuh').val("");
                    $('#value_riwayat_jatuh').hide();
                }
            })

            $("#frmAsesmen").on("submit", function(event) {
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
