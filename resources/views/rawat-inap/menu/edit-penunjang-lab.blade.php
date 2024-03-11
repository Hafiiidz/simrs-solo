<div class="modal-header">
    <h3 class="modal-title">Edit </h3>
    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
        <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
    </div>
</div>

<div class="modal-body">
    <div class="card card-bordered">
        <div class="card-body">
            <form action="{{ route('post-ranap.update-lab',$penunjang->id) }}" method="post" id='frmEditlab2'>
                @csrf
                <div class="row mb-5">
                    <!--begin::Repeater-->
                    <div id="lab_edit_repeater">
                        <!--begin::Form group-->
                        <div class="form-group">
                            <div data-repeater-list="lab">
                                @foreach (json_decode($penunjang->pemeriksaan_penunjang) as $pp)
                                <div data-repeater-item>
                                    <div class="form-group row mb-5">
                                        <div class="col-md-6">
                                            <label class="form-label">Tindakan Lab</label>
                                            <select name="tindakan_lab" class="form-select"
                                                data-kt-repeater="select2lab" data-placeholder="-Pilih-"
                                                required>
                                                <option></option>
                                                @foreach ($lab as $l)
                                                    <option {{ $pp->tindakan_lab == $l->id ? 'selected':'' }} value="{{ $l->id }}">
                                                        {{ $l->nama_pemeriksaan }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <a href="javascript:;" data-repeater-delete
                                                class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                <i class="ki-duotone ki-trash fs-5"><span
                                                        class="path1"></span><span
                                                        class="path2"></span><span
                                                        class="path3"></span><span
                                                        class="path4"></span><span class="path5"></span></i>
                                                Hapus
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <!--end::Form group-->

                        <!--begin::Form group-->
                        <div class="form-group mt-5">
                            <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                <i class="ki-duotone ki-plus fs-3"></i>
                                Tambah Lab
                            </a>
                        </div>
                        <!--end::Form group-->
                    </div>
                    <!--end::Repeater-->
                </div>
                <button class="btn btn-success mt-5 ">Update</button>
            </form>
        </div>
    </div>
</div>
{{-- <script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script> --}}
<script>
    $('#lab_edit_repeater').repeater({
        initEmpty: false,

        show: function() {
            $(this).slideDown();

            $(this).find('[data-kt-repeater="select2lab"]').select2({
                allowClear: true,
                dropdownParent: $('#modal_lihat')
            });
        },

        hide: function(deleteElement) {
            $(this).slideUp(deleteElement);
        },

        ready: function() {
            $('[data-kt-repeater="select2lab"]').select2({
                allowClear: true,
                dropdownParent: $('#modal_lihat')
            });
        }
    });

    $("#frmEditlab2").on("submit", function(event) {
        event.preventDefault();
        var blockUI = new KTBlockUI(document.querySelector("#kt_app_body"));
        Swal.fire({
            title: 'Edit Data?',
            text: "Edit Data?",
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
