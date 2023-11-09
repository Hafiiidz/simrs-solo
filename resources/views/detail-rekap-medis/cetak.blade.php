<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <div class="row">
        <table class="table">
            <tr class="border">
                <td class="w-50" style="border: 1px solid black;"></td>
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
                                <td>{{ ($data->rekapMedis->pasien->jenis_kelamin == 'P') ? 'Perempuan' : 'Laki - Laki' }}</td>
                            </tr>
                            <tr>
                                <td>Tgl Lahir</td>
                                <td>:</td>
                                <td>{{ date('d-m-Y', strtotime($data->rekapMedis->pasien->tgllahir)) }}</td>
                            </tr>
                            <tr>
                                <td>Usia</td>
                                <td>:</td>
                                <td>{{ \Carbon\Carbon::parse($data->rekapMedis->pasien->tgllahir)->age; }}</td>
                            </tr>
                            <tr>
                                <td>No.RM</td>
                                <td>:</td>
                                <td>{{ $data->rekapMedis->pasien->no_rm }}</td>
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
                    <b style="text-transform:uppercase">RESUME PASIEN {{ $data->rekapMedis->kategori->nama }}</b>
                </td>
            </tr>
            <tr>
                <td class="p-1" style="border: 1px solid black;">Diagnosa</td>
                <td class="p-2" style="border: 1px solid black;">
                    <p>{{ $data->diagnosa }}</p>
                </td>
            </tr>
            <tr>
                <td class="p-1" style="border: 1px solid black;">
                    Anamnesa & Pemeriksaan Fisik
                    <br>
                    <i>(yang relevan dengan diagnosis dan terapi)</i>
                </td>
                <td class="p-2" style="border: 1px solid black;">
                    <table>
                        <tr>
                            <td colspan="2"><b>Anamnesa</b></td>
                        </tr>
                        <tr>
                            <td>Alasan Masuk Rumah Sakit</td>
                            <td>: {{ $data->anamnesa }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><br></td>
                        </tr>
                        <tr>
                            <td><b>Obat yang dikonsumsi</b></td>
                            <td>: {{ $data->obat_yang_dikonsumsi }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><br></td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Alergi</b></td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;Obat</td>
                            <td class="text-start">: {{ ($alergi->value_obat) ? $alergi->value_obat : '-' }}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;Makanan</td>
                            <td class="text-start">: {{ ($alergi->value_makanan) ? $alergi->value_makanan : '-' }}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;Lain - lain</td>
                            <td class="text-start">: {{ ($alergi->value_lain) ? $alergi->value_lain : '-' }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><br></td>
                        </tr>
                        <tr>
                            <td>Pasien sedang</td>
                            <td>: {{ $data->pasien_sedang }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Pemeriksaan Fisik</b></td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;Tekanan Darah</td>
                            <td class="text-start">: {{ ($pfisik->tekanan_darah) ? $pfisik->tekanan_darah : '-' }} mmHg</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;Nadi</td>
                            <td class="text-start">: {{ ($pfisik->nadi) ? $pfisik->nadi : '-' }} x/menit</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;Pernapasan</td>
                            <td class="text-start">: {{ ($pfisik->pernapasan) ? $pfisik->pernapasan : '-' }} x/menit</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;Suhu</td>
                            <td class="text-start">: {{ ($pfisik->suhu) ? $pfisik->suhu : '-' }} celcius</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;Berat Badan</td>
                            <td class="text-start">: {{ ($pfisik->berat_badan) ? $pfisik->berat_badan : '-' }} Kg</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;Tinggi Badan</td>
                            <td class="text-start">: {{ ($pfisik->tinggi_badan) ? $pfisik->tinggi_badan : '-' }} Cm</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;BMI</td>
                            <td class="text-start">: {{ ($pfisik->bmi) ? $pfisik->bmi : '-' }} Kg/M2</td>
                        </tr>
                        <tr>
                            <td colspan="2"><br></td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Riwayat Kesehatan</b></td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;Riwayat penyakit yang lalu</td>
                            <td class="text-start">: {{ ($rkesehatan->riwayat_1 == 1) ? 'Ya' : 'Tidak' }}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;Pernah dirawat</td>
                            <td class="text-start">: {{ ($rkesehatan->riwayat_2 == 1) ? 'Ya' : 'Tidak' }}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;Pernah dioperasi</td>
                            <td class="text-start">: {{ ($rkesehatan->riwayat_3 == 1) ? 'Ya' : 'Tidak' }}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;Dalam Pengobatan Khusus</td>
                            <td class="text-start">: {{ ($rkesehatan->riwayat_4 == 1) ? 'Ya' : 'Tidak' }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="p-1" style="border: 1px solid black;">
                    Hasil Pemeriksaan Penunjang
                    <br>
                    <i>(yang relevan dengan diagnosis dan terapi)</i>
                </td>
                <td class="" style="border: 1px solid black;">
                    <div class="row">
                        <p class="text-center" style="border-bottom: 1px solid black;">Rencana Pemeriksaan</p>
                    </div>
                    <div class="p-2">
                        <p>{{ $data->rencana_pemeriksaan }}</p>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="p-1" style="border: 1px solid black;">
                    Terapi
                    <br>
                    <i>(Baik Obat, Prosedur, Operasi, Rehabilitasi dan Diet)</i>
                </td>
                <td class="p-2" style="border: 1px solid black;">
                    @if ($data->terapi_obat != 'null')
                        <table class="table">
                            @foreach (json_decode($data->terapi_obat) as $val)
                                @foreach ($obat as $item)
                                    @if ($val->obat == $item->id)
                                        <tr>
                                            <td class="text-start">{{ $item->nama_obat }}</td>
                                            <td class="text-end">{{ $val->jumlah_obat }} {{ $item->satuan->satuan }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </table>
                    @endif
                    <p>{{ $data->terapi }}</p>
                </td>
            </tr>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
