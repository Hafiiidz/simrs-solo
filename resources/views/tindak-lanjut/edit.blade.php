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
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Tindak
                            Lanjut</h1>
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
                            <li class="breadcrumb-item text-muted">Tindak Lanjut</li>
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
                            <h5 class="card-title">Data Kategori Rekam Medis Pasien</h5>
                        </div>
                        <div class="card-toolbar">
                            <a href="{{ route('rekam-medis-poli', $rawat->id) }}"
                                class="btn btn-sm btn-secondary">Kembali</a>
                        </div>
                    </div>
                    <!--begin::Body-->
                    <div class="card-body">
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
                            <div class="p-2">
                                @canany(['dokter', 'perawat'])
                                    {{-- <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#tambah-rekap">
                                        Tambah Data Kategori Rekam Medis
                                    </button> --}}
                                @endcanany
                            </div>
                        </div>

                        <div class="row">
                            <div class="row mb-3">
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-4">{{ $pasien->nama_pasien }}</span>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <!--begin::Label-->
                                <label class="col-lg-2 fw-semibold text-muted">NIK</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">{{ $pasien->nik }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-5">
                                <!--begin::Label-->
                                <label class="col-lg-2 fw-semibold text-muted">No BPJS</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">{{ $pasien->no_bpjs }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-5">
                                <!--begin::Label-->
                                <label class="col-lg-2 fw-semibold text-muted">No Handphone</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">{{ $pasien->nohp }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-5">
                                <!--begin::Label-->
                                <label class="col-lg-2 fw-semibold text-muted">Alamat</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <span class="fw-bold fs-6 text-gray-800">{{ $pasien->alamat->alamat }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                        </div>
                        <div class="separator separator-dashed border-secondary mb-5"></div>
                        <div class="rounded border p-5">
                            <form action="{{ route('tindak-lanjut.post_edit_tindak_lanjut', $tindak_lanjut->id) }}" method="post"
                                id='frmTindak'>
                                @csrf
                                <div class="row mb-5">
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold">Rencana Tindak Lanjut</label>
                                        <select name="rencana_tindak_lanjut" data-control="select2"
                                            data-placeholder="Select an option" class="form-select"
                                            id="rencana_tindak_lanjut" arial-placeholder="Rencana Tindak Lanjut" required>
                                            <option value=""></option>
                                            <option {{ $tindak_lanjut->tindak_lanjut == 'Kontrol Kembali' ? 'selected' : '' }}
                                                value="Kontrol Kembali">Pasien Kontrol Kembali</option>
                                            <option {{ $tindak_lanjut->tindak_lanjut == 'Dirujuk' ? 'selected' : '' }}
                                                value="Dirujuk">Pasien Dirujuk</option>
                                            <option {{ $tindak_lanjut->tindak_lanjut == 'Interm' ? 'selected' : '' }}
                                                value="Interm">Pasien Dirujuk Interm</option>
                                            @if ($rawat->idjenisrawat == 1)
                                                <option {{ $tindak_lanjut->tindak_lanjut == 'Prb' ? 'selected' : '' }}
                                                    value="Prb">Pasien Dirujuk PRB</option>
                                            @endif
                                            <option {{ $tindak_lanjut->tindak_lanjut == 'Dirawat' ? 'selected' : '' }}
                                                value="Dirawat">Pasien Dirawat</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- Rujukan --}}
                                <div id="rujukan" class="{{ $tindak_lanjut->tindak_lanjut == 'Dirujuk' ? '' : 'd-none' }}">
                                    <div class="row mb-5">
                                        <div class="col-md-3">
                                            <label class="form-label fw-bold">Tgl.Rujukan</label>
                                            <input type="date" value="{{ $tindak_lanjut->tgl_tindak_lanjut }}"
                                                placeholder="Pilih Tgl Rujukan" class="form-control" name='tgl_kontrol'
                                                id='tgl_kontrol'>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-12">
                                            <label class="form-label fw-bold">Tujuan Rujuk</label>
                                            <select {{ $tindak_lanjut->tindak_lanjut == 'Dirujuk' ? '' : 'disabled' }}
                                                name="tujuan_rujuk" data-control="select2"
                                                data-placeholder="Select an option" class="form-select" id="tujuan_rujuk"
                                                arial-placeholder="Tujuan Rujuk">
                                                @if ($tindak_lanjut->tindak_lanjut == 'Dirujuk')
                                                    <option value="{{ $tindak_lanjut->tujuan_tindak_lanjut }}">
                                                        {{ $tindak_lanjut->tujuan_tindak_lanjut }}</option>
                                                @endif

                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-12">
                                            <label class="form-label fw-bold">Poli Rujuk</label>
                                            <select {{ $tindak_lanjut->tindak_lanjut == 'Dirujuk' ? '' : 'disabled' }}
                                                name="poli_rujuk" data-control="select2"
                                                data-placeholder="Select an option" class="form-select" id="poli_rujuk"
                                                arial-placeholder="Poli Rujuk">
                                                @if ($tindak_lanjut->tindak_lanjut == 'Dirujuk')
                                                    @foreach ($poli['list'] as $p)
                                                        <option value="{{ $p['kodeSpesialis'] }}">
                                                            {{ $p['namaSpesialis'] }} - {{ $p['kapasitas'] }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                {{-- End Rujukan --}}

                                {{-- Rawat --}}
                                <div id="rawat" class="{{ $tindak_lanjut->tindak_lanjut == 'Dirawat' ? '' : 'd-none' }}">
                                    <div class="row mb-5">
                                        <div class="col-md-12">
                                            <label class="form-label fw-bold">DPJP</label>
                                            <select name="iddokter" class="form-select" id="" data-control="select2"
                                            data-placeholder="Select an option" class="form-select" id="dpjp"
                                                arial-placeholder="Rencana Tindak Lanjut">
                                                <option value=""></option>
                                                @foreach ($dokter as $d)
                                                    <option {{ $d->id == $tindak_lanjut->iddokter ? 'selected':'' }} value="{{ $d->id }}">{{ $d->nama_dokter }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-3">
                                            <label class="form-label fw-bold">Tgl.Rencana Rawat</label>
                                            <input type="date" value="{{ $tindak_lanjut->tgl_tindak_lanjut }}"  class="form-control" name='tgl_kontrol'
                                                id='tgl_kontrol'>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <input class="form-check-input" {{ $tindak_lanjut->operasi == 1 ? 'checked':'' }} type="checkbox" name='operasi' value="1"
                                                    id="obat" />
                                                <label class="form-check-label" for="obat">
                                                    Operasi
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="text" name="value_operasi" value="{{ $tindak_lanjut->tindakan_operasi }}" id="value_operasi"
                                                class="form-control" placeholder="...." style="display: {{ $tindak_lanjut->operasi != 1 ? 'none':'' }} ;">
                                        </div>
                                    </div>
                                </div>
                                {{-- End Rawat --}}
                                {{-- Interem --}}
                                <div id="interm"  class="{{ $tindak_lanjut->tindak_lanjut == 'Interm' ? '' : 'd-none' }}">
                                    <div class="row mb-5">
                                        <div class="col-md-3">
                                            <label class="form-label fw-bold">Tgl.Rujuk</label>
                                            <input type="date" value="{{ $tindak_lanjut->tgl_tindak_lanjut }}" class="form-control" name='tgl_kontrol'
                                                id='tgl_kontrol'>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-12">
                                            <label class="form-label fw-bold">Poli Rujuk</label>
                                            <select  name="poli_rujuk" data-control="select2"
                                                data-placeholder="Select an option" class="form-select" id="poli_rujuk_interm"
                                                arial-placeholder="Poli Rujuk">
                                                <option value=""></option>
                                                @foreach ($poli_interm as $p)
                                                    <option {{ $tindak_lanjut->poli_rujuk == $p->kode ?'selected':'' }} value="{{ $p->kode }}">{{ $p->poli }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Interem --}}
                                <div id="tindak_lanjut"></div>


                                <div class="row mb-5">
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold">Catatan</label>
                                        <textarea name="catatan" rows="3" class="form-control" placeholder="Catatan">{{ $tindak_lanjut->catatan }}</textarea>
                                    </div>
                                </div>
                                <button class="btn btn-primary">Simpan</button>
                            </form>
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
        //doc ready function

        $(document).ready(function() {
            $('#tujuan_rujuk').select2({
                ajax: {
                    url: '{{ route('list-faskes') }}',
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
                                    text: user.nama
                                };
                            })
                        };
                    },
                    cache: true
                },
                minimumInputLength: 1,
                placeholder: 'Search for a user...'
            });

            $('#tgl_kontrol').on('change', function() {
                $('#tujuan_rujuk').prop('disabled', false);
            });
            $('#tujuan_rujuk').on('change', function() {
                tgl = $('#tgl_kontrol').val();
                kode_faskes = $('#tujuan_rujuk').val();
                var langArray = kode_faskes.split('-');
                var url = '{{ route('spesialistik-faskes', [':b_id', ':p_no']) }}';
                url = url.replace(':b_id', langArray[0]);
                url = url.replace(':p_no', tgl);
                $.get(url).done(function(data) {
                    if (data != 0) {
                        $("select#poli_rujuk").html(data);
                    }

                });
                $('#poli_rujuk').prop('disabled', false);
            });
        });
        $('#rencana_tindak_lanjut').on('change', function() {
            aksi = $('#rencana_tindak_lanjut').val();
            if (aksi == 'Dirujuk') {
                $('#rujukan').removeClass('d-none');
                $('#rawat').addClass('d-none');
                $('#interm').addClass('d-none');
            } else if (aksi == 'Dirawat') {
                $('#rujukan').addClass('d-none');
                $('#rawat').removeClass('d-none');
                $('#interm').addClass('d-none');
            } else if (aksi == 'Interm') {
                $('#rujukan').addClass('d-none');
                $('#rawat').addClass('d-none');
                $('#interm').removeClass('d-none');
            } else {
                $('#rujukan').addClass('d-none');
                $('#rawat').addClass('d-none');
                $('#interm').addClass('d-none');
            }

            // $('#tgl_kontrol').val('');
            // $('#tujuan_rujuk').val('');
            // url = "{{ route('tindak-lanjut.aksi_tindak_lanjut', '') }}" + "/" + aksi;
            // $.get(url).done(function(data) {
            //     $('#tindak_lanjut').html(data);
            // });
        })


        $('#obat').change(function() {
            if (this.checked) {
                $('#value_operasi').show();
            } else {
                $('#value_operasi').hide();
            }
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

        $("#frmTindak").on("submit", function(event) {
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
    </script>
@endsection
