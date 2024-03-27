<table class="table table-bordered">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Penunjang</th>
            <th>Status</th>
            <th>Tindakan</th>
            <th>#</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($penunjang as $p)
            @if ($p->pemeriksaan_penunjang != 'null')
            <tr>
                <td>{{ $p->created_at }}</td>
                <td>{{ $p->jenis_penunjang }}</td>
                <td>{{ $p->status_pemeriksaan }}</td>
                <td>
                    <ul>
                        @if ($p->pemeriksaan_penunjang != 'null')
                            @foreach (json_decode($p->pemeriksaan_penunjang) as $pen)
                                @if ($p->jenis_penunjang == 'Lab')
                                    @foreach ($lab as $l)
                                        @if ($l->id == $pen->tindakan_lab)
                                            <li>{{ $l->nama_pemeriksaan }} @if ($p->status_pemeriksaan == 'Selesai')
                                                    @php
                                                        $hasil = DB::table('laboratorium_hasildetail')
                                                            ->where('no_rm', $rawat->no_rm)
                                                            ->where('idpengantar', $p->id)
                                                            ->where('idpemeriksaan', $pen->tindakan_lab)
                                                            ->first();
                                                        // dd($hasil);
                                                    @endphp
                                                    <button onclick="modalHasilLab({{ $hasil?->id }})"
                                                        class="btn btn-sm btn-secondary">Lihat Hasil</button>
                                                @endif
                                            </li>
                                        @endif
                                    @endforeach
                                @elseif($p->jenis_penunjang == 'Radiologi')
                                    @foreach ($radiologi as $rad)
                                        @if ($rad->id == $pen?->tindakan_rad)
                                            <li>{{ $rad->nama_tindakan }} @if ($p->status_pemeriksaan == 'Selesai')
                                                    @php
                                                        $hasil = DB::table('radiologi_hasildetail')
                                                            ->where('idpengantar', $p->id)
                                                            ->first();
                                                    @endphp
                                                    <button onclick="modalHasilRad({{ $hasil?->id }})"
                                                        class="btn btn-sm btn-secondary">Lihat Hasil</button>
                                                @endif
                                            </li>
                                        @endif
                                    @endforeach
                                @else
                                    @foreach ($fisio_tindakan as $f)
                                        @if ($f->id == $pen?->tindakan_fisio)
                                            <li>{{ $f->nama_tarif }} 
                                                @if ($p->status_pemeriksaan == 'Selesai')
                                                    {{-- @php
                                                        $hasil = DB::table('radiologi_hasildetail')
                                                            ->where('idpengantar', $p->id)
                                                            ->first();
                                                    @endphp
                                                    <button onclick="modalHasilRad({{ $hasil->id }})"
                                                        class="btn btn-sm btn-secondary">Lihat Hasil</button> --}}
                                                @endif
                                            </li>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </td>
                <td>
                    @if ($p->status_pemeriksaan == 'Antrian')
                        <button class="btn btn-sm btn-danger btn-icon btn-hapus-penunjang"
                            data-id="{{ $p->id }}"><i class="fa fa-trash"></i></button>
                        <button class="btn btn-sm btn-warning btn-icon btn-edit-penunjang"
                            data-id="{{ $p->id }}"><i class="fa fa-pencil"></i></button>
                    @endif
                </td>
            </tr>
            @endif
            
        @endforeach
    </tbody>
</table>
