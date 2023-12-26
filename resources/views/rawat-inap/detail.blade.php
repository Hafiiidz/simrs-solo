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
                            <h5 class="card-title">Detail Pasien</h5>
                        </div>
                        <div class="card-toolbar">
                            <a href="{{ route('view.rawat-inap', $rawat->idruangan) }}"
                                class="btn me-3 btn-sm btn-secondary">Kembali</a>
                            <button class="btn btn-sm btn-success">Pulang</button>
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
                                    <ul class="nav nav-tabs flex-nowrap text-nowrap" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0 active"
                                                data-bs-toggle="tab" href="#kt_tab_pane_1" aria-selected="true"
                                                role="tab">Asesmen Awal</a>
                                        </li>
                                        @if ($rawat->idpoli == 4)
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0"
                                                    data-bs-toggle="tab" href="#kt_tab_pane_bidan" aria-selected="false"
                                                    role="tab" tabindex="-1">Pengkajian Kebidanan</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0"
                                                    data-bs-toggle="tab" href="#kt_tab_pane_partograf"
                                                    aria-selected="false" role="tab" tabindex="-1">Partograf</a>
                                            </li>
                                        @endif
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0"
                                                data-bs-toggle="tab" href="#kt_tab_pane_2" aria-selected="false"
                                                role="tab" tabindex="-1">CPPT</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0"
                                                data-bs-toggle="tab" href="#kt_tab_pane_3" aria-selected="false"
                                                role="tab" tabindex="-1">Implementasi</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0"
                                                data-bs-toggle="tab" href="#kt_tab_pane_4" aria-selected="false"
                                                role="tab" tabindex="-1">Tindakan</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0"
                                                data-bs-toggle="tab" href="#kt_tab_pane_5" aria-selected="false"
                                                role="tab" tabindex="-1">Obat Obatan</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0"
                                                data-bs-toggle="tab" href="#kt_tab_pane_6" aria-selected="false"
                                                role="tab" tabindex="-1">Tindakan Penunjang</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0"
                                                data-bs-toggle="tab" href="#kt_tab_pane_7" aria-selected="false"
                                                role="tab" tabindex="-1">Operasi</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0"
                                                data-bs-toggle="tab" href="#kt_tab_pane_8" aria-selected="false"
                                                role="tab" tabindex="-1">Diganosa</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0"
                                                data-bs-toggle="tab" href="#kt_tab_pane_9" aria-selected="false"
                                                role="tab" tabindex="-1">Pindah Ruangan</a>
                                        </li>


                                    </ul>
                                </div>
                            </div>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade" id="kt_tab_pane_bidan" role="tabpanel">
                                    <a class="btn btn-warning btn-sm mb-5"
                                        href="{{ route('detail.rawat-inap.pengkajian-kebidanan', $rawat->id) }}">Pengkajian</a>
                                    @include('rawat-inap.menu.bidan')
                                </div>
                                <div class="tab-pane fade" id="kt_tab_pane_partograf" role="tabpanel">
                                    <button class="btn btn-warning btn-sm mb-5" data-bs-toggle="modal"
                                        data-bs-target="#modal_cppt">Partograf</button>
                                    @include('rawat-inap.menu.partograf')
                                </div>
                                <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                                    <h3>Asesmen Awal</h3>
                                    <div class="d-grid">
                                        <ul class="nav nav-tabs flex-nowrap text-nowrap" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-success rounded-bottom-0 active"
                                                    data-bs-toggle="tab" href="#asesmen_pane_1" aria-selected="true"
                                                    role="tab">Ringkasan Masuk</a>
                                            </li>
                                            {{-- <li class="nav-item" role="presentation">
                                                <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-success rounded-bottom-0"
                                                    data-bs-toggle="tab" href="#asesmen_pane_2" aria-selected="false"
                                                    role="tab" tabindex="-1">Pengkajian Awal</a>
                                            </li> --}}
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-success rounded-bottom-0"
                                                    data-bs-toggle="tab" href="#asesmen_pane_3" aria-selected="false"
                                                    role="tab" tabindex="-1">Riwayat Penyakit dan Pemeriksaan
                                                    Fisik</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-content" id="myTabContent2">
                                        <div class="tab-pane fade show active" id="asesmen_pane_1" role="tabpanel">
                                            @include('rawat-inap.menu.ringkasan_masuk')
                                        </div>
                                        {{-- <div class="tab-pane fade" id="asesmen_pane_2" role="tabpanel">
                                            @include('rawat-inap.menu.pengkajian_awal')
                                        </div> --}}
                                        <div class="tab-pane fade" id="asesmen_pane_3" role="tabpanel">
                                            @include('rawat-inap.menu.pemeriksaan_fisik_penyakit')
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                                    <button class="btn btn-warning btn-sm mb-5" data-bs-toggle="modal"
                                        data-bs-target="#modal_cppt">Tambah CPPT</button>
                                    @include('rawat-inap.menu.cppt')
                                </div>
                                <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
                                    <button class="btn btn-info btn-sm mb-5" data-bs-toggle="modal"
                                        data-bs-target="#modal_implementasi">Tambah Implementasi</button>
                                    @include('rawat-inap.menu.cppt')
                                </div>
                                <div class="tab-pane fade" id="kt_tab_pane_4" role="tabpanel">
                                    <button class="btn btn-info btn-sm mb-5" data-bs-toggle="modal"
                                        data-bs-target="#modal_tindakan">Tambah Tindakan</button>
                                    @include('rawat-inap.menu.tindakan')
                                </div>
                                <div class="tab-pane fade" id="kt_tab_pane_5" role="tabpanel">
                                    <button class="btn btn-info btn-sm mb-5" data-bs-toggle="modal"
                                        data-bs-target="#modal_beri_obat">Tambah Pemberian Obat</button>

                                    <button class="btn btn-success btn-sm mb-5" data-bs-toggle="modal"
                                        data-bs-target="#modal_obat">Order Obat</button>

                                    <button class="btn btn-danger btn-sm mb-5">Retur Obat</button>

                                    @include('rawat-inap.menu.obat')
                                </div>
                                <div class="tab-pane fade" id="kt_tab_pane_6" role="tabpanel">
                                    <button class="btn btn-info btn-sm mb-5" data-bs-toggle="modal"
                                        data-bs-target="#modal_penunjang">Tambah Penunjang</button>
                                    @include('rawat-inap.menu.penunjang')
                                </div>
                                <div class="tab-pane fade" id="kt_tab_pane_7" role="tabpanel">
                                    <button class="btn btn-danger btn-sm mb-5" data-bs-toggle="modal"
                                        data-bs-target="#modal_operasi">Tambah Operasi</button>
                                    @include('rawat-inap.menu.operasi')
                                </div>
                                <div class="tab-pane fade" id="kt_tab_pane_8" role="tabpanel">
                                    Diagnosa
                                </div>
                                <div class="tab-pane fade" id="kt_tab_pane_9" role="tabpanel">
                                    Pindah Ruangan
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
                        <form action="">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for=""> Profesi (PPA) </label>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="" class="form-select" id="">
                                                <option value="">-- Profesi (PPA) -- </option>
                                                <option value="Dokter">Dokter</option>
                                                <option value="Perawat">Perawat</option>
                                                <option value="Bidan">Bidan</option>
                                                <option value="Gizi">Gizi</option>
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
                                        <textarea name="" class="form-control" id=""></textarea>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-md-4">
                                    </div>
                                    <div class="col-md-2 text-center">O</div>
                                    <div class="col-md-6">
                                        <textarea name="" class="form-control" id=""></textarea>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-md-4">
                                    </div>
                                    <div class="col-md-2 text-center">A</div>
                                    <div class="col-md-6">
                                        <textarea name="" class="form-control" id=""></textarea>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-md-4">
                                    </div>
                                    <div class="col-md-2 text-center">P</div>
                                    <div class="col-md-6">
                                        <textarea name="" class="form-control" id=""></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" id="modal_implementasi">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Tambah Implementasi Keperawatan</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <form action="">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="">Jam</label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="time" name="" class="form-control" id="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="">Implementasi Keperawatan</label>
                                        </div>
                                        <div class="col-md-8">
                                            <textarea name="" class="form-control" id=""></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" id="modal_tindakan">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Tambah Tindakan</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <form action="">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="kt_tindakan_repeater">
                                        <!--begin::Form group-->
                                        <div class="form-group">
                                            <div data-repeater-list="tindakan_repeater">
                                                <div data-repeater-item>
                                                    <div class="form-group row mb-5">
                                                        <div class="col-md-4">
                                                            <label class="form-label">Tindakan</label>
                                                            <select name="tindakan" class="form-select"
                                                                data-kt-repeater="select22"
                                                                data-placeholder="-Pilih-"required>
                                                                <option></option>
                                                                @foreach ($tarif as $val)
                                                                    <option value="{{ $val->id }}">
                                                                        {{ $val->nama_tarif }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Dokter</label>
                                                            <select name="dokter" class="form-select"
                                                                data-kt-repeater="select22" data-placeholder="-Pilih-">
                                                                <option></option>
                                                                @foreach ($dokter as $val)
                                                                    <option value="{{ $val->id }}">
                                                                        {{ $val->nama_dokter }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label class="form-label">Jumlah</label>
                                                            <input type="number" name="jumlah"
                                                                class="form-control mb-5 mb-md-0"
                                                                min="0"required />
                                                        </div>
                                                        <div class="col-md-2">
                                                            <a href="javascript:;" data-repeater-delete
                                                                class="btn btn-light-danger mt-3 mt-md-8">
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
                                        <div class="form-group mt-5">
                                            <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                                <i class="ki-duotone ki-plus fs-3"></i>
                                                Tambah Tindakan
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" id="modal_obat" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Tambah Obat Obatan</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>
                    <form id='frmOrderobat' action="{{ route('postOrderObat.rawat-inap', $rawat->id) }}" method="POST">
                        <div class="modal-body">

                            @csrf
                            <div class="row mb-5">
                                <!--begin::Repeater-->
                                <div id="kt_docs_repeater_basic">
                                    <!--begin::Form group-->
                                    <div class="form-group">
                                        <div data-repeater-list="terapi_obat">
                                            <div data-repeater-item>
                                                <div class="form-group row mb-5">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Obat</label>
                                                        <select name="obat" class="form-select" id='select-obat'
                                                            data-kt-repeater="select2" data-placeholder="-Pilih-"
                                                            required>
                                                            <option></option>
                                                            @foreach ($obat as $val)
                                                                <option value="{{ $val->id }}">{{ $val->nama_obat }}
                                                                    - {{ $val->satuan->satuan }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label">Signa</label>
                                                        <div class="input-group mb-5">
                                                            <input type="text" class="form-control" name='signa1'
                                                                placeholder="...." aria-label="Username">
                                                            <span class="input-group-text">X</span>
                                                            <input type="text" class="form-control" name='signa2'
                                                                placeholder="...." aria-label="Server">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label">Jumlah Obat</label>
                                                        <input type="number" name="jumlah_obat"
                                                            class="form-control mb-5 mb-md-0" min="0" required>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <a href="javascript:;" data-repeater-delete
                                                            class="btn btn-light-danger mt-3 mt-md-8">
                                                            <i class="ki-duotone ki-trash fs-5"><span
                                                                    class="path1"></span><span
                                                                    class="path2"></span><span
                                                                    class="path3"></span><span
                                                                    class="path4"></span><span class="path5"></span></i>
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
        <div class="modal fade" tabindex="-1" id="modal_penunjang">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Tambah Tindakan Penunjang</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>
                    <form id='frmpenunjang' action="{{ route('postOrderPenunjang.rawat-inap', $rawat->id) }}"
                        method="post">
                        <div class="modal-body">

                            @csrf
                            <div class="row mb-5">
                                <!--begin::Repeater-->
                                <div id="radiologi_repeater">
                                    <!--begin::Form group-->
                                    <div class="form-group">
                                        <div data-repeater-list="radiologi">
                                            <div data-repeater-item>
                                                <div class="form-group row mb-5">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Tindakan Rad</label>
                                                        <select name="tindakan_rad" class="form-select"
                                                            data-kt-repeater="select2radiologi" data-placeholder="-Pilih-"
                                                            required>
                                                            <option></option>
                                                            @foreach ($radiologi as $rad)
                                                                <option value="{{ $rad->id }}">
                                                                    {{ $rad->nama_tindakan }}</option>
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
                                                                    class="path4"></span><span class="path5"></span></i>
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
                                                                    class="path4"></span><span class="path5"></span></i>
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

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" id="modal_pulang">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Pasien Pulang</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <form action="">

                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" id="modal_operasi">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Tambah Operasi</h3>
                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <form action="{{ route('store.operasi') }}" method="POST" autocomplete="off">
                            @csrf
                            <input type="hidden" name="idrawat" value="{{ $rawat->id }}">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="" class="form-label required">Tanggal Operasi</label>
                                    <input class="form-control" placeholder="Pilih Tanggal Operasi" id="tgl_operasi"
                                        name="tgl_operasi" required />
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <label for="" class="form-label required">Diagnosis Prabedah</label>
                                    <textarea name="diagnosis_prabedah" id="diagnosis_prabedah" rows="3" class="form-control"
                                        placeholder="Masukan Diagnosis" required></textarea>
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
    @endsection
    @section('js')
        <script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
        <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js"></script>
        <script>
            $(function() {
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

                $("#frmpemeriksaan_fisik").on("submit", function(event) {
                    event.preventDefault();
                    var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
                    Swal.fire({
                        title: 'Simpan Data',
                        text: "Apakah Anda yakin akan menyimpan data pemeriksaan fisik ?",
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
                $("#frm_pengkajian").on("submit", function(event) {
                    event.preventDefault();
                    var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
                    Swal.fire({
                        title: 'Simpan Data',
                        text: "Apakah Anda yakin akan menyimpan data ringakasan masuk ?",
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

                $("#frmOrderobat").on("submit", function(event) {
                    event.preventDefault();
                    var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
                    Swal.fire({
                        title: 'Order Obat',
                        text: "Apakah Anda yakin akan order obat ?",
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
                $("#frmpenunjang").on("submit", function(event) {
                    event.preventDefault();
                    var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
                    Swal.fire({
                        title: 'Order Obat',
                        text: "Apakah Anda yakin akan order pemeriksaan penunjang ?",
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

                $('#kt_tindakan_repeater').repeater({
                    initEmpty: false,

                    show: function() {
                        $(this).slideDown();

                        $(this).find('[data-kt-repeater="select22"]').select2({
                            allowClear: true,
                            dropdownParent: $('#modal_obat')
                        });
                    },

                    hide: function(deleteElement) {
                        $(this).slideUp(deleteElement);
                    },

                    ready: function() {
                        $('[data-kt-repeater="select22"]').select2({
                            allowClear: true,
                            dropdownParent: $('#modal_obat')
                        });
                    }
                });

                $('#kt_docs_repeater_basic').repeater({
                    initEmpty: true,

                    show: function() {
                        $(this).slideDown();

                        $(this).find('[data-kt-repeater="select2"]').select2({
                            allowClear: true,
                            dropdownParent: $('#modal_obat')
                        });
                    },

                    hide: function(deleteElement) {
                        $(this).slideUp(deleteElement);
                    },

                    ready: function() {
                        $('[data-kt-repeater="select2"]').select2({
                            allowClear: true,
                            dropdownParent: $('#modal_obat')
                        });
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

                $('#icdx_repeater').repeater({
                    @if (isset($ringakasan_pasien_masuk))
                        @if ($ringakasan_pasien_masuk->icd10!= null)
                            initEmpty: false,
                        @else
                            initEmpty: true,
                        @endif
                    @else
                        initEmpty: true,
                    @endif
                    show: function() {
                        $(this).slideDown();

                        $(this).find('[data-kt-repeater="select222"]').select2({
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
                        $('[data-kt-repeater="select222"]').select2({
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
                $('#icdx_repeater_sekunder').repeater({
                    @if (isset($ringakasan_pasien_masuk))
                        @if ($ringakasan_pasien_masuk->icd10_sekunder != null)
                            initEmpty: false,
                        @else
                            initEmpty: true,
                        @endif
                    @else
                        initEmpty: true,
                    @endif

                    show: function() {
                        $(this).slideDown();

                        $(this).find('[data-kt-repeater="select2222"]').select2({
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
                        $('[data-kt-repeater="select2222"]').select2({
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
                $('#icd9_repeater').repeater({
                    @if (isset($ringakasan_pasien_masuk))
                        @if ($ringakasan_pasien_masuk->icd9 != null)
                            initEmpty: false,
                        @else
                            initEmpty: true,
                        @endif
                    @else
                        initEmpty: true,
                    @endif

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

                $("#tgl_operasi").flatpickr({
                    altInput: true,
                    altFormat: "d-m-Y",
                    dateFormat: "Y-m-d"
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
