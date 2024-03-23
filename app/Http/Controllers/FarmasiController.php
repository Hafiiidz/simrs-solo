<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Rawat;
use App\Models\Obat\Obat;
use Illuminate\Http\Request;
use App\Helpers\VclaimHelper;
use App\Models\ObatTransaksi;
use App\Models\Pasien\Pasien;
use App\Models\AntrianFarmasi;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Models\RekapMedis\RekapMedis;
use Yajra\DataTables\Facades\DataTables;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class FarmasiController extends Controller
{
   
    public function antrian_resep()
    {
        //     $resep_rajal_umum = AntrianFarmasi::with('pasien','rawat')->where('jenis_rawat',1)->where('idbayar',1)->where('status_antrian','Antrian')->get();
        $resep_rajal = AntrianFarmasi::with('pasien', 'rawat')->whereDate('created_at', date('Y-m-d'))->where('jenis_rawat', 1)->where('status_antrian', 'Antrian')->whereNotNull('obat')->orderby('id', 'desc')->get();

        $resep_ugd = AntrianFarmasi::with('pasien', 'rawat')->whereDate('created_at', date('Y-m-d'))->where('jenis_rawat', 3)->where('status_antrian', 'Antrian')->whereNotNull('obat')->orderby('id', 'desc')->get();
        // $resep_ugd_bpjs = AntrianFarmasi::with('pasien','rawat')->where('jenis_rawat',3)->where('idbayar',2)->where('status_antrian','Antrian')->get();

        $resep_ranap = AntrianFarmasi::with('pasien', 'rawat')->where('jenis_rawat', 2)->where('status_antrian', 'Antrian')->whereNotNull('obat')->orderby('id', 'desc')->get();
        // $resep_ranap_bpjs = AntrianFarmasi::with('pasien','rawat')->where('jenis_rawat',2)->where('idbayar',2)->where('status_antrian','Antrian')->get();

        // $total_antrian = count($resep_rajal) + count($resep_ugd) + count($resep_ranap);
        $total_antrian = count($resep_rajal) + count($resep_ugd) + count($resep_ranap);

        $transaksi_bayar = DB::table('transaksi_bayar')->orderBy('urutan', 'asc')->get();
        return view('farmasi.antrian-resep', compact('resep_rajal', 'resep_ugd', 'resep_ranap', 'transaksi_bayar', 'total_antrian'));
    }

    public function updateResep(Request $request)
    {
        
    //    return $request->idantrian;
        // return $select_resep;
        $obat_non_racik = 0;
        $obat_racikan = 0;
        $hitung_kronis = 0;
        if(isset($request->idresep)){
            $select_resep = DB::table('demo_resep_dokter')->where('id', $request->idresep)->first();
            if($select_resep->jenis == 'Racik'){
                $gabungkanArray = array();
    
                foreach ($request->racikan as $key => $values) {
                    foreach ($values as $index => $value) {
                        if($value != null || $value != '')  {
                            $gabungkanArray[$index][$key] = $value;
                        }                    
                    }
                }
                // return $request->idantrian;
                $pemberian = [];
                foreach($gabungkanArray as $key => $value){
                    $pemberian[] = $value['pemberian'];
                    DB::table('demo_resep_dokter')->where('id', $key)->update([
                        'diberikan' => json_encode($value['pemberian']),
                        'kronis' => json_encode($value['pemberian_kronis']),
                        'idantrian'=>$request->idantrian
                    ]);
                }
                // return $pemberian;
                
                foreach($gabungkanArray as $key => $value){
                    $resep_dokter = DB::table('demo_resep_dokter')->where('id', $key)->first();
                    // if($resep_dokter->kronis != null || $resep_dokter->kronis != ''){
                    //     AntrianFarmasi::wher
                    // }
                    $data_obat = [];
                    $jumlah_obat = [];
                    $diberikan = [];
                    $kronis = [];
                    $obat = json_decode($resep_dokter->nama_obat);
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
                    foreach(json_decode($resep_dokter->diberikan) as $o){
                        $diberikan[] = [
                            'diberikan'=>$o,
                        ];
                    }
                    foreach(json_decode($resep_dokter->kronis) as $o){
                        $kronis[] = [
                            'kronis'=>$o,
                        ];
                    }
        
                    $obatData= json_encode(array_merge($data_obat,$jumlah_obat,$diberikan,$kronis));
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
                    for ($i = 0; $i < count($finalResult['diberikan']); $i++) {
                        $hitung_kronis += $finalResult['kronis'][$i];
                        $combinedArray[] = array(
                            'obat' => $finalResult['obat'][$i],
                            'jumlah_obat' => $finalResult['jumlah_obat'][$i],
                            'diberikan' => $finalResult['diberikan'][$i],
                            'kronis' => $finalResult['kronis'][$i],
                            
                        );
                    }
                   
                    // return $hitung_kronis;
        
                    $racikan[] = [
                        'obat'=>$combinedArray,
                        'jumlah_obat'=>$jumlah_obat,
                        'diberikan'=>$diberikan,
                        'kronis'=>$kronis,
                        'takaran'=>$resep_dokter->takaran,
                        'dosis'=>$resep_dokter->dosis,
                        'signa'=>$resep_dokter->signa,
                        'diminum'=>$resep_dokter->diminum,
                        'catatan'=>$resep_dokter->catatan,
                        'idresep'=>$resep_dokter->id,
                        'jenis'=>$request->jenis_obat[$resep_dokter->id],
                    ];
                }
                // 
                if($hitung_kronis > 0){
                    AntrianFarmasi::where('id', $request->idantrian)->update([
                        'kronis' => 1,
                    ]);
                }else{
                    AntrianFarmasi::where('id', $request->idantrian)->update([
                        'kronis' => null,
                    ]);
                }
    
    
                // 
                AntrianFarmasi::where('id', $request->idantrian)->update([
                    'racikan' => json_encode($racikan),
                    'update'=>1,
                ]);
                // return $combinedArray;
            }
        }
       

        if($request->idresep_non_racikan){
            foreach($request->idresep_non_racikan as $non_racik){
                $select_resep_non = DB::table('demo_resep_dokter')->where('id', $non_racik)->update([
                    'diberikan'=>$request->pemberian[$non_racik],
                    'kronis'=>$request->kronis[$non_racik],
                    'idantrian'=>$request->idantrian
                ]);
                
                $rd = DB::table('demo_resep_dokter')->where('id', $non_racik)->first();
                $hitung_kronis += $rd->kronis;
                $non_racikan[] = [
                    'obat'=>$rd->idobat,
                    'takaran'=>$rd->takaran,
                    'jumlah'=>$rd->jumlah,
                    'diberikan'=>$rd->diberikan,
                    'kronis'=>$rd->kronis,
                    'dosis'=>$rd->dosis,
                    'signa'=>$rd->signa,
                    'diminum'=>$rd->diminum,
                    'catatan'=>$rd->catatan,
                    'dtd'=>$rd->dtd,
                    'idresep'=>$rd->id,
                    'jenis'=>$request->jenis_obat_non_racikan[$rd->id],
                    'tambahan_farmasi'=>$rd->tambahan_farmasi
                ];
            }

            if($hitung_kronis > 0){
                AntrianFarmasi::where('id', $request->idantrian)->update([
                    'kronis' => 1,
                ]);
            }else{
                AntrianFarmasi::where('id', $request->idantrian)->update([
                    'kronis' => null,
                ]);
            }
            AntrianFarmasi::where('id', $request->idantrian)->update([
                'obat' => json_encode($non_racikan),
                'update'=>1,
            ]);            
        }
        
        // return $hitung_kronis;
        // return $request->all();

        $total_obat = 0;
        $total_kronis = 0;
        $kronis = 0;
        $total_obat_racikan = 0;

        $antrian = AntrianFarmasi::find($request->idantrian);
        foreach(json_decode($antrian->obat) as $non){
            $obat = Obat::find($non->obat);
            if($non->jenis != 1){
                $total_obat += $obat->harga_beli * $non->diberikan;
                $total_kronis += $obat->harga_beli *$non->kronis;
            }else{
                $total_obat += $obat->harga_jual * $non->diberikan + 3000;
                $total_kronis += $obat->harga_beli *$non->kronis;
            }           

        }

        foreach(json_decode($antrian->racikan) as $racik){
            foreach($racik->obat as $bat){
                $obat = Obat::find($bat->obat);
                if($racik->jenis != 1){
                    $total_obat_racikan += $obat->harga_beli * $bat->diberikan;
                    $total_kronis += $obat->harga_beli *$bat->kronis;
                }else{
                    $total_obat_racikan += $obat->harga_jual * $bat->diberikan + 3000;
                    $total_kronis += $obat->harga_beli *$bat->kronis;
                }           
            }
        }

        return response()->json([
            'status' => 'true',
            'total' =>  VclaimHelper::IndoCurr($total_obat_racikan + $total_obat),
            'kronis' => $total_kronis
        ]);
    }

    public function post_resep(Request $request, $id)
    {
        // return $request->all();
        $antrian = AntrianFarmasi::find($id);
        if($antrian->update != 1){
            return back()->with('gagal', 'Pastikan data sudah di update');
        }
        $rawat = Rawat::find($antrian->idrawat);
        $transaksi = DB::table('transaksi')->where('kode_kunjungan', $rawat->idkunjungan)->first();
        $pasien = Pasien::where('no_rm', $rawat->no_rm)->first();
        #simpan transaksi resep
        $obat_transaksi = new ObatTransaksi();
        $obat_transaksi->idrawat = $rawat->id;
        $obat_transaksi->no_rm = $rawat->no_rm;
        $obat_transaksi->idtrx = $transaksi?->id;
        $obat_transaksi->status = 2;
        $obat_transaksi->idresep = $antrian->id;
        $obat_transaksi->iduser = auth()->user()->id; 
        $obat_transaksi->tgl = date('Y-m-d');
        $obat_transaksi->idjenisrawat = $rawat->idjenisrawat;
        $obat_transaksi->jam = date('H:i:s');
        $obat_transaksi->kode_resep = 'RI' . date('Ymd') . rand(000000, 99999);
        $obat_transaksi->idjenis = 1;
        $obat_transaksi->save();

        #simpan resep
        $total_obat = 0;
        $total_obat_racikan = 0;
        if($antrian->obat != null || $antrian->obat != ''){
            foreach (json_decode($antrian->obat) as $to) {
                $obat = Obat::find($to->obat);
                if($to->jenis != 1){                    
                    $tuslah = 0;
                    $total_obat += $obat->harga_beli * $to->diberikan + $tuslah;
                    $harga = $obat->harga_beli;
                }else{
                    
                    $tuslah = 3000;
                    $total_obat += $obat->harga_jual * $to->diberikan + $tuslah;
                    $harga = $obat->harga_jual;
                }
                
                if($to->kronis > 0){
                    if($to->jenis != 1){
                        $tuslah = 0;
                        $total_obat += $obat->harga_beli * $to->kronis;
                        $harga = $obat->harga_beli;
                    }else{                        
                        $tuslah = 3000;
                        $total_obat += $obat->harga_jual * $to->kronis;
                        $harga = $obat->harga_jual;
                    }
                    // for($i=1; $i<=$to->kronis; $i++){
                        DB::table('obat_transaksi_detail')->insert([
                            'idtrx' => $obat_transaksi->id,
                            'idtransaksi' => $transaksi?->id,
                            'nama_obat' => $obat->nama_obat,
                            'idobat' => $to->obat,
                            'qty' => $to->kronis,
                            'harga' => $harga,
                            'signa' => $to->signa,
                            'tuslah'=>$tuslah,
                            'dosis'=> $to->dosis,
                            'diminum'=> $to->diminum,
                            'takaran'=> $to->takaran,
                            'total' => $harga * $to->kronis,
                            'idbayar' =>3,
                            'no_stok'=>1,
                        ]);
                    // }
                }
               
                DB::table('obat_transaksi_detail')->insert([
                    'idtrx' => $obat_transaksi->id,
                    'nama_obat' => $obat->nama_obat,
                    'idtransaksi' => $transaksi?->id,
                    'idobat' => $to->obat,
                    'qty' => $to->diberikan,
                    'harga' => $harga,
                    'signa' => $to->signa,
                    'tuslah'=>$tuslah,
                    'dosis'=> $to->dosis,
                    'diminum'=> $to->diminum,
                    'takaran'=> $to->takaran,
                    'total' => $harga * $to->diberikan + $tuslah,
                    'idbayar' => $to->jenis,
                    'no_stok'=>1,
                ]);
            }
        }

        if($antrian->racikan != null || $antrian->racikan != ''){
            $obat_transaksi_save = ObatTransaksi::find($obat_transaksi->id);
            $obat_transaksi_save->jumlahracik = count(json_decode($antrian->racikan));
            $obat_transaksi_save->jasa_racik = 10000 * count(json_decode($antrian->racikan));            
            $obat_transaksi_save->save();

            foreach (json_decode($antrian->racikan) as $to) {
                #create obat_racik
                $obat_racik = DB::table('obat_racik')->insertGetId([
                    'idresep'=>$obat_transaksi->id,
                    'tgl'=>date('Y-m-d'),
                    'idbayar'=>$rawat->idbayar,
                    'status'=>2,
                    'idrawat'=>$rawat->id,
                    'kode_racik'=>"RCK".date('Ymd').rand(000000,999999),
                ]);
             
                foreach($to->obat as $ob){
                    if($ob->kronis > 0){
                        if($to->jenis != 1){
                            
                            $tuslah = 0;
                            $total_obat_racikan += $obat->harga_beli * $ob->kronis + $tuslah;
                            $harga = $obat->harga_beli;
                        }else{
                            
                            $tuslah = 3000;
                            $total_obat_racikan += $obat->harga_jual * $ob->kronis + $tuslah;
                            $harga = $obat->harga_jual;
                        }
                        
                        // for($i=1; $i<=$ob->kronis; $i++){
                            DB::table('obat_transaksi_detail')->insert([
                                'idtrx' => $obat_transaksi->id,
                                'nama_obat' => $obat->nama_obat,
                                'idtransaksi' => $transaksi?->id,
                                'idobat' => $ob->obat,
                                'qty' => $ob->kronis,
                                'harga' => $harga,
                                'tuslah'=>$tuslah,
                                'signa' => $to->signa,
                                'dosis'=> $to->dosis,
                                'diminum'=> $to->diminum,
                                'takaran'=> $to->takaran,
                                'total' => $harga * $ob->kronis + $tuslah,
                                'idbayar' =>3,
                                'no_stok'=>1,
                            ]);
                        // }
                    }
                    $obat = Obat::find($ob->obat);
                    if($to->jenis != 1){
                        $tuslah = 0;
                        $total_obat_racikan += $obat->harga_beli * $ob->diberikan + $tuslah;
                        $harga = $obat->harga_beli;
                        
                    }else{
                        $tuslah = 3000;
                        $total_obat_racikan += $obat->harga_jual * $ob->diberikan + $tuslah;
                        $harga = $obat->harga_jual;
                        
                    }
                    DB::table('obat_transaksi_detail')->insert([
                        'idtrx' => $obat_transaksi->id,
                        'nama_obat' => $obat->nama_obat,
                        'idobat' => $ob->obat,
                        'qty' => $ob->diberikan,
                        'idtransaksi' => $transaksi?->id,
                        'harga' => $harga,
                        'signa' => $to->signa,
                        'tuslah'=>$tuslah,
                        'dosis'=> $to->dosis,
                        'diminum'=> $to->diminum,
                        'takaran'=> $to->takaran,
                        'total' => $harga * $ob->diberikan + $tuslah,
                        'idbayar' => $to->jenis,
                        'no_stok'=>1,
                    ]);

                    #insert obat_racik_detail
                    DB::table('obat_racik_detail')->insert([
                        'idracik'=>$obat_racik,
                        'idobat'=>$ob->obat,
                        'jumlah'=>$ob->diberikan,
                        'idresep'=>$obat_transaksi->id,
                        'nama_obat'=>$obat->nama_obat,
                        'status'=>2
                    ]);
                }
            }
        }
        // return $total_obat;

        $obat_transaksi_save = ObatTransaksi::find($obat_transaksi->id);
        $obat_transaksi_save->total_harga = $total_obat + $total_obat_racikan;
        $obat_transaksi_save->save();

        $antrian->status_antrian = 'Selesai';
        $antrian->idresep = $obat_transaksi->id;
        $antrian->save();
        $current_time = round(microtime(true) * 1000); 

        VclaimHelper::update_task($rawat->idrawat,7,$current_time); 
        
        return back()->with('berhasil', 'Resep Berhasil Di Simpan');
    }

    public function tambah_obat_status(Request $request,$id){
        return $request->all();
    }

    public function modal_tambah_obat(){

    }

    public function status_rajal($id)
    {
        $rawat = Rawat::find($id);
        $pasien = Pasien::where('no_rm', $rawat->no_rm)->first();
        $antrian = AntrianFarmasi::where('idrawat', $id)->where('status_antrian','Antrian')->first();
        $rekap_medis = RekapMedis::where('idrawat', $id)->first();
        // return $antrian->obat;
        $obat = Obat::where('nama_obat','!=','')->orderBy('nama_obat', 'asc')->get();
        $transaksi_bayar = DB::table('transaksi_bayar')->where('status',1)->orderBy('urutan', 'asc')->get();
        $takaran = ['-','tablet','kapsul','bungkus','tetes','ml','sendok takar 5ml','sendok takar 15ml','oles'];
        $resep = ObatTransaksi::where('idrawat', $id)->get();
        return view('farmasi.status-rajal', compact('rawat', 'pasien', 'antrian', 'rekap_medis', 'obat', 'transaksi_bayar', 'resep','takaran'));
    }
    public function status_ranap($id)
    {
        $rawat = Rawat::find($id);
        $pasien = Pasien::where('no_rm', $rawat->no_rm)->first();
        $antrian = AntrianFarmasi::where('idrawat', $id)->where('status_antrian', 'Antrian')->first();

        $obat = Obat::where('nama_obat','!=','')->get();
        // return $obat;
        $transaksi_bayar = DB::table('transaksi_bayar')->orderBy('urutan', 'asc')->get();
        $pemberian_obat = DB::table('demo_pemberian_obat_inap')->where('idrawat', $id)->get();
        $pemberian_obat_injeksi = DB::table('demo_pemberian_obat_inap')->where('idrawat', $id)->where('jenis', 'Injeksi')->get();
        $pemberian_obat_non_injeksi = DB::table('demo_pemberian_obat_inap')->where('idrawat', $id)->where('jenis', 'Non Injeksi')->get();
        $cppt = DB::table('rawat_cppt')->where('idrawat', $id)->get();
        $resep = ObatTransaksi::where('idrawat', $id)->get();
        $takaran = ['-','tablet','kapsul','bungkus','tetes','ml','sendok takar 5ml','sendok takar 15ml','oles'];
        return view('farmasi.status-ranap', compact('rawat', 'pasien', 'antrian', 'obat', 'transaksi_bayar', 'resep', 'pemberian_obat', 'pemberian_obat_injeksi', 'pemberian_obat_non_injeksi', 'cppt','takaran'));
    }
    public function post_pemberian(Request $request, $id)
    {
        // return $request->all();
        $rawat = Rawat::find($id);

        DB::table('demo_pemberian_obat_inap')->insert([
            'idrawat' => $rawat->id,
            'jenis' => $request->jenis_pemberian,
            'tgl' => $request->tgl,
            'pemberian_obat' => json_encode($request->pemberian_obat),
            'created_at' => now(),
            'updated_at' => now(),
            'user' => auth()->user()->id,
        ]);
        return redirect()->back()->with('berhasil', 'Data Pemberian Obat Berhasil Di Simpan');
    }

    public function list_obat()
    {
        if (request()->ajax()) {
            $query = Obat::orderBy('abjad', 'asc');
            return DataTables::eloquent($query)->make(true);
        }
        return view('farmasi.list-obat');
    }
    public function list_resep()
    {
        if (request()->ajax()) {
            $query = ObatTransaksi::with('rawat', 'rawat.pasien')->orderBy('id', 'desc');
            return DataTables::eloquent($query)
                ->addColumn('dokter', function ($item) {
                    return $item->rawat->dokter->nama_dokter;
                })
                ->addColumn('poli', function ($item) {
                    return $item->rawat->poli->poli;
                })
                ->addColumn('penanggung', function ($item) {
                    return $item->rawat->bayar->bayar;
                })
                ->addColumn('action', function ($item) {
                    if ($item->idjenisrawat == 2) {
                        return '
                    <a href="' . route('farmasi.status-ranap', $item->idrawat) . '" class="btn btn-sm btn-primary">Lihat</a>
                    ';
                    } else {
                        return '
                <a href="' . route('farmasi.status-rajal', $item->idrawat) . '" class="btn btn-sm btn-primary">Lihat</a>
                ';
                    }
                })
                ->rawColumns(['action', 'dokter', 'poli', 'penanggung'])
                ->make(true);
        }
        return view('farmasi.list-resep');
    }
    public function list_pasien_rawat()
    {

        if (request()->ajax()) {
            $query = Rawat::with('pasien', 'bayar')->where('idjenisrawat', 2)->where('status', 2)->orderBy('id', 'asc');
            return DataTables::eloquent($query)
                ->addColumn('dokter', function ($item) {
                    return $item->dokter->nama_dokter;
                })
                ->addColumn('action', function ($item) {
                    return '
                <a href="' . route('farmasi.status-ranap', $item->id) . '" class="btn btn-sm btn-primary">Lihat</a>
                ';
                })
                ->rawColumns(['action', 'terisi'])
                ->make(true);
        }
        return view('farmasi.list-pasien-rawat');
    }

    public function cetakFakturTempo($id){
        $resep = AntrianFarmasi::find($id);
        
        $rawat = Rawat::find($resep->idrawat);
        $pasien = Pasien::where('no_rm', $rawat->no_rm)->first();
       
        $obat = Obat::get();
        $pdf = PDF::loadview('farmasi.cetak.resep-faktur-tempo', compact('resep', 'rawat', 'pasien', 'obat'));
        $customPaper = array(0, 0, 323.15, 790.866);
        $pdf->setPaper($customPaper);
        return $pdf->stream();
    }
    public function cetakResepTempo($id)
    {
        $resep = AntrianFarmasi::find($id);
        $rawat = Rawat::find($resep->idrawat);
        $detail_rekap = DB::table('demo_detail_rekap_medis')->where('id', $rawat->idrekap)->first();       
        $pasien = Pasien::where('no_rm', $rawat->no_rm)->first();
        $alamat = DB::table('pasien_alamat')->where('idpasien', $pasien->id)->first();
        $obat = Obat::get();
        $qr = QrCode::size(150)
        ->backgroundColor(255, 255, 255)
        ->color(0, 0, 0)
        ->margin(1)
        ->generate(
            '"'.$rawat->dokter->nama_dokter.'"',
        );
        $pdf = PDF::loadview('farmasi.cetak.resep-tempo', compact('resep', 'rawat', 'pasien', 'obat', 'detail_rekap', 'alamat','qr'));
        $customPaper =array(0,0,567.00,283.80,'landscape');
        $pdf->setPaper('a5','portrait');
        return $pdf->stream();
    }
   
    public function cetakResep($id){
        $resep = ObatTransaksi::where('id', $id)->first();
        $rawat = Rawat::find($resep->idrawat);
        $pasien = Pasien::where('no_rm', $rawat->no_rm)->first();
        $detail_resep = DB::table('obat_transaksi_detail')->where('idtrx', $resep->id)->get();
        $obat = Obat::get();
        $pdf = PDF::loadview('farmasi.cetak.resep', compact('resep', 'rawat', 'pasien', 'obat', 'detail_resep'));
        $pdf->setPaper('a5','portrait');
        return $pdf->stream();
    }
    public function cetakFaktur($id)
    {
        $resep = ObatTransaksi::where('id', $id)->first();
        $rawat = Rawat::find($resep->idrawat);
        $pasien = Pasien::where('no_rm', $rawat->no_rm)->first();
        $detail_resep = DB::table('obat_transaksi_detail')->where('idtrx', $resep->id)->get();
        $racik = DB::table('obat_racik')->where('idresep', $resep->id)->get();
        // dd($racik);
        $cek_kronis = DB::table('obat_transaksi_detail')->where('idbayar',3)->where('idtrx', $resep->id)->count();
        $pdf = PDF::loadview('farmasi.cetak.faktur', compact('resep', 'rawat', 'pasien', 'detail_resep', 'cek_kronis','racik'));
        $customPaper = array(0, 0, 323.15, 790.866);
        $pdf->setPaper($customPaper);
        return $pdf->stream();
    }

    public function cetakTiketTempo($id)
    {
        // $resep = ObatTransaksi::where('id', $id)->first();
        // $rawat = Rawat::find($resep->idrawat);
        // $pasien = Pasien::select('pasien.*', 'pasien_alamat.alamat')
        //     ->leftJoin('pasien_alamat', 'pasien.id', '=', 'pasien_alamat.idpasien')->where('pasien.no_rm', $rawat->no_rm)->first();
        // $detail_resep = DB::table('obat_transaksi_detail')->where('idtrx', $resep->id)->get();
        $resep = AntrianFarmasi::find($id);
        $rawat = Rawat::find($resep->idrawat);
        $detail_rekap = DB::table('demo_detail_rekap_medis')->where('id', $rawat->idrekap)->first();
        $pasien = Pasien::where('no_rm', $rawat->no_rm)->first();
        $obat = Obat::get();
        
        $pdf = PDF::loadview('farmasi.cetak.tiket-tempo', compact('resep', 'rawat', 'pasien', 'detail_rekap'));
        $customPaper = array(0, 0, 170.079, 198.425);
        $pdf->setPaper($customPaper);
        return $pdf->stream();
    }
    public function cetakTiket($id)
    {
        $resep = ObatTransaksi::where('id', $id)->first();
        $rawat = Rawat::find($resep->idrawat);
        $pasien = Pasien::select('pasien.*', 'pasien_alamat.alamat')
            ->leftJoin('pasien_alamat', 'pasien.id', '=', 'pasien_alamat.idpasien')->where('pasien.no_rm', $rawat->no_rm)->first();
        $detail_resep = DB::table('obat_transaksi_detail')->where('idtrx', $resep->id)->get();

        $pdf = PDF::loadview('farmasi.cetak.tiket', compact('resep', 'rawat', 'pasien', 'detail_resep'));
        $customPaper = array(0, 0, 170.079, 198.425);
        $pdf->setPaper($customPaper);
        return $pdf->stream();
    }

    public function hapus_obat(Request $request){
        // $antrian = AntrianFarmasi::find($request->antrian);
        // return $antrian;
        try{
            DB::table('demo_resep_dokter')->where('jenis','Non Racik')->where('idantrian', $request->antrian)->where('idobat',$request->idobat)->delete();
            $antrian = AntrianFarmasi::find($request->antrian);
            $resep_dokter = DB::table('demo_resep_dokter')->where('jenis','Non Racik')->where('idantrian',$request->antrian)->get();
            $rawat = Rawat::find($antrian->idrawat);
            if($rawat->idbayar == 2){
                $jenis = 2;
            }else{
                $jenis = 1;
            }
            if (count($resep_dokter) > 0) {                
                $non_racik = [];
                foreach($resep_dokter as $rd){
                 
                        $non_racik[] = [
                            'obat'=>$rd->idobat,
                            'takaran'=>$rd->takaran,
                            'jumlah'=>$rd->jumlah,
                            'dosis'=>$rd->dosis,
                            'diberikan'=>$rd->diberikan,
                            'signa'=>$rd->signa,
                            'diminum'=>$rd->diminum,
                            'catatan'=>$rd->catatan,
                            'idresep'=>$rd->id,
                            'jenis'=>$jenis,
                            'tambahan_farmasi'=>$rd->tambahan_farmasi,
                        ];
                }
                
                
                DB::table('demo_antrian_resep')->where('id',$request->antrian)->update([
                    'obat' => json_encode($non_racik),
                    'updated_at' => now(),
                ]);
                return response()->json([
                    'status'=>true,
                    'pesan'=>'Data Berhasil Di Hapus'
                ]);
            }
            
        }catch(\Exception $e){
            return response()->json([
                'status'=>false,
                'pesan'=>'Data Gagal Di Hapus',
                'error'=>$e->getMessage()
            ]);
        }
    }

    public function singkron_resep($id){
        $rawat = Rawat::find($id);
        $antrian = AntrianFarmasi::where('idrawat', $id)->where('status_antrian','Antrian')->first();
        $resep_dokter = DB::table('demo_resep_dokter')->where('idrawat', $rawat->id)->where('idantrian',$antrian->id)->get();
        // dd($resep_dokter);
        // dd($resep_dokter);
        if (count($resep_dokter) > 0) {                
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
            // $no_antrian = DB::table('demo_antrian_resep')->whereDate('created_at', Carbon::today())->where('jenis_rawat', $rawat->idjenisrawat)->count();
            DB::table('demo_antrian_resep')->where('idrawat',$id)->where('status_antrian','Antrian')->update([
                'racikan' => json_encode($racikan),
                'obat' => json_encode($non_racik),
                'updated_at' => now(),
            ]);
            $antrian = DB::table('demo_antrian_resep')->where('idrawat', $id)->where('status_antrian','Antrian')->first();

            DB::table('demo_resep_dokter')->where('idrawat', $rawat->id)->whereNull('idantrian')->update([
                'idantrian'=>$antrian->id
            ]);
        }
        return redirect()->back()->with('berhasil', 'Data Berhasil Di Simpan');
    }
    public function post_edit_farmasi_racikan(Request $request){
        // return $request->all();
        $obat = Obat::find($request->id_data_obat);
        $resep_asal = DB::table('demo_resep_dokter')->where('id', $request->resep_asal)->first();
        $targetKey = $request->obat_asal;
        $newValue = $request->id_data_obat;
        $myArray = json_decode($resep_asal->idobat);
        $keyToReplace = array_search($targetKey, $myArray);
        $myArray[$keyToReplace] = $newValue;

        $nama_obat = new Collection([
            'obat'=>$myArray,
            'jumlah'=>json_decode($resep_asal->jumlah)
        ]);

        DB::table('demo_resep_dokter')->where('id', $request->resep_asal)->update([
            'idobat'=>json_encode($myArray),
            'nama_obat'=>$nama_obat,
        ]);

        // return $resep_asal;

        $resep = DB::table('demo_resep_dokter')->where('idantrian', $resep_asal->idantrian)->where('jenis','Racik')->get();
        // return $resep;
        $racikan = [];
        foreach($resep as $rd){
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
            }
        }
        // return $racikan;
        DB::table('demo_antrian_resep')->where('id',$resep_asal->idantrian)->update([
            'racikan' => json_encode($racikan),
            'updated_at' => now(),
        ]);
        return redirect()->back()->with('berhasil', 'Data Berhasil Di Simpan');

        
    }
    public function post_edit_farmasi(Request $request){
        // return $request->all();
        $obat = Obat::find($request->id_data_obat);
        $resep_asal = DB::table('demo_resep_dokter')->where('id', $request->resep_asal)->first();
        DB::table('demo_resep_dokter')->where('id', $request->resep_asal)->update([
            'idobat'=>$request->id_data_obat,
            'nama_obat'=>$obat->nama_obat,
        ]);
        $rawat = Rawat::find($resep_asal->idrawat);
        if($rawat->idbayar == 2){
            $jenis = 2;
        }else{
            $jenis = 1;
        }
        $resep = DB::table('demo_resep_dokter')->where('idantrian', $resep_asal->idantrian)->where('jenis','Non Racik')->get();
        if (count($resep) > 0) {                
            $non_racik = [];
            foreach($resep as $rd){
             
                    $non_racik[] = [
                        'obat'=>$rd->idobat,
                        'takaran'=>$rd->takaran,
                        'jumlah'=>$rd->jumlah,
                        'dosis'=>$rd->dosis,
                        'diberikan'=>$rd->diberikan,
                        'signa'=>$rd->signa,
                        'diminum'=>$rd->diminum,
                        'catatan'=>$rd->catatan,
                        'idresep'=>$rd->id,
                        'jenis'=>$jenis,
                        'tambahan_farmasi'=>$rd->tambahan_farmasi,
                    ];
            }
            
            
            DB::table('demo_antrian_resep')->where('id',$resep_asal->idantrian)->update([
                'obat' => json_encode($non_racik),
                'updated_at' => now(),
            ]);
            // return redirect()->back()->with('berhasil', 'Data Berhasil Di Simpan');
        }
        // return $resep;
        return redirect()->back()->with('berhasil', 'Data Berhasil Di Simpan');
    }
    public function get_edit_farmasi($id,$idobat){
        $antrian = AntrianFarmasi::find($id);
        $obat = Obat::find($idobat);
        $resep = DB::table('demo_resep_dokter')->where('idrawat', $antrian->idrawat)->where('idantrian',$id)->where('idobat',$idobat)->first();
        $list_obat = Obat::get();
        return View::make('farmasi.modal.edit-obat', compact('antrian', 'obat', 'resep', 'list_obat'));
    }
    public function get_edit_racikan($id,$idobat){
        $antrian = AntrianFarmasi::find($id);
        $obat = Obat::find($idobat);
        $resep = DB::table('demo_resep_dokter')->where('id',$id)->first();
        $list_obat = Obat::get();
        return View::make('farmasi.modal.edit-obat-racikan', compact('antrian', 'obat', 'resep', 'list_obat'));
    }

    public function tambah_obat(Request $request){
        $obat = Obat::find($request->obat_non);
        // return response()->json([
        //     'status'=>true,
        //     'obat'=>$obat
        // ]);
        try{
            DB::table('demo_resep_dokter')->where('idrawat', $request->idrawat)->where('jenis','Non Racik')->whereNotNull('idantrian')->update([
                'idantrian'=>$request->idtambah,
            ]);


            $resep = DB::table('demo_resep_dokter')->insertGetId([
                'idrawat'=>$request->idrawat,
                'idantrian'=>$request->idtambah,
                'idobat'=>$request->obat_non,
                'nama_obat'=>$obat->nama_obat,
                'jenis'=>'Non Racik',
                'jumlah'=>$request->jumlah_obat,
                'diberikan'=>$request->jumlah_obat,
                'takaran'=>$request->takaran_obat,
                'dosis'=>$request->dosis_obat,
                'signa'=>json_encode($request->diminum),
                'catatan'=>$request->catatan,
                'diminum'=>$request->takaran,
                'tambahan_farmasi'=>1,
            ]);

            $resep_dokter = DB::table('demo_resep_dokter')->where('jenis','Non Racik')->where('idrawat', $request->idrawat)->where('idantrian',$request->idtambah)->get();
            // return $resep_dokter;
            $rekap_medis = RekapMedis::where('idrawat', $request->idrawat)->first();
            $rawat = Rawat::find($request->idrawat);
            if($rawat->idbayar == 2){
                $jenis = 2;
            }else{
                $jenis = 1;
            }
            if (count($resep_dokter) > 0) {                
                $non_racik = [];
                foreach($resep_dokter as $rd){
                 
                        $non_racik[] = [
                            'obat'=>$rd->idobat,
                            'takaran'=>$rd->takaran,
                            'jumlah'=>$rd->jumlah,
                            'dosis'=>$rd->dosis,
                            'diberikan'=>$rd->diberikan,
                            'signa'=>$rd->signa,
                            'diminum'=>$rd->diminum,
                            'catatan'=>$rd->catatan,
                            'idresep'=>$rd->id,
                            'jenis'=>$jenis,
                            'tambahan_farmasi'=>$rd->tambahan_farmasi,
                        ];
                }
                
                
                DB::table('demo_antrian_resep')->where('id',$request->idtambah)->update([
                    'obat' => json_encode($non_racik),
                    'updated_at' => now(),
                ]);
                return redirect()->back()->with('berhasil', 'Data Berhasil Di Simpan');
            }
        }catch(\Exception $e){
            return redirect()->back()->with('gagal', 'Data Gagal Di Simpan');
        }
        
        
    }
    public function tambah_resep($id){
        $rawat = Rawat::find($id);
        $rekap_medis = RekapMedis::where('idrawat', $id)->first();
        $no_antrian = DB::table('demo_antrian_resep')->whereDate('created_at', Carbon::today())->where('jenis_rawat', $rawat->idjenisrawat)->count();
        $antrian = DB::table('demo_antrian_resep')->insert([
            'idrawat' => $rekap_medis->idrawat,
            'racikan' => [],
            'idbayar' => $rekap_medis->rawat->idbayar,
            'status_antrian' => 'Antrian',
            'no_rm' => $rekap_medis->rawat->no_rm,
            'idrekap' => $rekap_medis->id,
            'no_antrian' => $no_antrian + 1,
            'obat' => [],
            'jenis_rawat' => $rekap_medis->rawat->idjenisrawat,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect(route('farmasi.status-rajal', $id))->with('berhasil', 'Resep Berhasil Di Tambah');

    }
    public function delete_racikan($id){
        $resep = DB::table('demo_resep_dokter')->where('id',$id)->first();
        DB::table('demo_resep_dokter')->where('id',$id)->delete();
        return redirect(route('farmasi.singkron-resep', $resep->idrawat))->with('berhasil', 'Berhasil');

    }
    public function batalkan_resep($id){
        $antrian = AntrianFarmasi::find($id);
        $antrian->status_antrian = 'Batal';
        $antrian->save();
        return redirect()->back()->with('berhasil', 'Resep Berhasil Di Batalkan');
        // return redirect(route('farmasi.status-rajal', $antrian->idrawat))->with('berhasil', 'Resep Berhasil Di Batalkan');
    }
    public function post_resep_racikan(Request $request,$id){
        $rawat = Rawat::find($id);
        $antrian = AntrianFarmasi::where('idrawat', $id)->where('status_antrian','Antrian')->first();
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
            'diberikan'=>$request->pemberian,
            'idantrian'=>$antrian->id,
        ]);


        return redirect(route('farmasi.singkron-resep', $rawat->id));


      
    }
}
