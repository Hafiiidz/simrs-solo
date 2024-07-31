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
                            Rekammedis</h1>
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
                            <li class="breadcrumb-item text-muted">Tambah Kunjungan Pasien Umum</li>
                            <!--end::Item-->
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>

                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                       
                    </div>
                    <!--end::Page title-->
                </div>
                <!--end::Toolbar wrapper-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="row g-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-4">
                                <h2>Informasi Pasien</h2>
                                <div class="form-group row">
                                    <label for="nama" class="col-sm-4 col-form-label">Nama Pasien</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="nama" name="nama">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nomor_rekam_medis" class="col-sm-4 col-form-label">Nomor Rekam Medis</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="nomor_rekam_medis" name="nomor_rekam_medis">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tanggal_lahir" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jenis_kelamin" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                            <option value="pria">Pria</option>
                                            <option value="wanita">Wanita</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="alamat" name="alamat">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
