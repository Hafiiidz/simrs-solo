<div id="rujukan">
    <div class="row mb-5">
        <div class="col-md-3">
            <label class="form-label fw-bold">Tgl.Rujukan</label>
            <input type="date" class="form-control" name='tgl_rujuk' id='tgl_kontrol'>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <label class="form-label fw-bold">Tujuan Rujuk</label>
            <select name="tujuan_rujuk" class="form-select" id=""
                arial-placeholder="Rencana Tindak Lanjut">
                <option value="">Tujuan Rujuk</option>
                <option value="rslain">Rs Lain</option>
                
            </select>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <label class="form-label fw-bold">Poli Rujuk</label>
            <select name="poli_rujuk" data-control="select2" data-placeholder="Select an option" class="form-select" id=""
                arial-placeholder="Poli Rujuk">
                @foreach ($poli as $p)
                    <option value="{{ $p->id }}">{{ $p->poli }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>