<div class="row mt-10">
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
        <form action="">
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
                <div class="input-group">
                    <input type="text" name='dokter_kontrol' id='dokter_kontrol' readonly
                        class="form-control form-control-sm form-control-solid" required>
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
        </form>
    </div>
    <div class="col-md-6">
        <div id="hasil-cari-dokter"></div>
    </div>
</div>

<script>
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
            buttoncaridokterkontrol.removeAttribute("data-kt-indicator"); // Disable indicator on validation error
            return false;
        }
        if (penanggung == null || penanggung == '') {
            toastr.error('Harap isi penanggung terlebih dahulu');
            buttoncaridokterkontrol.removeAttribute("data-kt-indicator"); // Disable indicator on validation error
            return false;
        }
        // Make AJAX request
        $.ajax({
            url: '{{ route('get-jadwal-dokter') }}',
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
</script>
