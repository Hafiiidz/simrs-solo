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
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Template</h1>
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
                        <li class="breadcrumb-item text-muted">Ubah Template Operasi</li>
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
                        <h5 class="card-title">Ubah Template Operasi</h5>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ route('index.template') }}" class="btn btn-sm btn-secondary">Kembali</a>
                    </div>
                </div>
                <!--begin::Body-->
                <div class="card-body p-lg-15">
                    <form action="{{ route('update.template', $data->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="form-label">Nama Template</label>
                                <input type="text" name="nama" id="" class="form-control" value="{{ $data->nama }}" required>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-4">
                                <label for="" class="form-label">Dokter Bedah</label>
                                <!--begin::Repeater-->
                                <div id="dokter_bedah">
                                    <!--begin::Form group-->
                                    <div class="form-group">
                                        <div data-repeater-list="dokter_bedah">
                                            <!--begin::Form group-->
                                            <div class="form-group mt-0">
                                                <a href="javascript:;" data-repeater-create
                                                    class="btn btn-sm btn-light-primary">
                                                    <i class="ki-duotone ki-plus fs-3"></i>
                                                    Tambah Dokter
                                                </a>
                                            </div>
                                            <!--end::Form group-->
                                            @if ($data->dokter_bedah != 'null')
                                                @foreach (json_decode($data->dokter_bedah) as $val)
                                                    <div data-repeater-item class="mt-3">
                                                        <div class="form-group row mb-5">
                                                            <div class="col-md-10">
                                                            <select name="dokter_bedah" class="form-select" data-kt-repeater="dokter_select" data-placeholder="-Pilih-">
                                                                <option value="{{ $val->dokter_bedah }}">{{ $val->dokter_bedah }}</option>
                                                            </select>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <a href="javascript:;"
                                                                    data-repeater-delete
                                                                    class="btn btn-sm btn-light-danger mt-1">
                                                                    <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div data-repeater-item class="mt-3">
                                                    <div class="form-group row mb-5">
                                                        <div class="col-md-10">
                                                        <select name="dokter_bedah" class="form-select" data-kt-repeater="dokter_select" data-placeholder="-Pilih-">
                                                        </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <a href="javascript:;"
                                                                data-repeater-delete
                                                                class="btn btn-sm btn-light-danger mt-1">
                                                                <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
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
                            <div class="col-md-4">
                                <label for="" class="form-label">Perawat Bedah</label>
                                <!--begin::Repeater-->
                                <div id="perawat_bedah">
                                    <!--begin::Form group-->
                                    <div class="form-group">
                                        <div data-repeater-list="perawat_bedah">
                                            <!--begin::Form group-->
                                            <div class="form-group mt-0">
                                                <a href="javascript:;" data-repeater-create
                                                    class="btn btn-sm btn-light-primary">
                                                    <i class="ki-duotone ki-plus fs-3"></i>
                                                    Tambah Perawat
                                                </a>
                                            </div>
                                            <!--end::Form group-->
                                            @if ($data->perawat_bedah != 'null')
                                                @foreach (json_decode($data->perawat_bedah) as $val)
                                                <div data-repeater-item class="mt-3">
                                                    <div class="form-group row mb-5">
                                                        <div class="col-md-10">
                                                        <select name="perawat_bedah" class="form-select" data-kt-repeater="perawat_select" data-placeholder="-Pilih-">
                                                            <option value="{{ $val->perawat_bedah }}">{{ $val->perawat_bedah }}</option>
                                                        </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <a href="javascript:;"
                                                                data-repeater-delete
                                                                class="btn btn-sm btn-light-danger mt-1">
                                                                <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            @else
                                                <div data-repeater-item class="mt-3">
                                                    <div class="form-group row mb-5">
                                                        <div class="col-md-10">
                                                        <select name="perawat_bedah" class="form-select" data-kt-repeater="perawat_select" data-placeholder="-Pilih-">
                                                        </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <a href="javascript:;"
                                                                data-repeater-delete
                                                                class="btn btn-sm btn-light-danger mt-1">
                                                                <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
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
                            <div class="col-md-4">
                                <label for="" class="form-label">Asisten</label>
                                <!--begin::Repeater-->
                                <div id="asisten">
                                    <!--begin::Form group-->
                                    <div class="form-group">
                                        <div data-repeater-list="asisten">
                                            <!--begin::Form group-->
                                            <div class="form-group mt-0">
                                                <a href="javascript:;" data-repeater-create
                                                    class="btn btn-sm btn-light-primary">
                                                    <i class="ki-duotone ki-plus fs-3"></i>
                                                    Tambah Asisten
                                                </a>
                                            </div>
                                            <!--end::Form group-->
                                            @if ($data->asisten != 'null')
                                                @foreach (json_decode($data->asisten) as $val)
                                                <div data-repeater-item class="mt-3">
                                                    <div class="form-group row mb-5">
                                                        <div class="col-md-10">
                                                        <select name="asisten" class="form-select" data-kt-repeater="asisten_select" data-placeholder="-Pilih-">
                                                            <option value="{{ $val->asisten }}">{{ $val->asisten }}</option>
                                                        </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <a href="javascript:;"
                                                                data-repeater-delete
                                                                class="btn btn-sm btn-light-danger mt-1">
                                                                <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            @else
                                                <div data-repeater-item class="mt-3">
                                                    <div class="form-group row mb-5">
                                                        <div class="col-md-10">
                                                        <select name="asisten" class="form-select" data-kt-repeater="asisten_select" data-placeholder="-Pilih-">
                                                        </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <a href="javascript:;"
                                                                data-repeater-delete
                                                                class="btn btn-sm btn-light-danger mt-1">
                                                                <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
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
                            <div class="col-md-6">
                                <label for="" class="form-label">Desinfektan Kulit</label>
                                <select name="desinfektan_kulit" id="" class="form-select" data-control="select2" data-placeholder="-Pilih-">
                                    <option></option>
                                    <option value="Povidone Iodine 10%" {{ ($data->desinfektan_kulit == "Povidone Iodine 10%") ? 'selected' : '' }}>Povidone Iodine 10%</option>
                                    <option value="Alkohol 70 %" {{ ($data->desinfektan_kulit == "Alkohol 70 %") ? 'selected' : '' }}>Alkohol 70 %</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Kamar Operasi</label>
                                <select name="kamar_operasi" id="" class="form-select" data-control="select2" data-placeholder="-Pilih-">
                                    <option></option>
                                    <option value="Kamar 1" {{ ($data->kamar_operasi == "Kamar 1") ? 'selected' : '' }}>Kamar 1</option>
                                    <option value="Kamar 2" {{ ($data->kamar_operasi == "Kamar 2") ? 'selected' : '' }}>Kamar 2</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <label for="" class="form-label">Jenis Operasi</label>
                            <div class="col-md-6">
                                <select name="jenis_operasi" id="" class="form-select" data-control="select2" data-placeholder="-Pilih-">
                                    <option></option>
                                    <option value="Kecil" {{ ($data->jenis_operasi == "Kecil") ? 'selected' : '' }}>Kecil</option>
                                    <option value="Sedang" {{ ($data->jenis_operasi == "Sedang") ? 'selected' : '' }}>Sedang</option>
                                    <option value="Besar" {{ ($data->jenis_operasi == "Besar") ? 'selected' : '' }}>Besar</option>
                                    <option value="Khusus" {{ ($data->jenis_operasi == "Khusus") ? 'selected' : '' }}>Khusus</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select name="detail_operasi" id="" class="form-select" data-control="select2" data-placeholder="-Pilih-">
                                    <option></option>
                                    <option value="Bersih" {{ ($data->detail_operasi == "Bersih") ? 'selected' : '' }}>Bersih</option>
                                    <option value="Bersih Terkontaminasi" {{ ($data->detail_operasi == "Bersih Terkontaminasi") ? 'selected' : '' }}>Bersih Terkontaminasi</option>
                                    <option value="Terkontaminasi" {{ ($data->detail_operasi == "Terkontaminasi") ? 'selected' : '' }}>Terkontaminasi</option>
                                    <option value="Kotor / Terinfeksi" {{ ($data->detail_operasi == "Kotor / Terinfeksi") ? 'selected' : '' }}>Kotor / Terinfeksi</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-12">
                                <label for="" class="form-label">Diagnosis Pasca Bedah</label>
                                <textarea class="form-control" data-kt-autosize="true" name="diagnosis_pasca_bedah">{{ $data->diagnosis_pasca_bedah }}</textarea>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label">Tindakan Bedah</label>
                                    <!--begin::Repeater-->
                                    <div id="tindakan_bedah" class="mt-1">
                                        <!--begin::Form group-->
                                        <div class="form-group">
                                            <a href="javascript:;" data-repeater-create class="btn btn-sm btn-light-primary"><i class="ki-duotone ki-plus fs-3"></i>
                                                Tambah Tindakan Bedah
                                            </a>
                                        </div>
                                        <!--end::Form group-->
                                        <!--begin::Form group-->
                                        <div class="form-group">
                                            <div data-repeater-list="tindakan_bedah" class="row mt-2">
                                                @if ($data->tindakan_bedah)
                                                    @foreach (json_decode($data->tindakan_bedah) as $val)
                                                    <div class="col-md-4" data-repeater-item>
                                                        <div class="form-group row mb-5">
                                                            <div class="col-md-10">
                                                                <select name="tindakan_bedah" class="form-select" data-kt-repeater="tindakan_bedah_select" data-placeholder="Pilih Tindakan Bedah" required>
                                                                    <option value="{{ $val->tindakan_bedah }}" selected>
                                                                        {{ $val->tindakan_bedah }}
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-2 mt-1">
                                                                <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger">
                                                                    <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                @else
                                                    <div class="col-md-4" data-repeater-item>
                                                        <div class="form-group row mb-5">
                                                            <div class="col-md-10">
                                                                <select name="tindakan_bedah" class="form-select" data-kt-repeater="tindakan_bedah_select" data-placeholder="Pilih Tindakan Bedah" required></select>
                                                            </div>
                                                            <div class="col-md-2 mt-1">
                                                                <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger">
                                                                    <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
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
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-4">
                                <label for="" class="form-label">Jenis Anestesi</label>
                                <select name="jenis_anestesi" id="" class="form-select" data-control="select2" data-placeholder="-Pilih">
                                    <option></option>
                                    <option value="Umum" {{ ($data->jenis_anestesi == "Umum") ? 'selected' : '' }}>Umum</option>
                                    <option value="Spinal" {{ ($data->jenis_anestesi == "Spinal") ? 'selected' : '' }}>Spinal</option>
                                    <option value="Lokal" {{ ($data->jenis_anestesi == "Lokal") ? 'selected' : '' }}>Lokal</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="" class="form-label">Indikasi Operasi</label>
                                <textarea class="form-control" data-kt-autosize="true" name="indikasi_operasi">{{ $data->indikasi_operasi }}</textarea>
                            </div>
                            <div class="col-md-4">
                                <label for="" class="form-label">Implant</label>
                                <textarea class="form-control" data-kt-autosize="true" name="implant">{{ $data->implant }}</textarea>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-6">
                                <label for="" class="form-label">Uraian Pembedahan</label>
                                <textarea class="form-control" data-kt-autosize="true" name="uraian_pembedahan">{{ $data->uraian_pembedahan }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">Instruksi Post Operasi</label>
                                <textarea class="form-control" data-kt-autosize="true" name="post_operasi">{{ $data->post_operasi }}</textarea>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Ubah</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!--end::Body-->
            </div>
            <!--end::FAQ card-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>

@endsection
@section('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js"></script>
<script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
<script>
    $(function(){

        $('#tindakan_bedah').repeater({
            initEmpty: false,

            show: function() {
                $(this).slideDown();

                $(this).find('[data-kt-repeater="tindakan_bedah_select"]').select2({
                    ajax: {
                        url: 'https://local-simrs.rsausulaiman.com/auth/listprosedur2',
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
                        url: 'https://local-simrs.rsausulaiman.com/auth/listprosedur2',
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

        $('#dokter_bedah').repeater({
            initEmpty: false,

            show: function () {
                $(this).slideDown();

                $(this).find('[data-kt-repeater="dokter_select"]').select2({
                    ajax: {
                        type: 'GET',
                        url: '{{ route('get-dokter.ajax') }}',
                        processResults: function(data) {
                            return {
                                results: data
                            };
                        }
                    }
                });
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            },

            ready: function(){
                $('[data-kt-repeater="dokter_select"]').select2({
                    ajax: {
                        type: 'GET',
                        url: '{{ route('get-dokter.ajax') }}',
                        processResults: function(data) {
                            return {
                                results: data
                            };
                        }
                    }
                });
            }

        });

        $('#perawat_bedah').repeater({
            initEmpty: false,

            show: function () {
                $(this).slideDown();

                $(this).find('[data-kt-repeater="perawat_select"]').select2({
                    ajax: {
                        type: 'GET',
                        url: '{{ route('get-perawat.ajax') }}',
                        processResults: function(data) {
                            return {
                                results: data
                            };
                        }
                    }
                });
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            },

            ready: function(){
                $('[data-kt-repeater="perawat_select"]').select2({
                    ajax: {
                        type: 'GET',
                        url: '{{ route('get-perawat.ajax') }}',
                        processResults: function(data) {
                            return {
                                results: data
                            };
                        }
                    }
                });
            }

        });

        $('#asisten').repeater({
            initEmpty: false,

            show: function () {
                $(this).slideDown();

                $(this).find('[data-kt-repeater="asisten_select"]').select2({
                    ajax: {
                        type: 'GET',
                        url: '{{ route('get-perawat.ajax') }}',
                        processResults: function(data) {
                            return {
                                results: data
                            };
                        }
                    }
                });
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            },

            ready: function(){
                $('[data-kt-repeater="asisten_select"]').select2({
                    ajax: {
                        type: 'GET',
                        url: '{{ route('get-perawat.ajax') }}',
                        processResults: function(data) {
                            return {
                                results: data
                            };
                        }
                    }
                });
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
