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
                    'rawat.idjenisrawat',
                    'pasien.nama_pasien',
                    'rawat.tglmasuk',
                    'poli.poli',
                    'dokter.nama_dokter',
                    'dokter.kode_dpjp',
                    'rawat_bayar.bayar',
                    'rawat_status.status',
                    // 'rekap_medis.dokter',
                    // 'rekap_medis.perawat',
                    // 'rekap_medis.bpjs',
                ])
                ->join('pasien', 'pasien.no_rm', '=', 'rawat.no_rm')
                ->join('poli', 'poli.id', '=', 'rawat.idpoli')
                ->join('rawat_bayar', 'rawat_bayar.id', '=', 'rawat.idbayar')
                ->join('rawat_status', 'rawat_status.id', '=', 'rawat.status')
                ->Leftjoin('dokter', 'dokter.id', '=', 'rawat.iddokter')
                // ->Leftjoin('demo_rekap_medis as rekap_medis', 'rekap_medis.idrawat', '=', 'rawat.id')  
                ->whereIn('rawat.status',[1,2,3,4,8])            
                ->whereDate('rawat.tglmasuk', date('Y-m-d'))
                ->groupBy('rawat.id')
                ;
                if(auth()->user()->idpriv != 20){
                    $rawat->where('rawat.idpoli', auth()->user()->detail->idpoli);
                }   
            // if (auth()->user()->detail->idruangan == 1) {
            //     $rawat->where('rawat.idpoli', auth()->user()->detail->idpoli);
            // }else{
            //     $rawat->where('rawat.idpoli','!=',1);
            // }
            if (auth()->user()->detail->dokter == 1) {
                $rawat->where('dokter.kode_dpjp', auth()->user()->detail->dokter_detail->kode_dpjp)->orderBy('tglmasuk', 'desc');
            } else {
                $rawat->orderBy('tglmasuk', 'desc');
            }
            return DataTables::query($rawat)
                ->addColumn('opsi', function ($rawat) {
                    return '<a href="' . route('rekam-medis-poli', $rawat->id) . '" class="btn btn-sm btn-success">Lihat</a>';
                })
                ->addColumn('jenis_rawat',function($rawat){
                    $jenis = DB::table('rawat_jenis')->where('id',$rawat->idjenisrawat)->first();
                    return $jenis->jenis;
                })
                ->addColumn('status_pemeriksaan', function ($rawat) {
                    #span class="badge badge-success">Selesai</span>
                    $rekap = DB::table('demo_rekap_medis')->where('idrawat',$rawat->id)->first();
                    if($rekap){
                        if ($rekap->perawat == 1) {
                            $color_perawat = 'primary';
                        } else {
                            $color_perawat = 'danger';
                        }
                        if ($rekap->dokter == 1) {
                            $color_dokter = 'primary';
                        } else {
                            $color_dokter = 'danger';
                        }
                        if($rekap->bpjs == 1){
                            $color_bpjs = 'primary';
                        }else{
                            $color_bpjs = 'danger';
                        }
                    }else{
                        $color_perawat = 'danger';
                        $color_dokter = 'danger';
                        $color_bpjs = 'danger';
                    }
                   
                    $perawat = '<span class="badge badge-' . $color_perawat . '">Perawat</span>';
                    $dokter = '<span class="badge badge-' . $color_dokter . '">Dokter</span>';
                    $bpjs = '<span class="badge badge-' . $color_bpjs . '">BPJS</span>';

                    return $dokter . ' ' . $perawat.' '.$bpjs;
                })
                ->rawColumns(['opsi', 'status_pemeriksaan','jenis_rawat'])
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
                    'rawat.idjenisrawat',
                    'pasien.no_rm',
                    'pasien.nama_pasien',
                    'rawat.tglmasuk',
                    'poli.poli',
                    'dokter.nama_dokter',
                    'dokter.kode_dpjp',
                    'rawat_bayar.bayar',
                    'rawat_status.status',
                    // 'rekap_medis.dokter',
                    // 'rekap_medis.perawat',
                    // 'rekap_medis.bpjs',
                ])
                ->join('pasien', 'pasien.no_rm', '=', 'rawat.no_rm')
                ->join('poli', 'poli.id', '=', 'rawat.idpoli')
                ->join('rawat_bayar', 'rawat_bayar.id', '=', 'rawat.idbayar')
                ->join('rawat_status', 'rawat_status.id', '=', 'rawat.status')
                ->Leftjoin('dokter', 'dokter.id', '=', 'rawat.iddokter')
                // ->Leftjoin('demo_rekap_medis as rekap_medis', 'rekap_medis.idrawat', '=', 'rawat.id')
                ->whereIn('rawat.status',[1,2,3,4,8])
                ->groupBy('rawat.id')
                ;
                    
                if(auth()->user()->idpriv != 20){
                    $rawat->where('rawat.idpoli', auth()->user()->detail->idpoli);
                }   
            // if (auth()->user()->detail->idruangan == 1) {
            //     $rawat->where('rawat.idpoli', auth()->user()->detail->idpoli);
            // } else {
            //     $rawat->where('rawat.idpoli', '!=', 1);
            // }
            if (auth()->user()->detail->dokter == 1) {
                $rawat->where('dokter.kode_dpjp', auth()->user()->detail->dokter_detail->kode_dpjp)->orderBy('tglmasuk', 'desc');
            } else {
                $rawat->orderBy('tglmasuk', 'desc');
            }

            // ;
            return DataTables::query($rawat)
                ->addColumn('opsi', function ($rawat) {
                    return '<a href="' . route('rekam-medis-poli', $rawat->id) . '" class="btn btn-sm btn-success">Lihat</a>';
                })
                ->addColumn('jenis_rawat',function($rawat){
                    $jenis = DB::table('rawat_jenis')->where('id',$rawat->idjenisrawat)->first();
                    return $jenis->jenis;
                })
                ->addColumn('status_pemeriksaan', function ($rawat) {
                    #span class="badge badge-success">Selesai</span>
                    $rekap = DB::table('demo_rekap_medis')->where('idrawat',$rawat->id)->first();
                    if($rekap){
                        if ($rekap->perawat == 1) {
                            $color_perawat = 'primary';
                        } else {
                            $color_perawat = 'danger';
                        }
                        if ($rekap->dokter == 1) {
                            $color_dokter = 'primary';
                        } else {
                            $color_dokter = 'danger';
                        }
                        if($rekap->bpjs == 1){
                            $color_bpjs = 'primary';
                        }else{
                            $color_bpjs = 'danger';
                        }
                    }else{
                        $color_perawat = 'danger';
                        $color_dokter = 'danger';
                        $color_bpjs = 'danger';
                    }
                    $perawat = '<span class="badge badge-' . $color_perawat . '">Perawat</span>';
                    $dokter = '<span class="badge badge-' . $color_dokter . '">Dokter</span>';
                    $bpjs = '<span class="badge badge-' . $color_bpjs . '">BPJS</span>';

                    return $dokter . ' ' . $perawat.' '.$bpjs;
                })
                ->rawColumns(['opsi', 'status_pemeriksaan','jenis_rawat'])
                ->make(true);
        }
        return view('poliklinik.index');
        // return auth()->user()->detail->idpoli;
    }
}
