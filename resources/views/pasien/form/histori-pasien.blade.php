<div class="alert alert-primary d-flex align-items-center p-5 mb-10 mt-10">
    <i class="ki-duotone ki-shield-tick fs-2hx text-primary me-4"><span class="path1"></span><spanclass="path2"></span></i>
    <div class="d-flex flex-column">
        <h4 class="mb-1 text-primary">Silahkan Pilih SEP untuk dibuarkan surat kontrol</h4>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead>
                <tr class="fs-7">
                    <th>No SEP</th>
                    <th>Jenis Pelayanan</th>
                    <th>Diagnosa</th>
                    <th>Tgl SEP</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($getHistoriPelayananPeserta['response']['histori'] as $histori)
                    <tr>
                        <td>
                            <button class="btn btn-sm btn-primary btn-pilih-sep" data-id="{{ $histori['noSep'] }}">{{ $histori['noSep'] }}</button>
                        </td>
                        <td>{{ $histori['jnsPelayanan'] == 1 ? 'Rawat Inap' : 'Rawat Jalan' }}</td>
                        <td>{{ $histori['diagnosa'] }}</td>
                        <td>{{ $histori['tglSep'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
</div>
<script>
     $('.btn-pilih-sep').on('click', function() {
        var sep = $(this).data('id')
        $('#form-tambah').empty();
        $.ajax({
            url: '{{ route('data-kontrol-sep') }}',
            type: 'GET',
            data: {
                sep: sep,
            },
            beforeSend: function() {
                $('#kt_block_ui_4_target').block({
                    message: '<i class="fa fa-spinner fa-spin"></i> Mengambil data ke server BPJS ...',
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
                // console.log(response);
                toastr.success('Berhasil Pilih SEP');
                $('#form-tambah').html(response);
                $('#kt_block_ui_4_target').unblock();
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + error);
            }
        });
     });
</script>