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
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">List
                            Kategori Rekam Medis Pasien</h1>
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
                            <li class="breadcrumb-item text-muted">Kategori Rekam Medis</li>
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
                {{-- {{ dd($resume_medis) }} --}}
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h5 class="card-title">Data Kategori Rekam Medis Pasien</h5>
                        </div>
                        <div class="card-toolbar">
                            <a href="{{ route('poliklinik') }}" class="btn btn-sm btn-secondary me-2">Kembali</a>
                            @if ($resume_medis)
                                <a id="confirmButton" class="btn btn-sm btn-light-primary" href="#">Update
                                    Template</a>
                                <form action="{{ route('rekap-medis-selesai', $resume_medis->id) }}" id='frmSelesai'
                                    method="POST">
                                    @csrf

                                    @if ($resume_medis->perawat != 1)
                                        @if (auth()->user()->idpriv == 14 || auth()->user()->idpriv == 18 || auth()->user()->idpriv == 29)
                                            @csrf
                                            <input type="hidden" name="jenis" id="" value="perawat">
                                            <button class="btn btn-light-success btn-sm">Selesai</button>
                                        @endif
                                    @endif

                                    @if ($resume_medis->bpjs != 1)
                                        @if (auth()->user()->idpriv == 20)
                                            <input type="hidden" name="jenis" id="" value="bpjs">
                                            <button class="btn btn-light-success btn-sm">Selesai</button>
                                        @endif
                                    @endif

                                    @if ($resume_medis->dokter != 1)
                                        @if (auth()->user()->idpriv == 7)
                                            <input type="hidden" name="jenis" id="" value="dokter">
                                            <button class="btn btn-light-success btn-sm">Selesai</button>
                                        @endif
                                    @endif
                                </form>
                            @endif

                        </div>
                    </div>
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="row mb-10">
                            <div class="col-md-12">
                                @if (auth()->user()->idpriv == 7)
                                    @if ($rawat->status != 4 || $rawat->status != 5)
                                        @foreach ($get_template as $temp)
                                            <a href="{{ route('copy-template', [$temp->idrawat, $rawat->id]) }}"
                                                class="btn btn-warning btn-sm py-2 mb-5">{{ $temp->diagnosa }}</a>
                                        @endforeach
                                    @endif

                                @endif
                            </div>
                        </div>
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
                                @canany(['dokter', 'perawat'])
                                    {{-- <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#tambah-rekap">
                                        Tambah Data Kategori Rekam Medis
                                    </button> --}}
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
                                <label class="col-lg-2 fw-semibold text-muted">No.RM</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">{{ $pasien->no_rm }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-5">
                                <!--begin::Label-->
                                <label class="col-lg-2 fw-semibold text-muted">Tgl.Lahir</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">{{ $pasien->tgllahir }} -
                                        {{ $pasien->usia_tahun }}Th {{ $pasien->usia_bulan }}Bln
                                        {{ $pasien->usia_hari }}Hr</span>
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

                        <div class="rounded border p-5">
                            <div class="mb-5 hover-scroll-x">
                                <div class="d-grid">
                                    <ul class="nav nav-tabs flex-nowrap text-nowrap" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0 active"
                                                data-bs-toggle="tab" href="#kt_tab_pane_1" aria-selected="true"
                                                role="tab">Data Berobat</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0"
                                                data-bs-toggle="tab" href="#kt_tab_pane_2" aria-selected="false"
                                                role="tab" tabindex="-1">Resume Pasien</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0"
                                                data-bs-toggle="tab" href="#kt_tab_pane_resep" aria-selected="false"
                                                role="tab" tabindex="-1">Obat Obatan</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0"
                                                data-bs-toggle="tab" href="#kt_tab_pane_rb" aria-selected="false"
                                                role="tab" tabindex="-1">Riwayat Berobat</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0"
                                                data-bs-toggle="tab" href="#kt_tab_pane_3" aria-selected="false"
                                                role="tab" tabindex="-1">Rencana Tindak Lanjut</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0"
                                                data-bs-toggle="tab" href="#kt_tab_pane_4" aria-selected="false"
                                                role="tab" tabindex="-1">Tindakan</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0"
                                                data-bs-toggle="tab" href="#kt_tab_pane_5" aria-selected="false"
                                                role="tab" tabindex="-1">Hasil Pemeriksaan Penunjang</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0"
                                                data-bs-toggle="tab" href="#kt_tab_pane_6" aria-selected="false"
                                                role="tab" tabindex="-1">Upload Hasil Pemeriksaan Penunjang Luar</a>
                                        </li>


                                    </ul>
                                </div>
                            </div>

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                                    <div class="row mb-2">
                                        <!--begin::Label-->
                                        <label class="col-lg-2 fw-semibold text-muted">Poli</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <span class="fw-bold fs-6 text-gray-800">{{ $rawat->poli?->poli }}</span>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row mb-2">
                                        <!--begin::Label-->
                                        <label class="col-lg-2 fw-semibold text-muted">Dokter</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <span
                                                class="fw-bold fs-6 text-gray-800">{{ $rawat->dokter?->nama_dokter }}</span>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row mb-2">
                                        <!--begin::Label-->
                                        <label class="col-lg-2 fw-semibold text-muted">Tgl.Berobat</label>
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
                                        <label class="col-lg-2 fw-semibold text-muted">Penanggung</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">

                                            <span class="fw-bold fs-6 text-gray-800">{{ $rawat->bayar->bayar }}</span>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="kt_tab_pane_resep" role="tabpanel">

                                    <div class="d-grid">
                                        <ul class="nav nav-tabs flex-nowrap text-nowrap" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0 active"
                                                    data-bs-toggle="tab" href="#kt_tab_pane_non_racikan"
                                                    aria-selected="true" role="tab">Non Racikan</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0"
                                                    data-bs-toggle="tab" href="#kt_tab_pane_racikan"
                                                    aria-selected="false" role="tab" tabindex="-1">Racikan</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="tab-content" id="myTabContentObat">

                                        <div class="tab-pane fade show active" id="kt_tab_pane_non_racikan"
                                            role="tabpanel">
                                            <div class="table-responsive">
                                                @if (auth()->user()->idpriv == 7)
                                                    <table class="table table-bordered fs-9 gs-2 gy-2 gx-2"
                                                        id="kt_docs_repeater_basic">
                                                        <thead class="text-center align-middle">
                                                            <tr>
                                                                <th rowspan="2">Nama Obat</th>
                                                                <th rowspan="2" width=100>Jumlah</th>
                                                                <th rowspan="2" width=100>Dosis</th>
                                                                <th rowspan="2" width=200>Sediaan</th>
                                                                <th width=50 colspan="4">Aturan Pakai</th>
                                                                <th rowspan="2" width=100>Diminum</th>
                                                                <th rowspan="2" width=100>Catatan</th>
                                                            </tr>
                                                            <tr>
                                                                <th width=10>P</th>
                                                                <th width=10>S</th>
                                                                <th width=10>SO</th>
                                                                <th width=10>M</th>
                                                            </tr>

                                                        </thead>
                                                        <tbody class="align-middle">
                                                            <form id='frmNonracikan' method="POST">
                                                                @csrf
                                                                <tr>
                                                                    <td>
                                                                        <select name="obat_non" id='nama_obat_non'
                                                                            class="form-select form-select-sm"
                                                                            data-control="select2"
                                                                            data-placeholder="-Pilih-" required>
                                                                            {{-- <option value="1" selected>1</option>
                                                                    <option value="2" selected>2</option>
                                                                    <option value="3" >3</option> --}}
                                                                            <option value=""></option>
                                                                            @foreach ($obat as $val)
                                                                                <option value="{{ $val->id }}">
                                                                                    {{ $val->nama_obat }} -
                                                                                    {{ $val->satuan->satuan }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input type="number" id='jumlah_obat'
                                                                            name="jumlah_obat"
                                                                            class="form-control form-control-sm mb-2 mb-md-0"
                                                                            min="0" required>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" name="dosis_obat"
                                                                            placeholder="dosis"
                                                                            class="form-control form-control-sm  mb-2 mb-md-0"
                                                                            min="0">
                                                                    </td>
                                                                    <td>
                                                                        <select name="takaran_obat" id='takaran_obat'
                                                                            required class="form-select form-select-sm">
                                                                            <option value="">Pilih Sediaan</option>
                                                                            <option value="-">-</option>
                                                                            <option value="tablet">tablet</option>
                                                                            <option value="kapsul">kapsul</option>
                                                                            <option value="bungkus">bungkus</option>
                                                                            <option value="tetes">tetes</option>
                                                                            <option value="ml">ml</option>
                                                                            <option value="sendok takar 5ml">sendok takar
                                                                                5ml
                                                                            </option>
                                                                            <option value="sendok takar 15ml">sendok takar
                                                                                15ml
                                                                            </option>
                                                                            <option value="Oles">Oles</option>
                                                                        </select>

                                                                    </td>
                                                                    <td class="text-center align-middle"><input
                                                                            name="diminum[]"
                                                                            class="form-check-input form-check-input-sm"
                                                                            type="checkbox" value="P"
                                                                            id="flexCheckDefault" /></td>
                                                                    <td class="text-center align-middle"><input
                                                                            class="form-check-input form-check-input-sm"
                                                                            type="checkbox" value="S"
                                                                            name="diminum[]" id="flexCheckDefault" /></td>
                                                                    <td class="text-center align-middle"><input
                                                                            class="form-check-input form-check-input-sm"
                                                                            type="checkbox" value="SO"
                                                                            name="diminum[]" id="flexCheckDefault" /></td>
                                                                    <td class="text-center align-middle"><input
                                                                            class="form-check-input form-check-input-sm"
                                                                            type="checkbox" value="M"
                                                                            name="diminum[]" id="flexCheckDefault" /></td>
                                                                    <td>
                                                                        <div class="form-check form-check-inline mb-2">
                                                                            <input class="form-check-input" type="radio"
                                                                                name="takaran" id="kapsul"
                                                                                value="sebelum">
                                                                            <label class="form-check-label"
                                                                                for="tablet">Sebelum</label>
                                                                        </div>

                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio"
                                                                                name="takaran" id="kapsul"
                                                                                value="sesudah">
                                                                            <label class="form-check-label"
                                                                                for="kapsul">Sesudah</label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" name="catatan"
                                                                            class="form-control form-control-sm mb-2 mb-md-0"
                                                                            min="0">
                                                                    </td>
                                                                    <td>

                                                                        {{-- <button class="btn btn-sm btn-info">Racik</button> --}}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th colspan="10">
                                                                        <button type="submit" name="upload"
                                                                            id="upload" class="btn btn-primary btn-sm">
                                                                            <span class="indicator-label">
                                                                                Simpan Obat
                                                                            </span>
                                                                            <span class="indicator-progress">
                                                                                Prossesing... <span
                                                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                                            </span>
                                                                        </button>
                                                                    </th>
                                                                </tr>
                                                            </form>
                                                        </tbody>
                                                    </table>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="kt_tab_pane_racikan" role="tabpanel">
                                            <div class="table-responsive">
                                                @if (auth()->user()->idpriv == 7)
                                                    <table class="table table-bordered fs-9 gs-2 gy-2 gx-2"
                                                        id="kt_docs_repeater_basic">
                                                        <thead class="text-center align-middle">
                                                            <tr>
                                                                <th rowspan="2">Nama Obat</th>
                                                                <th rowspan="2" width=100>Dosis</th>
                                                                <th rowspan="2" width=100>Jumlah</th>
                                                                <th rowspan="2" width=50>Diberikan</th>
                                                                <th rowspan="2" width=200>Sediaan</th>
                                                                <th width=50 colspan="4">Aturan Pakai</th>
                                                                <th rowspan="2" width=100>Diminum</th>
                                                                <th rowspan="2" width=10>D.T.D</th>
                                                                <th rowspan="2" width=100>Catatan</th>
                                                            </tr>
                                                            <tr>
                                                                <th width=10>P</th>
                                                                <th width=10>S</th>
                                                                <th width=10>SO</th>
                                                                <th width=10>M</th>
                                                            </tr>

                                                        </thead>
                                                        <tbody class="align-middle">
                                                            <form id='frmRacikan' method="POST">
                                                                @csrf
                                                                <tr>
                                                                    <td>
                                                                        @for ($i = 1; $i <= 8; $i++)
                                                                            <select name="obat[]"
                                                                                id='nama_obat{{ $i }}'
                                                                                class="form-select form-select-sm"
                                                                                data-control="select2"
                                                                                data-placeholder="Obat {{ $i }}">
                                                                                {{-- <option value="1" selected>1</option>
                                                                        <option value="2" selected>2</option>
                                                                        <option value="3" >3</option> --}}
                                                                                <option value=""></option>
                                                                                @foreach ($obat as $val)
                                                                                    <option value="{{ $val->id }}">
                                                                                        {{ $val->nama_obat }} -
                                                                                        {{ $val->satuan->satuan }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        @endfor



                                                                    </td>
                                                                    <td>
                                                                        @for ($i = 1; $i <= 8; $i++)
                                                                            <input type="text"
                                                                                id='jumlah_obat{{ $i }}'
                                                                                name="jumlah_obat[]"
                                                                                class="form-control form-control-sm mb-2 mb-md-0"
                                                                                min="0">
                                                                        @endfor

                                                                    </td>
                                                                    <td>
                                                                        <input type="text" name="dosis_obat" required
                                                                            placeholder=""
                                                                            class="form-control form-control-sm  mb-2 mb-md-0"
                                                                            min="0">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" name="pemberian" required
                                                                            placeholder=""
                                                                            class="form-control form-control-sm  mb-2 mb-md-0"
                                                                            min="0">
                                                                    </td>
                                                                    <td>
                                                                        <select name="takaran_obat" id='takaran_obat'
                                                                            required class="form-select form-select-sm">
                                                                            <option value="">Pilih Sediaan</option>
                                                                            <option value="-">-</option>
                                                                            <option value="tablet">tablet</option>
                                                                            <option value="kapsul">kapsul</option>
                                                                            <option value="bungkus">bungkus</option>
                                                                            <option value="tetes">tetes</option>
                                                                            <option value="ml">ml</option>
                                                                            <option value="sendok takar 5ml">sendok takar
                                                                                5ml
                                                                            </option>
                                                                            <option value="sendok takar 15ml">sendok takar
                                                                                15ml
                                                                            </option>
                                                                            <option value="Oles">Oles</option>
                                                                        </select>

                                                                    </td>
                                                                    <td class="text-center align-middle"><input
                                                                            name="diminum[]"
                                                                            class="form-check-input form-check-input-sm"
                                                                            type="checkbox" value="P"
                                                                            id="flexCheckDefault" /></td>
                                                                    <td class="text-center align-middle"><input
                                                                            class="form-check-input form-check-input-sm"
                                                                            type="checkbox" value="S"
                                                                            name="diminum[]" id="flexCheckDefault" /></td>
                                                                    <td class="text-center align-middle"><input
                                                                            class="form-check-input form-check-input-sm"
                                                                            type="checkbox" value="SO"
                                                                            name="diminum[]" id="flexCheckDefault" /></td>
                                                                    <td class="text-center align-middle"><input
                                                                            class="form-check-input form-check-input-sm"
                                                                            type="checkbox" value="M"
                                                                            name="diminum[]" id="flexCheckDefault" /></td>
                                                                    <td>
                                                                        <div class="form-check form-check-inline mb-2">
                                                                            <input class="form-check-input" type="radio"
                                                                                name="takaran" id="kapsul"
                                                                                value="sebelum">
                                                                            <label class="form-check-label"
                                                                                for="tablet">Sebelum</label>
                                                                        </div>

                                                                        <div class="form-check form-check-inline">
                                                                            <input class="form-check-input" type="radio"
                                                                                name="takaran" id="kapsul"
                                                                                value="sesudah">
                                                                            <label class="form-check-label"
                                                                                for="kapsul">Sesudah</label>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center" width='10'>
                                                                        <input name="dtd"
                                                                            class="form-check-input form-check-input-sm"
                                                                            type="checkbox" value="1"
                                                                            id="dtd" />
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" name="catatan"
                                                                            class="form-control form-control-sm mb-2 mb-md-0"
                                                                            min="0">
                                                                    </td>
                                                                    <td>

                                                                        {{-- <button class="btn btn-sm btn-info">Racik</button> --}}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th colspan="10">
                                                                        <button type="submit" name="upload_racikan"
                                                                            id="upload_racikan"
                                                                            class="btn btn-primary btn-sm">
                                                                            <span class="indicator-label">
                                                                                Simpan Obat
                                                                            </span>
                                                                            <span class="indicator-progress">
                                                                                Prossesing... <span
                                                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                                            </span>
                                                                        </button>
                                                                    </th>
                                                                </tr>
                                                            </form>


                                                        </tbody>
                                                    </table>
                                                @endif
                                            </div>
                                        </div>

                                        <table id='list_resep' class="table table-bordered table-striped ">
                                            <thead class="fs-9">
                                                <tr>
                                                    <th>Nama Obat</th>
                                                    <th>Jumlah</th>
                                                    <th>Dosis</th>
                                                    <th>Sediaan</th>
                                                    <th>Aturan Pakai</th>
                                                    <th>Diminum</th>
                                                    <th>Catatan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody class="fs-7 bg-light-primary">
                                                @if (count($resep_dokter) > 0)
                                                    @foreach ($resep_dokter as $rd)
                                                        <tr id='li{{ $rd->id }}'>
                                                            @if ($rd->jenis == 'Racik')
                                                                @php
                                                                    $list_obat = json_decode($rd->nama_obat);

                                                                @endphp
                                                                <td>
                                                                    @foreach ($list_obat->obat as $ob)
                                                                        @if ($ob != null)
                                                                            {!! App\Helpers\VclaimHelper::get_data_obat($ob) . '+' !!}
                                                                        @endif
                                                                    @endforeach

                                                                    <span class="badge badge-success">Racikan</span>
                                                                </td>
                                                                <td>
                                                                    {{ $rd->dosis }}
                                                                </td>
                                                                <td>
                                                                    @foreach ($list_obat->jumlah as $ob)
                                                                        @if ($ob != null)
                                                                            {!! $ob !!} +
                                                                        @endif
                                                                    @endforeach
                                                                    <span class="badge badge-success">Racikan</span>

                                                                    {{ '(' . $rd->diberikan . ')' }}
                                                                </td>
                                                                <td>{{ $rd->takaran }}</td>
                                                                <td>{{ $rd->signa }}</td>
                                                                <td>{{ $rd->diminum }}
                                                                    {{ $rd->diminum == null ? '' : 'makan' }}</td>
                                                                <td>{{ $rd->catatan }}</td>
                                                                <td>
                                                                    <a class="btn btn-sm btn-danger btn-hapus"
                                                                        id='{{ $rd->id }}'
                                                                        href="javascript:void(0)"
                                                                        style='cursor:pointer;'>Hapus</a>
                                                                    <button data-id="{{ $rd->id }}"
                                                                        class="btn btn-sm btn-info btn-edit-racik">Edit</button>
                                                                </td>
                                                            @else
                                                                <td>{{ $rd->nama_obat }}</td>
                                                                <td role="button" id="{{ $resep }}">
                                                                    {{ $rd->jumlah }}</td>
                                                                <td>{{ $rd->dosis }}</td>
                                                                <td>{{ $rd->takaran }}</td>
                                                                <td>{{ $rd->signa }}</td>
                                                                <td>{{ $rd->diminum }}
                                                                    {{ $rd->diminum == null ? '' : 'makan' }}</td>
                                                                <td>{{ $rd->catatan }}</td>
                                                                <td>
                                                                    @if (auth()->user()->idpriv == 7)
                                                                        <a class="btn btn-sm btn-danger btn-hapus"
                                                                            id='{{ $rd->id }}'
                                                                            href="javascript:void(0)"
                                                                            style='cursor:pointer;'>Hapus</a>
                                                                        <button data-id="{{ $rd->id }}"
                                                                            class="btn btn-sm btn-info btn-edit">Edit</button>
                                                                    @endif
                                                                </td>
                                                            @endif

                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>

                                        <div class="card mt-10">
                                            <div class="card-header">
                                                <h3 class="card-title">Riwayat Obat</h3>
                                            </div>
                                            <div class="card-body">
                                                {{-- <span class="fs-5">*Hanya bisa menyalin obat non racikan</span> --}}
                                                <table id='tblRiwayatResep' class="table table-bordered mt-10">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Kode Resep</th>
                                                            <th>Tgl</th>
                                                            <th>Obat</th>
                                                            <th>Total Resep</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="tab-pane fade" id="kt_tab_pane_rb" role="tabpanel">
                                    <h5>Riwayat Berobat</h5>
                                    <div class="separator separator-dashed border-secondary mb-5 mt-5">
                                    </div>
                                    <div class="table-responsive">
                                        <table id="tbl_histori"
                                            class="table table-rounded table-striped border gy-7 gs-7">
                                            <thead>
                                                <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                                                    <th>Tgl.Kunjungan</th>
                                                    <th>Poliklinik</th>
                                                    <th>Dokter</th>
                                                    <th>Obat Obatan</th>
                                                    <th>Diagnosa</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($riwayat_berobat as $rb)
                                                    @php
                                                        $rekap_resume = App\Models\RekapMedis\DetailRekapMedis::where('idrekapmedis', $rb->id)->first();
                                                    @endphp
                                                    <tr data-id="{{ $rb->id }}">
                                                        <td>{{ $rb->created_at }}</td>
                                                        <td>{{ $rb->rawat?->poli?->poli }}</td>
                                                        <td>{{ $rb->rawat?->dokter?->nama_dokter }}</td>
                                                        <td>
                                                            @if ($rekap_resume)
                                                                {{-- @if ($rekap_resume->terapi_obat != 'null')
                                                                    @foreach (json_decode($rekap_resume->terapi_obat) as $val)
                                                                        @foreach ($obat as $item)
                                                                            @if ($val->obat == $item->id)
                                                                                {{ $item->nama_obat }}
                                                                                ({{ $val->signa1 }} x
                                                                                {{ $val->signa2 }} |
                                                                                {{ $val->jumlah_obat }})
                                                                                <br>
                                                                            @endif
                                                                        @endforeach
                                                                    @endforeach
                                                                @endif --}}
                                                                @if ($rekap_resume->terapi_obat != 'null')
                                                                    @foreach (json_decode($rekap_resume->terapi_obat) as $val)
                                                                    @endforeach
                                                                @endif
                                                            @endif
                                                        </td>
                                                        <td width=300>
                                                            @if ($rekap_resume)
                                                                {{ $rekap_resume?->diagnosa }}
                                                                <div
                                                                    class="separator separator-dashed border-secondary mb-5">
                                                                </div>
                                                                <h5>ICD X</h5>
                                                                <ul>
                                                                    @if ($rekap_resume->icdx != 'null')
                                                                        @foreach (json_decode($rekap_resume->icdx) as $val)
                                                                            <li>{{ $val->diagnosa_icdx }}
                                                                                @if (isset($val->jenis_diagnosa))
                                                                                    (<b>{{ $val->jenis_diagnosa == 'P' ? 'Primer' : 'Sekunder' }}</b>)
                                                                                @endif
                                                                            </li>
                                                                        @endforeach
                                                                    @endif

                                                                </ul>
                                                                <div
                                                                    class="separator separator-dashed border-secondary mb-5">
                                                                </div>
                                                                <h5>ICD IX</h5>
                                                                <ul>
                                                                    {{-- @if ($rekap_resume->icd9 != 'null')
                                                                        @foreach (json_decode($rekap_resume->icd9) as $val)
                                                                            <li>{{ $val->diagnosa_icdx }}</li>
                                                                        @endforeach
                                                                    @endif --}}
                                                                </ul>
                                                            @endif
                                                        </td>
                                                        <td width=200>
                                                            @if ($resume_medis)
                                                                <form action="{{ route('post.copy-data', $rawat->id) }}"
                                                                    method="post" id='formCopy{{ $rb->id }}'>
                                                                    @csrf
                                                                    <input type="hidden" name='idrekap'
                                                                        value="{{ $rb->id }}" name=""
                                                                        id="">
                                                                    <button type="button"
                                                                        onclick="modalHasil({{ $rb->id }})"
                                                                        class="btn btn-success btn-sm">Lihat</button>
                                                                    @if (auth()->user()->idpriv == 7)
                                                                        @if ($resume_medis->dokter != 1)
                                                                            <button
                                                                                class="btn btn-warning btn-sm">Copy</button>
                                                                        @endif
                                                                    @endif
                                                                </form>
                                                            @else
                                                                <form action="{{ route('post.copy-data', $rawat->id) }}"
                                                                    method="post" id='formCopy{{ $rb->id }}'>
                                                                    @csrf
                                                                    <input type="hidden" name='idrekap'
                                                                        value="{{ $rb->id }}" name=""
                                                                        id="">
                                                                    <button type="button"
                                                                        onclick="modalHasil({{ $rb->id }})"
                                                                        class="btn btn-success btn-sm">Lihat</button>
                                                                    @if (auth()->user()->idpriv == 7)
                                                                        <button
                                                                            class="btn btn-warning btn-sm">Copy</button>
                                                                    @endif
                                                                </form>
                                                            @endif


                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                                    @if (!$resume_medis)
                                        <form action="{{ route('post.resume-poli') }}" id="frmResume" method="post">
                                            @csrf
                                            <input type="hidden" name="idrawat" id="idrawat"
                                                value={{ $rawat->id }}>
                                            @if ($rawat->idjenisrawat == 1)
                                                <input type="hidden" name="idkategori" id="idkategori" value=1>
                                            @else
                                                <input type="hidden" name="idkategori" id="idkategori" value=3>
                                            @endif
                                            <input type="hidden" name='idpasien' value={{ $pasien->id }}>
                                            <button class="btn btn-warning btn-sm">Input Resume</button>
                                        </form>
                                    @else
                                        @if (!$resume_detail)
                                            <form action="{{ route('post.resume-poli') }}" id="frmResume"
                                                method="post">
                                                @csrf
                                                <input type="hidden" name="idrawat" id="idrawat"
                                                    value={{ $rawat->id }}>
                                                @if ($rawat->idjenisrawat == 1)
                                                    <input type="hidden" name="idkategori" id="idkategori" value=1>
                                                @else
                                                    <input type="hidden" name="idkategori" id="idkategori" value=3>
                                                @endif
                                                <input type="hidden" name='idpasien' value={{ $pasien->id }}>
                                                <button class="btn btn-warning btn-sm">Input Resume</button>
                                            </form>
                                        @else
                                            @if ($resume_detail)
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ route('detail-rekap-medis-cetak', $resume_detail->id) }}"
                                                    target="blank">Print</a>
                                                @if (auth()->user()->idpriv == 20)
                                                    <a class="btn btn-light-success btn-sm"
                                                        href="{{ route('detail-rekap-medis-show', $resume_detail->id) }}">Edit</a>
                                                @endif
                                                <div class="separator separator-dashed border-secondary mb-5 mt-5">
                                                </div>
                                            @endif
                                            <table class="table table-striped table-row-bordered gy-3 gs-5 border rounded">
                                                <thead class="border">
                                                    <tr class="fw-bold fs-6 text-gray-800 px-7">
                                                        <th>Diagnosa</th>
                                                        <th>Anamnesa</th>
                                                        <th>Rencana Pemeriksaan</th>
                                                        <th>Opsi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($resume_detail)
                                                        @php
                                                            $alergi = json_decode($resume_detail->alergi);
                                                            $pfisik = json_decode($resume_detail->pemeriksaan_fisik);
                                                            $rkesehatan = json_decode($resume_detail->riwayat_kesehatan);

                                                        @endphp
                                                        <tr>
                                                            <td width=300>
                                                                {{ $resume_detail?->diagnosa }}
                                                                <div
                                                                    class="separator separator-dashed border-secondary mb-5">
                                                                </div>
                                                                <h5>ICD X</h5>
                                                                @if ($resume_detail->icdx != 'null')
                                                                    <ul>
                                                                        @foreach (json_decode($resume_detail?->icdx) as $val)
                                                                            <li>{{ $val->diagnosa_icdx }}
                                                                                (<b>{{ $val->jenis_diagnosa == 'P' ? 'Primer' : 'Sekunder' }}</b>)
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                                <div
                                                                    class="separator separator-dashed border-secondary mb-5">
                                                                </div>
                                                                <h5>ICD IX</h5>
                                                                @if ($resume_detail->icd9 != 'null')
                                                                    <ul>
                                                                        @foreach (json_decode($resume_detail?->icd9) as $val)
                                                                            <li>{{ $val->diagnosa_icd9 }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </td>
                                                            <td width=300>
                                                                {{ $resume_detail?->anamnesa_dokter }}
                                                                @if ($rawat->idpoli == 12)
                                                                    @php
                                                                        $pemeriksaan_fisio = json_decode($resume_detail->pemeriksaan_fisio);
                                                                    @endphp
                                                                    <hr>
                                                                    <table>
                                                                        <tr>
                                                                            <td>&nbsp;&nbsp;Pemeriksaan Fisik</td>
                                                                            <td class="text-start">:
                                                                                {{ $pemeriksaan_fisio->pemeriksaan_fisik ? $pemeriksaan_fisio->pemeriksaan_fisik : '-' }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;&nbsp;Pemeriksaan Uji Fungsi</td>
                                                                            <td class="text-start">:
                                                                                {{ $pemeriksaan_fisio->pemeriksaan_uji_fungsi ? $pemeriksaan_fisio->pemeriksaan_uji_fungsi : '-' }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;&nbsp;Tata Laksana</td>
                                                                            <td class="text-start">:
                                                                                {{ $pemeriksaan_fisio->tata_laksana ? $pemeriksaan_fisio->tata_laksana : '-' }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;&nbsp;Anjuran</td>
                                                                            <td class="text-start">:
                                                                                {{ $pemeriksaan_fisio->anjuran ? $pemeriksaan_fisio->anjuran : '-' }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>&nbsp;&nbsp;evaluasi</td>
                                                                            <td class="text-start">:
                                                                                {{ $pemeriksaan_fisio->evaluasi ? $pemeriksaan_fisio->evaluasi : '-' }}
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                {{ $resume_detail?->rencana_pemeriksaan }}
                                                                @if ($resume_detail->radiologi != 'null')
                                                                    <div
                                                                        class="separator separator-dashed border-secondary mb-5">
                                                                    </div>
                                                                    <h5>Radiologi</h5>
                                                                    <ul>
                                                                        @foreach (json_decode($resume_detail->radiologi) as $val)
                                                                            @foreach ($radiologi as $item)
                                                                                @if ($val->tindakan_rad == $item->id)
                                                                                    <li>{{ $item->nama_tindakan }}</li>
                                                                                @endif
                                                                            @endforeach
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                                @if ($resume_detail->laborat != 'null')
                                                                    <div
                                                                        class="separator separator-dashed border-secondary mb-5">
                                                                    </div>
                                                                    <h5>Lab</h5>
                                                                    <ul>
                                                                        @foreach (json_decode($resume_detail->laborat) as $val)
                                                                            @foreach ($lab as $item)
                                                                                @if ($val->tindakan_lab == $item->id)
                                                                                    <li>{{ $item->nama_pemeriksaan }}</li>
                                                                                @endif
                                                                            @endforeach
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                                @if ($resume_detail->fisio != 'null')
                                                                    <div
                                                                        class="separator separator-dashed border-secondary mb-5">
                                                                    </div>
                                                                    <h5>Fisio</h5>
                                                                    <ul>
                                                                        @foreach (json_decode($resume_detail->fisio) as $val)
                                                                            {{-- <li>{{ $val->tindakan_fisio }}</li> --}}
                                                                            @foreach ($fisio as $item)
                                                                                @if ($val->tindakan_fisio == $item->id)
                                                                                    <li>{{ $item->nama_tarif }}</li>
                                                                                @endif
                                                                            @endforeach
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </td>
                                                            {{-- <td width=200>
                                                                {{ $resume_detail?->terapi }}
                                                                <div
                                                                    class="separator separator-dashed border-secondary mb-5">
                                                                </div>
                                                                @if ($resume_detail->terapi_obat != 'null')
                                                                    <h5>Obat & Alkes</h5>

                                                                    @if ($resume_detail->terapi_obat != 'null')
                                                                        @foreach (json_decode($resume_detail->terapi_obat) as $val)
                                                                            @if (isset($val->terapi_obat_racikan))
                                                                                <div class="card card-border mb-2">
                                                                                    <div class="card-body">
                                                                                        @foreach ($val->terapi_obat_racikan as $data_obat)
                                                                                            @foreach ($obat as $item)
                                                                                                @if ($data_obat->obat == $item->id)
                                                                                                    {{ $item->nama_obat }}
                                                                                                    {{ $data_obat->jumlah_obat }}
                                                                                                    {{ isset($data_obat->dosis_obat) ? $data_obat->dosis_obat : '' }}
                                                                                                    <br>
                                                                                                @endif
                                                                                            @endforeach
                                                                                        @endforeach
                                                                                        ({{ $val->signa1 }} -
                                                                                        {{ $val->signa2 }} -
                                                                                        {{ isset($val->signa3) ? $val->signa3 : '' }})
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                @endif
                                                            </td> --}}
                                                            <td>
                                                                @if (auth()->user()->idpriv == 7)
                                                                    @if ($resume_medis->dokter != 1)
                                                                        <a href="{{ route('detail-rekap-medis-show', $resume_detail->id) }}"
                                                                            class="btn btn-warning btn-sm">Edit</a>
                                                                    @endif

                                                                    @if ($resume_detail->terapi_obat != 'null')
                                                                        <a href="{{ route('resep-rekap-medis-cetak', $resume_detail->id) }}"
                                                                            class="btn btn-info btn-sm">Print Resep</a>
                                                                    @endif
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endif

                                                </tbody>
                                            </table>
                                            <div class="separator separator-dashed border-secondary mb-5 mt-5">
                                            </div>
                                            <table class="table table-striped table-row-bordered gy-3 gs-5 border rounded">
                                                <thead class="border">
                                                    <tr class="fw-bold fs-6 text-gray-800 px-7">
                                                        <th>Anamnesa Perawat</th>
                                                        <th>Pemeriksaan Fisik</th>
                                                        <th>Riwayat Kesehatan</th>
                                                        <th>Alergi</th>
                                                        <th>Obat yang dikonsumsi</th>
                                                        <th>Opsi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($resume_detail)
                                                        <td>{{ $resume_detail->anamnesa }}</td>
                                                        <td>
                                                            <table>
                                                                <tr>
                                                                    <td>&nbsp;&nbsp;Tekanan Darah</td>
                                                                    <td class="text-start">:
                                                                        {{ $pfisik->tekanan_darah ? $pfisik->tekanan_darah : '-' }}
                                                                        mmHg</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>&nbsp;&nbsp;Nadi</td>
                                                                    <td class="text-start">:
                                                                        {{ $pfisik->nadi ? $pfisik->nadi : '-' }} x/menit
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>&nbsp;&nbsp;Pernapasan</td>
                                                                    <td class="text-start">:
                                                                        {{ $pfisik->pernapasan ? $pfisik->pernapasan : '-' }}
                                                                        x/menit</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>&nbsp;&nbsp;Saturasi oksigen (SpO2)</td>
                                                                    <td class="text-start">:
                                                                        {{ isset($pfisik->spo2) ? $pfisik->spo2 : '-' }} %
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>&nbsp;&nbsp;Suhu</td>
                                                                    <td class="text-start">:
                                                                        {{ $pfisik->suhu ? $pfisik->suhu : '-' }} celcius
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>&nbsp;&nbsp;Berat Badan</td>
                                                                    <td class="text-start">:
                                                                        {{ $pfisik->berat_badan ? $pfisik->berat_badan : '-' }}
                                                                        Kg</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>&nbsp;&nbsp;Tinggi Badan</td>
                                                                    <td class="text-start">:
                                                                        {{ $pfisik->tinggi_badan ? $pfisik->tinggi_badan : '-' }}
                                                                        Cm</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>&nbsp;&nbsp;BMI</td>
                                                                    <td class="text-start">:
                                                                        {{ $pfisik->bmi ? $pfisik->bmi : '-' }} Kg/M2</td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td>
                                                            <table>
                                                                <tr>
                                                                    <td>&nbsp;&nbsp;Riwayat penyakit yang lalu</td>
                                                                    <td class="text-start">:
                                                                        {{ $rkesehatan->riwayat_1 == 1 ? 'Ya' : 'Tidak' }}
                                                                    </td>
                                                                </tr>
                                                                @if ($rkesehatan->value_riwayat_1 != null)
                                                                    <td class="fw-bold" colspan="2">
                                                                        &nbsp;&nbsp;{{ $rkesehatan->value_riwayat_1 }}
                                                                        <hr>
                                                                    </td>
                                                                @endif
                                                                <tr>
                                                                    <td>&nbsp;&nbsp;Pernah dirawat</td>
                                                                    <td class="text-start">:
                                                                        {{ $rkesehatan->riwayat_2 == 1 ? 'Ya' : 'Tidak' }}
                                                                    </td>
                                                                </tr>
                                                                @if ($rkesehatan->value_riwayat_2 != null)
                                                                    <td class="fw-bold" colspan="2">
                                                                        &nbsp;&nbsp;{{ $rkesehatan->value_riwayat_2 }}
                                                                        <hr>
                                                                    </td>
                                                                @endif
                                                                <tr>
                                                                    <td>&nbsp;&nbsp;Pernah dioperasi</td>
                                                                    <td class="text-start">:
                                                                        {{ $rkesehatan->riwayat_3 == 1 ? 'Ya' : 'Tidak' }}
                                                                    </td>
                                                                </tr>
                                                                @if ($rkesehatan->value_riwayat_3 != null)
                                                                    <td class="fw-bold" colspan="2">
                                                                        &nbsp;&nbsp;{{ $rkesehatan->value_riwayat_3 }}
                                                                        <hr>
                                                                    </td>
                                                                @endif
                                                                <tr>
                                                                    <td>&nbsp;&nbsp;Dalam Pengobatan Khusus</td>
                                                                    <td class="text-start">:
                                                                        {{ $rkesehatan->riwayat_4 == 1 ? 'Ya' : 'Tidak' }}
                                                                    </td>
                                                                </tr>
                                                                @if ($rkesehatan->value_riwayat_4 != null)
                                                                    <td class="fw-bold" colspan="2">
                                                                        &nbsp;&nbsp;{{ $rkesehatan->value_riwayat_4 }}
                                                                        <hr>
                                                                    </td>
                                                                @endif
                                                            </table>
                                                        </td>
                                                        <td>
                                                            <ul>
                                                                <li>Obat :
                                                                    <b>{{ $alergi->value_obat ? $alergi->value_obat : '-' }}</b>
                                                                </li>
                                                                <li>Makanan :
                                                                    <b>{{ $alergi->value_makanan ? $alergi->value_makanan : '-' }}</b>
                                                                </li>
                                                                <li>Lain Lain :
                                                                    <b>{{ $alergi->value_lain ? $alergi->value_lain : '-' }}</b>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                        <td>{{ $resume_detail->obat_yang_dikonsumsi }}</td>
                                                        <td>
                                                            @if (auth()->user()->idpriv >= 14)
                                                                @if ($resume_medis->perawat != 1)
                                                                    <a href="{{ route('detail-rekap-medis-show', $resume_detail->id) }}"
                                                                        class="btn btn-warning btn-sm">Edit</a>
                                                                @endif
                                                            @endif
                                                        </td>
                                                    @endif
                                                </tbody>
                                            </table>
                                        @endif

                                    @endif
                                </div>

                                <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
                                    <h4>Rencana Tindak Lanjut</h4>
                                    @if (!$tindak_lanjut)
                                        <form action="{{ route('tindak-lanjut.index') }}" method="post"
                                            id='frmTindakLanjut'>
                                            @csrf
                                            <input type="hidden" name='idrawat' value="{{ $rawat->id }}">
                                            <input type="hidden" name='idbayar' value="{{ $rawat->idbayar }}">
                                            <button class="btn btn-info btn-sm">Tindak Lanjut</button>
                                        </form>
                                    @else
                                        <table class="table table-striped table-row-bordered gy-3 gs-5 border rounded">
                                            <thead class="border">
                                                <tr class="fw-bold fs-6 text-gray-800 px-7">
                                                    <th>Tindak Lanjut</th>
                                                    <th>Tujuan Lanjut</th>
                                                    <th>Poli Tujuan</th>
                                                    <th>Tgl Tindak Lanjut</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        @if ($tindak_lanjut->tindak_lanjut == 'Dirawat')
                                                            {{ $tindak_lanjut->tindak_lanjut }} :
                                                            <br>DPJP : {{ $tindak_lanjut->dokter?->nama_dokter }}
                                                        @elseif($tindak_lanjut->tindak_lanjut == 'Prb')
                                                            Rujuk Balik {{ $tindak_lanjut->prb }}
                                                        @else
                                                            {{ $tindak_lanjut->tindak_lanjut }} :
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($tindak_lanjut->operasi == 1)
                                                            Operasi : {{ $tindak_lanjut->tindakan_operasi }}
                                                        @endif
                                                        {{ $tindak_lanjut->tujuan_tindak_lanjut }}
                                                    </td>
                                                    <td>{{ $tindak_lanjut->poli_rujuk }}</td>
                                                    <td>{{ $tindak_lanjut->tgl_tindak_lanjut }}</td>
                                                    <td>

                                                        <form action="{{ route('tindak-lanjut.hapus_tindak_lanjut') }}"
                                                            method="post" id='hps-tindak-lanjut'>
                                                            @csrf
                                                            <input type="hidden" name="id" id="id"
                                                                value="{{ $tindak_lanjut->id }}">
                                                            <a
                                                                href="{{ route('tindak-lanjut.edit_tindak_lanjut', $tindak_lanjut->id) }}"class="btn btn-info btn-sm">Edit</a>
                                                            <button class="btn btn-danger btn-sm">Hapus</button>
                                                        </form>

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        @if ($tindak_lanjut->tindak_lanjut == 'Dirawat')
                                            <button data-bs-toggle="modal" data-bs-target="#modal-sbar"
                                                class="btn btn-warning">SBAR</button>
                                        @endif
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="kt_tab_pane_4" role="tabpanel">
                                    {{-- @if ($rawat->status == 4) --}}
                                    @if ($resume_medis)
                                        @if ($resume_medis->dokter == 1 && $resume_medis->perawat == 1)
                                            @if ($resume_medis?->tindakan != null)
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Tindakan</th>
                                                            <th>Dokter</th>
                                                            <th>Jumlah</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach (json_decode($resume_medis->tindakan) as $st)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>
                                                                    @foreach ($tarif as $val)
                                                                        @if ($st->tindakan == $val->id)
                                                                            {{ $val->nama_tarif }}
                                                                        @endif
                                                                    @endforeach
                                                                </td>
                                                                <td>
                                                                    @foreach ($dokter as $val)
                                                                        @if ($st->dokter == $val->id)
                                                                            {{ $val->nama_dokter }}
                                                                        @endif
                                                                    @endforeach
                                                                </td>
                                                                <td>{{ $st->jumlah }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @endif
                                        @else
                                            <form action="{{ route('post.tindakan', $rawat->id) }}" method="post"
                                                id=frmTindakan>
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div id="kt_tindakan_repeater">
                                                            <!--begin::Form group-->
                                                            <div class="form-group">
                                                                <div data-repeater-list="tindakan_repeater">
                                                                    @if ($resume_medis?->tindakan != null)
                                                                        @foreach (json_decode($resume_medis->tindakan) as $st)
                                                                            <div data-repeater-item>
                                                                                <div class="form-group row mb-5">
                                                                                    <div class="col-md-4">
                                                                                        <label
                                                                                            class="form-label">Tindakan</label>
                                                                                        <select name="tindakan"
                                                                                            class="form-select"
                                                                                            data-kt-repeater="select22"
                                                                                            data-placeholder="-Pilih-"required>
                                                                                            <option></option>
                                                                                            @foreach ($tarif as $val)
                                                                                                <option
                                                                                                    value="{{ $val->id }}"
                                                                                                    {{ $st->tindakan == $val->id ? 'selected' : '' }}>
                                                                                                    {{ $val->nama_tarif }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <label
                                                                                            class="form-label">Dokter</label>
                                                                                        <select name="dokter"
                                                                                            class="form-select"
                                                                                            data-kt-repeater="select22"
                                                                                            data-placeholder="-Pilih-">
                                                                                            <option></option>
                                                                                            @foreach ($dokter as $val)
                                                                                                <option
                                                                                                    value="{{ $val->id }}"
                                                                                                    {{ $st->dokter == $val->id ? 'selected' : '' }}>
                                                                                                    {{ $val->nama_dokter }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-md-2">
                                                                                        <label
                                                                                            class="form-label">Jumlah</label>
                                                                                        <input type="number"
                                                                                            name="jumlah"
                                                                                            class="form-control mb-5 mb-md-0"
                                                                                            value="{{ $st->jumlah }}"
                                                                                            min="0"required />
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <a href="javascript:;"
                                                                                            data-repeater-delete
                                                                                            class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                                                            <i
                                                                                                class="ki-duotone ki-trash fs-5"><span
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
                                                                        @endforeach
                                                                    @else
                                                                        <div data-repeater-item>
                                                                            <div class="form-group row mb-5">
                                                                                <div class="col-md-4">
                                                                                    <label
                                                                                        class="form-label">Tindakan</label>
                                                                                    <select name="tindakan"
                                                                                        class="form-select"
                                                                                        data-kt-repeater="select22"
                                                                                        data-placeholder="-Pilih-"required>
                                                                                        <option></option>
                                                                                        @foreach ($tarif as $val)
                                                                                            <option
                                                                                                value="{{ $val->id }}">
                                                                                                {{ $val->nama_tarif }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <label
                                                                                        class="form-label">Dokter</label>
                                                                                    <select name="dokter"
                                                                                        class="form-select"
                                                                                        data-kt-repeater="select22"
                                                                                        data-placeholder="-Pilih-">
                                                                                        <option></option>
                                                                                        @foreach ($dokter as $val)
                                                                                            <option
                                                                                                {{ $rawat->iddokter == $val->id ? 'selected' : '' }}
                                                                                                value="{{ $val->id }}">
                                                                                                {{ $val->nama_dokter }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <label
                                                                                        class="form-label">Jumlah</label>
                                                                                    <input type="number" name="jumlah"
                                                                                        class="form-control mb-5 mb-md-0"
                                                                                        min="0"required />
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <a href="javascript:;"
                                                                                        data-repeater-delete
                                                                                        class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                                                        <i
                                                                                            class="ki-duotone ki-trash fs-5"><span
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
                                                                    @endif

                                                                </div>
                                                            </div>
                                                            <!--end::Form group-->

                                                            <!--begin::Form group-->
                                                            <div class="form-group mt-5">
                                                                <a href="javascript:;" data-repeater-create
                                                                    class="btn btn-light-primary">
                                                                    <i class="ki-duotone ki-plus fs-3"></i>
                                                                    Tambah Tindakan
                                                                </a>
                                                            </div>
                                                            <!--end::Form group-->
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="separator separator-dashed border-secondary mb-5 mt-5">
                                                </div>

                                                <button class="btn btn-info ">Simpan Tindakan</button>
                                            </form>
                                        @endif
                                    @else
                                        Silahkan Input Resume Medis Terlebih Dahulu
                                    @endif
                                    {{-- @else
                                        @if ($resume_medis)
                                            
                                        @else
                                            Silahkan Input Resume Medis Terlebih Dahulu
                                        @endif
                                    @endif --}}




                                </div>
                                <div class="tab-pane fade" id="kt_tab_pane_5" role="tabpanel">
                                    <h5>Hasil Pemeriksaan Lab</h5>
                                    <div class="separator separator-dashed border-secondary mt-5 mb-5"></div>
                                    @if ($pemeriksaan_lab)
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Pemeriksaan</th>
                                                    <th>Tgl Pemeriksaan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pemeriksaan_lab as $pl)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $pl->labid }}</td>
                                                        <td>{{ $pl->tgl_hasil }}</td>
                                                        <td>
                                                            @php
                                                                $pemeriksaan_lab_detail = DB::table('laboratorium_hasildetail')
                                                                    ->where('idhasil', $pl->id)
                                                                    ->get();
                                                            @endphp
                                                            <ol>
                                                                @foreach ($pemeriksaan_lab_detail as $plb)
                                                                    <li>
                                                                        <a href="#"
                                                                            onclick="modalHasilLab({{ $plb->id }})">{{ $plb->nama_pemeriksaan }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ol>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    @endif
                                    <h5>Hasil Pemeriksaan Radiologi</h5>
                                    <div class="separator separator-dashed border-secondary mt-5 mb-5"></div>
                                    @if ($pemeriksaan_radiologi)
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Pemeriksaan</th>
                                                    <th>Tgl Pemeriksaan</th>
                                                    <th>Pemeriksaan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pemeriksaan_radiologi as $pr)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $pr->idhasil }}</td>
                                                        <td>{{ $pr->tgl_hasil }}</td>
                                                        <td>
                                                            @php
                                                                $pemeriksaan_radio_detail = DB::table('radiologi_hasildetail')
                                                                    ->where('idhasil', $pr->id)
                                                                    ->get();
                                                            @endphp
                                                            <ol>
                                                                @foreach ($pemeriksaan_radio_detail as $pld)
                                                                    @php
                                                                        $tindakan = DB::table('radiologi_tindakan')
                                                                            ->where('id', $pld->idtindakan)
                                                                            ->first();
                                                                    @endphp
                                                                    <li>
                                                                        <a href="#"
                                                                            onclick="modalHasilRad({{ $pld->id }})">{{ $tindakan->nama_tindakan }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ol>

                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="kt_tab_pane_6" role="tabpanel">
                                    <h5>Upload Hasil Pemerikasaan Penunjang Luar</h5>
                                    <form action="{{ route('post.upload-pengantar', $rawat->id) }}"
                                        id='frmPengantarluar' method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="">Deskripsi File</label>
                                                        <input type="text" required class="form-control"
                                                            name="keterangan_file">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="">Upload File</label>
                                                        <input type="file" accept=".pdf,.jpeg,.jpg,.png" required
                                                            class="form-control" name="file_penunjang_luar">
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-sm mt-10">Upload</button>
                                    </form>
                                    @if (count($pemeriksaan_luar) > 0)
                                        <div class="separator separator-dashed border-secondary mt-5 mb-5"></div>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>File </th>
                                                    <th>Keterangan </th>
                                                    <th>Aksi </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pemeriksaan_luar as $pl)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            <a target="_blnk"
                                                                href="{{ asset('storage/file-penunjang-luar/' . $pl->nama_file) }}">{{ $pl->nama_file }}</a>
                                                        </td>
                                                        <td>{{ $pl->keterangan_file }}</td>
                                                        <td>
                                                            <form action="{{ route('post.delete-pengantar') }}"
                                                                method="post" id='frmDeletefile'>
                                                                @csrf
                                                                <input type="hidden" name="id" id="id"
                                                                    value="{{ $pl->id }}">
                                                                <button class="btn btn-sm btn-danger">Hapus</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                            </div>
                            <div class="separator separator-dashed border-secondary mb-5"></div>
                            <button id='icare-view' data-id="{{ $rawat->dokter?->kode_dpjp }}"
                                data-bpjs="{{ $pasien->no_bpjs }}" class="btn btn-light-success">I CARE</button>
                        </div>

                        <div class="separator separator-dashed border-secondary mt-5 mb-5"></div>
                        <h4>Histori Pasien</h4>
                        <table id="tbl-rekap" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                            <thead class="border">
                                <tr class="fw-bold fs-6 text-gray-800 px-7">
                                    <th>No</th>
                                    <th>Kunjungan</th>
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

    <!-- Modal -->
    <div class="modal fade" id="modal-sbar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">SBAR</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="frm-data" action="{{ route('detail-rekap-medis.post_sbar', $rawat->id) }}" method="POST"
                    autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-5">
                            <label class="form-label">Situation</label>
                            <textarea name="situation" class="form-control" required id="" rows=4></textarea>
                        </div>
                        <div class="row mb-5">
                            <label class="form-label">Background</label>
                            <textarea name="background" class="form-control" required id="" rows=4></textarea>
                        </div>
                        <div class="row mb-5">
                            <label class="form-label">Assesment</label>
                            <textarea name="assesment" class="form-control" required id="" rows=4></textarea>
                        </div>
                        <div class="row mb-5">
                            <label class="form-label">Recomendation</label>
                            <textarea name="recomendation" class="form-control" required id="" rows=4></textarea>
                        </div>
                        <div class="row mb-5">
                            <label class="form-label">Intruksi / Anjuran</label>
                            <textarea name="intruksi" class="form-control" required id="" rows=4></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="modal_lihat">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div id="modal-hasil">

                </div>
            </div>
        </div>
    </div>


@endsection
@section('js')
    <script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js"></script>
    <script>
        @if ($resume_medis)
            document.getElementById("confirmButton").addEventListener("click", function() {
                // Add your confirmation logic here
                Swal.fire({
                    title: 'Simpan Template',
                    text: "Yakin Menyimpan Template",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
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
                        window.location.href = "{{ route('update-template', $resume_medis->id) }}";
                    }
                });

            });
        @endif
        $(document).on('click', '#icare-view', function() {
            var dokter = $(this).attr('data-id');
            var bpjs = $(this).attr('data-bpjs');
            var url = '{{ route('get-icare', [':b_id', ':p_value']) }}';
            url = url.replace(':b_id', dokter);
            url = url.replace(':p_value', bpjs);
            $.get(url).done(function(data) {
                // console.log(data.status);
                if (data.status == false) {
                    Swal.fire({
                        text: 'Data Tidak Ditemukan',
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }else{
                    $("#modal-hasil").html(data);
                    $("#modal_lihat").modal('show');
                }
            });
        });
        $(document).on('click', '.btn-edit', function() {
            var value = $(this).attr('data-id');
            url = "{{ route('get-data-obat', '') }}" + "/" + value;
            $("#modal-hasil").empty();
            $.get(url).done(function(data) {
                $("#modal-hasil").html(data);
                $("#modal_lihat").modal('show');
            });
        });

        $(document).on('click', '.btn-edit-racik', function() {
            var value = $(this).attr('data-id');
            url = "{{ route('get-data-racik-obat', '') }}" + "/" + value;
            $("#modal-hasil").empty();
            $.get(url).done(function(data) {
                $("#modal-hasil").html(data);
                $("#modal_lihat").modal('show');
            });
        });

        function modalHasilLab(id) {
            // alert(id)
            url = "{{ route('get-hasil-lab', '') }}" + "/" + id;
            $("#modal-hasil").empty();
            $.get(url).done(function(data) {
                $("#modal-hasil").html(data);
                $("#modal_lihat").modal('show');
            });
        }

        function modalHasilRad(id) {
            // alert(id)
            url = "{{ route('get-hasil-rad', '') }}" + "/" + id;
            $("#modal-hasil").empty();
            $.get(url).done(function(data) {
                $("#modal-hasil").html(data);
                $("#modal_lihat").modal('show');
            });
        }

        function modalHasil(id) {
            url = "{{ route('get-hasil', '') }}" + "/" + id;
            $("#modal-hasil").empty();
            $.get(url).done(function(data) {
                $("#modal-hasil").html(data);
                $("#modal_lihat").modal('show');
            });
        }



        $(function() {



            $("#tblRiwayatResep").DataTable({
                "language": {
                    "lengthMenu": "Show _MENU_",
                },
                "dom": "<'row'" +
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
                ajax: '{{ route('rekam-medis-poli.data-resep', [$rawat->no_rm, $rawat->id]) }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'kode_resep',
                        name: 'kode_resep'
                    },
                    {
                        data: 'tgl',
                        name: 'tgl'
                    },
                    {
                        data: 'data_obat',
                        name: 'data_obat'
                    },
                    {
                        data: 'total_harga',
                        name: 'total_harga'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                ]
            });
            $("#tbl_histori").DataTable({
                "language": {
                    "lengthMenu": "Show _MENU_",
                },
                "dom": "<'row'" +
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
            });
            $("#tbl-rekap").DataTable({
                "language": {
                    "lengthMenu": "Show _MENU_",
                },
                "dom": "<'row'" +
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
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'kategori',
                        name: 'kategori.nama'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'opsi',
                        name: 'opsi',
                        orderable: false,
                        searcheable: false
                    },
                ]
            });
            $('#kt_tindakan_repeater').repeater({
                initEmpty: false,

                show: function() {
                    $(this).slideDown();

                    $(this).find('[data-kt-repeater="select22"]').select2({
                        allowClear: true,
                    });
                },

                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                },

                ready: function() {
                    $('[data-kt-repeater="select22"]').select2({
                        allowClear: true,
                    });
                }
            });
            $("#frm-data").on("submit", function(event) {
                event.preventDefault();
                var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
                Swal.fire({
                    title: 'Simpan SBAR',
                    text: "Yakin Menyimpan Data SBAR",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
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
            $("#frmPengantarluar").on("submit", function(event) {
                event.preventDefault();
                var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
                Swal.fire({
                    title: 'Upload Pengantar',
                    text: "Upload Pengantar?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
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
            $("#frmTindakLanjut").on("submit", function(event) {
                event.preventDefault();
                var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
                Swal.fire({
                    title: 'Tindak Lanjut',
                    text: "Tindak Lanjut?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
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
            $("#frmTindakan").on("submit", function(event) {
                event.preventDefault();
                var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
                Swal.fire({
                    title: 'Simpan Tindakan',
                    text: "Yakin menyimpan tindakan ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
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
            $("#frmResume").on("submit", function(event) {
                event.preventDefault();
                var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
                Swal.fire({
                    title: 'Input Resume',
                    text: "Apakah Anda yakin menginput resume ?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
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
            $("#frmSelesai").on("submit", function(event) {
                event.preventDefault();
                var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
                Swal.fire({
                    title: 'Selesai Pemerikasaan',
                    text: "Apakah Anda yakin menyelesaikan pemerikasaan ? Pemerikasaan tidak dapat diubah kembali setelah disimpan",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
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
            @foreach ($riwayat_berobat as $rb)
                $("#formCopy{{ $rb->id }}").on("submit", function(event) {
                    event.preventDefault();
                    var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
                    Swal.fire({
                        title: 'Copy Data Pemeriksaan',
                        text: "Apakah Anda yakin menyalin data ?",
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya',
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
            @endforeach


        });

        $("#hps-tindak-lanjut").on("submit", function(event) {
            event.preventDefault();
            var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
            Swal.fire({
                title: 'Hapus Data',
                text: "Apakah Anda yakin akan hapus data ini ?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus Data',
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
        $("#frmDeletefile").on("submit", function(event) {
            event.preventDefault();
            var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
            Swal.fire({
                title: 'Hapus File',
                text: "Apakah Anda yakin akan hapus file ini ?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus File',
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

        $(document).ready(function() {

            $('#frmNonracikan').on('submit', function(event) {
                const form = document.getElementById('frmNonracikan');
                const submitButton = document.getElementById('upload');

                event.preventDefault();
                $.ajax({
                    url: "{{ route('rekap-medis.post_resep_non_racikan', $rawat->id) }}",
                    method: "POST",
                    data: new FormData(this),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {

                        submitButton.setAttribute('data-kt-indicator', 'on');
                        submitButton.disabled = true;
                    },
                    success: function(data) {
                        console.log(data)
                        submitButton.setAttribute('data-kt-indicator', 'off');
                        submitButton.disabled = false;
                        Swal.fire(
                            'Obat Tersimpan',
                            '',
                            'success'
                        )


                        $('#nama_obat').val(null).trigger('change');
                        $('#takaran_obat').val(null).trigger('change');
                        $('input[type="text"]').val('');
                        $('input[type="number"]').val('');
                        $('input[type="checkbox"]').prop('checked', false);
                        $('input[type="radio"]').prop('checked', false);
                        // $('#message').css('display', 'block');
                        // $('#message').html(data.message);
                        // $('#message').addClass(data.class_name);
                        // $('#data_name').val('');
                        // $('#data_file').val('');
                        $('#list_resep > tbody:last-child').append(data.data);
                    }
                })

            });

            $('#frmRacikan').on('submit', function(event) {
                const form = document.getElementById('frmRacikan');
                const submitButton = document.getElementById('upload_racikan');
                var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
                event.preventDefault();
                $.ajax({
                    url: "{{ route('rekap-medis.post_resep_racikan', $rawat->id) }}",
                    method: "POST",
                    data: new FormData(this),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        submitButton.setAttribute('data-kt-indicator', 'on');
                        submitButton.disabled = true;
                    },
                    success: function(data) {

                        submitButton.setAttribute('data-kt-indicator', 'off');
                        submitButton.disabled = false;
                        Swal.fire(
                            'Obat Tersimpan',
                            '',
                            'success'
                        )
                        $('#nama_obat').val(null).trigger('change');
                        $('#takaran_obat').val(null).trigger('change');
                        $('select').val(null).trigger('change');
                        $('input[type="text"]').val('');
                        $('input[type="text"]').val('');
                        $('input[type="number"]').val('');
                        $('input[type="checkbox"]').prop('checked', false);
                        $('input[type="radio"]').prop('checked', false);
                        // $('#message').css('display', 'block');
                        // $('#message').html(data.message);
                        // $('#message').addClass(data.class_name);
                        // $('#data_name').val('');
                        // $('#data_file').val('');
                        $('#list_resep > tbody:last-child').append(data.data);
                        console.log(data.data)
                    }
                })

            });

        });

        $(document).on('click', '.btn-hapus', function() {

            e = $(this)
            iddata = $(e).attr('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '{{ route('post.delete-resep') }}',
                data: {
                    id: $(e).attr('id')
                },
                success: function(res) {
                    Swal.fire(
                        'Hapus berhasil',
                        '',
                        'success'
                    )
                    $('#li' + iddata).remove();
                }
            })
        })
    </script>
@endsection
