<form action="{{ route('postPemeriksaanFisik.rawat-inap',$rawat->id) }}" id='frmpemeriksaan_fisik' class="mt-5" method="post">
    @csrf
    @if(isset($raber))
        <input type="hidden" name="id_raber" value="{{ $raber->id }}">
    @endif
    <span class="d-inline-block position-relative mb-7">
        <!--begin::Label-->
        <span class="d-inline-block mb-2 fs-4 fw-bold">
            Anamnesa
        </span>
        <!--end::Label-->

        <!--begin::Line-->
        <span
            class="d-inline-block position-absolute h-5px bottom-0 end-0 start-0 bg-success translate rounded"></span>
        <!--end::Line-->
    </span>
    <div class="row mb-5">
        <div class="col-md-12">
            <label class="form-label fw-bold">Keluhan Utama</label>
            <textarea name="keluhan_utama" rows="3" class="form-control" {{ $disable }} placeholder="Keluhan Utama">{{ $anamnesa != null ? $anamnesa->keluhan_utama :'' }}</textarea>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <label class="form-label fw-bold">Riwayat Penyakit Sekarang</label>
            <textarea name="rwt_penyakit_sekarang" rows="3" class="form-control" {{ $disable }} placeholder="Riwayat Penyakit Sekarang">{{ $anamnesa != null ? $anamnesa->rwt_penyakit_sekarang:''}}</textarea>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <label class="form-label fw-bold">Riwayat Penyakit Dulu</label>
            <textarea name="rwt_penyakit_dulu" rows="3" class="form-control" {{ $disable }} placeholder="Riwayat Penyakit Dulu">{{ $anamnesa != null ? $anamnesa->rwt_penyakit_dulu:'' }}</textarea>
        </div>
    </div>
    <br>
    <span class="d-inline-block position-relative mb-7">
        <!--begin::Label-->
        <span class="d-inline-block mb-2 fs-4 fw-bold">
            Pemeriksaan Fisik
        </span>
        <!--end::Label-->

        <!--begin::Line-->
        <span
            class="d-inline-block position-absolute h-5px bottom-0 end-0 start-0 bg-success translate rounded"></span>
        <!--end::Line-->
    </span>
    <div class="row md-5">
        <div class="col-md-6">
            <label class="form-label">Kesadaran</label>
            <div class="input-group mb-5">
                <select name="kesadaran" {{ $disable }} class="form-select" required id="">
                    <option value="">--- Pilih ---</option>
                    @foreach ($kesadaran as $k)
                        <option {{ $pemeriksaan_fisik?->kesadaran == $k->kesadaran ? 'selected':'' }} value="{{ $k->kesadaran }}">{{ $k->kesadaran }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row md-5">
        <div class="col-md-3">
            <label class="form-label">Tekanan Darah</label>
            <div class="input-group mb-5">
                <input type="text" class="form-control" {{ $disable }} value="{{ $pemeriksaan_fisik?->tekanan_darah }}" name="tekanan_darah"
                    placeholder="...." aria-label="...." aria-describedby="tdarah" />
                <span class="input-group-text" id="tdarah">mmHg</span>
            </div>
        </div>
        <div class="col-md-3">
            <label class="form-label">Nadi</label>
            <div class="input-group mb-5">
                <input type="text" class="form-control" {{ $disable }} name="nadi" value="{{ $pemeriksaan_fisik?->nadi }}"
                    placeholder="...." aria-label="...." aria-describedby="nadi" />
                <span class="input-group-text" id="nadi">x/Menit</span>
            </div>
        </div>
        <div class="col-md-3">
            <label class="form-label">Pernapasan</label>
            <div class="input-group mb-5">
                <input type="text" class="form-control" {{ $disable }} value="{{ $pemeriksaan_fisik?->pernapasan }}" name="pernapasan"
                    placeholder="...." aria-label="...."
                    aria-describedby="pernapasan" />
                <span class="input-group-text" id="pernapasan">x/Menit</span>
            </div>
        </div>
        <div class="col-md-3">
            <label class="form-label">Suhu</label>
            <div class="input-group mb-5">
                <input type="text" class="form-control" {{ $disable }} value={{ $pemeriksaan_fisik?->suhu }} name="suhu"
                    placeholder="...." aria-label="...."
                    aria-describedby="suhu" />
                <span class="input-group-text" id="suhu">Derajat</span>
            </div>
        </div>
    </div>
    <div class="row md-5">
        <div class="col-md-12">
            <label class="form-label">Keadaan Umum</label>
            <textarea name="keadaan_umum" rows="3" class="form-control" {{ $disable }} placeholder="Keadaan Umum">{{ $pemeriksaan_fisik?->keadaan_umum }}</textarea>
        </div>
    </div>
    <div class="row md-5">
        <div class="col-md-12">
            <label class="form-label">Kepala</label>
            <textarea name="kepala" rows="3" class="form-control" {{ $disable }} placeholder="Kepala">{{ $pemeriksaan_fisik?->kepala }}</textarea>
        </div>
    </div>
    <div class="row md-5">
        <div class="col-md-12">
            <label class="form-label">Leher</label>
            <textarea name="leher" rows="3" class="form-control" {{ $disable }} placeholder="leher">{{ $pemeriksaan_fisik?->leher }}</textarea>
        </div>
    </div>
    <div class="row md-5">
        <div class="col-md-12">
            <label class="form-label">Paru</label>
            <textarea name="paru" rows="3" class="form-control" {{ $disable }} placeholder="paru">{{ $pemeriksaan_fisik?->paru }}</textarea>
        </div>
    </div>
    <div class="row md-5">
        <div class="col-md-12">
            <label class="form-label">Jantung</label>
            <textarea name="jantung" rows="3" class="form-control" {{ $disable }} placeholder="jantung">{{ $pemeriksaan_fisik?->jantung }}</textarea>
        </div>
    </div>
    <div class="row md-5">
        <div class="col-md-12">
            <label class="form-label">Abdomen</label>
            <textarea name="abdomen" rows="3" class="form-control" {{ $disable }} placeholder="Abdomen">{{ $pemeriksaan_fisik?->abdomen }}</textarea>
        </div>
    </div>
    <div class="row md-5">
        <div class="col-md-12">
            <label class="form-label">Kulit</label>
            <textarea name="kulit" rows="3" class="form-control" {{ $disable }} placeholder="Kulit">{{ $pemeriksaan_fisik?->kulit }}</textarea>
        </div>
    </div>
    <div class="row md-5">
        <div class="col-md-12">
            <label class="form-label">Extremitas</label>
            <textarea name="extremitas" rows="3" class="form-control" {{ $disable }} placeholder="Extremitas">{{ $pemeriksaan_fisik?->extremitas }}</textarea>
        </div>
    </div>
    <div class="row md-5 mb-5">
        <div class="col-md-12">
            <label class="form-label">Status neurologis</label>
            <textarea name="status_neurologis" rows="3" class="form-control" {{ $disable }} placeholder="Status neurologis">{{ $pemeriksaan_fisik?->status_neurologis }}</textarea>
        </div>
    </div>
    <button class="btn btn-primary" {{ $disable }}> Simpan </button>
</form>