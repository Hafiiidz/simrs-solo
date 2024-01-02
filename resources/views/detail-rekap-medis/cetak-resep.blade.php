<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="row">
        <table class="table">
            <tr class="border">
                <td class="w-50" style="border: 1px solid black; text-align:center;">
                    <br>
                    <img width="100" src="data:image/png;base64, {!! base64_encode(file_get_contents(public_path('image/logosiswanto.png'))) !!} ">
                    <br>
                    RSAU DR SISWANTO <br>
                    JL TENTARA PELAJAR NO 1, MALANGJIWAN, COLOMADU 0271779112
                </td>
                <td class="w-75" style="border: 1px solid black;">
                    <div class="row p-1">
                        <div class="col-md-12">
                            <p><b>Identitas Pasien</b></p>
                        </div>
                    </div>
                    <div class="row p-1">
                        <table>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>{{ $data->rekapMedis->pasien->nama_pasien }}</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td>{{ $data->rekapMedis->pasien->jenis_kelamin == 'P' ? 'Perempuan' : 'Laki - Laki' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Tgl Lahir</td>
                                <td>:</td>
                                <td>{{ date('d-m-Y', strtotime($data->rekapMedis->pasien->tgllahir)) }}</td>
                                <td></td>
                                <td>Usia</td>
                                <td>:</td>
                                <td>{{ $rawat->pasien->usia_tahun }}Th {{ $rawat->pasien->usia_bulan }}Bln
                                    {{ $rawat->pasien->usia_hari }}Hr</td>
                            </tr>
                            <tr>
                                <td>No.RM</td>
                                <td>:</td>
                                <td>{{ $rawat->no_rm }}</td>
                            </tr>
                            <tr>
                                <td>Klinik</td>
                                <td>:</td>
                                <td>{{ $rawat->poli->poli }}</td>
                            </tr>
                            <tr>
                                <td>Dokter</td>
                                <td>:</td>
                                <td>{{ $rawat->dokter->nama_dokter }}</td>
                            </tr>
                            <tr>
                                <td>Penjamin</td>
                                <td>:</td>
                                <td>{{ $rawat->bayar->bayar }}</td>
                            </tr>
                            <tr>
                                <td>Tgl Registrasi</td>
                                <td>:</td>
                                <td>{{ date('d-m-Y', strtotime($data->rekapMedis->pasien->tgldaftar)) }}</td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="text-center" style="border: 1px solid black;">
                    <b style="text-transform:uppercase">RESEP</b>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="p-2" style="border: 1px solid black;">
                    <table class="table">
                        @foreach (json_decode($data->terapi_obat) as $val)
                                {{-- {{ dd($val->terapi_obat_racikan) }} --}}
                                <tr>
                                    <td>
                                        (@foreach ($val->terapi_obat_racikan as $data_obat)
                                            @foreach ($obat as $item)
                                                @if ($data_obat->obat == $item->id)
                                                {{ $item->nama_obat }} , {{ $data_obat->jumlah_obat }} {{ isset($data_obat->dosis_obat) ? $data_obat->dosis_obat : '' }}
                                                @endif
                                            @endforeach
                                        @endforeach) 
                                        <span class="text-end"> </span>
                                       
                                    </td>
                                    <td>{{ $val->signa1 }} - {{ $val->signa2 }} - {{ $val->signa3 }}</td>
                                </tr>
                            @endforeach
                        {{-- @foreach (json_decode($data->terapi_obat) as $val)
                            @foreach ($obat as $item)
                                @if ($val->obat == $item->id)
                                    <tr>
                                        <td class="text-start">R/ {{ $item->nama_obat }} <br>{{ $val->signa1 }} X
                                            {{ $val->signa2 }}</td>
                                        <td class="text-end">No. {{ $val->jumlah_obat }} </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach --}}
                    </table>
                </td>
            </tr>
            <tr>
                <td class="p-2" style="border: 1px solid black;">

                </td>
                <td class="p-2" style="border: 1px solid black; font-size:14; text-align:center;">
                    <p>Surakarta, {{ \Carbon\Carbon::now()->formatLocalized('%A, %d %B %Y') }}</p>
                    <p>DPJP</p>
                    <img src="data:image/png;base64, {!! base64_encode($qr) !!} ">
                    <p>{{ $rawat->dokter->nama_dokter }}</p>
                </td>
            </tr>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
