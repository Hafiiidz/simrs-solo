<table id='list_rujukan_bpjs' class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>No.Rujukan</th>
            <th>Tgl.Rujukan</th>
            <th>PPK Perujuk</th>
            <th>Sub/Spesialis</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($response['response']['rujukan'] as $r)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-light btn-norujukan" data-poli="{{ $r['poliRujukan']['kode'] }}"
                        data-id="{{ $r['noKunjungan'] }}">{{ $r['noKunjungan'] }}</button>
                </td>
                <td>{{ $r['tglKunjungan'] }}</td>
                <td>{{ $r['peserta']['provUmum']['nmProvider'] }}</td>
                <td>{{ $r['poliRujukan']['nama'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $('.btn-norujukan').on('click', function() {
        var rujukan = $(this).data('id');
        var kode_poli = $(this).data('poli');
        var faskes = $('#faskes').val();
        $.ajax({
            url: '{{ route('pilih-rujukan-faskes') }}',
            type: 'GET',
            data: {
                rujukan: rujukan,
                kode_poli: kode_poli,
                faskes: faskes
            },
            beforeSend: function() {
                $.blockUI({
                    message: '<i class="fa fa-spinner fa-spin"></i> Loading ...',
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
                $.unblockUI();
                console.log(response)
                if (response.status === 'failed') {
                    toastr.error(response.message);
                } else {
                    if(response.keterangan != null){
                        toastr.success(response.keterangan);
                        $('#list_data_rujukan').empty();
                        $('#list_data_rujukan').html(response.data);
                    }
                   
                }
            },
            error: function(xhr, status, error) {
                $.unblockUI();
                toastr.error(xhr.responseJSON.message || error);
               
            }
        });
    })
</script>
