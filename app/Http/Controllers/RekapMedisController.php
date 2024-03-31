<?php

namespace App\Http\Controllers;

use App\Helpers\VclaimHelper;
use App\Models\Dokter;
use App\Models\LabHasil;
use App\Models\Obat\Obat;
use App\Models\ObatTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;
use App\Models\RekapMedis\RekapMedis;
use App\Models\RekapMedis\DetailRekapMedis;
use App\Models\RekapMedis\Kategori;
use App\Models\Pasien\Pasien;
use App\Models\RadiologiHasil;
use App\Models\Rawat;
use App\Models\SoapRajalTindakan;
use App\Models\Tarif;
use App\Models\TindakLanjut;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Termwind\Components\Raw;

class RekapMedisController extends Controller
{
    public function get_icare($id,$bpjs){
        $icare = VclaimHelper::postIcare($id,$bpjs);
        if(!isset($icare['url'])){
            return response()->json(['status'=>false,'message'=>'Data Tidak Ditemukan']);
        }
        // return response()->json(['status'=>true,'url'=>$icare['url']]);
        return View::make('rekap-medis.icare', compact('icare'));
    }
    public function get_data_racik_obat($id){
        $resep = DB::table('demo_resep_dokter')->where('id', $id)->first();   
        $takaran = ['-','tablet','kapsul','bungkus','tetes','ml','sendok takar 5ml','sendok takar 15ml','oles'];
        return View::make('rekap-medis.data-obat', compact('resep','takaran'));
    }
    public function get_data_obat($id){
        $resep = DB::table('demo_resep_dokter')->where('id', $id)->first();   
        $takaran = ['-','tablet','kapsul','bungkus','tetes','ml','sendok takar 5ml','sendok takar 15ml','oles'];
        return View::make('rekap-medis.data-obat', compact('resep','takaran'));
    }
    public function get_hasil_lab($id)
    {
        $hasil = LabHasil::find($id);
        $detail = DB::table('laboratorium_hasildetail')->where('id', $id)->first();
        $lab_form = DB::table('lab_hasil')->where('idlayanan', $detail->id)->get();
        return View::make('rekap-medis.hasil-lab', compact('hasil', 'detail', 'lab_form'));
    }
    public function get_hasil_lab_dua($id)
    {
        $hasil = LabHasil::find($id);
        $detail = DB::table('laboratorium_hasildetail')->where('id', $id)->first();
        $lab_form = DB::table('lab_hasil')->where('idlayanan', $detail->id)->get();
        return View::make('rekap-medis.hasil-lab', compact('hasil', 'detail', 'lab_form'));
    }
    public function get_hasil_rad($id)
    {
        $hasil = RadiologiHasil::find($id);
        $detail = DB::table('radiologi_hasildetail')->where('id', $id)->first();
        $tindakan = DB::table('radiologi_tindakan')->where('id', $detail->idtindakan)->first();
        $foto = DB::table('radiologi_hasilfoto')->where('idhasil', $id)->get();
        return View::make('rekap-medis.hasil-radiologi', compact('hasil', 'detail', 'foto', 'tindakan'));
    }
    public function get_hasil($id)
    {
        $resume_medis = RekapMedis::where('id', $id)->first();
        $resume_detail = DetailRekapMedis::where('idrekapmedis', $resume_medis->id)->first();
        $obat = Obat::with('satuan')->orderBy('obat.nama_obat', 'asc')->get();
        $tindak_lanjut = TindakLanjut::where('idrawat', $resume_medis->idrawat)->first();
        $radiologi = DB::table('radiologi_tindakan')->get();
        $lab = DB::table('laboratorium_pemeriksaan')->get();
        $fisio = DB::table('tarif')->where('idkategori', 8)->get();
        $rawat = Rawat::find($resume_medis->idrawat);
        $pemeriksaan_lab = LabHasil::where('idrawat', $resume_medis->idrawat)->get();
        $pemeriksaan_radiologi = RadiologiHasil::where('idrawat', $resume_medis->idrawat)->get();
        return View::make('rekap-medis.hasil-history', compact('resume_medis', 'resume_detail', 'obat', 'tindak_lanjut', 'radiologi', 'lab', 'fisio', 'rawat', 'pemeriksaan_lab', 'pemeriksaan_radiologi'));
    }
    public function selesai_poli(Request $request, $id)
    {
        $rekap_medis = RekapMedis::where('id', $id)->first();
        $rawat = Rawat::find($rekap_medis->idrawat);
        $transaksi = DB::table('transaksi')->where('kode_kunjungan', $rawat->idkunjungan)->first();
        // return $rawat->idkunjungan;
        // return $transaksi;
        // return $rekap_medis;
        $detail = DetailRekapMedis::where('idrekapmedis', $rekap_medis->id)->first();
        $current_time = round(microtime(true) * 1000); 


        if ($request->jenis == 'perawat') {
            $rekap_medis->perawat = 1;
            // return $rawat->idrawat;
            $current_time = round(microtime(true) * 1000); 
            VclaimHelper::update_task($rawat->idrawat,4,$current_time);
        }elseif($request->jenis == 'bpjs'){
            $rekap_medis->bpjs = 1;
        } else {
            $rekap_medis->dokter = 1;
            $resep_dokter = DB::table('demo_resep_dokter')->where('idrawat', $rawat->id)->get();
            // if($rekap_medis->dokter == null){
                if (count($resep_dokter) > 0) {   
                    VclaimHelper::update_task($rawat->idrawat,6,$current_time);             
                    $non_racik = [];
                    $racikan = [];
                    foreach($resep_dokter as $rd){
                        if($rd->jenis == 'Racik'){
                            $data_obat = [];
                            $jumlah_obat = [];
                            $obat = json_decode($rd->nama_obat);
                            foreach($obat->obat as $o){
                                $data_obat[] = [
                                    'obat'=>$o,
                                ];
                            }
                            foreach($obat->jumlah as $o){
                                $jumlah_obat[] = [
                                    'jumlah_obat'=>$o,
                                ];
                            }
                
                            $obatData= json_encode(array_merge($data_obat,$jumlah_obat));
                            $data = json_decode($obatData, true);
                
                            // Inisialisasi array 2 dimensi
                            $result = [];
                            $finalResult = array();
                            // Mengelompokkan elemen berdasarkan kunci
                            foreach ($data as $item) {
                                foreach ($item as $key => $value) {
                                    if (!isset($finalResult[$key])) {
                                        $finalResult[$key] = array();
                                    }
                                    $finalResult[$key][] = $value;
                                }
                            }
                            
                            // Menggabungkan hasil menjadi array sesuai format yang diinginkan
                            $combinedArray = array();
                            for ($i = 0; $i < count($finalResult['obat']); $i++) {
                                $combinedArray[] = array(
                                    'obat' => $finalResult['obat'][$i],
                                    'jumlah_obat' => $finalResult['jumlah_obat'][$i]
                                );
                            }
                            
                            // return $combinedArray;
                
                            $racikan[] = [
                                'obat'=>$combinedArray,
                                'jumlah_obat'=>$jumlah_obat,
                                'takaran'=>$rd->takaran,
                                'dosis'=>$rd->dosis,
                                'signa'=>$rd->signa,
                                'dtd'=>$rd->dtd,
                                'diminum'=>$rd->diminum,
                                'catatan'=>$rd->catatan,
                                'idresep'=>$rd->id
                            ];
                        }elseif($rd->jenis == 'Non Racik'){
                            $non_racik[] = [
                                'obat'=>$rd->idobat,
                                'takaran'=>$rd->takaran,
                                'jumlah'=>$rd->jumlah,
                                'dosis'=>$rd->dosis,
                                'signa'=>$rd->signa,
                                'diminum'=>$rd->diminum,
                                'catatan'=>$rd->catatan,
                                'idresep'=>$rd->id
                            ];
                        }
                    }
                    // return $racikan;
                    $cek_antrian = DB::table('demo_antrian_resep')->where('idrawat', $rawat->id)->where('jenis_rawat', $rawat->idjenisrawat)->first();
                    if($cek_antrian){
                        $no_antrian = DB::table('demo_antrian_resep')->whereDate('created_at', Carbon::today())->where('jenis_rawat', $rawat->idjenisrawat)->count();
                        $antrian = DB::table('demo_antrian_resep')->where('idrawat', $rawat->id)->where('status_antrian', 'Antrian')->update([
                            'racikan' => json_encode($racikan),
                            'obat' => json_encode($non_racik),
                            'updated_at' => now(),
                        ]);
                    }else{
                        $no_antrian = DB::table('demo_antrian_resep')->whereDate('created_at', Carbon::today())->where('jenis_rawat', $rawat->idjenisrawat)->count();
                        $antrian = DB::table('demo_antrian_resep')->insertGetId([
                            'idrawat' => $rekap_medis->idrawat,
                            'racikan' => json_encode($racikan),
                            'idbayar' => $rekap_medis->rawat->idbayar,
                            'status_antrian' => 'Antrian',
                            'no_rm' => $rekap_medis->rawat->no_rm,
                            'idrekap' => $rekap_medis->id,
                            'no_antrian' => $no_antrian + 1,
                            'obat' => json_encode($non_racik),
                            'jenis_rawat' => $rekap_medis->rawat->idjenisrawat,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                        DB::table('demo_resep_dokter')->where('idrawat', $rawat->id)->whereNull('idantrian')->update([
                            'idantrian'=>$antrian
                        ]);
                    }
                    
                }
                if ($detail->radiologi != null || $detail->radiologi != 'null' || $detail->radiologi != '') {
                    $cek_permintaan_penunjang_radiologi = DB::table('demo_permintaan_penunjang')->where('idrawat', $rekap_medis->idrawat)->where('jenis_penunjang','Radiologi')->where('status_pemeriksaan','Antrian')->first();
                    if(!$cek_permintaan_penunjang_radiologi){
                        DB::table('demo_permintaan_penunjang')->insert([
                            'idrawat' => $rekap_medis->idrawat,
                            'idbayar' => $rekap_medis->rawat->idbayar,
                            'status_pemeriksaan' => 'Antrian',
                            'no_rm' => $rekap_medis->rawat->no_rm,
                            'pemeriksaan_penunjang' => $detail->radiologi,
                            'jenis_penunjang' => 'Radiologi',
                            'peminta' => now(),
                            'created_at' => now(),
                            'updated_at' => now(),
                            'peminta' => auth()->user()->id,
                            'jenis_rawat' => $rekap_medis->rawat->idjenisrawat,
                            'idrekap' => $rekap_medis->id,
                        ]);
                    }
                    // DB::table('demo_permintaan_penunjang')->insert([
                    //     'idrawat' => $rekap_medis->idrawat,
                    //     'idbayar' => $rekap_medis->rawat->idbayar,
                    //     'status_pemeriksaan' => 'Antrian',
                    //     'no_rm' => $rekap_medis->rawat->no_rm,
                    //     'pemeriksaan_penunjang' => $detail->radiologi,
                    //     'jenis_penunjang' => 'Radiologi',
                    //     'peminta' => now(),
                    //     'created_at' => now(),
                    //     'updated_at' => now(),
                    //     'peminta' => auth()->user()->id,
                    //     'jenis_rawat' => $rekap_medis->rawat->idjenisrawat,
                    //     'idrekap' => $rekap_medis->id,
                    // ]);
                }
                if ($detail->laborat != null || $detail->laborat != 'null' || $detail->laborat != '') {
                    $cek_permintaan_penunjang_lab = DB::table('demo_permintaan_penunjang')->where('idrawat', $rekap_medis->idrawat)->where('jenis_penunjang','Lab')->where('status_pemeriksaan','Antrian')->first();
                    if(!$cek_permintaan_penunjang_lab){
                        DB::table('demo_permintaan_penunjang')->insert([
                            'idrawat' => $rekap_medis->idrawat,
                            'idbayar' => $rekap_medis->rawat->idbayar,
                            'status_pemeriksaan' => 'Antrian',
                            'no_rm' => $rekap_medis->rawat->no_rm,
                            'pemeriksaan_penunjang' => $detail->laborat,
                            'jenis_penunjang' => 'Lab',
                            'peminta' => now(),
                            'created_at' => now(),
                            'updated_at' => now(),
                            'peminta' => auth()->user()->id,
                            'jenis_rawat' => $rekap_medis->rawat->idjenisrawat,
                            'idrekap' => $rekap_medis->id,
                        ]);
                    }
                    // DB::table('demo_permintaan_penunjang')->insert([
                    //     'idrawat' => $rekap_medis->idrawat,
                    //     'idbayar' => $rekap_medis->rawat->idbayar,
                    //     'status_pemeriksaan' => 'Antrian',
                    //     'no_rm' => $rekap_medis->rawat->no_rm,
                    //     'pemeriksaan_penunjang' => $detail->laborat,
                    //     'jenis_penunjang' => 'Lab',
                    //     'peminta' => now(),
                    //     'created_at' => now(),
                    //     'updated_at' => now(),
                    //     'peminta' => auth()->user()->id,
                    //     'jenis_rawat' => $rekap_medis->rawat->idjenisrawat,
                    //     'idrekap' => $rekap_medis->id,
                    // ]);
                }
                if ($detail->fisio != 'null' || $detail->fisio != '' || $detail->fisio != null) {
                    // DB::table('demo_terapi_fisio')->insert([
                    //     'idrekap' => $rekap_medis->id,
                    //     'idrawat' => $rekap_medis->idrawat,
                    //     'idbayar' => $rekap_medis->rawat->idbayar,
                    //     'no_rm' => $rekap_medis->rawat->no_rm,
                    //     'terapi' => $detail->fisio,
                    //     'iddokter'=>$rekap_medis->rawat->iddokter,
                    //     'created_at' => now(),
                    //     'updated_at' => now(),
                    //     'limit_program'=>8,
                    // ]);
                    $cek_antrian_fisio = DB::table('demo_permintaan_penunjang')->where('idrawat', $rekap_medis->idrawat)->where('jenis_penunjang','Fisio')->where('status_pemeriksaan','Antrian')->first();
                    if(!$cek_antrian_fisio){
                        DB::table('demo_permintaan_penunjang')->insert([
                            'idrawat' => $rekap_medis->idrawat,
                            'idbayar' => $rekap_medis->rawat->idbayar,
                            'status_pemeriksaan' => 'Antrian',
                            'no_rm' => $rekap_medis->rawat->no_rm,
                            'pemeriksaan_penunjang' => $detail->fisio,
                            'jenis_penunjang' => 'Fisio',
                            'peminta' => now(),
                            'created_at' => now(),
                            'updated_at' => now(),
                            'peminta' => auth()->user()->id,
                            'jenis_rawat' => $rekap_medis->rawat->idjenisrawat,
                            'idrekap' => $rekap_medis->id,
                        ]);
                    }
                    
                }
            // }
           

            $current_time = round(microtime(true) * 1000); 
            VclaimHelper::update_task($rawat->idrawat,5,$current_time);
        }

        $rekap_medis->save();

        if($request->jenis != 'bpjs'){
            if ($rekap_medis->perawat == 1 && $rekap_medis->dokter == 1) {
                $rawat = Rawat::find($rekap_medis->idrawat);
                if($rawat->status != 2){
                    $rawat->status = 4;
                }
                
                $rawat->save();
               
                if ($rekap_medis->tindakan != NULL || $rekap_medis->tindakan != 'null') {
                    $jumlah = 0;
                    // return $rekap_medis->tindakan;
                    foreach (json_decode($rekap_medis->tindakan) as $tindakan) {
                        // $jumlah += 2;
                        // $cek_tindakan = DB::table('transaksi_detail_rinci')->where('idrawat', $rawat->id)->where('idtarif', $tindakan->tindakan)->first();
                        // if(!$cek_tindakan){
                            $tarif = Tarif::find($tindakan->tindakan);
                            for ($x = 1; $x <= $tindakan->jumlah; $x++) {
                                DB::table('transaksi_detail_rinci')->insert([
                                    'idbayar' => $rawat->idbayar,
                                    'iddokter' => $tindakan->dokter,
                                    'idpaket' => 0,
                                    'idjenis' => 0,
                                    'idrawat' => $rawat->id,
                                    'idtransaksi' => $transaksi->id,
                                    'idtarif' => $tindakan->tindakan,
                                    'tarif' => $tarif->tarif,
                                    'idtindakan' => $tarif->kat_tindakan,
                                    'tgl' => now(),
                                ]);
                            // }   
                        }
                        
                    }
                    // return $jumlah;
                }
            }
        }
       
        return redirect()->back()->with('berhasil', 'Pasien Selesai Diperiksa');
    }

    public function copy_resep($id,$idrawat){
        $resep = ObatTransaksi::find($id);
        $rekap_medis = RekapMedis::where('idrawat', $idrawat)->first();
        $resep_detail = DB::table('obat_transaksi_detail')->where('idtrx', $resep->id)->get();
        $array = [];
        foreach($resep_detail as $rd){
            $obat = Obat::find($rd->idobat);
            // $array[] = [
            //     'obat'=>$rd->idobat,
            //     'takaran'=>$rd->takaran,
            //     'jumlah'=>$rd->qty,
            //     'dosis'=>$rd->dosis,
            //     'signa'=>'',
            //     'diminum'=>'',
            // ];
            $data = [
                'idrawat'=>$idrawat,
                'idobat'=>$rd->idobat,
                'takaran'=>$rd->takaran,
                'jumlah'=>$rd->qty,
                'dosis'=>$rd->dosis,
                'signa'=>'',
                'diminum'=>'',
                'nama_obat'=>$obat->nama_obat,
                'jenis'=>'Non Racik'
            ];
            DB::table('demo_resep_dokter')->insert($data);
        }
        return redirect()->back()->with('berhasil', 'Resep Berhasil Disalin');


       return $array;
    }

    public function data_resep_pasien($no_rm,$idrawat){
        $resep = ObatTransaksi::where('no_rm', $no_rm)->orderBy('id','desc');
        return DataTables::eloquent($resep)
        ->addColumn('data_obat',function($resep){
            $data_obat = DB::table('obat_transaksi_detail')->where('idtrx', $resep->id)->get();
            $html = '';
            foreach($data_obat as $do){
                $html .= '<li>'.$do->nama_obat.' - '.$do->qty.'</li>';
            }
            return $html;
        })
        ->addColumn('aksi', function ($resep) use ($idrawat) {
            return '<a href="'.route('copy-resep',[$resep->id,$idrawat]).'" class="btn btn-sm btn-success">Salin Obat</a>';
        })
        ->addIndexColumn()
        ->rawColumns(['data_obat','aksi'])
        ->make(true);
    }

    public function copy_template($id,$idrawatbaru){
        // return $idrawatbaru;
        $rekap_lama = RekapMedis::where('idrawat', $id)->first();
        $cek_rekap = RekapMedis::where('idrawat', $idrawatbaru)->first();
        // return $rekap_lama;
        if($cek_rekap){
            // $rekap_medis = RekapMedis::where('idrawat',$idrawatbaru)->update([
            //     'dokter'=>0,
            //     'perawat'=>0,
            //     'bpjs'=>0,
            // ]);
        }else{
            return back()->with('gagal','Data gagal disalin harap perawat mengisi isiannya terlebih dahulu');
            $rekap_medis_baru = RekapMedis::create([
                'idrawat'=>$idrawatbaru,
                'idkategori'=>$rekap_lama->idkategori,
                'idpasien'=>Rawat::find($idrawatbaru)->pasien->id,
                'dokter'=>0,
                'perawat'=>0,
                'bpjs'=>0,
            ]);
            // return $rekap_medis->id;
        }
        
        // $obat_lama = DB::table('demo_resep_dokter')->where('idrawat', $id)->get();

        // // return $obat_lama;
        // foreach($obat_lama as $ol){
        //     $obat = Obat::find($ol->idobat);
        //     $data = [
        //         'idrawat'=>$idrawatbaru,
        //         'idobat'=>$ol->idobat,
        //         'takaran'=>$ol->takaran,
        //         'jumlah'=>$ol->jumlah,
        //         'dosis'=>$ol->dosis,
        //         'signa'=>'',
        //         'diminum'=>'',
        //         'nama_obat'=>$obat->nama_obat,
        //         'jenis'=>'Non Racik'
        //     ];
        //     DB::table('demo_resep_dokter')->insert($data);
        // }
        
        $originalPost = DetailRekapMedis::where('idrawat', $id)->first();
        // return $originalPost;
        if(!$cek_rekap){
            // return $rekap_medis->id;
            return back()->with('gagal','Data gagal disalin harap perawat mengisi isiannya terlebihdahulu');
        }else{
            $pemodal = DetailRekapMedis::where('idrawat', $idrawatbaru)->first();
            
            $pemodal->diagnosa = $originalPost->diagnosa;
            $pemodal->pemeriksaan_fisik_dokter = $originalPost->pemeriksaan_fisik_dokter;
            $pemodal->pemeriksaan_fisio = $originalPost->pemeriksaan_fisio;
            $pemodal->anamnesa_dokter = $originalPost->anamnesa_dokter;
            $pemodal->kategori_penyakit = $originalPost->kategori_penyakit;
            $pemodal->icdx = $originalPost->icdx;
            $pemodal->icd9 = $originalPost->icd9;
       
            $pemodal->save();
        }
       
       
        return redirect()->back()->with('berhasil', 'Template Berhasil Disalin');
    }

    public function index_poli($id_rawat)
    {
        // $rawat = DB::table('rawat')->where('id', $id_rawat)->first();
        $rawat = Rawat::find($id_rawat);
        $resume_medis = RekapMedis::with('kategori')->where('idrawat', $rawat->id)->first();
        // dd($resume_medis);
        $resume_detail = [];
        if ($resume_medis) {
            $resume_detail = DetailRekapMedis::with('rekapMedis.kategori')->where('idrekapmedis', $resume_medis->id)->first();
        }
        $pasien = Pasien::with('alamat')->where('no_rm', $rawat->no_rm)->first();
        if (request()->ajax()) {
            $rekap = RekapMedis::with('kategori')->where('idrawat', '!=', $rawat->id)->where('idpasien', $pasien->id);

            return DataTables::of($rekap)
                ->addColumn('kategori', function (RekapMedis $rekap) {
                    return $rekap->rawat->poli?->poli . ' (' . $rekap->rawat->dokter?->nama_dokter . ')' . ' <span class="badge badge-success">' . $rekap->rawat->bayar?->bayar . '</span>';
                })
                ->addColumn('tanggal', function (RekapMedis $rekap) {
                    return Carbon::parse($rekap->created_at)->translatedFormat('l, d F Y');
                })
                ->addColumn('opsi', function (RekapMedis $rekap) {
                    return '<a href="' . route('rekam-medis-poli', $rekap->idrawat) . '" class="btn btn-sm btn-success">Detail</a>';
                })
                ->rawColumns(['kategori', 'tanggal', 'opsi'])
                ->addIndexColumn()
                ->make();
        }
        $obat = Obat::with('satuan')->where('nama_obat','!=','')->orderBy('obat.nama_obat', 'asc')->get();
        $tindak_lanjut = TindakLanjut::where('idrawat', $id_rawat)->first();
        $radiologi = DB::table('radiologi_tindakan')->get();
        $lab = DB::table('laboratorium_pemeriksaan')->get();
        $fisio = DB::table('tarif')->where('idkategori', 8)->get();
        $fisio_tindakan = DB::table('tarif')->where('idkategori', 8)->get();
        $dokter = Dokter::where('status',1)->where('kode_dpjp','!=',NULL)->get();
        $tarif = DB::table('tarif')->whereNull('idjenisrawat')->orWhere('idjenisrawat', $rawat->id_jenis_rawat)->whereNull('idpoli')->orWhereIn('idpoli', [auth()->user()->detail->idpoli])->get();
        $soap_tindakan = SoapRajalTindakan::where('idrawat', $id_rawat)->get();
        $tarif_all =  DB::table('tarif')->get();
        $resep_dokter = DB::table('demo_resep_dokter')->where('idrawat', $id_rawat)->get();
        $pemeriksaan_lab = LabHasil::where('idrawat', $id_rawat)->get();
        $pemeriksaan_radiologi = RadiologiHasil::where('idrawat', $id_rawat)->get();
        $pemeriksaan_luar = DB::table('demo_rekap_medis_file_penunjang')->where('id_rekap', $id_rawat)->get();
        $riwayat_berobat = RekapMedis::where('idpasien', $pasien->id)->where('idrawat', '!=', $id_rawat)->get();
        $penunjang = DB::table('demo_permintaan_penunjang')->where('idrawat', $id_rawat)->get();
        $resep = ObatTransaksi::where('no_rm', $rawat->no_rm)->get();
        $get_template = RekapMedis::with('rawat')
        ->join('demo_detail_rekap_medis','demo_detail_rekap_medis.idrekapmedis','=','demo_rekap_medis.id')
        ->whereRelation('rawat','idpoli',auth()->user()->detail->idpoli)
        // ->where('template',1)
        ->where('idpasien', $pasien->id)
        ->whereRelation('rawat','id','!=',$id_rawat)
        ->whereRelation('rawat','iddokter',$rawat->iddokter)
        ->whereNotNull('diagnosa')
        // ->orderBy('updated_at','desc')
        ->orderBy(DB::raw('COUNT(demo_detail_rekap_medis.diagnosa)'),'DESC')
        // ->orderBy('demo_detail_rekap_medis.created_at','desc')
        ->groupBy('demo_detail_rekap_medis.diagnosa')
        ->limit(10)
        ->get();
        // dd($get_template);
        // dd($riwayat_berobat);
        return view('rekap-medis.poliklinik', compact('pasien', 'rawat', 'resume_medis', 'resume_detail', 'obat', 'tindak_lanjut', 'radiologi', 'lab', 'tarif', 'dokter', 'soap_tindakan', 'fisio', 'pemeriksaan_lab', 'pemeriksaan_radiologi', 'riwayat_berobat', 'pemeriksaan_luar', 'resep_dokter', 'resep','get_template','penunjang','fisio_tindakan','tarif_all'));
    }

    public function copy_data(Request $request, $id)
    {
        $rawat = Rawat::find($id);
        // dd($rawat);
        $rekap_medis = RekapMedis::where('idrawat', $id)->first();
        // dd($rekap_medis);
        $data_rekap = DetailRekapMedis::where('idrekapmedis', $request->idrekap)->first();
        // return $data_rekap;
        if ($rekap_medis) {
            $detail_resume = DetailRekapMedis::where('idrekapmedis', $rekap_medis->id)->first();
            if ($detail_resume) {
                $detail_resume->idrawat = $rawat->id;
                $detail_resume->diagnosa = $data_rekap->diagnosa;
                // $detail_resume->anamnesa = $data_rekap->data_rekap;
                // $detail_resume->obat_yang_dikonsumsi = $data_rekap->obat_yang_dikonsumsi;
                // $detail_resume->alergi = $data_rekap->alergi;
                // $detail_resume->pasien_sedang = $data_rekap->pasien_sedang;
                // $detail_resume->pemeriksaan_fisik = $data_rekap->pemeriksaan_fisik;
                // $detail_resume->riwayat_kesehatan = $data_rekap->riwayat_kesehatan;
                $detail_resume->rencana_pemeriksaan = $data_rekap->rencana_pemeriksaan;
                $detail_resume->terapi = $data_rekap->terapi;
                $detail_resume->terapi_obat = $data_rekap->terapi_obat;
                $detail_resume->kategori_penyakit = $data_rekap->kategori_penyakit;
                // $detail_resume->triase = $data_rekap->triase;
                $detail_resume->radiologi = $data_rekap->radiologi;
                $detail_resume->laborat = $data_rekap->laborat;
                $detail_resume->icdx = $data_rekap->icdx;
                $detail_resume->tindakan = $data_rekap->tindakan;
                $detail_resume->anamnesa_dokter = $data_rekap->anamnesa_dokter;
                $detail_resume->fisio = $data_rekap->fisio;
                $detail_resume->prosedur = $data_rekap->prosedur;
                $detail_resume->icd9 = $data_rekap->icd9;
                $detail_resume->save();
            } else {
                $detail_resume = new DetailRekapMedis;
                $detail_resume->diagnosa = $data_rekap->diagnosa;
                $detail_resume->anamnesa = $data_rekap->data_rekap;
                $detail_resume->obat_yang_dikonsumsi = $data_rekap->obat_yang_dikonsumsi;
                $detail_resume->alergi = $data_rekap->alergi;
                $detail_resume->pasien_sedang = $data_rekap->pasien_sedang;
                $detail_resume->pemeriksaan_fisik = $data_rekap->pemeriksaan_fisik;
                $detail_resume->riwayat_kesehatan = $data_rekap->riwayat_kesehatan;
                $detail_resume->rencana_pemeriksaan = $data_rekap->rencana_pemeriksaan;
                $detail_resume->terapi = $data_rekap->terapi;
                $detail_resume->terapi_obat = $data_rekap->terapi_obat;
                $detail_resume->kategori_penyakit = $data_rekap->kategori_penyakit;
                $detail_resume->triase = $data_rekap->triase;
                $detail_resume->radiologi = $data_rekap->radiologi;
                $detail_resume->laborat = $data_rekap->laborat;
                $detail_resume->icdx = $data_rekap->icdx;
                $detail_resume->tindakan = $data_rekap->tindakan;
                $detail_resume->anamnesa_dokter = $data_rekap->anamnesa_dokter;
                $detail_resume->fisio = $data_rekap->fisio;
                $detail_resume->prosedur = $data_rekap->prosedur;
                $detail_resume->icd9 = $data_rekap->icd9;
                $detail_resume->save();
            }
        } else {
            $resume = new RekapMedis;
            $resume->idrawat = $rawat->id;
            $resume->idkategori = 1;
            $resume->idrawat = $rawat->id;
            $resume->idpasien = $rawat->pasien->id;
            $resume->save();

            $detail_resume = new DetailRekapMedis;
            $detail_resume->idrekapmedis = $resume->id;
            $detail_resume->idrawat = $rawat->id;
            $detail_resume->diagnosa = $data_rekap->diagnosa;
            $detail_resume->anamnesa = $data_rekap->data_rekap;
            $detail_resume->obat_yang_dikonsumsi = $data_rekap->obat_yang_dikonsumsi;
            $detail_resume->alergi = $data_rekap->alergi;
            $detail_resume->pasien_sedang = $data_rekap->pasien_sedang;
            $detail_resume->pemeriksaan_fisik = $data_rekap->pemeriksaan_fisik;
            $detail_resume->riwayat_kesehatan = $data_rekap->riwayat_kesehatan;
            $detail_resume->rencana_pemeriksaan = $data_rekap->rencana_pemeriksaan;
            $detail_resume->terapi = $data_rekap->terapi;
            $detail_resume->terapi_obat = $data_rekap->terapi_obat;
            $detail_resume->kategori_penyakit = $data_rekap->kategori_penyakit;
            $detail_resume->triase = $data_rekap->triase;
            $detail_resume->radiologi = $data_rekap->radiologi;
            $detail_resume->laborat = $data_rekap->laborat;
            $detail_resume->icdx = $data_rekap->icdx;
            $detail_resume->tindakan = $data_rekap->tindakan;
            $detail_resume->anamnesa_dokter = $data_rekap->anamnesa_dokter;
            $detail_resume->fisio = $data_rekap->fisio;
            $detail_resume->prosedur = $data_rekap->prosedur;
            $detail_resume->icd9 = $data_rekap->icd9;
            $detail_resume->save();
        }
        return redirect()->back()->with('berhasil', 'Data Berhasil Disalin');
    }
    public function index($id_pasien)
    {
        $pasien = Pasien::with('alamat')->find($id_pasien);
        // dd($pasien);
        $kategori = Kategori::get();
        if (request()->ajax()) {
            // $rekap = RekapMedis::with('kategori')->where('idpasien', $id_pasien);
            // $pasien = Pasien::find($id);
            $rekap = Rawat::where('no_rm', $pasien->no_rm);

            return DataTables::of($rekap)
                ->addColumn('kategori', function (Rawat $rekap) {
                    return $rekap->poli->poli;
                })
                ->addColumn('tanggal', function (Rawat $rekap) {
                    return Carbon::parse($rekap->tglmasuk)->translatedFormat('l, d F Y');
                })
                ->addColumn('opsi', function (Rawat $rekap) {
                    return '<a href="' . route('rekam-medis-poli', $rekap->id) . '" class="btn btn-sm btn-success">Detail</a>';
                })
                ->rawColumns(['kategori', 'tanggal', 'opsi'])
                ->addIndexColumn()
                ->make();
        }

        return view('rekap-medis.index', compact('pasien', 'kategori'));
    }

    public function store(Request $request)
    {
        $rekap = new RekapMedis;
        $rekap->idkategori = $request->kategori;
        $rekap->idpasien = $request->id_pasien;
        $rekap->save();
        return redirect()->back()->with('berhasil', 'Data Rekam Medis Berhasil Ditambahkan');
    }

    public function delete_file_pengatar(Request $request)
    {
        $file = DB::table('demo_rekap_medis_file_penunjang')->where('id', $request->id)->first();
        $path = public_path('storage/file-penunjang-luar/' . $file->nama_file);
        if (file_exists($path)) {
            unlink($path);
        }
        DB::table('demo_rekap_medis_file_penunjang')->where('id', $request->id)->delete();
        return redirect()->back()->with('berhasil', 'File Berhasil Dihapus');
    }
    public function upload_file_pengatar(Request $request, $id)
    {
        // return $request->all();
        $foto = $request->file('file_penunjang_luar');
        $fileName = time() . 'Pengantar_' . $id . '.' . $foto->extension();

        $filenameWithExt = $foto->getClientOriginalName();
        $extension = $foto->getClientOriginalExtension();
        $filenameSimpan = time() . 'foto-rad' . '_' . $id . '_' . time() . '.' . $extension;

        $foto->storeAs('public/' . 'file-penunjang-luar', $filenameSimpan);

        DB::table('demo_rekap_medis_file_penunjang')->insert([
            'id_rekap' => $id,
            'id_user' => auth()->user()->id,
            'created_at' => now(),
            'nama_file' => $filenameSimpan,
            'keterangan_file' => $request->keterangan_file
        ]);

        return redirect()->back()->with('berhasil', 'File Pengantar Berhasil Diupload');
    }
    public function input_resume_poli(Request $request)
    {
        $rawat = Rawat::find($request->idrawat);
        if($rawat->status != 2){
            $rawat->status = 3;
        }
       
        $rawat->timestamps = false;
        $rawat->save();

        $cek_resume = RekapMedis::where('idrawat', $request->idrawat)->first();
        if (!$cek_resume) {
            $resume = new RekapMedis;
            $resume->idkategori = $request->idkategori;
            $resume->idrawat = $request->idrawat;
            $resume->idpasien = $request->idpasien;
            $resume->save();
        } else {
            $resume = RekapMedis::find($cek_resume->id);
        }
        $triase = DB::table('soap_triase')->get();
        $data = RekapMedis::find($resume->id);
        $pasien = Pasien::with('alamat')->find($data->idpasien);
        $obat = Obat::with('satuan')->where('nama_obat', '!=', '')->orderBy('obat.nama_obat', 'asc')->get();

        $kategori = Kategori::find($data->idkategori);
        $kategori_diagnosa = DB::table('kategori_diagnosa')->get();
        $radiologi = DB::table('radiologi_tindakan')->get();
        $lab = DB::table('laboratorium_pemeriksaan')->get();
        $fisio = DB::table('tarif')->where('idkategori', 8)->get();
        return view('detail-rekap-medis.create', compact('pasien', 'kategori', 'data', 'obat', 'kategori_diagnosa', 'radiologi', 'lab', 'rawat', 'triase', 'fisio'));

        // return redirect(route('detail-rekap-medis-show',$detail_resume->id))->with('berhasil','Data Resume Berhasil Ditambahkan');
    }

    public function input_tindakan(Request $request, $id)
    {
        $rawat = RekapMedis::where('idrawat', $id)->first();
        $rawat->tindakan = json_encode($request->tindakan_repeater);
        $rawat->save();
        return redirect()->back()->with('berhasil', 'Data Tindakan Berhasil Ditambahkan');
    }

    public function post_delete_resep(Request $request){
        DB::table('demo_resep_dokter')->where('id',$request->id)->delete();
        return response()->json([
            'pesan' => 'Berhasil di hapus'
        ]);
    }

    function get_nama_obat($id){
        $obat = Obat::find($id);
        return $obat->nama_obat;
    }

    public function post_resep_racikan(Request $request,$id){
        $nama_obat = new Collection([
            'obat'=>$request->obat,
            'jumlah'=>$request->jumlah_obat
        ]);

        $resep = DB::table('demo_resep_dokter')->insertGetId([
            'idrawat'=>$id,
            'idobat'=>json_encode($request->obat),
            'nama_obat'=>$nama_obat,
            'jenis'=>'Racik',
            'jumlah'=>json_encode($request->jumlah_obat),
            'takaran'=>$request->takaran_obat,
            'dosis'=>$request->dosis_obat,
            'signa'=>json_encode($request->diminum),
            'catatan'=>$request->catatan,
            'dtd'=>$request->dtd,
            'diminum'=>$request->takaran,
            'diberikan'=>$request->pemberian
        ]);


        $list_obat = json_decode($nama_obat);
        $html_obat = '';
        $html_jumlah = '';
        foreach($list_obat->obat as $ob){
            if($ob != null){
                $html_obat .= VclaimHelper::get_data_obat($ob).'+';
            }
           
        }

        foreach($list_obat->jumlah as $jum){
            if($jum != null){
                $html_jumlah .= $jum.'+';
            }
        }

        $html ='';
        $html .= '<tr id="li'.$resep.'">';
        $html .= '<td>'.$html_obat.' <span class="badge badge-success">Racikan</span></td>';
        $html .= '<td>'.$html_jumlah.'</td>';
        $html .= '<td>'.$request->dosis_obat.'</td>';
        $html .= '<td>'.$request->takaran_obat.'</td>';
        $html .= '<td>'.json_encode($request->diminum).'</td>';
        $html .= '<td>'.$request->takaran.'</td>';
        $html .= '<td>'.$request->catatan.'</td>';
        $html .= '<td>
        <a class="btn btn-sm btn-danger btn-hapus" id="'.$resep.'" href="javascript:void(0)" style="cursor:pointer;"">Hapus</a>
        <button data-id="'.$resep.'" class="btn btn-sm btn-info btn-edit-racik">Edit</button>
        </td>';

        return response()->json(['status'=>'ok','data'=>$html]);
    }
    public function post_resep_update_non_racikan(Request $request,$id){
        // return $request->all();
        $resep = DB::table('demo_resep_dokter')->where('id',$id)->first();
        if($resep->jenis == 'Racik'){
            DB::table('demo_resep_dokter')->where('id',$id)->update([
                'jumlah'=>json_encode($request->jumlah_obat),
                'takaran'=>$request->takaran_obat,
                'dosis'=>$request->dosis_obat,
                'signa'=>json_encode($request->diminum),
                'catatan'=>$request->catatan,
                'diminum'=>$request->takaran,
                'diberikan'=>$request->pemberian
            ]);
    
    
            $list_obat = json_decode($resep->nama_obat);
            $html_obat = '';
            $html_jumlah = '';
            foreach($list_obat->obat as $ob){
                if($ob != null){
                    $html_obat .= VclaimHelper::get_data_obat($ob).'+';
                }
               
            }
    
            foreach($list_obat->jumlah as $jum){
                if($jum != null){
                    $html_jumlah .= $jum.'+';
                }
            }
            $html ='';
            $html .= '<tr id="li'.$resep->id.'">';
            $html .= '<td>'.$html_obat.' <span class="badge badge-success">Racikan</span></td>';
            $html .= '<td>'.$html_jumlah.'</td>';
            $html .= '<td>'.$request->dosis_obat.'</td>';
            $html .= '<td>'.$request->takaran_obat.'</td>';
            $html .= '<td>'.json_encode($request->diminum).'</td>';
            $html .= '<td>'.$request->takaran.'</td>';
            $html .= '<td>'.$request->catatan.'</td>';
            $html .= '<td>
            <a class="btn btn-sm btn-danger btn-hapus" id="'.$resep->id.'" href="javascript:void(0)" style="cursor:pointer;"">Hapus</a>
            <button data-id="'.$resep->id.'" class="btn btn-sm btn-info btn-edit-racik">Edit</button>
            </td>';

        return response()->json(['status'=>'ok','data'=>$html]);
        }else{
            DB::table('demo_resep_dokter')->where('id',$id)->update([
                'jumlah'=>$request->jumlah_obat,
                'takaran'=>$request->takaran_obat,
                'dosis'=>$request->dosis_obat,
                'signa'=>json_encode($request->diminum),
                'catatan'=>$request->catatan,
                'diminum'=>$request->takaran
            ]);
    
            
    
            $html ='';
            $html .= '<tr id="li'.$resep->id.'">';
            $html .= '<td>'.$resep->nama_obat.'</td>';
            $html .= '<td role="button" id="'.$resep->id.'">'.$resep->jumlah.'</td>';
            $html .= '<td>'.$resep->dosis.'</td>';
            $html .= '<td>'.$resep->takaran.'</td>';
            $html .= '<td>'.$resep->signa.'</td>';
            $html .= '<td>'.$resep->diminum.' makan</td>';
            $html .= '<td>'.$resep->catatan.'</td>';
            $html .= '<td><a
            class="btn btn-sm btn-danger btn-hapus"
            id="'.$resep->id.'" href="javascript:void(0)"
            style="cursor:pointer;"">Hapus</a>
            <button data-id="'.$resep->id.'" class="btn btn-sm btn-info btn-edit">Edit</button>   
            </td>';
    
            $html .= '</tr>';
    
            return response()->json(['status'=>'ok','data'=>$html]);
        }

    }
    public function post_resep_non_racikan(Request $request,$id){
        // return $request->all();
        $obat = Obat::find($request->obat_non);

        $resep = DB::table('demo_resep_dokter')->insertGetId([
            'idrawat'=>$id,
            'idobat'=>$request->obat_non,
            'nama_obat'=>$obat->nama_obat,
            'jenis'=>'Non Racik',
            'jumlah'=>$request->jumlah_obat,
            'takaran'=>$request->takaran_obat,
            'dosis'=>$request->dosis_obat,
            'signa'=>json_encode($request->diminum),
            'catatan'=>$request->catatan,
            'diminum'=>$request->takaran
        ]);

        $html ='';
        $html .= '<tr id="li'.$resep.'">';
        $html .= '<td>'.$obat->nama_obat.'</td>';
        $html .= '<td role="button" id="'.$resep.'">'.$request->jumlah_obat.'</td>';
        $html .= '<td>'.$request->dosis_obat.'</td>';
        $html .= '<td>'.$request->takaran_obat.'</td>';
        $html .= '<td>'.json_encode($request->diminum).'</td>';
        $html .= '<td>'.$request->takaran.'</td>';
        $html .= '<td>'.$request->catatan.'</td>';
        $html .= '<td><a
        class="btn btn-sm btn-danger btn-hapus"
        id="'.$resep.'" href="javascript:void(0)"
        style="cursor:pointer;"">Hapus</a>
        <button data-id="'.$resep.'" class="btn btn-sm btn-info btn-edit-racik">Edit</button>   
        </td>';

        $html .= '</tr>';

        return response()->json(['status'=>'ok','data'=>$html]);
    }

    public function update_template($id){
        $rekap_medis = RekapMedis::find($id);
        $rekap_medis->template = 1;
        $rekap_medis->save();
        return redirect()->back()->with('berhasil','Template Berhasil Diupdate');
    }

    public function edit_jumlah(Request $request){
        $resep_dokter = DB::table('demo_resep_dokter')->where('id',$request->id)->update([
            'jumlah'=>$request->value
        ]);
        return response()->json(['status'=>'ok']);
    }
}
