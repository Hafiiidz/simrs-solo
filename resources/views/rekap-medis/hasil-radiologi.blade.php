<div class="modal-header">
    <h3 class="modal-title">Pemeriksaan Radiologi {{ $tindakan->nama_tindakan }}</h3>
    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
        <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
    </div>
</div>
<div class="modal-body">
    <label for="">
        <b>Klinis</b>
    </label>
    <div class="card card-bordered mt-2 mb-2">
        <div class="card-body fs-5">
            {{ $detail->klinis }}
        </div>
    </div>

    <label for="">
        <b>Hasil</b>
    </label>
    <div class="card card-bordered mt-2 mb-2">
        <div class="card-body fs-5">
            {{ $detail->hasil }}
        </div>
    </div>

    <label for="">
        <b>Kesan</b>
    </label>
    <div class="card card-bordered mt-2 mb-2">
        <div class="card-body fs-5">
            {{ $detail->kesan }}
        </div>
    </div>
    
    <div class="separator separator-dashed border-secondary mt-5 mb-5"></div>

    <label for=""> Foto </label>
    @foreach ($foto as $f)
    <div class="card card-bordered mt-2 mb-2">
        <div class="card-body fs-5">
            <img src="{{ asset('storage/foto-rad/'.$f->foto) }}" alt="">
        </div>
    </div>
    @endforeach
</div>