<form action="{{ route('postRingkasanmasuk.rawat-inap',$rawat->id) }}" id='frm_pengkajian' class="mt-5" method="post">
    @csrf
    <span class="d-inline-block position-relative mb-7">
        <!--begin::Label-->
        <span class="d-inline-block mb-2 fs-4 fw-bold">
            Diagnosa
        </span>
        <!--end::Label-->

        <!--begin::Line-->
        <span
            class="d-inline-block position-absolute h-5px bottom-0 end-0 start-0 bg-success translate rounded"></span>
        <!--end::Line-->
    </span>
    <div class="row mb-5">
        <div class="col-md-12">
            <label class="form-label fw-bold">Penyakit Utama</label>
            <textarea name="penyakit_utama" rows="3" class="form-control" placeholder="Penyakit Utama"></textarea>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <div id="icdx_repeater">
                <!--begin::Form group-->
                <div class="form-group">
                    <div data-repeater-list="icdx">
                        <div data-repeater-item>
                            <div class="form-group row mb-5">
                                <div class="col-md-6">
                                    <label class="form-label">ICD X</label>
                                    <select name="diagnosa_icdx" class="form-select"
                                        data-kt-repeater="select222" data-placeholder="-Pilih-"
                                        required>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Jenis Diagnosa</label>
                                    <div class="input-group mb-5">
                                        <select name="jenis_diagnosa" class="form-select"
                                            id="">
                                            <option value="P">Primer</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <a href="javascript:;" data-repeater-delete
                                        class="btn btn-sm btn-light-danger mt-3 mt-md-8">
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
                    </div>
                </div>
                <!--end::Form group-->

                <!--begin::Form group-->
                <div class="form-group mt-5">
                    <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                        <i class="ki-duotone ki-plus fs-3"></i>
                        Tambah ICD X
                    </a>
                </div>
                <!--end::Form group-->
            </div>
        </div>
       
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <label class="form-label fw-bold">Penyakit Tambahan</label>
            <textarea name="penyakit_tambahan" rows="3" class="form-control" placeholder="Penyakit Tambahan"></textarea>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <div id="icdx_repeater_sekunder">
                <!--begin::Form group-->
                <div class="form-group">
                    <div data-repeater-list="icdx_sekunder">
                        <div data-repeater-item>
                            <div class="form-group row mb-5">
                                <div class="col-md-6">
                                    <label class="form-label">ICD X</label>
                                    <select name="diagnosa_icdx" class="form-select"
                                        data-kt-repeater="select2222" data-placeholder="-Pilih-"
                                        required>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Jenis Diagnosa</label>
                                    <div class="input-group mb-5">
                                        <select name="jenis_diagnosa" class="form-select"
                                            id="">
                                            <option value="S">Sekunder</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <a href="javascript:;" data-repeater-delete
                                        class="btn btn-sm btn-light-danger mt-3 mt-md-8">
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
                    </div>
                </div>
                <!--end::Form group-->

                
            </div>
        </div>
        <div class="col-md-12">
            <label class="form-label fw-bold">Diagnosa</label>

            <textarea name="diagnosa" rows="3" class="form-control" placeholder="..."></textarea>
        </div>
    </div>

    <span class="d-inline-block position-relative mb-7">
        <!--begin::Label-->
        <span class="d-inline-block mb-2 fs-4 fw-bold">
            Tindakan
        </span>
        <!--end::Label-->

        <!--begin::Line-->
        <span
            class="d-inline-block position-absolute h-5px bottom-0 end-0 start-0 bg-success translate rounded"></span>
        <!--end::Line-->
    </span>
    <div class="row mb-5">
        <div class="col-md-12">
            <div id="icd9_repeater">
                <!--begin::Form group-->
                <div class="form-group">
                    <div data-repeater-list="icd9">
                        <div data-repeater-item>
                            <div class="form-group row mb-5">
                                <div class="col-md-6">
                                    <label class="form-label">ICD 9</label>
                                    <select name="diagnosa_icdx" class="form-select"
                                        data-kt-repeater="select2icd9" data-placeholder="-Pilih-"
                                        required>
                                    </select>
                                </div>
                                

                                <div class="col-md-4">
                                    <a href="javascript:;" data-repeater-delete
                                        class="btn btn-sm btn-light-danger mt-3 mt-md-8">
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
                    </div>
                </div>
                <!--end::Form group-->

                <!--begin::Form group-->
                <div class="form-group mt-5">
                    <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                        <i class="ki-duotone ki-plus fs-3"></i>
                        Tambah ICD 9
                    </a>
                </div>
                <!--end::Form group-->
            </div>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <label class="form-label fw-bold">Tindakan</label>
            <textarea name="tindakan" rows="3" class="form-control" placeholder="Tindakan"></textarea>
        </div>
    </div>
    <button id='simpan_ringakasan_masuk' class="mt-5 btn btn-primary">Simpan</button>
</form>
