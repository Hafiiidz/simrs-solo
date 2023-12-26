<html>
<head>
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
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td style="border: 1px solid black;" width="35%" class="text-center"><h2><b>LAPORAN PEMBEDAHAN</b></h2></td>
                            <td style="border: 1px solid black;" colspan="2">
                                <table>
                                    <tr>
                                        <td><b>No RM</b></td>
                                        <td>:</td>
                                        <td>{{ $data->rawat->no_rm }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Nama / Jenis Kelamin</b></td>
                                        <td>:</td>
                                        <td>{{ $data->rawat->pasien->nama_pasien }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Tanggal Lahir</b></td>
                                        <td>:</td>
                                        <td>{{ $data->rawat->pasien->tgllahir }}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;" colspan="3">Tanggal Operasi : {{ $data->tgl_operasi }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;">
                                Dokter Operator : {{ json_decode($data->dokter_bedah)[0]->dokter_bedah }}
                            </td>
                            <td style="border: 1px solid black;">Asisten Bedah : {{ json_decode($data->asisten)[0]->asisten }}</td>
                            <td style="border: 1px solid black;">Instrumen</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;">Dokter Anestesi : {{ json_decode($data->ahli_anastesi)[0]->ahli_anastesi }}</td>
                            <td style="border: 1px solid black;" colspan="2">Penata Anestesi : {{ json_decode($data->penata_anastesi)[0]->penata_anastesi }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;" rowspan="2">Diagnosis Pra. Bedah   : {{ $data->diagnosis_prabedah }}</td>
                            <td style="border: 1px solid black;" colspan="2">Diagnosis Pasca Bedah : {{ $data->diagnosis_pasca_bedah }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;" colspan="2">Desinfektan kulit  : {{ $data->desinfektan_kulit }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;">Tindakan : {{ json_decode($data->tindakan_bedah)[0]->tindakan_bedah }}</td>
                            <td style="border: 1px solid black;" rowspan="2">Posisi : {{ $data->posisi }}</td>
                            <td style="border: 1px solid black;" rowspan="2">
                                Jaringan/Kultur
                                <br>
                                @php
                                    $jaringan_kultur = json_decode($data->jaringan)->jaringan_kultur;
                                @endphp
                                @if ($jaringan_kultur == 1)
                                    Ya
                                    <br>
                                    Macam Jaringan : {{ json_decode($data->jaringan)->macam_jaringan; }}
                                @else
                                    Tidak
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;">Indikasi operasi : {{ $data->indikasi_operasi }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;" colspan="3">Implant : {{ $data->implant }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;">{{ $data->jenis_operasi }}</td>
                            <td style="border: 1px solid black;" colspan="2">
                                <table>
                                    <tr>
                                        <td>1.Efektif</td>
                                        <td>2.Cito</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Kamar Operasi :</td>
                                        <td>{{ $data->kamar_operasi }}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;" colspan="3">{{ $data->detail_operasi }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;">Mulai (Pukul) : {{ $data->mulai_jam }}</td>
                            <td style="border: 1px solid black;">Selesai (Pukul) : {{ $data->selesai_jam }}</td>
                            <td style="border: 1px solid black;">Lama pembedahan : {{ $data->lama_operasi }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;" colspan="3">Jenis Anestesi : {{ $data->jenis_anastesi }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;" colspan="3">
                                <table>
                                    <tr>
                                        <td>Laporan Pembedahan :</td>
                                        <td>{{ $data->uraian_pembedahan }}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;" colspan="3">
                                <table>
                                    <tr>
                                        <td>Komplikasi :</td>
                                        <td>{{ $data->komplikasi }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah Kehilangan Darah :</td>
                                        <td>{{ $data->jumlah_pendarahan }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah Darah Masuk :</td>
                                        <td>{{ $data->jumlah_darah_masuk }}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;" colspan="2">
                                <table>
                                    <tr>
                                        <td>Instruksi Post Operasi :</td>
                                        <td>{{ $data->instruksi_post_operasi }}</td>
                                    </tr>
                                </table>
                            </td>
                            <td style="border: 1px solid black;"></td>
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
