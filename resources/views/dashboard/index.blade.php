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
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Dashboard</h1>
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
                        <li class="breadcrumb-item text-muted">Dashboard</li>
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
            <div class="d-flex flex-wrap flex-stack mb-6" data-select2-id="select2-data-136-zz50">
                <!--begin::Title-->
                <h3 class="fw-bold my-2">
                    Ketersediaan Tempat Tidur
                </h3>
                <!--end::Title-->
            </div>
            <div class="row g-6 g-xl-9">
                @foreach ($ruangan as $val)
                    <div class="col-sm-6 col-xl-3">
                        <!--begin::Card-->
                        <div class="card shadow h-100" style="background-image:url('{{ asset('assets/media/patterns/vektor-2.png') }}');background-size: cover; ">
                            <!--begin::Card header-->
                            <div class="card-header flex-nowrap border-0 pt-9">
                                <!--begin::Card title-->
                                <div class="card-title m-0">
                                    <!--begin::Icon-->
                                    <div class="symbol me-5">
                                        <i class="fa-solid fa-bed fs-4"></i>
                                    </div>
                                    <!--end::Icon-->

                                    <!--begin::Title-->
                                    
                                    <a href="#" class="fs-4 fw-semibold text-hover-primary text-gray-600 m-0">
                                        {{ $val->nama_ruangan }} <br> ( {{ $val->bed_count }} BED )
                                    </a>
                                    <!--end::Title-->
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="card-body d-flex flex-column px-9 pt-6 pb-8">
                                <!--begin::Heading-->
                                <div class="fs-2x fw-bold mb-3">
                                    {{ $val->bed_kosong_count }} KOSONG
                                </div>
                                <!--end::Heading-->
                                <!--begin::Stats-->
                                <div class="d-flex align-items-center flex-wrap mb-5 mt-auto fs-6">
                                    <i class="ki-outline ki-Up-right fs-3 me-1 text-danger"></i>
                                    <!--begin::Label-->
                                    <div class="fw-semibold text-gray-500">
                                        {{ $val->kelas->kelas }}
                                    </div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                @endforeach
            </div>
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>
@endsection
@section('js')
<script>
    $(function(){

    });
</script>
@endsection
