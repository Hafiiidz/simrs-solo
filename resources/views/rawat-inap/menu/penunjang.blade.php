<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Penunjang</th>
            <th>Status</th>
            <th>Tindakan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($penunjang as $p)
            <tr>
                <td>{{ $p->created_at }}</td>
                <td>{{ $p->jenis_penunjang }}</td>
                <td>{{ $p->status_pemeriksaan }}</td>
                <td>
                    <ul>
                        @foreach (json_decode($p->pemeriksaan_penunjang) as $pen)
                            @if ($p->jenis_penunjang == 'Lab')
                                @foreach ($lab as $l)
                                    @if ($l->id == $pen->tindakan_lab)
                                        <li>{{ $l->nama_pemeriksaan }}</li>
                                    @endif
                                @endforeach
                            @else
                                @foreach ($radiologi as $rad)
                                    @if ($rad->id == $pen->tindakan_rad)
                                        <li>{{ $rad->nama_tindakan }}</li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </ul>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
