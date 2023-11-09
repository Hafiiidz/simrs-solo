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
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Detail Rekap Medis Pasien</h1>
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
                        <li class="breadcrumb-item text-muted">Rekap Medis</li>
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
                        <h5 class="card-title">Rekap Medis Pasien</h5>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ route('detail-rekap-medis-index', $rekap->idrekapmedis) }}" class="btn btn-sm btn-secondary">Kembali</a>
                    </div>
                </div>
                <!--begin::Body-->
                <div class="card-body p-lg-10">
                    <form action="{{ route('detail-rekap-medis-update', $rekap->id) }}" method="post" autocomplete="off" id="frm-data">
                        @csrf
                        <input type="hidden" name="kategori" value="{{ $rekap->rekapMedis->kategori->id }}">
                        <div class="alert alert-dismissible bg-light-success border border-success border-3 border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                            <!--begin::Icon-->
                            <i class="ki-duotone ki-pulse fs-2hx text-success me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>                    <!--end::Icon-->

                            <!--begin::Content-->
                            <div class="d-flex flex-column justify-content-center">
                                <h2 class="mb-1">{{ $rekap->rekapMedis->kategori->nama }}</h2>
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
                            <span class="d-inline-block position-absolute h-5px bottom-0 end-0 start-0 bg-primary translate rounded"></span>
                            <!--end::Line-->
                        </span>
                        <!--end::Underline-->
                        <div class="row">
                            <div class="row mb-3">
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-4">{{ $rekap->rekapMedis->pasien->nama_pasien }}</span>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <!--begin::Label-->
                                <label class="col-lg-1 fw-semibold text-muted">NIK</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">{{ $rekap->rekapMedis->pasien->nik }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-5">
                                <!--begin::Label-->
                                <label class="col-lg-1 fw-semibold text-muted">No BPJS</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">{{ $rekap->rekapMedis->pasien->no_bpjs }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-5">
                                <!--begin::Label-->
                                <label class="col-lg-1 fw-semibold text-muted">No Handphone</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">{{ $rekap->rekapMedis->pasien->nohp }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-5">
                                <!--begin::Label-->
                                <label class="col-lg-1 fw-semibold text-muted">Alamat</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">{{ $rekap->rekapMedis->pasien->alamat->alamat }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                        </div>
                        <div class="separator separator-dashed border-secondary mb-5"></div>
                        <div class="row mb-5">
                            <div class="col-md-12">
                                <label class="form-label fw-bold">Diagnosa</label>
                                <textarea name="diagnosa" rows="3" class="form-control" placeholder="...">{{ $rekap->diagnosa }}</textarea>
                            </div>
                        </div>
                        <!--begin::Underline-->
                        <span class="d-inline-block position-relative mb-7">
                            <!--begin::Label-->
                            <span class="d-inline-block mb-2 fs-4 fw-bold">
                                Anamnesa & Pemeriksaan Fisik
                            </span>
                            <!--end::Label-->

                            <!--begin::Line-->
                            <span class="d-inline-block position-absolute h-5px bottom-0 end-0 start-0 bg-success translate rounded"></span>
                            <!--end::Line-->
                        </span>
                        <!--end::Underline-->
                        <div class="row mb-5">
                            <div class="col-md-12">
                                <label class="form-label fw-bold">Anamnesa</label>
                                <textarea name="anamnesa" rows="3" class="form-control" placeholder="Alasan Masuk Rumah Sakit">{{ $rekap->anamnesa }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-12">
                                <label class="form-label fw-bold">Obat Yang Dikonsumsi</label>
                                <textarea name="obat_yang_dikonsumsi" rows="3" class="form-control" placeholder="....">{{ $rekap->obat_yang_dikonsumsi }}</textarea>
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
                                                <input class="form-check-input" type="checkbox" value="obat" id="obat" {{ ($alergi->value_obat) ? 'checked' : '' }}/>
                                                <label class="form-check-label" for="obat">
                                                    Obat
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" name="value_obat" id="value_obat" class="form-control" value="{{ $alergi->value_obat }}" placeholder="...." style="display: {{ ($alergi->value_obat) ? '' : 'none' }};">
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="makanan" id="makanan" {{ ($alergi->value_makanan) ? 'checked' : '' }}/>
                                                <label class="form-check-label" for="makanan">
                                                    Makanan
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" name="value_makanan" id="value_makanan" class="form-control" value="{{ $alergi->value_makanan }}" placeholder="...." style="display: {{ ($alergi->value_makanan) ? '' : 'none' }};">
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="lain" id="lain" {{ ($alergi->value_lain) ? 'checked' : '' }}/>
                                                <label class="form-check-label" for="lain">
                                                    Lain - Lain
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" name="value_lain" id="value_lain" class="form-control"value="{{ $alergi->value_lain }}" placeholder="...." style="display: {{ ($alergi->value_lain) ? '' : 'none' }};">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-12">
                                <label class="form-label fw-bold">Pasien Sedang</label>
                                <input name="pasien_sedang" rows="3" class="form-control" placeholder="...." value="{{ $rekap->pasien_sedang }}">
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
                                                <input type="text" class="form-control" name="tekanan_darah" value="{{ $pfisik->tekanan_darah }}" placeholder="...." aria-label="...." aria-describedby="tdarah"/>
                                                <span class="input-group-text" id="tdarah">mmHg</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Nadi</label>
                                            <div class="input-group mb-5">
                                                <input type="text" class="form-control" name="nadi" value="{{ $pfisik->nadi }}" placeholder="...." aria-label="...." aria-describedby="nadi"/>
                                                <span class="input-group-text" id="nadi">x/Menit</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Pernapasan</label>
                                            <div class="input-group mb-5">
                                                <input type="text" class="form-control" name="pernapasan" value="{{ $pfisik->pernapasan }}" placeholder="...." aria-label="...." aria-describedby="pernapasan"/>
                                                <span class="input-group-text" id="pernapasan">x/Menit</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row md-5">
                                        <div class="col-md-4">
                                            <label class="form-label">Suhu</label>
                                            <div class="input-group mb-5">
                                                <input type="text" class="form-control" name="suhu" value="{{ $pfisik->suhu }}" placeholder="...." aria-label="...." aria-describedby="suhu"/>
                                                <span class="input-group-text" id="suhu">Derajat</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Berat Badan</label>
                                            <div class="input-group mb-5">
                                                <input type="text" class="form-control" name="berat_badan" value="{{ $pfisik->berat_badan }}" placeholder="...." aria-label="...." aria-describedby="berat_badan"/>
                                                <span class="input-group-text" id="berat_badan">Kg</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Tinggi Badan</label>
                                            <div class="input-group mb-5">
                                                <input type="text" class="form-control" name="tinggi_badan" value="{{ $pfisik->tinggi_badan }}" placeholder="...." aria-label="....e" aria-describedby="tinggi_badan"/>
                                                <span class="input-group-text" id="tinggi_badan">Cm</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row col-md-4">
                                        <label class="form-label">BMI</label>
                                        <div class="input-group mb-5">
                                            <input type="text" class="form-control" name="bmi" value="{{ $pfisik->bmi }}" placeholder="...." aria-label="....e" aria-describedby="bmi"/>
                                            <span class="input-group-text" id="bmi">Kg/M2</span>
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
                                        <div class="col-md-8">
                                            <div class="d-flex justify-content-start">
                                                <div class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="radio" value="1" id="riwayat-1" name="riwayat_1" {{ ($rkesehatan->riwayat_1 == 1) ? 'checked' : '' }}/>
                                                    <label class="form-check-label" for="flexRadioDefault">
                                                        Ya
                                                    </label>
                                                </div>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <div class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="radio" value="0" id="riwayat-1" name="riwayat_1" {{ ($rkesehatan->riwayat_1 == 0) ? 'checked' : '' }}/>
                                                    <label class="form-check-label" for="flexRadioDefault">
                                                        Tidak
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="separator separator-dashed border-secondary mb-5"></div>
                                    <div class="row mb-5">
                                        <div class="col-md-4">
                                            <label class="form-label">Pernah dirawat</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="d-flex justify-content-start">
                                                <div class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="radio" value="1" id="riwayat-2" name="riwayat_2" {{ ($rkesehatan->riwayat_2 == 1) ? 'checked' : '' }}/>
                                                    <label class="form-check-label" for="flexRadioDefault">
                                                        Ya
                                                    </label>
                                                </div>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <div class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="radio" value="0" id="riwayat-2" name="riwayat_2" {{ ($rkesehatan->riwayat_2 == 0) ? 'checked' : '' }}/>
                                                    <label class="form-check-label" for="flexRadioDefault">
                                                        Tidak
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="separator separator-dashed border-secondary mb-5"></div>
                                    <div class="row mb-5">
                                        <div class="col-md-4">
                                            <label class="form-label">Pernah dioperasi</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="d-flex justify-content-start">
                                                <div class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="radio" value="1" id="riwayat-3" name="riwayat_3" {{ ($rkesehatan->riwayat_3 == 1) ? 'checked' : '' }}/>
                                                    <label class="form-check-label" for="flexRadioDefault">
                                                        Ya
                                                    </label>
                                                </div>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <div class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="radio" value="0" id="riwayat-3" name="riwayat_3" {{ ($rkesehatan->riwayat_3 == 0) ? 'checked' : '' }}/>
                                                    <label class="form-check-label" for="flexRadioDefault">
                                                        Tidak
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="separator separator-dashed border-secondary mb-5"></div>
                                    <div class="row mb-5">
                                        <div class="col-md-4">
                                            <label class="form-label">Dalam pengobatan khusus</label>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="d-flex justify-content-start">
                                                <div class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="radio" value="1" id="riwayat-4" name="riwayat_4" {{ ($rkesehatan->riwayat_4 == 1) ? 'checked' : '' }}/>
                                                    <label class="form-check-label" for="flexRadioDefault">
                                                        Ya
                                                    </label>
                                                </div>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <div class="form-check form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="radio" value="0" id="riwayat-4" name="riwayat_4" {{ ($rkesehatan->riwayat_4 == 0) ? 'checked' : '' }}/>
                                                    <label class="form-check-label" for="flexRadioDefault">
                                                        Tidak
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--begin::Underline-->
                        <span class="d-inline-block position-relative mb-7">
                            <!--begin::Label-->
                            <span class="d-inline-block mb-2 fs-4 fw-bold">
                                Rencana Pemeriksaan
                            </span>
                            <!--end::Label-->

                            <!--begin::Line-->
                            <span class="d-inline-block position-absolute h-5px bottom-0 end-0 start-0 bg-success translate rounded"></span>
                            <!--end::Line-->
                        </span>
                        <!--end::Underline-->
                        <div class="row mb-5">
                            <div class="col-md-12">
                                <textarea name="rencana_pemeriksaan" rows="3" class="form-control" placeholder="Hasil Pemeriksaan Penunjang (yang relevan dengan diagnosis dan terapi)">{{ $rekap->rencana_pemeriksaan }}</textarea>
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
                            <span class="d-inline-block position-absolute h-5px bottom-0 end-0 start-0 bg-success translate rounded"></span>
                            <!--end::Line-->
                        </span>
                        <!--end::Underline-->
                        <div class="row mb-5">
                            <!--begin::Repeater-->
                            <div id="kt_docs_repeater_basic">
                                <!--begin::Form group-->
                                <div class="form-group">
                                    <div data-repeater-list="terapi_obat">
                                        @if ($rekap->terapi_obat != 'null')
                                            @foreach(json_decode($rekap->terapi_obat) as $val)
                                                <div data-repeater-item>
                                                    <div class="form-group row mb-5">
                                                        <div class="col-md-6">
                                                            <label class="form-label">Obat</label>
                                                            <select name="obat" class="form-select" data-kt-repeater="select2" data-placeholder="-Pilih-">
                                                                <option></option>
                                                                @foreach ($obat as $item)
                                                                    <option value="{{ $item->id }}" {{ ($val->obat == $item->id) ? 'selected' : '' }}>{{ $item->nama_obat }} - {{ $item->satuan->satuan }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="form-label">Jumlah Obat</label>
                                                            <input type="number" name="jumlah_obat" value="{{ $val->jumlah_obat }}" class="form-control mb-5 mb-md-0" min="0"/>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                                <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                                                Hapus
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div data-repeater-item>
                                                <div class="form-group row mb-5">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Obat</label>
                                                        <select name="obat" class="form-select" data-kt-repeater="select2" data-placeholder="-Pilih-"required >
                                                            <option></option>
                                                            @foreach ($obat as $val)
                                                                <option value="{{ $val->id }}">{{ $val->nama_obat }} - {{ $val->satuan->satuan }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label">Jumlah Obat</label>
                                                        <input type="number" name="jumlah_obat" class="form-control mb-5 mb-md-0" min="0"required />
                                                    </div>
                                                    <div class="col-md-4">
                                                        <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                            <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                                            Hapus
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
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
                            </div>
                            <!--end::Repeater-->
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <textarea name="terapi" rows="3" class="form-control" placeholder="Baik Obat, Prosedur, Operasi, Rehabilitasi dan Diet">{{ $rekap->terapi }}</textarea>
                            </div>
                        </div>
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
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js">
</script>
<script>
    $(function(){

        alergi();

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

        $('#kt_docs_repeater_basic').repeater({
            initEmpty: {{ ($rekap->terapi_obat == 'null') ? 'true' : 'false' }},

            show: function () {
                $(this).slideDown();

                $(this).find('[data-kt-repeater="select2"]').select2();
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            },

            ready: function(){
                $('[data-kt-repeater="select2"]').select2();
            }
        });

    });

    function alergi()
    {
        $('#obat').change(function() {
            if(this.checked) {
                $('#value_obat').show();
            }
            else{
                $('#value_obat').hide();
                $('#value_obat').val('');
            }
        });

        $('#makanan').change(function() {
            if(this.checked) {
                $('#value_makanan').show();
            }
            else{
                $('#value_makanan').hide();
                $('#value_makanan').val('');
            }
        });

        $('#lain').change(function() {
            if(this.checked) {
                $('#value_lain').show();
            }
            else{
                $('#value_lain').hide();
                $('#value_lain').val('');
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
