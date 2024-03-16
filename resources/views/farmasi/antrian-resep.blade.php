@extends('layouts.index')
@section('css')
@endsection
@section('content')
    @if ($total_antrian > 0)
        <audio autoplay>
            <source src="{{ asset('assets/media/FGTP7RQ-notification.mp3') }}" type="audio/mp3">
        </audio>
    @endif
    <div id="playOnHover" class="d-flex flex-column flex-column-fluid">
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
                            Antrian
                            Resep</h1>
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
                        <div class="card card-flush bg-light-info h-xl-100">
                            <div class="card-body pt-0">
                                <!--begin::Content-->
                                <div class="d-flex flex-stack my-5">
                                    <span class="text-gray-500 fs-7 fw-bold">ANTRIAN RAWAT JALAN</span>

                                    {{-- <span class="text-gray-500 fw-bold fs-7">PASIEN</span> --}}
                                </div>
                                <!--end::Content-->

                                @foreach ($resep_rajal as $rr)
                                    <!--begin::Item-->
                                    @php
                                        $cek_rawat = App\Models\Rawat::where('id', $rr->idrawat)->first();
                                    @endphp
                                    @if ($cek_rawat)
                                        <a href="{{ route('farmasi.status-rajal', $rr->idrawat) }}">
                                            <div class="d-flex text-end">
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Icon-->

                                                    <span class="fs-2x fw-bold d-block text-gray-800 me-5 mb-2 lh-1 ">RJ -
                                                        {{ $rr->no_antrian }}</span>
                                                    <!--end::Icon-->

                                                    <!--begin::Section-->
                                                    <div class="">
                                                        <a href="{{ route('farmasi.status-rajal', $rr->idrawat) }}"
                                                            class="text-gray-800 text-hover-primary fs-3 fw-bold lh-0">{{ $rr->pasien->nama_pasien }}</a>

                                                        <span class="text-gray-500 fw-semibold d-block fs-7">No RM:
                                                            {{ $rr->no_rm }}</span>
                                                        <span class="text-gray-500 fw-semibold d-block fs-7">Poli :
                                                            {{ $rr->rawat?->poli?->poli }}</span>
                                                        <span class="text-gray-500 fw-semibold d-block fs-7">Dokter :
                                                            {{ $rr->rawat?->dokter?->nama_dokter }}</span>
                                                    </div>
                                                    <!--end::Section-->
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                    <!--end::Item-->

                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed my-4"></div>
                                    <!--end::Separator-->
                                @endforeach




                            </div>
                            <!--end::Body-->
                        </div>
                        {{-- <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <h5 class="card-title">Rawat Jalan</h5>
                                </div>
                            </div>
                            <!--begin::Body-->
                            <div class="card-body">
                                @foreach ($resep_rajal as $rr)
                                    <a href="{{ route('farmasi.status-rajal', $rr->idrawat) }}">
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
                                                    <span
                                                        class="md-bold fs-6 text-gray-800">{{ $rr->rawat->poli->poli }}</span>
                                                </div>
                                            </div>
                                            <div class="row p-2">
                                                <label class="col-md-4 fw-semibold text-muted">Dokter</label>
                                                <div class="col-md-8">
                                                    <span
                                                        class="md-bold fs-6 text-gray-800">{{ $rr->rawat->dokter->nama_dokter }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach

                            </div>
                            <!--end::Body-->
                        </div> --}}
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card card-flush bg-light-danger h-xl-100">
                                <div class="card-body pt-0">
                                    <!--begin::Content-->
                                    <div class="d-flex flex-stack my-5">
                                        <span class="text-gray-500 fs-7 fw-bold">ANTRIAN UGD</span>

                                        {{-- <span class="text-gray-500 fw-bold fs-7">PASIEN</span> --}}
                                    </div>
                                    <!--end::Content-->

                                    @foreach ($resep_ugd as $rr)
                                        @php
                                            $cek_rawat = App\Models\Rawat::where('id', $rr->idrawat)->first();
                                        @endphp
                                        @if ($cek_rawat)
                                            <!--begin::Item-->
                                            <a href="{{ route('farmasi.status-rajal', $rr->idrawat) }}">
                                                <div class="d-flex text-end">
                                                    <!--begin::Wrapper-->
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Icon-->

                                                        <span
                                                            class="fs-2x fw-bold d-block text-gray-800 me-5 mb-2 lh-1 ">UGD
                                                            -
                                                            {{ $rr->no_antrian }}</span>
                                                        <!--end::Icon-->

                                                        <!--begin::Section-->
                                                        <div class="">
                                                            <a href="{{ route('farmasi.status-rajal', $rr->idrawat) }}"
                                                                class="text-gray-800 text-hover-primary fs-3 fw-bold lh-0">{{ $rr->pasien->nama_pasien }}</a>

                                                            <span class="text-gray-500 fw-semibold d-block fs-7">No RM:
                                                                {{ $rr->no_rm }}</span>
                                                            <span class="text-gray-500 fw-semibold d-block fs-7">Poli :
                                                                {{ $rr->rawat->poli->poli }}</span>
                                                            <span class="text-gray-500 fw-semibold d-block fs-7">Dokter :
                                                                {{ $rr->rawat->dokter->nama_dokter }}</span>
                                                        </div>
                                                        <!--end::Section-->
                                                    </div>
                                                </div>
                                            </a>
                                        @endif
                                        <!--end::Item-->

                                        <!--begin::Separator-->
                                        <div class="separator separator-dashed my-4"></div>
                                        <!--end::Separator-->
                                    @endforeach




                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card card-flush bg-light-success h-xl-100">
                                <div class="card-body pt-0">
                                    <!--begin::Content-->
                                    <div class="d-flex flex-stack my-5">
                                        <span class="text-gray-500 fs-7 fw-bold">ANTRIAN RAWAT INAP</span>

                                        {{-- <span class="text-gray-500 fw-bold fs-7">PASIEN</span> --}}
                                    </div>
                                    <!--end::Content-->

                                    @foreach ($resep_ranap as $rr)
                                        <!--begin::Item-->
                                        @php
                                            $cek_rawat = App\Models\Rawat::where('id', $rr->idrawat)->first();
                                        @endphp
                                        @if ($cek_rawat)
                                        <a href="{{ route('farmasi.status-ranap', $rr->idrawat) }}">
                                            <div class="d-flex text-end">
                                                <!--begin::Wrapper-->
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Icon-->

                                                    <span class="fs-2x fw-bold d-block text-gray-800 me-5 mb-2 lh-1 ">RI -
                                                        {{ $rr->no_antrian }}</span>
                                                    <!--end::Icon-->

                                                    <!--begin::Section-->
                                                    <div class="">
                                                        <a href="{{ route('farmasi.status-ranap', $rr->idrawat) }}"
                                                            class="text-gray-800 text-hover-primary fs-3 fw-bold lh-0">{{ $rr->pasien->nama_pasien }}</a>

                                                        <span class="text-gray-500 fw-semibold d-block fs-7">No RM:
                                                            {{ $rr->no_rm }}</span>
                                                        <span class="text-gray-500 fw-semibold d-block fs-7">Ruangan :
                                                            {{ $rr->rawat->ruangan->nama_ruangan }}</span>
                                                        <span class="text-gray-500 fw-semibold d-block fs-7">Dokter :
                                                            {{ $rr->rawat->dokter->nama_dokter }}</span>
                                                    </div>
                                                    <!--end::Section-->
                                                </div>
                                            </div>
                                        </a>
                                        @endif
                                        <!--end::Item-->

                                        <!--begin::Separator-->
                                        <div class="separator separator-dashed my-4"></div>
                                        <!--end::Separator-->
                                    @endforeach




                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Body-->
                        </div>
                        {{-- <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <h5 class="card-title">Ranap</h5>
                                </div>
                            </div>
                            <!--begin::Body-->
                            <div class="card-body">
                                @foreach ($resep_ranap as $rr)
                                    <a href="{{ route('farmasi.status-ranap', $rr->idrawat) }}">
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
                                                <label class="col-md-4 fw-semibold text-muted">Pasien</label>
                                                <div class="col-md-8">
                                                    <span
                                                        class="md-bold fs-6 text-gray-800">{{ $rr->pasien->nama_pasien }}</span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <div class="row p-2">
                                                <!--begin::Label-->
                                                <label class="col-md-4 fw-semibold text-muted">Ruangan</label>
                                                <div class="col-md-8">
                                                    <span
                                                        class="md-bold fs-6 text-gray-800">{{ $rr->rawat->ruangan->nama_ruangan }}</span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <div class="row p-2">
                                                <label class="col-md-4 fw-semibold text-muted">Dokter</label>
                                                <div class="col-md-8">
                                                    <span
                                                        class="md-bold fs-6 text-gray-800">{{ $rr->rawat->dokter->nama_dokter }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <!--end::Body-->
                        </div> --}}
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
        @if ($total_antrian > 0)
            window.onload = function() {
                var audioContext = new(window.AudioContext || window.webkitAudioContext)();
            }
        @endif

      
    </script>
@endsection
