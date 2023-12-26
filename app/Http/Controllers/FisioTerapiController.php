<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class FisioTerapiController extends Controller
{
    public function index()
    {
        if(request()->ajax()){
            $query = DB::table('demo_terapi_fisio')
            ->join('pasien','demo_terapi_fisio.no_rm','=','pasien.no_rm')
            ->join('rawat','demo_terapi_fisio.idrawat','=','rawat.id')
            ->leftJoin('dokter','demo_terapi_fisio.iddokter','=','dokter.id')
            ->select([
                'demo_terapi_fisio.*',
                'pasien.nama_pasien',
                'dokter.nama_dokter',
            ])->orderBy('demo_terapi_fisio.id','DESC');
            return DataTables::query($query)
            ->addIndexColumn()
            ->addColumn('action',function($query){
                return '<a href="" class="btn btn-primary btn-sm">Terapi</a>';
            })->addColumn('terapi_fisio',function($query){
                $html ='';
                $html .='<ul>';
                foreach (json_decode($query->terapi) as $val):
                    $html .= '<li>'.$val->tindakan_fisio.'</li>';
                    
                endforeach;
                $html .='</ul>';
                return $html;
            })
            ->rawColumns(['action','terapi_fisio'])
            ->make(true);

        }
       
        return view('fisio.index');
    }
}
