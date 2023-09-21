<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;
use App\Models\RekapMedis\RekapMedis;
use App\Models\RekapMedis\DetailRekapMedis;
use App\Models\RekapMedis\Kategori;
use App\Models\Pasien\Pasien;

class RekapMedisController extends Controller
{
    public function index($id_pasien)
    {
        $pasien = Pasien::with('alamat')->find($id_pasien);
        $kategori = Kategori::get();
        if (request()->ajax()) {
            $rekap = RekapMedis::with('kategori')->where('idpasien', $id_pasien);

            return DataTables::of($rekap)
            ->addColumn('kategori', function(RekapMedis $rekap) {
                return $rekap->kategori->nama;
            })
            ->addColumn('tanggal', function(RekapMedis $rekap) {
                return Carbon::parse($rekap->created_at)->translatedFormat('l, d F Y');
            })
            ->addColumn('opsi', function(RekapMedis $rekap) {
                return '<a href="'. route('detail-rekap-medis-index', $rekap->id) .'" class="btn btn-sm btn-success">Detail</a>';
            })
            ->rawColumns(['kategori','tanggal','opsi'])
            ->addIndexColumn()
            ->make();
        }

        return view('rekap-medis.index', compact('pasien','kategori'));
    }

    public function store(Request $request)
    {
        $rekap = new RekapMedis;
        $rekap->idkategori = $request->kategori;
        $rekap->idpasien = $request->id_pasien;
        $rekap->save();

        return redirect()->back()->with('berhasil','Data Rekap Medis Berhasil Ditambahkan');
    }
}
