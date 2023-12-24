<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien\Pasien;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PoliklinikController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {

            $rawat = DB::table('rawat')
                ->select([
                    'rawat.id',
                    'pasien.no_rm',
                    'pasien.nama_pasien',
                    'rawat.tglmasuk',
                    'poli.poli',
                    'dokter.nama_dokter',
                    'rawat_bayar.bayar',
                    'rawat_status.status',
                    'rekap_medis.dokter',
                    'rekap_medis.perawat',
                ])
                ->join('pasien', 'pasien.no_rm', '=', 'rawat.no_rm')
                ->join('poli', 'poli.id', '=', 'rawat.idpoli')
                ->join('rawat_bayar', 'rawat_bayar.id', '=', 'rawat.idbayar')
                ->join('rawat_status', 'rawat_status.id', '=', 'rawat.status')
                ->Leftjoin('dokter', 'dokter.id', '=', 'rawat.iddokter')
                ->Leftjoin('demo_rekap_medis as rekap_medis', 'rekap_medis.idrawat', '=', 'rawat.id')
                ->where('rawat.idpoli', auth()->user()->detail->idpoli)
                ->whereDate('rawat.tglmasuk', date('Y-m-d'));
            if (auth()->user()->detail->dokter == 1) {
                $rawat->where('rawat.iddokter', auth()->user()->detail->iddokter)->orderBy('tglmasuk', 'desc');
            } else {
                $rawat->orderBy('tglmasuk', 'desc');
            }
            return DataTables::query($rawat)
                ->addColumn('opsi', function ($rawat) {
                    return '<a href="' . route('rekam-medis-poli', $rawat->id) . '" class="btn btn-sm btn-success">Lihat</a>';
                })
                ->addColumn('status_pemeriksaan', function ($rawat) {
                    #span class="badge badge-success">Selesai</span>
                    if ($rawat->perawat == 1) {
                        $color_perawat = 'primary';
                    } else {
                        $color_perawat = 'danger';
                    }
                    if ($rawat->dokter == 1) {
                        $color_dokter = 'primary';
                    } else {
                        $color_dokter = 'danger';
                    }
                    $perawat = '<span class="badge badge-' . $color_perawat . '">Perawat</span>';
                    $dokter = '<span class="badge badge-' . $color_dokter . '">Dokter</span>';

                    return $dokter . ' ' . $perawat;
                })
                ->rawColumns(['opsi', 'status_pemeriksaan'])
                ->make(true);
        }
        return view('poliklinik.index');
        // return auth()->user()->detail->idpoli;
    }

    public function index_semua()
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
                ])
                ->join('pasien', 'pasien.no_rm', '=', 'rawat.no_rm')
                ->join('poli', 'poli.id', '=', 'rawat.idpoli')
                ->join('rawat_bayar', 'rawat_bayar.id', '=', 'rawat.idbayar')
                ->join('rawat_status', 'rawat_status.id', '=', 'rawat.status')
                ->Leftjoin('dokter', 'dokter.id', '=', 'rawat.iddokter')
                ->Leftjoin('demo_rekap_medis as rekap_medis', 'rekap_medis.idrawat', '=', 'rawat.id')
                ->where('rawat.idpoli', auth()->user()->detail->idpoli);
            if (auth()->user()->detail->dokter == 1) {
                $rawat->where('rawat.iddokter', auth()->user()->detail->iddokter)->orderBy('tglmasuk', 'desc');
            } else {
                $rawat->orderBy('tglmasuk', 'desc');
            }

            // ;
            return DataTables::query($rawat)
                ->addColumn('opsi', function ($rawat) {
                    return '<a href="' . route('rekam-medis-poli', $rawat->id) . '" class="btn btn-sm btn-success">Lihat</a>';
                })
                ->addColumn('status_pemeriksaan', function ($rawat) {
                    #span class="badge badge-success">Selesai</span>
                    if ($rawat->perawat == 1) {
                        $color_perawat = 'primary';
                    } else {
                        $color_perawat = 'danger';
                    }
                    if ($rawat->dokter == 1) {
                        $color_dokter = 'primary';
                    } else {
                        $color_dokter = 'danger';
                    }
                    $perawat = '<span class="badge badge-' . $color_perawat . '">Perawat</span>';
                    $dokter = '<span class="badge badge-' . $color_dokter . '">Dokter</span>';

                    return $dokter . ' ' . $perawat;
                })
                ->rawColumns(['opsi', 'status_pemeriksaan'])
                ->make(true);
        }
        return view('poliklinik.index');
        // return auth()->user()->detail->idpoli;
    }
}
