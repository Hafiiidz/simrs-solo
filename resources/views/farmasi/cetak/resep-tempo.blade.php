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
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div style="width: 70%; float:left;">
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
            <div style="width: 30%; float:left;">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        @php
                            $pfisik = json_decode($detail_rekap?->pemeriksaan_fisik);
                        @endphp
                        <table>
                            <tr>
                                <td>Diagnosa</td>
                                <td>{{ $detail_rekap?->diagnosa }}</td>
                            </tr>
                            <tr>
                                <td>Alergi</td>
                                <td>{{ $detail_rekap?->alergi }}</td>
                            </tr>
                            <tr>
                                <td>BB / TB</td>
                                <td>{{ $pfisik?->berat_badan . ' Kg /' }} {{ $pfisik?->tinggi_badan . ' cm' }} </td>
                            </tr>
                        </table>
                    </table>
                </div>

            </div>
        </div>
        <br>
        <div style="width:100%;"></div>
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
                        <td>{{ date('Y/m/d',strtotime($resep->created_at)) }}</td>
                        <td>Poli/Ruangan</td>
                        <td>:</td>
                        @if($rawat->idjenisrawat == 2)
                            <td>{{ $rawat->ruangan?->nama_ruangan }}</td>
                        @else
                            <td>Poli {{ $rawat->poli?->poli }}</td>
                        @endif
                    </tr>
                    <tr>
                        <td>Alamat Pasien</td>
                        <td>:</td>
                        <td>{{ $alamat?->alamat }}</td>
                    </tr>
                </table>
            </div>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-6" style="width:70%; float:left">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($resep->obat != null || $resep->obat != '[]' || $resep->obat != 'null')
                                @foreach (json_decode($resep->obat) as $obat)
                                    <tr  style="padding-bottom:10px; margin-bottom:10px; height: 50px;" class="border">
                                        <td>
                                            R / <br>{!! App\Helpers\VclaimHelper::get_data_obat($obat->obat) !!} <br>
                                            {{ $obat->dosis }}
                                            {{ $obat->takaran }} ( {{ $obat->signa }} )
                                            {{ $obat->diminum . ' makan' }}
                                            
                                        </td>
                                        <td>No. {{ $obat->diberikan }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            @if ($resep->racikan != null || $resep->racikan != '[]' || $resep->racikan != 'null')
                                @foreach (json_decode($resep->racikan) as $racik)
                                    <tr  class="border" style="padding-bottom:10px; margin-bottom:10px; height: 50px;">
                                        <td width=100>
                                            R / <br>
                                            @foreach ($racik->obat as $ro)
                                                {!! App\Helpers\VclaimHelper::get_data_obat($ro->obat) !!} ({{ $ro->jumlah_obat }}) +
                                            @endforeach
                                            <br>{{ $racik->dosis }}
                                            {{ $racik->takaran }} ( {{ $racik->signa }} )
                                            {{ $racik->diminum . ' makan' }}
                                            <br>
                                            
                                            
                                        </td>
                                       <td>
                                        No. 
                                       </td>
                                    </td>
                                @endforeach
                                
                            @endif


                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6" style="width:30%; float:left">
                <div class="table-responsive">
                    <table class="table table-bordered" style="text-align: center;">
                        <thead>
                            <tr class="border">
                                <th width=80 style="border: 1px solid black;" class="text-center">Administartif</th>
                                <th style="border: 1px solid black;" class="text-center">Ceklis</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="border: 1px solid black;">Tgl R/</td>
                                <td style="border: 1px solid black;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">Paraf Dokter</td>
                                <td style="border: 1px solid black;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">Identitas Pasien</td>
                                <td style="border: 1px solid black;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">BB / TB</td>
                                <td style="border: 1px solid black;"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive" style="margin-top: 5px">
                    <table class="table table-bordered" style="text-align: center;">
                        <thead>
                            <tr class="border">
                                <th width=80 style="border: 1px solid black;" class="text-center">Farmasetis</th>
                                <th style="border: 1px solid black;" class="text-center">Ceklis</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="border: 1px solid black;">Nama Obat</td>
                                <td style="border: 1px solid black;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">Sediaan</td>
                                <td style="border: 1px solid black;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">Dosis</td>
                                <td style="border: 1px solid black;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">Jumlah Obat</td>
                                <td style="border: 1px solid black;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">Aturan Pakai</td>
                                <td style="border: 1px solid black;"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive" style="margin-top: 5px">
                    <table class="table table-bordered" style="text-align: center;">
                        <thead>
                            <tr class="border">
                                <th width=80 style="border: 1px solid black;" class="text-center">Persyaratan Klinis
                                </th>
                                <th style="border: 1px solid black;" class="text-center">Ceklis</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="border: 1px solid black;">Tepat Indikasi</td>
                                <td style="border: 1px solid black;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">Tepat Dosis</td>
                                <td style="border: 1px solid black;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">Waktu Penggunaan</td>
                                <td style="border: 1px solid black;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">Duplikasi</td>
                                <td style="border: 1px solid black;"></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid black;">Kontra Indikasi</td>
                                <td style="border: 1px solid black;"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div style="width: 100%; float:left">
                    <p>Surakarta, {{ \Carbon\Carbon::now()->formatLocalized('%A, %d %B %Y') }}</p>
                    <p>DPJP</p>
                    <img width="50%" src="data:image/png;base64, {!! base64_encode($qr) !!} ">
                    <p>{{ $rawat->dokter->nama_dokter }}</p>
                </div>
            </div>
        </div>
        <div class="row">
           
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
