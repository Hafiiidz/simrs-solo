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
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Tambah
                            Rekam Medis Pasien</h1>
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
                <div class="card shadow-sm">
                    <div class="card-header">
                        <div class="card-title">
                            <h5 class="card-title">Rekam Medis Pasien</h5>
                        </div>
                        <div class="card-toolbar">
                            <a href="{{ route('rekam-medis-poli', $data->idrawat) }}"
                                class="btn btn-sm btn-secondary">Kembali</a>
                        </div>
                    </div>
                    <!--begin::Body-->
                    <div class="card-body p-lg-10">
                        <form action="{{ route('detail-rekap-medis-store', $data->id) }}" method="post" autocomplete="off"
                            id="frm-data">
                            @csrf
                            <input type="hidden" name="kategori" value="{{ $kategori->id }}">
                            <div
                                class="alert alert-dismissible bg-light-success border border-success border-3 border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                                <!--begin::Icon-->
                                <i class="ki-duotone ki-pulse fs-2hx text-success me-4 mb-5 mb-sm-0"><span
                                        class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                <!--end::Icon-->

                                <!--begin::Content-->
                                <div class="d-flex flex-column justify-content-center">
                                    {{-- <h2 class="mb-1">{{ $kategori->nama }}</h2> --}}
                                </div>
                                <!--end::Content-->
                            </div>
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
                            <div class="row">
                                <div class="row mb-3">
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-4">{{ $pasien->nama_pasien }}</span>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <!--begin::Label-->
                                    <label class="col-lg-2 fw-semibold text-muted">NIK</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800">{{ $pasien->nik }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-5">
                                    <!--begin::Label-->
                                    <label class="col-lg-2 fw-semibold text-muted">No BPJS</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800">{{ $pasien->no_bpjs }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-5">
                                    <!--begin::Label-->
                                    <label class="col-lg-2 fw-semibold text-muted">No Handphone</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800">{{ $pasien->nohp }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-5">
                                    <!--begin::Label-->
                                    <label class="col-lg-2 fw-semibold text-muted">Alamat</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800">{{ $pasien->alamat->alamat }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                            </div>
                            <div class="separator separator-dashed border-secondary mb-5"></div>
                            @if ($rawat->idjenisrawat == 3)
                            @if (auth()->user()->idpriv == 14 || auth()->user()->idpriv == 18 || auth()->user()->idpriv == 29)
                                    <div class="row mb-5">
                                        <div class="col-md-12">
                                            <label class="form-label fw-bold">Triase</label>
                                            <select class="form-select" name="triase" data-control="select2"
                                                data-placeholder="Select an option">
                                                <option></option>
                                                @foreach ($triase as $t)
                                                    <option class="red-option" value="{{ $t->id }}">
                                                        {{ $t->triase }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            @endif
                            @if (auth()->user()->idpriv == 7)
                                {{-- <div class="row mb-5">
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold">Kategori Penyakit</label>
                                        <select class="form-select" data-control="select2"
                                            data-placeholder="Select an option">
                                            <option></option>
                                            @foreach ($kategori_diagnosa as $kd)
                                                <option value="{{ $kd->id }}">{{ $kd->jenisdiagnosa }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                            @endif
                            @if (auth()->user()->idpriv == 7)
                                <div class="row mb-5">
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold">Diagnosa</label>
                                        <textarea name="diagnosa" rows="3" class="form-control" placeholder="..."></textarea>
                                    </div>
                                    {{-- <div class="col-md-12">
                                        <div id="icdx_repeater">
                                            <!--begin::Form group-->
                                            <div class="form-group">
                                                <div data-repeater-list="icdx">
                                                    <div data-repeater-item>
                                                        <div class="form-group row mb-5">
                                                            <div class="col-md-6">
                                                                <label class="form-label">ICD X</label>
                                                                <select name="diagnosa_icdx" class="form-select"
                                                                    data-kt-repeater="select22" data-placeholder="-Pilih-"
                                                                    required>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label class="form-label">Jenis Diagnosa</label>
                                                                <div class="input-group mb-5">
                                                                    <select name="jenis_diagnosa" required
                                                                        class="form-select" id="">
                                                                        <option value="P" selected>Primer</option>
                                                                        <option value="S">Sekunder</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <a href="javascript:;" data-repeater-delete
                                                                    class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                                    <i class="ki-duotone ki-trash fs-5"><span
                                                                            class="path1"></span><span
                                                                            class="path2"></span><span
                                                                            class="path3"></span><span
                                                                            class="path4"></span><span
                                                                            class="path5"></span></i>
                                                                    Hapus
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Form group-->

                                            <!--begin::Form group-->
                                            <div class="form-group mt-5">
                                                <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                                    <i class="ki-duotone ki-plus fs-3"></i>
                                                    Tambah ICD X
                                                </a>
                                            </div>
                                            <!--end::Form group-->
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-bold">Tindakan / Prosedur</label>
                                    <textarea name="tindakan_prc" rows="3" class="form-control" placeholder="..."></textarea>
                                </div>
                                {{-- <div class="row mb-5">
                                    <div class="col-md-12">
                                        <div id="icd9_repeater">
                                            <!--begin::Form group-->
                                            <div class="form-group">
                                                <div data-repeater-list="icd9">
                                                    <div data-repeater-item>
                                                        <div class="form-group row mb-5">
                                                            <div class="col-md-6">
                                                                <label class="form-label">ICD 9</label>
                                                                <select name="diagnosa_icd9" class="form-select"
                                                                    data-kt-repeater="select2icd9"
                                                                    data-placeholder="-Pilih-" required>
                                                                </select>
                                                            </div>


                                                            <div class="col-md-4">
                                                                <a href="javascript:;" data-repeater-delete
                                                                    class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                                    <i class="ki-duotone ki-trash fs-5"><span
                                                                            class="path1"></span><span
                                                                            class="path2"></span><span
                                                                            class="path3"></span><span
                                                                            class="path4"></span><span
                                                                            class="path5"></span></i>
                                                                    Hapus
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Form group-->

                                            <!--begin::Form group-->
                                            <div class="form-group mt-5">
                                                <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                                    <i class="ki-duotone ki-plus fs-3"></i>
                                                    Tambah ICD 9
                                                </a>
                                            </div>
                                            <!--end::Form group-->
                                        </div>
                                    </div>
                                </div> --}}
                            @endif
                            <!--begin::Underline-->
                            <span class="d-inline-block position-relative mb-7">
                                <!--begin::Label-->
                                <span class="d-inline-block mb-2 fs-4 fw-bold">
                                    Anamnesa & Pemeriksaan Fisik
                                </span>
                                <!--end::Label-->

                                <!--begin::Line-->
                                <span
                                    class="d-inline-block position-absolute h-5px bottom-0 end-0 start-0 bg-success translate rounded"></span>
                                <!--end::Line-->
                            </span>
                            @if (auth()->user()->idpriv == 7)
                                <div class="row mb-5">
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold">Anamnesa</label>
                                        <textarea name="anamnesa_dokter" rows="3" class="form-control" placeholder="Anamnesa Dokter"></textarea>
                                    </div>
                                </div>
                                @if ($rawat->idjenisrawat == 3)
                                <div class="row mb-5">
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold">Pemeriksaan Fisik</label>
                                        <textarea name="pemeriksaan_fisik" rows="3" class="form-control" placeholder="Pemeriksaan Fisik"></textarea>
                                    </div>
                                </div>
                                @endif
                                @if ($rawat->idpoli == 12)
                                    <div class="row mb-5">
                                        <div class="col-md-12">
                                            <label class="form-label fw-bold">Pemeriksaan Fisik</label>
                                            <textarea name="pemeriksaan_fisik" rows="3" class="form-control" placeholder="Pemeriksaan Fisik"></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-12">
                                            <label class="form-label fw-bold">Pemeriksaan Uji Fungsi</label>
                                            <textarea name="pemeriksaan_uji_fungsi" rows="3" class="form-control" placeholder="Pemeriksaan Uji Fungsi"></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-12">
                                            <label class="form-label fw-bold">Tata Laksanan KFR (ICD ) CM </label>
                                            <textarea name="tata_laksana" rows="3" class="form-control" placeholder="Tata Laksana"></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-12">
                                            <label class="form-label fw-bold">Anjuran</label>
                                            <textarea name="anjuran" rows="3" class="form-control" placeholder="Anjuran"></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-12">
                                            <label class="form-label fw-bold">Evaluasi</label>
                                            <textarea name="evaluasi" rows="3" class="form-control" placeholder="Evaluasi"></textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-5">
                                        <!--begin::Repeater-->
                                        <div id="fisio_repeater">
                                            <!--begin::Form group-->
                                            <div class="form-group">
                                                <div data-repeater-list="fisio">
                                                    <div data-repeater-item>
                                                        <div class="form-group row mb-5">
                                                            <div class="col-md-6">
                                                                <label class="form-label">Permintaan Terapi</label>
                                                                {{-- <input type="text" name='tindakan_fisio' class="form-control" required> --}}
                                                                <select name="tindakan_fisio" class="form-select"
                                                                    data-kt-repeater="select2fisio"
                                                                    data-placeholder="-Pilih-" required>
                                                                    <option></option>
                                                                    @foreach ($fisio as $fisio)
                                                                        <option value="{{ $fisio->id }}">
                                                                            {{ $fisio->nama_tarif }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <a href="javascript:;" data-repeater-delete
                                                                    class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                                    <i class="ki-duotone ki-trash fs-5"><span
                                                                            class="path1"></span><span
                                                                            class="path2"></span><span
                                                                            class="path3"></span><span
                                                                            class="path4"></span><span
                                                                            class="path5"></span></i>
                                                                    Hapus
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Form group-->

                                            <!--begin::Form group-->
                                            <div class="form-group mt-5">
                                                <a href="javascript:;" data-repeater-create class="btn btn-light-info">
                                                    <i class="ki-duotone ki-plus fs-3"></i>
                                                    Tambah Terapi Fisio
                                                </a>
                                            </div>
                                            <!--end::Form group-->
                                        </div>
                                        <!--end::Repeater-->
                                    </div>
                                @endif
                            @endif

                            <!--end::Underline-->
                            @if (auth()->user()->idpriv == 14 || auth()->user()->idpriv == 18 || auth()->user()->idpriv == 29)
                                <div class="row mb-5">
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold">Anamnesa</label>
                                        <textarea name="anamnesa" rows="3" class="form-control" placeholder="Alasan Masuk Rumah Sakit"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold">Obat Yang Dikonsumsi</label>
                                        <textarea name="obat_yang_dikonsumsi" rows="3" class="form-control" placeholder="...."></textarea>
                                    </div>
                                </div>
                                <div class="row mb-5 p-lg-5">
                                    <div class="card card-bordered">
                                        <div class="card-header">
                                            <h5 class="card-title">Alergi</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row mb-5">
                                                <div class="col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="obat"
                                                            id="obat" />
                                                        <label class="form-check-label" for="obat">
                                                            Obat
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="text" name="value_obat" id="value_obat"
                                                        class="form-control" placeholder="...." style="display: none;">
                                                </div>
                                            </div>
                                            <div class="row mb-5">
                                                <div class="col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="makanan"
                                                            id="makanan" />
                                                        <label class="form-check-label" for="makanan">
                                                            Makanan
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="text" name="value_makanan" id="value_makanan"
                                                        class="form-control" placeholder="...." style="display: none;">
                                                </div>
                                            </div>
                                            <div class="row mb-5">
                                                <div class="col-md-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="lain"
                                                            id="lain" />
                                                        <label class="form-check-label" for="lain">
                                                            Lain - Lain
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-10">
                                                    <input type="text" name="value_lain" id="value_lain"
                                                        class="form-control" placeholder="...." style="display: none;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold">Pasien Dalam Kondisi Tertentu</label>
                                        <input name="pasien_sedang" rows="3" class="form-control"
                                            placeholder="....">
                                    </div>
                                </div>
                                <div class="row mb-5 p-lg-5">
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
                                                            placeholder="...." aria-label="...."
                                                            aria-describedby="tdarah" />
                                                        <span class="input-group-text" id="tdarah">mmHg</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Nadi</label>
                                                    <div class="input-group mb-5">
                                                        <input type="text" class="form-control" name="nadi"
                                                            placeholder="...." aria-label="...."
                                                            aria-describedby="nadi" />
                                                        <span class="input-group-text" id="nadi">x/Menit</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Pernapasan</label>
                                                    <div class="input-group mb-5">
                                                        <input type="text" class="form-control" name="pernapasan"
                                                            placeholder="...." aria-label="...."
                                                            aria-describedby="pernapasan" />
                                                        <span class="input-group-text" id="pernapasan">x/Menit</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row md-5">
                                                <div class="col-md-4">
                                                    <label class="form-label">Suhu</label>
                                                    <div class="input-group mb-5">
                                                        <input type="text" class="form-control" name="suhu"
                                                            placeholder="...." aria-label="...."
                                                            aria-describedby="suhu" />
                                                        <span class="input-group-text" id="suhu">Derajat</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Berat Badan</label>
                                                    <div class="input-group mb-5">
                                                        <input type="text" class="form-control"
                                                            onkeyup="calculateBMI()" id="berat_badan_val"
                                                            name="berat_badan" placeholder="...." aria-label="...."
                                                            aria-describedby="berat_badan" />
                                                        <span class="input-group-text" id="berat_badan">Kg</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Tinggi Badan</label>
                                                    <div class="input-group mb-5">
                                                        <input type="text" class="form-control"
                                                            onkeyup="calculateBMI()" id="tinggi_badan_val"
                                                            name="tinggi_badan" placeholder="...." aria-label="....e"
                                                            aria-describedby="tinggi_badan" />
                                                        <span class="input-group-text" id="tinggi_badan">Cm</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row col-md-4">
                                                <label class="form-label">BMI</label>
                                                <div class="input-group mb-5">
                                                    <input type="text" class="form-control" id='bmi_val'
                                                        name="bmi" placeholder="...." aria-label="....e"
                                                        aria-describedby="bmi" />
                                                    <span class="input-group-text" id="bmi">Kg/M2</span>
                                                </div>
                                            </div>
                                            <div class="row col-md-4">
                                                <label class="form-label">saturasi oksigen (SpO2) </label>
                                                <div class="input-group mb-5">
                                                    <input type="text" class="form-control"
                                                        name="spo2" placeholder="...." aria-label="....e"
                                                        aria-describedby="spo2" />
                                                    <span class="input-group-text" id="bmi">%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-5 p-lg-5">
                                    <div class="card card-bordered">
                                        <div class="card-header">
                                            <h5 class="card-title">Riwayat Kesehatan</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row mb-5">
                                                <div class="col-md-4">
                                                    <label class="form-label">Riwayat penyakit yang lalu</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="d-flex justify-content-start">
                                                        <div class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="radio" value="1"
                                                                id="riwayat-1" name="riwayat_1" />
                                                            <label class="form-check-label" for="flexRadioDefault">
                                                                Ya
                                                            </label>
                                                        </div>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                        <div class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="radio" value="5"
                                                                id="riwayat-1" name="riwayat_1" />
                                                            <label class="form-check-label" for="flexRadioDefault">
                                                                Tidak
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" name="value_riwayat_1" id="value_riwayat_1"
                                                        class="form-control" placeholder="...." style="display: none;">
                                                </div>
                                            </div>
                                            <div class="separator separator-dashed border-secondary mb-5"></div>
                                            <div class="row mb-5">
                                                <div class="col-md-4">
                                                    <label class="form-label">Pernah dirawat</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="d-flex justify-content-start">
                                                        <div class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="radio" value="1"
                                                                id="riwayat-2" name="riwayat_2" />
                                                            <label class="form-check-label" for="flexRadioDefault">
                                                                Ya
                                                            </label>
                                                        </div>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                        <div class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="radio" value="0"
                                                                id="riwayat-2" name="riwayat_2" />
                                                            <label class="form-check-label" for="flexRadioDefault">
                                                                Tidak
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" name="value_riwayat_2" id="value_riwayat_2"
                                                        class="form-control" placeholder="...." style="display: none;">
                                                </div>
                                            </div>
                                            <div class="separator separator-dashed border-secondary mb-5"></div>
                                            <div class="row mb-5">
                                                <div class="col-md-4">
                                                    <label class="form-label">Pernah dioperasi</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="d-flex justify-content-start">
                                                        <div class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="radio" value="1"
                                                                id="riwayat-3" name="riwayat_3" />
                                                            <label class="form-check-label" for="flexRadioDefault">
                                                                Ya
                                                            </label>
                                                        </div>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                        <div class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="radio" value="0"
                                                                id="riwayat-3" name="riwayat_3" />
                                                            <label class="form-check-label" for="flexRadioDefault">
                                                                Tidak
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" name="value_riwayat_3" id="value_riwayat_3"
                                                        class="form-control" placeholder="...." style="display: none;">
                                                </div>
                                            </div>
                                            <div class="separator separator-dashed border-secondary mb-5"></div>
                                            <div class="row mb-5">
                                                <div class="col-md-4">
                                                    <label class="form-label">Dalam pengobatan khusus</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="d-flex justify-content-start">
                                                        <div class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="radio" value="1"
                                                                id="riwayat-4" name="riwayat_4" />
                                                            <label class="form-check-label" for="flexRadioDefault">
                                                                Ya
                                                            </label>
                                                        </div>
                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                        <div class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="radio" value="0"
                                                                id="riwayat-4" name="riwayat_4" />
                                                            <label class="form-check-label" for="flexRadioDefault">
                                                                Tidak
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" name="value_riwayat_4" id="value_riwayat_4"
                                                        class="form-control" placeholder="...." style="display: none;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if (auth()->user()->idpriv == 7)
                                <!--begin::Underline-->
                                <span class="d-inline-block position-relative mb-7">
                                    <!--begin::Label-->
                                    <span class="d-inline-block mb-2 fs-4 fw-bold">
                                        Rencana Pemeriksaan
                                    </span>
                                    <!--end::Label-->

                                    <!--begin::Line-->
                                    <span
                                        class="d-inline-block position-absolute h-5px bottom-0 end-0 start-0 bg-success translate rounded"></span>
                                    <!--end::Line-->
                                </span>
                                <!--end::Underline-->
                                <div class="row mb-5">
                                    <!--begin::Repeater-->
                                    <div id="radiologi_repeater">
                                        <!--begin::Form group-->
                                        <div class="form-group">
                                            <div data-repeater-list="radiologi">
                                                <div data-repeater-item>
                                                    <div class="form-group row mb-5">
                                                        <div class="col-md-6">
                                                            <label class="form-label">Tindakan Radiologi</label>
                                                            <select name="tindakan_rad" class="form-select"
                                                                data-kt-repeater="select2radiologi"
                                                                data-placeholder="-Pilih-" required>
                                                                <option></option>
                                                                @foreach ($radiologi as $rad)
                                                                    <option value="{{ $rad->id }}">
                                                                        {{ $rad->nama_tindakan }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <label class="form-label" for="">Klinis</label>
                                                            <input type="text" name="klinis" required  class="form-control" id="">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <a href="javascript:;" data-repeater-delete
                                                                class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                                <i class="ki-duotone ki-trash fs-5"><span
                                                                        class="path1"></span><span
                                                                        class="path2"></span><span
                                                                        class="path3"></span><span
                                                                        class="path4"></span><span
                                                                        class="path5"></span></i>
                                                                Hapus
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Form group-->

                                        <!--begin::Form group-->
                                        <div class="form-group mt-5">
                                            <a href="javascript:;" data-repeater-create class="btn btn-light-success">
                                                <i class="ki-duotone ki-plus fs-3"></i>
                                                Tambah Radiologi
                                            </a>
                                        </div>
                                        <!--end::Form group-->
                                    </div>
                                    <!--end::Repeater-->
                                </div>
                                <div class="row mb-5">
                                    <!--begin::Repeater-->
                                    <div id="lab_repeater">
                                        <!--begin::Form group-->
                                        <div class="form-group">
                                            <div data-repeater-list="lab">
                                                <div data-repeater-item>
                                                    <div class="form-group row mb-5">
                                                        <div class="col-md-6">
                                                            <label class="form-label">Tindakan Lab</label>
                                                            <select name="tindakan_lab" class="form-select"
                                                                data-kt-repeater="select2lab" data-placeholder="-Pilih-"
                                                                required>
                                                                <option></option>
                                                                @foreach ($lab as $lab)
                                                                    <option value="{{ $lab->id }}">
                                                                        {{ $lab->nama_pemeriksaan }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <a href="javascript:;" data-repeater-delete
                                                                class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                                <i class="ki-duotone ki-trash fs-5"><span
                                                                        class="path1"></span><span
                                                                        class="path2"></span><span
                                                                        class="path3"></span><span
                                                                        class="path4"></span><span
                                                                        class="path5"></span></i>
                                                                Hapus
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Form group-->

                                        <!--begin::Form group-->
                                        <div class="form-group mt-5">
                                            <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                                <i class="ki-duotone ki-plus fs-3"></i>
                                                Tambah Lab
                                            </a>
                                        </div>
                                        <!--end::Form group-->
                                    </div>
                                    <!--end::Repeater-->
                                </div>
                                @if ($rawat->idpoli == 12)
                                @endif
                                <div class="row mb-5">
                                    <div class="col-md-12">
                                        <textarea name="rencana_pemeriksaan" rows="3" class="form-control"
                                            placeholder="Hasil Pemeriksaan Penunjang (yang relevan dengan diagnosis dan terapi)"></textarea>
                                    </div>
                                </div>
                                <!--begin::Underline-->
                                <span class="d-inline-block position-relative mb-7">
                                    <!--begin::Label-->
                                    <span class="d-inline-block mb-2 fs-4 fw-bold">
                                        Terapi
                                    </span>
                                    <!--end::Label-->

                                    <!--begin::Line-->
                                    <span
                                        class="d-inline-block position-absolute h-5px bottom-0 end-0 start-0 bg-success translate rounded"></span>
                                    <!--end::Line-->
                                </span>
                                <!--end::Underline-->
                                <div class="row mb-5">
                                    {{-- <table class="table table-bordered fs-9 gs-2 gy-2 gx-2" id="kt_docs_repeater_basic">
                                        <thead class="text-center align-middle">
                                            <tr>
                                                <th rowspan="2">Nama Obat</th>
                                                <th rowspan="2" width=100>Jumlah</th>
                                                <th rowspan="2" width=100>Dosis</th>
                                                <th rowspan="2" width=200>Takaran</th>
                                                <th width=50 colspan="3">Signa</th>
                                                <th rowspan="2" width=100>Diminum</th>
                                                <th rowspan="2" width=100>Catatan</th>
                                                <th rowspan="2">Aksi</th>
                                            </tr>
                                            <tr>
                                                <th width=10>P</th>
                                                <th width=10>S</th>
                                                <th width=10>M</th>
                                            </tr>
                                    
                                        </thead>
                                        <tbody data-repeater-list="terapi_obat" class="align-middle">
                                            <tr data-repeater-item>
                                                <td>
                                                    <select name="obat" multiple="multiple" class="form-select form-select-sm" data-kt-repeater="select2"
                                                        data-placeholder="-Pilih-" required>
                                                        @foreach ($obat as $val)
                                                        <option value="{{ $val->id }}">
                                                            {{ $val->nama_obat }} - {{ $val->satuan->satuan }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" name="jumlah_obat" step=".01" class="form-control form-control-sm mb-2 mb-md-0"
                                                        data-kt-repeater="tagify" min="0" required>
                                                </td>
                                                <td>
                                                    <input type="text" name="dosis_obat"  placeholder="dosis"
                                                        class="form-control form-control-sm  mb-2 mb-md-0" min="0">
                                                </td>
                                                <td>
                                                    <select name="takaran_obat" required class="form-select form-select-sm">
                                                        <option value="">Pilih Takaran</option>
                                                        <option value="tablet">tablet</option>
                                                        <option value="kapsul">kapsul</option>
                                                        <option value="bungkus">bungkus</option>
                                                        <option value="tetes">tetes</option>
                                                        <option value="ml">ml</option>
                                                        <option value="sendok takar 5ml">sendok takar 5ml</option>
                                                        <option value="sendok takar 15ml">sendok takar 15ml</option>
                                                        <option value="Oles">Oles</option>
                                                    </select>
                                    
                                                </td>
                                                <td class="text-center align-middle"><input name="diminum" class="form-check-input form-check-input-sm" type="checkbox"
                                                        value="P" id="flexCheckDefault" /></td>
                                                <td class="text-center align-middle"><input class="form-check-input form-check-input-sm" type="checkbox"
                                                        value="S" name="diminum" id="flexCheckDefault" /></td>
                                                <td class="text-center align-middle"><input class="form-check-input form-check-input-sm" type="checkbox"
                                                        value="M" name="diminum" id="flexCheckDefault" /></td>
                                                <td>
                                                    <div class="form-check form-check-inline mb-2">
                                                        <input class="form-check-input" type="radio" name="takaran" id="tablet" value="sebelum">
                                                        <label class="form-check-label" for="tablet">Sebelum</label>
                                                    </div>
                                    
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="takaran" id="kapsul" value="sesudah">
                                                        <label class="form-check-label" for="kapsul">Sesudah</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" name="catatan" class="form-control form-control-sm mb-2 mb-md-0" min="0">
                                                </td>
                                                <td>
                                                    <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger">
                                                        <i class="ki-duotone ki-trash fs-5">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                            <span class="path4"></span>
                                                            <span class="path5"></span>
                                                        </i>
                                                    </a>
                                                </td>
                                            </tr>
                                    
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td><a href="javascript:;" data-repeater-create class="btn btn-sm btn-light-primary">
                                                        <i class="ki-duotone ki-plus fs-3"></i>
                                                        Tambah Obat
                                                    </a></td>
                                            </tr>
                                        </tfoot>
                                    </table> --}}
                                    <!--begin::Repeater-->
                                    {{-- <div id="kt_docs_repeater_basic">
                                        <!--begin::Form group-->
                                        <div class="form-group">
                                            <div data-repeater-list="terapi_obat">
                                                <div data-repeater-item>
                                                    <div class="form-group row mb-5">
                                                        <div class="col-md-8">
                                                            <div class="inner-repeater">
                                                                <div data-repeater-list="terapi_obat_racikan"
                                                                    class="">
                                                                    <div data-repeater-item>
                                                                        <div class="row">
                                                                            <div class="col-md-8">
                                                                                <label class="form-label">Obat</label>
                                                                                <select name="obat" class="form-select"
                                                                                    data-kt-repeater="select2"
                                                                                    data-placeholder="-Pilih-" required>
                                                                                    <option></option>
                                                                                    @foreach ($obat as $val)
                                                                                        <option
                                                                                            value="{{ $val->id }}">
                                                                                            {{ $val->nama_obat }}
                                                                                            - {{ $val->satuan->satuan }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <label class="form-label">Jumlah</label>
                                                                                <div class="input-group pb-3">

                                                                                    <input type="number"
                                                                                        name="jumlah_obat" step=".01"
                                                                                        class="form-control mb-5 mb-md-0"
                                                                                        min="0" required>
                                                                                        <input type="text"
                                                                                            name="dosis_obat" placeholder="dosis"
                                                                                            class="form-control mb-5 mb-md-0"
                                                                                            min="0" >
                                                                                    <button
                                                                                        class="border border-secondary input-group-text btn btn-icon btn-flex btn-light-danger"
                                                                                        data-repeater-delete
                                                                                        type="button">
                                                                                        <i
                                                                                            class="ki-duotone ki-trash fs-5"><span
                                                                                                class="path1"></span><span
                                                                                                class="path2"></span><span
                                                                                                class="path3"></span><span
                                                                                                class="path4"></span><span
                                                                                                class="path5"></span></i>
                                                                                    </button>
                                                                                </div>
                                                                                
                                                                            </div>
                                                                        </div>

                                                                    </div>



                                                                </div>
                                                                <button class="btn btn-sm btn-flex btn-light-success"
                                                                    data-repeater-create type="button">
                                                                    <i class="ki-duotone ki-plus fs-5"></i>
                                                                    Tambah Racikan
                                                                </button>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">Signa</label>
                                                            <div class="input-group mb-5">
                                                                <input type="text" class="form-control" name='signa1'
                                                                    placeholder="...." aria-label="Username">
                                                                <span class="input-group-text">-</span>
                                                                <input type="text" class="form-control" name='signa2'
                                                                    placeholder="...." aria-label="Server">
                                                                <span class="input-group-text">-</span>
                                                                <input type="text" class="form-control" name='signa3'
                                                                    placeholder="...." aria-label="Server">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <a href="javascript:;" data-repeater-delete
                                                                class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                                <i class="ki-duotone ki-trash fs-5"><span
                                                                        class="path1"></span><span
                                                                        class="path2"></span><span
                                                                        class="path3"></span><span
                                                                        class="path4"></span><span
                                                                        class="path5"></span></i>
                                                                Hapus
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Form group-->

                                        <!--begin::Form group-->
                                        <div class="form-group mt-5">
                                            <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                                <i class="ki-duotone ki-plus fs-3"></i>
                                                Tambah Obat
                                            </a>
                                        </div>
                                        <!--end::Form group-->
                                    </div> --}}
                                    <!--end::Repeater-->
                                </div>
                                {{-- <div class="row">
                                    <div class="col-md-12">
                                        <textarea name="terapi" data-kt-autosize="true" rows="3" class="form-control"
                                            placeholder="Tindakan , Rehabilitasi dan Diet"></textarea>
                                    </div>
                                </div> --}}
                            @endif
                    </div>
                    <!--end::Body-->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-md btn-success">Simpan</button>
                        </form>
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

            alergi();
            riwayat_kesehatan();
            calculateBMI();
            $("#frm-data").on("submit", function(event) {
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

            $('#kt_docs_repeater_basic').repeater({
                initEmpty: true,

                repeaters: [{
                    selector: '.inner-repeater',
                    show: function() {
                        $(this).slideDown();
                        $(this).find('[data-kt-repeater="select2"]').select2();
                    },

                    hide: function(deleteElement) {
                        $(this).slideUp(deleteElement);
                    }
                }],
                show: function() {
                    $(this).slideDown();

                    $(this).find('[data-kt-repeater="select2"]').select2();
                    new Tagify(this.querySelector('[data-kt-repeater="tagify"]'));
                },

                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                },

                ready: function() {
                    $('[data-kt-repeater="select2"]').select2();
                    new Tagify(document.querySelector('[data-kt-repeater="tagify"]'));

                }
            });

            $('#radiologi_repeater').repeater({
                initEmpty: true,

                show: function() {
                    $(this).slideDown();

                    $(this).find('[data-kt-repeater="select2radiologi"]').select2();
                },

                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                },

                ready: function() {
                    $('[data-kt-repeater="select2radiologi"]').select2();
                }
            });

            $('#icd9_repeater').repeater({
                initEmpty: true,

                show: function() {
                    $(this).slideDown();

                    $(this).find('[data-kt-repeater="select2icd9"]').select2({
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
                        placeholder: 'Search for a user...'
                    });
                },

                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                },

                ready: function() {
                    $('[data-kt-repeater="select2icd9"]').select2({
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
                        placeholder: 'Search for a user...'
                    });
                }
            });

            $('#lab_repeater').repeater({
                initEmpty: true,

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
            @if ($rawat->idpoli == 12)
                $('#fisio_repeater').repeater({
                    initEmpty: true,

                    show: function() {
                        $(this).slideDown();

                        $(this).find('[data-kt-repeater="select2fisio"]').select2();
                    },

                    hide: function(deleteElement) {
                        $(this).slideUp(deleteElement);
                    },

                    ready: function() {
                        $('[data-kt-repeater="select2fisio"]').select2();
                    }
                });
            @endif
            $('#icdx_repeater').repeater({
                initEmpty: true,

                show: function() {
                    $(this).slideDown();

                    $(this).find('[data-kt-repeater="select22"]').select2({
                        ajax: {
                            url: 'https://new-simrs.rsausulaiman.com/auth/listdiagnosa2',
                            dataType: 'json',
                            delay: 250,
                            data: function(params) {

                                return {
                                    q: params.term, // search term
                                };
                            },
                            processResults: function(data) {
                                return {
                                    results: data.result.map(function(user) {
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
                        placeholder: 'Search for a user...'
                    });
                },

                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                },

                ready: function() {
                    $('[data-kt-repeater="select22"]').select2({
                        ajax: {
                            url: 'https://new-simrs.rsausulaiman.com/auth/listdiagnosa2',
                            dataType: 'json',
                            delay: 250,
                            data: function(params) {

                                return {
                                    q: params.term, // search term
                                };
                            },
                            processResults: function(data) {
                                return {
                                    results: data.result.map(function(user) {
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
                        placeholder: 'Search for a user...'
                    });
                }
            });


        });

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

        function riwayat_kesehatan() {
            $('input[type=radio][name="riwayat_1"]').change(function() {
                if ($(this).val() == '1') {
                    $('#value_riwayat_1').show();
                } else {
                    $('#value_riwayat_1').val("");
                    $('#value_riwayat_1').hide();
                }
            })
            $('input[type=radio][name="riwayat_2"]').change(function() {
                if ($(this).val() == '1') {
                    $('#value_riwayat_2').show();
                } else {
                    $('#value_riwayat_2').val("");
                    $('#value_riwayat_2').hide();
                }
            })
            $('input[type=radio][name="riwayat_3"]').change(function() {
                if ($(this).val() == '1') {
                    $('#value_riwayat_3').show();
                } else {
                    $('#value_riwayat_3').val("");
                    $('#value_riwayat_3').hide();
                }
            })
            $('input[type=radio][name="riwayat_4"]').change(function() {
                if ($(this).val() == '1') {
                    $('#value_riwayat_4').show();
                } else {
                    $('#value_riwayat_4').val("");
                    $('#value_riwayat_4').hide();
                }
            })
        }

        function alergi() {
            $('#obat').change(function() {
                if (this.checked) {
                    $('#value_obat').show();
                } else {
                    $('#value_obat').hide();
                }
            });

            $('#makanan').change(function() {
                if (this.checked) {
                    $('#value_makanan').show();
                } else {
                    $('#value_makanan').hide();
                }
            });

            $('#lain').change(function() {
                if (this.checked) {
                    $('#value_lain').show();
                } else {
                    $('#value_lain').hide();
                }
            });
        }

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
