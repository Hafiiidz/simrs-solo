<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Diagnosis Prabedah</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data_operasi as $data)
            <tr>
                <td>{{ \Carbon\Carbon::parse($data->tgl_operasi)->translatedFormat('l, d F Y'); }}</td>
                <td>{{ $data->diagnosis_prabedah }}</td>
                <td class="text-center"><span class="badge badge-success">{{ $data->status }}</span></td>
                <td class="text-center">
                    <a href="{{ route('show.operasi', $data->id) }}" class="btn btn-primary btn-sm" target="_blank">Detail</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">Tidak Ada Data!</td>
            </tr>
        @endforelse
    </tbody>
</table>
