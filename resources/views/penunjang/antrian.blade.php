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
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Antrian penunjang</h1>
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
                        <li class="breadcrumb-item text-muted">Antrian Resep</li>
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
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="card-title">Rawat Jalan</h5>
                            </div>
                        </div>
                        <!--begin::Body-->
                        <div class="card-body">
                            @foreach ($penunjang_rajal as $rr)
                            <a href="{{ route('penunjang.detail',[$rr->idrawat,$jenis]) }}">
                                <div class="rounded border mb-2 bg-light-primary"> 
                                    <div class="row p-2">
                                        <!--begin::Label-->
                                        <label class="col-md-4 fw-semibold text-muted">No RM</label>
                                        <div class="col-md-8">
                                            <span class="md-bold fs-6 text-gray-800">{{ $rr->no_rm }}</span>
                                        </div>                                    
                                        <!--end::Col-->
                                    </div>
                                    <div class="row p-2">
                                        <label class="col-md-4 fw-semibold text-muted">Poliklinik</label>
                                        <div class="col-md-8">
                                            <span class="md-bold fs-6 text-gray-800">{{ $rr->rawat->poli->poli }}</span>
                                        </div>
                                    </div>
                                    <div class="row p-2">
                                        <label class="col-md-4 fw-semibold text-muted">Dokter</label>
                                        <div class="col-md-8">
                                            <span class="md-bold fs-6 text-gray-800">{{ $rr->rawat->dokter->nama_dokter }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                           
                        </div>
                        <!--end::Body-->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="card-title">UGD</h5>
                            </div>
                        </div>
                        <!--begin::Body-->
                        <div class="card-body">
                            @foreach ($penunjang_ugd as $rr)
                            <a href="{{ route('penunjang.detail',[$rr->idrawat,$jenis]) }}">
                                <div class="rounded border mb-2 bg-light-danger"> 
                                    <div class="row p-2">
                                        <!--begin::Label-->
                                        <label class="col-md-4 fw-semibold text-muted">No RM</label>
                                        <div class="col-md-8">
                                            <span class="md-bold fs-6 text-gray-800">{{ $rr->no_rm }}</span>
                                        </div>                                    
                                        <!--end::Col-->
                                    </div>
                                    <div class="row p-2">
                                        <label class="col-md-4 fw-semibold text-muted">Dokter</label>
                                        <div class="col-md-8">
                                            <span class="md-bold fs-6 text-gray-800">{{ $rr->rawat->dokter->nama_dokter }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        <!--end::Body-->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h5 class="card-title">Ranap</h5>
                            </div>
                        </div>
                        <!--begin::Body-->
                        <div class="card-body">
                            @foreach ($penunjang_ranap as $rr)
                            <a href="{{ route('penunjang.detail',[$rr->idrawat,$jenis]) }}">
                                <div class="rounded border mb-2 bg-light-info"> 
                                    <div class="row p-2">
                                        <!--begin::Label-->
                                        <label class="col-md-4 fw-semibold text-muted">No RM</label>
                                        <div class="col-md-8">
                                            <span class="md-bold fs-6 text-gray-800">{{ $rr->no_rm }}</span>
                                        </div>                                    
                                        <!--end::Col-->
                                    </div>
                                    <div class="row p-2">
                                        <!--begin::Label-->
                                        <label class="col-md-4 fw-semibold text-muted">Ruangan</label>
                                        <div class="col-md-8">
                                            <span class="md-bold fs-6 text-gray-800">{{ $rr->rawat->id }}</span>
                                        </div>                                    
                                        <!--end::Col-->
                                    </div>
                                    <div class="row p-2">
                                        <label class="col-md-4 fw-semibold text-muted">Dokter</label>
                                        <div class="col-md-8">
                                            <span class="md-bold fs-6 text-gray-800">{{ $rr->rawat->dokter->nama_dokter }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @endforeach
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
<script>
  
</script>
@endsection
