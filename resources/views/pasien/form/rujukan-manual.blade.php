<div class="mb-2 fv-row">
    <label for="">Diagnosa ICD X</label>
    <select class="js-data-example-ajax form-select form-select-sm" name="icdx"></select>
</div>
<div class="mb-2 fv-row">
    <label for="">Status Kecelakaan</label>
    <select class="form-select form-select-sm" name="status_kecelakaan" id="cbstatuskll">
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
        placeholder: 'Ketik Kode ICD X / Diagnosa ...'
    
    });
</script>
