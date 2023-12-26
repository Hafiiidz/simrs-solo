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
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Detail Gizi</h1>
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
                        <li class="breadcrumb-item text-muted">Gizi</li>
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
                        <h5 class="card-title">Data Gizi</h5>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ route('index.gizi') }}" class="btn btn-secondary btn-sm">Kembali</a>
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
                    <div class="rounded border p-5">
                        <div class="mb-5 hover-scroll-x">
                            <div class="d-grid">
                                <ul class="nav nav-tabs flex-nowrap text-nowrap">
                                    <li class="nav-item">
                                        <a class="nav-link active btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0" data-bs-toggle="tab" href="#kt_tab_pane_1">Skrining Awal Gizi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0" data-bs-toggle="tab" href="#kt_tab_pane_2">Asuhan Gizi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0" data-bs-toggle="tab" href="#kt_tab_pane_3">Evaluasi Asuhan Gizi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0" data-bs-toggle="tab" href="#kt_tab_pane_4">CPPT</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                                <div class="rounded border p-5">
                                    <form action="{{ route('store.skrining-gizi') }}" method="POST" autocomplete="off">
                                        @csrf
                                        <input type="hidden" name="idrawat" value="{{ $rawat->id }}">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="" class="form-label">
                                                    1. Apakah pasien mengalami penurunan berat badan yang tidak direncanakan / tidak diinginkan dalam 6 bulan terakhir ?
                                                </label>
                                                <div class="mt-5" style="margin-left: 20px;">
                                                    <div class="form-check form-check-custom form-check-solid form-check-sm ml-5">
                                                        <input class="form-check-input" type="radio" value="1" name="parameter_1" {{ ($skrining) ? ((json_decode($skrining?->skrining)->parameter_1 == 1) ? 'checked' : '') : '' }}/>
                                                        <label class="form-check-label">
                                                            Tidak ada penurunan berat badan
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="mt-5" style="margin-left: 20px;">
                                                    <div class="form-check form-check-custom form-check-solid form-check-sm ml-5">
                                                        <input class="form-check-input" type="radio" value="2" name="parameter_1" {{ ($skrining) ? ((json_decode($skrining?->skrining)->parameter_1 == 2) ? 'checked' : '') : '' }}/>
                                                        <label class="form-check-label">
                                                            Tidak yakin / tidak tahu / terasa baju lebih longgar
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="mt-5" style="margin-left: 20px;">
                                                    <div class="form-check form-check-custom form-check-solid form-check-sm ml-5">
                                                        <input class="form-check-input" type="radio" value="3" name="parameter_1" {{ ($skrining) ? ((json_decode($skrining?->skrining)->parameter_1 == 3) ? 'checked' : '') : '' }}/>
                                                        <label class="form-check-label">
                                                            Jika ya, berapa penurunan berat badan tersebut
                                                        </label>
                                                    </div>
                                                </div>
                                                <div id="frm-ya" class="mt-5" style="margin-left: 40px; display: none;">
                                                    <div class="mt-5" style="margin-left: 20px;">
                                                        <div class="form-check form-check-custom form-check-solid form-check-sm ml-5">
                                                            <input class="form-check-input" type="radio" value="1" name="ya" {{ ($skrining) ? ((json_decode($skrining?->skrining)->ya == 1) ? 'checked' : '') : '' }}/>
                                                            <label class="form-check-label">
                                                                1 – 5 kg
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="mt-5" style="margin-left: 20px;">
                                                        <div class="form-check form-check-custom form-check-solid form-check-sm ml-5">
                                                            <input class="form-check-input" type="radio" value="2" name="ya" {{ ($skrining) ? ((json_decode($skrining?->skrining)->ya == 2) ? 'checked' : '') : '' }}/>
                                                            <label class="form-check-label">
                                                                6 – 10 kg
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="mt-5" style="margin-left: 20px;">
                                                        <div class="form-check form-check-custom form-check-solid form-check-sm ml-5">
                                                            <input class="form-check-input" type="radio" value="3" name="ya" {{ ($skrining) ? ((json_decode($skrining?->skrining)->ya == 3) ? 'checked' : '') : '' }}/>
                                                            <label class="form-check-label">
                                                                11 – 15 kg
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="mt-5" style="margin-left: 20px;">
                                                        <div class="form-check form-check-custom form-check-solid form-check-sm ml-5">
                                                            <input class="form-check-input" type="radio" value="4" name="ya" {{ ($skrining) ? ((json_decode($skrining?->skrining)->ya == 4) ? 'checked' : '') : '' }}/>
                                                            <label class="form-check-label">
                                                                >15 kg
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-5 mb-5">
                                            <div class="col-md-12">
                                                <label for="" class="form-label">
                                                    2. Apakah asupan makan berkurang karena tidak nafsu makan ?
                                                </label>
                                                <div class="mt-5" style="margin-left: 20px;">
                                                    <div class="form-check form-check-custom form-check-solid form-check-sm ml-5">
                                                        <input class="form-check-input" type="radio" value="1" name="parameter_2" {{ ($skrining) ? ((json_decode($skrining?->skrining)->parameter_2== 1) ? 'checked' : '') : '' }}/>
                                                        <label class="form-check-label">
                                                            Tidak
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="mt-5" style="margin-left: 20px;">
                                                    <div class="form-check form-check-custom form-check-solid form-check-sm ml-5">
                                                        <input class="form-check-input" type="radio" value="2" name="parameter_2" {{ ($skrining) ? ((json_decode($skrining?->skrining)->parameter_2 == 2) ? 'checked' : '') : '' }}/>
                                                        <label class="form-check-label">
                                                            Ya
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row mt-5">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                                <div class="rounded border p-5">
                                    <form action="{{ route('store.asuhan-gizi') }}" method="POST" autocomplete="off">
                                        @csrf
                                        <input type="hidden" name="idrawat" id="" value="{{ $rawat->id }}">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="" class="form-label">Tanggal</label>
                                                <input class="form-control" placeholder="Pilih Tanggal" id="tanggal-asuhan" name="tanggal" data-bs-focus="false" value="{{ $asuhan->tanggal ?? '' }}" required/>
                                            </div>
                                            <div class="col-md-9">
                                                <label for="" class="form-label">Diagnosis Medis</label>
                                                <textarea name="diagnosis_medis" id="diagnosis_medis" rows="1" class="form-control" placeholder="Masukan Diagnosis">{{ $asuhan->diagnosis_medis ?? '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row mt-5 p-5">
                                            <div class="card card-bordered">
                                                <div class="card-header">
                                                    <h5 class="card-title">Antropometri</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row md-5">
                                                        <div class="col-md-4">
                                                            <label class="form-label">BB</label>
                                                            <div class="input-group mb-5">
                                                                <input type="text" class="form-control" name="bb"
                                                                    placeholder="...." value="@if($asuhan) {{ json_decode($asuhan->antropometri)->bb ?? '' }} @endif" />
                                                                <span class="input-group-text">kg</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">TB/PB</label>
                                                            <div class="input-group mb-5">
                                                                <input type="text" class="form-control" name="tb_pb"
                                                                    placeholder="...." value="@if($asuhan) {{ json_decode($asuhan->antropometri)->tb_pb ?? '' }} @endif" />
                                                                <span class="input-group-text">cm</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">IMT</label>
                                                            <div class="input-group mb-5">
                                                                <input type="text" class="form-control" name="imt"
                                                                    placeholder="...." value="@if($asuhan) {{ json_decode($asuhan->antropometri)->imt ?? '' }} @endif" />
                                                                <span class="input-group-text">kg/m2</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="form-label">LLA</label>
                                                            <div class="input-group mb-5">
                                                                <input type="text" class="form-control" name="lla"
                                                                    placeholder="...." value="@if($asuhan) {{ json_decode($asuhan->antropometri)->lla ?? '' }} @endif" />
                                                                <span class="input-group-text">cm</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">RL</label>
                                                            <div class="input-group mb-5">
                                                                <input type="text" class="form-control" name="rl"
                                                                    placeholder="...." value="@if($asuhan) {{ json_decode($asuhan->antropometri)->rl ?? '' }} @endif" />
                                                                <span class="input-group-text">cm</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-md-12">
                                                <label for="" class="form-label">Biokimia Terkait Gizi</label>
                                                <textarea name="biokimia" id="biokimia" rows="1" class="form-control" placeholder="Masukan Biokimia Terkait Gizi">{{ $asuhan->biokimia ?? '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-md-12">
                                                <label for="" class="form-label">Klinik / Fisik</label>
                                                <textarea name="klinik" id="klinik" rows="1" class="form-control" placeholder="Masukan Klinik / Fisik">{{ $asuhan->klinik ?? '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-md-12">
                                                <label for="" class="form-label">Riwayat Gizi</label>
                                                <textarea name="riwayat_gizi" id="riwayat_gizi" rows="1" class="form-control" placeholder="Masukan Riwayat Gizi">{{ $asuhan->riwayat_gizi ?? '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row mt-5 p-5">
                                            <div class="card card-bordered">
                                                <div class="card-header">
                                                    <h5 class="card-title">Alergi Makanan</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="row mb-5">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Telur</label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="d-flex justify-content-start">
                                                                        <div class="form-check form-check-custom form-check-solid">
                                                                            <input class="form-check-input" type="radio" value="1"
                                                                                id="telur" name="telur" @if($asuhan) {{ (json_decode($asuhan->alergi_makanan)->telur == 1) ? 'checked' : '' }} @endif/>
                                                                            <label class="form-check-label" for="flexRadioDefault">
                                                                                Ya
                                                                            </label>
                                                                        </div>
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <div class="form-check form-check-custom form-check-solid">
                                                                            <input class="form-check-input" type="radio" value="0"
                                                                                id="telur" name="telur"  @if($asuhan) {{ (json_decode($asuhan->alergi_makanan)->telur == 0) ? 'checked' : '' }} @endif/>
                                                                            <label class="form-check-label" for="flexRadioDefault">
                                                                                Tidak
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-5">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Susu sapi dan produk olahannya</label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="d-flex justify-content-start">
                                                                        <div class="form-check form-check-custom form-check-solid">
                                                                            <input class="form-check-input" type="radio" value="1"
                                                                                id="susu_sapi" name="susu_sapi" @if($asuhan) {{ (json_decode($asuhan->alergi_makanan)->susu_sapi == 1) ? 'checked' : '' }} @endif/>
                                                                            <label class="form-check-label" for="flexRadioDefault">
                                                                                Ya
                                                                            </label>
                                                                        </div>
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <div class="form-check form-check-custom form-check-solid">
                                                                            <input class="form-check-input" type="radio" value="0"
                                                                                id="susu_sapi" name="susu_sapi" @if($asuhan) {{ (json_decode($asuhan->alergi_makanan)->susu_sapi == 0) ? 'checked' : '' }} @endif/>
                                                                            <label class="form-check-label" for="flexRadioDefault">
                                                                                Tidak
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-5">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Kacang tanah/kedelai</label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="d-flex justify-content-start">
                                                                        <div class="form-check form-check-custom form-check-solid">
                                                                            <input class="form-check-input" type="radio" value="1"
                                                                                id="kacang_tanah" name="kacang_tanah" @if($asuhan) {{ (json_decode($asuhan->alergi_makanan)->kacang_tanah == 1) ? 'checked' : '' }} @endif />
                                                                            <label class="form-check-label" for="flexRadioDefault">
                                                                                Ya
                                                                            </label>
                                                                        </div>
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <div class="form-check form-check-custom form-check-solid">
                                                                            <input class="form-check-input" type="radio" value="0"
                                                                                id="kacang_tanah" name="kacang_tanah" @if($asuhan) {{ (json_decode($asuhan->alergi_makanan)->kacang_tanah == 0) ? 'checked' : '' }} @endif />
                                                                            <label class="form-check-label" for="flexRadioDefault">
                                                                                Tidak
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Gluten/gandum</label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="d-flex justify-content-start">
                                                                        <div class="form-check form-check-custom form-check-solid">
                                                                            <input class="form-check-input" type="radio" value="1"
                                                                                id="gluten" name="gluten" @if($asuhan) {{ (json_decode($asuhan->alergi_makanan)->gluten == 1) ? 'checked' : '' }} @endif/>
                                                                            <label class="form-check-label" for="flexRadioDefault">
                                                                                Ya
                                                                            </label>
                                                                        </div>
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <div class="form-check form-check-custom form-check-solid">
                                                                            <input class="form-check-input" type="radio" value="0"
                                                                                id="gluten" name="gluten" @if($asuhan) {{ (json_decode($asuhan->alergi_makanan)->gluten == 0) ? 'checked' : '' }} @endif/>
                                                                            <label class="form-check-label" for="flexRadioDefault">
                                                                                Tidak
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="row mb-5">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Udang</label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="d-flex justify-content-start">
                                                                        <div class="form-check form-check-custom form-check-solid">
                                                                            <input class="form-check-input" type="radio" value="1"
                                                                                id="udang" name="udang" @if($asuhan) {{ (json_decode($asuhan->alergi_makanan)->udang == 1) ? 'checked' : '' }} @endif />
                                                                            <label class="form-check-label" for="flexRadioDefault">
                                                                                Ya
                                                                            </label>
                                                                        </div>
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <div class="form-check form-check-custom form-check-solid">
                                                                            <input class="form-check-input" type="radio" value="0"
                                                                                id="udang" name="udang" @if($asuhan) {{ (json_decode($asuhan->alergi_makanan)->udang == 0) ? 'checked' : '' }} @endif />
                                                                            <label class="form-check-label" for="flexRadioDefault">
                                                                                Tidak
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-5">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Ikan</label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="d-flex justify-content-start">
                                                                        <div class="form-check form-check-custom form-check-solid">
                                                                            <input class="form-check-input" type="radio" value="1"
                                                                                id="ikan" name="ikan" @if($asuhan) {{ (json_decode($asuhan->alergi_makanan)->ikan == 1) ? 'checked' : '' }} @endif />
                                                                            <label class="form-check-label" for="flexRadioDefault">
                                                                                Ya
                                                                            </label>
                                                                        </div>
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <div class="form-check form-check-custom form-check-solid">
                                                                            <input class="form-check-input" type="radio" value="0"
                                                                                id="ikan" name="ikan" @if($asuhan) {{ (json_decode($asuhan->alergi_makanan)->ikan == 0) ? 'checked' : '' }} @endif />
                                                                            <label class="form-check-label" for="flexRadioDefault">
                                                                                Tidak
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Almond</label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="d-flex justify-content-start">
                                                                        <div class="form-check form-check-custom form-check-solid">
                                                                            <input class="form-check-input" type="radio" value="1"
                                                                                id="almond" name="almond" @if($asuhan) {{ (json_decode($asuhan->alergi_makanan)->almond == 1) ? 'checked' : '' }} @endif/>
                                                                            <label class="form-check-label" for="flexRadioDefault">
                                                                                Ya
                                                                            </label>
                                                                        </div>
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <div class="form-check form-check-custom form-check-solid">
                                                                            <input class="form-check-input" type="radio" value="0"
                                                                                id="almond" name="almond" @if($asuhan) {{ (json_decode($asuhan->alergi_makanan)->almond == 0) ? 'checked' : '' }} @endif/>
                                                                            <label class="form-check-label" for="flexRadioDefault">
                                                                                Tidak
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row mt-5">
                                                        <label for="" class="form-label">Pola Makan</label>
                                                        <textarea name="pola_makan" id="pola_makan" rows="1" class="form-control" placeholder="Masukan Pola Makan">{{ $asuhan->pola_makan ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-md-12">
                                                <label for="" class="form-label">Riwayat Personal</label>
                                                <textarea name="riwayat_personal" id="riwayat_personal" rows="1" class="form-control" placeholder="Masukan Riwayat Personal">{{ $asuhan->riwayat_personal ?? '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-md-12">
                                                <label for="" class="form-label">Diagnosa Gizi</label>
                                                <textarea name="diagnosa_gizi" id="diagnosa_gizi" rows="1" class="form-control" placeholder="Masukan Diagnosa Gizi">{{ $asuhan->diagnosa_gizi ?? '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row mt-5 p-5">
                                            <div class="card card-bordered">
                                                <div class="card-header">
                                                    <h5 class="card-title">Intervensi Gizi</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="" class="form-label">Tujuan</label>
                                                            <textarea name="tujuan" id="tujuan" rows="1" class="form-control" placeholder="Masukan Tujuan">@if($asuhan) {{ json_decode($asuhan->intervensi_gizi)->tujuan ?? '' }}@endif</textarea>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="" class="form-label">Target</label>
                                                            <textarea name="target" id="target" rows="1" class="form-control" placeholder="Masukan Target">@if($asuhan) {{ json_decode($asuhan->intervensi_gizi)->target ?? '' }}@endif</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
                                <div class="rounded border p-5">
                                    <div class="row mb-5">
                                        <div class="col-md-12">
                                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_evaluasi">Tambah Data</button>
                                        </div>
                                    </div>
                                    @include('gizi.data._data_evaluasi_gizi')
                                </div>
                            </div>
                            <div class="tab-pane fade" id="kt_tab_pane_4" role="tabpanel">
                                <button class="btn btn-warning btn-sm mb-5" data-bs-toggle="modal"
                                data-bs-target="#modal_cppt">Tambah CPPT</button>
                                @include('rawat-inap.menu.cppt')
                            </div>
                        </div>
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

<div class="modal fade" tabindex="-1" id="modal_evaluasi">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Evaluasi Asuhan Gizi</h3>
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                            class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <form id="frm-evaluasi" action="{{ route('store.evaluasi-gizi') }}" method="POST" autocomplete="off">
                    @csrf
                    <input type="hidden" name="idrawat" value="{{ $rawat->id }}">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="" class="form-label required">Tanggal</label>
                            <input class="form-control" placeholder="Pilih Tanggal" id="tanggal" name="tanggal" data-bs-focus="false" required/>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <label for="" class="form-label required">Monitoring Evaluasi</label>
                            <textarea name="monitoring_evaluasi" id="monitoring_evaluasi" rows="3" class="form-control" placeholder="Masukan Monitoring Evaluasi" required></textarea>
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
<div class="modal fade" tabindex="-1" id="modal_cppt">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah CPPT</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                            class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <form action="{{ route('store.cppt-gizi') }}" method="POST" autocomplete="off">
                    @csrf
                    <input type="hidden" name="idrawat" value="{{ $rawat->id }}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for=""> Profesi (PPA) </label>
                                </div>
                                <div class="col-md-8">
                                    <select name="profesi" class="form-select" id="profesi">
                                        <option value="Gizi">Gizi</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="row">
                            <div class="col-md-4">
                                CPPT
                            </div>
                            <div class="col-md-2 text-center">A</div>
                            <div class="col-md-6">
                                <textarea name="cppt_a" class="form-control" id=""></textarea>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-2 text-center">D</div>
                            <div class="col-md-6">
                                <textarea name="cppt_d" class="form-control" id=""></textarea>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-2 text-center">I</div>
                            <div class="col-md-6">
                                <textarea name="cppt_i" class="form-control" id=""></textarea>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-2 text-center">M</div>
                            <div class="col-md-6">
                                <textarea name="cppt_m" class="form-control" id=""></textarea>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-2 text-center">E</div>
                            <div class="col-md-6">
                                <textarea name="cppt_e" class="form-control" id=""></textarea>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
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

        var skrining_ya = '{{ ($skrining) ? json_decode($skrining?->skrining)->parameter_1 : '' }}';
        if(skrining_ya == 3){
            $('#frm-ya').show('Fadeout');
        }else{
            $('#frm-ya').hide('Fadein');
        }

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

        $("#tanggal").flatpickr({
            altInput: true,
            altFormat: "d-m-Y",
            dateFormat: "Y-m-d"
        });

        $("#tanggal-asuhan").flatpickr({
            altInput: true,
            altFormat: "d-m-Y",
            dateFormat: "Y-m-d"
        });

        $('input[type=radio][name=parameter_1]').change(function() {
            if (this.value == 3) {
                $('#frm-ya').show('Fadeout');
            }
            else{
                $('#frm-ya').hide('Fadein');
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
