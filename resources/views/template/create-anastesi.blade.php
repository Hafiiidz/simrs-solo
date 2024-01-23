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
                            Template</h1>
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
                            <li class="breadcrumb-item text-muted">Tambah Template Operasi</li>
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
                            <h5 class="card-title">Tambah Template Catatan Anastesi</h5>
                        </div>
                        <div class="card-toolbar">
                            <a href="{{ route('index.template-anastesi') }}" class="btn btn-sm btn-secondary">Kembali</a>
                        </div>
                    </div>
                    <!--begin::Body-->
                    <div class="card-body p-lg-15">
                        <form action="{{ route('store.template-anastesi') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="" class="form-label">Nama Template</label>
                                    <input type="text" name="nama" value="" class="form-control tgl">
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="form-label">Status Fisik</label>
                                    <select name="status_fisik" class="form-select" data-control="select2"
                                        data-placeholder="- Pilih -">
                                        <option></option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="E">E</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="form-label">Jenis / Teknis Anestesis</label>
                                    <div class="row mt-3">
                                        <div class="col">
                                            <input class="form-check-input" type="radio" value="LA"
                                                name="teknik_anestesis" />
                                            <label class="form-check-label" for="flexCheckbox30">
                                                LA
                                            </label>
                                        </div>
                                        <div class="col">
                                            <input class="form-check-input" type="radio" value="REGIONAL"
                                                name="teknik_anestesis" />
                                            <label class="form-check-label" for="flexCheckbox30">
                                                REGIONAL
                                            </label>
                                        </div>
                                        <div class="col">
                                            <input class="form-check-input" type="radio" value="GA"
                                                name="teknik_anestesis" />
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
                                    <textarea class="form-control" data-kt-autosize="true" name="posisi"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-label">Premedikasi</label>
                                    <textarea class="form-control" data-kt-autosize="true" name="premedikasi"></textarea>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-4">
                                    <label for="" class="form-label">Pemberian</label>
                                    <select name="pemberian" id="" class="form-select" data-control="select2"
                                        data-placeholder="- Pilih -">
                                        <option></option>
                                        <option value="SC">SC</option>
                                        <option value="IM">IM</option>
                                    </select>
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

                                                <div class="col-md-4" data-repeater-item>
                                                    <div class="form-group row mb-5">
                                                        <div class="col-md-10">
                                                            <input type="text" name="obat_anestesi_catatan"
                                                                class="form-control mb-2 mb-md-0 mt-5"
                                                                placeholder="Masukan Nama Obat" />
                                                        </div>
                                                        <div class="col-md-2">
                                                            <a href="javascript:;" data-repeater-delete
                                                                class="btn btn-sm btn-light-danger mt-6">
                                                                <i class="ki-duotone ki-trash fs-5">
                                                                    <span class="path1"></span><span
                                                                        class="path2"></span><span
                                                                        class="path3"></span><span
                                                                        class="path4"></span><span class="path5"></span>
                                                                </i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
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
                                    <textarea class="form-control" data-kt-autosize="true" name="anestesi"></textarea>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="form-label">Operasi</label>
                                    <textarea class="form-control" data-kt-autosize="true" name="operasi"></textarea>
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="form-label">Respirasi</label>
                                    <textarea class="form-control" data-kt-autosize="true" name="respirasi"></textarea>
                                </div>
                            </div>
                            <div class="row mt-5">
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <label for="" class="form-label">Catatan</label>
                                    <textarea class="form-control" data-kt-autosize="true" name="catatan"></textarea>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-4">
                                    <label for="" class="form-label">Lama Anestesi</label>
                                    <input type="text" name="lama_anestesi" value="" class="form-control">
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <label for="" class="form-label">Komplikasi Pra Anestesi</label>
                                    <textarea class="form-control" data-kt-autosize="true" name="pra_anestesi"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-label">Komplikasi Post Anestesi</label>
                                    <textarea class="form-control" data-kt-autosize="true" name="post_anestesi"></textarea>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
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
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js"></script>
    <script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script>
        $(function() {
            $('#obat_anestesi_catatan').repeater({
                initEmpty: false,

                show: function() {
                    $(this).slideDown();
                },

                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });
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
