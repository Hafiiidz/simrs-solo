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
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Edit
                            BHP OK</h1>
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
                            <li class="breadcrumb-item text-muted">BHP</li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted"></li>
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
                            <h5 class="card-title">Edit Bph OK</h5>
                        </div>
                        <div class="card-toolbar">
                            {{-- <a href="{{ route('rekap-medis-index', $pasien->id) }}" class="btn btn-sm btn-secondary">Kembali</a> --}}
                        </div>
                    </div>
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form action="" method="POST" id='frmeditbhp'>
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $bhp->id }}">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Nama BHP</label>
                                        <input type="text" class="form-control" required id="exampleFormControlInput1" value="{{ $bhp->nama_barang }}" name="nama_barang"
                                            placeholder="Nama BHP">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" required class="form-label">Harga</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" value="{{ $bhp->harga }}" name="harga"
                                            placeholder="Harga">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" required class="form-label">Satuan</label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" value="{{ $bhp->satuan }}" name="satuan"
                                            placeholder="Satuan">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" required class="form-label">Jenis</label>
                                        <select class="form-select" name="jenis" aria-label="Default select example">
                                            <option selected>Pilih Jenis</option>
                                            <option {{ $bhp->jenis == 'Implan' ? 'selected':'' }} value="Implan">Implan</option>
                                            <option {{ $bhp->jenis == 'BHP' ? 'selected':'' }} value="BHP">BHP</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
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
@endsection
@section('js')
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js"></script>
    <script>
    
        $(function() {
            $("#frmeditbhp").submit(function(e) {
                e.preventDefault();
                var form = $(this);
                $.ajax({
                    url: "{{ route('store.bhp') }}",
                    type: "POST",
                    data: form.serialize(),
                    beforeSend: function() {
                        $.blockUI({
                            message: '<i class="fa fa-spinner fa-spin"></i> Loading ...',
                            css: {
                                border: 'none',
                                padding: '15px',
                                backgroundColor: '#000',
                                '-webkit-border-radius': '10px',
                                '-moz-border-radius': '10px',
                                opacity: .5,
                                color: '#fff'
                            }
                        });
                    },
                    complete: function() {
                        $.unblockUI();
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            Swal.fire({
                                text: response.message,
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            }).then(function() {
                                window.location.href = "{{ route('index.bhp') }}";
                            });
                        } else {
                            Swal.fire({
                                text: response.message,
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            text: xhr.responseJSON.message,
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                });
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
