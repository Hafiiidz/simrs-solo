<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan\Ruangan;
use App\Models\Ruangan\RuanganBed;
use App\Models\Ruangan\RuanganKelas;
use App\Models\Ruangan\RuanganJenis;
use App\Models\Ruangan\RuanganGender;
use Yajra\DataTables\Facades\DataTables;

class RuanganBedController extends Controller
{
    public function index($id_ruangan)
    {
        $ruangan = Ruangan::with('kelas','bed','jenisRuangan','genderRuangan')->find($id_ruangan);

        if (request()->ajax()) {
            $bed = RuanganBed::where('idruangan', $id_ruangan);

            return DataTables::of($bed)
            ->addColumn('opsi', function(RuanganBed $bed) {
                return '<a onClick="editBed('. $bed->id .')" class="btn btn-sm btn-success">Edit</a>';
            })

            ->addColumn('status', function(RuanganBed $bed) {
                return ($bed->status == 1) ? 'Aktif' : 'Tidak Aktif';
            })
            ->rawColumns(['opsi','status'])
            ->addIndexColumn()
            ->make();
        }

        return view('ruangan.bed.index', compact('ruangan'));
    }

    public function store(Request $request)
    {
        $bed = new RuanganBed;
        $bed->idruangan = $request->idruangan;

        $jumlah_kode = RuanganBed::where('kodebed','!=', null)->count();
        $jumlah_kode++;
        $kodebed = 'BED' . str_pad($jumlah_kode, 4, '0', STR_PAD_LEFT);
        $bed->kodebed = $kodebed;

        $bed->status = $request->status;
        $bed->idjenis = $request->idjenis;
        $bed->terisi = 0;
        $bed->bayi = $request->bayi;
        $bed->save();

        return redirect()->back()->with('berhasil','Data BED Berhasil Di Simpan!');
    }

    public function edit(Request $request)
    {
        $bed = RuanganBed::with('ruangan','jenisRuangan')->where('id', $request->id_bed)->first();

        return response()->json([
            'status' => true,
            'data' => $bed
        ]);
    }

    public function update(Request $request)
    {
        $bed = RuanganBed::find($request->id_bed);
        $bed->bayi = $request->bayi;
        $bed->status = $request->status;
        $bed->save();

        return redirect()->back()->with('berhasil','Data BED Berhasil Di Edit!');
    }
}
