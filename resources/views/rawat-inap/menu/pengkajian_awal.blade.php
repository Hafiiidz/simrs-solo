<form action="" id='frm_pengkajian' class="mt-5" method="post">
    @csrf
    <div class="row mb-5">
        <div class="col-md-2">
            <label class="form-label">Anamnesa</label>
        </div>
        <div class="col-md-8">
            <div class="d-flex justify-content-start">
                <div class="form-check form-check-custom form-check-solid">
                    <input class="form-check-input" type="radio" value="Autoanamnesa" id="anamnesa-1" name="anamnesa_1" />
                    <label class="form-check-label" for="flexRadioDefault">
                        Autoanamnesa
                    </label>
                </div>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <div class="form-check form-check-custom form-check-solid">
                    <input class="form-check-input" type="radio" value="0" id="anamnesa-1" name="anamnesa_1" />
                    <label class="form-check-label" for="flexRadioDefault">
                        Alloanamnesa
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <label class="form-label fw-bold">Keluhan Utama</label>
            <textarea name="rwt_penyakit_sekarang" rows="3" class="form-control" placeholder="Keluhan Utama"></textarea>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <label class="form-label fw-bold"></label>
            <textarea name="rwt_penyakit_sekarang" rows="3" class="form-control" placeholder="Keluhan Utama"></textarea>
        </div>
    </div>
</form>
