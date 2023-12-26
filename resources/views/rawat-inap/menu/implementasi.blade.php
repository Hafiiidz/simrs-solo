<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tgl & Jam</th>
            <th>Implementasi</th>
            <th>Petugas</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($implamentasi as $val)
        <tr>
            <td>{{ \Carbon\Carbon::parse($val->tgl)->translatedFormat('l, d F Y H:i:s'); }}</td>
            <td>{{ $val->implementasi }}</td>
            <td>{{ $val->idpetugas }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="3">Tidak Ada Data!</td>
        </tr>
        @endforelse
    </tbody>
</table>