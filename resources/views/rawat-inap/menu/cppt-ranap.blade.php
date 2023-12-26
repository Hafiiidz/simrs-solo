<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Profesi (PPA)</th>
            <th>Hasil Asesmen Pasien , Intruksi & Tindak Lanjut</th>
            <th>Petugas</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($cppt as $val)
        <tr>
            <td>
                {{ \Carbon\Carbon::parse($val->tgl)->translatedFormat('l, d F Y '); }} <br>
                {{ \Carbon\Carbon::parse($val->jam)->translatedFormat('H:i:s'); }}
            </td>
            <td>{{ $val->profesi }}</td>
            <td>
                <table>
                    <tr>
                        <td>S</td>
                        <td>:</td>
                        <td>{{ $val->subjektif }}</td>
                    </tr>
                    <tr>
                        <td>O</td>
                        <td>:</td>
                        <td>{{ $val->objektif }}</td>
                    </tr>
                    <tr>
                        <td>A</td>
                        <td>:</td>
                        <td>{{ $val->asesmen }}</td>
                    </tr>
                    <tr>
                        <td>P</td>
                        <td>:</td>
                        <td>{{ $val->plan}}</td>
                    </tr>
                </table>
            </td>
            <td>{{ $val->idpetugas }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="4">Tidak Ada Data!</td>
        </tr>
        @endforelse
    </tbody>
</table>
