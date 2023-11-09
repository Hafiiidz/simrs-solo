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
            ])
            ->join('pasien','pasien.no_rm','=','rawat.no_rm')
            ->join('poli','poli.id','=','rawat.idpoli')
            ->join('rawat_bayar','rawat_bayar.id','=','rawat.idbayar')
            ->join('rawat_status','rawat_status.id','=','rawat.status')
            ->Leftjoin('dokter','dokter.id','=','rawat.iddokter')
            ->where('rawat.idpoli', auth()->user()->detail->idpoli)
            ->orderBy('tglmasuk', 'desc');
            return DataTables::query($rawat)
            ->addColumn('opsi',function($rawat){
                return '<a href="' . route('rekam-medis-poli', $rawat->id) . '" class="btn btn-sm btn-success">Lihat</a>';
            })
            ->rawColumns(['opsi'])
            ->make(true);
        }
        return view('poliklinik.index');
        // return auth()->user()->detail->idpoli;
    }
    
}
