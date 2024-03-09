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
                    <div class="card-header">
                        <div class="card-toolbar">
                            <h1>Total BHP : {{ number_format($total_bhp) }}</h1>
                        </div>
                        <div class="card-title">
                            <h5 class="card-title">Input BHP</h5>
                        </div>
                    </div>
                    <div class="card-body">
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
                                        role="tab">BHP</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0 "
                                        data-bs-toggle="tab" href="#kt_tab_pane_2" aria-selected="true"
                                        role="tab">Implan</a>
                                </li>
                            </ul>
                        </div>
                        <form action="{{ route('post_bhp_ok.operasi', $operasi_tindakan->id) }}" method="POST"
                            id="frmBhp">
                            @csrf
                            <div class="d-flex justify-content-end mb-5 mt-5">
                                <button type="submit" class="btn btn-primary me-3">Simpan</button>
                                <a href="{{ route('edit.operasi',$data->id) }}" class="btn btn-secondary">Kembali</a>
                            </div>
                            <div class="tab-content" id="myTabContent">

                                <div class="tab-pane fade  show active" id="kt_tab_pane_1" role="tabpanel">
                                    <div class="row">
                                        <div class="form-group">
                                            <div id="bhp_repeater">
                                                <div data-repeater-list="bhp">
                                                    <div class="col-md-12">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Nama BHP</th>
                                                                    <th width=150>Jumlah</th>
                                                                    <th>Satuan</th>
                                                                    <th>Harga</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($bhp as $key => $item)
                                                                    @php
                                                                        $cek_bhp = DB::table('operasi_tindakan_bhp')
                                                                            ->where('nama_obat', $item->nama_barang)
                                                                            ->where('idoperasi', $operasi_tindakan->id)
                                                                            ->where(
                                                                                'idtindakan',
                                                                                $operasi_tindakan->idtindakan,
                                                                            )
                                                                            ->first();
                                                                    @endphp
                                                                    <tr>
                                                                        <td>{{ $key + 1 }}</td>
                                                                        <td>{{ $item->nama_barang }}</td>
                                                                        <td>
                                                                            <div data-repeater-item>
                                                                                <input type="hidden"
                                                                                    name='id_bhp'value="{{ $item->id }}">
                                                                                <input type="hidden"
                                                                                    name='satuan'value="{{ $item->satuan }}">
                                                                                <input type="hidden" name='harga'
                                                                                    value="{{ $item->harga }}">
                                                                                <input type="hidden" name='nama'
                                                                                    value="{{ $item->nama_barang }}">
                                                                                <input type="text"
                                                                                    class="form-control form-control-sm"
                                                                                    value="{{ $cek_bhp->jumlah ?? null }}"
                                                                                    name="jumlah">
                                                                            </div>
                                                                        </td>
                                                                        <td>{{ $item->satuan }}</td>
                                                                        <td>{{ number_format($item->harga) }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                                    <div class="row">
                                        <div class="form-group">
                                            <div id="implan_repeater">
                                                <div data-repeater-list="implan">
                                                    <div class="col-md-12">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Nama Implan</th>
                                                                    <th width=150>Jumlah</th>
                                                                    <th>Satuan</th>
                                                                    <th>Harga</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($implan as $key => $item)
                                                                    @php
                                                                        $cek_bhp = DB::table('operasi_tindakan_bhp')
                                                                            ->where('nama_obat', $item->nama_barang)
                                                                            ->where('idoperasi', $operasi_tindakan->id)
                                                                            ->where(
                                                                                'idtindakan',
                                                                                $operasi_tindakan->idtindakan,
                                                                            )
                                                                            ->first();
                                                                    @endphp
                                                                    <tr>
                                                                        <td>{{ $key + 1 }}</td>
                                                                        <td>{{ $item->nama_barang }}</td>
                                                                        <td>
                                                                            <div data-repeater-item>
                                                                                <input type="hidden" name='id_bhp'
                                                                                    value="{{ $item->id }}">
                                                                                <input type="hidden"
                                                                                    name='satuan'value="{{ $item->satuan }}">
                                                                                <input type="hidden" name='harga'
                                                                                    value="{{ $item->harga }}">
                                                                                <input type="hidden" name='nama'
                                                                                    value="{{ $item->nama_barang }}">
                                                                                <input type="text"
                                                                                    class="form-control form-control-sm"
                                                                                    value="{{ $cek_bhp->jumlah ?? null }}"
                                                                                    name="jumlah">
                                                                            </div>
                                                                        </td>
                                                                        <td>{{ $item->satuan }}</td>
                                                                        <td>{{ number_format($item->harga) }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </form>
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
        //eksekusi frmbhp
        $("#frmBhp").on("submit", function(event) {
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
            $('#bhp_repeater').repeater({
                initEmpty: false,
                show: function() {
                    $(this).slideDown();
                },
                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                },
                ready: function() {}
            });
            $('#implan_repeater').repeater({
                initEmpty: false,
                show: function() {
                    $(this).slideDown();
                },
                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                },
                ready: function() {}
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
