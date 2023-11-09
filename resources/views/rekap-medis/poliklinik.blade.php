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
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">List
                            Kategori Rekam Medis Pasien</h1>
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
                            <li class="breadcrumb-item text-muted">Kategori Rekam Medis</li>
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
                            <a href="{{ url('/pasien') }}" class="btn btn-sm btn-secondary">Kembali</a>
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
                            <div class="mb-5 hover-scroll-x">
                                <div class="d-grid">
                                    <ul class="nav nav-tabs flex-nowrap text-nowrap" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0 active"
                                                data-bs-toggle="tab" href="#kt_tab_pane_1" aria-selected="true"
                                                role="tab">Data Berobat</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0"
                                                data-bs-toggle="tab" href="#kt_tab_pane_2" aria-selected="false"
                                                role="tab" tabindex="-1">Resume Pasien</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0"
                                                data-bs-toggle="tab" href="#kt_tab_pane_3" aria-selected="false"
                                                role="tab" tabindex="-1">Rencana Tindak Lanjut</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0"
                                                data-bs-toggle="tab" href="#kt_tab_pane_4" aria-selected="false"
                                                role="tab" tabindex="-1">Tindakan</a>
                                        </li>


                                    </ul>
                                </div>
                            </div>

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                                    <div class="row mb-2">
                                        <!--begin::Label-->
                                        <label class="col-lg-2 fw-semibold text-muted">Poli</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <span class="fw-bold fs-6 text-gray-800">{{ $rawat->poli?->poli }}</span>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row mb-2">
                                        <!--begin::Label-->
                                        <label class="col-lg-2 fw-semibold text-muted">Dokter</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">
                                            <span
                                                class="fw-bold fs-6 text-gray-800">{{ $rawat->dokter?->nama_dokter }}</span>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row mb-2">
                                        <!--begin::Label-->
                                        <label class="col-lg-2 fw-semibold text-muted">Tgl.Berobat</label>
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
                                        <label class="col-lg-2 fw-semibold text-muted">Penanggung</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8">

                                            <span class="fw-bold fs-6 text-gray-800">{{ $rawat->bayar->bayar }}</span>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                                    @if (!$resume_medis)
                                        <form action="{{ route('post.resume-poli') }}" id="frmResume" method="post">
                                            @csrf
                                            <input type="hidden" name="idrawat" id="idrawat"
                                                value={{ $rawat->id }}>
                                            @if ($rawat->idjenisrawat == 1)
                                                <input type="hidden" name="idkategori" id="idkategori" value=1>
                                            @else
                                                <input type="hidden" name="idkategori" id="idkategori" value=3>
                                            @endif
                                            <input type="hidden" name='idpasien' value={{ $pasien->id }}>
                                            <button class="btn btn-warning btn-sm">Input Resume</button>
                                        </form>
                                    @else
                                        @if ($resume_detail)
                                            <a class="btn btn-primary btn-sm" href="{{ route('detail-rekap-medis-cetak', $resume_detail->id) }}"
                                                target="blank">Print</a>
                                                <div class="separator separator-dashed border-secondary mb-5 mt-5">
                                                </div>
                                        @endif
                                        <table class="table table-striped table-row-bordered gy-3 gs-5 border rounded">
                                            <thead class="border">
                                                <tr class="fw-bold fs-6 text-gray-800 px-7">
                                                    <th>Diagnosa</th>
                                                    <th>Anamnesa</th>
                                                    <th>Rencana Pemeriksaan</th>
                                                    <th>Terapi</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($resume_detail)
                                                    @php
                                                        $alergi = json_decode($resume_detail->alergi);
                                                        $pfisik = json_decode($resume_detail->pemeriksaan_fisik);
                                                        $rkesehatan = json_decode($resume_detail->riwayat_kesehatan);
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $resume_detail?->diagnosa }}</td>
                                                        <td>{{ $resume_detail?->anamnesa }}</td>
                                                        <td>{{ $resume_detail?->rencana_pemeriksaan }}</td>
                                                        <td>
                                                            {{ $resume_detail?->terapi }}
                                                            <div class="separator separator-dashed border-secondary mb-5">
                                                            </div>
                                                            @if ($resume_detail->terapi_obat != 'null')
                                                                <ul>
                                                                    @foreach (json_decode($resume_detail->terapi_obat) as $val)
                                                                        @foreach ($obat as $item)
                                                                            @if ($val->obat == $item->id)
                                                                                <li>{{ $item->nama_obat }}</li>
                                                                            @endif
                                                                        @endforeach
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @can('dokter')
                                                            <a href="{{ route('detail-rekap-medis-show', $resume_detail->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                @endif

                                            </tbody>
                                        </table>
                                        <div class="separator separator-dashed border-secondary mb-5 mt-5">
                                        </div>
                                        <table class="table table-striped table-row-bordered gy-3 gs-5 border rounded">
                                            <thead class="border">
                                                <tr class="fw-bold fs-6 text-gray-800 px-7">
                                                    <th>Pemeriksaan Fisik</th>
                                                    <th>Riwayat Kesehatan</th>
                                                    <th>Alergi</th>
                                                    <th>Obat yang dikonsumsi</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td>
                                                    <table>
                                                        <tr>
                                                            <td>&nbsp;&nbsp;Tekanan Darah</td>
                                                            <td class="text-start">:
                                                                {{ $pfisik->tekanan_darah ? $pfisik->tekanan_darah : '-' }}
                                                                mmHg</td>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;&nbsp;Nadi</td>
                                                            <td class="text-start">:
                                                                {{ $pfisik->nadi ? $pfisik->nadi : '-' }} x/menit</td>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;&nbsp;Pernapasan</td>
                                                            <td class="text-start">:
                                                                {{ $pfisik->pernapasan ? $pfisik->pernapasan : '-' }}
                                                                x/menit</td>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;&nbsp;Suhu</td>
                                                            <td class="text-start">:
                                                                {{ $pfisik->suhu ? $pfisik->suhu : '-' }} celcius</td>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;&nbsp;Berat Badan</td>
                                                            <td class="text-start">:
                                                                {{ $pfisik->berat_badan ? $pfisik->berat_badan : '-' }}
                                                                Kg</td>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;&nbsp;Tinggi Badan</td>
                                                            <td class="text-start">:
                                                                {{ $pfisik->tinggi_badan ? $pfisik->tinggi_badan : '-' }}
                                                                Cm</td>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;&nbsp;BMI</td>
                                                            <td class="text-start">:
                                                                {{ $pfisik->bmi ? $pfisik->bmi : '-' }} Kg/M2</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    <table>
                                                        <tr>
                                                            <td>&nbsp;&nbsp;Riwayat penyakit yang lalu</td>
                                                            <td class="text-start">:
                                                                {{ $rkesehatan->riwayat_1 == 1 ? 'Ya' : 'Tidak' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;&nbsp;Pernah dirawat</td>
                                                            <td class="text-start">:
                                                                {{ $rkesehatan->riwayat_2 == 1 ? 'Ya' : 'Tidak' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;&nbsp;Pernah dioperasi</td>
                                                            <td class="text-start">:
                                                                {{ $rkesehatan->riwayat_3 == 1 ? 'Ya' : 'Tidak' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>&nbsp;&nbsp;Dalam Pengobatan Khusus</td>
                                                            <td class="text-start">:
                                                                {{ $rkesehatan->riwayat_4 == 1 ? 'Ya' : 'Tidak' }}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td>
                                                    <ul>
                                                        <li>Obat :
                                                            <b>{{ $alergi->value_obat ? $alergi->value_obat : '-' }}</b>
                                                        </li>
                                                        <li>Makanan :
                                                            <b>{{ $alergi->value_makanan ? $alergi->value_makanan : '-' }}</b>
                                                        </li>
                                                        <li>Lain Lain :
                                                            <b>{{ $alergi->value_lain ? $alergi->value_lain : '-' }}</b>
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td>{{ $resume_detail->obat_yang_dikonsumsi }}</td>
                                                <td>
                                                    @can('perawat')
                                                        <a href="{{ route('detail-rekap-medis-show', $resume_detail->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                    @endcan
                                                </td>
                                            </tbody>
                                        </table>
                                    @endif
                                </div>

                                <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
                                    Sint sit mollit irure quis est nostrud cillum consequat Lorem esse do quis dolor esse
                                    fugiat sunt do.
                                    Eu ex commodo veniam Lorem aliquip laborum occaecat qui Lorem esse mollit dolore anim
                                    cupidatat.
                                    eserunt officia id Lorem nostrud aute id commodo elit eiusmod enim irure amet eiusmod
                                    qui reprehenderit nostrud tempor.
                                    Fugiat ipsum excepteur in aliqua non et quis aliquip ad irure in labore cillum elit
                                    enim. Consequat aliquip incididunt
                                    ipsum et minim laborum laborum laborum et cillum labore. Deserunt adipisicing cillum id
                                    nulla minim nostrud labore eiusmod et amet.
                                </div>
                            </div>
                        </div>

                        <div class="separator separator-dashed border-secondary mt-5 mb-5"></div>
                        <h4>Histori Pasien</h4>
                        <table id="tbl-rekap" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                            <thead class="border">
                                <tr class="fw-bold fs-6 text-gray-800 px-7">
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th>Tanggal</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody class="border">

                            </tbody>
                        </table>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::FAQ card-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>

    <!-- Modal -->
    {{-- <div class="modal fade" id="tambah-rekap" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Rekam Medis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="frm-data" action="{{ route('rekap-medis-store') }}" method="POST" autocomplete="off">
                        @csrf
                        <div class="row">
                            <label class="form-label">Kategori</label>
                            <input type="hidden" name="id_pasien" value="{{ $pasien->id }}">
                            <select class="form-select" name="kategori" data-control="select2"
                                data-placeholder="Pilih Kategori" data-dropdown-parent="#tambah-rekap" required>
                                <option></option>
                                @foreach ($kategori as $val)
                                    <option value="{{ $val->id }}">{{ $val->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
@section('js')
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js"></script>
    <script>
        $(function() {
            $("#tbl-rekap").DataTable({
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
                processing: true,
                serverSide: true,
                search: {
                    return: true
                },
                ajax: '{{ url()->current() }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'kategori',
                        name: 'kategori.nama'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'opsi',
                        name: 'opsi',
                        orderable: false,
                        searcheable: false
                    },
                ]
            });

            $("#frmResume").on("submit", function(event) {
                event.preventDefault();
                var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
                Swal.fire({
                    title: 'Simpan Data',
                    text: "Apakah Anda yakin menginput resume ?",
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
