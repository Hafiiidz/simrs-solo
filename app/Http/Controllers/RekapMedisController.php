<?php

namespace App\Http\Controllers;

use App\Models\Obat\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;
use App\Models\RekapMedis\RekapMedis;
use App\Models\RekapMedis\DetailRekapMedis;
use App\Models\RekapMedis\Kategori;
use App\Models\Pasien\Pasien;
use App\Models\Rawat;
use Illuminate\Support\Facades\DB;

class RekapMedisController extends Controller
{
    public function index_poli($id_rawat)
    {
        // $rawat = DB::table('rawat')->where('id', $id_rawat)->first();
        $rawat = Rawat::find($id_rawat);
        $resume_medis = RekapMedis::with('kategori')->where('idrawat', $rawat->id)->first();
        // dd($resume_medis);
        $resume_detail = [];
        if ($resume_medis) {
            $resume_detail = DetailRekapMedis::with('rekapMedis.kategori')->where('idrekapmedis', $resume_medis->id)->first();
        }
        $pasien = Pasien::with('alamat')->where('no_rm', $rawat->no_rm)->first();
        $kategori = Kategori::get();
        if (request()->ajax()) {
            $rekap = RekapMedis::with('kategori')->where('idpasien', $pasien->id);

            return DataTables::of($rekap)
                ->addColumn('kategori', function (RekapMedis $rekap) {
                    return $rekap->kategori->nama;
                })
                ->addColumn('tanggal', function (RekapMedis $rekap) {
                    return Carbon::parse($rekap->created_at)->translatedFormat('l, d F Y');
                })
                ->addColumn('opsi', function (RekapMedis $rekap) {
                    return '<a href="' . route('detail-rekap-medis-index', $rekap->id) . '" class="btn btn-sm btn-success">Detail</a>';
                })
                ->rawColumns(['kategori', 'tanggal', 'opsi'])
                ->addIndexColumn()
                ->make();
        }
        $obat = Obat::with('satuan')->where('obat.idjenis', 1)->orderBy('obat.nama_obat', 'asc')->get();
        return view('rekap-medis.poliklinik', compact('pasien', 'kategori', 'rawat', 'resume_medis', 'resume_detail', 'obat'));
    }

    public function index($id_pasien)
    {
        $pasien = Pasien::with('alamat')->find($id_pasien);
        $kategori = Kategori::get();
        if (request()->ajax()) {
            $rekap = RekapMedis::with('kategori')->where('idpasien', $id_pasien);

            return DataTables::of($rekap)
                ->addColumn('kategori', function (RekapMedis $rekap) {
                    return $rekap->kategori->nama;
                })
                ->addColumn('tanggal', function (RekapMedis $rekap) {
                    return Carbon::parse($rekap->created_at)->translatedFormat('l, d F Y');
                })
                ->addColumn('opsi', function (RekapMedis $rekap) {
                    return '<a href="' . route('detail-rekap-medis-index', $rekap->id) . '" class="btn btn-sm btn-success">Detail</a>';
                })
                ->rawColumns(['kategori', 'tanggal', 'opsi'])
                ->addIndexColumn()
                ->make();
        }

        return view('rekap-medis.index', compact('pasien', 'kategori'));
    }

    public function store(Request $request)
    {
        $rekap = new RekapMedis;
        $rekap->idkategori = $request->kategori;
        $rekap->idpasien = $request->id_pasien;
        $rekap->save();



        return redirect()->back()->with('berhasil', 'Data Rekam Medis Berhasil Ditambahkan');
    }

    public function input_resume_poli(Request $request)
    {
        $resume = new RekapMedis;
        $resume->idkategori = $request->idkategori;
        $resume->idrawat = $request->idrawat;
        $resume->idpasien = $request->idpasien;
        $resume->save();

        $data = RekapMedis::find($resume->id);
        $pasien = Pasien::with('alamat')->find($data->idpasien);
        $kategori = Kategori::find($data->idkategori);
        $obat = Obat::with('satuan')->where('obat.idjenis', 1)->orderBy('obat.nama_obat', 'asc')->get();
        return view('detail-rekap-medis.create', compact('pasien', 'kategori', 'data', 'obat'));

        // return redirect(route('detail-rekap-medis-show',$detail_resume->id))->with('berhasil','Data Resume Berhasil Ditambahkan');
    }
}
