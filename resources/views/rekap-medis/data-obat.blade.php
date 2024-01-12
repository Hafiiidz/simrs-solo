<div class="modal-header">
    <h3 class="modal-title">{{ $resep->nama_obat }}</h3>
    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
        <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
    </div>
</div>

<div class="modal-body">
    <div class="card card-bordered">
        <div class="card-body">
            @if ($resep->jenis == 'Racik')
                <form id='updRacikan' method="POST">
                    @csrf
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th rowspan="2" width=200>Dosis</th>
                                <th rowspan="2" width=100>Jumlah</th>
                                <th rowspan="2" width=50>Diberikan</th>
                                <th rowspan="2" width=100>Takaran</th>
                                <th width=50 colspan="4">Signa</th>
                                <th rowspan="2" width=100>Diminum</th>
                                <th rowspan="2" width=100>Catatan</th>
                            </tr>
                            <tr>
                                <th width=10>P</th>
                                <th width=10>S</th>
                                <th width=10>SO</th>
                                <th width=10>M</th>
                            </tr>
                        </thead>

                        <tbody>
                           
                            <tr>
                                <td>
                                    @foreach (json_decode($resep->jumlah) as $jumlah)
                                    @if($jumlah != null)
                                    <input type="number" id='jumlah_obat' name="jumlah_obat[]"
                                    value="{{ $jumlah }}" class="form-control form-control-sm mb-2 mb-md-0"
                                    min="0" required>
                                    @endif
                                    @endforeach
                                   
                                </td>
                                <td class="text-center align-middle">
                                    <input type="text" name='dosis_obat' value="{{ $resep->dosis }}" class="form-control form-control-sm">
                                </td class="text-center align-middle">
                                <td class="text-center align-middle">
                                    <input type="text" name="pemberian" required="" placeholder="" value="{{ $resep->diberikan }}"  class="form-control form-control-sm  mb-2 mb-md-0" min="0">
                                </td>
                                <td class="text-center align-middle">
                                    <select name="takaran_obat" id='takaran_obat' required
                                        class="form-select form-select-sm">
                                        <option value="">Pilih Takaran</option>
                                        @foreach ($takaran as $t)
                                            <option {{ $t == $resep->takaran ? 'selected' : '' }}
                                                value="{{ $t }}">{{ $t }}</option>
                                        @endforeach
                                    </select>

                                </td>
                                <td class="text-center align-middle"><input name="diminum[]"
                                        class="form-check-input form-check-input-sm"
                                        {{ App\Helpers\VclaimHelper::cek_signa($resep->signa, 'P') == true ? 'checked' : '' }}
                                        type="checkbox" value="P" id="flexCheckDefault" /></td>
                                <td class="text-center align-middle"><input class="form-check-input form-check-input-sm"
                                        type="checkbox"
                                        {{ App\Helpers\VclaimHelper::cek_signa($resep->signa, 'S') == true ? 'checked' : '' }}
                                        value="S" name="diminum[]" id="flexCheckDefault" /></td>
                                <td class="text-center align-middle"><input class="form-check-input form-check-input-sm"
                                        type="checkbox"
                                        {{ App\Helpers\VclaimHelper::cek_signa($resep->signa, 'SO') == true ? 'checked' : '' }}
                                        value="SO" name="diminum[]" id="flexCheckDefault" /></td>
                                <td class="text-center align-middle"><input class="form-check-input form-check-input-sm"
                                        type="checkbox"
                                        {{ App\Helpers\VclaimHelper::cek_signa($resep->signa, 'M') == true ? 'checked' : '' }}
                                        value="M" name="diminum[]" id="flexCheckDefault" /></td>
                                <td>
                                    <div class="form-check form-check-inline mb-2">
                                        <input class="form-check-input" type="radio"
                                            {{ $resep->diminum == 'sebelum' ? 'checked' : '' }} name="takaran"
                                            id="kapsul" value="sebelum">
                                        <label class="form-check-label" for="tablet">Sebelum</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input"
                                            {{ $resep->diminum == 'sesudah' ? 'checked' : '' }} type="radio"
                                            name="takaran" id="kapsul" value="sesudah">
                                        <label class="form-check-label" for="kapsul">Sesudah</label>
                                    </div>
                                </td>
                                <td>
                                    <input type="text" value="{{ $resep->catatan }}" name="catatan"
                                        class="form-control form-control-sm mb-2 mb-md-0" min="0">
                                </td>
                                <td>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="10">
                                    <button type="submit" class="btn btn-success"
                                        id='update-data'value="{{ $resep->id }}">Simpan</button>
                                </th>
                            </tr>
                           
                           
                </form>
                </tbody>

                </table>
                </form>
            @else
                <form id='updNonracikan' method="POST">
                    @csrf


                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th rowspan="2" width=100>Jumlah</th>
                                <th rowspan="2" width=100>Dosis</th>
                                <th rowspan="2" width=200>Takaran</th>
                                <th width=50 colspan="4">Signa</th>
                                <th rowspan="2" width=100>Diminum</th>
                                <th rowspan="2" width=100>Catatan</th>
                            </tr>
                            <tr>
                                <th width=10>P</th>
                                <th width=10>S</th>
                                <th width=10>SO</th>
                                <th width=10>M</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    <input type="number" id='jumlah_obat' name="jumlah_obat"
                                        value="{{ $resep->jumlah }}" class="form-control form-control-sm mb-2 mb-md-0"
                                        min="0" required>
                                </td>
                                <td>
                                    <input type="text" name="dosis_obat" placeholder="dosis"
                                        value="{{ $resep->dosis }}"
                                        class="form-control form-control-sm  mb-2 mb-md-0" min="0">
                                </td>
                                <td>
                                    <select name="takaran_obat" id='takaran_obat' required
                                        class="form-select form-select-sm">
                                        <option value="">Pilih Takaran</option>
                                        @foreach ($takaran as $t)
                                            <option {{ $t == $resep->takaran ? 'selected' : '' }}
                                                value="{{ $t }}">{{ $t }}</option>
                                        @endforeach
                                    </select>

                                </td>
                                <td class="text-center align-middle"><input name="diminum[]"
                                        class="form-check-input form-check-input-sm"
                                        {{ App\Helpers\VclaimHelper::cek_signa($resep->signa, 'P') == true ? 'checked' : '' }}
                                        type="checkbox" value="P" id="flexCheckDefault" /></td>
                                <td class="text-center align-middle"><input
                                        class="form-check-input form-check-input-sm" type="checkbox"
                                        {{ App\Helpers\VclaimHelper::cek_signa($resep->signa, 'S') == true ? 'checked' : '' }}
                                        value="S" name="diminum[]" id="flexCheckDefault" /></td>
                                <td class="text-center align-middle"><input
                                        class="form-check-input form-check-input-sm" type="checkbox"
                                        {{ App\Helpers\VclaimHelper::cek_signa($resep->signa, 'SO') == true ? 'checked' : '' }}
                                        value="SO" name="diminum[]" id="flexCheckDefault" /></td>
                                <td class="text-center align-middle"><input
                                        class="form-check-input form-check-input-sm" type="checkbox"
                                        {{ App\Helpers\VclaimHelper::cek_signa($resep->signa, 'M') == true ? 'checked' : '' }}
                                        value="M" name="diminum[]" id="flexCheckDefault" /></td>
                                <td>
                                    <div class="form-check form-check-inline mb-2">
                                        <input class="form-check-input" type="radio"
                                            {{ $resep->diminum == 'sebelum' ? 'checked' : '' }} name="takaran"
                                            id="kapsul" value="sebelum">
                                        <label class="form-check-label" for="tablet">Sebelum</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input"
                                            {{ $resep->diminum == 'sesudah' ? 'checked' : '' }} type="radio"
                                            name="takaran" id="kapsul" value="sesudah">
                                        <label class="form-check-label" for="kapsul">Sesudah</label>
                                    </div>
                                </td>
                                <td>
                                    <input type="text" value="{{ $resep->catatan }}" name="catatan"
                                        class="form-control form-control-sm mb-2 mb-md-0" min="0">
                                </td>
                                <td>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="10">
                                    <button type="submit" class="btn btn-success"
                                        id='update-data'value="{{ $resep->id }}">Simpan</button>
                                </th>
                            </tr>
                </form>
                </tbody>

                </table>
                </form>
            @endif

        </div>
    </div>
</div>
<script>
    $('#updNonracikan').on('submit', function(event) {
        const form = document.getElementById('updNonracikan');
        const submitButton = document.getElementById('update-data');
        var value = submitButton.value;
        event.preventDefault();
        $.ajax({
            url: "{{ route('update-resep-obat', '') }}" + "/" + value,
            method: "POST",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {

                submitButton.setAttribute('data-kt-indicator', 'on');
                submitButton.disabled = true;
            },
            success: function(data) {
                // console.log(data)
                submitButton.setAttribute('data-kt-indicator', 'off');
                submitButton.disabled = false;
                // $('#li' + value).remove();

                $('#li' + value).replaceWith(data.data);

                $("#modal_lihat").modal('hide');

                Swal.fire(
                    'Obat Tersimpan',
                    '',
                    'success'
                )

            }
        })

    });
    $('#updRacikan').on('submit', function(event) {
        const form = document.getElementById('updRacikan');
        const submitButton = document.getElementById('update-data');
        var value = submitButton.value;
        event.preventDefault();
        $.ajax({
            url: "{{ route('update-resep-obat', '') }}" + "/" + value,
            method: "POST",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {

                submitButton.setAttribute('data-kt-indicator', 'on');
                submitButton.disabled = true;
            },
            success: function(data) {
                console.log(data)
                submitButton.setAttribute('data-kt-indicator', 'off');
                submitButton.disabled = false;
                // $('#li' + value).remove();

                $('#li' + value).replaceWith(data.data);

                $("#modal_lihat").modal('hide');

                Swal.fire(
                    'Obat Tersimpan',
                    '',
                    'success'
                )

            }
        })

    });
</script>
