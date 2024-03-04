@extends('layouts.index')
@section('css')
@endsection
@section('content')
    @php
        if($pengkajian){
            $riwayat_mens = json_decode($pengkajian?->riwayat_men);
            $riwayat_hamil = json_decode($pengkajian?->riwayat_hamil);
            $riwayat_kehamilan = json_decode($pengkajian?->riwayat_kehamilan);
        }else{
            $riwayat_mens = null;
            $riwayat_hamil = null;
            $riwayat_kehamilan = null;
        }        
    @endphp
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
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0"></h1>
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
                            <li class="breadcrumb-item text-muted">Pengkajian Kebidanan</li>
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
                <div class="card card-flush">
                    <div class="card-header">
                        <h3 class="card-title">Pengkajian Kebidanan</h3>
                        <div class="card-toolbar">
                            {{-- <a href="{{ route('index.rawat-inap') }}" class="btn btn-sm btn-secondary me-2">Kembali</a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="rounded border p-5">
                            <div class="mb-5 hover-scroll-x">
                                <div class="d-grid">
                                    <ul class="nav nav-tabs flex-nowrap text-nowrap" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0 active"
                                                data-bs-toggle="tab" href="#kt_tab_pane_subjektif" aria-selected="true"
                                                role="tab">Data Subjektif</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0"
                                                data-bs-toggle="tab" href="#kt_tab_pane_objektif" aria-selected="false"
                                                role="tab" tabindex="-1">Data Objektif</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade  show active" id="kt_tab_pane_subjektif" role="tabpanel">
                                    <h5>Data Subjektif</h5>
                                    <div class="separator separator-dashed border-secondary mb-5"></div>
                                    <form action="{{ route('post.pengakajian-data-subjektif', $rawat->id) }}"
                                        method="POST" id='frmKebidanan'>
                                        @csrf
                                        <div class="fw-row mb-5">
                                            <label class="form-label">1. Keluhan Utama</label>
                                            <textarea name="keluhan_utama" id="keluhan_utama" class="form-control" data-kt-autosize="true" rows=2>{{ $pengkajian?->keluhan_utama }}</textarea>
                                        </div>
                                        <div class="fw-row mb-5">
                                            <label class="form-label">2. Riwayat Menstruasi</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group mb-5">
                                                        <input type="text" class="form-control" value="{{ $riwayat_mens?->usia_menarche }}" name="usia_menarche"
                                                            placeholder="Usia Menarche" id="">
                                                        <span class="input-group-text" id="basic-addon2">Tahun</span>
                                                    </div>
                                                    <div class="input-group mb-5">
                                                        <input type="text" class="form-control" value="{{ $riwayat_mens?->lama_haid }}" name="lama_haid"
                                                            placeholder="Lama Haid" id="">
                                                        <span class="input-group-text" id="basic-addon2">Hari</span>
                                                    </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-group mb-5">
                                                        <input type="text" class="form-control" name="jumlah_darah_haid"
                                                            placeholder="Jumlah Darah Haid" value="{{ $riwayat_mens?->jumlah_darah_haid }}" id="">
                                                        <span class="input-group-text" id="basic-addon2">Softek /
                                                            Hari</span>
                                                    </div>
                                                    <div class="input-group mb-5">
                                                        <input type="text" class="form-control" value="{{ $riwayat_mens?->flour_albus }}" name="flour_albus"
                                                            placeholder="Flour Albus" id="">
                                                    </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-group mb-5">
                                                        <input type="text" class="form-control" value="{{ $riwayat_mens?->hpht }}" name="hpht"
                                                            placeholder="HPHT" id="">
                                                    </div>
                                                    <div class="input-group mb-5">
                                                        <input type="text" class="form-control" value="{{ $riwayat_mens?->keluhan_haid }}" name="keluhan_haid"
                                                            placeholder="Keluhan Haid" id="">
                                                    </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-group mb-5">
                                                        <input type="text" class="form-control" name="tp"
                                                            placeholder="TP" id="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="fw-row mb-5">
                                            <label class="form-label">3. Riwayat Hamil Ini</label>
                                            <div class="row mt-5">
                                                <div class="col-md-2">
                                                    <label>Hamil Muda</label>

                                                </div>
                                                <div class="col-1 mt-2">
                                                    <label class="form-check-image active">


                                                        <div class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="radio" value="1"
                                                                name="hamil_muda" />
                                                            <div class="form-check-label">
                                                                Mual
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                                <!--end::Col-->

                                                <!--begin::Col-->
                                                <div class="col-1 mt-2">
                                                    <label class="form-check-image">

                                                        <div class="form-check form-check-custom form-check-solid me-10">
                                                            <input class="form-check-input" type="radio" value="1"
                                                                name="hamil_muda" />
                                                            <div class="form-check-label">
                                                                Muntah
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                                <!--end::Col-->

                                                <!--begin::Col-->
                                                <div class="col-1 mt-2 me-5">
                                                    <label class="form-check-image">

                                                        <div class="form-check form-check-custom form-check-solid me-10">
                                                            <input class="form-check-input" type="radio" value="1"
                                                                name="hamil_muda" />
                                                            <div class="form-check-label">
                                                                Pendarahan
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>

                                                <div class="col-1 mt-2">
                                                    <label class="form-check-image">

                                                        <div class="form-check form-check-custom form-check-solid me-10">
                                                            <input class="form-check-input" type="radio" value="1"
                                                                name="hamil_muda" />
                                                            <div class="form-check-label">
                                                                Lainnya
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                                <div class="col-3">
                                                    <label class="form-check-image">

                                                        <input type="text" class="form-control"
                                                            placeholder="Sesuai Keluhan" name="keluhan_lainnya"
                                                            id="">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="separator separator-dashed border-secondary mb-5"></div>
                                            <div class="row mt-5">
                                                <div class="col-md-2">
                                                    <label>Hamil Tua</label>

                                                </div>
                                                <div class="col-1 mt-2">
                                                    <label class="form-check-image active">


                                                        <div class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="radio" value="1"
                                                                name="hamil_tua" />
                                                            <div class="form-check-label">
                                                                Mual
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                                <!--end::Col-->

                                                <!--begin::Col-->
                                                <div class="col-1 mt-2">
                                                    <label class="form-check-image">

                                                        <div class="form-check form-check-custom form-check-solid me-10">
                                                            <input class="form-check-input" type="radio" value="1"
                                                                name="hamil_tua" />
                                                            <div class="form-check-label">
                                                                Muntah
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                                <!--end::Col-->

                                                <!--begin::Col-->
                                                <div class="col-1 mt-2 me-5">
                                                    <label class="form-check-image">

                                                        <div class="form-check form-check-custom form-check-solid me-10">
                                                            <input class="form-check-input" type="radio" value="1"
                                                                name="hamil_tua" />
                                                            <div class="form-check-label">
                                                                Pendarahan
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>

                                                <div class="col-1 mt-2">
                                                    <label class="form-check-image">

                                                        <div class="form-check form-check-custom form-check-solid me-10">
                                                            <input class="form-check-input" type="radio" value="1"
                                                                name="hamil_tua" />
                                                            <div class="form-check-label">
                                                                Lainnya
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                                <div class="col-3">
                                                    <label class="form-check-image">
                                                        <input type="text" class="form-control"
                                                            placeholder="Sesuai Keluhan" name="keluhan_hamil_tua_lainnya"
                                                            id="">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row mb-5">
                                                <div class="col-md-2">
                                                    <label>Riwayat Imunisasi</label>

                                                </div>
                                                <div class="col-1 mt-2">
                                                    <label class="form-check-image active">


                                                        <div class="form-check form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="radio" value="1"
                                                                name="riwayat_imunisasi" />
                                                            <div class="form-check-label">
                                                                TT1
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                                <!--end::Col-->

                                                <!--begin::Col-->
                                                <div class="col-1 mt-2">
                                                    <label class="form-check-image">

                                                        <div class="form-check form-check-custom form-check-solid me-10">
                                                            <input class="form-check-input" type="radio" value="1"
                                                                name="riwayat_imunisasi" />
                                                            <div class="form-check-label">
                                                                TT2
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="separator separator-dashed border-secondary mb-5"></div>
                                            <div class="row mt-5">
                                                <div class="col-md-2">
                                                    <label>Gerakan Janin Pertama</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="input-group mb-5">
                                                        <input type="text" name="gerakan_janin_pertama"
                                                            class="form-control" aria-describedby="basic-addon2" />
                                                        <span class="input-group-text" id="basic-addon2">Bulan</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="separator separator-dashed border-secondary mb-5"></div>
                                            <div class="row mt-5">
                                                <div class="col-md-2">
                                                    <label>Gerakan Janin Terakhir</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="input-group mb-5">
                                                        <input type="text" name="gerakan_janin_terakhir"
                                                            class="form-control" aria-describedby="basic-addon2" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="separator separator-dashed border-secondary mb-5"></div>
                                            <div class="row mt-5">
                                                <div class="col-md-2">
                                                    <label>Tanda bahaya dan penyulit kehamilan</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="input-group mb-5">
                                                        <input type="text" name="penyulit_kehamilan"
                                                            class="form-control" aria-describedby="basic-addon2" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="separator separator-dashed border-secondary mb-5"></div>
                                            <div class="row mt-5">
                                                <div class="col-md-2">
                                                    <label>Obat / Jamu yang pernah dan sedang
                                                        dikonsumsi</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="input-group mb-5">
                                                        <input type="text" name="obat_jamu_konsumsi"
                                                            class="form-control" aria-describedby="basic-addon2" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="separator separator-dashed border-secondary mb-5"></div>
                                            <div class="row mt-5">
                                                <div class="col-md-2">
                                                    <label>Keluhan BAK</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="input-group mb-5">
                                                        <input type="text" name="keluhan_bak" class="form-control"
                                                            aria-describedby="basic-addon2" />
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>Keluhan BAB</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="input-group mb-5">
                                                        <input type="text" name="keluhan_bab" class="form-control"
                                                            aria-describedby="basic-addon2" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="separator separator-dashed border-secondary mb-5"></div>
                                            <div class="row mt-5">
                                                <div class="col-md-2">
                                                    <label>Kekhawatiran Khusus</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="input-group mb-5">
                                                        <input type="text" name="kekhawatiran_khusus"
                                                            class="form-control" aria-describedby="basic-addon2" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="fw-row mb-5">
                                            <label class="form-label">4. Riwayat Kehamilan</label>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="input-group mb-5">
                                                        <span class="input-group-text" id="basic-addon1">G</span>
                                                        <input type="text" class="form-control" placeholder="G"
                                                            name="g" aria-label="G"
                                                            aria-describedby="basic-addon1" />
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="input-group mb-5">
                                                        <span class="input-group-text" id="basic-addon1">P</span>
                                                        <input type="text" class="form-control" placeholder="P"
                                                            name="p" aria-label="P"
                                                            aria-describedby="basic-addon1" />
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="input-group mb-5">
                                                        <span class="input-group-text" id="basic-addon1">A</span>
                                                        <input type="text" class="form-control" placeholder="A"
                                                            name="a" aria-label="A"
                                                            aria-describedby="basic-addon1" />
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="input-group mb-5">
                                                        <span class="input-group-text" id="basic-addon1">Hidup</span>
                                                        <input type="text" class="form-control" placeholder="Hidup"
                                                            name="hidup" aria-label="Hidup"
                                                            aria-describedby="basic-addon1" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="fw-row mb-5">
                                            <label class="form-label">5. Riwayat penyakit yang pernah
                                                diderita/operasi</label>
                                            <textarea name="riwayat_penyakit_operasi" id="riwayat_penyakit_operasi" class="form-control" data-kt-autosize="true"
                                                rows=2></textarea>
                                        </div>
                                        <div class="fw-row mb-5">
                                            <label class="form-label">6. Riwayat penyakit keluarga</label>
                                            <textarea name="riwayat_penyakit_keluarga" id="riwayat_penyakit_keluarga" class="form-control"
                                                data-kt-autosize="true" rows=2></textarea>
                                        </div>
                                        <div class="fw-row mb-5">
                                            <label class="form-label">7. Status Perkawinan</label>
                                            <textarea name="status_perkawinan" id="status_perkawinan" class="form-control" data-kt-autosize="true" rows=2></textarea>
                                        </div>
                                        <div class="fw-row mb-5">
                                            <label class="form-label">8. Riwayat psikososial
                                                ekonomi</label>
                                            <textarea name="riwayat_psikososial_ekonomi" id="riwayat_psikososial_ekonomi" class="form-control"
                                                data-kt-autosize="true" rows=2></textarea>
                                        </div>
                                        <div class="fw-row mb-5">
                                            <label class="form-label">9. Riwayat KB dan Rencana KB</label>
                                            <textarea name="riwayat_dan_rencana_kb" id="riwayat_dan_rencana_kb" class="form-control" data-kt-autosize="true"
                                                rows=2></textarea>
                                        </div>
                                        <div class="fw-row mb-5">
                                            <label class="form-label">10. Riwayat Ginekologi</label>
                                            <textarea name="riwayat_ginekologi" id="riwayat_ginekologi" class="form-control" data-kt-autosize="true" rows=2></textarea>
                                        </div>
                                        <div class="fw-row mb-5">
                                            <label class="form-label">11. Pola
                                                makan/minum/eliminasi/istirahat</label>
                                            <textarea name="pola_makan" id="pola_makan" class="form-control" data-kt-autosize="true" rows=2></textarea>
                                        </div>
                                        <div class="fw-row mb-5">
                                            <button type="submit" id="btn-simpan-kebidanan"
                                                class="btn btn-primary">Simpan</button>
                                            <a href="{{ route('detail.rawat-inap', $rawat->id) }}"
                                                class="btn btn-secondary">Kembali</a>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="kt_tab_pane_objektif" role="tabpanel">
                                    <h5>Data Objektif</h5>
                                </div>
                            </div>
                        </div>
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
        $(function() {
            //onclick
            $("#frmKebidanan").on("submit", function(event) {
                event.preventDefault();
                var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
                Swal.fire({
                    title: 'Yakin Simpan Data?',
                    text: "Simpan Data? ",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
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
