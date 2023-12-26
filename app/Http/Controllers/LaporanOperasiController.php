<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Operasi\LaporanOperasi;
use App\Models\Rawat;
use App\Models\Pasien\Pasien;
use Illuminate\Support\Collection;
use PDF;

class LaporanOperasiController extends Controller
{
    public function index()
    {
        $data = LaporanOperasi::with('rawat','rawat.pasien');

        if (request()->ajax()) {

            return DataTables::eloquent($data)
            ->addColumn('opsi', function(LaporanOperasi $data) {
                return '
                    <a href="'. route('edit.operasi', $data->id) .'" class="btn btn-sm btn-success">Detail</a>
                    <a href="'. route('cetak-laporan.operasi', $data->id) .'" class="btn btn-sm btn-info" target="_blank">Print</a>
                ';
            })
            ->addColumn('no_rm', function(LaporanOperasi $data) {
                return $data->rawat->no_rm;
            })
            ->addColumn('tanggal', function (LaporanOperasi $data) {
                return Carbon::parse($data->tgl_operasi)->translatedFormat('l, d F Y');
            })
            ->addColumn('status', function (LaporanOperasi $data) {
                return '<span class="badge badge-secondary">'. $data->status .'</span<';
            })
            ->rawColumns(['opsi','tanggal','status','no_rm'])
            ->addIndexColumn()
            ->make();

        }

        return view('operasi.index');
    }

    public function store(Request $request)
    {
        $operasi = new LaporanOperasi;
        $operasi->idrawat = $request->idrawat;
        $operasi->tgl_operasi = $request->tgl_operasi;
        $operasi->diagnosis_prabedah = $request->diagnosis_prabedah;
        $operasi->save();

        return redirect()->back()->with('berhasil', 'Data Berhasil Ditambahkan');
    }

    public function show($id)
    {
        $data = LaporanOperasi::with('rawat','rawat.pasien')->where('id', $id)->first();

        return view('operasi.show', compact('data'));
    }

    public function edit($id)
    {
        $data = LaporanOperasi::with('rawat','rawat.pasien')->where('id', $id)->first();

        return view('operasi.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $jaringan = new Collection([
            'jaringan_kultur' => $request->jaringan_kultur,
            'macam_jaringan' => ($request->jaringan_kultur == 1) ? $request->macam_jaringan : ''
        ]);

        $data = LaporanOperasi::find($id);
        $data->tgl_operasi = $request->tgl_operasi;
        $data->mulai_jam = $request->mulai_jam;
        $data->selesai_jam = $request->selesai_jam;
        $data->lama_operasi = $request->lama_operasi;
        $data->dokter_bedah = json_encode($request->dokter_bedah);
        $data->perawat_bedah = json_encode($request->perawat_bedah);
        $data->asisten = json_encode($request->asisten);
        $data->diagnosis_prabedah = $request->diagnosis_prabedah;
        $data->jenis_operasi = $request->jenis_operasi;
        $data->diagnosis_pasca_bedah = $request->diagnosis_pasca_bedah;
        $data->tindakan_bedah = json_encode($request->tindakan_bedah);
        $data->ahli_anastesi = json_encode($request->ahli_anastesi);
        $data->obat_anastesi = json_encode($request->obat_anastesi);
        $data->jumlah_pendarahan = $request->jumlah_pendarahan;
        $data->kamar_operasi = $request->kamar_operasi;
        $data->uraian_pembedahan = $request->uraian_pembedahan;
        $data->detail_operasi = $request->detail_operasi;
        $data->penata_anastesi  = json_encode($request->penata_anastesi);
        $data->indikasi_operasi = $request->indikasi_operasi;
        $data->posisi = $request->posisi;
        $data->implant = $request->implant;
        $data->jenis_anastesi = $request->jenis_anastesi;
        $data->jumlah_darah_masuk = $request->jumlah_darah_masuk;
        $data->instruksi_post_operasi = $request->instruksi_post_operasi;
        $data->jaringan = $jaringan;
        $data->komplikasi = $request->komplikasi;
        $data->desinfektan_kulit = $request->desinfektan_kulit;
        $data->save();

        return redirect()->route('index.operasi')->with('berhasil','Data Berhasil Disimpan!');
    }

    public function updateStatus(Request $request, $id)
    {
        $data = LaporanOperasi::find($id);
        $data->status = $request->status;
        $data->save();

        return redirect()->route('index.operasi')->with('berhasil','Status Berhasil Disimpan!');
    }

    public function cetakLaporan($id)
    {
        $data = LaporanOperasi::with('rawat','rawat.pasien')->where('id', $id)->first();

        // dd(json_decode($data->dokter_bedah)[0]->dokter_bedah);

        $pdf = PDF::loadview('operasi.cetak.laporan', compact('data'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream();
    }
}
