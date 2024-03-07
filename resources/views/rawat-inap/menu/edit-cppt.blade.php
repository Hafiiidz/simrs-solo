<div class="modal-header">
    <h3 class="modal-title">Edit </h3>
    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
        <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
    </div>
</div>

<div class="modal-body">
    <div class="card card-bordered">
        <div class="card-body">
            <form action="{{ route('post_edit_cppt.rawat-inap',$cppt->id) }}" method="post" id='frmEditCppt'>
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <label for=""> Profesi (PPA) </label>
                            </div>
                            <div class="col-md-8">
                                <select name="profesi" class="form-select" id="">
                                    <option value="">-- Profesi (PPA) -- </option>
                                    @foreach ($profesi as $pr)
                                        <option {{ $pr['value'] == $cppt->profesi ? 'selected' : '' }}
                                            value="{{ $pr['value'] }}">{{ $pr['value'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="row">
                        <div class="col-md-4">
                            Hasil Asesmen Pasien (SOAP)
                        </div>
                        <div class="col-md-2 text-center">S</div>
                        <div class="col-md-6">
                            <textarea rows=4 name="subjektif" class="form-control" id="">{{ $cppt->subjektif }}</textarea>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-2 text-center">O</div>
                        <div class="col-md-6">
                            <textarea rows=4 name="objektif" class="form-control" id="">{{ $cppt->objektif }}</textarea>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-2 text-center">A</div>
                        <div class="col-md-6">
                            <textarea rows=4 name="asesmen" class="form-control" id="">{{ $cppt->asesmen }}</textarea>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-2 text-center">P</div>
                        <div class="col-md-6">
                            <textarea rows=4 name="plan" class="form-control" id="">{{ $cppt->plan }}</textarea>
                        </div>
                    </div>
                </div>
                <button class="btn btn-success mt-5 ">Update</button>
            </form>
        </div>
    </div>
</div>
<script>
    $("#frmEditCppt").on("submit", function(event) {
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
