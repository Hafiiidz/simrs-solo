<div class="modal-header">
    <h3 class="modal-title">Pemeriksaan Lab {{ $detail->nama_pemeriksaan }}</h3>
    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
        <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
    </div>
</div>
    
<div class="modal-body">
    <div class="card card-bordered">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Nilai</th>
                        <th>Satuan</th>
                        <th>Nilai Rujukan</th>
                    </tr>
                </thead>
                <tbody>
        
                    @foreach ($lab_form as $lf)
                        <tr>
                            <td>{{ $lf->item }}</td>
                            <td>
                                {{ $lf->hasil }}
                            </td>
                            <td>{{ $lf->satuan }}</td>
                            <td>{{ $lf->nilai_rujukan }}</td>
                        </tr>
                    @endforeach
                </tbody>
        </div>
    </div>
</div>