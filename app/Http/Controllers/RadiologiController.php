<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
class RadiologiController extends Controller
{
    #list pemeriksaan radiologi
    public function antrian_radiologi(){
        $query = DB::table('demo_permintaan_penunjang')
        ->leftjoin('rawat','rawat.id','=','demo_permintaan_penunjang.idrawat')
        ->leftjoin('pasien','pasien.no_rm','=','rawat.no_rm')
        ->leftjoin('rawat_jenis','rawat_jenis.id','=','rawat.idjenisrawat')
        ->leftjoin('poli','poli.id','=','rawat.idpoli')
        ->leftjoin('ruangan','ruangan.id','=','rawat.idruangan')
        ->leftjoin('dokter','dokter.id','=','demo_permintaan_penunjang.peminta')
        ->select([
            'demo_permintaan_penunjang.*',
            'pasien.nama_pasien',
            'rawat_jenis.jenis',
            'poli.id as idpoli',
            'poli.poli',
            'ruangan.nama_ruangan',
            'dokter.nama_dokter',
            'rawat.idjenisrawat',

        ])
        ->where('demo_permintaan_penunjang.pemeriksaan_penunjang','!=','null')
        ->where('demo_permintaan_penunjang.jenis_penunjang','Radiologi')->orderBy('demo_permintaan_penunjang.id','desc');
        if(request()->ajax()){
            return DataTables::of($query)
            ->addColumn('action', function($query){
                return '<a href="'.route('penunjang.detail',[$query->idrawat,'Radiologi']).'" class="btn btn-sm btn-icon btn-light-info"><i class="fa fa-pencil"></i></a>';
            })
            ->addColumn('pemeriksaan',function($query){
               
                 if($query->pemeriksaan_penunjang != 'null' || $query->pemeriksaan_penunjang != null || $query->pemeriksaan_penunjang != ''){
                    $pemeriksaan = json_decode($query->pemeriksaan_penunjang);
                    $html = '<ol>';
                    foreach($pemeriksaan as $p){
                        $radiologi_tindakan = DB::table('radiologi_tindakan')->where('id',$p->tindakan_rad)->first();
                        $html .= '<li>'.$radiologi_tindakan?->nama_tindakan.'</li>';
                    }
                    $html .= '</ol>';
                    return $html;
                 }
                 return '-';
            })
            ->addColumn('status', function($query){
                if($query->status_pemeriksaan == 'Antrian'){
                    return '<span class="badge badge-success">Antrian</span>';
                }else if($query->status_pemeriksaan == 'Pemeriksaan'){
                    return '<span class="badge badge-warning">Pemeriksaan</span>';
                }else if($query->status_pemeriksaan == 'Selesai'){
                    return '<span class="badge badge-primary">Selesai</span>';
                }
            })
            ->addColumn('poliruangan', function($query){
                if($query->idjenisrawat == 2){
                    return $query->nama_ruangan;
                }else{
                    return $query->poli;
                }
            })
            ->addIndexColumn()
            ->rawColumns(['action','pemeriksaan','status','poliruangan'])
            ->make(true);
        }
        return view('radiologi.antrian');
    }   
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
