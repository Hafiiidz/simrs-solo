<div class="modal-header">
    <h3 class="modal-title">Jadwal Dokter BPJS</h3>
</div>
<div class="modal-body">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Dokter</th>
                <th>Poli</th>
                <th>Jadwal</th>
                <th>Kapasitas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results['response'] as $r)
            <tr>
                <td>{{ $r['namadokter'] }} ({{ $r['kodedokter'] }})</td>                
                <td>{{ $r['namapoli'] }}</td>
                <td>{{ $r['jadwal'] }}</td>
                <td>{{ $r['kapasitaspasien'] }}</td>
                <td>
                    <button type="button" class="btn btn-light btn-pilih-dokter" data-id="{{ $r['kodedokter'] }}">Pilih</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="modal-footer"></div>
<script>
    $('.btn-pilih-dokter').on('click',function(){
        var iddokter = $(this).data('id');
        $.ajax({
                url: '{{ route('get-pilih-dokter',2) }}',
                type: 'GET',
                data: {
                    iddokter: iddokter,
                },

                success: function(response) {
                    console.log(response);
                    if (response.status === 'failed') {
                        toastr.error('Server Error');
                    } else {
                        toastr.success('Dokter Berhasil dipilih');
                        $('#dokter').val(response.data.nama_dokter)
                        $('#iddokter').val(response.data.iddokter)
                        $('#modal-dokter').modal('hide');
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error(xhr.responseJSON.message || error);
                }
            });
    })
</script>