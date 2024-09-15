@extends('layouts.index')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">
                        BHP Operasi
                    </h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted text-hover-primary">Menu</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Pasien</li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Operasi - Input BHP</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--end::Toolbar-->
    
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="card-toolbar">
                        <h1>Total BHP: {{ number_format($total_bhp) }}</h1>
                    </div>
                    <div class="card-title">
                        <h5 class="card-title">Input BHP</h5>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#bhp">BHP</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#implan">Implan</a>
                        </li>
                    </ul>
                    <form action="{{ route('post_bhp_ok.operasi', $operasi_tindakan->id) }}" method="POST" id="frmBhp">
                        @csrf
                        <div class="d-flex justify-content-end mb-5 mt-5">
                            <button type="submit" class="btn btn-primary me-3">Simpan</button>
                            <a href="{{ route('edit.operasi', $data->id) }}" class="btn btn-secondary">Kembali</a>
                        </div>
                        <div class="tab-content">
                            <!-- Tab BHP -->
                            <div class="tab-pane fade show active" id="bhp">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama BHP</th>
                                            <th width="150">Jumlah</th>
                                            <th>Satuan</th>
                                            <th>Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bhp as $key => $item)
                                            @php
                                             $cek_bhp = DB::table('operasi_tindakan_bhp')
                                                                            ->where('nama_obat', $item->nama_barang)
                                                                            ->where('idoperasi', $operasi_tindakan->id)
                                                                            ->where(
                                                                                'idtindakan',
                                                                                $operasi_tindakan->idtindakan,
                                                                            )
                                                                            ->first();
                                                // $cek_bhp = $operasi_tindakan_bhp->firstWhere('nama_obat', $item->nama_barang);
                                            @endphp
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->nama_barang }}</td>
                                                <td>
                                                    <input type="hidden" name="bhp[{{ $key }}][id]" value="{{ $item->id }}">
                                                    <input type="hidden" name="bhp[{{ $key }}][satuan]" value="{{ $item->satuan }}">
                                                    <input type="hidden" name="bhp[{{ $key }}][harga]" value="{{ $item->harga }}">
                                                    <input type="hidden" name="bhp[{{ $key }}][nama]" value="{{ $item->nama_barang }}">
                                                    <input type="text" name="bhp[{{ $key }}][jumlah]" class="form-control form-control-sm" value="{{ $cek_bhp->jumlah ?? null }}">
                                                </td>
                                                <td>{{ $item->satuan }}</td>
                                                <td>{{ number_format($item->harga) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Tab Implan -->
                            <div class="tab-pane fade" id="implan">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Implan</th>
                                            <th width="150">Jumlah</th>
                                            <th>Satuan</th>
                                            <th>Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($implan as $key2 => $item2)
                                            @php
                                                // $cek_implan = $operasi_tindakan_bhp->firstWhere('nama_obat', $item2->nama_barang);
                                                $cek_implan = DB::table('operasi_tindakan_bhp')
                                                                            ->where('nama_obat', $item2->nama_barang)
                                                                            ->where('idoperasi', $operasi_tindakan->id)
                                                                            ->where(
                                                                                'idtindakan',
                                                                                $operasi_tindakan->idtindakan,
                                                                            )
                                                                            ->first();
                                           @endphp
                                            <tr>
                                                <td>{{ $key2 + 1 }}</td>
                                                <td>{{ $item2->nama_barang }}</td>
                                                <td>
                                                    <input type="hidden" name="implan[{{ $key2 }}][id]" value="{{ $item2->id }}">
                                                    <input type="hidden" name="implan[{{ $key2 }}][satuan]" value="{{ $item2->satuan }}">
                                                    <input type="hidden" name="implan[{{ $key2 }}][harga]" value="{{ $item2->harga }}">
                                                    {{-- <input type="hidden" name="implan[{{ $key2 }}][nama_barang]" value="{{ $item2->nama_barang }}"> --}}
                                                    {{-- <input type="hidden" name="implan[{{ $key }}][satuan]" value="{{ $item2->satuan }}">
                                                    <input type="hidden" name="implan[{{ $key }}][harga]" value="{{ $item2->harga }}">
                                                    <input type="hidden" name="implan[{{ $key }}][nama]" value="{{ $item2->nama }}"> --}}
                                                    <input type="text" name="implan[{{ $key2 }}][jumlah]" class="form-control form-control-sm" value="{{ $cek_implan->jumlah ?? null }}">
                                                </td>
                                                <td>{{ $item2->satuan }}</td>
                                                <td>{{ number_format($item2->harga) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end::Content-->
</div>
@endsection

@section('js')
<script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js"></script>
<script>
$(document).ready(function() {
    function handleFormSubmit(formId, message) {
        $(formId).on("submit", function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Simpan Data',
                text: message,
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Ya, Simpan Data',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.blockUI({ message: "<img src='{{ asset('assets/img/loading.gif') }}' width='10%' height='auto'> Tunggu . . ." });
                    this.submit();
                }
            });
        });
    }

    handleFormSubmit("#frmBhp", "Apakah Anda yakin akan menyimpan data ini?");
});
</script>
@endsection
