<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <style>
            @page {
                margin-top: 5px;
                margin-bottom: 0px;
                margin-right: 5px;
                margin-left: 5px;
            }
            body {
                margin-top: 10px;
                margin-bottom: 0px;
                margin-right: 5px;
                margin-left: 5px;
                font-size: 9px;
                }
            .page_break { page-break-after: always; }
            .page_break:last-child {
                page-break-after: avoid;
            }
        </style>
</head>

<body>
    <div class="container">
        @foreach ($detail_resep as $val)
        <div class="page_break">
            <div class="row" style="border-bottom: 1px solid black;">
                <table>
                    <tr>
                        <td>
                            <img width="20" src="data:image/png;base64, {!! base64_encode(file_get_contents(public_path('image/logosiswanto.png'))) !!} ">
                        </td>
                        <td class="text-center"><b>FARMASI RSAU DR SISWANTO SOLO</b></td>
                    </tr>
                </table>
            </div>
            <div class="row mt-2">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td><b>{{ $pasien->nama_pasien }}</b></td>
                            <td>No RM</td>
                            <td>:</td>
                            <td><b>{{ $pasien->no_rm }}</b></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td><b>{{ substr($pasien->alamat, 0, 10); }}</b></td>
                            <td>Usia</td>
                            <td>:</td>
                            <td><b>{{ $pasien->usia_tahun }}Thn</b></td>
                        </tr>
                        <tr>
                            <td>Tgl</td>
                            <td>:</td>
                            <td><b>{{ $resep->tgl }}</b></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row mt-3"style="border-bottom: 1px solid black;">
                <div class="text-center">Sehari</div>
            </div>
            <div class="row">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td>Dokter</td>
                            <td>:</td>
                            <td>{{ $rawat->dokter?->nama_dokter }}</td>
                        </tr>
                        <tr>
                            <td>Obat</td>
                            <td>:</td>
                            <td><b>{{ $val->nama_obat }}</b></td>
                        </tr>
                        <tr>
                            <td>Catatan</td>
                            <td>:</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>Jumlah</td>
                            <td>:</td>
                            <td>{{ $val->qty }} {{ $val->takaran }}</td>
                        </tr>
                        <tr>
                            <td>Opsi Obat</td>
                            <td>:</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>ED</td>
                            <td>:</td>
                            <td>-</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
