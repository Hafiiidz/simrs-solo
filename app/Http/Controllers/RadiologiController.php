<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
class RadiologiController extends Controller
{
    #list pemeriksaan radiologi
    public function index_radiologi(){
        $query = DB::table('soap_radiologi')
        ->join('radiologi_tindakan','radiologi_tindakan.id','=','soap_radiologi.idtindakan')
        ->join('dokter','dokter.id','=','soap_radiologi.iddokter')
        ->join('rawat','rawat.id','=','soap_radiologi.idrawat')
        ->join('pasien','pasien.no_rm','=','rawat.no_rm')
        ->join('rawat_jenis','rawat_jenis.id','=','rawat.idjenisrawat')
        ->join('radiologi_hasildetail','radiologi_hasildetail.id','=','soap_radiologi.idhasil')
        ->select([
            'soap_radiologi.id',
            'soap_radiologi.tgl_permintaan',
            'radiologi_tindakan.nama_tindakan',
            'rawat.no_rm',
            'pasien.nama_pasien',
            'dokter.nama_dokter',
            'rawat_jenis.jenis',
            'rawat.id as idrawat',
            'radiologi_hasildetail.tgl_hasil'

        ])
        ->orderBy('soap_radiologi.id','desc');
        if(request()->ajax()){
            return DataTables::of($query)
            ->addColumn('action', function($query){
                return '<a href="'.route('penunjang.detail',[$query->idrawat,'Radiologi']).'" class="btn btn-sm btn-icon btn-primary"><i class="fa fa-eye"></i></a>';
            })
            ->addIndexColumn()
            ->make(true);
        }
        return view('radiologi.index');
    }
}
