@extends('layouts.index')
@section('css')
    <style>
        #tambah_kunjungan {
            transition: all 0.2s ease;
            /* Tambahkan transisi untuk semua properti */
        }

        .swal2-popup {
            width: 600px !important;
            /* Adjust the width as needed */
        }
    </style>
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
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#general_concent">General Consent</button>
                                    {{-- <button class="btn btn-warning btn-sm ">Cek Finger Print</button> --}}
                                </div>
                            </div>
                            <div class="card-body p-9">
                                <!--begin::Row-->
                                <div class="row mb-7">
                                    <div id='alert-finger' class="col-md-12 d-none">
                                        {{-- <div
                                            class="alert alert-{{ $cek_finger_print['response']['kode'] == 0 ? 'danger' : 'success' }} d-flex align-items-center p-5 mb-10">
                                            <i
                                                class="ki-duotone ki-fingerprint-scanning   fs-2hx text-{{ $cek_finger_print['response']['kode'] == 0 ? 'danger' : 'success' }} me-4">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>
                                            <div class="d-flex flex-column">
                                                <h4
                                                    class="mb-1 text-{{ $cek_finger_print['response']['kode'] == 0 ? 'danger' : 'success' }}">
                                                    Validasi Finger Print</h4>
                                                <span>{{ $cek_finger_print['response']['status'] }}</span>
                                            </div>
                                        </div> --}}
                                    </div>
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">Nama Lengkap</label>
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
                        <form action="{{ route('pasien.post-tambah-kunjungan') }}" method="post"
                            id="formInputKunjungan">
                            <div class="row g-5">
                                @csrf
                                <div id="tambah_kunjungan" class="col-md-12">
                                    <div class="card card-stretch">
                                        <div class="card-header">
                                            <h3 class="card-title">Tambah Kunjungan</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-2 fv-row">
                                                <label for="kt_datepicker_1"
                                                    class="required form-label">Tgl.Kunjungan</label>
                                                <input class="form-control form-control-sm" name="tglmasuk"
                                                    placeholder="Pick a date" id="kt_datepicker_1" />
                                            </div>
                                            <div class="mb-2 fv-row">
                                                <label for="penanggung" class="required form-label">Penanggung</label>
                                                <div class="input-group">
                                                    <select name="penanggung" class="form-select form-select-sm me-3"
                                                        id="penanggung">
                                                        <option value="">-- Pilih Penanggung --</option>
                                                        <option value="2">BPJS</option>
                                                        <option value="1">UMUM</option>
                                                    </select>
                                                    <div class="form-check mt-2">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="buat_sep" name="buat_sep" />
                                                        <label class="form-check-label" for="buat_sep">
                                                            Buat SEP
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-2 fv-row">
                                                <label for="jenis_rawat" class="required form-label">Jenis Rawat</label>
                                                <select name="jenis_rawat" class="form-select form-select-sm"
                                                    onchange="updateOptions()" id="jenis_rawat">
                                                    <option value="">-- Pilih Poli --</option>
                                                    <option value="1">Rawat Jalan</option>
                                                    <option value="3">UGD</option>
                                                </select>
                                            </div>
                                            <div class="mb-2 fv-row">
                                                <label for="poli" class="required form-label">Poli</label>
                                                <select name="idpoli" class="form-select form-select-sm" id="poli">
                                                </select>
                                            </div>
                                            <div class="mb-3 fv-row">
                                                <label for="dokter" class="required form-label">Dokter</label>
                                                <input type="hidden" name='iddokter' id='iddokter'>
                                                <div class="input-group">
                                                    <input type="text" name='dokter' id='dokter' readonly
                                                        class="form-control form-control-sm form-control-solid" required>
                                                    <button class="btn btn-sm btn-success" disabled type="button"
                                                        id="btn-cari-dokter">
                                                        <span class="indicator-label">
                                                            Cari
                                                        </span>
                                                        <span class="indicator-progress">
                                                            Harap Tunggu <span
                                                                class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                        </span>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="mb-2 fv-row form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault" />
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Anggota ?
                                                </label>
                                            </div>

                                        </div>
                                        <div class="card-footer">
                                            <button type="button" id="button-simpan" class="btn btn-primary">Simpan
                                                Data</button>
                                        </div>
                                    </div>
                                </div>
                                <div id="card_buat_sep" class="col-md-8 d-none">
                                    <div class="card card-stretch">
                                        <div class="card-header">
                                            <h3 class="card-title">SEP</h3>
                                            <div class="card-toolbar">
                                                <button class="btn btn-warning">SEP Manual</button>
                                                {{-- <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="flexCheckDefault" />
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Buat SEP
                                                    </label>
                                                </div> --}}

                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div id="sep_rujukan">
                                                {{-- 1. Manual
                                                2. Rujukan Pertama
                                                3. Kontrol
                                                4. Post Ranap --}}
                                                <input type="hidden" name="sep" id='sep'>
                                                <div class="mb-2 fv-row">
                                                    <label for="">Asal Rujukan</label>
                                                    <select name="faskes" class="form-select" id="faskes">
                                                        <option value="">Pilih Asal Rujukan</option>
                                                        <option value="1">Faskes 1</option>
                                                        <option value="2">Faskes 2</option>
                                                    </select>
                                                </div>
                                                <div id="list_data_rujukan"></div>
                                                <div id="insert_rujukan"></div>
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
    <div class="modal fade" tabindex="-1" id="modal-dokter">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div id="modal-hasil"></div>
            </div>
        </div>
    </div>
    {{-- <button id="openPopup">Open Popup</button> --}}
@endsection
@section('js')
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js"></script>
    <script>
        //forminsert
        $(document).ready(function() {
            const form = document.getElementById('formInputKunjungan');
            var validator = FormValidation.formValidation(
                form, {
                    fields: {
                        'no_surat': {
                            validators: {
                                notEmpty: {
                                    message: 'no_surat Harus diisi'
                                }
                            }
                        },
                        'txtnmdpjp': {
                            validators: {
                                notEmpty: {
                                    message: 'txtnmdpjp Harus diisi'
                                }
                            }
                        },
                        'status_kecelakaan': {
                            validators: {
                                notEmpty: {
                                    message: 'status_kecelakaan Harus diisi'
                                }
                            }
                        },
                        'tglmasuk': {
                            validators: {
                                notEmpty: {
                                    message: 'Tgl Masuk Harus diisi'
                                }
                            }
                        },
                        'penanggung': {
                            validators: {
                                notEmpty: {
                                    message: 'Penanggung Harus diisi'
                                }
                            }
                        },
                        'jenis_rawat': {
                            validators: {
                                notEmpty: {
                                    message: 'Jenis Rawat Harus diisi'
                                }
                            }
                        },
                        'idpoli': {
                            validators: {
                                notEmpty: {
                                    message: 'Poliklinik Harus diisi'
                                }
                            }
                        },
                        'dokter': {
                            validators: {
                                notEmpty: {
                                    message: 'Dokter Harus diisi'
                                }
                            }
                        },
                    },

                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: '.fv-row',
                            eleInvalidClass: '',
                            eleValidClass: ''
                        })
                    }
                }
            );
           
            const submitButton = document.getElementById('button-simpan');
            submitButton.addEventListener('click', function(e) {
                // Prevent default button action
                e.preventDefault();

                // Validate form before submit
                if (validator) {
                    validator.validate().then(function(status) {
                        console.log('validated!');

                        if (status == 'Valid') {
                            // Show loading indication
                            submitButton.setAttribute('data-kt-indicator', 'on');

                            // Disable button to avoid multiple click
                            submitButton.disabled = true;

                            // Simulate form submission. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                            setTimeout(function() {
                                // Remove loading indication
                                submitButton.removeAttribute('data-kt-indicator');

                                // Enable button
                                submitButton.disabled = false;

                                // Show popup confirmation
                                Swal.fire({
                                    text: "Form has been successfully submitted!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                                // var formData = form.closest('form');
                                var formDataFix = $(form).serialize();
                                var url = form.getAttribute('action');
                                var method = form.getAttribute('method');
                                $.ajax({
                                    type: method,
                                    url: url, // Replace with your server endpoint
                                    data: formDataFix,
                                    success: function(response) {
                                        console.log('success');
                                    },
                                    error: function(error) {
                                        console.log('Error submitting form:',
                                            error);
                                    }
                                });
                                // form.submit();
                                // Submit form
                            }, 2000);
                        }
                    });
                }
            });
        });




        $(document).ready(function() {
            $('#openPopup').on('click', function() {
                Swal.fire({
                    title: 'Select an option',
                    html: '<select id="firstSelect" class="form-select">' +
                        '<option value="" disabled selected>Select an option</option>' +
                        '<option value="1">Option 1</option>' +
                        '<option value="2">Option 2</option>' +
                        '<option value="3">Option 3</option>' +
                        '</select>',
                    preConfirm: () => {
                        const selectedValue = $('#firstSelect').val();
                        if (!selectedValue) {
                            Swal.showValidationMessage('Please select an option');
                        }
                        return selectedValue;
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'You selected ' + result.value,
                            html: '<select id="secondSelect" class="form-select">' +
                                '<option value="" disabled selected>Select another option</option>' +
                                '<option value="1">Sub-option 1</option>' +
                                '<option value="2">Sub-option 2</option>' +
                                '<option value="3">Sub-option 3</option>' +
                                '</select>',
                            preConfirm: () => {
                                const selectedValue = $('#secondSelect').val();
                                if (!selectedValue) {
                                    Swal.showValidationMessage(
                                        'Please select an option');
                                }
                                return selectedValue;
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire(
                                    'Selected!',
                                    'You selected: ' + result.value,
                                    'success'
                                );
                            }
                        });
                    }
                });
            });
        });
        $('#buat_sep').change(function() {
            var penanggung = $('#penanggung').val();
            if ($(this).is(':checked')) {
                var penanggung = $('#penanggung').val();
                if (penanggung == null || penanggung == '' || penanggung == 1) {
                    toastr.error('Harap isi penanggung dengan BPJS');
                    $(this).prop('checked', false);
                    $('#sep').val(null);
                } else {
                    $('#tambah_kunjungan').removeClass('col-md-12').addClass('col-md-4');
                    $('#card_buat_sep').removeClass('d-none');
                    $('#sep').val(1);
                }

            } else {
                $('#tambah_kunjungan').removeClass('col-md-4').addClass('col-md-12');
                $('#card_buat_sep').addClass('d-none');
                $('#list_data_rujukan').empty();
                $('#sep').val(null);
            }
        });
        $('#poli').on('change', function() {
            var selectedValue = $(this).val();
            if (selectedValue > 0) {
                $('#btn-cari-dokter').prop('disabled', false);
            } else {
                $('#btn-cari-dokter').prop('disabled', true);
            }
        })


        $('#faskes').on('change', function() {
            var faskes = $(this).val();
            var no_bpjs = "{{ $pasien->no_bpjs }}";
            if (faskes == '' || faskes == null) {
                toastr.error('Silahkan pilih faskes');
                $('#list_data_rujukan').empty();
                return false;
            }
            $.ajax({
                url: '{{ route('get-rujukan-faskes') }}',
                type: 'GET',
                data: {
                    faskes: faskes,
                    no_bpjs: no_bpjs
                },
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
                success: function(response) {
                    $.unblockUI();
                    if (response.status === 'failed') {
                        toastr.error(response.message);
                        $('#list_data_rujukan').empty();
                    } else {
                        $('#list_data_rujukan').html(response.response);
                        toastr.success(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    $.unblockUI();
                    toastr.error(xhr.responseJSON.message || error);
                    $('#list_data_rujukan').empty();
                }
            });
        });
        var buttoncaridokter = document.querySelector("#btn-cari-dokter");

        // Handle the click event for the buttoncaridokter
        buttoncaridokter.addEventListener("click", function() {
            // Activate indicator
            buttoncaridokter.setAttribute("data-kt-indicator", "on");

            var tgl = $('#kt_datepicker_1').val();
            var poli = $('#poli').val();
            var penanggung = $('#penanggung').val();
            console.log(tgl);
            if (tgl == null || tgl == '') {
                toastr.error('Harap isi tanggal kunjungan terlebih dahulu');
                buttoncaridokter.removeAttribute("data-kt-indicator"); // Disable indicator on validation error
                return false;
            }
            if (penanggung == null || penanggung == '') {
                toastr.error('Harap isi penanggung terlebih dahulu');
                buttoncaridokter.removeAttribute("data-kt-indicator"); // Disable indicator on validation error
                return false;
            }
            // Make AJAX request
            $.ajax({
                url: '{{ route('get-jadwal-dokter') }}',
                type: 'GET',
                data: {
                    poli: poli,
                    tgl: tgl,
                    penanggung: penanggung
                },
                success: function(response) {
                    // Display the result
                    $('#modal-hasil').html(response);
                    $('#modal-dokter').modal('show');
                    // Disable indicator after successful response
                    buttoncaridokter.removeAttribute("data-kt-indicator");
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + error);
                    toastr.error(xhr.responseJSON.message || error);
                    // Disable indicator after error response
                    buttoncaridokter.removeAttribute("data-kt-indicator");
                }
            });

            // Optionally, disable the indicator after a fixed time regardless of AJAX response
            // setTimeout(function() {
            //     button.removeAttribute("data-kt-indicator");
            // }, 3000);
        });

        $("#kt_datepicker_1").flatpickr();

        function updateOptions() {
            var jenisRawat = document.getElementById("jenis_rawat").value;
            var anotherSelect = document.getElementById("poli");
            // Clear existing options
            anotherSelect.innerHTML = '';

            // Define options based on the selected value
            var options = [];

            if (jenisRawat == 1) {
                options = [{
                        value: '',
                        text: 'Pilih Poli'
                    },
                    {
                        value: '2',
                        text: 'BEDAH'
                    },
                    {
                        value: '3',
                        text: 'GIGI'
                    },
                    {
                        value: '4',
                        text: 'OBGYN'
                    },
                    {
                        value: '5',
                        text: 'PENYAKIT DALAM'
                    },
                    {
                        value: '6',
                        text: 'ANAK'
                    },
                    {
                        value: '7',
                        text: 'Saraf'
                    },
                    {
                        value: '8',
                        text: 'JIWA'
                    },
                    {
                        value: '9',
                        text: 'PARU'
                    },
                    {
                        value: '10',
                        text: 'ORTOPEDI'
                    },
                    {
                        value: '11',
                        text: 'MATA'
                    },
                    {
                        value: '12',
                        text: 'REHABMEDIK'
                    },
                    {
                        value: '13',
                        text: 'GIGI PRSOSTHODONTI'
                    },
                    {
                        value: '14',
                        text: 'KULIT'
                    }

                ];
            } else if (jenisRawat == 3) {
                options = [{
                        value: '',
                        text: 'Pilih Poli'
                    },
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
