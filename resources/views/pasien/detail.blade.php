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
                            <li class="breadcrumb-item text-muted">Pasien</li>
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
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="row g-5">
                    <div class="col-md-4">
                        <div class="card  mb-5">
                            <div class="card-header">
                                <h4 class="card-title">Data Pasien</h4>

                                <div class="card-toolbar">
                                    <button class="btn btn-light btn-sm">Ubah</button>
                                </div>
                            </div>
                            <div class="card-body p-9">
                                <!--begin::Row-->
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">Alamat</label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800">{{ $pasien->nama_pasien }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->

                                <!--begin::Input group-->
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">No. Rekammedis</label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <span class="fw-semibold text-gray-800 fs-6">{{ $pasien->no_rm }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">NIK</label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <span class="fw-semibold text-gray-800 fs-6">{{ $pasien->nik }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">No. BPJS</label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <span class="fw-semibold text-gray-800 fs-6">{{ $pasien->no_bpjs }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">
                                        Kontak Pasien

                                        <span class="ms-1" data-bs-toggle="tooltip"
                                            aria-label="Phone number must be active"
                                            data-bs-original-title="Phone number must be active" data-kt-initialized="1">
                                            <i class="ki-duotone ki-information fs-7"><span class="path1"></span><span
                                                    class="path2"></span><span class="path3"></span></i> </span>
                                    </label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8 d-flex align-items-center">
                                        <span class="fw-bold fs-6 text-gray-800 me-2">{{ $pasien->nohp }}</span>
                                        {{-- <span class="badge badge-success">Verified</span> --}}
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">Jenis Kelamin</label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span
                                            class="fw-bold fs-6 text-gray-800">{{ $pasien->jenis_kelamin == 'L' ? 'Laki-laki' : 'perempuan' }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">
                                        Tanggal Lahir
                                    </label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8 d-flex align-items-center">
                                        <span
                                            class="fw-bold fs-6 me-3 text-gray-800">{{ date('d F Y', strtotime($pasien->tgllahir)) }}
                                        </span>
                                        <span class="badge badge-success  ">{{ $pasien->usia_tahun }} th
                                            {{ $pasien->usia_bulan }}bln {{ $pasien->usia_hari }}hr</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">Kepercayaan</label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800">{{ $pasien->agama->agama }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>

                            </div>
                        </div>
                        <div class="card mb-5">
                            <div class="card-header">
                                <h4 class="card-title">Data Alamat</h4>

                                <div class="card-toolbar">
                                    <button class="btn btn-light btn-sm">Ubah</button>
                                </div>
                            </div>
                            <div class="card-body p-9">
                                <!--begin::Row-->
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">Alamat Utama</label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800">{{ $pasien->alamat?->alamat }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>

                            </div>
                        </div>
                        <div class="card mb-5">
                            <div class="card-header">
                                <h4 class="card-title">Data Anggota</h4>

                                <div class="card-toolbar">
                                    <button class="btn btn-light btn-sm">Ubah</button>
                                </div>
                            </div>
                            <div class="card-body p-9">
                                <!--begin::Row-->
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">Kesatuan</label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800">{{ $pasien->kesatuan }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">Pangkat</label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800">{{ $pasien->pangkat }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">NRP</label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800">{{ $pasien->nrp }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row g-5">
                            <div class="col-md-4">
                                <div class="card card-stretch">
                                    <div class="card-header">
                                        <h6 class="card-title">Tanda Vital Terakhir</h6>
                                        <div class="card-toolbar ">
                                            <i class="ki-duotone ki-heart-circle text-primary fs-2hx">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        @if ($detail_rekap_medis)
                                            <div class="row mb-5">
                                                <!--begin::Label-->
                                                <label class="col-lg-7 fw-semibold text-muted">Tinggi Badan</label>
                                                <!--end::Label-->

                                                <!--begin::Col-->
                                                <div class="col-lg-5">
                                                    <span
                                                        class="fw-bold fs-6 text-gray-800">{{ $pemeriksaan_fisik->tinggi_badan ?? '-' }}
                                                        cm</span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <div class="row mb-5">
                                                <!--begin::Label-->
                                                <label class="col-lg-7 fw-semibold text-muted">Berat Badan</label>
                                                <!--end::Label-->

                                                <!--begin::Col-->
                                                <div class="col-lg-5">
                                                    <span
                                                        class="fw-bold fs-6 text-gray-800">{{ $pemeriksaan_fisik->berat_badan ?? '-' }}
                                                        kg</span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <div class="row mb-5">
                                                <!--begin::Label-->
                                                <label class="col-lg-7 fw-semibold text-muted">BMI</label>
                                                <!--end::Label-->

                                                <!--begin::Col-->
                                                <div class="col-lg-5">
                                                    <span
                                                        class="fw-bold fs-6 text-gray-800">{{ $pemeriksaan_fisik->bmi == 'NaN' ? '-' : $pemeriksaan_fisik->bmi }}</span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <div class="row mb-5">
                                                <!--begin::Label-->
                                                <label class="col-lg-7 fw-semibold text-muted">Tekanan Darah</label>
                                                <!--end::Label-->

                                                <!--begin::Col-->
                                                <div class="col-lg-5">
                                                    <span
                                                        class="fw-bold fs-6 text-gray-800">{{ $pemeriksaan_fisik->tekanan_darah }}
                                                        mmHg</span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                        @else
                                            <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                                                <i class="ki-duotone ki-information text-danger fs-2hx me-4">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                                <div class="d-flex flex-column">

                                                    <span>Data TTV tidak ditemukan</span>
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card card-stretch">
                                    <div class="card-header">
                                        <h6 class="card-title">Diagnosis Terakhir</h6>
                                        <div class="card-toolbar">
                                            <button class="btn btn-sm btn-light">Lihat Semua</button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                                <tr class="fw-bold fs-7 text-gray-800 border-bottom border-gray-200">
                                                    <th>ICD X</th>
                                                    <th>Tanggal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($soap_icdx as $icd)
                                                    <tr>
                                                        <td>{{ $icd->icd10 }}</td>
                                                        <td>{{ $icd->tglmasuk }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-5">
                            <div class="col-md-8">
                                <div class="card card-stretch">
                                    <div class="card-header">
                                        <h6 class="card-title">Pemeriksaan Penunjang Terakhir</h6>
                                        <div class="card-toolbar">
                                            <button class="btn btn-sm btn-light">Lihat Semua</button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                                <tr class="fw-bold fs-7 text-gray-800 border-bottom border-gray-200">
                                                    <th width="60%">Pemeriksaan</th>
                                                    <th>Jenis</th>
                                                    <th>Tanggal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($penunjang as $p)
                                                    @if ($p->pemeriksaan_penunjang != 'null')
                                                        <tr>

                                                            <td>

                                                                @if ($p->pemeriksaan_penunjang != 'null')
                                                                    @foreach (json_decode($p->pemeriksaan_penunjang) as $pen)
                                                                        @if ($p->jenis_penunjang == 'Lab')
                                                                            @foreach ($lab as $l)
                                                                                @if ($l->id == $pen->tindakan_lab)
                                                                                    {{ $l->nama_pemeriksaan }},
                                                                                @endif
                                                                            @endforeach
                                                                        @elseif($p->jenis_penunjang == 'Radiologi')
                                                                            @foreach ($radiologi as $rad)
                                                                                @if ($rad->id == $pen?->tindakan_rad)
                                                                                    {{ $rad->nama_tindakan }},
                                                                                @endif
                                                                            @endforeach
                                                                        @else
                                                                            @foreach ($fisio_tindakan as $f)
                                                                                @if ($f->id == $pen?->tindakan_fisio)
                                                                                    {{ $f->nama_tarif }},
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($p->jenis_penunjang == 'Radiologi')
                                                                    <span
                                                                        class="badge badge-danger">{{ $p->jenis_penunjang }}</span>
                                                                @elseif($p->jenis_penunjang == 'Lab')
                                                                    <span
                                                                        class="badge badge-warning">{{ $p->jenis_penunjang }}</span>
                                                                @else
                                                                    <span
                                                                        class="badge badge-info">{{ $p->jenis_penunjang }}</span>
                                                                @endif
                                                            </td>
                                                            <td>{{ $p->created_at }}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-stretch">
                                    <div class="card-header">
                                        <h6 class="card-title">Kunjungan Terakhir</h6>
                                        <div class="card-toolbar">

                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="timeline timeline-border-dashed">

                                            <div class="timeline-item">
                                                <!--begin::Timeline line-->
                                                {{-- <div class="timeline-line"></div> --}}
                                                <!--end::Timeline line-->

                                                <!--begin::Timeline icon-->
                                                <div class="timeline-icon me-4">
                                                    <i class="ki-duotone ki-book-square fs-2 text-gray-500">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>
                                                </div>
                                                <!--end::Timeline icon-->

                                                <!--begin::Timeline content-->
                                                <div class="timeline-content mb-10 mt-n2">
                                                    <!--begin::Timeline heading-->
                                                    <div class="overflow-auto pe-3">
                                                        <!--begin::Title-->
                                                        <div class="fs-7 text-muted  fw-semibold mb-2">
                                                            Anamnesa
                                                        </div>
                                                        <!--end::Title-->

                                                        <!--begin::Description-->
                                                        <div class="d-flex align-items-center mt-1 fs-6">
                                                            <!--begin::Info-->
                                                            <div class="me-2 fs-6"> {{ $detail_rekap_medis?->anamnesa }}
                                                            </div>
                                                            <!--end::User-->
                                                        </div>
                                                        <!--end::Description-->
                                                    </div>
                                                    <!--end::Timeline heading-->
                                                </div>
                                                <!--end::Timeline content-->
                                            </div>
                                            <div class="timeline-item">
                                                <!--begin::Timeline line-->
                                                {{-- <div class="timeline-line"></div> --}}
                                                <!--end::Timeline line-->

                                                <!--begin::Timeline icon-->
                                                <div class="timeline-icon me-4">
                                                    <i class="ki-duotone ki-bandage fs-2 text-gray-500">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>
                                                </div>
                                                <!--end::Timeline icon-->

                                                <!--begin::Timeline content-->
                                                <div class="timeline-content mb-10 mt-n2">
                                                    <!--begin::Timeline heading-->
                                                    <div class="overflow-auto pe-2">
                                                        <!--begin::Title-->
                                                        <div class="fs-7 text-muted  fw-semibold mb-2">
                                                            Diagnosa
                                                        </div>
                                                        <!--end::Title-->

                                                        <!--begin::Description-->
                                                        <div class="d-flex align-items-center mt-1 fs-6">
                                                            <!--begin::Info-->
                                                            <div class="me-2 fs-6"> {{ $detail_rekap_medis?->diagnosa }}
                                                            </div>
                                                            <!--end::User-->
                                                        </div>
                                                        <!--end::Description-->
                                                    </div>
                                                    <!--end::Timeline heading-->
                                                </div>
                                                <!--end::Timeline content-->
                                            </div>
                                            <div class="timeline-item">
                                                <!--begin::Timeline line-->
                                                {{-- <div class="timeline-line"></div> --}}
                                                <!--end::Timeline line-->

                                                <!--begin::Timeline icon-->
                                                <div class="timeline-icon me-4">
                                                    <i class="ki-duotone ki-capsule fs-2 text-gray-500">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>
                                                </div>
                                                <!--end::Timeline icon-->

                                                <!--begin::Timeline content-->
                                                <div class="timeline-content mb-10 mt-n2">
                                                    <!--begin::Timeline heading-->
                                                    <div class="overflow-auto pe-2">
                                                        <!--begin::Title-->
                                                        <div class="fs-7 text-muted  fw-semibold mb-2">
                                                            Terapi Obat
                                                        </div>
                                                        <!--end::Title-->

                                                        <!--begin::Description-->
                                                        <div class="d-flex align-items-center mt-1 fs-6">
                                                            <!--begin::Info-->
                                                            <div class="me-2 fs-6">
                                                                @if ($terapi_obat && json_decode($terapi_obat))
                                                                    @foreach (json_decode($terapi_obat) as $to)
                                                                        @foreach ($obat as $o)
                                                                            @if ($o->id == $to->obat)
                                                                                {{ $o->nama_obat }}
                                                                            @endif
                                                                        @endforeach
                                                                    @endforeach
                                                                @endif

                                                            </div>
                                                            <!--end::User-->
                                                        </div>
                                                        <!--end::Description-->
                                                    </div>
                                                    <!--end::Timeline heading-->
                                                </div>
                                                <!--end::Timeline content-->
                                            </div>
                                            

                                        </div>
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
