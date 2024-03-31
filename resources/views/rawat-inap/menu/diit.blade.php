<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Tgl</th>
            <th>Diit</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($gizi as $g)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $g->tgl }}</td>
                <td>{{ $g->diit }}</td>
                <td>
                    <a href="{{ route('label.gizi',$g->id) }}" class="btn btn-sm btn-success">Print Label</a>
                    <a href="{{ route('delete.gizi',$g->id) }}" onclick="return confirm('Are you sure?');" class="btn btn-sm btn-danger">Hapus</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
