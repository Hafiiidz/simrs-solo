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
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">BHP
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
                            <li class="breadcrumb-item text-muted">Operasi - Input BHP</li>
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
                <div class="card">
                    <form method="POST" action="{{ route('post_bhp_ok.operasi', $operasi_tindakan->id) }}"
                        id='frmInputBhp'>
                        @csrf
                        <div class="card-body">
                            <div class="row mt-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!--begin::Repeater-->
                                        <div id="bph_repeater">
                                            <!--begin::Form group-->
                                            <div class="form-group">
                                                <div data-repeater-list="bhp">
                                                    <div data-repeater-item>
                                                        <div class="form-group row mb-5">
                                                            {{-- <input type="hidden" name="idtindakan" value="{{ $operasi_tindakan->idtindakan }}" id=""> --}}
                                                            <div class="col-md-6">
                                                                <label class="form-label">Nama Obat</label>
                                                                <select name="nama_obat" class="form-select"  data-kt-repeater="select22" data-placeholder="-Pilih-"require id="">
                                                                    <option value=""></option>
                                                                    @foreach ($list_bhp as $lb)
                                                                        <option value="{{ $lb->id }}">{{ $lb->nama_barang }} Rp. {{ number_format($lb->harga) }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label class="form-label">Jumlah</label>
                                                                <input type="text" required name="jumlah"
                                                                    class="form-control mb-2 mb-md-0"
                                                                    placeholder="Masukan Obat" />
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label class="form-label">Satuan</label>
                                                                <input type="text" required name="satuan_obat"
                                                                    class="form-control mb-2 mb-md-0"
                                                                    placeholder="Masukan Obat" />
                                                            </div>
                                                            {{-- <div class="col-md-2">
                                                                <label class="form-label">Harga</label>
                                                                <input type="text" required name="harga_obat"
                                                                    class="form-control mb-2 mb-md-0"
                                                                    placeholder="Masukan Obat" />
                                                            </div> --}}
                                                            <div class="col-md-2">
                                                                <a href="javascript:;" data-repeater-delete
                                                                    class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                                    <i class="ki-duotone ki-trash fs-5"><span
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
                                                    Tambah BHP
                                                </a>
                                            </div>
                                            <!--end::Form group-->
                                        </div>
                                        <!--end::Repeater-->
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-10">
                                <div class="col-md-4">
                                    <button class="btn btn-success">Simpan</button>
                                </div>
                            </div>
                        </div>


                    </form>

                </div>
                <br>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Harga Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bhp as $b)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $b->nama_obat }}</td>
                                        <td>{{ $b->jumlah }}</td>
                                        <td>{{ $b->harga * $b->jumlah }}</td>
                                        <td><a href="" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        <a href="{{ route('index.operasi') }}" class="btn btn-secondary">Kembali</a>
                    </div>
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
        $(document).ready(function() {
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
            $('#bph_repeater').repeater({
                initEmpty: false,
                show: function() {
                    $('[data-kt-repeater="select22"]').select2({
                        allowClear: true,
                    });
                    $(this).slideDown();
                },
                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                },
                ready: function() {
                    $('[data-kt-repeater="select22"]').select2({
                        allowClear: true,
                    });
                }
            });

            $("#frmInputBhp").on("submit", function(event) {
                event.preventDefault();
                var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
                Swal.fire({
                    title: 'Simpan Data',
                    text: "Apakah Anda yakin akan menyimpan bhp ini ?",
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
        });
    </script>
@endsection
