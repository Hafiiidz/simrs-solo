<div class="modal-header">
    <h3 class="modal-title">List Surat Kontrol</h3>
    
</div>
<div class="modal-body">
    <table class="table table-bordered">
        <thead>
            <tr class="fs-7">
                <th>No Surat Kontrol</th>
                <th>Jns Pelayanan</th>
                <th>Nama Dokter</th>
                <th>Tgl Rencana Kontrol</th>
                <th>No Sep Asal Kontrol</th>
                <th>Terbit SEP</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($response['response']['list'] as $list)
                <tr>
                    <td>
                        {{-- @if($list['terbitSEP'] != 'Sudah')
                        
                        @else
                        {{ $list['noSuratKontrol'] }}
                        @endif --}}
                        <button type="button" class="btn btn-light btn-pilih-nomor" 
                        data-tglsurat="{{ $list['tglRencanaKontrol'] }}"
                        data-id="{{ $list['noSuratKontrol'] }}"
                        data-dokter="{{ $list['kodeDokter'] }}"
                        data-poli="{{ $list['poliTujuan'] }}"
                        data-sep="{{ $list['noSepAsalKontrol'] }}"
                        >{{ $list['noSuratKontrol'] }}</button> 
                      
                    </td>
                    <td>{{ $list['jnsPelayanan'] }}</td>
                    <td>{{ $list['namaDokter'] }}</td>
                    <td>{{ $list['tglRencanaKontrol'] }}</td>
                    <td>{{ $list['noSepAsalKontrol'] }}</td>
                    <td>{{ $list['terbitSEP'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
    <button class="btn btn-success">Tambah Surat Kontrol</button>
</div>
<div class="modal-footer"></div>
<script>
    $('.btn-pilih-nomor').on('click',function(){
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
</script>