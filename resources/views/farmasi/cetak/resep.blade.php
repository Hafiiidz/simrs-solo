<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <style>
            @page {
                margin-top: 10px;
                margin-bottom: 0px;
                margin-right: 10px;
                margin-left: 10px;
            }
            body {
                margin-top: 10px;
                margin-bottom: 0px;
                margin-right: 10px;
                margin-left: 10px;
                font-size: 10px;
                }
        </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <table>
                <tr>
                    <td rowspan="3"><img width="40" src="data:image/png;base64, {!! base64_encode(file_get_contents(public_path('image/logosiswanto.png'))) !!} "></td>
                    <td>FARMASI RSAU dr.SISWANTO</td>
                </tr>
                <tr>
                    <td><i>JL Tentara Pelajar No 1, Malangjiwan, Colomadu</i></td>
                </tr>
                <tr>
                    <td><i>Telepon 0271779112</i></td>
                </tr>
            </table>
        </div>
        <div class="row mt-2">
            <p>Rincian Resep</p>
        </div>
        <div class="row mt-2">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <td>Nama Pasien</td>
                        <td>:</td>
                        <td>{{ $pasien->nama_pasien }}</td>
                        <td>Usia</td>
                        <td>:</td>
                        <td>{{ $pasien->usia_tahun }}Th , {{ $pasien->usia_bulan }}Bln , {{ $pasien->usia_hari }}Hr
                        </td>
                    </tr>
                    <tr>
                        <td>No RM</td>
                        <td>:</td>
                        <td>{{ $pasien->no_rm }}</td>
                        <td>Tgl Lahir</td>
                        <td>:</td>
                        <td>{{ $pasien->tgllahir }}</td>
                    </tr>
                    <tr>
                        <td>No Resep</td>
                        <td>:</td>
                        <td>{{ $resep->kode_resep }}</td>
                        <td>Dokter</td>
                        <td>:</td>
                        <td>{{ $rawat->dokter?->nama_dokter }}</td>
                    </tr>
                    <tr>
                        <td>Tgl Resep</td>
                        <td>:</td>
                        <td>{{ $resep->tgl }}</td>
                        <td>Poli/Ruangan</td>
                        <td>:</td>
                        @if($rawat->idjenisrawat == 2)
                        <td>{{ $rawat->ruangan?->nama_ruangan }}</td>
                        @else
                        <td>Poli {{ $rawat->poli?->poli }}</td>
                        @endif
                       
                    </tr>
                </table>
            </div>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="border">
                                <th style="border: 1px solid black;" class="text-center">No</th>
                                <th style="border: 1px solid black;" class="text-center">Nama Obat (Merk)</th>
                                <th style="border: 1px solid black;" class="text-center">Qty</th>
                                <th style="border: 1px solid black;" class="text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detail_resep as $val)
                                <tr class="border">
                                    <td style="border: 1px solid black;" class="text-center">{{ $loop->iteration }}</td>
                                    <td style="border: 1px solid black;">{{ $val->nama_obat }}</td>
                                    <td style="border: 1px solid black;" class="text-center">{{ $val->qty }}</td>
                                    <td style="border: 1px solid black;" class="text-end">Rp.{{ number_format($val->total) }}</td>
                                </tr>
                            @endforeach
                            <tr class="border">
                                <td style="border: 1px solid black;" colspan="3" class="text-end">Total Harga</td>
                                <td style="border: 1px solid black;" class="text-end">Rp.{{ number_format($resep->total_harga) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
