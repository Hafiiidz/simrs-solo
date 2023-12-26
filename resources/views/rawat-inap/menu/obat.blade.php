<h5>Order Obat</h5>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tanggal Order</th>
            <th>Status Order</th>
            <th>Obat</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order_obat as $o)
            <tr>
                <td>{{ $o->created_at }}</td>
                <td>{{ $o->status_antrian }}</td>
                <td>
                    @foreach (json_decode($o->obat) as $list_obat)
                        @foreach ($obat as $item)
                            @if ($list_obat->obat == $item->id)
                                {{ $item->nama_obat }} - {{ $list_obat->jumlah_obat }} <br>
                            @endif
                        @endforeach
                    @endforeach
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="separator separator-dashed border-secondary mt-5 mb-5"></div>
<h5>Pemberian Obat</h5>
<table class="table table-bordered">
    <tbody>
        @foreach ($pemberian_obat as $po)
            <tr>
                <th colspan="8">
                    Tgl : {{ $po->tgl }}
                </th>
            </tr>
            <tr>
                <th>No</th>
                <th>Jenis Obat</th>
                <th>Nama Obat</th>
                <th>Qty</th>
                <th>Rute</th>
                <th>Signa</th>
                <th>Waktu Petugas</th>
            </tr>
            @foreach (json_decode($po->pemberian_obat) as $val)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $po->jenis }}</td>
                    <td>{{ $val->nama_obat }}</td>
                    <td>{{ $val->jumlah_obat }}</td>
                    <td>{{ $val->rute }}</td>
                    <td>{{ $val->signa }}</td>
                    <td>
                        @foreach ($val->obat_obatan as $obat)
                            Jam :{{ $obat->jam }} <br>
                            Initial :{{ $obat->initial }}<br>
                            <div class="separator separator-dashed border-secondary mt-5 mb-5"></div>
                        @endforeach

                </tr>
            @endforeach
        @endforeach

    </tbody>
</table>
