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
            <div class="col-md-12">
               <h4>{{ $rawat->pasien->nama_pasien }}</h4> 
               <p>{{ $rawat->no_rm }} | {{ $rawat->ruangan->nama_ruangan }} {{ $rawat->poli?->nama_poli }} | {{ $gizi->tgl }}</p>
               <h3>{{ $gizi->diit }}</h3>
               <p>*Setelah 1 jam alat makan akan diambil</p>
            </div>
        </div>
    </div>
</body>