<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Tindakan</th>
            <th>Dokter</th>
            <th>Bayar</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list_tindakan as $tindakan)
            <tr>
                <td>{{ $tindakan->created_at }}</td>
                <td>
                    @foreach ($tarif as $t)
                        @if ($t->id == $tindakan->idtindakan)
                            {{ $t->nama_tarif }}
                        @endif
                    @endforeach
                </td>
                <td>{{ $tindakan->iddokter }}</td>
                <td>{{ $rawat->bayar->bayar }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
