<div class="modal-header">
    <h3 class="modal-title">Edit {{ $obat->nama_obat }}</h3>
    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
        <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
    </div>
</div>

<div class="modal-body">
    <div class="card card-bordered">
        <div class="card-body">
            <form action="{{ route('farmasi.edit-obat-farmasi') }}" method="post" id='frmEditObat'>
                @csrf
                <div class="mb-10">
                    <input type="hidden" name='resep_asal' value="{{ $resep->id }}">
                    <label for="nama_obat" class="form-label
                    required">Nama Obat</label>
                    <select name="id_data_obat" class="form-select" data-placeholder="Select an option"
                        data-control="select2" id="id_data_obat">
                        <option value=""></option>
                        @foreach ($list_obat as $item)
                            <option value="{{ $item->id }}" {{ $item->id == $resep->idobat ? 'selected' : '' }}>
                                {{ $item->nama_obat }}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-success mt-5 ">Update</button>
            </form>
        </div>
    </div>
</div>

<script>
    $("#frmEditObat").on("submit", function(event) {
        event.preventDefault();
        var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
        Swal.fire({
            title: 'Edit Obat',
            text: "Apakah Anda yakin akan edit obat ini ?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Edit',
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
    $('#id_data_obat').select2({
        dropdownParent: $('#modal_lihat')
    });
</script>
