<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Tindakan</th>
            <th>Profesi</th>
            <th>Dokter</th>
            <th>Bayar</th>
            <th>Jumlah</th>
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
                <td>{{ $tindakan->profesi }}</td>
                <td>{{ App\Helpers\VclaimHelper::getDokterSimrs($tindakan->iddokter) }}</td>
                <td>{{ $rawat->bayar->bayar }}</td>
                <td>{{ $tindakan->jumlah }}</td>
                <td>
                    @if($rawat->status == 2)
                    <a href="{{ route('delete-tindakan.rawat-inap',$tindakan->id) }}" onclick="return confirm('Hapus Tindakan ?')" class="btn btn-sm btn-light-danger">Hapus</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
