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
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Rekam
                            Medis Pasien</h1>
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
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h5 class="card-title">Order Obat</h5>
                        </div>
                        <div class="card-toolbar">
                            <a href="{{ route('view.rawat-inap', $rawat->idruangan) }}"
                                class="btn me-3 btn-sm btn-secondary">Kembali</a>
                            {{-- <button data-bs-toggle="modal" data-bs-target="#modal_pulang"
                                class="btn btn-sm btn-success">Pulang</button> --}}
                        </div>
                    </div>
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="p-0">
                                <!--begin::Underline-->
                                <span class="d-inline-block position-relative mb-5">
                                    <!--begin::Label-->
                                    <span class="d-inline-block mb-2 fs-2 fw-bold">
                                        Order Obat
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
                            <div class="d-grid">
                                <ul class="nav nav-tabs flex-nowrap text-nowrap" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0 active"
                                            data-bs-toggle="tab" href="#kt_tab_pane_non_racikan" aria-selected="true"
                                            role="tab">Non Racikan</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0"
                                            data-bs-toggle="tab" href="#kt_tab_pane_racikan" aria-selected="false"
                                            role="tab" tabindex="-1">Racikan</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-content" id="myTabContentObat">

                                <div class="tab-pane fade show active" id="kt_tab_pane_non_racikan" role="tabpanel">
                                    <div class="table-responsive">
                                        {{-- @if (auth()->user()->idpriv == 7) --}}
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
                                                                class="form-select form-select-sm" data-control="select2"
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
                                                            <input type="number" id='jumlah_obat' name="jumlah_obat"
                                                                class="form-control form-control-sm mb-2 mb-md-0"
                                                                min="0" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="dosis_obat" placeholder="dosis"
                                                                class="form-control form-control-sm  mb-2 mb-md-0"
                                                                min="0">
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
                                                                class="form-check-input form-check-input-sm"
                                                                type="checkbox" value="P" id="flexCheckDefault" />
                                                        </td>
                                                        <td class="text-center align-middle"><input
                                                                class="form-check-input form-check-input-sm"
                                                                type="checkbox" value="S" name="diminum[]"
                                                                id="flexCheckDefault" /></td>
                                                        <td class="text-center align-middle"><input
                                                                class="form-check-input form-check-input-sm"
                                                                type="checkbox" value="SO" name="diminum[]"
                                                                id="flexCheckDefault" /></td>
                                                        <td class="text-center align-middle"><input
                                                                class="form-check-input form-check-input-sm"
                                                                type="checkbox" value="M" name="diminum[]"
                                                                id="flexCheckDefault" /></td>
                                                        <td>
                                                            <div class="form-check form-check-inline mb-2">
                                                                <input class="form-check-input" type="radio"
                                                                    name="takaran" id="kapsul" value="sebelum">
                                                                <label class="form-check-label"
                                                                    for="tablet">Sebelum</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="takaran" id="kapsul" value="sesudah">
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
                                                            <button type="submit" name="upload" id="upload"
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
                                        {{-- @endif --}}

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="kt_tab_pane_racikan" role="tabpanel">
                                    <div class="table-responsive">
                                        {{-- @if (auth()->user()->idpriv == 7) --}}
                                        <table class="table table-bordered fs-9 gs-2 gy-2 gx-2"
                                            id="kt_docs_repeater_basic">
                                            <thead class="text-center align-middle">
                                                <tr>
                                                    <th rowspan="2">Nama Obat</th>
                                                    <th rowspan="2" width=100>Dosis</th>
                                                    <th rowspan="2" width=100>Jumlah</th>
                                                    <th rowspan="2" width=50>Signa</th>
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
                                                                <select name="obat[]" id='nama_obat{{ $i }}'
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
                                                                <input type="text" id='jumlah_obat{{ $i }}'
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
                                                                class="form-check-input form-check-input-sm"
                                                                type="checkbox" value="P" id="flexCheckDefault" />
                                                        </td>
                                                        <td class="text-center align-middle"><input
                                                                class="form-check-input form-check-input-sm"
                                                                type="checkbox" value="S" name="diminum[]"
                                                                id="flexCheckDefault" /></td>
                                                        <td class="text-center align-middle"><input
                                                                class="form-check-input form-check-input-sm"
                                                                type="checkbox" value="SO" name="diminum[]"
                                                                id="flexCheckDefault" /></td>
                                                        <td class="text-center align-middle"><input
                                                                class="form-check-input form-check-input-sm"
                                                                type="checkbox" value="M" name="diminum[]"
                                                                id="flexCheckDefault" /></td>
                                                        <td>
                                                            <div class="form-check form-check-inline mb-2">
                                                                <input class="form-check-input" type="radio"
                                                                    name="takaran" id="kapsul" value="sebelum">
                                                                <label class="form-check-label"
                                                                    for="tablet">Sebelum</label>
                                                            </div>

                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="takaran" id="kapsul" value="sesudah">
                                                                <label class="form-check-label"
                                                                    for="kapsul">Sesudah</label>
                                                            </div>
                                                        </td>
                                                        <td class="text-center" width='10'>
                                                            <input name="dtd"
                                                                class="form-check-input form-check-input-sm"
                                                                type="checkbox" value="1" id="dtd" />
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
                                                                id="upload_racikan" class="btn btn-primary btn-sm">
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
                                        {{-- @endif  --}}
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
                                                                id='{{ $rd->id }}' href="javascript:void(0)"
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
                                                            {{-- @if (auth()->user()->idpriv == 7) --}}
                                                                <a class="btn btn-sm btn-danger btn-hapus"
                                                                    id='{{ $rd->id }}' href="javascript:void(0)"
                                                                    style='cursor:pointer;'>Hapus</a>
                                                                <button data-id="{{ $rd->id }}"
                                                                    class="btn btn-sm btn-info btn-edit">Edit</button>
                                                            {{-- @endif --}}
                                                        </td>
                                                    @endif

                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                {{-- @if (count($resep_dokter) > 0) --}}
                                <form action="{{ route('post-selesai-resep.rawat-inap') }}" method="post" id='selesaiObat'>
                                    @csrf
                                    <input type="hidden" name="idresep" value="{{ $resep_antrian->id }}">
                                    <input type="hidden" name="idrawat" value="{{ $rawat->id }}">
                                    <button class="btn btn-success btn-sm">Selesai</button>
                                    <a href="{{ route('farmasi.batalkan-resep',$resep_antrian->id) }}" class="btn btn-danger btn-sm">Batalkan</a>
                                </form>
                                {{-- @endif --}}
                                

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
                        <!--end::Body-->
                    </div>
                    <!--end::FAQ card-->
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>

        <!-- Modal -->




    @endsection
    @section('js')
        <script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
        <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js"></script>
        <script>
            $("#kt_datepicker_1").flatpickr();
            $("#kt_datepicker_2").flatpickr();
            $("#kt_datepicker_3").flatpickr({
                enableTime: true,
                dateFormat: "Y-m-d H:i",
            });
            $(function() {


                $("#selesaiObat").on("submit", function(event) {
                    event.preventDefault();
                    var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
                    Swal.fire({
                        title: 'Yakin Simpan Data?',
                        text: "Simpan Data? Data Akan langsung terkirim ke farmasi dan tidak bisa di edit",
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
                $("#frmPulang").on("submit", function(event) {
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



            });
        </script>
        <script>
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
