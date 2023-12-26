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
        </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <table>
                <tr>
                    <td rowspan="3"><img width="100" src="data:image/png;base64, {!! base64_encode(file_get_contents(public_path('image/logosiswanto.png'))) !!} "></td>
                    <td class="text-center"><b>RSAU DR. SISWANTO</b></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td class="text-center">JL Tentara Pelajar No 1, Malangjiwan, Colomadu</td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td class="text-center">0271779112</td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                </tr>
            </table>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <b>HASIL PEMERIKSAAN RADIOLOGI</b>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td>Nama Pasien</td>
                            <td>:</td>
                            <td>{{ $rawat->pasien->nama_pasien }}</td>
                            <td>Alamat Pasien</td>
                            <td>:</td>
                            <td>{{ $rawat->pasien->alamat_penanggunjawab }}</td>
                        </tr>
                        <tr>
                            <td>Tgl Lahir</td>
                            <td>:</td>
                            <td>{{ $rawat->pasien->tgllahir }}</td>
                            <td>Ruangan / Poli</td>
                            <td>:</td>
                            <td>{{ $rawat->poli?->poli }}</td>
                        </tr>
                        <tr>
                            <td>No RM</td>
                            <td>:</td>
                            <td>{{ $rawat->pasien->no_rm }}</td>
                            <td>Dr Pengirim</td>
                            <td>:</td>
                            <td>{{ $rawat->dokter?->nama_dokter }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td>{{ $rawat->pasien->jenis_kelamin }}</td>
                            <td>Tgl Permintaan</td>
                            <td>:</td>
                            <td>{{ date('Y-m-d') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <b><u>KETERANGAN KLINIS</u></b>
                <br><br>
                <p>{{ $pemeriksaan->klinis }}</p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <b><u>URAIAN HASIL PEMERIKSAAN</u></b>
                <br><br>
                {!! $pemeriksaan->hasil !!}
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <b><u>KESAN / KESIMPULAN</u></b>
                <br><br>
                {!! $pemeriksaan->kesan !!}
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
