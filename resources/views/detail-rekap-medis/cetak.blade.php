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

                    {{-- <p>RSAU DR SISWANTO</p> --}}
                </td>
                <td class="w-75" style="border: 1px solid black;">
                    <div class="row">
                        <div class="col-md-12">
                            <p><b>Identitas Pasien</b></p>
                        </div>
                    </div>
                    <div class="row">
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
                <td class="p-1" style="border: 1px solid black;">ICD X</td>
                <td class="p-2" style="border: 1px solid black;">
                    @if ($data->icdx != 'null')
                        <ul>
                            @foreach (json_decode($data->icdx) as $val)
                                <li>{{ $val->diagnosa_icdx }}
                                    (<b>{{ $val->jenis_diagnosa == 'P' ? 'Primer' : 'Sekunder' }}</b>)
                                </li>
                            @endforeach
                        </ul>
                    @endif
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
                            <td width=150>Alasan Masuk Rumah Sakit</td>
                            <td>: {{ $data->anamnesa }}</td>
                        </tr>
                        <tr>
                            <td>Anamnesa Dokter</td>
                            <td>: {{ $data->anamnesa_dokter }}</td>
                        </tr>
                        @if ($rawat->idpoli == 12)
                            @php
                                $pemeriksaan_fisio = json_decode($data->pemeriksaan_fisio);
                            @endphp
                            <tr>
                                <td>&nbsp;&nbsp;Pemeriksaan Fisik</td>
                                <td class="text-start">
                                    {{ $pemeriksaan_fisio->pemeriksaan_fisik ? $pemeriksaan_fisio->pemeriksaan_fisik : '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp;Pemeriksaan Uji Fungsi</td>
                                <td class="text-start">
                                    {{ $pemeriksaan_fisio->pemeriksaan_uji_fungsi ? $pemeriksaan_fisio->pemeriksaan_uji_fungsi : '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp;Tata Laksana</td>
                                <td class="text-start">
                                    {{ $pemeriksaan_fisio->tata_laksana ? $pemeriksaan_fisio->tata_laksana : '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp;Anjuran</td>
                                <td class="text-start">
                                    {{ $pemeriksaan_fisio->anjuran ? $pemeriksaan_fisio->anjuran : '-' }}
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;&nbsp;evaluasi</td>
                                <td class="text-start">
                                    {{ $pemeriksaan_fisio->evaluasi ? $pemeriksaan_fisio->evaluasi : '-' }}
                                </td>
                            </tr>
                        @endif
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
                            <td class="text-start">: {{ $alergi->value_obat ? $alergi->value_obat : '-' }}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;Makanan</td>
                            <td class="text-start">: {{ $alergi->value_makanan ? $alergi->value_makanan : '-' }}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;Lain - lain</td>
                            <td class="text-start">: {{ $alergi->value_lain ? $alergi->value_lain : '-' }}</td>
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
                            <td class="text-start">: {{ $pfisik->tekanan_darah ? $pfisik->tekanan_darah : '-' }} mmHg
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;Nadi</td>
                            <td class="text-start">: {{ $pfisik->nadi ? $pfisik->nadi : '-' }} x/menit</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;Pernapasan</td>
                            <td class="text-start">: {{ $pfisik->pernapasan ? $pfisik->pernapasan : '-' }} x/menit
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;Suhu</td>
                            <td class="text-start">: {{ $pfisik->suhu ? $pfisik->suhu : '-' }} celcius</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;Berat Badan</td>
                            <td class="text-start">: {{ $pfisik->berat_badan ? $pfisik->berat_badan : '-' }} Kg</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;Tinggi Badan</td>
                            <td class="text-start">: {{ $pfisik->tinggi_badan ? $pfisik->tinggi_badan : '-' }} Cm
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;BMI</td>
                            <td class="text-start">: {{ $pfisik->bmi ? $pfisik->bmi : '-' }} Kg/M2</td>
                        </tr>
                        <tr>
                            <td colspan="2"><br></td>
                        </tr>
                        <tr>
                            <td colspan="2"><b>Riwayat Kesehatan</b></td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;Riwayat penyakit yang lalu</td>
                            <td class="text-start">: {{ $rkesehatan->riwayat_1 == 1 ? 'Ya' : 'Tidak' }}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;Pernah dirawat</td>
                            <td class="text-start">: {{ $rkesehatan->riwayat_2 == 1 ? 'Ya' : 'Tidak' }}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;Pernah dioperasi</td>
                            <td class="text-start">: {{ $rkesehatan->riwayat_3 == 1 ? 'Ya' : 'Tidak' }}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;Dalam Pengobatan Khusus</td>
                            <td class="text-start">: {{ $rkesehatan->riwayat_4 == 1 ? 'Ya' : 'Tidak' }}</td>
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
            {{-- <tr>
                <td class="p-1" style="border: 1px solid black;">
                    Terapi
                    <br>
                    <i>(Baik Obat, Prosedur, Operasi, Rehabilitasi dan Diet)</i>
                </td>
                <td class="p-2" style="border: 1px solid black;">
                    @if ($data->terapi_obat != 'null')
                        <table class="table">
                            @foreach (json_decode($data->terapi_obat) as $val)
                                <tr>
                                    <td width='200'>
                                        (@foreach ($val->terapi_obat_racikan as $data_obat)
                                            @foreach ($obat as $item)
                                                @if ($data_obat->obat == $item->id)
                                                    {{ $item->nama_obat }} , {{ $data_obat->jumlah_obat }}
                                                    {{ isset($data_obat->dosis_obat) ? $data_obat->dosis_obat : '' }}
                                                @endif
                                            @endforeach
                                        @endforeach)
                                        <span class="text-end"> </span>

                                    </td>
                                    <td align="right">{{ $val->signa1 }} - {{ $val->signa2 }} -
                                        {{ $val->signa3 }}</td>
                                </tr>
                            @endforeach
                        </table>
                    @endif
                    <p>{{ $data->terapi }}</p>
                </td>
            </tr> --}}
            @if ($tindak_lanjut)
                <tr>
                    <td colspan="2" class="text-center" style="border: 1px solid black;">
                        <b style="text-transform:uppercase">Rencana Tindak Lanjut</b>
                    </td>
                </tr>
                @if ($tindak_lanjut->tindak_lanjut == 'Dirawat')
                    <tr>
                        <td colspan="2" style="border: 1px solid black;">
                            <table>
                                <tr>
                                    <td colspan="3">Pasien {{ $tindak_lanjut->tindak_lanjut }}</td>
                                </tr>
                                <tr>
                                    <td>DPJP</td>
                                    <td>:</td>
                                    <td>{{ $tindak_lanjut->dokter->nama_dokter }}</td>
                                </tr>
                                <tr>
                                    <td>No SPRI</td>
                                    <td>:</td>
                                    <td>SPRI/{{ $tindak_lanjut->nomor }}/{{ $tindak_lanjut->bulanRomawi(date('n', strtotime($tindak_lanjut->tgl_tindak_lanjut))) }}/{{ date('Y', strtotime($tindak_lanjut->tgl_tindak_lanjut)) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tanggal Rencana Rawat</td>
                                    <td>:</td>
                                    <td>{{ $tindak_lanjut->tgl_tindak_lanjut }}</td>
                                </tr>
                                @if ($tindak_lanjut->operasi == 1)
                                    <tr>
                                        <td>Tindakan Operasi</td>
                                        <td>:</td>
                                        <td>{{ $tindak_lanjut->tindakan_operasi }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td>Catatan</td>
                                    <td>:</td>
                                    <td>{{ $tindak_lanjut->catatan }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                @elseif($tindak_lanjut->tindak_lanjut == 'Dirujuk')
                    <tr>
                        <td colspan="2" style="border: 1px solid black;">
                            <table>
                                <tr>
                                    <td colspan="3">Pasien {{ $tindak_lanjut->tindak_lanjut }}</td>
                                </tr>
                                <tr>
                                    <td>Tujuan Rujuk</td>
                                    <td>:</td>
                                    <td>{{ $tindak_lanjut->tujuan_tindak_lanjut }}</td>
                                </tr>
                                <tr>
                                    <td>Poli Rujukan</td>
                                    <td>:</td>
                                    <td>{{ $tindak_lanjut->poli->poli }} ({{ $tindak_lanjut->poli_rujuk }})</td>
                                </tr>
                                <tr>
                                    <td>No Rujukan</td>
                                    <td>:</td>
                                    <td>RUJUKAN/{{ $tindak_lanjut->nomor }}/{{ $tindak_lanjut->bulanRomawi(date('n', strtotime($tindak_lanjut->tgl_tindak_lanjut))) }}/{{ date('Y', strtotime($tindak_lanjut->tgl_tindak_lanjut)) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tanggal</td>
                                    <td>:</td>
                                    <td>{{ $tindak_lanjut->tgl_tindak_lanjut }}</td>
                                </tr>
                                <tr>
                                    <td>Catatan</td>
                                    <td>:</td>
                                    <td>{{ $tindak_lanjut->catatan }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                @elseif($tindak_lanjut->tindak_lanjut == 'Kontrol Kembali')
                    <tr>
                        <td colspan="2" style="border: 1px solid black;">
                            <table>
                                <tr>
                                    <td colspan="3">Pasien {{ $tindak_lanjut->tindak_lanjut }}</td>
                                </tr>
                                <tr>
                                    <td>Dokter</td>
                                    <td>:</td>
                                    <td>{{ $tindak_lanjut->rawat->dokter->nama_dokter }}</td>
                                </tr>
                                <tr>
                                    <td>No SKPD</td>
                                    <td>:</td>
                                    <td>SKPD/{{ $tindak_lanjut->nomor }}/{{ date('m', strtotime($tindak_lanjut->tgl_tindak_lanjut)) }}/{{ date('Y', strtotime($tindak_lanjut->tgl_tindak_lanjut)) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tanggal</td>
                                    <td>:</td>
                                    <td>{{ $tindak_lanjut->tgl_tindak_lanjut }}</td>
                                </tr>
                                <tr>
                                    <td>Catatan</td>
                                    <td>:</td>
                                    <td>{{ $tindak_lanjut->catatan }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                @elseif($tindak_lanjut->tindak_lanjut == 'Interm')

                @elseif($tindak_lanjut->tindak_lanjut == 'Prb')
                    @php
                        $prb = json_decode($tindak_lanjut->prb);
                    @endphp
                    <tr>
                        <td colspan="2" style="border: 1px solid black;">
                            <table>
                                <tr>
                                    <td colspan="3">Pasien Rujuk Balik</td>
                                </tr>
                                <tr>
                                    <td>Nomor </td>
                                    <td>:</td>
                                    <td>NO:
                                        {{ $tindak_lanjut->nomor }}/{{ date('m', strtotime($tindak_lanjut->tgl_tindak_lanjut)) }}/{{ date('Y', strtotime($tindak_lanjut->tgl_tindak_lanjut)) }}
                                    </td>
                                </tr>
                                {{-- <tr>
                                <td>Diagnosa</td>
                                <td>:</td>
                                <td>
                                    <p>{{ $data->diagnosa }}</p>

                                    @if ($data->icdx != 'null')
                                    <ul>
                                        @foreach (json_decode($data->icdx) as $val)
                                            <li>{{ $val->diagnosa_icdx }}
                                                (<b>{{ $val->jenis_diagnosa == 'P' ? 'Primer' : 'Sekunder' }}</b>)
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                                </td>
                            </tr> --}}
                                <tr>
                                    <td>Tgl Surat Rujukan </td>
                                    <td>:</td>
                                    <td>{{ date('d F Y', strtotime($tindak_lanjut->created_at)) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">Belum Dapat di kembalikan ke Fasilitas Perujuk dengan alasan</td>
                                </tr>
                                <tr style="border:1px solid;">
                                    <td colspan="3">{{ $prb->alasan }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3">Rencana Tindak lanjut pada kunjungan selanjutnya</td>
                                </tr>
                                <tr style="border:1px solid; padding:10px;">
                                    <td colspan="3">{{ $prb->rencana_selanjutnya }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3">Surat Keterangan ini digunakan untuk 1(satu) kali kunjungan
                                        dengan diagnosa diatas pada :</td>
                                </tr>
                                <tr>
                                    <td width=150>Tanggal</td>
                                    <td>:</td>
                                    <td>{{ date('d F Y', strtotime($tindak_lanjut->tgl_tindak_lanjut)) }}</td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                @endif
            @endif
            <tr>
                <td class="p-2" style="border: 1px solid black;">

                </td>
                <td class="p-2" style="border: 1px solid black; font-size:12; text-align:center;">
                    <p>Surakarta, {{ \Carbon\Carbon::now()->formatLocalized('%A, %d %B %Y') }}</p>
                    <p>DPJP</p>
                    <img width="50%" src="data:image/png;base64, {!! base64_encode($qr) !!} ">
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
