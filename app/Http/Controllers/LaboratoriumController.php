<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Rawat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\RekapMedis\RekapMedis;
use Yajra\DataTables\Facades\DataTables;

class LaboratoriumController extends Controller
{
    #list pemeriksaan

    public function antrian_lab(Request $request){
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
        ->where('pemeriksaan_penunjang','!=','null')
        ->where('demo_permintaan_penunjang.jenis_penunjang','Lab')->orderBy('demo_permintaan_penunjang.id','desc');
        if(request()->ajax()){
            return DataTables::of($query)
            ->addColumn('action', function($query){
                return '<a href="'.route('penunjang.detail',[$query->idrawat,'Lab']).'" class="btn btn-sm btn-icon btn-light-info"><i class="fa fa-pencil"></i></a>';
            })
            ->addColumn('pemeriksaan',function($query){
               
                 if($query->pemeriksaan_penunjang != 'null' || $query->pemeriksaan_penunjang != null || $query->pemeriksaan_penunjang != ''){
                    $pemeriksaan = json_decode($query->pemeriksaan_penunjang);
                    $html = '<ol>';
                    foreach($pemeriksaan as $p){
                        $radiologi_tindakan = DB::table('laboratorium_pemeriksaan')->where('id',$p->tindakan_lab)->first();
                        $html .= '<li>'.$radiologi_tindakan?->nama_pemeriksaan.'</li>';
                    }
                    $html .= '</ol>';
                    return $html;
                 }
                 return '-';
            })
            ->addColumn('status', function($query){
                if($query->status_pemeriksaan == 'Antrian'){
                    return '<span class="badge badge-danger">Antrian</span>';
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
            ->filter(function ($query) use ($request) {
                if ($request->get('status') != '') {
                    $query->where('status_pemeriksaan', $request->get('status'));
                }
                if ($request->get('asal') != '') {
                    $query->where('rawat.idjenisrawat', $request->get('asal'));
                }
               
                if (!empty($request->get('search'))) {
                    $query->where(function ($w) use ($request) {
                        $search = $request->get('search');
                        $w->orWhere('demo_permintaan_penunjang.no_rm', 'LIKE', "%$search%");
                    });
                }
            })
            ->rawColumns(['action','pemeriksaan','status','poliruangan'])
            ->make(true);
        }
        $antrian = DB::table('demo_permintaan_penunjang')->where('status_pemeriksaan','Antrian')->where('pemeriksaan_penunjang','!=','null')->whereDate('created_at', date('Y-m-d'))->where('demo_permintaan_penunjang.jenis_penunjang','Lab')->count();
        $selesai = DB::table('demo_permintaan_penunjang')->where('status_pemeriksaan','Selesai')->where('pemeriksaan_penunjang','!=','null')->whereDate('created_at', date('Y-m-d'))->where('demo_permintaan_penunjang.jenis_penunjang','Lab')->count();
        $pemeriksaan = DB::table('demo_permintaan_penunjang')->where('status_pemeriksaan','Selesai')->where('pemeriksaan_penunjang','!=','null')->whereDate('created_at', date('Y-m-d'))->where('demo_permintaan_penunjang.jenis_penunjang','Lab')->count();
        return view('laboratorium.antrian-lab',compact('antrian','selesai','pemeriksaan'));
    }   

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
                ->addColumn('opsi', function ($query) {
                    return '<a href="' . route('penunjang.detail',[ $query->idrawat,'Lab']) . '" class="btn btn-sm btn-success">Lihat</a>';
                })
                ->addIndexColumn()

                ->rawColumns(['pemeriksaan','opsi'])
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
                    return '<a href="' . route('penunjang.detail',[ $rawat->id,'Lab']) . '" class="btn btn-sm btn-success">Lihat</a>';
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

    public function tambah_pemeriksaan(Request $request,$id){
        // return $request->all();
        $lab_hasil = DB::table('laboratorium_hasildetail')->where('idhasil',$id)->first();
        foreach($request->lab as $lab){
            $cek_hasil = DB::table('laboratorium_hasildetail')->where('idhasil',$id)->where('idpemeriksaan',$lab['tindakan_lab'])->first();
            if(!$cek_hasil){
                $data_lab = DB::table('laboratorium_pemeriksaan')->where('id',$lab['tindakan_lab'])->first();
                $data = [
                    'idhasil'=>$id,
                    'idpemeriksaan'=>$lab['tindakan_lab'],
                    'nama_pemeriksaan'=>$data_lab->nama_pemeriksaan,
                    'status'=>1,
                    'idbayar'=>$lab_hasil->idbayar,
                    'no_rm'=>$lab_hasil->no_rm,
                    'kat_pasien'=>$lab_hasil->kat_pasien,
                    'idpengantar'=>$lab_hasil->idpengantar,
                ];
                DB::table('laboratorium_hasildetail')->insert($data);
            }
        }

        return redirect()->back()->with('berhasil','Berhasil menambahkan pemeriksaan');
    }

    public function tambah_pemeriksaan_lab(Request $request,$id){
        $rawat = Rawat::find($id);
        $rekap = RekapMedis::where('idrawat',$id)->first();
        $data = [
            'idrawat'=>$id,
            'pemeriksaan_penunjang'=>'null',
            'created_at'=>now(),
            'updated_at'=>now(),
            'status_pemeriksaan'=>'Antrian',
            'jenis_penunjang'=>'Lab',
            'peminta'=>$rawat->iddokter,
            'idbayar'=>$rawat->idbayar,
            'no_rm'=>$rawat->no_rm,
            'jenis_rawat'=>$rawat->idjenisrawat,
            'idrekap'=>$rekap?->id,
        ];
        #insert demo_permintaan_penunjang
        $idpermintaan = DB::table('demo_permintaan_penunjang')->insert($data);
        return redirect()->back()->with('berhasil','Berhasil menambahkan pemeriksaan');
    }
    public function edit_tgl_hasil(Request $request,$id){
        DB::table('laboratorium_hasil')->where('id',$id)->update([
            'tgl_hasil'=>$request->tgl_hasil,
        ]);
        return redirect()->back()->with('berhasil','Berhasil mengubah tanggal dan jam hasil');
    }
    public function hapus_hasil($id){
        DB::table('laboratorium_hasil')->where('id',$id)->delete();
        return redirect()->back()->with('berhasil','Berhasil menghapus hasil');
    }
    public function hapus_pemeriksaan($id){
        DB::table('laboratorium_hasildetail')->where('id',$id)->delete();
        return redirect()->back()->with('berhasil','Berhasil menghapus pemeriksaan');
    }
}
