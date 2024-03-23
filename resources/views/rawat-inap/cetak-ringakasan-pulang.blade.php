<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body style="font-size:13px;">
    <div style="width: 100% ; height:100px;">
        <div
            style="width: 40%; font-family:arial; border-bottom:1px solid; padding-bottom:1px; float:left; text-align:center;">
            <p>PANGAKAN TNI AU ADI SOEMARMO RSAU dr. SISWANTO</p>
        </div>
    </div>

    <table class="table table-bordered">
        <tr style="border: 1px solid black; text-align:center;">
            <th colspan="3">RESUME MEDIS PASIEN</th>
        </tr>
        <tr style="border: 1px solid black; text-align:left;">
            <td style="border: 1px solid black;">Nama : {{ $rawat->pasien->nama_pasien }}</td>
            <td style="border: 1px solid black;">Tgl Lahir / Usia
                :{{ \Carbon\Carbon::parse($rawat->pasien->tgllahir)->translatedFormat('d F Y ') }}
                ({{ $rawat->pasien->usia_tahun }} thn)</td>
            <td style="border: 1px solid black;">NO RM : {{ $rawat->pasien->no_rm }}</td>
        </tr>
        <tr style="border: 1px solid black; text-align:left;">
            <td colspan="3">
                Alamat : {{ $rawat->pasien->alamat->alamat }}<br>
            </td>
        </tr>
        <tr style="border: 1px solid black; text-align:left;">
            <td colspan="3">
                <p>Diagnosa Masuk : </p>
                <ul>
                    @if ($ringakasan_pasien_masuk)
                        @if ($ringakasan_pasien_masuk->icd10 != 'null')
                            @foreach (json_decode($ringakasan_pasien_masuk->icd10) as $rp)
                                <li>{{ $rp->diagnosa_icdx }} {!! isset($rp->jenis_diagnosa) ?? $rp->jenis_diagnosa == 'P' ? '<b>(Primer)</b>' : '<b>(Sekunder)</b>' !!}</li>
                            @endforeach

                        @endif
                    @endif

                </ul>

            </td>
        </tr>
        <tr style="border: 1px solid black; text-align:left;">
            <td colspan="3">
                <p>Diagnosa Akhir : </p>
                <ul>
                    @if ($diagnosa_akhir)
                        @if ($diagnosa_akhir->icd10 != 'null')
                            @foreach (json_decode($diagnosa_akhir->icd10) as $da)
                                <li>{{ $da->diagnosa_icdx }} {!! isset($da->jenis_diagnosa) ?? $da->jenis_diagnosa == 'P' ? '<b>(Primer)</b>' : '<b>(Sekunder)</b>' !!}</li>
                            @endforeach

                        @endif
                    @endif


                </ul>

            </td>
        </tr>
        <tr style="border: 1px solid black; text-align:left;">
            <td colspan="3">
                <p>Operasi / Prosedur Khusus : </p>
                <ul>
                    @if ($diagnosa_akhir)
                        @if ($diagnosa_akhir->icd9 != 'null')
                            @foreach (json_decode($diagnosa_akhir->icd9) as $da)
                                <li>{{ $da->diagnosa_icdx }} </li>
                            @endforeach

                        @endif
                    @endif


                </ul>

            </td>
        </tr>
        <tr style="border: 1px solid black; text-align:left;">
            <td colspan="3">
                <p>Riwayat Singkat Penyakit dan Pemeriksaan Fisik </p>
                    <ol>
                        <li>Alasan dirawat (keluhan utama) : {{ $ringakasan_pasien_masuk?->penyakit_utama }}</li>
                        <li>Riwayat Penyakit Dahulu : {{ $ringakasan_pasien_masuk?->penyakit_utama }} </li>
                        <li>Riwayat Sosial :</li>
                        <li>Penemuan Fisik Pentiing : </li>
                    </ol>
            </td>
        </tr>
        <tr style="border: 1px solid black; text-align:left;">
            <td colspan="3">
                <p>Pemeriksaan Penunjang </p>
                    <ol>
                    <li>Laboratorium : <br>  </li>
                        <li>Radiologi : <br>
                            @foreach ($soap_radiologi as $sr)
                                {{ $sr->idtindakan.',' }} 
                            @endforeach
                        </li>
                        <li>Lain - Lain</li>
                    </ol>
            </td>
        </tr>
    </table>
</body>

</html>
