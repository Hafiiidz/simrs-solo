<form action="{{ route('post-diagnosa-akhir.rawat-inap',$rawat->id) }}" method="post" id='frmDiagnosaAkhir'>
    @csrf
    <div class="row mb-5">
        <div class="col-md-12">
            <label for="">ICD 10 Akhir</label>
            <div id="dx_akhir_repeater">
                <!--begin::Form group-->
                <div class="form-group">
                    @if (isset($diagnosa_akhir))
                        @if ($diagnosa_akhir->icd10 != null)
                            <div data-repeater-list="icdx">
                                @foreach (json_decode($diagnosa_akhir->icd10) as $val2)
                                    <div data-repeater-item>
                                        <div class="form-group row mb-5">
                                            <div class="col-md-6">
                                                <label class="form-label">ICD X</label>
                                                <select name="diagnosa_icdx" class="form-select"
                                                    data-kt-repeater="select_dx_akhir" data-placeholder="-Pilih-"
                                                    required>
                                                    <option value="{{ $val2->diagnosa_icdx }}">
                                                        {{ $val2->diagnosa_icdx }}</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Jenis Diagnosa</label>
                                                <div class="input-group mb-5">
                                                    <select name="jenis_diagnosa" class="form-select" id="">
                                                        <option value="P">Primer</option>
                                                        <option value="S">Sekunder</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <a href="javascript:;" data-repeater-delete
                                                    class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                    <i class="ki-duotone ki-trash fs-5"><span
                                                            class="path1"></span><span class="path2"></span><span
                                                            class="path3"></span><span class="path4"></span><span
                                                            class="path5"></span></i>
                                                    Hapus
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div data-repeater-list="icdx">
                                <div data-repeater-item>
                                    <div class="form-group row mb-5">
                                        <div class="col-md-6">
                                            <label class="form-label">ICD X</label>
                                            <select name="diagnosa_icdx" class="form-select"
                                                data-kt-repeater="select_dx_akhir" data-placeholder="-Pilih-" required>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Jenis Diagnosa</label>
                                            <div class="input-group mb-5">
                                                <select name="jenis_diagnosa" class="form-select" id="">
                                                    <option value="P">Primer</option>
                                                    <option value="S">Sekunder</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <a href="javascript:;" data-repeater-delete
                                                class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span
                                                        class="path2"></span><span class="path3"></span><span
                                                        class="path4"></span><span class="path5"></span></i>
                                                Hapus
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <div data-repeater-list="icdx">
                            <div data-repeater-item>
                                <div class="form-group row mb-5">
                                    <div class="col-md-6">
                                        <label class="form-label">ICD X</label>
                                        <select name="diagnosa_icdx" class="form-select"
                                            data-kt-repeater="select_dx_akhir" data-placeholder="-Pilih-" required>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Jenis Diagnosa</label>
                                        <div class="input-group mb-5">
                                            <select name="jenis_diagnosa" class="form-select" id="">
                                                <option value="P">Primer</option>
                                                <option value="S">Sekunder</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <a href="javascript:;" data-repeater-delete
                                            class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                            <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span
                                                    class="path2"></span><span class="path3"></span><span
                                                    class="path4"></span><span class="path5"></span></i>
                                            Hapus
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif


                </div>
                <!--end::Form group-->

                <!--begin::Form group-->
                <div class="form-group mt-5">
                    <a href="javascript:;" {{ $disable }} data-repeater-create class="btn btn-light-primary">
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
            <label for="">ICD 9 Akhir</label>
            <div id="icd9_repeater_akhir">
                <!--begin::Form group-->
                <div class="form-group">
                    @if (isset($diagnosa_akhir))
                        @if ($diagnosa_akhir->icd9 != 'null')
                            <div data-repeater-list="icd9">
                                @foreach (json_decode($diagnosa_akhir->icd9) as $val)
                                    <div data-repeater-item>
                                        <div class="form-group row mb-5">
                                            <div class="col-md-6">
                                                <label class="form-label">ICD 9</label>
                                                <select name="diagnosa_icdx" class="form-select"
                                                    data-kt-repeater="select2_icd9_akhir" data-placeholder="-Pilih-"
                                                    required>
                                                    <option value="{{ $val->diagnosa_icdx }}">
                                                        {{ $val->diagnosa_icdx }}</option>
                                                </select>
                                            </div>


                                            <div class="col-md-4">
                                                <a href="javascript:;" data-repeater-delete
                                                    class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                    <i class="ki-duotone ki-trash fs-5"><span
                                                            class="path1"></span><span class="path2"></span><span
                                                            class="path3"></span><span class="path4"></span><span
                                                            class="path5"></span></i>
                                                    Hapus
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div data-repeater-list="icd9">
                                <div data-repeater-item>
                                    <div class="form-group row mb-5">
                                        <div class="col-md-6">
                                            <label class="form-label">ICD 9</label>
                                            <select name="diagnosa_icdx" class="form-select"
                                                data-kt-repeater="select2_icd9_akhir" data-placeholder="-Pilih-"
                                                required>
                                            </select>
                                        </div>


                                        <div class="col-md-4">
                                            <a href="javascript:;" data-repeater-delete
                                                class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span
                                                        class="path2"></span><span class="path3"></span><span
                                                        class="path4"></span><span class="path5"></span></i>
                                                Hapus
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <div data-repeater-list="icd9">
                            <div data-repeater-item>
                                <div class="form-group row mb-5">
                                    <div class="col-md-6">
                                        <label class="form-label">ICD 9</label>
                                        <select name="diagnosa_icdx" class="form-select"
                                            data-kt-repeater="select2_icd9_akhir" data-placeholder="-Pilih-" required>
                                        </select>
                                    </div>


                                    <div class="col-md-4">
                                        <a href="javascript:;" data-repeater-delete
                                            class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                            <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span
                                                    class="path2"></span><span class="path3"></span><span
                                                    class="path4"></span><span class="path5"></span></i>
                                            Hapus
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
                <!--end::Form group-->

                <!--begin::Form group-->
                <div class="form-group mt-5">
                    <a  href="javascript:;" data-repeater-create class="btn btn-light-primary ">
                        <i class="ki-duotone ki-plus fs-3"></i>
                        Tambah ICD 9
                    </a>
                </div>
                <!--end::Form group-->
            </div>
        </div>
    </div>
    <br>
    <button class="btn btn-success"  {{ $disable }}>Simpan</button>
</form>
