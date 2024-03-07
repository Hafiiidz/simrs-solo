<div class="modal-header">
    <h3 class="modal-title">Edit </h3>
    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
        <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
    </div>
</div>

<div class="modal-body">
    <div class="card card-bordered">
        <div class="card-body">
            <form action="{{ route('post_edit_implementasi.rawat-inap',$implementasi->id) }}" method="post" id='frmEditImplementasi'>
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Jam</label>
                            </div>
                            <div class="col-md-4">
                                <input type="time" value="{{ date('H:i',strtotime($implementasi->jam)) }}" name="jam" class="form-control"
                                    id="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-5">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Implementasi Keperawatan</label>
                            </div>
                            <div class="col-md-8">
                                <textarea name="implementasi" dt-auto class="form-control" id="">{{ $implementasi->implementasi }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-success mt-5 ">Update</button>
            </form>
        </div>
    </div>
</div>
<script>
    $("#frmEditImplementasi").on("submit", function(event) {
        event.preventDefault();
        var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
        Swal.fire({
            title: 'Simpan Data?',
            text: "Simpan Data?",
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
</script>
