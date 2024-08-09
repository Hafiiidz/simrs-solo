<div class="alert rujukan_kontrol alert-dismissible bg-success d-flex flex-column flex-sm-row w-100 p-5 mb-5">
    <!--begin::Icon-->
    <i class="ki-duotone ki-search-list fs-2hx text-light me-4 mb-5 mb-sm-0"><span class="path1"></span><span
            class="path2"></span><span class="path3"></span></i> <!--end::Icon-->

    <!--begin::Content-->
    <div class="d-flex flex-column text-light pe-0 pe-sm-10">
        <h4 class="mb-2 text-light">Perhatian</h4>
        <span>{{ $keterangan }}</span>
    </div>
</div>
<div class="mb-2 fv-row mt-5">
    <label class="required" for="">No.Rujukan</label>
    <input type="text" name="no_rujukan" value="{{ $request['rujukan'] }}" class="form-control form-control-solid"
        readonly id="no_rujukan">
</div>
<div class="mb-2 fv-row">
    <label class="required" for="">Asal Rujukan</label>
    <input type="text" name=""
        value="{{ $get_rujukan['response']['rujukan']['peserta']['provUmum']['nmProvider'] }}"
        class="form-control form-control-solid" readonly>
    <input type="hidden" name="kode_faskes" value="{{ $get_rujukan['response']['rujukan']['peserta']['provUmum']['kdProvider'] }}" id="kode_faskes">
    <input type="hidden" name="kunjungan" value="3" id="kunjungan">
</div>
<div class="mb-2 fv-row">
    <label class="required" for="">Diagnosa</label>
    {{-- <input type="text" name="diagnosa" value="{{ $get_rujukan['response']['rujukan']['diagnosa']['nama'] }}"
        class="form-control form-control-solid" readonly id="diagnosa">
    <input type="hidden" name="kode" value="{{ $get_rujukan['response']['rujukan']['diagnosa']['kode'] }}"
        class="form-control form-control-solid" readonly id="kode_diagnosa"> --}}
        <label for="">Diagnosa ICD X</label>
        <select class="js-data-example-ajax form-select form-select-sm" name="icdx"></select>
        <input type="hidden" name="kode" value="{{ $get_rujukan['response']['rujukan']['diagnosa']['kode'].' - '.$get_rujukan['response']['rujukan']['diagnosa']['nama'] }}" id="kode_diagnosa">
</div>
<div class="mb-2 fv-row rujukan_kontrol">
    
    <label class="required" for="">No.Surat Kontrol/SKDP</label>
    <div class="input-group">
        <input type="text" name="no_surat" value="" class="form-control form-control-solid" readonly required id="no_surat">
        <button class="btn btn-sm btn-primary"  type="button" id="btn-cari-no-surat">
            <span class="indicator-label">
                Cari
            </span>
            <span class="indicator-progress">
                Harap Tunggu <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
            </span>
        </button>
    </div>
</div>
<div class="mb-2 fv-row rujukan_kontrol">
    <label class="required" for="">DPJP Pemberi Surat SKDP/SPRI </label>
    <input type="text" name="txtnmdpjp" value="" class="form-control form-control-solid" readonly
        id="txtnmdpjp">
    <input type="hidden" name="txtkddpjp" value="" class="form-control form-control-solid" readonly
        id="txtkddpjp">
</div>
<div class="mb-2 fv-row">
    <label class="required" for="">Status Kecelakaan</label>
    <select class="form-select " name="status_kecelakaan" id="cbstatuskll">
        <option value="-">-- Silahkan Pilih --</option>
        <option value="0" title="Kasus bukan akibat kecelakaan lalu lintas dan kerja">Bukan Kecelakaan</option>
        <option value="1" title="Kasus KLL Tidak Berhubungan dengan Pekerjaan">Kecelakaan LaluLintas dan Bukan
            Kecelakaan Kerja</option>
        <option value="2"
            title="1).Kasus KLL Berhubungan dengan Pekerjaan. 2).Kasus KLL Berangkat dari Rumah menuju tempat Kerja. 3).Kasus KLL Berangkat dari tempat Kerja menuju rumah.">
            Kecelakaan LaluLintas dan Kecelakaan Kerja
        </option>
        <option value="3"
            title="1).Kasus Kecelakaan Berhubungan dengan pekerjaan. 2).Kasus terjadi di tempat kerja.Kasus terjadi pada saat kerja.">
            Kecelakaan Kerja
        </option>
    </select>
</div>
<input type="hidden" value=1 id="is_rujukan">
<script>
    var button = document.querySelector("#btn-cari-no-surat");

    // Handle the click event for the button
    button.addEventListener("click", function() {
        // Activate indicator
        button.setAttribute("data-kt-indicator", "on");

        var no_kartu = "{{  $get_rujukan['response']['rujukan']['peserta']['noKartu'] }}";        
        // Make AJAX request
        $.ajax({
            url: '{{ route('get-surat-kontrol') }}',
            type: 'GET',
            data: {
                no_kartu: no_kartu,
            },
            success: function(response) {
                // Display the result
                console.log(response);
                $('#modal-hasil').html(response);
                $('#modal-dokter').modal('show');
                // // Disable indicator after successful response
                button.removeAttribute("data-kt-indicator");
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + error);

                // Disable indicator after error response
                button.removeAttribute("data-kt-indicator");
            }
        });

        // Optionally, disable the indicator after a fixed time regardless of AJAX response
        // setTimeout(function() {
        //     button.removeAttribute("data-kt-indicator");
        // }, 3000);
    });
</script>
<script>
    $('.js-data-example-ajax').select2({
        ajax: {
            url: 'https://new-simrs.rsausulaiman.com/auth/listdiagnosa2',
            dataType: 'json',
            delay: 250,
            data: function(params) {

                return {
                    q: params.term, // search term
                };
            },
            processResults: function(data) {
                return {
                    results: data.result.map(function(user) {
                        return {
                            id: user.id,
                            text: user.text
                        };
                    })
                };
            },
            cache: true
        },
        minimumInputLength: 1,
        placeholder: '{{ $get_rujukan['response']['rujukan']['diagnosa']['kode']." - ".$get_rujukan['response']['rujukan']['diagnosa']['nama'] }}'
    
    });
</script>
