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
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Input
                            Hasil Lab</h1>
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
                            <li class="breadcrumb-item text-muted">Input Hasil Lab</li>
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
                    <div class="col-md-6 mb-5">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <h5 class="card-title">Data Pasien</h5>
                                </div>
                            </div>
                            <!--begin::Body-->
                            <div class="card-body p-lg-15">
                                <div class="row p-2">
                                    <!--begin::Label-->
                                    <label class="col-md-4 fw-semibold text-muted">No RM</label>
                                    <div class="col-md-8">
                                        <span class="md-bold fs-6 text-gray-800">{{ $rawat->pasien->no_rm }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row p-2">
                                    <label class="col-md-4 fw-semibold text-muted">Nama Pasien</label>
                                    <div class="col-md-8">
                                        <span class="md-bold fs-6 text-gray-800">{{ $rawat->pasien->nama_pasien }}</span>
                                    </div>
                                </div>
                                <div class="row p-2">
                                    <label class="col-md-4 fw-semibold text-muted">Usia</label>
                                    <div class="col-md-8">
                                        <span class="md-bold fs-6 text-gray-800">
                                            {{ $rawat->pasien->usia_tahun }}Th {{ $rawat->pasien->usia_bulan }}Bln
                                            {{ $rawat->pasien->usia_hari }}Hr</span>
                                    </div>
                                </div>
                                <div class="row p-2">
                                    <label class="col-md-4 fw-semibold text-muted">No BPJS</label>
                                    <div class="col-md-8">
                                        <span class="md-bold fs-6 text-gray-800">{{ $rawat->pasien->no_bpjs }}</span>
                                    </div>
                                </div>
                                <div class="row p-2">
                                    <label class="col-md-4 fw-semibold text-muted">NIK</label>
                                    <div class="col-md-8">
                                        <span class="md-bold fs-6 text-gray-800">{{ $rawat->pasien->nik }}</span>
                                    </div>
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                    <div class="col-md-6 mb-5">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <h5 class="card-title">Data Berobat</h5>
                                </div>
                            </div>
                            <!--begin::Body-->
                            <div class="card-body p-lg-15">
                                <div class="row mb-2">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">Poli</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800">{{ $rawat->poli?->poli }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-2">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">Dokter</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800">{{ $rawat->dokter?->nama_dokter }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-2">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">Tgl.Berobat</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        @php
                                            setlocale(LC_ALL, 'IND');
                                        @endphp
                                        <span
                                            class="fw-bold fs-6 text-gray-800">{{ \Carbon\Carbon::parse($rawat->tglmasuk)->formatLocalized('%A %d %B %Y') }}
                                            {{ date('H:i:s', strtotime($rawat->tglmasuk)) }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-2">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">Penanggung</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">

                                        <span class="fw-bold fs-6 text-gray-800">{{ $rawat->bayar->bayar }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card mb-5">
                            <div class="card-header">
                                <h5 class="card-title">Input Pemeriksaan {{ $tindakan->nama_tindakan }}</h5>
                                <div class="card-toolbar">
                                    <a href="{{ route('penunjang.detail', [$rawat->id, 'Radiologi']) }}"
                                        class="btn btn-secondary me-3">Kembali</a>
                                    
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-6">
                                        <form action="{{ route('penunjang.rad-post-hasil', $pemeriksaan->id) }}"
                                            method="post" id='frmInput'>
                                            @csrf
                                            <div class="mb-5">
                                                <label for="exampleFormControlInput1"
                                                    class="required form-label">Klinis</label>
                                                <div class="input-group mb-5">
                                                    <input type="text" class="form-control" id='klinis' name='klinis'
                                                        placeholder="Klinis" value="{{ $pemeriksaan->klinis }}" />
                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#kt_modal_1" id="basic-addon2">Cari
                                                        Template</button>
                                                </div>
                                            </div>
                                            <div class="mb-5">
                                                <label for="exampleFormControlInput1"
                                                    class="required form-label">Hasil</label>
                                                <textarea id="hasil" rows="8" class="form-control" name='hasil'>{{ $pemeriksaan->hasil }}</textarea>
                                            </div>
                                            <div class="mb-5">
                                                <label for="exampleFormControlInput1"
                                                    class="required form-label">Kesan</label>
                                                <textarea id="kesan" rows="8" class="form-control" name='kesan'>{{ $pemeriksaan->kesan }}</textarea>
                                            </div>
                                            <div class="mb-5">
                                                <label for="exampleFormControlInput1"
                                                    class="required form-label">Keterangan</label>
                                                <textarea id="keterangan" rows="4" class="form-control" name='keterangan'>{{ $pemeriksaan->keterangan }}</textarea>
                                            </div>
                                            <button class="btn btn-success">Simpan Data</button>
                                        </form>
                                    </div>

                                    <div class="col-md-6 p-20">
                                        <h5>Upload Foto</h5>
                                        <div class="separator separator-dashed border-secondary mb-5"></div>
                                        <form id='uploadFile'
                                            action="{{ route('penunjang.rad-post-foto', $pemeriksaan->id) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <label for="">No Foto</label>
                                            <input type="text" class="form-control" name="nofoto" required
                                                id="">
                                            <label for="">File</label>
                                            <input type="file" required name='foto_radiologi' accept=".jpg,.png"
                                                class="form-control">
                                            <button class="btn btn-primary btn-sm mt-5">Upload</button>
                                        </form>
                                        <div class="separator mt-10 separator-dashed border-secondary mb-5"></div>
                                        <h5>Daftar Foto</h5>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>No Foto</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($foto as $f)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $f->nofoto }}</td>
                                                                    <td>
                                                                        <button data-bs-toggle="modal" data-bs-target="#modal_{{ $f->id }}" class="btn btn-sm btn-primary">View</button>
                                                                        <a href="" class="btn btn-sm btn-danger">Delete</a>
                                                                    </td>
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
                    </div>
                </div>
                <!--end::FAQ card-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    @foreach ($foto as $f)
    <div class="modal fade" tabindex="-1" id="modal_{{ $f->id }}">
    <div
        class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"></h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span
                            class="path1"></span><span
                            class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            {{-- <div class="modal-body">
                <div class="PDF">
                    <object
                        data="{{ asset($value_data['url'] . $value_data['value']) }}"
                        type="application/pdf"
                        width="750" height="750">
                        <a>Dokumen tidak ditemukan</a>
                    </object>
                </div>
            </div> --}}
            <div class="modal-body">
                <img width='100%'
                            src="{{ asset('storage/foto-rad/'.$f->foto) }}?v={{ rand() }}"
                            alt="">
            </div>

            <div class="modal-footer">
                <button type="button"
                    class="btn btn-light"
                    data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
    @endforeach
    <div class="modal fade" tabindex="-1" id="kt_modal_1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Cari Template</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <table id="kt_datatable_column_rendering" class="table table-striped table-row-bordered gy-5 gs-7">
                        <thead>
                            <tr class="fw-semibold fs-6 text-gray-800">
                                <th>Klinis</th>
                                <th>Hasil</th>
                                <th>Kesan</th>
                                {{-- <th>Aksi</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($template_radiologi as $tr)
                                <tr data-id="{{ $tr->id }}">
                                    <td>{{ $tr->klinis }}</td>
                                    <td>{{ $tr->hasil }}</td>
                                    <td>{{ $tr->kesan }}</td>
                                    {{-- <td><a class="btn btn-sm btn-success" id="pilih-template">Pilih</a></td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
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
            var table = $('#kt_datatable_column_rendering').DataTable({
                "language": {
                    "lengthMenu": "Show _MENU_",
                },
                "dom": "<'row'" +
                    "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                    "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                    ">" +

                    "<'table-responsive'tr>" +

                    "<'row'" +
                    "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                    "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                    ">",
            });
            $('#lab_repeater').repeater({
                initEmpty: false,

                show: function() {
                    $(this).slideDown();

                    $(this).find('[data-kt-repeater="select2lab"]').select2();
                },

                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                },

                ready: function() {
                    $('[data-kt-repeater="select2lab"]').select2();
                }
            });
            $("#frmInput").on("submit", function(event) {
                event.preventDefault();
                var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
                Swal.fire({
                    title: 'Simpan Data',
                    text: "Apakah Anda yakin akan mengerjakan pemeriksaan ini ? ",
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

            $('#kt_datatable_column_rendering tbody').on('click', 'tr', function() {
                var rowData = table.row(this).data();

                // Access the data-id attribute
                var dataId = $(this).attr('data-id');

                // Log the data-id value (you can use it as needed)
                console.log('Clicked row with data-id: ' + dataId);

                // If you want to use the data associated with the row, you can access it through rowData
                console.log('Row data:', rowData);
                $('#kesan').val(rowData[2]);
                $('#hasil').val(rowData[1]);
                $('#kt_modal_1').modal('hide');
            })

            
            $("#frmLabhasil").on("submit", function(event) {
                event.preventDefault();
                var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
                Swal.fire({
                    title: 'Simpan Data',
                    text: "Apakah Anda yakin akan mengerjakan pemeriksaan ini ? ",
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
            $("#uploadFile").on("submit", function(event) {
                event.preventDefault();
                var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
                Swal.fire({
                    title: 'Upload Foto',
                    text: "Apakah Anda yakin untuk Upload Foto ? ",
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
        });
    </script>
@endsection
