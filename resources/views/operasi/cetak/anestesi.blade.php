<html>
<head>
    <title>catatan-anestesi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <style>
            @page {
                margin-top: 10px;
                margin-bottom: 0px;
                margin-right: 12px;
                margin-left: 12px;
            }
            body {
                margin-top: 10px;
                margin-bottom: 0px;
                margin-right: 12px;
                margin-left: 12px;
                }
            th, td {
                padding: 8px;
            }

            .isi-table{
                font-size: 13px;
            }
        </style>
</head>

<body>
    <div class="container">
        <div class="row" style="border-bottom: 1px solid gray;">
            <table>
                <tr>
                    <td class="text-center">PANGKALAN TNI AU ADI SOEMARMO</td>
                </tr>
                <tr>
                    <td class="text-center">RSAU dr. SISWANTO</td>
                </tr>
            </table>
        </div>
        <div class="row" class="isi-table">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td style="border: 1px solid black;">Nama: {{ $operasi->rawat->pasien->nama_pasien }}<br><br>TTL: {{ $operasi->rawat->pasien->tgllahir }}</td>
                            <td class="text-center" style="border: 1px solid black;">Umur<br>(TH/BL/HR):<br>{{ $operasi->rawat->pasien->usia_tahun }}</td>
                            <td class="text-center" style="border: 1px solid black;">Kelamin:<br><br>{{ $operasi->rawat->pasien->jenis_kelamin }}</td>
                            <td class="text-center" style="border: 1px solid black;">Status Fisik:<br><br>{{ $data->status_fisik }}</td>
                            <td class="text-center" style="border: 1px solid black;">Tanggal:<br><br>{{ date('d-m-Y', strtotime($data->tanggal)) }}</td>
                            <td class="text-center" style="border: 1px solid black;">No RM:<br><br>{{ $operasi->rawat->no_rm }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;" colspan="3" rowspan="2">
                                dr. Anestesi :
                                <br>
                                <br>
                                Asisten Anestesi :
                                <br>
                                <br>
                            </td>
                            <td style="border: 1px solid black;">Diagnosis Pra Bedah:</td>
                            <td style="border: 1px solid black;" colspan="2">{{ $operasi->diagnosis_prabedah }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;">Jenis Pembedahan:</td>
                            <td style="border: 1px solid black;" colspan="2"></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;" colspan="3" rowspan="2">
                                Anestesi Dengan :
                            </td>
                            <td style="border: 1px solid black;">JENIS/TEKNIK ANESTESI:</td>
                            <td style="border: 1px solid black;" colspan="2">{{ $data->teknik_anestesi }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;">POSISI:</td>
                            <td style="border: 1px solid black;" colspan="2">{{ $data->posisi }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;" colspan="3">PREMEDIKASI: {{ $data->premedikasi }}</td>
                            <td style="border: 1px solid black;" colspan="3" rowspan="2">
                                <ol>
                                    @foreach (json_decode($data->obat_anestesi) as $val)
                                        <li>{{ $val->obat_anestesi_catatan }}</li>
                                    @endforeach
                                </ol>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;" colspan="3">
                                Pemberian :SC/IM/IV/Oral<br>
                                Jam :<br>
                                Efek :
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;" colspan="6">Waktu Operasi :</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;">O2</td>
                            <td style="border: 1px solid black;" colspan="5">
                                @foreach (json_decode($data->o2) as $val)
                                    {{ $val->o2 }}&nbsp;&nbsp;
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;">N2O</td>
                            <td style="border: 1px solid black;" colspan="5">
                                @foreach (json_decode($data->n2o) as $val)
                                    {{ $val->n2o }}&nbsp;&nbsp;
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;">ISOFLUERENCE</td>
                            <td style="border: 1px solid black;" colspan="5">
                                @foreach (json_decode($data->isoflurane) as $val)
                                    {{ $val->isoflurane }}&nbsp;&nbsp;
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;">SEVOFLURENE</td>
                            <td style="border: 1px solid black;" colspan="5">
                                @foreach (json_decode($data->sevoflurane) as $val)
                                    {{ $val->sevoflurane }}&nbsp;&nbsp;
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;">Infus</td>
                            <td style="border: 1px solid black;" colspan="5">
                                @foreach (json_decode($data->infus) as $val)
                                    {{ $val->infus }}&nbsp;&nbsp;
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;">Medikasi</td>
                            <td style="border: 1px solid black;" colspan="5">
                                @foreach (json_decode($data->medikasi) as $val)
                                    {{ $val->medikasi }}&nbsp;&nbsp;
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;" rowspan="3">STADIA :</td>
                            <td style="border: 1px solid black;" colspan="5">ANESTESI : {{ json_decode($data->stadia)->anestesi }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;" colspan="5">OPERASI : {{ json_decode($data->stadia)->operasi }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;" colspan="5">RESPIRASI : {{ json_decode($data->stadia)->respirasi }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="border: 1px solid black;" class="text-center">
                                JUMLAH MEDIKASI
                            </td>
                            <td colspan="2" style="border: 1px solid black;" class="text-center">
                                JUMLAH CAIRAN / TRANSFUSI
                            </td>
                            <td colspan="2" style="border: 1px solid black;" class="text-center">
                                CATATAN
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="border: 1px solid black;">{{ $data->jumlah_medikasi }}</td>
                            <td colspan="2" style="border: 1px solid black;">{{ $data->jumlah_cairan }}</td>
                            <td colspan="2" style="border: 1px solid black;">
                                KOMPLIKASI PRA ANESTESI:<br><br>
                                {{ $data->pra_anestesi }}
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;">PENDARAHAN :<br><br>{{ $data->pendarahan }}</td>
                            <td style="border: 1px solid black;">URINE :<br><br>{{ $data->urine }}</td>
                            <td style="border: 1px solid black;">LAMA OPERASI :</td>
                            <td style="border: 1px solid black;">LAMA ANESTESI :<br><br>{{ $data->lama_anestesi }}</td>
                            <td colspan="2" style="border: 1px solid black;">KOMPLIKASI POST ANESTESI:<br><br>
                                {{ $data->post_anestesi }}
                            </td>
                        </tr>
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
