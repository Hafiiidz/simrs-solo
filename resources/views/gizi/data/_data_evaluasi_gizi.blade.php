<table id="tbl-evaluasi" class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Hari / Tanggal</th>
            <th>Monitoring Evaluasi</th>
            <th>Nama Petugas</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($evaluasi as $val)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ \Carbon\Carbon::parse($val->tanggal)->translatedFormat('l, d F Y'); }}</td>
                <td>{{ $val->monitoring_evaluasi }}</td>
                <td>{{ $val->user->detail->nama }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4">Tidak Ada Data!</td>
            </tr>
        @endforelse
    </tbody>
</table>
