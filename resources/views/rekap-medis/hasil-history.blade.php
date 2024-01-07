<div class="modal-header">
    <h3 class="modal-title">Riwayat Berobat</h3>
    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
        <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
    </div>
</div>
<div class="modal-body fs-7">
    <div class="row">
        <div class="col-md-12">
            <div class="row mb-2">
                <!--begin::Label-->
                <label class="col-lg-2 fw-semibold text-muted">Poli</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                    <span class="fw-bold fs-6 text-gray-800">{{ $rawat->poli?->poli }}</span>
                </div>
                <!--end::Col-->
            </div>
            <div class="row mb-2">
                <!--begin::Label-->
                <label class="col-lg-2 fw-semibold text-muted">Dokter</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                    <span
                        class="fw-bold fs-6 text-gray-800">{{ $rawat->dokter?->nama_dokter }}</span>
                </div>
                <!--end::Col-->
            </div>
            <div class="row mb-2">
                <!--begin::Label-->
                <label class="col-lg-2 fw-semibold text-muted">Tgl.Berobat</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                    @php
                        setlocale(LC_ALL, 'IND');
                    @endphp
                    <span
                        class="fw-bold fs-6 text-gray-800">{{ \Carbon\Carbon::parse($rawat->tglmasuk)->formatLocalized('%A %d %B %Y') }}
                        {{ date('H:i:s', strtotime($rawat->tglmasuk)) }}</span>
                </div>
                <!--end::Col-->
            </div>
            <div class="row mb-2">
                <!--begin::Label-->
                <label class="col-lg-2 fw-semibold text-muted">Penanggung</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">

                    <span class="fw-bold fs-6 text-gray-800">{{ $rawat->bayar->bayar }}</span>
                </div>
                <!--end::Col-->
            </div>
            <div class="separator separator-dashed border-secondary mb-5 mt-5">
            </div>

            <div class="rounded border p-5">
                <div class="mb-5 hover-scroll-x">
                    <div class="d-grid">
                        <ul class="nav nav-tabs flex-nowrap text-nowrap" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0 active"
                                    data-bs-toggle="tab" href="#rm_pasien" aria-selected="true"
                                    role="tab">Resume Medis</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0"
                                    data-bs-toggle="tab" href="#penunjang_pasien" aria-selected="false"
                                    role="tab" tabindex="-1">Pemeriksaan Penunjang</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade" id="penunjang_pasien" role="tabpanel">
                        <h5>Hasil Pemeriksaan Lab</h5>
                                    <div class="separator separator-dashed border-secondary mt-5 mb-5"></div>
                                    @if ($pemeriksaan_lab)
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Pemeriksaan</th>
                                                    <th>Tgl Pemeriksaan</th>
                                                    <th>Pemeriksaan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pemeriksaan_lab as $pl)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $pl->labid }}</td>
                                                        <td>{{ $pl->tgl_hasil }}</td>
                                                        <td>
                                                            @php
                                                                $pemeriksaan_lab_detail = DB::table('laboratorium_hasildetail')
                                                                    ->where('idhasil', $pl->id)
                                                                    ->get();
                                                            @endphp
                                                            <ul>
                                                                @foreach ($pemeriksaan_lab_detail as $plb)
                                                                    <li>
                                                                        <a href="">{{ $plb->nama_pemeriksaan }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    @endif
                                    <h5>Hasil Pemeriksaan Radiologi</h5>
                                    <div class="separator separator-dashed border-secondary mt-5 mb-5"></div>
                                    @if ($pemeriksaan_radiologi)
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Pemeriksaan</th>
                                                    <th>Tgl Pemeriksaan</th>
                                                    <th>Pemeriksaan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pemeriksaan_radiologi as $pr)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $pr->idhasil }}</td>
                                                        <td>{{ $pr->tgl_hasil }}</td>
                                                        <td>
                                                            @php
                                                                $pemeriksaan_radio_detail = DB::table('radiologi_hasildetail')
                                                                    ->where('idhasil', $pr->id)
                                                                    ->get();
                                                            @endphp
                                                            <ul>
                                                                @foreach ($pemeriksaan_radio_detail as $pld)
                                                                    @php
                                                                        $tindakan = DB::table('radiologi_tindakan')
                                                                            ->where('id', $pld->idtindakan)
                                                                            ->first();
                                                                    @endphp
                                                                    <li>
                                                                        <a href="#" onclick="modalHasilRad({{ $pld->id }})">{{ $tindakan->nama_tindakan }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>

                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    @endif
                    </div>
                    <div class="tab-pane fade show active" id="rm_pasien" role="tabpanel">
                        <table class="table table-striped table-row-bordered gy-3 gs-5 border rounded">
                            <thead class="border">
                                <tr class="fw-bold fs-7 text-gray-800 px-7">
                                    <th>Diagnosa</th>
                                    <th>Anamnesa</th>
                                    <th>Rencana Pemeriksaan</th>
                                    <th>Terapi</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($resume_detail)
                                    @php
                                        $alergi = json_decode($resume_detail->alergi);
                                        $pfisik = json_decode($resume_detail->pemeriksaan_fisik);
                                        $rkesehatan = json_decode($resume_detail->riwayat_kesehatan);
                                    @endphp
                                    <tr>
                                        <td width=300>
                                            {{ $resume_detail?->diagnosa }}
                                            <div
                                                class="separator separator-dashed border-secondary mb-5">
                                            </div>
                                            <h5>ICD X</h5>
                                            <ul>
                                                @foreach (json_decode($resume_detail->icdx) as $val)
                                                    <li>{{ $val->diagnosa_icdx }}
                                                        (<b>{{ $val->jenis_diagnosa == 'P' ? 'Primer' : 'Sekunder' }}</b>)
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <div
                                                class="separator separator-dashed border-secondary mb-5">
                                            </div>
                                            <h5>ICD IX</h5>
                                            <ul>
                                                @foreach (json_decode($resume_detail->icd9) as $val)
                                                    <li>{{ $val->diagnosa_icd9 }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td width=300>{{ $resume_detail?->anamnesa_dokter }}</td>
                                        <td>
                                            {{ $resume_detail?->rencana_pemeriksaan }}
                                            @if ($resume_detail->radiologi != 'null')
                                                <div
                                                    class="separator separator-dashed border-secondary mb-5">
                                                </div>
                                                <h5>Radiologi</h5>
                                                <ul>
                                                    @foreach (json_decode($resume_detail->radiologi) as $val)
                                                        @foreach ($radiologi as $item)
                                                            @if ($val->tindakan_rad == $item->id)
                                                                <li>{{ $item->nama_tindakan }}</li>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </ul>
                                            @endif
                                            @if ($resume_detail->laborat != 'null')
                                                <div
                                                    class="separator separator-dashed border-secondary mb-5">
                                                </div>
                                                <h5>Lab</h5>
                                                <ul>
                                                    @foreach (json_decode($resume_detail->laborat) as $val)
                                                        @foreach ($lab as $item)
                                                            @if ($val->tindakan_lab == $item->id)
                                                                <li>{{ $item->nama_pemeriksaan }}</li>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </ul>
                                            @endif
                                            @if ($resume_detail->fisio != 'null')
                                                <div
                                                    class="separator separator-dashed border-secondary mb-5">
                                                </div>
                                                <h5>Fisio</h5>
                                                <ul>
                                                    @foreach (json_decode($resume_detail->fisio) as $val)
                                                        @foreach ($fisio as $item)
                                                            @if ($val->tindakan_fisio == $item->id)
                                                                <li>{{ $item->nama_tarif }}</li>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $resume_detail?->terapi }}
                                            <div
                                                class="separator separator-dashed border-secondary mb-5">
                                            </div>
                                            @if ($resume_detail->terapi_obat != 'null')
                                                <h5>Obat & Alkes</h5>
                                                <ul>
                                                    @foreach (json_decode($resume_detail->terapi_obat) as $val)
                                                        @foreach ($obat as $item)
                                                            @if ($val->obat == $item->id)
                                                                <li>{{ $item->nama_obat }}
                                                                    ({{ $val->signa1 }} x
                                                                    {{ $val->signa2 }} |
                                                                    {{ $val->jumlah_obat }})
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </td>
                                        <td>
                                            @can('dokter')
                                                @if ($resume_detail->terapi_obat != 'null')
                                                    <a href="{{ route('resep-rekap-medis-cetak', $resume_detail->id) }}"
                                                        class="btn btn-info btn-sm">Print Resep</a>
                                                @endif
                                            @endcan
                                        </td>
                                    </tr>
                                @endif
                        
                            </tbody>
                        </table>
                        <div class="separator separator-dashed border-secondary mb-5 mt-5">
                        </div>
                        <table class="table table-striped table-row-bordered gy-3 gs-5 border rounded">
                            <thead class="border">
                                <tr class="fw-bold fs-7 text-gray-800 px-7">
                                    <th>Anamnesa Perawat</th>
                                    <th>Pemeriksaan Fisik</th>
                                    <th>Riwayat Kesehatan</th>
                                    <th>Alergi</th>
                                    <th>Obat yang dikonsumsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($resume_detail)
                                    <td>{{ $resume_medis->anamnesa }}</td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td>&nbsp;&nbsp;Tekanan Darah</td>
                                                <td class="text-start">:
                                                    {{ $pfisik->tekanan_darah ? $pfisik->tekanan_darah : '-' }}
                                                    mmHg</td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;&nbsp;Nadi</td>
                                                <td class="text-start">:
                                                    {{ $pfisik->nadi ? $pfisik->nadi : '-' }} x/menit
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;&nbsp;Pernapasan</td>
                                                <td class="text-start">:
                                                    {{ $pfisik->pernapasan ? $pfisik->pernapasan : '-' }}
                                                    x/menit</td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;&nbsp;Suhu</td>
                                                <td class="text-start">:
                                                    {{ $pfisik->suhu ? $pfisik->suhu : '-' }} celcius
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;&nbsp;Berat Badan</td>
                                                <td class="text-start">:
                                                    {{ $pfisik->berat_badan ? $pfisik->berat_badan : '-' }}
                                                    Kg</td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;&nbsp;Tinggi Badan</td>
                                                <td class="text-start">:
                                                    {{ $pfisik->tinggi_badan ? $pfisik->tinggi_badan : '-' }}
                                                    Cm</td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;&nbsp;BMI</td>
                                                <td class="text-start">:
                                                    {{ $pfisik->bmi ? $pfisik->bmi : '-' }} Kg/M2</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td>&nbsp;&nbsp;Riwayat penyakit yang lalu</td>
                                                <td class="text-start">:
                                                    {{ $rkesehatan->riwayat_1 == 1 ? 'Ya' : 'Tidak' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;&nbsp;Pernah dirawat</td>
                                                <td class="text-start">:
                                                    {{ $rkesehatan->riwayat_2 == 1 ? 'Ya' : 'Tidak' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;&nbsp;Pernah dioperasi</td>
                                                <td class="text-start">:
                                                    {{ $rkesehatan->riwayat_3 == 1 ? 'Ya' : 'Tidak' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;&nbsp;Dalam Pengobatan Khusus</td>
                                                <td class="text-start">:
                                                    {{ $rkesehatan->riwayat_4 == 1 ? 'Ya' : 'Tidak' }}
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <ul>
                                            <li>Obat :
                                                <b>{{ $alergi->value_obat ? $alergi->value_obat : '-' }}</b>
                                            </li>
                                            <li>Makanan :
                                                <b>{{ $alergi->value_makanan ? $alergi->value_makanan : '-' }}</b>
                                            </li>
                                            <li>Lain Lain :
                                                <b>{{ $alergi->value_lain ? $alergi->value_lain : '-' }}</b>
                                            </li>
                                        </ul>
                                    </td>
                                    <td>{{ $resume_detail->obat_yang_dikonsumsi }}</td>
                                   
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
</div>