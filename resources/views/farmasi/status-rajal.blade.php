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
                                    <a href="{{ route('farmasi.antrian-resep') }}" class="btn btn-warning me-3">Kembali</a>
                                    @if ($antrian?->status_antrian == 'Antrian')
                                        <a href="{{ route('farmasi.singkron-resep', $rawat->id) }}"
                                            class="btn btn btn-light-info">Singkronkan Resep</a>
                                    @else
                                        <a href="{{ route('farmasi.tambah-resep',$rawat->id) }}" onclick="return confirm('Tambah Resep?')" class="btn btn-info ">Tambah Resep</a>
                                    @endif
                                </div>
                            </div>
                            <!--begin::Body-->
                            <div class="card-body p-lg-15">
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
                                                            <li>{{ $od->nama_obat }}
                                                                {{ $od->idbayar == 3 ? '(Kronis)' : '' }}
                                                                ({{ $od->qty }})
                                                            </li>
                                                        @endforeach
                                                    </ol>
                                                </td>
                                                <td>{{ number_format($r->total_harga + $r->jasa_racik) }}</td>
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
    <script></script>
    <script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js"></script>

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
