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
            <td>{{ \Carbon\Carbon::parse($val->tanggal)->translatedFormat('l, d F Y H:i:s'); }}</td>
            <td>{{ $val->profesi }}</td>
            <td>
                <table>
                    <tr>
                        <td>A</td>
                        <td>:</td>
                        <td>{{ json_decode($val->hasil)->a }}</td>
                    </tr>
                    <tr>
                        <td>D</td>
                        <td>:</td>
                        <td>{{ json_decode($val->hasil)->d }}</td>
                    </tr>
                    <tr>
                        <td>I</td>
                        <td>:</td>
                        <td>{{ json_decode($val->hasil)->i }}</td>
                    </tr>
                    <tr>
                        <td>M</td>
                        <td>:</td>
                        <td>{{ json_decode($val->hasil)->m }}</td>
                    </tr>
                    <tr>
                        <td>E</td>
                        <td>:</td>
                        <td>{{ json_decode($val->hasil)->e }}</td>
                    </tr>
                </table>
            </td>
            <td>{{ $val->user->detail->nama }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="4">Tidak Ada Data!</td>
        </tr>
        @endforelse
    </tbody>
</table>
