<div class="mb-2 fv-row">
    <label for="">No.Rujukan</label>
    <input type="text" name="no_rujukan" value="{{ $get_rujukan['response']['rujukan']['noKunjungan'] }}" class="form-control form-control-solid" readonly id="no_rujukan">
</div>
<div class="mb-2 fv-row">
    <label for="">Asal Rujukan</label>
    <input type="hidden" name="kode_faskes" value="{{ $get_rujukan['response']['rujukan']['provPerujuk']['kode'] }}" class="form-control form-control-solid" readonly">
    <input type="text" name=""  value="{{ $get_rujukan['response']['rujukan']['provPerujuk']['nama'] }}"  class="form-control form-control-solid" readonly id="asal_rujukan">
</div>
<div class="mb-2 fv-row">
    <label class="required" for="">Diagnosa</label>
    <label for="">Diagnosa ICD X</label>
    <select class="js-data-example-ajax form-select form-select-sm" name="icdx"></select>
    <input type="hidden" name="kode"
        value="{{ $get_rujukan['response']['rujukan']['diagnosa']['kode'] . ' - ' . $get_rujukan['response']['rujukan']['diagnosa']['nama'] }}"
        id="kode_diagnosa">
</div>
<div class="mb-2 fv-row">
    <label class="required" for="">Status Kecelakaan</label>
    <select class="form-select " name="status_kecelakaan" id="cbstatuskll">
        <option value="-">-- Silahkan Pilih --</option>
        <option value="0" title="Kasus bukan akibat kecelakaan lalu lintas dan kerja">Bukan Kecelakaan</option>
        <option value="1" title="Kasus KLL Tidak Berhubungan dengan Pekerjaan">Kecelakaan Lalu Lintas dan Bukan
            Kecelakaan Kerja</option>
        <option value="2"
            title="1).Kasus KLL Berhubungan dengan Pekerjaan. 2).Kasus KLL Berangkat dari Rumah menuju tempat Kerja. 3).Kasus KLL Berangkat dari tempat Kerja menuju rumah.">
            Kecelakaan Lalu Lintas dan Kecelakaan Kerja
        </option>
        <option value="3"
            title="1).Kasus Kecelakaan Berhubungan dengan pekerjaan. 2).Kasus terjadi di tempat kerja.Kasus terjadi pada saat kerja.">
            Kecelakaan Kerja
        </option>
    </select>
</div>
{{-- <input type="hidden" value=1 id="is_rujukan"> --}}

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