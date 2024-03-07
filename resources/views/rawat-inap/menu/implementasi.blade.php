<table class="table table-bordered">
    <thead>
        <tr>
            <th>
                #
            </th>
            <th>Tgl & Jam</th>
            <th>Implementasi</th>
            <th>Petugas</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($implamentasi as $val)
        <tr>
            <td>
                <button data-id="{{ $val->id }}" class="btn btn-sm btn-light-warning btn-icon btn-edit-implementasi">
                    <i class="fa fa-pencil"></i>
                </button>
                <button data-id="{{ $val->id }}" class="btn btn-sm btn-light-danger btn-icon btn-hapus-implementasi">
                    <i class="fa fa-trash"></i>
                </button>
            </td>
            <td>{{ \Carbon\Carbon::parse($val->tgl)->translatedFormat('l, d F Y'); }} {{ date('H:i',strtotime($val->jam)) }}</td>
            <td>{{ $val->implementasi }}</td>
            <td>{{ \App\Helpers\VclaimHelper::getDataUser($val->idpetugas) }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="3">Tidak Ada Data!</td>
        </tr>
        @endforelse
    </tbody>
</table>