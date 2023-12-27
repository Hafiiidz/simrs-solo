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
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Farmasi
                            Rawat Jalan</h1>
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
                            <li class="breadcrumb-item text-muted">Farmasi Rawat Jalan</li>
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
                                        <span class="md-bold fs-6 text-gray-800">{{ $pasien->no_rm }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row p-2">
                                    <label class="col-md-4 fw-semibold text-muted">Nama Pasien</label>
                                    <div class="col-md-8">
                                        <span class="md-bold fs-6 text-gray-800">{{ $pasien->nama_pasien }}</span>
                                    </div>
                                </div>
                                <div class="row p-2">
                                    <label class="col-md-4 fw-semibold text-muted">Usia</label>
                                    <div class="col-md-8">
                                        <span class="md-bold fs-6 text-gray-800">
                                            {{ $pasien->usia_tahun }}Th {{ $pasien->usia_bulan }}Bln
                                            {{ $pasien->usia_hari }}Hr</span>
                                    </div>
                                </div>
                                <div class="row p-2">
                                    <label class="col-md-4 fw-semibold text-muted">No BPJS</label>
                                    <div class="col-md-8">
                                        <span class="md-bold fs-6 text-gray-800">{{ $pasien->no_bpjs }}</span>
                                    </div>
                                </div>
                                <div class="row p-2">
                                    <label class="col-md-4 fw-semibold text-muted">NIK</label>
                                    <div class="col-md-8">
                                        <span class="md-bold fs-6 text-gray-800">{{ $pasien->nik }}</span>
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
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <h5 class="card-title">Resep</h5>
                                </div>
                                <div class="card-toolbar">
                                    <a href="{{ route('farmasi.antrian-resep') }}" class="btn btn-warning">Kembali</a>
                                </div>
                            </div>
                            <!--begin::Body-->
                            <div class="card-body p-lg-15">
                                @if ($antrian?->status_antrian == 'Antrian')
                                <h4>Permintaan Resep</h4>
                                <h6>Dokter : {{ $rawat->dokter->nama_dokter }}</h6>
                                <form action="{{ route('farmasi.post-resep',$antrian->id) }}" id='formPermintaanobat' method="post">
                                    @csrf
                                    <input type="hidden" name="idantrian" id="" value="{{ $antrian->id }}">
                                    <div class="rounded border p-5">
                                        <div class="row mb-5">
                                            <!--begin::Repeater-->
                                            <div id="kt_docs_repeater_basic">
                                                <!--begin::Form group-->
                                                <div class="form-group">
                                                    <div data-repeater-list="terapi_obat">
                                                        @if ($antrian->obat != 'null')
                                                            @foreach (json_decode($antrian->obat) as $val)
                                                                <div data-repeater-item>
                                                                    <div class="form-group row mb-2">
                                                                        <div class="col-md-6">
                                                                            <label class="form-label">Obat</label>
                                                                            <select name="obat" class="form-select"
                                                                                data-kt-repeater="select2"
                                                                                data-placeholder="-Pilih-">
                                                                                <option></option>
                                                                                @foreach ($obat as $item)
                                                                                    <option value="{{ $item->id }}"
                                                                                        {{ $val->obat == $item->id ? 'selected' : '' }}>
                                                                                        {{ $item->nama_obat }} - {{ $item->stok_apotek  }} (Rp. {{ $item->harga_jual }})
                                                                                         / {{ $item->satuan->satuan }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-2 fs-8">
                                                                            <label class="form-label">Signa</label>
                                                                            <div class="input-group mb-5">
                                                                                <input type="text" class="form-control"
                                                                                    name='signa1' value="{{ $val->signa1 }}"
                                                                                    placeholder="...." aria-label="Username">
                                                                                <span class="input-group-text fs-9">X</span>
                                                                                <input type="text" class="form-control"
                                                                                    name='signa2' value="{{ $val->signa2 }}"
                                                                                    placeholder="...." aria-label="Server">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <label class="form-label">Qty</label>
                                                                            <input type="number"
                                                                                value={{ $val->jumlah_obat }}
                                                                                name="jumlah_obat"
                                                                                class="form-control form-control-solid mb-5 mb-md-0"
                                                                                min="0" required>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <label class="form-label">Pemberian</label>
                                                                            <input type="number" name="pemberian_obat"
                                                                                class="form-control mb-5 mb-md-0" min="0"
                                                                                required>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <label class="form-label">Jenis Obat</label>
                                                                            <select name="jenis_obat" id=""
                                                                                class="form-select" required>
                                                                                <option value="">- Jenis Obat -</option>
                                                                               @foreach ($transaksi_bayar as $tb)
                                                                                   <option value="{{ $tb->id }}">{{ $tb->bayar }}</option>
                                                                               @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <a href="javascript:;" data-repeater-delete
                                                                                class="btn btn-sm btn-light-danger">
                                                                                <i class="ki-duotone ki-trash fs-5"><span
                                                                                        class="path1"></span><span
                                                                                        class="path2"></span><span
                                                                                        class="path3"></span><span
                                                                                        class="path4"></span><span
                                                                                        class="path5"></span></i>
                                                                                Hapus
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <div data-repeater-item>
                                                                <div class="form-group row mb-2">
                                                                    <div class="col-md-3">
                                                                        <label class="form-label">Obat</label>
                                                                        <select name="obat" class="form-select"
                                                                            data-kt-repeater="select2"
                                                                            data-placeholder="-Pilih-" required>
                                                                            <option></option>
                                                                            @foreach ($obat as $val)
                                                                                <option value="{{ $val->id }}">
                                                                                    {{ $val->nama_obat }}
                                                                                    - {{ $val->stok_apotek }}
                                                                                    {{ $val->satuan->satuan }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label class="form-label">Signa</label>
                                                                        <div class="input-group mb-5">
                                                                            <input type="text" class="form-control"
                                                                                name='signa1' placeholder="...."
                                                                                aria-label="Username">
                                                                            <span class="input-group-text">X</span>
                                                                            <input type="text" class="form-control"
                                                                                name='signa2' placeholder="...."
                                                                                aria-label="Server">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label class="form-label">Jumlah Obat</label>
                                                                        <input type="number" name="jumlah_obat"
                                                                            class="form-control form-control-solid mb-5 mb-md-0" min="0"
                                                                            required readonly>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label class="form-label">Pemberian</label>
                                                                        <input type="number" name="pemberian_obat"
                                                                            class="form-control mb-5 mb-md-0" min="0"
                                                                            required>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label class="form-label">Jenis Obat</label>
                                                                        <select name="jenis_obat" id=""
                                                                            class="form-select" required>
                                                                            <option value="">- Jenis Obat -</option>
                                                                            <option value="1">Pribadi</option>
                                                                            <option value="2">BPJS</option>
                                                                            <option value="3">Kronis</option>
                                                                            <option value="4">Covid</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <a href="javascript:;" data-repeater-delete
                                                                            class="btn btn-sm btn-light-danger">
                                                                            <i class="ki-duotone ki-trash fs-5"><span
                                                                                    class="path1"></span><span
                                                                                    class="path2"></span><span
                                                                                    class="path3"></span><span
                                                                                    class="path4"></span><span
                                                                                    class="path5"></span></i>
                                                                            Hapus
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
                                                    <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                                        <i class="ki-duotone ki-plus fs-3"></i>
                                                        Tambah Obat
                                                    </a>
                                                </div>
                                                <!--end::Form group-->
                                                <div class="row mt-5">
                                                    <div class="col-md-2">
                                                        <label class="form-label">Total Resep</label>
                                                        <input type="text" name="total_resep" id="total_resep" class="form-control form-control-solid" readonly>
                                                    </div>
                                                    <div class="col">
                                                        <label class="form-label">&nbsp;</label>
                                                        <br>
                                                        <button type="button" class="btn btn-primary" id="btn-resep">Update Resep</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end::Repeater-->
                                        </div>
                                    </div>
                                    <a target="_blank"  class="btn btn-warning mt-10" href="{{ route('farmasi.cetak-resep-tempo',$antrian->id) }}">Print Resep</a>
                                    <button class="btn btn-success mt-10">Simpan Resep</button>
                                </form>
                                <div class="separator separator-dashed border-secondary mt-5 mb-5"></div>
                                @endif
                                <table class="table table-bordered mt-10">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Resep</th>
                                            <th>Tgl</th>
                                            <th>Obat</th>
                                            <th>Total Resep</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($resep as $r)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $r->kode_resep }}</td>
                                                <td>{{ $r->tgl }}</td>
                                                <td>
                                                    @php
                                                        $obat_detail = DB::table('obat_transaksi_detail')->where('idtrx',$r->id)->get();
                                                    @endphp
                                                    <ol>
                                                        @foreach ($obat_detail as $od)
                                                        <li>{{ $od->nama_obat }} ({{ $od->qty }})</li>
                                                        @endforeach
                                                    </ol>
                                                </td>
                                                <td>{{ $r->total_harga }}</td>
                                                <td>
                                                    <a href="{{ route('farmasi.cetak-resep', $r->id) }}" class="btn btn-info btn-sm" target="_blank">Print</a>
                                                    <a href="{{ route('farmasi.cetak-tiket', $r->id) }}" class="btn btn-info btn-sm" target="_blank">Print Tiket</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>


                            </div>
                            <!--end::Body-->
                        </div>
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
    <script></script>
    <script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js"></script>
    <script>
        $(function() {
            $('#kt_docs_repeater_basic').repeater({
                initEmpty: false,
                show: function() {
                    $(this).slideDown();

                    $(this).find('[data-kt-repeater="select2"]').select2();
                },

                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                },

                ready: function() {
                    $('[data-kt-repeater="select2"]').select2();
                }
            });

            $("#formPermintaanobat").on("submit", function(event) {
                event.preventDefault();
                var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
                Swal.fire({
                    title: 'Simpan Data',
                    text: "Apakah Anda yakin akan menyimpan data ini ? data yang sudah di simpan tidak dapat di hapus kembali",
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
        })

        $( "#btn-resep" ).on( "click", function() {
            var formData = $("#formPermintaanobat").serialize();
            $.ajax({
                type: "GET",
                url: '{{route('farmasi.update-resep')}}',
                data: formData,
                success: function(response){
                    $('#total_resep').val('Rp.' + response.total);
                }
            });
        } );

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
