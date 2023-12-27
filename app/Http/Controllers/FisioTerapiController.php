<?php

namespace App\Http\Controllers;

use App\Models\Pasien\Pasien;
use App\Models\Rawat;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
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

    public function show_asesmen(Request $request,$id){
        $rawat = Rawat::find($id);
        $pasien = Pasien::where('no_rm',$rawat->no_rm)->first();
        $asesmen = DB::table('tindakan_fisio_asesmen')->where('idrawat',$id)->first();
        $pemeriksaan_fisik = json_decode($asesmen->pemeriksaan_fisik);
        $kemampuan = json_decode($asesmen->kemampuan_fungsional);
        $alat_bantu = json_decode($asesmen->alat_bantu);
        $riwayat_jatuh = json_decode($asesmen->riwayat_jatuh);
        return view('fisio.show-fisio',compact('rawat','pasien','asesmen','pemeriksaan_fisik','kemampuan','alat_bantu','riwayat_jatuh'));
    }
    public function input_asesmen(Request $request,$id){
        $rawat = Rawat::find($id);
        $fisio = DB::table('tindakan_fisio')->where('idrawat')->get();
        $pasien = Pasien::where('no_rm',$rawat->no_rm)->first();

        $cek_asesmen = DB::table('tindakan_fisio_asesmen')->where('idrawat',$id)->first();
        if($cek_asesmen){
            return redirect()->route('fisio.show-asesmen',$id);
        }

        return view('fisio.input-asesmen',compact('rawat','fisio','pasien'));
    }

    public function post_asesmen(Request $request,$id){
        // return $request->all();

        $pemeriksaan_fisik = new Collection([
            'tekanan_darah'=>$request->tekanan_darah,
            'nadi'=>$request->nadi,
            'pernapasan'=>$request->pernapasan,
            'suhu'=>$request->suhu,
            'berat_badan'=>$request->berat_badan,
            'tinggi_badan'=>$request->tinggi_badan,
            'bmi'=>$request->bmi,
            'skor_nyeri'=>$request->skor_nyeri,
            'berkurang'=>$request->berkurang,
            'bertambah'=>$request->bertambah,
        ]);

        $kemampuan = new Collection([
            'kemampuan'=>$request->kemampuan,
            'value_kemampuan'=>$request->value_kemampuan,
        ]);
        $alat_bantu = new Collection([
            'alat_bantu'=>$request->alat_bantu,
            'value_alat_bantu'=>$request->value_alat_bantu,
        ]);
        $riwayat_jatuh = new Collection([
            'riwayat_jatuh'=>$request->riwayat_jatuh,
            'value_riwayat_jatuh'=>$request->value_riwayat_jatuh,
        ]);

        $cek_asesmen = DB::table('tindakan_fisio_asesmen')->where('idrawat',$id)->first();
        if(!$cek_asesmen){
            $data = [
                'idrawat'=>$id,
                'tgl'=>date('Y-m-d'),
                'anamnese'=>$request->anamnese,
                'keluhan_utama'=>$request->keluhan_utama,
                'riwayat_penyakit'=>$request->riwayat_penyakit,
                'pemeriksaan_fisik'=>$pemeriksaan_fisik->toJson(),
                'kemampuan_fungsional'=>$kemampuan->toJson(),
                'alat_bantu'=>$alat_bantu->toJson(),
                'riwayat_jatuh'=>$riwayat_jatuh->toJson(),
                'pemeriksaan_umum'=>$request->pemeriksaan_umum,
                'pemeriksaan_khusus'=>$request->pemeriksaan_khusus,
                'pemeriksaan_penunjang'=>$request->pemeriksaan_penunjang,
                'diagnosis_fisio_terapi'=>$request->diagnosis_fisio,
                'program_rencana'=>$request->program_rencana,
                'evaluasi'=>$request->evaluasi,
            ];
            DB::table('tindakan_fisio_asesmen')->insert($data);
        }else{
            $data = [
                'idrawat'=>$id,
                'tgl'=>date('Y-m-d'),
                'anamnese'=>$request->anamnese,
                'keluhan_utama'=>$request->keluhan_utama,
                'riwayat_penyakit'=>$request->riwayat_penyakit,
                'pemeriksaan_fisik'=>$pemeriksaan_fisik->toJson(),
                'kemampuan_fungsional'=>$kemampuan->toJson(),
                'alat_bantu'=>$alat_bantu->toJson(),
                'riwayat_jatuh'=>$riwayat_jatuh->toJson(),
                'pemeriksaan_umum'=>$request->pemeriksaan_umum,
                'pemeriksaan_khusus'=>$request->pemeriksaan_khusus,
                'pemeriksaan_penunjang'=>$request->pemeriksaan_penunjang,
                'diagnosis_fisio_terapi'=>$request->diagnosis_fisio,
                'program_rencana'=>$request->program_rencana,
                'evaluasi'=>$request->evaluasi,
            ];
            DB::table('tindakan_fisio_asesmen')->where('idrawat',$id)->update   ($data);
        }
        

      
        return redirect()->route('penunjang.detail',[$id,'Fisio'])->with('berhasil','Data berhasil disimpan');
    }
}
