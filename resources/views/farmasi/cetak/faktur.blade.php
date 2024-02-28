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

        .page_break {
            page-break-before: always;
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
                        <td>Poli {{ $rawat->poli?->poli }}</td>
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
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($detail_resep as $val)
                                @if ($val->idbayar != 3)
                                    @php
                                        $total += $val->total;
                                    @endphp
                                    <tr class="border">
                                        <td style="border: 1px solid black;" class="text-center">{{ $loop->iteration }}
                                        </td>
                                        <td style="border: 1px solid black;">{{ $val->nama_obat }}</td>
                                        <td style="border: 1px solid black;" class="text-center">{{ $val->qty }}
                                        </td>
                                        <td style="border: 1px solid black;" class="text-end">
                                            Rp.{{ App\Helpers\VclaimHelper::IndoCurr($val->total) }}</td>
                                    </tr>
                                @endif
                            @endforeach
                            @php
                                $total_racik = 0;
                            @endphp
                            @if (count($racik) > 0)
                                    @php
                                        $total_racik = 10000 * count($racik);
                                    @endphp
                                <tr class="border">
                                    <td style="border: 1px solid black;" colspan="3" class="text-end">Total Racik
                                    </td>
                                    <td style="border: 1px solid black;" class="text-end">
                                        Rp.{{ App\Helpers\VclaimHelper::IndoCurr($total_racik) }}
                                    </td>
                                </tr>
                            @endif
                            <tr class="border">
                                <td style="border: 1px solid black;" colspan="3" class="text-end">Total Harga</td>
                                <td style="border: 1px solid black;" class="text-end">Rp.{{ App\Helpers\VclaimHelper::IndoCurr($total+$total_racik) }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @if ($cek_kronis > 0)
        <div class="page_break"></div>
        <div class="container">
            <div class="row">
                <table>
                    <tr>
                        <td rowspan="3"><img width="40" src="data:image/png;base64, {!! base64_encode(file_get_contents(public_path('image/logosiswanto.png'))) !!} ">
                        </td>
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
                <p>Rincian Resep Kronis</p>
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
                            <td>{{ $pasien->usia_tahun }}Th , {{ $pasien->usia_bulan }}Bln ,
                                {{ $pasien->usia_hari }}Hr
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
                            <td>Poli {{ $rawat->poli?->poli }}</td>
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
                                @php
                                    $total_kronis = 0;
                                @endphp
                                @foreach ($detail_resep as $val)
                                    @if ($val->idbayar == 3)
                                        @php
                                            $total_kronis += $val->total;
                                        @endphp
                                        <tr class="border">
                                            <td style="border: 1px solid black;" class="text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td style="border: 1px solid black;">{{ $val->nama_obat }}</td>
                                            <td style="border: 1px solid black;" class="text-center">
                                                {{ $val->qty }}
                                            </td>
                                            <td style="border: 1px solid black;" class="text-end">
                                                Rp.{{ App\Helpers\VclaimHelper::IndoCurr($val->total) }}</td>
                                        </tr>
                                    @endif
                                @endforeach

                                <tr class="border">
                                    <td style="border: 1px solid black;" colspan="3" class="text-end">Total Harga
                                    </td>
                                    <td style="border: 1px solid black;" class="text-end">
                                        Rp.{{ App\Helpers\VclaimHelper::IndoCurr($total_kronis) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
