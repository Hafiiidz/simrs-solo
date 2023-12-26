<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LaboratoriumController extends Controller
{
    #list pemeriksaan
    public function index()
    {
        if (request()->ajax()) {
            $query = DB::table('laboratorium_hasil')
                ->join('rawat', 'rawat.id', '=', 'laboratorium_hasil.idrawat')
                ->leftjoin('poli', 'poli.id', '=', 'rawat.idpoli')
                ->leftjoin('dokter', 'dokter.id', '=', 'rawat.iddokter')
                ->leftjoin('ruangan', 'ruangan.id', '=', 'rawat.idruangan')
                ->leftJoin('rawat_jenis', 'rawat_jenis.id', '=', 'rawat.idjenisrawat')
                ->join('pasien', 'pasien.no_rm', '=', 'rawat.no_rm')
                ->select([
                    'laboratorium_hasil.*',
                    'poli.poli',
                    'dokter.nama_dokter',
                    'ruangan.nama_ruangan',
                    'rawat_jenis.jenis',
                    'pasien.nama_pasien',
                    'rawat.no_rm',
                ])->orderBy('tgl_hasil', 'desc');
            return DataTables::query($query)
                ->addColumn('pemeriksaan', function ($query) {
                    $pemeriksaan = DB::table('laboratorium_hasildetail')->where('idhasil', $query->id)->get();
                    $html = '';
                    $html .= '<ul>';
                    foreach ($pemeriksaan as $p) {
                        $html .= '<li>' . $p->nama_pemeriksaan . '</li>';
                    }
                    $html .= '</ul>';
                    return $html;
                })
                ->addIndexColumn()
                ->rawColumns(['pemeriksaan'])
                ->make(true);
        }

        return view('laboratorium.index');
    }

    #list pasien
    public function pasien()
    {
        if (request()->ajax()) {
            $rawat = DB::table('rawat')
                ->select([
                    'rawat.id',
                    'rawat.iddokter',
                    'pasien.no_rm',
                    'pasien.nama_pasien',
                    'rawat.tglmasuk',
                    'poli.poli',
                    'dokter.nama_dokter',
                    'rawat_bayar.bayar',
                    'rawat_status.status',
                    'rekap_medis.dokter',
                    'rekap_medis.perawat',
                    'rawat_jenis.jenis',
                    'ruangan.nama_ruangan',
                ])
                ->join('pasien', 'pasien.no_rm', '=', 'rawat.no_rm')
                ->join('poli', 'poli.id', '=', 'rawat.idpoli')
                ->join('rawat_bayar', 'rawat_bayar.id', '=', 'rawat.idbayar')
                ->join('rawat_status', 'rawat_status.id', '=', 'rawat.status')
                ->Leftjoin('dokter', 'dokter.id', '=', 'rawat.iddokter')
                ->Leftjoin('demo_rekap_medis as rekap_medis', 'rekap_medis.idrawat', '=', 'rawat.id')
                ->leftJoin('rawat_jenis', 'rawat_jenis.id', '=', 'rawat.idjenisrawat')
                ->leftJoin('ruangan', 'ruangan.id', '=', 'rawat.idruangan')
                ->where('rawat_status.status', '!=', 5)->orderBy('rawat.tglmasuk', 'desc');
                return DataTables::query($rawat)
                ->addColumn('opsi', function ($rawat) {
                    return '<a href="' . route('rekam-medis-poli', $rawat->id) . '" class="btn btn-sm btn-success">Lihat</a>';
                })
                ->rawColumns(['opsi'])
                ->make(true);
        }

        return view('laboratorium.pasien');
    }

    #view hasil
    public function hasil()
    {
        return view('laboratorium.hasil');
    }

    #view hasil pasien
    public function hasilPasien()
    {
        return view('laboratorium.hasil-pasien');
    }
}
