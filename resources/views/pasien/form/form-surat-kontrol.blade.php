<div class="row mt-10" id="buat-surat">
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead>
                <tr class="fs-7">
                    <th>No SEP</th>
                    <th>Tgl SEP</th>
                    <th>Kunjungan</th>
                    <th>Poli Tujuan</th>
                    <th>Diagnosa</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $sep['response']['noSep'] }}</td>
                    <td>{{ $sep['response']['tglSep'] }}</td>
                    <td>{{ $sep['response']['jnsPelayanan'] }}</td>
                    <td>{{ $sep['response']['poli'] }}</td>
                    <td>{{ $sep['response']['diagnosa'] }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-6">
        <form action="{{ route('pasien.post-surat-kontrol') }}" method="POST" id="form-crete-surat-kontrol">
            @csrf
            <div class="mb-3 fv-row">
                <label class="form-label required" for="">Poli Tujuan</label>
                <select name="poli_tujuan" class="form-select form-select-sm" id="poli_tujuan">
                    @foreach ($poli as $p)
                        <option value="{{ $p->id }}">{{ $p->poli }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 fv-row">
                <label for="dokter_kontrol" class="required form-label">Dokter</label>
                <input type="hidden" name='iddokter_kontrol' id='iddokter_kontrol'>
                <input type="hidden" name='tgl_kontrol' value="{{ date('Y-m-d') }}" id='tgl_kontrol'>
                <input type="hidden" name='no_sep' value="{{ $sep['response']['noSep'] }}" id='no_sep'>
                <div class="input-group fw-row">
                    <input type="text" name='dokter_kontrol' id='dokter_kontrol' readonly
                        class="form-control form-control-sm form-control" required>
                    <button class="btn btn-sm btn-success" type="button" id="btn-cari-dokter-kontrol">
                        <span class="indicator-label">
                            Cari
                        </span>
                        <span class="indicator-progress">
                            Harap Tunggu <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
            </div>

            <button type="button" id="btn-simpan-surat-kotnrol" class="btn btn-primary">Simpan Data</button>
        </form>
    </div>
    <div class="col-md-6">
        <div id="hasil-cari-dokter"></div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.btn-pilih-nomor').on('click', function() {
            $('#poli').empty();
            var no_surat = $(this).data('id');
            var dokter = $(this).data('dokter');
            var poli = $(this).data('poli');
            var tglsurat = $(this).data('tglsurat');
            var sep = $(this).data('sep');

            $.ajax({
                url: '{{ route('get-pilih-nomer') }}',
                type: 'GET',
                data: {
                    no_surat: no_surat,
                    dokter: dokter,
                    tglsurat: tglsurat,
                    poli: poli,
                    sep: sep
                },
                success: function(response) {
                    // Display the result
                    console.log(response);
                    $('#poli').html(response.data.poli_option);
                    $('#kt_datepicker_1').val(response.data.tgl_surat)
                    $('#jenis_rawat').val(1)
                    $('#iddokter').val(response.data.iddokter)
                    $('#dokter').val(response.data.nama_dokter)
                    $('#no_surat').val(response.data.no_surat)
                    $('#txtnmdpjp').val(response.data.nama_dpjp)
                    $('#txtkddpjp').val(response.data.kode_dokter)
                    $('#modal-hasil').empty();
                    $('#btn-cari-dokter').prop('disabled', false);
                    $('#modal-dokter').modal('hide');
                    toastr.warning(response.data.sep_asal_kontrol)
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + error);
                }
            });
        })
    });

    var buttoncaridokterkontrol = document.querySelector("#btn-cari-dokter-kontrol");
    // Handle the click event for the buttoncaridokterkontrol
    buttoncaridokterkontrol.addEventListener("click", function() {
        // Activate indicator
        buttoncaridokterkontrol.setAttribute("data-kt-indicator", "on");

        var tgl = "{{ date('Y-m-d') }}";
        var poli = $('#poli_tujuan').val();
        var penanggung = $('#penanggung').val();
        console.log(tgl);
        if (tgl == null || tgl == '') {
            toastr.error('Harap isi tanggal kunjungan terlebih dahulu');
            buttoncaridokterkontrol.removeAttribute(
                "data-kt-indicator"); // Disable indicator on validation error
            return false;
        }
        if (penanggung == null || penanggung == '') {
            toastr.error('Harap isi penanggung terlebih dahulu');
            buttoncaridokterkontrol.removeAttribute(
                "data-kt-indicator"); // Disable indicator on validation error
            return false;
        }
        // Make AJAX request
        $.ajax({
            url: '{{ route('get-jadwal-dokter-kontrol') }}',
            type: 'GET',
            data: {
                poli: poli,
                tgl: tgl,
                penanggung: penanggung
            },
            success: function(response) {
                // Display the result
                $('#hasil-cari-dokter').html(response);
                // Disable indicator after successful response
                buttoncaridokterkontrol.removeAttribute("data-kt-indicator");
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + error);
                toastr.error(xhr.responseJSON.message || error);
                // Disable indicator after error response
                buttoncaridokterkontrol.removeAttribute("data-kt-indicator");
            }
        });

        // Optionally, disable the indicator after a fixed time regardless of AJAX response
        // setTimeout(function() {
        //     button.removeAttribute("data-kt-indicator");
        // }, 3000);
    });



    // Define form element
    // const form_create_kontrol = document.getElementById('form-crete-surat-kontrol');

    // // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
    // var validator_create_kontrol = FormValidation.formValidation(
    //     form_create_kontrol, {
    //         fields: {
    //             'dokter_kontrol': {
    //                 validators: {
    //                     notEmpty: {
    //                         message: 'Dokter Harus Diisi'
    //                     }
    //                 }
    //             },
    //         },

    //         plugins: {
    //             trigger: new FormValidation.plugins.Trigger(),
    //             bootstrap: new FormValidation.plugins.Bootstrap5({
    //                 rowSelector: '.fv-row',
    //             })
    //         }
    //     }
    // );

    // // Submit button handler
    // const submitButton_create_kontrol = document.getElementById('btn-simpan-surat-kotnrol');
    // submitButton_create_kontrol.addEventListener('click', function(e) {
    //     // Prevent default button action
    //     e.preventDefault();

    //     // Validate form before submit
    //     if (validator_create_kontrol) {
    //         validator_create_kontrol.validate().then(function(status) {
    //             console.log('validated!');

    //             if (status == 'Valid') {
    //                 // Show loading indication
    //                 submitButton_create_kontrol.setAttribute('data-kt-indicator', 'on');

    //                 // Disable button to avoid multiple click
    //                 submitButton_create_kontrol.disabled = true;

    //                 // Simulate form submission. For more info check the plugin's official documentation: https://sweetalert2.github.io/

    //             }
    //         });
    //     }
    // });

    function initializeFormCreateKontrol() {
        const form_create_kontrol = document.getElementById('form-crete-surat-kontrol');
        const submitButton_create_kontrol = document.getElementById('btn-simpan-surat-kotnrol');

        // Init form validation rules
        const validator_create_kontrol = FormValidation.formValidation(
            form_create_kontrol, {
                fields: {
                    'dokter_kontrol': {
                        validators: {
                            notEmpty: {
                                message: 'Dokter Harus Diisi'
                            }
                        }
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                    })
                }
            }
        );

        // Submit button handler
        submitButton_create_kontrol.addEventListener('click', function(e) {
            // Prevent default button action
            e.preventDefault();

            // Validate form before submit
            if (validator_create_kontrol) {
                validator_create_kontrol.validate().then(function(status) {
                    console.log('validated!');

                    if (status == 'Valid') {
                        // Show loading indication
                        submitButton_create_kontrol.setAttribute('data-kt-indicator', 'on');

                        // Disable button to avoid multiple clicks
                        submitButton_create_kontrol.disabled = true;

                        var formDataFix2 = $(form_create_kontrol).serialize();

                        var url = form_create_kontrol.getAttribute('action');
                        var method = form_create_kontrol.getAttribute('method');
                        $.ajax({
                            type: method,
                            url: url, // Replace with your server endpoint
                            data: formDataFix2,
                            beforeSend: function() {
                                $('#kt_block_ui_4_target').block({
                                    message: '<i class="fa fa-spinner fa-spin"></i> Menyimpan Data ...',
                                    css: {
                                        border: 'none',
                                        padding: '15px',
                                        backgroundColor: '#000',
                                        '-webkit-border-radius': '10px',
                                        '-moz-border-radius': '10px',
                                        opacity: .5,
                                        color: '#fff'
                                    }
                                });
                            },
                            success: function(response) {
                                console.log(response);
                                if (response.status == 'success') {
                                    toastr.success(response.message);
                                    var newRow = `
                                    
                                    <tr>
                                        <td>
                                              <button type="button" class="btn btn-light btn-pilih-nomor"
                                                data-tglsurat="${response.data.tglRencanaKontrol}" data-id="${response.data.noSuratKontrol}"
                                                data-dokter="${response.dokter}" data-poli="${response.poli}"
                                                data-sep="${response.sep_asal}"
                                                data-nokartu="${response.data.noKartu}">${response.data.noSuratKontrol}</button>    
                                        </td>
                                        <td>Rawat Jalan</td>
                                        <td>${response.data.namaDokter}</td>
                                        <td>${response.data.tglRencanaKontrol}</td>
                                        <td>
                                          ${response.sep_asal}
                                        </td>
                                        <td>Belum</td>
                                    </tr>
                                `;
                                    $('#kontrol-table-body').prepend(newRow);
                                    $('#form-tambah').addClass('d-none');
                                    $('#kt_block_ui_4_target').unblock();
                                    $('#modal-dokter').modal('hide');


                                } else {
                                    toastr.error(response.message);
                                    $('#kt_block_ui_4_target').unblock();
                                }
                                submitButton_create_kontrol.disabled = false;
                            },
                            error: function(error) {
                                $('#kt_block_ui_4_target').unblock();
                                toastr.error(error);
                                console.log(
                                    'Error submitting form:',
                                    error);
                            }
                        });
                    }
                });
            }
        });
    }

    // Call the function to initialize
    initializeFormCreateKontrol();
</script>
