<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Tindakan</th>
            <th>Dokter</th>
            <th>Bayar</th>
            <th>Aksi</th>
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
                <td>{{ App\Helpers\VclaimHelper::getDokterSimrs($tindakan->iddokter) }}</td>
                <td>{{ $rawat->bayar->bayar }}</td>
                <td>
                    <a href="{{ route('delete-tindakan.rawat-inap',$tindakan->id) }}" onclick="return confirm('Hapus Tindakan ?')" class="btn btn-sm btn-light-danger">Hapus</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
