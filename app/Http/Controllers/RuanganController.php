<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan\Ruangan;
use App\Models\Ruangan\RuanganBed;
use App\Models\Ruangan\RuanganKelas;
use App\Models\Ruangan\RuanganJenis;
use App\Models\Ruangan\RuanganGender;
use Yajra\DataTables\Facades\DataTables;

class RuanganController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $ruangan = Ruangan::with('kelas','bed','jenisRuangan','genderRuangan');

            return DataTables::of($ruangan)
            ->addColumn('opsi', function(Ruangan $ruangan) {
                return '<a href="'. route('index.ruangan-bed', $ruangan->id) .'" class="btn btn-sm btn-success">Detail</a>';
            })
            ->addColumn('kelas', function(Ruangan $ruangan) {
                return $ruangan->kelas->kelas;
            })
            ->addColumn('ruangan_jenis', function(Ruangan $ruangan) {
                return $ruangan->jenisRuangan->ruangan_jenis;
            })
            ->addColumn('gender', function(Ruangan $ruangan) {
                return $ruangan->genderRuangan->gender;
            })
            ->rawColumns(['opsi','kelas','ruangan_jenis','gender'])
            ->addIndexColumn()
            ->make();
        }

        $jenis = RuanganJenis::get();
        $gender = RuanganGender::get();
        $kelas = RuanganKelas::get();

        return view('ruangan.index', compact('jenis','gender','kelas'));
    }

    public function store(Request $request)
    {
        $ruangan = new Ruangan;
        $ruangan->idjenis = $request->jenis_ruangan;
        $ruangan->nama_ruangan = $request->nama;
        $ruangan->kapasitas = 0;
        $ruangan->gender = $request->gender;
        $ruangan->idkelas = $request->kelas;
        $ruangan->status = $request->status;
        $ruangan->jenis = 2;
        $ruangan->keterangan = $request->keterangan;

        $jumlah_kode = Ruangan::where('kode_ruangan','!=', null)->count();
        $jumlah_kode++;
        $kode_ruangan = 'RG' . str_pad($jumlah_kode, 3, '0', STR_PAD_LEFT);

        $ruangan->kode_ruangan = $kode_ruangan;
        $ruangan->save();

        return redirect()->back()->with('berhasil','Data Ruangan Berhasil Di Simpan!');
    }
}
