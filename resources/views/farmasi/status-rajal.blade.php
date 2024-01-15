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
                            Rawat Jalan</h1>
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
                            <li class="breadcrumb-item text-muted">Farmasi Rawat Jalan</li>
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
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <h5 class="card-title">Resep</h5>
                                </div>
                                <div class="card-toolbar">
                                    <a href="{{ route('farmasi.antrian-resep') }}" class="btn btn-warning">Kembali</a>
                                </div>
                            </div>
                            <!--begin::Body-->
                            <div class="card-body p-lg-15">
                                @if ($antrian?->status_antrian == 'Antrian')
                                    <h4>Permintaan Resep</h4>
                                    <h6>Dokter : {{ $rawat->dokter->nama_dokter }}</h6>
                                    {{-- @if ($antrian->racikan != null || $antrian->racikan != '')
                                        <div
                                            class="alert alert-dismissible bg-success d-flex flex-column flex-sm-row w-100 p-5 mb-10">
                                            <!--begin::Icon-->
                                            <i class="ki-duotone ki-pencil fs-2hx text-light me-4 mb-5 mb-sm-0"><span
                                                    class="path1"></span><span class="path2"></span></i> <!--end::Icon-->

                                            <!--begin::Content-->
                                            <div class="d-flex flex-column text-light pe-0 pe-sm-10">
                                                <h4 class="mb-2 text-light">Racikan Resep</h4>
                                                <span>{{ $antrian->racikan }}</span>

                                                <button data-bs-toggle="modal" data-bs-target="#kt_modal_1"
                                                    class="btn btn-secondary mt-10 btn-sm">Racik</button>
                                            </div>

                                            <!--end::Content-->

                                            <!--begin::Close-->
                                            <button type="button"
                                                class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
                                                data-bs-dismiss="alert">
                                                <i class="ki-duotone ki-cross fs-2x text-light"><span
                                                        class="path1"></span><span class="path2"></span></i> </button>
                                            <!--end::Close-->
                                        </div>

                                        <div class="modal fade" tabindex="-1" id="kt_modal_1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title">Modal title</h3>

                                                        <!--begin::Close-->
                                                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                                            data-bs-dismiss="modal" aria-label="Close">
                                                            <i class="ki-duotone ki-cross fs-1"><span
                                                                    class="path1"></span><span class="path2"></span></i>
                                                        </div>
                                                        <!--end::Close-->
                                                    </div>

                                                    <div class="modal-body">
                                                        <p>Modal body text goes here.</p>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save
                                                            changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif --}}
                                    {{-- <form action="{{ route('farmasi.post-resep', $antrian->id) }}" id='formPermintaanobat'
                                        method="post">
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
                                                                    @if (isset($val->terapi_obat_racikan))
                                                                        <div data-repeater-item>
                                                                            <div class="form-group row mb-5">
                                                                                <div class="col-md-7">
                                                                                    <div class="inner-repeater">
                                                                                        @foreach ($val->terapi_obat_racikan as $data_obat)
                                                                                            <div data-repeater-list="terapi_obat_racikan"
                                                                                                class="">

                                                                                                <div data-repeater-item>
                                                                                                    <div class="row">
                                                                                                        <div
                                                                                                            class="col-md-6">
                                                                                                            <label
                                                                                                                class="form-label">Obat</label>
                                                                                                            <select
                                                                                                                name="obat"
                                                                                                                class="form-select"
                                                                                                                data-kt-repeater="select2"
                                                                                                                data-placeholder="-Pilih-"
                                                                                                                required>
                                                                                                                <option>
                                                                                                                </option>
                                                                                                                @foreach ($obat as $item)
                                                                                                                    <option
                                                                                                                        value="{{ $item->id }}"
                                                                                                                        {{ $data_obat->obat == $item->id ? 'selected' : '' }}>
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
                                                                                                        <div
                                                                                                            class="col-md-4">
                                                                                                            <label
                                                                                                                class="form-label">Jumlah
                                                                                                                (dosis)
                                                                                                            </label>
                                                                                                            <div
                                                                                                                class="input-group pb-3">

                                                                                                                <input
                                                                                                                    type="number"
                                                                                                                    name="jumlah_obat"
                                                                                                                    step=".01"
                                                                                                                    value="{{ $data_obat->jumlah_obat }}"
                                                                                                                    class="form-control mb-5 mb-md-0"
                                                                                                                    min="0"
                                                                                                                    required>
                                                                                                                <input
                                                                                                                    type="text"
                                                                                                                    name="dosis_obat"
                                                                                                                    placeholder=""
                                                                                                                    class="form-control mb-5 mb-md-0"
                                                                                                                    min="0">
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
                                                                                                        <div
                                                                                                            class="col-md-2">
                                                                                                            <label
                                                                                                                for=""
                                                                                                                class="form-label">Pemberian</label>
                                                                                                            <input
                                                                                                                type="number"
                                                                                                                name="pemberian_obat"
                                                                                                                class="form-control mb-5 mb-md-0"
                                                                                                                min="0"
                                                                                                                required>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                </div>



                                                                                            </div>
                                                                                        @endforeach
                                                                                        <button
                                                                                            class="btn btn-sm btn-flex btn-light-success"
                                                                                            data-repeater-create
                                                                                            type="button">
                                                                                            <i
                                                                                                class="ki-duotone ki-plus fs-5"></i>
                                                                                            Tambah Racikan
                                                                                        </button>
                                                                                    </div>

                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <label class="form-label">Signa</label>
                                                                                    <div class="input-group mb-5">
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            value="{{ $val->signa1 }}"
                                                                                            name='signa1'
                                                                                            placeholder="...."
                                                                                            aria-label="Username">
                                                                                        <span
                                                                                            class="input-group-text">-</span>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            value="{{ $val->signa2 }}"
                                                                                            name='signa2'
                                                                                            placeholder="...."
                                                                                            aria-label="Server">
                                                                                        <span
                                                                                            class="input-group-text">-</span>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            value="{{ $val->signa3 }}"
                                                                                            name='signa3'
                                                                                            placeholder="...."
                                                                                            aria-label="Server">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <label class="form-label">Jenis
                                                                                        Obat</label>
                                                                                    <select name="jenis_obat"
                                                                                        id="" class="form-select"
                                                                                        required>
                                                                                        <option value="">- Jenis Obat
                                                                                            -
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
                                                                    @else
                                                                        <div data-repeater-item>
                                                                            <div class="form-group row mb-2">
                                                                                <div class="col-md-6">
                                                                                    <label class="form-label">Obat</label>
                                                                                    <select name="obat"
                                                                                        class="form-select"
                                                                                        data-kt-repeater="select2"
                                                                                        data-placeholder="-Pilih-">
                                                                                        <option></option>
                                                                                        @foreach ($obat as $item)
                                                                                            <option
                                                                                                value="{{ $item->id }}"
                                                                                                {{ $val->obat == $item->id ? 'selected' : '' }}>
                                                                                                {{ $item->nama_obat }} -
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
                                                                                    <label class="form-label">Signa</label>
                                                                                    <div class="input-group mb-5">
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
                                                                                    <label class="form-label">Qty</label>
                                                                                    <input type="number"
                                                                                        value={{ $val->jumlah_obat }}
                                                                                        name="jumlah_obat"
                                                                                        class="form-control form-control-solid mb-5 mb-md-0"
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
                                                                                    <select name="jenis_obat"
                                                                                        id="" class="form-select"
                                                                                        required>
                                                                                        <option value="">- Jenis Obat
                                                                                            -
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
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                <div data-repeater-item>
                                                                    <div class="form-group row mb-2">
                                                                        <div class="col-md-3">
                                                                            <label class="form-label">Obat</label>
                                                                            <select name="obat" class="form-select"
                                                                                data-kt-repeater="select2"
                                                                                data-placeholder="-Pilih-" required>
                                                                                <option></option>
                                                                                @foreach ($obat as $val)
                                                                                    <option value="{{ $val->id }}">
                                                                                        {{ $val->nama_obat }}
                                                                                        - {{ $val->stok_apotek }}
                                                                                        {{ $val->satuan->satuan }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <label class="form-label">Signa</label>
                                                                            <div class="input-group mb-5">
                                                                                <input type="text" class="form-control"
                                                                                    name='signa1' placeholder="...."
                                                                                    aria-label="Username">
                                                                                <span class="input-group-text">X</span>
                                                                                <input type="text" class="form-control"
                                                                                    name='signa2' placeholder="...."
                                                                                    aria-label="Server">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <label class="form-label">Jumlah Obat</label>
                                                                            <input type="number" name="jumlah_obat"
                                                                                class="form-control form-control-solid mb-5 mb-md-0"
                                                                                min="0" required readonly>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <label class="form-label">Pemberian</label>
                                                                            <input type="number" name="pemberian_obat"
                                                                                class="form-control mb-5 mb-md-0"
                                                                                min="0" required>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <label class="form-label">Jenis Obat</label>
                                                                            <select name="jenis_obat" id=""
                                                                                class="form-select" required>
                                                                                <option value="">- Jenis Obat -
                                                                                </option>
                                                                                <option value="1">Pribadi</option>
                                                                                <option value="2">BPJS</option>
                                                                                <option value="3">Kronis</option>
                                                                                <option value="4">Covid</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <a href="javascript:;" data-repeater-delete
                                                                                class="btn btn-sm btn-light-danger">
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
                                                            <input type="text" name="total_resep" id="total_resep"
                                                                class="form-control form-control-solid" readonly>
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
                                        <a target="_blank" class="btn btn-warning mt-10"  href="{{ route('farmasi.cetak-resep-tempo', $antrian->id) }}">Print Resep</a>
                                        <a target="_blank" class="btn btn-light-info mt-10"  href="{{ route('farmasi.cetak-resep-tempo', $antrian->id) }}">Print Faktur</a>
                                        <button class="btn btn-success mt-10">Simpan Resep</button>
                                    </form>
                                    <div class="separator separator-dashed border-secondary mt-5 mb-5"></div> --}}
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
                                                                                    <td>{!! App\Helpers\VclaimHelper::get_data_obat($ob_racikan->obat) !!}</td>
                                                                                    <td>{!! App\Helpers\VclaimHelper::get_harga_obat($ob_racikan->obat) !!}</td>
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
                                                                    {{ $val->diminum . ' makan' }}</td>
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
                                                                <td>{!! App\Helpers\VclaimHelper::get_data_obat($val->obat) !!}</td>
                                                                <td>{!! App\Helpers\VclaimHelper::get_harga_obat($val->obat) !!}</td>
                                                                <td class="text-center">
                                                                    {{ $val->jumlah }}</td>
                                                                <td>
                                                                    {{-- <input type="hidden" value={{ $val->idresep }} name="racikan[idresep][]" class="form-control">
                                                    <input type="hidden" value={{ $val->obat }} name="racikan[idobat][]" class="form-control"> --}}
                                                                    <input type="text"
                                                                        name="pemberian[{{ $val->idresep }}]"
                                                                        value="{{ isset($val->diberikan) ? $val->diberikan : '' }}"
                                                                        class="form-control form-control-sm">
                                                                </td>
                                                                <td>
                                                                    {{-- <input type="hidden" value={{ $val->idresep }} name="racikan[idresep][]" class="form-control">
                                                    <input type="hidden" value={{ $val->obat }} name="racikan[idobat][]" class="form-control"> --}}
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
                                          
                                                <form action="{{ route('farmasi.post-resep', $antrian->id) }}" id='formPermintaanobatSelesai'
                                                    method="post">
                                                    @csrf
                                                    <a target="_blank" class="btn btn-warning mt-10"
                                                    href="{{ route('farmasi.cetak-resep-tempo', $antrian->id) }}">Print
                                                    Resep</a>
                                                <a target="_blank" class="btn btn-light-info mt-10"
                                                    href="{{ route('farmasi.cetak-faktur-tempo', $antrian->id) }}">Print
                                                    Faktur</a>
                                                <a target="_blank" class="btn btn-light-danger mt-10"
                                                    href="{{ route('farmasi.cetak-tiket-tempo', $antrian->id) }}">E Tiket</a>
                                                    <input type="hidden" name="idantrian" id="" value="{{ $antrian->id }}">
                                                    <button class="btn btn-success mt-10">Simpan Resep</button>
                                                </form>
                                           
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
                                                            <li>{{ $od->nama_obat }} ({{ $od->qty }})</li>
                                                        @endforeach
                                                    </ol>
                                                </td>
                                                <td>{{ $r->total_harga }}</td>
                                                <td>
                                                    <a href="{{ route('farmasi.cetak-faktur', $r->id) }}"
                                                        class="btn btn-warning btn-sm" target="_blank">Print</a>
                                                    {{-- <a href="{{ route('farmasi.cetak-resep', $r->id) }}"
                                                        class="btn btn-success btn-sm" target="_blank">Print Resep</a> --}}
                                                    <a href="{{ route('farmasi.cetak-tiket', $r->id) }}"
                                                        class="btn btn-info btn-sm" target="_blank">Print Tiket</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>


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
@endsection
@section('js')
    <script></script>
    <script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js"></script>
    <script>
        $(function() {
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
        })

        $("#btn-resep").on("click", function() {
            var formData = $("#formPermintaanobat").serialize();
            console.log(formData)
            $.ajax({
                type: "GET",
                url: '{{ route('farmasi.update-resep') }}',
                data: formData,
                success: function(response) {
                    $('#total_resep').val('Rp.' + response.total);
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
