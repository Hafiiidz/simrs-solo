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
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Antrian
                            Operasi</h1>
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
                            <li class="breadcrumb-item text-muted">Operasi</li>
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
                            <h5 class="card-title">Operasi</h5>
                        </div>
                        <div class="card-toolbar">
                            <button type="button" class="btn btn-primary btn-sm"
                                data-bs-toggle="modal"data-bs-target="#modal_status">Ubah Status</button>
                            &nbsp;
                            <a href="{{ route('index.operasi') }}" class="btn btn-secondary btn-sm">Kembali</a>
                        </div>
                    </div>
                    <!--begin::Body-->
                    <div class="card-body p-lg-15">
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
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row mb-3">
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-4">{{ $data->rawat->pasien->nama_pasien }}</span>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <!--begin::Label-->
                                    <label class="col-lg-3 fw-semibold text-muted">NO RM</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800">{{ $data->rawat->pasien->no_rm }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-5">
                                    <!--begin::Label-->
                                    <label class="col-lg-3 fw-semibold text-muted">NIK</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800">{{ $data->rawat->pasien->nik }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-5">
                                    <!--begin::Label-->
                                    <label class="col-lg-3 fw-semibold text-muted">No BPJS</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800">{{ $data->rawat->pasien->no_bpjs }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-5">
                                    <!--begin::Label-->
                                    <label class="col-lg-3 fw-semibold text-muted">No Handphone</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800">{{ $data->rawat->pasien->nohp }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-5">
                                    <!--begin::Label-->
                                    <label class="col-lg-3 fw-semibold text-muted">Alamat</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span
                                            class="fw-bold fs-6 text-gray-800">{{ $data->rawat->pasien->alamat->alamat }}</span>
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
                                        {{-- <li class="nav-item" role="presentation">
                                            <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0 "
                                                data-bs-toggle="tab" href="#kt_tab_pane_0" aria-selected="true"
                                                role="tab">Check List</a>
                                        </li> --}}
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0 active"
                                                data-bs-toggle="tab" href="#kt_tab_pane_1" aria-selected="true"
                                                role="tab">Laporan Operasi</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0 "
                                                data-bs-toggle="tab" href="#kt_tab_pane_2" aria-selected="true"
                                                role="tab">Biaya & BHP</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0 "
                                                data-bs-toggle="tab" href="#kt_tab_pane_3" aria-selected="true"
                                                role="tab">Catatan Anestesi</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content" id="myTabContent">
                                    {{-- <div class="tab-pane fade" id="kt_tab_pane_0" role="tabpanel">
                                        
                                    </div> --}}
                                    <div class="tab-pane fade  show active" id="kt_tab_pane_1" role="tabpanel">
                                        <div class="rounded border p-5">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <span class="d-inline-block position-relative mb-7">
                                                        <!--begin::Label-->
                                                        <span class="d-inline-block mb-2 fs-4 fw-bold">
                                                            Template Operasi
                                                        </span>
                                                        <!--end::Label-->

                                                        <!--begin::Line-->
                                                        <span
                                                            class="d-inline-block position-absolute h-5px bottom-0 end-0 start-0 bg-primary translate rounded"></span>
                                                        <!--end::Line-->
                                                    </span>
                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <div class="row justify-content-md-start">
                                                                <div class="col-md-auto">
                                                                    @foreach ($template as $val)
                                                                        @if($loop->iteration < 7)
                                                                            <button type="button" class="btn mb-2 btn-light-primary" onclick="showTemplate({{ $val->id }})">{{ $val->nama }}</button>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal-template">Template Lainnya</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-5">
                                                <div class="col-md-12">
                                                    <span class="d-inline-block position-relative mb-7">
                                                        <!--begin::Label-->
                                                        <span class="d-inline-block mb-2 fs-4 fw-bold">
                                                            Detail Operasi
                                                        </span>
                                                        <!--end::Label-->

                                                        <!--begin::Line-->
                                                        <span
                                                            class="d-inline-block position-absolute h-5px bottom-0 end-0 start-0 bg-success translate rounded"></span>
                                                        <!--end::Line-->
                                                    </span>
                                                    <form id="frm-data" action="{{ route('update.operasi', $data->id) }}"
                                                        method="POST" autocomplete="off">
                                                        @csrf
                                                    
                                                    <div class="row mb-5">
                                                        <div class="col-md-4">
                                                            <span class="text-center">
                                                                <h6 class=" mb-2 mt-2 p-2">Sebelum Induksi Anastesi <br> (SIGN IN)</h6>
                                                            </span>
                                                            
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <td>Item</td>
                                                                        <td width='50'>Ceklis</td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($sign_in as $si)
                                                                        <tr>
                                                                            <td>{{ $si->item_cek }}</td>
                                                                            <td>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" {!! App\Helpers\VclaimHelper::cek_list_ok($data->id,'sign_in',$si->id) == 1 ? 'checked':'' !!}  type="checkbox" name="sign_in[]" value="{{ $si->id }}"  id="flexCheckDefault" />
                                                                                    {{-- <label class="form-check-label" for="flexCheckDefault">
                                                                                        Check
                                                                                    </label> --}}
                                                                                </div>
                                                                            </td>
                                                                            =
                                                                        </tr>
                                                                        
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <span class="text-center">
                                                                <h6 class=" mb-2 mt-2 p-2">Sebelum Mengiris Kulit <br> (Time Out)</h6>
                                                            </span>
                                                            
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <td>Item</td>
                                                                        <td width='50'>Ceklis</td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($time_out as $to)
                                                                        <tr>
                                                                            <td>{!! $to->item_cek !!}</td>
                                                                            <td>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="time_out[]" {!! App\Helpers\VclaimHelper::cek_list_ok($data->id,'time_out',$to->id) == 1 ? 'checked':'' !!} value="{{ $to->id }}" id="flexCheckDefault" />                                                                                   
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <span class="text-center">
                                                                <h6 class=" mb-2 mt-2 p-2">Sebelum Pasien Meninggalkan Ruangan  <br>(SIGN OUT)</h6>
                                                            </span>
                                                            
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <td>Item</td>
                                                                        <td width='50'>Ceklis</td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($sign_out as $so)
                                                                        <tr>
                                                                            <td>{{ $so->item_cek }}</td>
                                                                            <td>
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox"{!! App\Helpers\VclaimHelper::cek_list_ok($data->id,'sign_out',$so->id) == 1 ? 'checked':'' !!}  name="sign_out[]" value="{{ $so->id }}" id="flexCheckDefault" />
                                                                                    {{-- <label class="form-check-label" for="flexCheckDefault">
                                                                                        Check
                                                                                    </label> --}}
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                   
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label for="" class="form-label">Tanggal Operasi</label>
                                                                <input class="form-control" placeholder="Pilih Tanggal Operasi"
                                                                    id="tgl_operasi" name="tgl_operasi"
                                                                    value="{{ $data->tgl_operasi }}" required />
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="" class="form-label">Jam Mulai</label>
                                                                <input class="form-control" placeholder="Pilih Jam Mulai"
                                                                    id="mulai_jam" name="mulai_jam"
                                                                    value="{{ $data->mulai_jam }}" required />
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="" class="form-label">Jam Selesai</label>
                                                                <input class="form-control" placeholder="Pilih Jam Mulai"
                                                                    id="selesai_jam" name="selesai_jam"
                                                                    value="{{ $data->selesai_jam }}" required />
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="" class="form-label">Lama Operasi</label>
                                                                <input class="form-control" type="text"
                                                                    placeholder="Masukan Lama Operasi" id="lama_operasi"
                                                                    name="lama_operasi" value="{{ $data->lama_operasi }}"
                                                                    required />
                                                            </div>
                                                        </div>
                                                        <div class="row mt-5">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <!--begin::Repeater-->
                                                                    <div id="dokter_bedah">
                                                                        <!--begin::Form group-->
                                                                        <div class="form-group">
                                                                            <div data-repeater-list="dokter_bedah">
                                                                                <div id="template_dokter_bedah"></div>
                                                                                @if ($data->dokter_bedah)
                                                                                    @foreach (json_decode($data->dokter_bedah) as $val)
                                                                                        <div data-repeater-item>
                                                                                            <div class="form-group row mb-5">
                                                                                                <div class="col-md-10">
                                                                                                    <label
                                                                                                        class="form-label">Dokter
                                                                                                        Bedah</label>
                                                                                                    <input type="text"
                                                                                                        name="dokter_bedah" class="form-control mb-2 mb-md-0"  placeholder="Masukan Nama"
                                                                                                        value="{{ $val->dokter_bedah }}" required/>
                                                                                                </div>
                                                                                                <div class="col-md-2">
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
                                                                                                    </a>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                @else
                                                                                    <div data-repeater-item>
                                                                                        <div class="form-group row mb-5">
                                                                                            <div class="col-md-10">
                                                                                                <label class="form-label">Dokter
                                                                                                    Bedah</label>
                                                                                                <input type="text"
                                                                                                    name="dokter_bedah" class="form-control mb-2 mb-md-0" placeholder="Masukan Nama" required/>
                                                                                            </div>
                                                                                            <div class="col-md-2">
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
                                                                                class="btn btn-sm btn-light-primary">
                                                                                <i class="ki-duotone ki-plus fs-3"></i>
                                                                                Tambah Dokter
                                                                            </a>
                                                                        </div>
                                                                        <!--end::Form group-->
                                                                    </div>
                                                                    <!--end::Repeater-->
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <!--begin::Repeater-->
                                                                    <div id="perawat_bedah">
                                                                        <!--begin::Form group-->
                                                                        <div class="form-group">
                                                                            <div data-repeater-list="perawat_bedah">
                                                                                <div id="template_perawat_bedah"></div>
                                                                                @if ($data->perawat_bedah)
                                                                                    @foreach (json_decode($data->perawat_bedah) as $val)
                                                                                        <div data-repeater-item>
                                                                                            <div class="form-group row mb-5">
                                                                                                <div class="col-md-10">
                                                                                                    <label
                                                                                                        class="form-label">Perawat
                                                                                                        Bedah</label>
                                                                                                    <input type="text"
                                                                                                        name="perawat_bedah"
                                                                                                        class="form-control mb-2 mb-md-0"
                                                                                                        placeholder="Masukan Nama"
                                                                                                        value="{{ $val->perawat_bedah }}" required/>
                                                                                                </div>
                                                                                                <div class="col-md-2">
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
                                                                                                    </a>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                @else
                                                                                    <div data-repeater-item>
                                                                                        <div class="form-group row mb-5">
                                                                                            <div class="col-md-10">
                                                                                                <label class="form-label">Perawat
                                                                                                    Bedah</label>
                                                                                                <input type="text"
                                                                                                    name="perawat_bedah"
                                                                                                    class="form-control mb-2 mb-md-0"
                                                                                                    placeholder="Masukan Nama" required/>
                                                                                            </div>
                                                                                            <div class="col-md-2">
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
                                                                                class="btn btn-sm btn-light-primary">
                                                                                <i class="ki-duotone ki-plus fs-3"></i>
                                                                                Tambah Perawat
                                                                            </a>
                                                                        </div>
                                                                        <!--end::Form group-->
                                                                    </div>
                                                                    <!--end::Repeater-->
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <!--begin::Repeater-->
                                                                    <div id="asisten">
                                                                        <!--begin::Form group-->
                                                                        <div class="form-group">
                                                                            <div data-repeater-list="asisten">
                                                                                <div id="template_asisten"></div>
                                                                                @if ($data->asisten)
                                                                                    @foreach (json_decode($data->asisten) as $val)
                                                                                        <div data-repeater-item>
                                                                                            <div class="form-group row mb-5">
                                                                                                <div class="col-md-10">
                                                                                                    <label
                                                                                                        class="form-label">Asisten</label>
                                                                                                    <input type="text"
                                                                                                        name="asisten"
                                                                                                        class="form-control mb-2 mb-md-0"
                                                                                                        placeholder="Masukan Nama"
                                                                                                        value="{{ $val->asisten }}" required/>
                                                                                                </div>
                                                                                                <div class="col-md-2">
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
                                                                                                    </a>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                @else
                                                                                    <div data-repeater-item>
                                                                                        <div class="form-group row mb-5">
                                                                                            <div class="col-md-10">
                                                                                                <label
                                                                                                    class="form-label">Asisten</label>
                                                                                                <input type="text"
                                                                                                    name="asisten"
                                                                                                    class="form-control mb-2 mb-md-0"
                                                                                                    placeholder="Masukan Nama" required/>
                                                                                            </div>
                                                                                            <div class="col-md-2">
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
                                                                                class="btn btn-sm btn-light-primary">
                                                                                <i class="ki-duotone ki-plus fs-3"></i>
                                                                                Tambah Asisten
                                                                            </a>
                                                                        </div>
                                                                        <!--end::Form group-->
                                                                    </div>
                                                                    <!--end::Repeater-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-5">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label for="" class="form-label">Diagnosis
                                                                        Prabedah</label>
                                                                    <textarea name="diagnosis_prabedah" id="diagnosis_prabedah" rows="5" class="form-control" required>{{ $data->diagnosis_prabedah }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-5">
                                                            <div class="col-md-12">
                                                                <label for="" class="form-label">Jenis Operasi</label>
                                                                <select name="jenis_operasi" class="form-select" id="jenis_operasi"
                                                                    data-control="select2" data-placeholder="Pilih Jenis Operasi">
                                                                    <option></option>
                                                                    <option value="Kecil"
                                                                        {{ $data->jenis_operasi == 'Kecil' ? 'selected' : '' }}>
                                                                        Kecil</option>
                                                                    <option value="Sedang"
                                                                        {{ $data->jenis_operasi == 'Sedang' ? 'selected' : '' }}>
                                                                        Sedang</option>
                                                                    <option value="Besar"
                                                                        {{ $data->jenis_operasi == 'Besar' ? 'selected' : '' }}>
                                                                        Besar</option>
                                                                    <option value="Khusus"
                                                                        {{ $data->jenis_operasi == 'Khusus' ? 'selected' : '' }}>
                                                                        Khusus</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-5">
                                                            <div class="col-md-12">
                                                                <select name="detail_operasi" class="form-select" id="detail_operasi"
                                                                    data-control="select2" data-placeholder="Pilih">
                                                                    <option></option>
                                                                    <option value="Bersih"
                                                                        {{ $data->detail_operasi == 'Bersih' ? 'selected' : '' }}>
                                                                        Bersih</option>
                                                                    <option value="Bersih Terkontaminasi"
                                                                        {{ $data->detail_operasi == 'Bersih Terkontaminasi' ? 'selected' : '' }}>
                                                                        Bersih Terkontaminasi</option>
                                                                    <option value="Terkontaminasi"
                                                                        {{ $data->detail_operasi == 'Terkontaminasi' ? 'selected' : '' }}>
                                                                        Terkontaminasi</option>
                                                                    <option value="Kotor / Terinfeksi"
                                                                        {{ $data->detail_operasi == 'Kotor / Terinfeksi' ? 'selected' : '' }}>
                                                                        Kotor / Terinfeksi</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-5">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label for="" class="form-label">Diagnosis Pasca
                                                                        Bedah</label>
                                                                    <textarea name="diagnosis_pasca_bedah" id="diagnosis_pasca_bedah" rows="5" class="form-control" required>{{ $data->diagnosis_pasca_bedah }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-5">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label for="" class="form-label">Desinfektan
                                                                        Kulit</label>
                                                                    <input type="text" name="desinfektan_kulit" id="desinfektan_kulit"
                                                                        class="form-control"
                                                                        placeholder="Masukan Desinfektan Kulit"
                                                                        value="{{ $data->desinfektan_kulit }}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-5">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <!--begin::Repeater-->
                                                                    <div id="tindakan_bedah">
                                                                        <!--begin::Form group-->
                                                                        <div class="form-group">
                                                                            <div data-repeater-list="tindakan_bedah">
                                                                                <div id="template_tindakan_bedah"></div>
                                                                                @if ($data->tindakan_bedah)
                                                                                    @foreach (json_decode($data->tindakan_bedah) as $val)
                                                                                        <div data-repeater-item>
                                                                                            <div class="form-group row mb-5">
                                                                                                <div class="col-md-10">
                                                                                                    <label
                                                                                                        class="form-label">Tindakan
                                                                                                        Bedah</label>
                                                                                                    <select name="tindakan_bedah"
                                                                                                        class="form-select"
                                                                                                        data-kt-repeater="tindakan_bedah_select"
                                                                                                        data-placeholder="Pilih Tindakan Bedah"
                                                                                                        required>
                                                                                                        <option
                                                                                                            value="{{ $val->tindakan_bedah }}"
                                                                                                            selected>
                                                                                                            {{ $val->tindakan_bedah }}
                                                                                                        </option>
                                                                                                    </select>
                                                                                                </div>
                                                                                                <div class="col-md-2">
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
                                                                                                    </a>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                @else
                                                                                    <div data-repeater-item>
                                                                                        <div class="form-group row mb-5">
                                                                                            <div class="col-md-10">
                                                                                                <label class="form-label">Tindakan
                                                                                                    Bedah</label>
                                                                                                <select name="tindakan_bedah"
                                                                                                    class="form-select"
                                                                                                    data-kt-repeater="tindakan_bedah_select"
                                                                                                    data-placeholder="Pilih Tindakan Bedah"
                                                                                                    required>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-md-2">
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
                                                                                class="btn btn-sm btn-light-primary">
                                                                                <i class="ki-duotone ki-plus fs-3"></i>
                                                                                Tambah Tindakan Bedah
                                                                            </a>
                                                                        </div>
                                                                        <!--end::Form group-->
                                                                    </div>
                                                                    <!--end::Repeater-->
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Indikasi Operasi</label>
                                                                    <textarea name="indikasi_operasi" rows="3" class="form-control" id="indikasi_operasi">{{ $data->indikasi_operasi }}</textarea>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="form-label">Posisi</label>
                                                                    <textarea name="posisi" rows="3" class="form-control">{{ $data->posisi }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-5">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <!--begin::Repeater-->
                                                                    <div id="ahli_anastesi">
                                                                        <!--begin::Form group-->
                                                                        <div class="form-group">
                                                                            <div data-repeater-list="ahli_anastesi">
                                                                                @if ($data->ahli_anastesi)
                                                                                    @foreach (json_decode($data->ahli_anastesi) as $val)
                                                                                        <div data-repeater-item>
                                                                                            <div class="form-group row mb-5">
                                                                                                <div class="col-md-10">
                                                                                                    <label
                                                                                                        class="form-label">Dokter
                                                                                                        Anestesi</label>
                                                                                                    <input type="text"
                                                                                                        name="ahli_anastesi"
                                                                                                        class="form-control mb-2 mb-md-0"
                                                                                                        placeholder="Masukan Nama"
                                                                                                        value="{{ $val->ahli_anastesi }}" />
                                                                                                </div>
                                                                                                <div class="col-md-2">
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
                                                                                                    </a>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                @else
                                                                                    <div data-repeater-item>
                                                                                        <div class="form-group row mb-5">
                                                                                            <div class="col-md-10">
                                                                                                <label class="form-label">Dokter
                                                                                                    Anestesi</label>
                                                                                                <input type="text"
                                                                                                    name="ahli_anastesi"
                                                                                                    class="form-control mb-2 mb-md-0"
                                                                                                    placeholder="Masukan Nama" />
                                                                                            </div>
                                                                                            <div class="col-md-2">
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
                                                                                class="btn btn-sm btn-light-primary">
                                                                                <i class="ki-duotone ki-plus fs-3"></i>
                                                                                Tambah Ahli Anestesi
                                                                            </a>
                                                                        </div>
                                                                        <!--end::Form group-->
                                                                    </div>
                                                                    <!--end::Repeater-->
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <!--begin::Repeater-->
                                                                    <div id="penata_anastesi">
                                                                        <!--begin::Form group-->
                                                                        <div class="form-group">
                                                                            <div data-repeater-list="penata_anastesi">
                                                                                @if ($data->penata_anastesi)
                                                                                    @foreach (json_decode($data->penata_anastesi) as $val)
                                                                                        <div data-repeater-item>
                                                                                            <div class="form-group row mb-5">
                                                                                                <div class="col-md-10">
                                                                                                    <label
                                                                                                        class="form-label">Penata
                                                                                                        Anestesi</label>
                                                                                                    <input type="text"
                                                                                                        name="penata_anastesi"
                                                                                                        class="form-control mb-2 mb-md-0"
                                                                                                        placeholder="Masukan Nama"
                                                                                                        value="{{ $val->penata_anastesi }}" />
                                                                                                </div>
                                                                                                <div class="col-md-2">
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
                                                                                                    </a>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                @else
                                                                                    <div data-repeater-item>
                                                                                        <div class="form-group row mb-5">
                                                                                            <div class="col-md-10">
                                                                                                <label class="form-label">Penata
                                                                                                    Anestesi</label>
                                                                                                <input type="text"
                                                                                                    name="penata_anastesi"
                                                                                                    class="form-control mb-2 mb-md-0"
                                                                                                    placeholder="Masukan Nama" />
                                                                                            </div>
                                                                                            <div class="col-md-2">
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
                                                                                class="btn btn-sm btn-light-primary">
                                                                                <i class="ki-duotone ki-plus fs-3"></i>
                                                                                Tambah Penata Anestesi
                                                                            </a>
                                                                        </div>
                                                                        <!--end::Form group-->
                                                                    </div>
                                                                    <!--end::Repeater-->
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <!--begin::Repeater-->
                                                                    <div id="obat_anastesi">
                                                                        <!--begin::Form group-->
                                                                        <div class="form-group">
                                                                            <div data-repeater-list="obat_anastesi">
                                                                               
                                                                                @if ($data->obat_anastesi)
                                                                                    @foreach (json_decode($data->obat_anastesi) as $val)
                                                                                        <div data-repeater-item>
                                                                                            <div class="form-group row mb-5">
                                                                                                <div class="col-md-10">
                                                                                                    <label class="form-label">Obat
                                                                                                        Anestesi</label>
                                                                                                    <input type="text"
                                                                                                        name="obat_anastesi"
                                                                                                        class="form-control mb-2 mb-md-0"
                                                                                                        placeholder="Masukan Nama"
                                                                                                        value="{{ $val->obat_anastesi }}" />
                                                                                                </div>
                                                                                                <div class="col-md-2">
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
                                                                                                    </a>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                @else
                                                                                    <div data-repeater-item>
                                                                                        <div class="form-group row mb-5">
                                                                                            <div class="col-md-10">
                                                                                                <label class="form-label">Obat
                                                                                                    Anestesi</label>
                                                                                                <input type="text"
                                                                                                    name="obat_anastesi"
                                                                                                    class="form-control mb-2 mb-md-0"
                                                                                                    placeholder="Masukan Nama" />
                                                                                            </div>
                                                                                            <div class="col-md-2">
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
                                                                                class="btn btn-sm btn-light-primary">
                                                                                <i class="ki-duotone ki-plus fs-3"></i>
                                                                                Tambah Obat Anestesi
                                                                            </a>
                                                                        </div>
                                                                        <!--end::Form group-->
                                                                    </div>
                                                                    <!--end::Repeater-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-5">
                                                            <div class="col-md-2">
                                                                <label for="" class="form-label">
                                                                    Jaringan/Kultur
                                                                </label>
                                                                <div class="mt-5" style="margin-left: 20px;">
                                                                    <div
                                                                        class="form-check form-check-custom form-check-solid form-check-sm ml-5">
                                                                        <input class="form-check-input" type="radio"
                                                                            value="1" name="jaringan_kultur"
                                                                            {{ $data->jaringan ? (json_decode($data?->jaringan)->jaringan_kultur == 1 ? 'checked' : '') : '' }} />
                                                                        <label class="form-check-label">
                                                                            Ya
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-5" style="margin-left: 20px;">
                                                                    <div
                                                                        class="form-check form-check-custom form-check-solid form-check-sm ml-5">
                                                                        <input class="form-check-input" type="radio"
                                                                            value="2" name="jaringan_kultur"
                                                                            {{ $data->jaringan ? (json_decode($data?->jaringan)->jaringan_kultur == 2 ? 'checked' : '') : '' }} />
                                                                        <label class="form-check-label">
                                                                            Tidak
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="frm-jaringan" class="col-md-6" style="display: none">
                                                                <label for="" class="form-label">Macam Jaringan</label>
                                                                <textarea name="macam_jaringan" rows="3" class="form-control">{{ isset($data->jaringan) ? json_decode($data?->jaringan)->macam_jaringan : '' }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-5">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label class="form-label">Implant</label>
                                                                    <textarea name="implant" id="implant" rows="3" class="form-control">{{ $data->implant }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-5">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="form-label">Jenis Anestesi</label>
                                                                    <select name="jenis_anastesi" class="form-select" id="jenis_anestesi"
                                                                        data-control="select2"
                                                                        data-placeholder="Pilih Jenis anestesi">
                                                                        <option></option>
                                                                        <option value="Umum"
                                                                            {{ $data?->jenis_anastesi == 'Umum' ? 'selected' : '' }}>
                                                                            Umum</option>
                                                                        <option value="Spinal"
                                                                            {{ $data?->jenis_anastesi == 'Spinal' ? 'selected' : '' }}>
                                                                            Spinal</option>
                                                                        <option value="Lokal"
                                                                            {{ $data?->jenis_anastesi == 'Lokal' ? 'selected' : '' }}>
                                                                            Lokal</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="" class="form-label">Kamar Operasi</label>
                                                                    <input type="text" name="kamar_operasi" id="kamar_operasi"
                                                                        class="form-control" placeholder="Masukan Kamar Operasi"
                                                                        value="{{ $data->kamar_operasi }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-5">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label for="" class="form-label">Komplikasi</label>
                                                                    <input type="text" name="komplikasi" id="komplikasi"
                                                                        class="form-control" placeholder="Masukan Komplikasi"
                                                                        value="{{ $data->komplikasi }}">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="" class="form-label">Jumlah Kehilangan
                                                                        Pendarahan</label>
                                                                    <input type="text" name="jumlah_pendarahan"
                                                                        id="jumlah_pendarahan" class="form-control"
                                                                        placeholder="Masukan Jumlah Pendarahan"
                                                                        value="{{ $data->jumlah_pendarahan }}">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="" class="form-label">Jumlah Darah
                                                                        Masuk</label>
                                                                    <input type="text" name="jumlah_darah_masuk"
                                                                        id="jumlah_darah_masuk" class="form-control"
                                                                        placeholder="Masukan Jumlah Pendarahan"
                                                                        value="{{ $data?->jumlah_darah_masuk }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-5">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label for="" class="form-label">Uraian
                                                                        Pembedahan</label>
                                                                    <textarea name="uraian_pembedahan" id="uraian_pembedahan" rows="5" class="form-control"
                                                                        placeholder="Masukan Uraian Pembedahan">{{ $data->uraian_pembedahan }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-5">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label for="" class="form-label">Instruksi Post
                                                                        Operasi</label>
                                                                    <textarea name="instruksi_post_operasi" id="instruksi_post_operasi" rows="5" class="form-control"
                                                                        placeholder="Masukan Instruksi Post Operasi">{{ $data?->instruksi_post_operasi }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-5">
                                                            <div class="col-md-12">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" id="check_template" />
                                                                    <label class="form-check-label" for="flexCheckDefault">
                                                                        <b>Simpan Ke Template</b>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-5 d-none" id="tampil_template">
                                                            <div class="col-md-6">
                                                                <label for="" class="form-label required">Nama Template</label>
                                                                <input type="text" name="nama_template" id="nama_template" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="row mt-5">
                                                            <div class="col-md-12">
                                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                                        <div class="row mt-5">
                                            <div class="col-md-12">
                                                <button data-bs-toggle="modal" data-bs-target="#kt_modal_1"
                                                    class="btn btn-warning">Tindakan / Tarif Pembedahan</button>
                                            </div>

                                            <div class="col-md-12">
                                                @if ($tindakan)
                                                <br>
                                                    <hr>
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Tindakan</th>
                                                                <th>Keterangan</th>
                                                                <th>Harga</th>
                                                                <th>BHP</th>
                                                                <th>Dokter</th>
                                                                <th>Opsi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($tindakan as $t)
                                                                <tr>
                                                                    <td>
                                                                        @foreach ($tarif as $tr)
                                                                            @if ($tr->id == $t->idtindakan)
                                                                                {{ $tr->nama_tarif }}
                                                                            @endif
                                                                        @endforeach
                                                                    </td>
                                                                    <td>{{ $t->keterangan_tindakan }}</td>
                                                                    <td>{{ number_format($t->harga_tindakan,2) }}</td>
                                                                    <td>{{  number_format($t->harga_bhp,2) }}</td>
                                                                    <td>{{ $t->nama_dokter }}</td>
                                                                    <td>
                                                                        <a href="{{ route('bhp.operasi',[$t->id,$data->id]) }}" class="btn btn-info btn-sm">BHP</a>
                                                                        <a href="{{ route('delete.operasi',$t->id) }}" onclick="return confirm('Yakin Hapus Data?') " class="btn btn-danger btn-sm">Hapus</a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="modal fade" tabindex="-1" id="kt_modal_1">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title">Tindakan OK</h3>

                                                        <!--begin::Close-->
                                                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                                            data-bs-dismiss="modal" aria-label="Close">
                                                            <i class="ki-duotone ki-cross fs-1"><span
                                                                    class="path1"></span><span class="path2"></span></i>
                                                        </div>
                                                        <!--end::Close-->
                                                    </div>
                                                    <form action="{{ route('post_tindakan_ok.operasi',$data->idrawat) }}" id='frmTambahTindakan' method="post">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div id="tarif_ok">
                                                                        <!--begin::Form group-->
                                                                        <div class="form-group">
                                                                            <div data-repeater-list="asisten">
                                                                                <div data-repeater-item>
                                                                                    <div class="form-group row mb-5">
                                                                                        <div class="col-md-12">
                                                                                            <label class="form-label">Tindakan OK</label>
                                                                                            <select name="tindakan_bedah"
                                                                                                class="form-select"
                                                                                                data-kt-repeater="tarif_ok_select"
                                                                                                data-placeholder="Pilih Tarif Tindakan"
                                                                                                required>
                                                                                            </select>

                                                                                        </div>
                                                                                        <div class="col-md-12">
                                                                                            <label
                                                                                                class="form-label">Keterangan Tindakan</label>
                                                                                                <textarea name="keterangan" class="form-control" id="" rows="3"></textarea>

                                                                                        </div>
                                                                                        <div class="col-md-12">
                                                                                            <label
                                                                                                class="form-label">Dokter Operator</label>
                                                                                                <select name="dokter_tindakan" class="form-select" data-kt-repeater="dokter_tindakan_select"data-placeholder="Pilih Dokter Operator"
                                                                                                required>
                                                                                                    <option value=""></option>
                                                                                                    @foreach ($dokter as $d)
                                                                                                        <option value="{{ $d->id }}">{{ $d->nama_dokter }}</option>
                                                                                                    @endforeach
                                                                                                </select>

                                                                                        </div>
                                                                                        <div class="col-md-2">
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
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!--end::Form group-->

                                                                        <!--begin::Form group-->
                                                                        <div class="form-group mt-5">
                                                                            <a href="javascript:;" data-repeater-create
                                                                                class="btn btn-sm btn-light-primary">
                                                                                <i class="ki-duotone ki-plus fs-3"></i>
                                                                                Tambah Tindakan
                                                                            </a>
                                                                        </div>
                                                                        <!--end::Form group-->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
                                        <div class="rounded border p-5">
                                            <span class="d-inline-block position-relative mb-7">
                                                <!--begin::Label-->
                                                <span class="d-inline-block mb-2 fs-4 fw-bold">
                                                    Anestesi
                                                </span>
                                                <!--end::Label-->

                                                <!--begin::Line-->
                                                <span
                                                    class="d-inline-block position-absolute h-5px bottom-0 end-0 start-0 bg-success translate rounded"></span>
                                                <!--end::Line-->
                                            </span>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <span class="d-inline-block position-relative mb-7">
                                                        <!--begin::Label-->
                                                        <span class="d-inline-block mb-2 fs-4 fw-bold">
                                                            Template Anastesi
                                                        </span>
                                                        <!--end::Label-->

                                                        <!--begin::Line-->
                                                        <span
                                                            class="d-inline-block position-absolute h-5px bottom-0 end-0 start-0 bg-primary translate rounded"></span>
                                                        <!--end::Line-->
                                                    </span>
                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <div class="row justify-content-md-start">
                                                                <div class="col-md-auto">
                                                                    @foreach ($template_anastesi as $val)
                                                                        @if($loop->iteration < 7)
                                                                            <button type="button" class="btn btn-light-primary btn-sm" onclick="showTemplateAnastesi({{ $val->id }})">{{ $val->nama }}</button>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal-template-anastesi">Template Lainnya</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-5">
                                                <div class="col">
                                                    <a href="{{ route('cetak-catatan-anestesi.operasi', $catatan->id) }}" class="btn btn-sm btn-secondary" target="_blank">Cetak Catatan Anestesi</a>
                                                </div>
                                            </div>
                                            <form action="{{ route('post-catatan-anestesi.operasi') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="laporan_operasi_id" value="{{ $data->id }}">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="" class="form-label">Tanggal</label>
                                                        <input type="date" name="tanggal" value="{{ $catatan->tanggal }}" class="form-control tgl">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="" class="form-label">Status Fisik</label>
                                                        <select name="status_fisik" class="form-select" data-control="select2" data-placeholder="- Pilih -">
                                                            <option></option>
                                                            <option value="1" {{ ($catatan->status_fisik == 1) ? 'selected' : '' }}>1</option>
                                                            <option value="2" {{ ($catatan->status_fisik == 2) ? 'selected' : '' }}>2</option>
                                                            <option value="3" {{ ($catatan->status_fisik == 3) ? 'selected' : '' }}>3</option>
                                                            <option value="4" {{ ($catatan->status_fisik == 4) ? 'selected' : '' }}>4</option>
                                                            <option value="5" {{ ($catatan->status_fisik == 5) ? 'selected' : '' }}>5</option>
                                                            <option value="E" {{ ($catatan->status_fisik == "E") ? 'selected' : '' }}>E</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="" class="form-label">Jenis / Teknis Anestesis</label>
                                                        <div class="row mt-3">
                                                            <div class="col">
                                                                <input class="form-check-input"  type="radio" value="LA" name="teknik_anestesis" {{ ($catatan->teknik_anestesi == "LA") ? 'checked' : '' }}/>
                                                                <label class="form-check-label" for="flexCheckbox30">
                                                                    LA
                                                                </label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="form-check-input" type="radio" value="REGIONAL" name="teknik_anestesis" {{ ($catatan->teknik_anestesi == "REGIONAL") ? 'checked' : '' }}/>
                                                                <label class="form-check-label" for="flexCheckbox30">
                                                                    REGIONAL
                                                                </label>
                                                            </div>
                                                            <div class="col">
                                                                <input class="form-check-input" type="radio" value="GA" name="teknik_anestesis" {{ ($catatan->teknik_anestesi == "GA") ? 'checked' : '' }}/>
                                                                <label class="form-check-label" for="flexCheckbox30">
                                                                    GA
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-5">
                                                    <div class="col-md-6">
                                                        <label for="" class="form-label">Posisi</label>
                                                        <textarea class="form-control" id='posisi' data-kt-autosize="true" name="posisi">{{ $catatan->posisi }}</textarea>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="" class="form-label">Premedikasi</label>
                                                        <textarea class="form-control" id='premedikasi' data-kt-autosize="true" name="premedikasi">{{ $catatan->premedikasi }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row mt-5">
                                                    <div class="col-md-4">
                                                        <label for="" class="form-label">Pemberian</label>
                                                        <select name="pemberian" id="" class="form-select" data-control="select2" data-placeholder="- Pilih -">
                                                            <option></option>
                                                            <option value="SC" {{ ($catatan->pemberian == 'SC') ? 'selected' : '' }}>SC</option>
                                                            <option value="IM" {{ ($catatan->pemberian == 'IM') ? 'selected' : '' }}>IM</option>
                                                            <option value="IM" {{ ($catatan->pemberian == 'IV') ? 'selected' : '' }}>IV</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="" class="form-label">Jam</label>
                                                        <input class="form-control jam" placeholder="Jam" name="jam" value="{{ $catatan->jam }}" />
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="" class="form-label">Efek</label>
                                                        <input type="text" name="efek" id='efek' class="form-control" value="{{ $catatan->efek }}">
                                                    </div>
                                                </div>
                                                <div class="row mt-5">
                                                    <div class="col-md-12">
                                                        <label class="form-label">Obat Anestesi</label>
                                                        <!--begin::Repeater-->
                                                        <div id="obat_anestesi_catatan">
                                                            <!--begin::Form group-->
                                                            <div class="form-group mt-1">
                                                                <a href="javascript:;" data-repeater-create
                                                                    class="btn btn-sm btn-light-primary">
                                                                    <i class="ki-duotone ki-plus fs-3"></i>
                                                                    Tambah Obat Anestesi
                                                                </a>
                                                            </div>
                                                            <!--end::Form group-->
                                                            <!--begin::Form group-->
                                                            <div class="form-group">
                                                                <div data-repeater-list="obat_anestesi_catatan" class="row">
                                                                    <div class="row" id="template_obat_anastesi"></div>
                                                                    @if ($catatan->obat_anestesi)
                                                                    @foreach (json_decode($catatan->obat_anestesi) as $val)
                                                                        <div class="col-md-4" data-repeater-item>
                                                                            <div class="form-group row mb-5">
                                                                                <div class="col-md-10">
                                                                                    <input type="text"
                                                                                        name="obat_anestesi_catatan"
                                                                                        class="form-control mb-2 mb-md-0 mt-5"
                                                                                        placeholder="Masukan Nama Obat" value="{{ $val->obat_anestesi_catatan }}" />
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <a href="javascript:;"
                                                                                        data-repeater-delete
                                                                                        class="btn btn-sm btn-light-danger mt-6">
                                                                                        <i class="ki-duotone ki-trash fs-5">
                                                                                            <span
                                                                                                class="path1"></span><span
                                                                                                class="path2"></span><span
                                                                                                class="path3"></span><span
                                                                                                class="path4"></span><span
                                                                                                class="path5"></span>
                                                                                        </i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @else
                                                                    
                                                                    
                                                                    <div class="col-md-4" data-repeater-item>
                                                                        {{-- <div id="template_obat_anastesi"></div> --}}
                                                                        <div class="form-group row mb-5">
                                                                            <div class="col-md-10">
                                                                                <input type="text"
                                                                                    name="obat_anestesi_catatan"
                                                                                    class="form-control mb-2 mb-md-0 mt-5"
                                                                                    placeholder="Masukan Nama Obat" />
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <a href="javascript:;"
                                                                                    data-repeater-delete
                                                                                    class="btn btn-sm btn-light-danger mt-6">
                                                                                    <i class="ki-duotone ki-trash fs-5">
                                                                                        <span
                                                                                            class="path1"></span><span
                                                                                            class="path2"></span><span
                                                                                            class="path3"></span><span
                                                                                            class="path4"></span><span
                                                                                            class="path5"></span>
                                                                                    </i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                </div>
                                                            </div>
                                                            <!--end::Form group-->
                                                        </div>
                                                        <!--end::Repeater-->
                                                    </div>
                                                </div>

                                                {{-- spo2 --}}
                                                <div class="row mt-3">
                                                    <div class="col-md-12">
                                                        <label class="form-label">SPO2</label>
                                                        <!--begin::Repeater-->
                                                        <div id="spo2">
                                                            <!--begin::Form group-->
                                                            <div class="form-group mt-1">
                                                                <a href="javascript:;" data-repeater-create class="btn btn-sm btn-light-primary">
                                                                    <i class="ki-duotone ki-plus fs-3"></i>
                                                                    Tambah
                                                                </a>
                                                            </div>
                                                            <!--end::Form group-->
                                                            <!--begin::Form group-->
                                                            <div class="form-group">
                                                                <div data-repeater-list="spo2" class="row">
                                                                    @if ($catatan->spo2)
                                                                        @foreach (json_decode($catatan->spo2) as $val)
                                                                        <div class="col-md-4" data-repeater-item>
                                                                            <div class="form-group row mb-5">
                                                                                <div class="col-md-10">
                                                                                    <input type="text" name="spo2" class="form-control mb-2 mb-md-0 mt-5" placeholder="Per 15 Menit" value="{{ $val->spo2 }}" />
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-6">
                                                                                        <i class="ki-duotone ki-trash fs-5">
                                                                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                                                                                        </i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endforeach
                                                                    @else
                                                                        <div class="col-md-4" data-repeater-item>
                                                                            <div class="form-group row mb-5">
                                                                                <div class="col-md-10">
                                                                                    <input type="text" name="spo2" class="form-control mb-2 mb-md-0 mt-5" placeholder="Per 15 Menit" />
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-6">
                                                                                        <i class="ki-duotone ki-trash fs-5">
                                                                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                                                                                        </i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <!--end::Form group-->
                                                        </div>
                                                        <!--end::Repeater-->
                                                    </div>
                                                </div>
                                                {{-- end spo2 --}}
                                                {{-- Nadi --}}
                                                <div class="row mt-3">
                                                    <div class="col-md-12">
                                                        <label class="form-label">Nadi</label>
                                                        <!--begin::Repeater-->
                                                        <div id="nadi">
                                                            <!--begin::Form group-->
                                                            <div class="form-group mt-1">
                                                                <a href="javascript:;" data-repeater-create class="btn btn-sm btn-light-primary">
                                                                    <i class="ki-duotone ki-plus fs-3"></i>
                                                                    Tambah
                                                                </a>
                                                            </div>
                                                            <!--end::Form group-->
                                                            <!--begin::Form group-->
                                                            <div class="form-group">
                                                                <div data-repeater-list="nadi" class="row">
                                                                    @if ($catatan->nadi)
                                                                        @foreach (json_decode($catatan->nadi) as $val)
                                                                        <div class="col-md-4" data-repeater-item>
                                                                            <div class="form-group row mb-5">
                                                                                <div class="col-md-10">
                                                                                    <input type="text" name="nadi" class="form-control mb-2 mb-md-0 mt-5" placeholder="Per 15 Menit" value="{{ $val->nadi }}" />
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-6">
                                                                                        <i class="ki-duotone ki-trash fs-5">
                                                                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                                                                                        </i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endforeach
                                                                    @else
                                                                        <div class="col-md-4" data-repeater-item>
                                                                            <div class="form-group row mb-5">
                                                                                <div class="col-md-10">
                                                                                    <input type="text" name="nadi" class="form-control mb-2 mb-md-0 mt-5" placeholder="Per 15 Menit" />
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-6">
                                                                                        <i class="ki-duotone ki-trash fs-5">
                                                                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                                                                                        </i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <!--end::Form group-->
                                                        </div>
                                                        <!--end::Repeater-->
                                                    </div>
                                                </div>
                                                {{-- end Nadi --}}
                                                {{-- RR --}}
                                                <div class="row mt-3">
                                                    <div class="col-md-12">
                                                        <label class="form-label">RR</label>
                                                        <!--begin::Repeater-->
                                                        <div id="rr">
                                                            <!--begin::Form group-->
                                                            <div class="form-group mt-1">
                                                                <a href="javascript:;" data-repeater-create class="btn btn-sm btn-light-primary">
                                                                    <i class="ki-duotone ki-plus fs-3"></i>
                                                                    Tambah
                                                                </a>
                                                            </div>
                                                            <!--end::Form group-->
                                                            <!--begin::Form group-->
                                                            <div class="form-group">
                                                                <div data-repeater-list="rr" class="row">
                                                                    @if ($catatan->rr)
                                                                        @foreach (json_decode($catatan->rr) as $val)
                                                                        <div class="col-md-4" data-repeater-item>
                                                                            <div class="form-group row mb-5">
                                                                                <div class="col-md-10">
                                                                                    <input type="text" name="rr" class="form-control mb-2 mb-md-0 mt-5" placeholder="Per 15 Menit" value="{{ $val->rr }}" />
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-6">
                                                                                        <i class="ki-duotone ki-trash fs-5">
                                                                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                                                                                        </i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endforeach
                                                                    @else
                                                                        <div class="col-md-4" data-repeater-item>
                                                                            <div class="form-group row mb-5">
                                                                                <div class="col-md-10">
                                                                                    <input type="text" name="rr" class="form-control mb-2 mb-md-0 mt-5" placeholder="Per 15 Menit" />
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-6">
                                                                                        <i class="ki-duotone ki-trash fs-5">
                                                                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                                                                                        </i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <!--end::Form group-->
                                                        </div>
                                                        <!--end::Repeater-->
                                                    </div>
                                                </div>
                                                {{-- End RR --}}
                                                <div class="row mt-3">
                                                    <div class="col-md-12">
                                                        <label class="form-label">O2</label>
                                                        <!--begin::Repeater-->
                                                        <div id="o2">
                                                            <!--begin::Form group-->
                                                            <div class="form-group mt-1">
                                                                <a href="javascript:;" data-repeater-create class="btn btn-sm btn-light-primary">
                                                                    <i class="ki-duotone ki-plus fs-3"></i>
                                                                    Tambah
                                                                </a>
                                                            </div>
                                                            <!--end::Form group-->
                                                            <!--begin::Form group-->
                                                            <div class="form-group">
                                                                <div data-repeater-list="o2" class="row">
                                                                    @if ($catatan->o2)
                                                                        @foreach (json_decode($catatan->o2) as $val)
                                                                        <div class="col-md-4" data-repeater-item>
                                                                            <div class="form-group row mb-5">
                                                                                <div class="col-md-10">
                                                                                    <input type="text" name="o2" class="form-control mb-2 mb-md-0 mt-5" placeholder="Per 5 Menit" value="{{ $val->o2 }}" />
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-6">
                                                                                        <i class="ki-duotone ki-trash fs-5">
                                                                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                                                                                        </i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endforeach
                                                                    @else
                                                                        <div class="col-md-4" data-repeater-item>
                                                                            <div class="form-group row mb-5">
                                                                                <div class="col-md-10">
                                                                                    <input type="text" name="o2" class="form-control mb-2 mb-md-0 mt-5" placeholder="Per 5 Menit" />
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-6">
                                                                                        <i class="ki-duotone ki-trash fs-5">
                                                                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                                                                                        </i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <!--end::Form group-->
                                                        </div>
                                                        <!--end::Repeater-->
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-12">
                                                        <label class="form-label">N2O</label>
                                                        <!--begin::Repeater-->
                                                        <div id="n2o">
                                                            <!--begin::Form group-->
                                                            <div class="form-group mt-1">
                                                                <a href="javascript:;" data-repeater-create class="btn btn-sm btn-light-primary">
                                                                    <i class="ki-duotone ki-plus fs-3"></i>
                                                                    Tambah
                                                                </a>
                                                            </div>
                                                            <!--end::Form group-->
                                                            <!--begin::Form group-->
                                                            <div class="form-group">
                                                                <div data-repeater-list="n2o" class="row">
                                                                    @if ($catatan->n2o)
                                                                        @foreach (json_decode($catatan->n2o) as $val)
                                                                        <div class="col-md-4" data-repeater-item>
                                                                            <div class="form-group row mb-5">
                                                                                <div class="col-md-10">
                                                                                    <input type="text" name="n2o" class="form-control mb-2 mb-md-0 mt-5" placeholder="Per 5 Menit" value="{{ $val->n2o }}" />
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-6">
                                                                                        <i class="ki-duotone ki-trash fs-5">
                                                                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                                                                                        </i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endforeach
                                                                    @else
                                                                        <div class="col-md-4" data-repeater-item>
                                                                            <div class="form-group row mb-5">
                                                                                <div class="col-md-10">
                                                                                    <input type="text" name="n2o" class="form-control mb-2 mb-md-0 mt-5" placeholder="Per 5 Menit" />
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-6">
                                                                                        <i class="ki-duotone ki-trash fs-5">
                                                                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                                                                                        </i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <!--end::Form group-->
                                                        </div>
                                                        <!--end::Repeater-->
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-12">
                                                        <label class="form-label">Isoflurane</label>
                                                        <!--begin::Repeater-->
                                                        <div id="isoflurane">
                                                            <!--begin::Form group-->
                                                            <div class="form-group mt-1">
                                                                <a href="javascript:;" data-repeater-create class="btn btn-sm btn-light-primary">
                                                                    <i class="ki-duotone ki-plus fs-3"></i>
                                                                    Tambah
                                                                </a>
                                                            </div>
                                                            <!--end::Form group-->
                                                            <!--begin::Form group-->
                                                            <div class="form-group">
                                                                <div data-repeater-list="isoflurane" class="row">
                                                                    @if ($catatan->isoflurane)
                                                                        @foreach (json_decode($catatan->isoflurane) as $val)
                                                                        <div class="col-md-4" data-repeater-item>
                                                                            <div class="form-group row mb-5">
                                                                                <div class="col-md-10">
                                                                                    <input type="text" name="isoflurane" class="form-control mb-2 mb-md-0 mt-5" placeholder="Per 5 Menit" value="{{ $val->isoflurane }}" />
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-6">
                                                                                        <i class="ki-duotone ki-trash fs-5">
                                                                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                                                                                        </i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endforeach
                                                                    @else
                                                                        <div class="col-md-4" data-repeater-item>
                                                                            <div class="form-group row mb-5">
                                                                                <div class="col-md-10">
                                                                                    <input type="text" name="isoflurane" class="form-control mb-2 mb-md-0 mt-5" placeholder="Per 5 Menit" />
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-6">
                                                                                        <i class="ki-duotone ki-trash fs-5">
                                                                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                                                                                        </i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <!--end::Form group-->
                                                        </div>
                                                        <!--end::Repeater-->
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-12">
                                                        <label class="form-label">Sevoflurane</label>
                                                        <!--begin::Repeater-->
                                                        <div id="sevoflurane">
                                                            <!--begin::Form group-->
                                                            <div class="form-group mt-1">
                                                                <a href="javascript:;" data-repeater-create class="btn btn-sm btn-light-primary">
                                                                    <i class="ki-duotone ki-plus fs-3"></i>
                                                                    Tambah
                                                                </a>
                                                            </div>
                                                            <!--end::Form group-->
                                                            <!--begin::Form group-->
                                                            <div class="form-group">
                                                                <div data-repeater-list="sevoflurane" class="row">
                                                                    @if ($catatan->sevoflurane)
                                                                        @foreach (json_decode($catatan->sevoflurane) as $val)
                                                                        <div class="col-md-4" data-repeater-item>
                                                                            <div class="form-group row mb-5">
                                                                                <div class="col-md-10">
                                                                                    <input type="text" name="sevoflurane" class="form-control mb-2 mb-md-0 mt-5" placeholder="Per 5 Menit" value="{{ $val->sevoflurane }}" />
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-6">
                                                                                        <i class="ki-duotone ki-trash fs-5">
                                                                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                                                                                        </i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endforeach
                                                                    @else
                                                                        <div class="col-md-4" data-repeater-item>
                                                                            <div class="form-group row mb-5">
                                                                                <div class="col-md-10">
                                                                                    <input type="text" name="sevoflurane" class="form-control mb-2 mb-md-0 mt-5" placeholder="Per 5 Menit" />
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-6">
                                                                                        <i class="ki-duotone ki-trash fs-5">
                                                                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                                                                                        </i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <!--end::Form group-->
                                                        </div>
                                                        <!--end::Repeater-->
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-12">
                                                        <label class="form-label">Infus</label>
                                                        <!--begin::Repeater-->
                                                        <div id="infus">
                                                            <!--begin::Form group-->
                                                            <div class="form-group mt-1">
                                                                <a href="javascript:;" data-repeater-create class="btn btn-sm btn-light-primary">
                                                                    <i class="ki-duotone ki-plus fs-3"></i>
                                                                    Tambah
                                                                </a>
                                                            </div>
                                                            <!--end::Form group-->
                                                            <!--begin::Form group-->
                                                            <div class="form-group">
                                                                <div data-repeater-list="infus" class="row">
                                                                    @if ($catatan->infus)
                                                                        @foreach (json_decode($catatan->infus) as $val)
                                                                        <div class="col-md-4" data-repeater-item>
                                                                            <div class="form-group row mb-5">
                                                                                <div class="col-md-10">
                                                                                    <input type="text" name="infus" class="form-control mb-2 mb-md-0 mt-5" placeholder="Per 5 Menit" value="{{ $val->infus }}" />
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-6">
                                                                                        <i class="ki-duotone ki-trash fs-5">
                                                                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                                                                                        </i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endforeach
                                                                    @else
                                                                        <div class="col-md-4" data-repeater-item>
                                                                            <div class="form-group row mb-5">
                                                                                <div class="col-md-10">
                                                                                    <input type="text" name="infus" class="form-control mb-2 mb-md-0 mt-5" placeholder="Per 5 Menit" />
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-6">
                                                                                        <i class="ki-duotone ki-trash fs-5">
                                                                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                                                                                        </i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <!--end::Form group-->
                                                        </div>
                                                        <!--end::Repeater-->
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-12">
                                                        <label class="form-label">Medikasi</label>
                                                        <!--begin::Repeater-->
                                                        <div id="medikasi">
                                                            <!--begin::Form group-->
                                                            <div class="form-group mt-1">
                                                                <a href="javascript:;" data-repeater-create class="btn btn-sm btn-light-primary">
                                                                    <i class="ki-duotone ki-plus fs-3"></i>
                                                                    Tambah
                                                                </a>
                                                            </div>
                                                            <!--end::Form group-->
                                                            <!--begin::Form group-->
                                                            <div class="form-group">
                                                                <div data-repeater-list="medikasi" class="row">
                                                                    @if ($catatan->medikasi)
                                                                        @foreach (json_decode($catatan->medikasi) as $val)
                                                                        <div class="col-md-4" data-repeater-item>
                                                                            <div class="form-group row mb-5">
                                                                                <div class="col-md-10">
                                                                                    <input type="text" name="medikasi" class="form-control mb-2 mb-md-0 mt-5" placeholder="Per 5 Menit" value="{{ $val->medikasi }}" />
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-6">
                                                                                        <i class="ki-duotone ki-trash fs-5">
                                                                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                                                                                        </i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endforeach
                                                                    @else
                                                                        <div class="col-md-4" data-repeater-item>
                                                                            <div class="form-group row mb-5">
                                                                                <div class="col-md-10">
                                                                                    <input type="text" name="medikasi" class="form-control mb-2 mb-md-0 mt-5" placeholder="Per 5 Menit" />
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-6">
                                                                                        <i class="ki-duotone ki-trash fs-5">
                                                                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                                                                                        </i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <!--end::Form group-->
                                                        </div>
                                                        <!--end::Repeater-->
                                                    </div>
                                                </div>
                                                <div class="row mt-5">
                                                    <label for="" class="form-label"><b>Stadia</b></label>
                                                    <div class="col-md-4">
                                                        <label for="" class="form-label">Anestesi</label>
                                                        <textarea class="form-control" id='stadia_anestesi' data-kt-autosize="true" name="anestesi">{{ json_decode($catatan?->stadia)->anestesi ?? '' }}</textarea>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="" class="form-label">Operasi</label>
                                                        <textarea class="form-control"  id='stadia_operasi' data-kt-autosize="true" name="operasi">{{ json_decode($catatan?->stadia)->operasi ?? '' }}</textarea>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="" class="form-label">Respirasi</label>
                                                        <textarea class="form-control"  id='stadia_respirasi' data-kt-autosize="true" name="respirasi">{{ json_decode($catatan?->stadia)->respirasi ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row mt-5">
                                                    <div class="col-md-6">
                                                        <label for="" class="form-label">Jumlah Medikasi</label>
                                                        <input type="text" name="jumlah_medikasi" value="{{ $catatan->jumlah_medikasi }}" class="form-control">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="" class="form-label">Jumlah Cairan</label>
                                                        <input type="text" name="jumlah_cairan" value="{{ $catatan->jumlah_cairan }}" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row mt-5">
                                                    <div class="col-md-12">
                                                        <label for="" class="form-label">Catatan</label>
                                                        <textarea class="form-control"  id='catatan_anestesi' data-kt-autosize="true" name="catatan">{{ $catatan->catatan }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row mt-5">
                                                    <div class="col-md-4">
                                                        <label for="" class="form-label">Pendarahan</label>
                                                        <input type="text" name="pendarahan" value="{{ $catatan->pendarahan }}" class="form-control">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="" class="form-label">Urine</label>
                                                        <input type="text" name="urine" value="{{ $catatan->urine }}" class="form-control">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="" class="form-label">Lama Anestesi</label>
                                                        <input type="text" name="lama_anestesi" value="{{ $catatan->lama_anestesi }}" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row mt-5">
                                                    <div class="col-md-6">
                                                        <label for="" class="form-label">Komplikasi Pra Anestesi</label>
                                                        <textarea class="form-control" id='pra_anestesi' data-kt-autosize="true" name="pra_anestesi">{{ $catatan->pra_anestesi }}</textarea>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="" class="form-label">Komplikasi Post Anestesi</label>
                                                        <textarea class="form-control"  id='post_anestesi' data-kt-autosize="true" name="post_anestesi">{{ $catatan->post_anestesi }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row mt-5">
                                                    <div class="col-md-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="check_template_anastesi" />
                                                            <label class="form-check-label" for="flexCheckDefault">
                                                                <b>Simpan Ke Template</b>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-5 d-none" id="tampil_template_anastesi">
                                                    <div class="col-md-6">
                                                        <label for="" class="form-label required">Nama Template</label>
                                                        <input type="text" name="nama_template" id="nama_template_anastesi" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row mt-5">
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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

    <div class="modal fade" tabindex="-1" id="modal_status">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Ubah Status</h3>
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <form id="frm-status" action="{{ route('update-status.operasi', $data->id) }}" method="POST"
                        autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <label for="" class="form-label required">Status</label>
                                <select name="status" class="form-select" data-control="select2"
                                    data-placeholder="Pilih Status">
                                    <option></option>
                                    <option value="antrian" {{ $data->status == 'antrian' ? 'selected' : '' }}>Antrian
                                    </option>
                                    <option value="operasi" {{ $data->status == 'operasi' ? 'selected' : '' }}>Operasi
                                    </option>
                                    <option value="batal" {{ $data->status == 'batal' ? 'selected' : '' }}>Batal
                                    </option>
                                    <option value="selesai" {{ $data->status == 'selesai' ? 'selected' : '' }}>Selesai
                                    </option>
                                </select>
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

    <!-- Modal -->
    <div class="modal fade" id="modal-template-anastesi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Template</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="form-label">Template Anastesi</label>
                        <select name="template_lain_anastesi" id="template_lain_anastesi" data-control="select2" data-placeholder="-Pilih-" class="form-select">
                            <option></option>
                            @foreach ($template_anastesi as $val)
                                <option value="{{ $val->id }}">{{ $val->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="btn-terapkan-anastesi" type="button" class="btn btn-primary">Terapkan</button>
            </div>
        </div>
        </div>
    </div>
    <div class="modal fade" id="modal-template" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Template</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="form-label">Template Operasi</label>
                        <select name="template_lain" id="template_lain" data-control="select2" data-placeholder="-Pilih-" class="form-select">
                            <option></option>
                            @foreach ($template as $val)
                                <option value="{{ $val->id }}">{{ $val->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="btn-terapkan" type="button" class="btn btn-primary">Terapkan</button>
            </div>
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
            $("#frm-data").on("submit", function(event) {
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

            $("#frmTambahTindakan").on("submit", function(event) {
                event.preventDefault();
                var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
                Swal.fire({
                    title: 'Simpan Data',
                    text: "Apakah Anda yakin akan menyimpan tindakan ini ?",
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

            $("#frm-status").on("submit", function(event) {
                event.preventDefault();
                var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
                Swal.fire({
                    title: 'Simpan Data',
                    text: "Apakah Anda yakin akan menyimpan status ini ?",
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

            $("#tgl_operasi").flatpickr({
                altInput: true,
                altFormat: "d-m-Y",
                dateFormat: "Y-m-d"
            });

            $("#mulai_jam").flatpickr({
                noCalendar: true,
                enableTime: true,
                time_24hr: true
            });

            $("#selesai_jam").flatpickr({
                noCalendar: true,
                enableTime: true,
                time_24hr: true
            });

            $('#dokter_bedah').repeater({
                initEmpty: false,

                show: function() {
                    $(this).slideDown();
                },

                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });

            $('#perawat_bedah').repeater({
                initEmpty: false,

                show: function() {
                    $(this).slideDown();
                },

                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });

            $('#asisten').repeater({
                initEmpty: false,

                show: function() {
                    $(this).slideDown();
                },

                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });

            $('#tarif_ok').repeater({
                initEmpty: false,

                show: function() {
                    $(this).slideDown();
                    $(this).find('[data-kt-repeater="dokter_tindakan_select"]').select2({
                        dropdownParent: $('#kt_modal_1'),
                    });
                    $(this).find('[data-kt-repeater="tarif_ok_select"]').select2({
                        dropdownParent: $('#kt_modal_1'),
                        ajax: {
                            url: 'https://live.simrs.rsaudrsiswanto.co.id/dashboard/rest/tarif-ok-erm',
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
                        placeholder: 'Pilih Tindakan Bedah'
                    });

                },

                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                },

                ready: function() {
                    $('[data-kt-repeater="dokter_tindakan_select"]').select2({
                        dropdownParent: $('#kt_modal_1'),
                    });
                    $('[data-kt-repeater="tarif_ok_select"]').select2({
                        dropdownParent: $('#kt_modal_1'),
                        ajax: {
                            url: 'https://live.simrs.rsaudrsiswanto.co.id/dashboard/rest/tarif-ok-erm',
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
                        placeholder: 'Pilih Tindakan Bedah'
                    });

                }
            });

            $('#tindakan_bedah').repeater({
                initEmpty: false,

                show: function() {
                    $(this).slideDown();

                    $(this).find('[data-kt-repeater="tindakan_bedah_select"]').select2({
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
                        placeholder: 'Pilih Tindakan Bedah'
                    });
                },

                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                },

                ready: function() {

                    $('[data-kt-repeater="tindakan_bedah_select"]').select2({
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
                        placeholder: 'Pilih Tindakan Bedah'
                    });
                }
            });

            $('#ahli_anastesi').repeater({
                initEmpty: false,

                show: function() {
                    $(this).slideDown();
                },

                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });

            $('#obat_anastesi').repeater({
                initEmpty: false,

                show: function() {
                    $(this).slideDown();
                },

                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });

            $('#penata_anastesi').repeater({
                initEmpty: false,

                show: function() {
                    $(this).slideDown();
                },

                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });

            var jaringan = '{{ $data->jaringan ? json_decode($data?->jaringan)->jaringan_kultur : '' }}';

            if (jaringan == 1) {
                $('#frm-jaringan').show('Fadeout');
            } else {
                $('#frm-jaringan').hide('Fadein');
            }
        });


        $("#selesai_jam").on("change", function() {
            // Get the input values
            var startTime = document.getElementById('mulai_jam').value;
            var endTime = document.getElementById('selesai_jam').value;

            // Parse the input values to create Date objects
            var startDateTime = new Date('2023-01-01 ' + startTime); // Use a common date for parsing time
            var endDateTime = new Date('2023-01-01 ' + endTime); // Use a common date for parsing time

            // Calculate the time difference in milliseconds
            var timeDiff = endDateTime - startDateTime;

            // Convert the time difference to hours and minutes
            var hours = Math.floor(timeDiff / (1000 * 60 * 60));
            var minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));

            // Display the result
            $('#lama_operasi').val(hours + ' Jam ' + minutes + ' menit');
        });

        $('input[type=radio][name=jaringan_kultur]').change(function() {
            if (this.value == 1) {
                $('#frm-jaringan').show('Fadeout');
            } else {
                $('#frm-jaringan').hide('Fadein');
            }
        });

        $(".jam").flatpickr({
            noCalendar: true,
            enableTime: true,
            time_24hr: true
        });

        $(".tgl").flatpickr({
            altInput: true,
            altFormat: "d-m-Y",
            dateFormat: "Y-m-d"
        });

        $('#obat_anestesi_catatan').repeater({
            initEmpty: false,

            show: function() {
                $(this).slideDown();
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });

        $('#spo2').repeater({
            initEmpty: false,

            show: function() {
                $(this).slideDown();
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
        $('#nadi').repeater({
            initEmpty: false,

            show: function() {
                $(this).slideDown();
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
        $('#rr').repeater({
            initEmpty: false,

            show: function() {
                $(this).slideDown();
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
        $('#o2').repeater({
            initEmpty: false,

            show: function() {
                $(this).slideDown();
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });

        $('#n2o').repeater({
            initEmpty: false,

            show: function() {
                $(this).slideDown();
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });

        $('#isoflurane').repeater({
            initEmpty: false,

            show: function() {
                $(this).slideDown();
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });

        $('#sevoflurane').repeater({
            initEmpty: false,

            show: function() {
                $(this).slideDown();
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });

        $('#infus').repeater({
            initEmpty: false,

            show: function() {
                $(this).slideDown();
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });

        $('#medikasi').repeater({
            initEmpty: false,

            show: function() {
                $(this).slideDown();
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });

        function showTemplate(id){
            $.ajax({
                type: 'GET',
                url: '{{ route('show.template') }}',
                data: { template_id : id},
                beforeSend: function() {
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
                },
                success: function(data) {
                    $('#template_dokter_bedah').html(data.dokter_bedah);
                    $('#template_perawat_bedah').html(data.perawat_bedah);
                    $('#template_asisten').html(data.asisten);

                    $('#desinfektan_kulit').val(data.template.desinfektan_kulit);
                    $('#kamar_operasi').val(data.template.kamar_operasi);

                    $("#jenis_operasi").val(data.template.jenis_operasi).change();
                    $("#detail_operasi").val(data.template.detail_operasi).change();

                    $('#diagnosis_pasca_bedah').val(data.template.diagnosis_pasca_bedah);

                    $('#template_tindakan_bedah').html(data.tindakan_bedah);
                    // console.log(data.tindakan_bedah)

                    $("#jenis_anestesi").val(data.template.jenis_anestesi).change();

                    $('#indikasi_operasi').val(data.template.indikasi_operasi);
                    $('#implant').val(data.template.implant);

                    $('#uraian_pembedahan').val(data.template.uraian_pembedahan);
                    $('#instruksi_post_operasi').val(data.template.post_operasi);

                    $.unblockUI();
                },
                error: function(data) {
                    console.log('error');
                },
            });
        }
        function showTemplateAnastesi(id){
            $.ajax({
                type: 'GET',
                url: '{{ route('show.template-anastesi') }}',
                data: { template_id : id},
                beforeSend: function() {
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
                },
                success: function(data) {
                    $('#template_obat_anastesi').html(data.obat_anastesi);
                    $('#posisi').val(data.template.posisi);
                    $('#premedikasi').val(data.template.premedikasi);
                    var stadia = JSON.parse(data.template.stadia);
                    $('#stadia_anestesi').val(stadia.anestesi);
                    $('#stadia_operasi').val(stadia.operasi);
                    $('#stadia_respirasi').val(stadia.respirasi);
                    $('#pra_anestesi').val(data.template.pra_anestesi);
                    $('#catatan_anestesi').val(data.template.catatan);
                    $('#post_anestesi').val(data.template.post_anestesi);

                    console.log(data);
                    $.unblockUI();
                },
                error: function(data) {
                    console.log('error');
                },
            });
        }

        $("#btn-terapkan").on( "click", function(e) {

            var id = $('#template_lain').val();
            if(id === ""){
                Swal.fire('Template Tidak Boleh Kosong','','warning');
                return false;
            }

            $.ajax({
                type: 'GET',
                url: '{{ route('show.template') }}',
                data: { template_id : id},
                beforeSend: function() {
                    $('#modal-template').modal('hide');
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
                },
                success: function(data) {
                    $('#template_dokter_bedah').html(data.dokter_bedah);
                    $('#template_perawat_bedah').html(data.perawat_bedah);
                    $('#template_asisten').html(data.asisten);

                    $('#desinfektan_kulit').val(data.template.desinfektan_kulit);
                    $('#kamar_operasi').val(data.template.kamar_operasi);

                    $("#jenis_operasi").val(data.template.jenis_operasi).change();
                    $("#detail_operasi").val(data.template.detail_operasi).change();

                    $('#diagnosis_pasca_bedah').val(data.template.diagnosis_pasca_bedah);

                    $('#template_tindakan_bedah').html(data.tindakan_bedah);
                    // console.log(data.tindakan_bedah)

                    $("#jenis_anestesi").val(data.template.jenis_anestesi).change();

                    $('#indikasi_operasi').val(data.template.indikasi_operasi);
                    $('#implant').val(data.template.implant);

                    $('#uraian_pembedahan').val(data.template.uraian_pembedahan);
                    $('#instruksi_post_operasi').val(data.template.post_operasi);

                    $.unblockUI();
                },
                error: function(data) {
                    console.log('error');
                },
            });

        });
        $("#btn-terapkan-anastesi").on( "click", function(e) {

            var id = $('#template_lain_anastesi').val();
            if(id === ""){
                Swal.fire('Template Tidak Boleh Kosong','','warning');
                return false;
            }

            $.ajax({
                type: 'GET',
                url: '{{ route('show.template-anastesi') }}',
                data: { template_id : id},
                beforeSend: function() {
                    $('#modal-template-anastesi').modal('hide');
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
                },
                success: function(data) {
                  
                    $.unblockUI();
                },
                error: function(data) {
                    console.log('error');
                },
            });

        });

        $('#check_template').change(function() {
            if(this.checked) {
                $('#tampil_template').removeClass('d-none');
                $("#nama_template").prop('required',true);
                return false;
            }
            $('#tampil_template').addClass('d-none');
            $("#nama_template").prop('required',false);
        });
        $('#check_template_anastesi').change(function() {
            if(this.checked) {
                $('#tampil_template_anastesi').removeClass('d-none');
                $("#nama_template_anastesi").prop('required',true);
                return false;
            }
            $('#tampil_template_anastesi').addClass('d-none');
            $("#nama_template_anastesi").prop('required',false);
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
