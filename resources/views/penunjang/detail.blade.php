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
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">
                            Pemeriksaan {{ $jenis }}</h1>
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
                            <li class="breadcrumb-item text-muted">Pemeriksaan {{ $jenis }}</li>
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

                        @if ($jenis == 'Lab')
                            @if ($penunjang)
                                <div class="card mb-5">
                                    <div class="card-header">
                                        <h5 class="card-title">Permintaan Pemeriksaan {{ $jenis }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <form id='frmLab' action="{{ route('penunjang.lab-post', $penunjang->id) }}"
                                            method="post">
                                            @csrf
                                            <div class="form-group row mb-3">
                                                <label class="col-sm-3 col-form-label text-start">Dokter / Petugas</label>
                                                <div class="col-sm-4">
                                                    <select name="dokter_pemeriksa" required class="form-select"
                                                        id="">
                                                        <option value="">-- Dokter --</option>
                                                        @foreach ($dokter as $dr)
                                                            <option value="{{ $dr->id }}">{{ $dr->nama_dokter }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <input class="form-control form-control-solid" readonly required
                                                        name='petugas' value="{{ auth()->user()->detail->nama }}"
                                                        placeholder="Petugas" />
                                                </div>
                                            </div>
                                            <div class="separator separator-dashed border-secondary mb-5"></div>
                                            <h5>Permintaan Pemeriksaan</h5>
                                            <div class="rounded border p-5">
                                                <div class="row mb-5">
                                                    <div class="col-md-">
                                                        <div id="lab_repeater">
                                                            <!--begin::Form group-->
                                                            <div class="form-group">
                                                                <div data-repeater-list="lab">

                                                                    @if ($penunjang->pemeriksaan_penunjang != 'null')
                                                                        {{-- {{ dd($rekap->laborat) }} --}}
                                                                        @foreach (json_decode($penunjang->pemeriksaan_penunjang) as $val)
                                                                            <div data-repeater-item>
                                                                                <div class="form-group row mb-5">
                                                                                    <div class="col-md-4">
                                                                                        <label class="form-label">Tindakan
                                                                                            Lab</label>
                                                                                        <select name="tindakan_lab"
                                                                                            class="form-select"
                                                                                            data-kt-repeater="select2lab"
                                                                                            data-placeholder="-Pilih-"
                                                                                            required>
                                                                                            <option></option>
                                                                                            @foreach ($lab as $l)
                                                                                                <option
                                                                                                    value="{{ $l->id }}"
                                                                                                    {{ $val->tindakan_lab == $l->id ? 'selected' : '' }}>
                                                                                                    {{ $l->nama_pemeriksaan }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <label
                                                                                            class="form-label">Catatan</label>
                                                                                        <input class="form-control"
                                                                                            name='catatan'
                                                                                            placeholder="Catatan" />
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
                                                                                <div class="col-md-6">
                                                                                    <label class="form-label">Tindakan
                                                                                        Lab</label>
                                                                                    <select name="tindakan_lab"
                                                                                        class="form-select"
                                                                                        data-kt-repeater="select2lab"
                                                                                        data-placeholder="-Pilih-"
                                                                                        required>
                                                                                        <option></option>
                                                                                        @foreach ($lab as $l)
                                                                                            <option
                                                                                                value="{{ $l->id }}">
                                                                                                {{ $l->nama_pemeriksaan }}
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
                                                                    @endif

                                                                </div>
                                                            </div>
                                                            <!--end::Form group-->

                                                            <!--begin::Form group-->
                                                            <div class="form-group mt-5">
                                                                <a href="javascript:;" data-repeater-create
                                                                    class="btn btn-light-primary">
                                                                    <i class="ki-duotone ki-plus fs-3"></i>
                                                                    Tambah Lab
                                                                </a>
                                                            </div>
                                                            <!--end::Form group-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-success mt-5" type="submit">Kerjakan</button>
                                        </form>
                                    </div>
                                </div>
                            @endif


                            <div class="card mb-5">
                                <div class="card-header">
                                    <h5 class="card-title">List Pemeriksaan {{ $jenis }}</h5>
                                </div>
                                <div class="card-body">
                                    @if (count($pemeriksaan_lab))
                                        @foreach ($pemeriksaan_lab as $pl)
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th colspan="3">Tanggal Pemeriksaan : {{ $pl->tgl_hasil }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th>Pemeriksaan</th>
                                                        <th>Status</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                    @php
                                                        $pemeriksaan_lab_detail = DB::table('laboratorium_hasildetail')
                                                            ->where('idhasil', $pl->id)
                                                            ->get();
                                                    @endphp
                                                    @foreach ($pemeriksaan_lab_detail as $pld)
                                                        <tr>
                                                            <td>{{ $pld->nama_pemeriksaan }}</td>
                                                            <td>{{ $pld->status < 2 ? 'Hasil Belum di input' : 'Hasil sudah terinput' }}
                                                            </td>
                                                            <td>
                                                                @if ($pld->status < 2)
                                                                    <a href="{{ route('penunjang.input-hasil', [$pld->id, $pld->idpemeriksaan]) }}"
                                                                        class="btn btn-primary btn-sm">Input Hasil</a>
                                                                @else
                                                                    <a href="{{ route('penunjang.lihat-hasil', [$pld->id, $pld->idpemeriksaan]) }}"
                                                                        class="btn btn-success btn-sm">Lihat Hasil</a>
                                                                @endif

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        @elseif($jenis == 'Radiologi')
                            @if ($penunjang)
                                <div class="card mb-5">
                                    <div class="card-header">
                                        <h5 class="card-title">Permintaan Pemeriksaan {{ $jenis }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <form id='frmLab' action="{{ route('penunjang.rad-post', $penunjang->id) }}"
                                            method="post">
                                            @csrf
                                            <div class="form-group row mb-3">
                                                <label class="col-sm-3 col-form-label text-start">Dokter / Petugas</label>
                                                <div class="col-sm-4">
                                                    <select name="dokter_pemeriksa" required class="form-select"
                                                        id="">
                                                        <option value="">-- Dokter --</option>
                                                        @foreach ($dokter as $dr)
                                                            <option value="{{ $dr->id }}">{{ $dr->nama_dokter }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <input class="form-control form-control-solid" readonly required
                                                        name='petugas' value="{{ auth()->user()->detail->nama }}"
                                                        placeholder="Petugas" />
                                                </div>
                                            </div>
                                            <div class="separator separator-dashed border-secondary mb-5"></div>
                                            <h5>Permintaan Pemeriksaan</h5>
                                            <div class="rounded border p-5">
                                                <div class="row mb-5">
                                                    <div class="col-md-12">
                                                        <div id="radiologi_repeater">
                                                            <!--begin::Form group-->
                                                            <div class="form-group">
                                                                <div data-repeater-list="radiologi">
                                                                    @foreach (json_decode($penunjang->pemeriksaan_penunjang) as $val)
                                                                        <div data-repeater-item>
                                                                            <div class="form-group row mb-5">
                                                                                <div class="col-md-6">
                                                                                    <label class="form-label">Tindakan Rad</label>
                                                                                    <select name="tindakan_rad"
                                                                                        class="form-select"
                                                                                        data-kt-repeater="select2radiologi"
                                                                                        data-placeholder="-Pilih-" required>
                                                                                        <option></option>
                                                                                        @foreach ($radiologi as $rad)
                                                                                            <option value="{{ $rad->id }}"
                                                                                                {{ $val->tindakan_rad == $rad->id ? 'selected' : '' }}>
                                                                                                {{ $rad->nama_tindakan }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <label
                                                                                        class="form-label">Klinis</label>
                                                                                    <input class="form-control"
                                                                                        name='klinis' required
                                                                                        placeholder="Klinis" />
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <label
                                                                                        class="form-label">Catatan</label>
                                                                                    <input class="form-control"
                                                                                        name='catatan'
                                                                                        placeholder="Catatan" />
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
                                                                    @endforeach
                                                                </div>


                                                            </div>
                                                            <!--end::Form group-->

                                                            <!--begin::Form group-->
                                                            <div class="form-group mt-5">
                                                                <a href="javascript:;" data-repeater-create
                                                                    class="btn btn-light-success">
                                                                    <i class="ki-duotone ki-plus fs-3"></i>
                                                                    Tambah Radiologi
                                                                </a>
                                                            </div>
                                                            <!--end::Form group-->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="btn btn-success mt-5" type="submit">Kerjakan</button>
                                        </form>

                                    </div>
                                </div>
                            @endif
                            <div class="card mb-5">
                                <div class="card-header">
                                    <h5 class="card-title">List Pemeriksaan {{ $jenis }}</h5>
                                </div>
                                <div class="card-body">
                                    @if (count($pemeriksaan_radiologi))
                                        @foreach ($pemeriksaan_radiologi as $pl)
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th colspan="3">Tanggal Pemeriksaan : {{ $pl->tgl_hasil }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th>Pemeriksaan</th>
                                                        <th>Status</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                    @php
                                                        $pemeriksaan_radio_detail = DB::table('radiologi_hasildetail')
                                                            ->where('idhasil', $pl->id)
                                                            ->get();
                                                    @endphp
                                                    @foreach ($pemeriksaan_radio_detail as $pld)
                                                    @php
                                                        $tindakan = DB::table('radiologi_tindakan')
                                                            ->where('id', $pld->idtindakan)
                                                            ->first();
                                                    @endphp
                                                        <tr>
                                                            <td>{{ $tindakan->nama_tindakan }}</td>
                                                            <td>{{ $pld->status < 2 ? 'Hasil Belum di input' : 'Hasil sudah terinput' }}
                                                            </td>
                                                            <td>
                                                                @if ($pld->status < 2)
                                                                    <a href="{{ route('penunjang.input-hasil-radiologi', [$pld->id, $pld->idtindakan]) }}"
                                                                        class="btn btn-primary btn-sm">Input Hasil</a>
                                                                @else
                                                                    <a href="{{ route('penunjang.input-hasil-radiologi', [$pld->id, $pld->idtindakan]) }}"
                                                                        class="btn btn-success btn-sm">Lihat Hasil</a>
                                                                    <a href="{{ route('penunjang.cetak-radiologi', $pld->id) }}"
                                                                        class="btn btn-info btn-sm" target="_blank">Print</a>
                                                                @endif

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        @elseif($jenis == 'Fisio')
                            @if ($penunjang)
                                <div class="card mb-5">
                                    <div class="card-header">
                                        <h5 class="card-title">Permintaan Pemeriksaan {{ $jenis }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <form id='frmLab' action="{{ route('penunjang.fisio-post', $penunjang->id) }}"
                                            method="post">
                                            @csrf
                                            <div class="form-group row mb-3">
                                                <label class="col-sm-3 col-form-label text-start">Dokter / Petugas</label>
                                                <div class="col-sm-4">
                                                    <select name="dokter_pemeriksa" required class="form-select"
                                                        id="">
                                                        <option value="">-- Dokter --</option>
                                                        @foreach ($dokter as $dr)
                                                            <option value="{{ $dr->id }}">{{ $dr->nama_dokter }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <input class="form-control form-control-solid" readonly required
                                                        name='petugas' value="{{ auth()->user()->detail->nama }}"
                                                        placeholder="Petugas" />
                                                </div>
                                            </div>
                                            <div class="separator separator-dashed border-secondary mb-5"></div>
                                            <h5>Permintaan Pemeriksaan</h5>
                                            <div class="row mb-5">
                                                <!--begin::Repeater-->
                                                <div id="fisio_repeater">
                                                    <!--begin::Form group-->
                                                    <div class="form-group">
                                                        <div data-repeater-list="fisio">
                                                            @if ($penunjang->pemeriksaan_penunjang != 'null')
                                                                {{-- {{ dd($rekap->laborat) }} --}}
                                                                @foreach (json_decode($penunjang->pemeriksaan_penunjang) as $val)
                                                                    <div data-repeater-item>
                                                                        <div class="form-group row mb-5">
                                                                            <div class="col-md-6">
                                                                                <label class="form-label">Fisio Terapi</label>
                                                                                <select name="tindakan_fisio" class="form-select"
                                                                                    data-kt-repeater="select2fisio"
                                                                                    data-placeholder="-Pilih-" required>
                                                                                    <option></option>
                                                                                    @foreach ($fisio as $f)
                                                                                        <option value="{{ $f->id }}"
                                                                                            {{ $val->tindakan_fisio == $f->id ? 'selected' : '' }}>
                                                                                            {{ $f->nama_tarif }}</option>
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
                                                                @endforeach
                                                            @else
                                                                <div data-repeater-item>
                                                                    <div class="form-group row mb-5">
                                                                        <div class="col-md-6">
                                                                            <label class="form-label">Fisio Terapi</label>
                                                                            <select name="tindakan_fisio" class="form-select"
                                                                                data-kt-repeater="select2fisio" data-placeholder="-Pilih-"
                                                                                required>
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
                                                            @endif

                                                        </div>
                                                    </div>
                                                    <!--end::Form group-->

                                                    <!--begin::Form group-->
                                                    <div class="form-group mt-5">
                                                        <a href="javascript:;" data-repeater-create class="btn btn-light-info">
                                                            <i class="ki-duotone ki-plus fs-3"></i>
                                                            Tambah Fisio
                                                        </a>
                                                    </div>
                                                    <!--end::Form group-->
                                                </div>
                                                <!--end::Repeater-->
                                            </div>
                                            <button class="btn btn-success mt-5" type="submit">Kerjakan</button>
                                        </form>

                                    </div>
                                </div>
                            @endif
                            <div class="card mb-5">
                                <div class="card-header">
                                    <h5 class="card-title">List Pemeriksaan {{ $jenis }}</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Pemeriksaan</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pemeriksaan_fisio as $pf)
                                            @php
                                                $tindakan = DB::table('tarif')
                                                    ->where('id', $pf->idtindakan)
                                                    ->first();
                                            @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $tindakan->nama_tarif }}</td>
                                                    <td>{{ $pf->status < 2 ? 'Hasil Belum di input' : 'Hasil sudah terinput' }} </td>
                                                    <td>
                                                        @if ($pf->status < 2)
                                                            <a href="{{ route('penunjang.input-hasil-fisio', [$pf->id, $pf->idtindakan]) }}"
                                                                class="btn btn-primary btn-sm">Input Hasil</a>
                                                        @else
                                                            <a href="{{ route('penunjang.input-hasil-fisio', [$pf->id, $pf->idtindakan]) }}"
                                                                class="btn btn-success btn-sm">Lihat Hasil</a>
                                                        @endif

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif

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

            @if ($jenis == 'Lab')
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
                $("#frmLab").on("submit", function(event) {
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
            @elseif ($jenis == 'Radiologi')
                $('#radiologi_repeater').repeater({
                    initEmpty: false,

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
                $("#frmLab").on("submit", function(event) {
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
            @elseif ($jenis == 'Fisio')
            $('#fisio_repeater').repeater({
                initEmpty: false,

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
            $("#frmLab").on("submit", function(event) {
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
            @endif
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
        })

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
