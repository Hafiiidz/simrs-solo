
@foreach ($response['response']['rujukan'] as $r)
    <div class="d-flex flex-stack  px-0">
        <!--begin::Symbol-->
        <div class="symbol symbol-40px me-4">
        </div>
        <!--end::Symbol-->

        <!--begin::Section-->
        <div class="d-flex align-items-center flex-row-fluid flex-wrap">
            <!--begin:Author-->
            <div class="flex-grow-1 me-2">
                <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bold">No.Rujukan:
                    {{ $r['noKunjungan'] }}</a>
                <span class="text-muted fw-semibold d-block fs-7">Tgl.Rujukan: {{ $r['tglKunjungan'] }}</span>
                <span class="text-muted fw-semibold d-block fs-7">PPK Perujuk:
                    {{ $r['peserta']['provUmum']['nmProvider'] }}</span>
                <span class="text-muted fw-semibold d-block fs-7">Sub/Spesialis: {{ $r['poliRujukan']['nama'] }}</span>
            </div>
            <!--end:Author-->

            <!--begin::Actions-->
            <button type="button"
                class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px btn-norujukan"
                data-poli="{{ $r['poliRujukan']['kode'] }}" data-id="{{ $r['noKunjungan'] }}">
                <i class="ki-duotone ki-arrow-right fs-2"><span class="path1"></span><span class="path2"></span></i>
            </button>
            <!--end::Actions-->
        </div>
        <!--end::Section-->
    </div>
    <div class="separator separator-dashed my-4"></div>
@endforeach
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
                $.unblockUI();
                console.log(response)
                if (response.status === 'failed') {
                    toastr.error(response.message);
                } else {
                    if (response.keterangan != null) {
                        toastr.success(response.keterangan);
                        $('#list_data_rujukan').empty();
                        $('#list_data_rujukan').html(response.data);
                        $('#jenis_rawat').val(1);
                        $('#kt_datepicker_1').val("{{ date('Y-m-d') }}");
                        $('#poli_rujukan').val(response.data_poli_tujuan.id);
                        $('#poli').html(response.data_poli);
                    }else{
                        toastr.success(response.keterangan);
                        $('#list_data_rujukan').empty();
                        $('#list_data_rujukan').html(response.data);
                        $('#poli_rujukan').val(response.data_poli_tujuan.id);
                        $('#jenis_rawat').val(1);
                        $('#kt_datepicker_1').val("{{ date('Y-m-d') }}");
                        $('#poli').html(response.data_poli);
                        $('#btn-cari-dokter').prop('disabled', false);
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
