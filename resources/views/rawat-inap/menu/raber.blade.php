<h3 class="mt-10 mb-5">List Raber</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama DPJP Raber</th>
            <th>Tgl Mulai</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list_raber as $rb)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $rb->nama_dokter }}</td>
                <td>{{ $rb->tgl_mulai }}</td>
                <td>
                    <a href="{{ route('detail.rawat-bersama',$rb->id) }}" class="btn btn-sm btn-success me-1">Lihat</a>
                    <a href="" class="btn btn-sm btn-danger">Hapus</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="modal fade" tabindex="-1" id="model_raber">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tambah Raber</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <form action="{{ route('post-raber', $rawat->id) }}" method="post" id='frmRaber'>
                    @csrf
                    <select class="form-select" data-control="select2"
                        data-dropdown-parent="#model_raber" data-placeholder="Select an option" data-allow-clear="true"
                        id="id_dokter" name="id_dokter">
                        <option value=""></option>
                        @foreach ($dokter_dpjp as $dpjp)
                            <option value="{{ $dpjp->id }}">{{ $dpjp->nama_dokter }}</option>
                        @endforeach
                    </select>
                    <br>
                    <button class="btn btn-primary btn-sm mt-10">Tambah Raber</button>
                </form>
            </div>

            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> --}}
        </div>
    </div>
</div>
