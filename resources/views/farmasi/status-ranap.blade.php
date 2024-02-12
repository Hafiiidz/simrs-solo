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
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Farmasi
                            Ranap</h1>
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
                            <li class="breadcrumb-item text-muted">Farmasi Ranap</li>
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
                                        <span class="md-bold fs-6 text-gray-800">{{ $pasien->no_rm }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row p-2">
                                    <label class="col-md-4 fw-semibold text-muted">Nama Pasien</label>
                                    <div class="col-md-8">
                                        <span class="md-bold fs-6 text-gray-800">{{ $pasien->nama_pasien }}</span>
                                    </div>
                                </div>
                                <div class="row p-2">
                                    <label class="col-md-4 fw-semibold text-muted">Usia</label>
                                    <div class="col-md-8">
                                        <span class="md-bold fs-6 text-gray-800">
                                            {{ $pasien->usia_tahun }}Th {{ $pasien->usia_bulan }}Bln
                                            {{ $pasien->usia_hari }}Hr</span>
                                    </div>
                                </div>
                                <div class="row p-2">
                                    <label class="col-md-4 fw-semibold text-muted">No BPJS</label>
                                    <div class="col-md-8">
                                        <span class="md-bold fs-6 text-gray-800">{{ $pasien->no_bpjs }}</span>
                                    </div>
                                </div>
                                <div class="row p-2">
                                    <label class="col-md-4 fw-semibold text-muted">NIK</label>
                                    <div class="col-md-8">
                                        <span class="md-bold fs-6 text-gray-800">{{ $pasien->nik }}</span>
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
                                    <label class="col-lg-4 fw-semibold text-muted">Ruangan</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800">{{ $rawat->ruangan?->nama_ruangan }}</span>
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
                                    <label class="col-lg-4 fw-semibold text-muted">Tgl.masuk</label>
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
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <h5 class="card-title">Farmasi Ranap</h5>
                                </div>
                                <div class="card-toolbar">
                                    <a href="{{ route('farmasi.antrian-resep') }}" class="btn btn-warning me-3">Kembali</a>

                                </div>
                            </div>
                            <!--begin::Body-->
                            <div class="mb-5 hover-scroll-x">
                                <div class="d-grid">
                                    <ul class="nav nav-tabs flex-nowrap text-nowrap" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0 active"
                                                data-bs-toggle="tab" href="#kt_tab_pane_1" aria-selected="true"
                                                role="tab">Resep</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0"
                                                data-bs-toggle="tab" href="#kt_tab_pane_2" aria-selected="false"
                                                role="tab" tabindex="-1">Pemberian Obat </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0"
                                                data-bs-toggle="tab" href="#kt_tab_pane_3" aria-selected="false"
                                                role="tab" tabindex="-1">CCPT </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                                        <div class="card-body p-lg-15">
                                            {{-- @dd($antrian) --}}
                                            {{-- @if ($antrian)
                                                @if ($antrian->status_antrian == 'Antrian')
                                                    <h4>Permintaan Resep</h4>
                                                    <h6>Dokter : {{ $rawat->dokter->nama_dokter }}</h6>
                                                    <form action="{{ route('farmasi.post-resep', $antrian->id) }}"
                                                        id='formPermintaanobat' method="post">
                                                        @csrf
                                                        <input type="hidden" name="idantrian" id="" value="{{ $antrian->id }}">
                                                        <div class="rounded border p-5">
                                                            <div class="row mb-5">
                                                                <!--begin::Repeater-->
                                                                <div id="kt_docs_repeater_basic">
                                                                    <!--begin::Form group-->
                                                                    <div class="form-group">
                                                                        <div data-repeater-list="terapi_obat">
                                                                            @if ($antrian->obat != 'null')
                                                                                @foreach (json_decode($antrian->obat) as $val)
                                                                                    <div data-repeater-item>
                                                                                        <div class="form-group row mb-2">
                                                                                            <div class="col-md-6">
                                                                                                <label
                                                                                                    class="form-label">Obat</label>
                                                                                                <select name="obat"
                                                                                                    class="form-select"
                                                                                                    data-kt-repeater="select2"
                                                                                                    data-placeholder="-Pilih-">
                                                                                                    <option></option>
                                                                                                    @foreach ($obat as $item)
                                                                                                        <option
                                                                                                            value="{{ $item->id }}"
                                                                                                            {{ $val->obat == $item->id ? 'selected' : '' }}>
                                                                                                            {{ $item->nama_obat }}
                                                                                                            -
                                                                                                            {{ $item->stok_apotek }}
                                                                                                            (Rp.
                                                                                                            {{ $item->harga_jual }})
                                                                                                            /
                                                                                                            {{ $item->satuan->satuan }}
                                                                                                        </option>
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-md-2 fs-8">
                                                                                                <label
                                                                                                    class="form-label">Signa</label>
                                                                                                <div
                                                                                                    class="input-group mb-5">
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name='signa1'
                                                                                                        value="{{ $val->signa1 }}"
                                                                                                        placeholder="...."
                                                                                                        aria-label="Username">
                                                                                                    <span
                                                                                                        class="input-group-text fs-9">X</span>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name='signa2'
                                                                                                        value="{{ $val->signa2 }}"
                                                                                                        placeholder="...."
                                                                                                        aria-label="Server">
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-md-1">
                                                                                                <label
                                                                                                    class="form-label">Qty</label>
                                                                                                <input type="number"
                                                                                                    value={{ $val->jumlah_obat }}
                                                                                                    name="jumlah_obat"
                                                                                                    class="form-control form-control-solid mb-5 mb-md-0"
                                                                                                    min="0"
                                                                                                    required>
                                                                                            </div>
                                                                                            <div class="col-md-1">
                                                                                                <label
                                                                                                    class="form-label">Pemberian</label>
                                                                                                <input type="number"
                                                                                                    name="pemberian_obat"
                                                                                                    class="form-control mb-5 mb-md-0"
                                                                                                    min="0"
                                                                                                    required>
                                                                                            </div>
                                                                                            <div class="col-md-2">
                                                                                                <label
                                                                                                    class="form-label">Jenis
                                                                                                    Obat</label>
                                                                                                <select name="jenis_obat"
                                                                                                    id=""
                                                                                                    class="form-select"
                                                                                                    required>
                                                                                                    <option value="">
                                                                                                        -
                                                                                                        Jenis Obat -
                                                                                                    </option>
                                                                                                    @foreach ($transaksi_bayar as $tb)
                                                                                                        <option
                                                                                                            value="{{ $tb->id }}">
                                                                                                            {{ $tb->bayar }}
                                                                                                        </option>
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-md-4">
                                                                                                <a href="javascript:;"
                                                                                                    data-repeater-delete
                                                                                                    class="btn btn-sm btn-light-danger">
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
                                                                                    <div class="form-group row mb-2">
                                                                                        <div class="col-md-3">
                                                                                            <label
                                                                                                class="form-label">Obat</label>
                                                                                            <select name="obat"
                                                                                                class="form-select"
                                                                                                data-kt-repeater="select2"
                                                                                                data-placeholder="-Pilih-"
                                                                                                required>
                                                                                                <option></option>
                                                                                                @foreach ($obat as $val)
                                                                                                    <option
                                                                                                        value="{{ $val->id }}">
                                                                                                        {{ $val->nama_obat }}
                                                                                                        -
                                                                                                        {{ $val->stok_apotek }}
                                                                                                        {{ $val->satuan->satuan }}
                                                                                                    </option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="col-md-2">
                                                                                            <label
                                                                                                class="form-label">Signa</label>
                                                                                            <div class="input-group mb-5">
                                                                                                <input type="text"
                                                                                                    class="form-control"
                                                                                                    name='signa1'
                                                                                                    placeholder="...."
                                                                                                    aria-label="Username">
                                                                                                <span
                                                                                                    class="input-group-text">X</span>
                                                                                                <input type="text"
                                                                                                    class="form-control"
                                                                                                    name='signa2'
                                                                                                    placeholder="...."
                                                                                                    aria-label="Server">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-2">
                                                                                            <label
                                                                                                class="form-label">Qty</label>
                                                                                            <input type="number"
                                                                                                name="jumlah_obat"
                                                                                                class="form-control mb-5 mb-md-0"
                                                                                                min="0" required>
                                                                                        </div>
                                                                                        <div class="col-md-1">
                                                                                            <label
                                                                                                class="form-label">Pemberian</label>
                                                                                            <input type="number"
                                                                                                name="pemberian_obat"
                                                                                                class="form-control mb-5 mb-md-0"
                                                                                                min="0" required>
                                                                                        </div>
                                                                                        <div class="col-md-2">
                                                                                            <label class="form-label">Jenis
                                                                                                Obat</label>
                                                                                            <select name=""
                                                                                                id=""
                                                                                                class="form-select"
                                                                                                required>
                                                                                                <option value="">-
                                                                                                    Jenis
                                                                                                    Obat -</option>
                                                                                                <option value="1">
                                                                                                    Pribadi
                                                                                                </option>
                                                                                                <option value="2">BPJS
                                                                                                </option>
                                                                                                <option value="3">
                                                                                                    Kronis
                                                                                                </option>
                                                                                                <option value="4">
                                                                                                    Covid
                                                                                                </option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <a href="javascript:;"
                                                                                                data-repeater-delete
                                                                                                class="btn btn-sm btn-light-danger">
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
                                                                            Tambah Obat
                                                                        </a>
                                                                    </div>
                                                                    <!--end::Form group-->
                                                                    <div class="row mt-5">
                                                                        <div class="col-md-2">
                                                                            <label class="form-label">Total Resep</label>
                                                                            <input type="text" name="total_resep"
                                                                                id="total_resep"
                                                                                class="form-control form-control-solid"
                                                                                readonly>
                                                                        </div>
                                                                        <div class="col">
                                                                            <label class="form-label">&nbsp;</label>
                                                                            <br>
                                                                            <button type="button" class="btn btn-primary"
                                                                                id="btn-resep">Update Resep</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--end::Repeater-->
                                                            </div>
                                                        </div>
                                                        <a target="_blank" class="btn btn-warning mt-10" href="{{ route('farmasi.cetak-resep-tempo',$antrian->id) }}">Print Resep</a>
                                                        <button class="btn btn-success mt-10">Simpan Resep</button>
                                                    </form>
                                                    <div class="separator separator-dashed border-secondary mt-5 mb-5">
                                                    </div>
                                                @endif
                                            @endif --}}
                                            @if ($antrian?->status_antrian == 'Antrian')
                                            <h4>Permintaan Resep</h4>
                                            <h6>Dokter : {{ $rawat->dokter->nama_dokter }}</h6>
        
                                            <h4>Racikan</h4>
                                            {{-- Racikan --}}
                                            <form action="" id='formPermintaanobat'>
                                                <table class="table table-bordered fs-7 gs-2 gy-2 gx-2" id="kt_docs_repeater_basic">
                                                    <thead class="text-center align-middle">
                                                        <tr>
                                                            <th rowspan="2">Nama Obat</th>
                                                            {{-- <th rowspan="2" width=100>Jumlah Pemberian</th> --}}
                                                            <th rowspan="2" width=500>Pemberian Obat</th>
                                                            <th rowspan="2">Jenis Obat</th>
                                                        </tr>
        
                                                    </thead>
                                                    <tbody>
                                                        {{-- {{ dd($antrian->racikan) }} --}}
                                                        @if ($antrian->racikan != 'null' || $antrian->racikan != '' || $antrian->racikan != '[]' || $antrian->racikan != null)
                                                            <tr>
                                                                <td colspan="10" class="fw-bold fs-6 text-gray-800">
                                                                    Racikan
                                                                </td>
        
                                                            </tr>
                                                            <tr>
                                                                <td colspan="10" class="fw-bold fs-6 text-gray-800">
                                                                    <button type="button" data-bs-toggle="modal"
                                                                        data-bs-target="#modal_tambah_racikan"
                                                                        class="btn btn-success btn-sm">Tambah Racikan</button>
                                                                </td>
                                                            </tr>
                                                            @if ($antrian->racikan != 'null')
                                                                @foreach (json_decode($antrian->racikan) as $val)
                                                                    <input type="hidden" value="{{ $val->idresep }}"
                                                                        name='idresep'>
                                                                    <input type="hidden" value="{{ $antrian->id }}"
                                                                        name='idantrian'>
                                                                    <tr>
                                                                        <td>
                                                                            <table>
                                                                                <tr>
                                                                                    <th>Obat</th>
                                                                                    <th>Harga</th>
                                                                                    <th>Jumlah</th>
                                                                                    <th width=50>Pemberian</th>
                                                                                    <th width=50>Kronis</th>
                                                                                </tr>
                                                                                @foreach ($val->obat as $ob_racikan)
                                                                                    @if ($ob_racikan->obat != null)
                                                                                        <tr>
                                                                                            <td>
                                                                                                <button type="button"
                                                                                                    data-id='{{ $val->idresep }}'
                                                                                                    data-value='{{ $ob_racikan->obat }}'class="btn btn-light-success btn-sm btn-edit-racikan">{!! App\Helpers\VclaimHelper::get_data_obat($ob_racikan->obat) !!}</button>
                                                                                            </td>
                                                                                            <td>{!! App\Helpers\VclaimHelper::get_harga_obat($ob_racikan->obat, $rawat->idbayar) !!}</td>
                                                                                            <td class="text-center">
                                                                                                {{ $ob_racikan->jumlah_obat }}</td>
                                                                                            <td>
        
                                                                                                <input type="text"
                                                                                                    name="racikan[pemberian][{{ $val->idresep }}][]"
                                                                                                    value="{{ isset($ob_racikan->diberikan) ? $ob_racikan->diberikan : '' }}"
                                                                                                    class="form-control form-control-sm">
        
                                                                                            </td>
                                                                                            <td>
                                                                                                <input type="text"
                                                                                                    name="racikan[pemberian_kronis][{{ $val->idresep }}][]"
                                                                                                    value="{{ isset($ob_racikan->kronis) ? $ob_racikan->kronis : '' }}"
                                                                                                    class="form-control form-control-sm">
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endif
                                                                                @endforeach
                                                                            </table>
                                                                        </td>
                                                                        <td class="align-middle text-center">{{ $val->dosis }}
                                                                            {{ $val->takaran }} ( {{ $val->signa }} )
                                                                            {{ $val->diminum . ' makan' }}
                                                                            <b>{!! $val->dtd == 1 ? '<b> - (DTD)</b>' : '' !!}</b>
                                                                        </td>
                                                                        <td class="align-middle text-center">
                                                                            <select name="jenis_obat[{{ $val->idresep }}]"
                                                                                id="" class="form-select form-select-sm"
                                                                                required>
                                                                                <option value="">- Jenis Obat
                                                                                    -
                                                                                </option>
                                                                                @foreach ($transaksi_bayar as $tb)
                                                                                    @if (isset($val->jenis))
                                                                                        <option
                                                                                            {{ $val->jenis == $tb->id ? 'selected' : '' }}
                                                                                            value="{{ $tb->id }}">
                                                                                            {{ $tb->bayar }}
                                                                                        </option>
                                                                                    @else
                                                                                        <option value="{{ $tb->id }}">
                                                                                            {{ $tb->bayar }}
                                                                                        </option>
                                                                                    @endif
                                                                                @endforeach
                                                                            </select>
                                                                        </td>
                                                                        <td class="align-middle text-center">
                                                                            <a class="btn btn-danger btn-sm" href="{{ route('farmasi.delete-resep',$val->idresep) }}">Hapus</a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                        @endif
                                                        {{-- Non Racikan --}}
                                                    </tbody>
                                                </table>
        
        
                                                <hr>
                                                <h4>Non Racikan</h4>
                                                <table class="table table-bordered fs-7 gs-2 gy-2 gx-2"
                                                    id="kt_docs_repeater_basic">
                                                    <thead class="text-center align-middle">
                                                        <tr>
                                                            <th rowspan="2">Nama Obat</th>
                                                            {{-- <th rowspan="2" width=100>Jumlah Pemberian</th> --}}
                                                            <th rowspan="2">Harga</th>
                                                            <th rowspan="2">Jumlah</th>
                                                            <th rowspan="2" width=100>Pemberian</th>
                                                            <th rowspan="2" width=100>Kronis</th>
                                                            <th rowspan="2">Dosis / Takaran Obat</th>
                                                            <th rowspan="2">Jenis Obat</th>
                                                        </tr>
        
                                                    </thead>
                                                    <tbody class="align-middle">
                                                        @if ($antrian->obat != 'null' || $antrian->obat != '' || $antrian->obat != '[]')
                                                            @if ($antrian->obat != 'null')
                                                                @foreach (json_decode($antrian->obat) as $val)
                                                                    <input type="hidden" value="{{ $val->idresep }}"
                                                                        name='idresep_non_racikan[]'>
                                                                    <input type="hidden" value="{{ $antrian->id }}"
                                                                        name='idantrian'>
                                                                    <tr>
                                                                        <td>
                                                                            @if (isset($val->tambahan_farmasi))
                                                                                @if ($val->tambahan_farmasi != null)
                                                                                    <button type="button"
                                                                                        data-id="{{ $antrian->id }}"
                                                                                        data-value="{{ $val->obat }}"
                                                                                        class="btn btn-light-danger btn-sm btn-hapus-farmasi">
                                                                                        {!! App\Helpers\VclaimHelper::get_data_obat($val->obat) !!}</button>
                                                                                @else
                                                                                    <button type="button"
                                                                                        data-id="{{ $antrian->id }}"
                                                                                        data-value="{{ $val->obat }}"
                                                                                        class="btn btn-light-success btn-sm btn-edit-farmasi">
                                                                                        {!! App\Helpers\VclaimHelper::get_data_obat($val->obat) !!}
                                                                                    </button>
                                                                                @endif
                                                                            @else
                                                                                <button type="button"
                                                                                    data-id="{{ $antrian->id }}"
                                                                                    data-value="{{ $val->obat }}"
                                                                                    class="btn btn-light-success btn-sm btn-edit-farmasi">
                                                                                    {!! App\Helpers\VclaimHelper::get_data_obat($val->obat) !!}
                                                                                </button>
                                                                            @endif
        
                                                                        </td>
                                                                        <td>{!! App\Helpers\VclaimHelper::get_harga_obat($val->obat, $rawat->idbayar) !!}</td>
                                                                        <td class="text-center">
                                                                            {{ $val->jumlah }}</td>
                                                                        <td>
                                                                            <input type="text"
                                                                                name="pemberian[{{ $val->idresep }}]"
                                                                                value="{{ isset($val->diberikan) ? $val->diberikan : '' }}"
                                                                                class="form-control form-control-sm">
                                                                        </td>
                                                                        <td>
                                                                            <input type="text"
                                                                                name="kronis[{{ $val->idresep }}]"
                                                                                value="{{ isset($val->kronis) ? $val->kronis : '' }}"
                                                                                class="form-control form-control-sm">
                                                                        </td>
                                                                        <td class="text-center">
                                                                            {{ $val->dosis }}
                                                                            {{ $val->takaran }} ( {{ $val->signa }} )
                                                                            {{ $val->diminum . ' makan' }}
                                                                        </td>
                                                                        <td class="align-middle text-center">
                                                                            <select
                                                                                name="jenis_obat_non_racikan[{{ $val->idresep }}]"
                                                                                id="" class="form-select form-select-sm"
                                                                                required>
                                                                                <option value="">- Jenis Obat
                                                                                    -
                                                                                </option>
                                                                                @foreach ($transaksi_bayar as $tb)
                                                                                    @if (isset($val->jenis))
                                                                                        <option
                                                                                            {{ $val->jenis == $tb->id ? 'selected' : '' }}
                                                                                            value="{{ $tb->id }}">
                                                                                            {{ $tb->bayar }}
                                                                                        </option>
                                                                                    @else
                                                                                        <option value="{{ $tb->id }}">
                                                                                            {{ $tb->bayar }}
                                                                                        </option>
                                                                                    @endif
                                                                                @endforeach
                                                                            </select>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                               
                                                            @endif
                                                            <tr>
                                                                <td colspan=7>
                                                                    <div
                                                                        class="alert alert-primary d-flex align-items-center p-5 mb-10">
                                                                        <i
                                                                            class="ki-duotone ki-shield-tick fs-2hx text-primary me-4"><span
                                                                                class="path1"></span><span
                                                                                class="path2"></span></i>
                                                                        <div class="d-flex flex-column">
                                                                            <h4 class="mb-1 text-primary">Klik Update terlebih
                                                                                dahulu untuk dapat menambah obat</h4>
                                                                        </div>
                                                                    </div>
                                                                    <button type="button" data-id="{{ $antrian->id }}" id="modal_tambah_non"class="btn btn-primary btn-sm">Tambah</button>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </form>
                                            <div class="row mt-5">
                                                <div class="col-md-2">
                                                    <label class="form-label">Total Resep</label>
                                                    <input type="text" name="total_resep" id="total_resep"
                                                        class="form-control form-control-solid" readonly>
                                                </div>
                                                <div class="col">
                                                    <label class="form-label">&nbsp;</label>
                                                    <br>
                                                    <button type="button" class="btn btn-primary" id="btn-resep">Update
                                                        Resep</button>
                                                </div>
        
                                            </div>
                                            <div class="row">
                                                <div class="col">
        
                                                    <form action="{{ route('farmasi.post-resep', $antrian->id) }}"
                                                        id='formPermintaanobatSelesai' method="post">
                                                        @csrf
                                                        <a target="_blank" class="btn btn-warning mt-10"
                                                            href="{{ route('farmasi.cetak-resep-tempo', $antrian->id) }}">Print
                                                            Resep</a>
                                                        <a target="_blank" class="btn btn-light-info mt-10"
                                                            href="{{ route('farmasi.cetak-faktur-tempo', $antrian->id) }}">Print
                                                            Faktur</a>
                                                        <a target="_blank" class="btn btn-light-danger mt-10"
                                                            href="{{ route('farmasi.cetak-tiket-tempo', $antrian->id) }}">E
                                                            Tiket</a>
                                                        <input type="hidden" name="idantrian" id=""
                                                            value="{{ $antrian->id }}">
                                                        <button class="btn btn-success mt-10">Simpan Resep</button>
                                                    </form>
                                                    <br>
                                                    <a onclick="return confirm('Batalkan Resep?')" href="{{ route('farmasi.batalkan-resep',$antrian->id) }}" class="btn btn-danger"> Batalkan Resep </a>
        
                                                </div>
                                            </div>
                                        @endif

                                            <table class="table table-bordered mt-10">
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
                                                    @foreach ($resep as $r)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $r->kode_resep }}</td>
                                                            <td>{{ $r->tgl }}</td>
                                                            <td>
                                                                @php
                                                                    $obat_detail = DB::table('obat_transaksi_detail')
                                                                        ->where('idtrx', $r->id)
                                                                        ->get();
                                                                @endphp
                                                                <ol>
                                                                    @foreach ($obat_detail as $od)
                                                                        <li>{{ $od->nama_obat }} ({{ $od->qty }})
                                                                        </li>
                                                                    @endforeach
                                                                </ol>
                                                            </td>
                                                            <td>{{ $r->total_harga }}</td>
                                                            <td>
                                                                <a href="{{ route('farmasi.cetak-resep', $r->id) }}"
                                                                    class="btn btn-info btn-sm" target="_blank">Print</a>
                                                                <a href="{{ route('farmasi.cetak-tiket', $r->id) }}"
                                                                    class="btn btn-info btn-sm" target="_blank">Print
                                                                    Tiket</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>


                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                                        <div class="card-body p-lg-15">
                                            <h5>Pemberian Obat</h5>
                                            <table class="table table-bordered">
                                                <tbody>
                                                    @foreach ($pemberian_obat as $po)
                                                        <tr>
                                                            <th colspan="8">
                                                                Tgl : {{ $po->tgl }}
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Jenis Obat</th>
                                                            <th>Nama Obat</th>
                                                            <th>Qty</th>
                                                            <th>Rute</th>
                                                            <th>Signa</th>
                                                            <th>Waktu Petugas</th>
                                                        </tr>
                                                        @foreach (json_decode($po->pemberian_obat) as $val)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $po->jenis }}</td>
                                                                <td>{{ $val->nama_obat }}</td>
                                                                <td>{{ $val->jumlah_obat }}</td>
                                                                <td>{{ $val->rute }}</td>
                                                                <td>{{ $val->signa }}</td>
                                                                <td>
                                                                    @foreach ($val->obat_obatan as $obat)
                                                                        Jam :{{ $obat->jam }} <br>
                                                                        Initial :{{ $obat->initial }}<br>
                                                                        <div
                                                                            class="separator separator-dashed border-secondary mt-5 mb-5">
                                                                        </div>
                                                                    @endforeach

                                                            </tr>
                                                        @endforeach
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
                                        <div class="card-body p-lg-15">
                                            <h5>CPPT</h5>
                                            <button class="btn btn-warning btn-sm mb-5" data-bs-toggle="modal"
                                                data-bs-target="#modal_cppt">CPPT</button>
                                            <hr>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Tanggal</th>
                                                        <th>Profesi (PPA)</th>
                                                        <th>Hasil Asesmen Pasien , Intruksi & Tindak Lanjut</th>
                                                        <th>Petugas</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($cppt as $val)
                                                        <tr>
                                                            <td>
                                                                {{ \Carbon\Carbon::parse($val->tgl)->translatedFormat('l, d F Y ') }}
                                                                <br>
                                                                {{ \Carbon\Carbon::parse($val->jam)->translatedFormat('H:i:s') }}
                                                            </td>
                                                            <td>{{ $val->profesi }}</td>
                                                            <td>
                                                                <table>
                                                                    <tr>
                                                                        <td>S</td>
                                                                        <td>:</td>
                                                                        <td>{{ $val->subjektif }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>O</td>
                                                                        <td>:</td>
                                                                        <td>{{ $val->objektif }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>A</td>
                                                                        <td>:</td>
                                                                        <td>{{ $val->asesmen }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>P</td>
                                                                        <td>:</td>
                                                                        <td>{{ $val->plan }}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td>{{ $val->idpetugas }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="4">Tidak Ada Data!</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="kt_tab_pane_4" role="tabpanel">
                                        <div class="card-body p-lg-15">
                                            <h5>Pemberian Obat Non Injeksi</h5>
                                            <table class="table table-bordered">
                                                <tbody>
                                                    @foreach ($pemberian_obat_non_injeksi as $po)
                                                        <tr>
                                                            <th colspan="8">
                                                                Tgl : {{ $po->tgl }}
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Obat</th>
                                                            <th>Qty</th>
                                                            <th>Rute</th>
                                                            <th>Signa</th>
                                                            <th>Waktu Petugas</th>
                                                        </tr>
                                                        @foreach (json_decode($po->pemberian_obat) as $val)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $val->nama_obat }}</td>
                                                                <td>{{ $val->jumlah_obat }}</td>
                                                                <td>{{ $val->rute }}</td>
                                                                <td>{{ $val->signa }}</td>
                                                                <td>
                                                                    @foreach ($val->obat_obatan as $obat)
                                                                        Jam :{{ $obat->jam }} <br>
                                                                        Initial :{{ $obat->initial }}<br>
                                                                        <div
                                                                            class="separator separator-dashed border-secondary mt-5 mb-5">
                                                                        </div>
                                                                    @endforeach

                                                            </tr>
                                                        @endforeach
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--end::Body-->
                        </div>
                    </div>
                </div>
                <!--end::FAQ card-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>

    <div class="modal fade" tabindex="-1" id="kt_modal_1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Pemberian Obat</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>
                <form action="{{ route('farmasi.post-pemberian', $rawat->id) }}" method="post" id='fromPemberian'>
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row mb-3">
                            <label class="col-sm-3 col-form-label text-start">Jenis Pemberian</label>
                            <div class="col-sm-4">
                                <select name="jenis_pemberian" required class="form-select" id="">
                                    <option value=""></option>
                                    <option value="Obat">Obat</option>
                                    <option value="Injeksi">Obat Injeksi</option>
                                    <option value="Non Injeksi">Obat Non Injeksi</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input class="form-control" required name='tgl' placeholder="Tanggal"
                                    id="kt_datepicker_1" />
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <!--begin::Repeater-->
                            <div id="kt_docs_repeater_nested">
                                <!--begin::Form group-->
                                <div class="form-group">
                                    <div data-repeater-list="pemberian_obat">
                                        <div data-repeater-item>
                                            <div class="form-group row mb-5">
                                                <div class="col-md-3">
                                                    <label class="form-label">Nama Obat</label>
                                                    <input type="text" name='nama_obat' required
                                                        class="form-control form-control-sm mb-2 mb-md-0"
                                                        placeholder="Nama Obat" />
                                                </div>
                                                <div class="col-md-1">
                                                    <label class="form-label">Qty</label>
                                                    <input type="text" name='jumlah_obat' required
                                                        class="form-control form-control-sm mb-2 mb-md-0"
                                                        placeholder="Qty Obat" />
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="inner-repeater">
                                                        <div data-repeater-list="obat_obatan" class="mb-5">
                                                            <div data-repeater-item>
                                                                <label class="form-label">Jam / Initial</label>
                                                                <div class="input-group pb-3">
                                                                    <input type="time" name='jam' required
                                                                        class="form-control form-control-sm"
                                                                        placeholder="Jam" />
                                                                    <input type="text" name='initial' required
                                                                        class="form-control form-control-sm"
                                                                        placeholder="Initial" />
                                                                    <button
                                                                        class="border border-secondary btn btn-icon btn-flex  btn-sm btn-light-danger"
                                                                        data-repeater-delete type="button">
                                                                        <i class="ki-duotone ki-trash fs-5"><span
                                                                                class="path1"></span><span
                                                                                class="path2"></span><span
                                                                                class="path3"></span><span
                                                                                class="path4"></span><span
                                                                                class="path5"></span></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button class="btn btn-sm btn-flex btn-light-primary"
                                                            data-repeater-create type="button">
                                                            <i class="ki-duotone ki-plus fs-5"></i>
                                                            Tambah Jam
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Rute</label>
                                                    <select name="rute" class="form-select" id="">
                                                        <option value=""></option>
                                                        <option value="Oral">Oral</option>
                                                        <option value="Intravena">Intravena</option>
                                                        <option value="Sublingual">Sublingual</option>
                                                        <option value="Nasal">Nasal</option>
                                                        <option value="Injeksi">Injeksi</option>
                                                    </select>
                                                    <input type="text" name='rute'
                                                        class="form-control form-control-sm mb-2 mb-md-0"
                                                        placeholder="Rute" required />
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Signa</label>
                                                    <input type="text" name='signa'
                                                        class="form-control form-control-sm mb-2 mb-md-0"
                                                        placeholder="Signa" required />
                                                </div>
                                                <div class="col-md-4">
                                                    <a href="javascript:;" data-repeater-delete
                                                        class="btn btn-sm btn-flex btn-light-danger mt-3 mt-md-9">
                                                        <i class="ki-duotone ki-trash fs-5"><span
                                                                class="path1"></span><span class="path2"></span><span
                                                                class="path3"></span><span class="path4"></span><span
                                                                class="path5"></span></i>
                                                        Delete Row
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Form group-->

                                <!--begin::Form group-->
                                <div class="form-group">
                                    <a href="javascript:;" data-repeater-create class="btn btn-flex btn-light-primary">
                                        <i class="ki-duotone ki-plus fs-3"></i>
                                        Tambah Pemberian
                                    </a>
                                </div>
                                <!--end::Form group-->
                            </div>
                            <!--end::Repeater-->
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
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>
                <form action="{{ route('post_cppt.rawat-inap', $rawat->id) }}" id="frmCppt" method="post">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for=""> Profesi (PPA) </label>
                                    </div>
                                    <div class="col-md-8">
                                        <select name="profesi" class="form-select" id="">
                                            <option value="">-- Profesi (PPA) -- </option>
                                            <option value="Farmasi">Farmasi</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="row">
                                <div class="col-md-4">
                                    Hasil Asesmen Pasien (SOAP)
                                </div>
                                <div class="col-md-2 text-center">S</div>
                                <div class="col-md-6">
                                    <textarea name="subjektif" class="form-control" id=""></textarea>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-2 text-center">O</div>
                                <div class="col-md-6">
                                    <textarea name="objektif" class="form-control" id=""></textarea>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-2 text-center">A</div>
                                <div class="col-md-6">
                                    <textarea name="asesmen" class="form-control" id=""></textarea>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-2 text-center">P</div>
                                <div class="col-md-6">
                                    <textarea name="plan" class="form-control" id=""></textarea>
                                </div>
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

    <div class="modal fade" tabindex="-1" id="modal_tambah">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Obat</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <div class="card card-bordered">
                        <div class="card-body">

                            <form id='updNonracikan' action="{{ route('farmasi.tambah-obat') }}" method="POST">
                                @csrf
                                {{-- <label for="">aaa</label> --}}
                                <input type="hidden" name="idtambah" id="id_tambah">
                                <input type="hidden" name="idrawat" id="id_rawat" value="{{ $rawat->id }}">
                                <div class="row mb-5">
                                    <div class="col-md-12">
                                        <label for="">Obat</label>
                                        <select name="obat_non" id='nama_obat_non' class="form-select form-select-sm"
                                            data-control="select2" data-placeholder="-Pilih-" required>
                                            <option value=""></option>
                                            @foreach ($obat as $val)
                                                <option value="{{ $val->id }}">
                                                    {{ $val->nama_obat }} -
                                                    {{ $val->satuan->satuan }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" width=100>Jumlah</th>
                                            <th rowspan="2" width=100>Dosis</th>
                                            <th rowspan="2" width=200>Takaran</th>
                                            <th width=50 colspan="4">Signa</th>
                                            <th rowspan="2" width=100>Diminum</th>
                                        </tr>
                                        <tr>
                                            <th width=10>P</th>
                                            <th width=10>S</th>
                                            <th width=10>SO</th>
                                            <th width=10>M</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="number" id='jumlah_obat' name="jumlah_obat"
                                                    class="form-control form-control-sm mb-2 mb-md-0" min="0"
                                                    required>
                                            </td>
                                            <td>
                                                <input type="text" name="dosis_obat" placeholder="dosis"
                                                    class="form-control form-control-sm  mb-2 mb-md-0" min="0">
                                            </td>
                                            <td>
                                                <select name="takaran_obat" id='takaran_obat' required
                                                    class="form-select form-select-sm">
                                                    <option value="">Pilih Takaran</option>
                                                    @foreach ($takaran as $t)
                                                        <option value="{{ $t }}">{{ $t }}</option>
                                                    @endforeach
                                                </select>

                                            </td>
                                            <td class="text-center align-middle"><input name="diminum[]"
                                                    class="form-check-input form-check-input-sm" type="checkbox"
                                                    value="P" id="flexCheckDefault" /></td>
                                            <td class="text-center align-middle"><input
                                                    class="form-check-input form-check-input-sm" type="checkbox"
                                                    value="S" name="diminum[]" id="flexCheckDefault" /></td>
                                            <td class="text-center align-middle"><input
                                                    class="form-check-input form-check-input-sm" type="checkbox"
                                                    value="SO" name="diminum[]" id="flexCheckDefault" /></td>
                                            <td class="text-center align-middle"><input
                                                    class="form-check-input form-check-input-sm" type="checkbox"
                                                    value="M" name="diminum[]" id="flexCheckDefault" /></td>
                                            <td>
                                                <div class="form-check form-check-inline mb-2">
                                                    <input class="form-check-input" type="radio" name="takaran"
                                                        id="kapsul" value="sebelum">
                                                    <label class="form-check-label" for="tablet">Sebelum</label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="takaran"
                                                        id="kapsul" value="sesudah">
                                                    <label class="form-check-label" for="kapsul">Sesudah</label>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <th colspan="10">
                                                <button type="submit" class="btn btn-success"
                                                    id='update-data'>Simpan</button>
                                            </th>
                                        </tr>

                                    </tbody>

                                </table>
                            </form>

                        </div>
                    </div>
                </div>

                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="modal_lihat">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="modal-hasil">

            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="modal_tambah_racikan">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Tambah Racikan</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <table class="table table-bordered fs-9 gs-2 gy-2 gx-2" id="kt_docs_repeater_basic">
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
                            <form id='frmRacikan' action="{{ route('farmasi.post-resep-racikan', $rawat->id) }}"
                                method="POST">
                                @csrf
                                <tr>
                                    <td>
                                        @for ($i = 1; $i <= 8; $i++)
                                            <select name="obat[]" id='nama_obat_racikan{{ $i }}'
                                                class="form-select form-select-sm select-obat" data-control="select2"
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
                                            <input type="text" id='jumlah_obat{{ $i }}'
                                                name="jumlah_obat[]" class="form-control form-control-sm mb-2 mb-md-0"
                                                min="0">
                                        @endfor

                                    </td>
                                    <td>
                                        <input type="text" name="dosis_obat" required placeholder=""
                                            class="form-control form-control-sm  mb-2 mb-md-0" min="0">
                                    </td>
                                    <td>
                                        <input type="text" name="pemberian" required placeholder=""
                                            class="form-control form-control-sm  mb-2 mb-md-0" min="0">
                                    </td>
                                    <td>
                                        <select name="takaran_obat" id='takaran_obat' required
                                            class="form-select form-select-sm">
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
                                    <td class="text-center align-middle"><input name="diminum[]"
                                            class="form-check-input form-check-input-sm" type="checkbox" value="P"
                                            id="flexCheckDefault" /></td>
                                    <td class="text-center align-middle"><input
                                            class="form-check-input form-check-input-sm" type="checkbox" value="S"
                                            name="diminum[]" id="flexCheckDefault" /></td>
                                    <td class="text-center align-middle"><input
                                            class="form-check-input form-check-input-sm" type="checkbox" value="SO"
                                            name="diminum[]" id="flexCheckDefault" /></td>
                                    <td class="text-center align-middle"><input
                                            class="form-check-input form-check-input-sm" type="checkbox" value="M"
                                            name="diminum[]" id="flexCheckDefault" /></td>
                                    <td>
                                        <div class="form-check form-check-inline mb-2">
                                            <input class="form-check-input" type="radio" name="takaran" id="kapsul"
                                                value="sebelum">
                                            <label class="form-check-label" for="tablet">Sebelum</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="takaran" id="kapsul"
                                                value="sesudah">
                                            <label class="form-check-label" for="kapsul">Sesudah</label>
                                        </div>
                                    </td>
                                    <td class="text-center" width='10'>
                                        <input name="dtd" class="form-check-input form-check-input-sm"
                                            type="checkbox" value="1" id="dtd" />
                                    </td>
                                    <td>
                                        <input type="text" name="catatan"
                                            class="form-control form-control-sm mb-2 mb-md-0" min="0">
                                    </td>
                                    <td>

                                        {{-- <button class="btn btn-sm btn-info">Racik</button> --}}
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="10">
                                        <button type="submit" name="upload_racikan" id="upload_racikan"
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
        $("#kt_datepicker_1").flatpickr();
        $(function() {
            $("#frmCppt").on("submit", function(event) {
                    event.preventDefault();
                    var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
                    Swal.fire({
                        title: 'Simpan Data',
                        text: "Apakah Anda yakin akan menyimpan data CPPT ?",
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
            $("#formPermintaanobat").on("submit", function(event) {
                event.preventDefault();
                var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
                Swal.fire({
                    title: 'Simpan Data',
                    text: "Apakah Anda yakin akan menyimpan data ini ? data yang sudah di simpan tidak dapat di hapus kembali",
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

            $("#fromPemberian").on("submit", function(event) {
                event.preventDefault();
                var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
                Swal.fire({
                    title: 'Simpan Data?',
                    text: "Simpan Data?",
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

            $('#kt_docs_repeater_nested').repeater({
                initEmpty: false,
                repeaters: [{
                    selector: '.inner-repeater',
                    show: function() {
                        $(this).slideDown();
                    },

                    hide: function(deleteElement) {
                        $(this).slideUp(deleteElement);
                    }
                }],

                show: function() {
                    $(this).slideDown();
                },

                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });

            $('#kt_docs_repeater_basic').repeater({
                initEmpty: false,
                show: function() {
                    $(this).slideDown();

                    $(this).find('[data-kt-repeater="select2"]').select2();
                },

                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                },

                ready: function() {
                    $('[data-kt-repeater="select2"]').select2();
                }
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

        $("#btn-resep").on("click", function() {
            var formData = $("#formPermintaanobat").serialize();
            $.ajax({
                type: "GET",
                url: '{{ route('farmasi.update-resep') }}',
                data: formData,
                success: function(response) {
                    $('#total_resep').val('Rp.' + response.total);
                }
            });
        });
    </script>
        <script>
            $('#id_data_obat').select2({
                dropdownParent: $('#modal_lihat')
            });
            $(document).on('click', '.btn-edit-racikan', function() {
                var id = $(this).attr('data-id');
                var value = $(this).attr('data-value');
    
    
                var url = '{{ route('get-edit-racikan', [':b_id', ':p_value']) }}';
                url = url.replace(':b_id', id);
                url = url.replace(':p_value', value);
                $("#modal-hasil").empty();
                $.get(url).done(function(data) {
                    $("#modal-hasil").html(data);
                    $("#modal_lihat").modal('show');
                    console.log(data);
                });
            });
            $(document).on('click', '.btn-edit-farmasi', function() {
                var id = $(this).attr('data-id');
                var value = $(this).attr('data-value');
    
    
                var url = '{{ route('get-edit-farmasi', [':b_id', ':p_value']) }}';
                url = url.replace(':b_id', id);
                url = url.replace(':p_value', value);
                $("#modal-hasil").empty();
                $.get(url).done(function(data) {
                    $("#modal-hasil").html(data);
                    $("#modal_lihat").modal('show');
                    console.log(data);
                });
            });
            $(function() {
                @for ($i = 1; $i <= 8; $i++)
                    $('#nama_obat_racikan{{ $i }}').select2({
                        dropdownParent: $('#modal_tambah_racikan')
                    });
                @endfor
                $('#nama_obat_non').select2({
                    dropdownParent: $('#modal_tambah')
                });
                $('#kt_docs_repeater_basic').repeater({
                    initEmpty: false,
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
                    },
    
                    hide: function(deleteElement) {
                        $(this).slideUp(deleteElement);
                    },
    
                    ready: function() {
                        $('[data-kt-repeater="select2"]').select2();
                    }
                });
                
    
                $("#modal_tambah_non").on("click", function(event) {
                    var id = $(this).data('id');
                    $('#modal_tambah').modal('show');
                    $('#id_tambah').val(id);
    
                })
                $("#formPermintaanobatSelesai").on("submit", function(event) {
                    event.preventDefault();
                    var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
                    Swal.fire({
                        title: 'Simpan Data',
                        text: "Apakah Anda yakin akan menyimpan data ini ? data yang sudah di simpan tidak dapat di hapus kembali",
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
                $(".btn-hapus-farmasi").on("click", function(event) {
                    var idantrian = $(this).data('id');
                    var idobat = $(this).data('value');
                    event.preventDefault();
                    var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
                    Swal.fire({
                        title: 'Hapus Data',
                        text: "Apakah Anda yakin akan menghapus data ini ?",
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Hapus Data',
                        cancelButtonText: 'Tidak'
                    }).then((result) => {
                        $.ajax({
                                method: "GET",
                                url: "{{ route('hapus-data-resep') }}",
                                data: {
                                    antrian: idantrian,
                                    idobat: idobat
                                }
                            })
                            .done(function(msg) {
                                //reload page
                                console.log(msg);
                                Swal.fire({
                                    text: 'Data berhasil di hapus',
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                                location.reload();
                            });
                    });
    
    
                })
                $("#updNonracikan").on("submit", function(event) {
                    event.preventDefault();
                    var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
                    Swal.fire({
                        title: 'Simpan Data',
                        text: "Apakah Anda yakin akan menyimpan data ini ? data yang sudah di simpan tidak dapat di hapus kembali",
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
            })
    
            $("#btn-resep").on("click", function() {
                var formData = $("#formPermintaanobat").serialize();
                // console.log(formData)
                $.ajax({
                    type: "GET",
                    url: '{{ route('farmasi.update-resep') }}',
                    data: formData,
                    success: function(response) {
                        console.log(response);
                        $('#total_resep').val('Rp.' + response.total);
                    }
                });
            });
            $('#frmRacikan').on('submit', function(event) {
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
        </script>
@endsection
