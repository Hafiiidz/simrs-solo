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
                            Rekammedis</h1>
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
                            <li class="breadcrumb-item text-muted">Tambah Kunjungan Pasien BPJS</li>
                            <!--end::Item-->
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>

                    <div class="d-flex align-items-center gap-2 gap-lg-3">

                    </div>
                    <!--end::Page title-->
                </div>
                <!--end::Toolbar wrapper-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="row g-5">
                    <div class="col-md-4">
                        <div class="card  mb-5">
                            <div class="card-header">
                                <h4 class="card-title">Data Pasien</h4>

                                <div class="card-toolbar">
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#general_concent">General Consent</button>
                                    <button class="btn btn-warning btn-sm ">Cek Finger Print</button>
                                </div>
                            </div>
                            <div class="card-body p-9">
                                <!--begin::Row-->
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">Alamat</label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800">{{ $pasien->nama_pasien }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->

                                <!--begin::Input group-->
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">No. Rekammedis</label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <span class="fw-semibold text-gray-800 fs-6">{{ $pasien->no_rm }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">NIK</label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <span class="fw-semibold text-gray-800 fs-6">{{ $pasien->nik }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">No. BPJS</label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <span class="fw-semibold text-gray-800 fs-6">{{ $pasien->no_bpjs }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">
                                        Kontak Pasien

                                        <span class="ms-1" data-bs-toggle="tooltip"
                                            aria-label="Phone number must be active"
                                            data-bs-original-title="Phone number must be active" data-kt-initialized="1">
                                            <i class="ki-duotone ki-information fs-7"><span class="path1"></span><span
                                                    class="path2"></span><span class="path3"></span></i> </span>
                                    </label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8 d-flex align-items-center">
                                        <span class="fw-bold fs-6 text-gray-800 me-2">{{ $pasien->nohp }}</span>
                                        {{-- <span class="badge badge-success">Verified</span> --}}
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">Jenis Kelamin</label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span
                                            class="fw-bold fs-6 text-gray-800">{{ $pasien->jenis_kelamin == 'L' ? 'Laki-laki' : 'perempuan' }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">
                                        Tanggal Lahir
                                    </label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8 d-flex align-items-center">
                                        <span
                                            class="fw-bold fs-6 me-3 text-gray-800">{{ date('d F Y', strtotime($pasien->tgllahir)) }}
                                        </span>
                                        <span class="badge badge-success  ">{{ $pasien->usia_tahun }} th
                                            {{ $pasien->usia_bulan }}bln {{ $pasien->usia_hari }}hr</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">Kepercayaan</label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800">{{ $pasien->agama->agama }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>

                            </div>
                        </div>
                        <div class="card mb-5">
                            <div class="card-header">
                                <h4 class="card-title">Data Alamat</h4>

                                <div class="card-toolbar">
                                    
                                </div>
                            </div>
                            <div class="card-body p-9">
                                <!--begin::Row-->
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">Alamat Utama</label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800">{{ $pasien->alamat?->alamat }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>

                            </div>
                        </div>
                        <div class="card mb-5">
                            <div class="card-header">
                                <h4 class="card-title">Data Anggota</h4>

                                <div class="card-toolbar">
                                   
                                </div>
                            </div>
                            <div class="card-body p-9">
                                <!--begin::Row-->
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">Kesatuan</label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800">{{ $pasien->kesatuan }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">Pangkat</label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800">{{ $pasien->pangkat }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">NRP</label>
                                    <!--end::Label-->

                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800">{{ $pasien->nrp }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row g-5">
                            <div class="col-md-6">
                                <div class="card card-stretch">
                                    <div class="card-header">
                                        <h3 class="card-title">Tambah Kunjungan</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-2">
                                            <label for="kt_datepicker_1" class="required form-label">Tgl.Kunjungan</label>
                                            <input class="form-control form-control-sm" name="tglmasuk"
                                                placeholder="Pick a date" id="kt_datepicker_1" />
                                        </div>
                                        <div class="mb-2">
                                            <label for="penanggung" class="required form-label">Penanggung</label>
                                            <select name="penanggung" class="form-select form-select-sm"
                                                id="penanggung">
                                                <option value="2">BPJS</option>
                                                <option value="1">UMUM</option>
                                            </select>
                                        </div>
                                        <div class="mb-2">
                                            <label for="jenis_rawat" class="required form-label">Jenis Rawat</label>
                                            <select name="jenis_rawat" class="form-select form-select-sm" onchange="updateOptions()"
                                                id="jenis_rawat">
                                                <option value="">-- Pilih Poli --</option>
                                                <option value="1">Rawat Jalan</option>
                                                <option value="3">UGD</option>
                                            </select>
                                        </div>
                                        <div class="mb-2">
                                            <label for="poli" class="required form-label">Poli</label>
                                            <select name="poli" class="form-select form-select-sm" id="poli">
                                            </select>
                                        </div>
                                        <div class="mb-2">
                                        <label for="dokter" class="required form-label">Dokter</label>
                                        <div class="input-group">
                                            <input type="text" name='dokter' id='dokter' disabled class="form-control form-control-sm"
                                                required>
                                            <button class="btn btn-sm btn-success" disabled type="button"
                                                id="btn-cari-dokter">Cari</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" tabindex="-1" id="general_concent">
        <div class="modal-dialog modal-lg   ">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">PERSETUJUAN UMUM (GENERAL CONSENT)</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <p><strong>I. PERSETUJUAN ASUHAN KESEHATAN</strong></p>
                    <p>Saya menyadari bahwa tindakan kedokteran adalah beresiko, meliputi tindakan medis berupa preventif,
                        diagnostik, terapeutik atau rehabilitatif yang dilakukan oleh dokter atau dokter gigi terhadap
                        pasien.</p>
                    <p>Saya menyetujui segala pelayanan medis di Rumah Sakit Lanud Adi Soemarmo sebagaiman sesuai dengan
                        keadaan saya selama mendapatkan pelayanan medis di Rumah Sakit Lanud Adi Soemarmo.</p>
                    <p>Saya dengan ini memberikan persetujuan (kecuali yang membutuhkan persetujuan khusu/tertulis) dengan
                        tidak dapat ditarik kembali kepada Rumah Sakit Lnud Adi Soemarmo dalam memberikan pelayanan medis,
                        pemeriksaan fisik, yang dapat dilakukan oleh dokter atau perawat, dan melakukan prosedur diagnostik,
                        atau terapi dan tatalaksana sesuai pertimbangan dokter yang diperlukan atau disarankan pada
                        pelayanan medis untuk saya. Hal ini mencakup seluruh pemeriksaan dan prosedur diagnostik rutin,
                        termasuk namun tidak terbatas pada x-ray, pemberian dan atau tindakan kedokteran serta penyuntikan
                        (intramuskular, intravena, danprosedur invasif lainnya) produk farmasi dan obat-obatan, pemasangan
                        alat medis, dan pengambilan darah untuk pemeriksaan laboratorium atau pemeriksaan patologi yang
                        dibutuhkan untuk pelayanan medis saya.</p>
                    <p>Saya mempercayakan pada semua tenaga kesehatan rumah sakit untuk memberikan perawatan, diagnostik dan
                        terapi kepada saya sebagai pasien rawat inap atau rawat jalan atau Instalasi Gawat Darurat (IGD),
                        termasuk semua pemeriksaan penunjang, yang dibutuhkan untuk pengobatan dan tindakan yang diperlukan.
                    </p>
                    <p><strong>II. KEJADIAN TIDAK TERDUGA / DIHARAPKAN</strong></p>
                    <p>Saya mengerti dan menyadari bahwa dalam tindakan kedokteran dapat terjadi kejadian tidak terduga /
                        diharapkan (unanticipated outcame) yang dapat merupakan efek samping dari tindakan kedokteran yang
                        tidak dapat diduga sebelumnya (termasuk antara lain, namun tidak terbatas pada Steven Johnson
                        Syndrome dan Syok Anafilatik).</p>
                    <p>Saya mengerti bahwa hasil asuhan dan pengobatan termasuk kejadian yang tidak terduga /diharapkan akan
                        di beritahukan kepada saya dan keluarga oleh Dokter Penanggung Jawab Pasien (DPJP).</p>
                    <p><strong>SAYA TELAH DIJELASKAN, MEMBACA, MEMAHAMI, dan SEPENUHNYA SETUJU terhadap pernyataan tersebut
                            di atas.</strong></p>
                    <br>
                    <label for="">Nama Penanggung Jawab</label>
                    <input type="text" class="form-control" name="penanggung_jawab">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Setuju</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $("#kt_datepicker_1").flatpickr();

        function updateOptions() {
            var jenisRawat = document.getElementById("jenis_rawat").value;
            var anotherSelect = document.getElementById("poli");
            alert(jenisRawat);
            // Clear existing options
            anotherSelect.innerHTML = '';

            // Define options based on the selected value
            var options = [];

            if (jenisRawat == 1) {
                options = [
                    { value: '', text: 'Pilih Poli' },
                    { value: '2', text: 'BEDAH' },
                    { value: '3', text: 'GIGI' },
                    { value: '4', text: 'OBGYN' },
                    { value: '5', text: 'PENYAKIT DALAM' },
                    { value: '6', text: 'ANAK' },
                    { value: '7', text: 'Saraf' },
                    { value: '8', text: 'JIWA' },
                    { value: '9', text: 'PARU' },
                    { value: '10', text: 'ORTOPEDI' },
                    { value: '11', text: 'MATA' },
                    { value: '12', text: 'REHABMEDIK' },
                    { value: '13', text: 'GIGI PRSOSTHODONTI' },
                    { value: '14', text: 'KULIT' }
                    
                ];
            } else if (jenisRawat == 3) {
                options = [
                    { value: '', text: 'Pilih Poli' },
                    {
                        value: 1,
                        text: 'UGD'
                    }
                ];
            }

            // Add new options to the select element
            options.forEach(function(option) {
                var newOption = document.createElement("option");
                newOption.value = option.value;
                newOption.text = option.text;
                anotherSelect.appendChild(newOption);
            });
        }
    </script>
@endsection
