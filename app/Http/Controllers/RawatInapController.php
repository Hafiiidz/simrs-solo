<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Poli;
use App\Models\Rawat;
use App\Models\Tarif;
use App\Models\Dokter;
use App\Models\Ruangan;
use App\Models\Obat\Obat;
use App\Models\TindakLanjut;
use Illuminate\Http\Request;
use App\Models\ObatTransaksi;
use App\Models\Pasien\Pasien;
use App\Models\Gizi\SkriningGizi;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use App\Models\RekapMedis\RekapMedis;
use App\Models\Operasi\LaporanOperasi;
use PDF;
use Yajra\DataTables\Facades\DataTables;

class RawatInapController extends Controller
{
    public function get_ruangan($id){
        $ruangan = Ruangan::where('idkelas',$id)->get();
        foreach ($ruangan as $key => $value) {
            echo '<option value="'.$value->id.'">'.$value->nama_ruangan.'</option>';
        }
    }
    public function postRanap(Request $request,$id){
        // return $request->all();
        $rawat = Rawat::find($id);
        $transaksi = DB::table('transaksi')->where('kode_kunjungan', $rawat->idkunjungan)->first();
        $pasien = Pasien::where('no_rm',$rawat->no_rm)->first();
        $cek_ringakasan = DB::table('rawat_ringkasanpulang')->where('idrawat', $rawat->id)->first();
        $data_pulang = [
            'idrawat'=>$rawat->id,
            'no_rm'=>$rawat->no_rm,
            'tgl_pulang'=>$request->tgl_pulang,
            'jam_pulang'=>date('H:i:s',strtotime($request->jam_pulang)),
            'anjuran'=>$request->anjuran,
            'terapi'=>$request->terapi,
            'kondisi_waktupulang'=>$request->kondisi_pulang,
            'tgl_kontrol'=>$request->tgl_kontrol,
            'idpoli'=>$request->poli_tujuan,
        ];
        if($cek_ringakasan){
            DB::table('rawat_ringkasanpulang')->where('idrawat', $rawat->id)->update($data_pulang);
            // $pulang = DB::table('rawat_ringkasanpulang')->where('idrawat', $rawat->id)->first();
            $pulang = $cek_ringakasan->id;
        }else{
            $pulang = DB::table('rawat_ringkasanpulang')->insertGetId($data_pulang);
        }

        #tindakan
        $tindakan = DB::table('demo_trx_tindakan')->where('idrawat',$rawat->id)->get();
        // if (count($tindakan) > 0) {
        //     foreach ($tindakan as $tk) {
        //         $tarif = Tarif::find($tk->idtindakan);
        //         for ($x = 1; $x <= $tk->jumlah; $x++) {
        //             DB::table('transaksi_detail_rinci')->insert([
        //                 'idbayar' => $rawat->idbayar,
        //                 'iddokter' => $tk->iddokter,
        //                 'idpaket' => 0,
        //                 'idjenis' => 0,
        //                 'idrawat' => $rawat->id,
        //                 'idtransaksi' => $transaksi->id,
        //                 'idtarif' => $tk->idtindakan,
        //                 'tarif' => $tarif->tarif,
        //                 'idtindakan' => $tarif->kat_tindakan,
        //                 'tgl' => now(),
        //             ]); 
        //         }
        //     }
        // }

        $response = Http::get(env('URL_SIMRS_LAMA').'/rest/pulang?pulang='.$pulang.'&rawat='.$rawat->id);
        // return $response;
        #cek rawat ruangan 
        // $rawat_ruangan = DB::table('rawat_ruangan')->where('idrawat',$rawat->id)->where('status',1)->count();
        // if($rawat_ruangan > 0){
        //     DB::table('rawat_ruangan')->where('idrawat',$rawat->id)->update([
        //         'tgl_keluar'=>$request->tgl_pulang,
        //         'updated_at'=>now(),
        //     ]);
        // }
        // #update tempat tidur 
        // DB::table('ruangan_bed')->where('id',$rawat->idtempattidur)->update([
        //     'terisi'=>0,
        //     'status'=>0,
        //     'updated_at'=>now(),
        // ]);
        return redirect()->back()->with('berhasil','Data Berhasil Di Simpan');
    }
    public function index_raber()
    {
       
        if (request()->ajax()) {

            $query = DB::table('demo_rawat_bersama')
            ->join('rawat','rawat.id','=','demo_rawat_bersama.idrawat')
            ->join('rawat_bayar','rawat_bayar.id','=','rawat.idbayar')
            ->join('pasien','pasien.no_rm','=','rawat.no_rm')
            ->join('ruangan','ruangan.id','=','rawat.idruangan')
            ->select([
                'demo_rawat_bersama.id',
                'demo_rawat_bersama.id_dokter',
                'rawat.no_rm',
                'pasien.nama_pasien',
                'pasien.usia_tahun',
                'rawat.tglmasuk',
                'ruangan.nama_ruangan',
                'rawat_bayar.bayar'
            ])->where('demo_rawat_bersama.id_dokter', auth()->user()->detail->iddokter);
            return DataTables::of($query)
            ->addColumn('action',function($query){
                return "<a href='".route('detail.rawat-bersama',$query->id)."' class='btn btn-sm btn-info'>Detail</a>";
            })
            ->make(true);

        }
        return view('rawat-inap.index-raber');
    }
    public function index()
    {
       
        if (request()->ajax()) {
            if (auth()->user()->detail->dokter == 1) {
                $query = Rawat::with('pasien', 'bayar')
                    ->where('idjenisrawat', 2)
                    ->where('iddokter', auth()->user()->detail->iddokter)
                    ->where('status', 2);
            } else {
                $query = Rawat::with('pasien', 'bayar' ,'ruangan')
                    ->where('idjenisrawat', 2)
                    ->whereRelation('ruangan','unit_ruangan', auth()->user()->detail->idruangan)
                    ->where('status', 2);
            }

            return DataTables::eloquent($query)
                ->addColumn('dokter', function ($item) {
                    return $item->dokter->nama_dokter;
                })
                ->addColumn('ruangan', function ($item) {
                    $ruangan = DB::table('ruangan')->where('id', $item->idruangan)->first();
                    return $ruangan->nama_ruangan;
                })
                ->addColumn('action', function ($item) {
                    return '
                <a href="' . route('detail.rawat-inap', $item->id) . '" class="btn btn-sm btn-primary">Lihat</a>
                ';
                })
                ->rawColumns(['action', 'terisi', 'ruangan'])
                ->make(true);
        }
        return view('rawat-inap.view');
    }
    public function index_pulang()
    {
       
        if (request()->ajax()) {
            if (auth()->user()->detail->dokter == 1) {
                $query = Rawat::with('pasien', 'bayar')
                    ->where('idjenisrawat', 2)
                    ->where('iddokter', auth()->user()->detail->iddokter)
                    ->where('status', 2);
            } else {
                $query = Rawat::with('pasien', 'bayar' ,'ruangan')
                    ->where('idjenisrawat', 2)
                    ->whereRelation('ruangan','unit_ruangan', auth()->user()->detail->idruangan)
                    ->where('status', 4);
            }

            return DataTables::eloquent($query)
                ->addColumn('dokter', function ($item) {
                    return $item->dokter->nama_dokter;
                })
                ->addColumn('ruangan', function ($item) {
                    $ruangan = DB::table('ruangan')->where('id', $item->idruangan)->first();
                    return $ruangan->nama_ruangan;
                })
                ->addColumn('action', function ($item) {
                    return '
                <a href="' . route('detail.rawat-inap', $item->id) . '" class="btn btn-sm btn-primary">Lihat</a>
                ';
                })
                ->rawColumns(['action', 'terisi', 'ruangan'])
                ->make(true);
        }
        return view('rawat-inap.view');
    }

    #view
    public function view($id)
    {
        return redirect(route('index.rawat-inap'));
        $ruangan = DB::table('ruangan')->where('id', $id)->first();
        if (request()->ajax()) {
            $query = Rawat::with('pasien', 'bayar')->where('idruangan', $id)->where('status', 2);
            return DataTables::eloquent($query)
                ->addColumn('dokter', function ($item) {
                    return $item->dokter->nama_dokter;
                })
                ->addColumn('action', function ($item) {
                    return '
                <a href="' . route('detail.rawat-inap', $item->id) . '" class="btn btn-sm btn-primary">Lihat</a>
                ';
                })
                ->rawColumns(['action', 'terisi'])
                ->make(true);
        }
        return view('rawat-inap.view', [
            'ruangan' => $ruangan
        ]);
    }
    #detail
    public function postPengkajianSubjektif(Request $request, $id){
        $riwayat_mens = new Collection([
            "usia_menarche"=>$request->usia_menarche,
            "lama_haid"=>$request->lama_haid,
            "jumlah_darah_haid"=>$request->jumlah_darah_haid,
            "flour_albus"=>$request->flour_albus,
            "hpht"=>$request->hpht,
            "keluhan_haid"=>$request->keluhan_haid,
            "tp"=>$request->tp,
        ]);
        $riwayat_hamil_ini = new Collection([
            "keluhan_lainnya"=>$request->keluhan_lainnya,
            "keluhan_hamil_tua_lainnya"=>$request->keluhan_hamil_tua_lainnya,
            "gerakan_janin_pertama"=>$request->gerakan_janin_pertama,
            "gerakan_janin_terakhir"=>$request->gerakan_janin_terakhir,
            "penyulit_kehamilan"=>$request->penyulit_kehamilan,
            "obat_jamu_konsumsi"=>$request->obat_jamu_konsumsi,
            "keluhan_bak"=>$request->keluhan_bak,
            "keluhan_bab"=>$request->keluhan_bab,
            "kekhawatiran_khusus"=>$request->kekhawatiran_khusus,
        ]);
        $riwayat_kehamilan = new Collection([
            "gravida"=>$request->g,
            "partus"=>$request->p,
            "abortus"=>$request->a,
            "hidup"=>$request->hidup,
        ]);

        $data = [
            "idrawat"=>$id,
            "keluhan_utama"=>$request->keluhan_utama,
            "riwayat_men"=>$riwayat_mens->toJson(),
            "riwayat_hamil"=>$riwayat_hamil_ini->toJson(),
            "riwayat_kehamilan"=>$riwayat_kehamilan->toJson(),
            "riwayat_penyakit_operasi"=>$request->riwayat_penyakit_operasi,
            "riwayat_penyakit_keluarga"=>$request->riwayat_penyakit_keluarga,
            "status_perkawinan"=>$request->status_perkawinan,
            "riwayat_psikososial_ekonomi"=>$request->riwayat_psikososial_ekonomi,
            "riwayat_dan_rencana_kb"=>$request->riwayat_dan_rencana_kb,
            "riwayat_ginekologi"=>$request->riwayat_ginekologi,
            "pola_makan"=>$request->pola_makan,
        ];

        $cek_pengkajian = DB::table('demo_pengkajian_kebidanan')->where('idrawat',$id)->first();
        if($cek_pengkajian){
            DB::table('demo_pengkajian_kebidanan')->where('idrawat',$id)->update($data);
        }else{
            DB::table('demo_pengkajian_kebidanan')->insert($data);
        }
        return redirect()->route('detail.rawat-inap',$id)->with('berhasil','Data Berhasil Di Simpan');
    }
    public function pengkajian_kebidanan($id)
    {
        $rawat = Rawat::with('pasien', 'bayar')->where('id', $id)->first();
        $pasien = Pasien::where('no_rm', $rawat->no_rm)->first();
        #demo_pengkajian_kebidanan
        $pengkajian = DB::table('demo_pengkajian_kebidanan')->where('idrawat',$id)->first();
        return view('rawat-inap.pengkajian-kebidanan', [
            'rawat' => $rawat
        ], compact('pasien','pengkajian'));
    }

    public function post_diagnosa_akhir(Request $request,$id){
        // return $request->all();
        $cek_diagnosa_akhir = DB::table('demo_ranap_dx')->where('idrawat',$id)->first();
        if($cek_diagnosa_akhir){
            DB::table('demo_ranap_dx')->where('idrawat',$id)->update([
                'icd10'=>json_encode($request->icdx),
                'icd9'=>json_encode($request->icd9),
                'updated_at'=>now(),
            ]);
        }else{
            DB::table('demo_ranap_dx')->insert([
                'idrawat'=>$id,
                'icd10'=>json_encode($request->icdx),
                'icd9'=>json_encode($request->icd9),
                'created_at'=>now(),
                'updated_at'=>now(),
            ]);
        }

        return redirect()->back()->with('berhasil','Data Berhasil Di Simpan');
    }
    public function delete_tindakan($id){
        $tindakan = DB::table('demo_trx_tindakan')->where('id',$id)->first();
        $rawat = Rawat::find($tindakan->idrawat);
        $transaksi = DB::table('transaksi')->where('kode_kunjungan', $rawat->idkunjungan)->first();
        DB::table('transaksi_detail_rinci')->where('idrawat',$rawat->id)->where('idtarif',$tindakan->idtindakan)->where('idtransaksi',$transaksi->id)->delete();
        DB::table('demo_trx_tindakan')->where('id',$id)->delete();
        return redirect()->back()->with('berhasil','Data Berhasil Di Hapus');
    }
    public function post_tindakan(Request $request,$id){
        if(isset($request->id_raber)){
            $raber = $request->id_raber;
        }else{
            $raber = null;
        }
        $rawat = Rawat::find($id);
        $transaksi = DB::table('transaksi')->where('kode_kunjungan', $rawat->idkunjungan)->first();
        foreach($request->tindakan_repeater as $tindakan){
            if($tindakan['dokter'] == null){
                $profesi = 'Perawat';
            }else{
                $profesi = 'Dokter';
            }
            $cek_tindakan = DB::table('demo_trx_tindakan')->where('idrawat',$rawat->id)->where('idtindakan',$tindakan['tindakan'])->first();
            if($cek_tindakan){
                DB::table('transaksi_detail_rinci')->where('idrawat',$rawat->id)->where('idtarif',$tindakan['tindakan'])->where('idtransaksi',$transaksi->id)->delete();

                DB::table('demo_trx_tindakan')->where('idrawat',$rawat->id)->where('idtindakan',$tindakan['tindakan'])->update([
                    'jumlah'=>$cek_tindakan->jumlah + $tindakan['jumlah'],
                    'profesi'=>$profesi,
                    'updated_at'=>now(),
                ]);

               

            }else{
                 #insert demo_trx_tindakan
                DB::table('demo_trx_tindakan')->insert([
                    'idrawat'=>$rawat->id,
                    'idtindakan'=>$tindakan['tindakan'],
                    'iddokter'=>$tindakan['dokter'],
                    'jumlah'=>$tindakan['jumlah'],
                    'profesi'=>$profesi,
                    'created_at'=>now(),
                    'updated_at'=>now(),
                    'id_raber'=>$raber
                ]);
            }
            #insert transaksi_detail_rinci
            $tindakan = DB::table('demo_trx_tindakan')->where('idrawat',$rawat->id)->where('idtindakan',$tindakan['tindakan'])->get();
                
            if (count($tindakan) > 0) {
                foreach ($tindakan as $tk) {
                    $tarif = Tarif::find($tk->idtindakan);
                    for ($x = 1; $x <= $tk->jumlah; $x++) {
                        DB::table('transaksi_detail_rinci')->insert([
                            'idbayar' => $rawat->idbayar,
                            'iddokter' => $tk->iddokter,
                            'idpaket' => 0,
                            'idjenis' => 0,
                            'idrawat' => $rawat->id,
                            'idtransaksi' => $transaksi->id,
                            'idtarif' => $tk->idtindakan,
                            'tarif' => $tarif->tarif,
                            'idtindakan' => $tarif->kat_tindakan,
                            'tgl' => now(),
                        ]); 
                    }
                }
            }           
           
        }

        return redirect()->back()->with('berhasil','Data Berhasil Di Simpan');
    }

    public function post_implementasi(Request $request,$id){
        $rawat = Rawat::find($id);
        DB::table('rawat_implementasi')->insert([
            'tgl'=>date('Y-m-d'),
            'jam'=>$request->jam,
            'implementasi'=>$request->implementasi,
            'no_rm'=>$rawat->no_rm,
            'idrawat'=>$rawat->id,       
            'idpetugas'=>auth()->user()->id,
            'idruangan'=>$rawat->idruangan
        ]);

        return redirect()->back()->with('berhasil','Data Berhasil Di Simpan');
    }

    public function post_cppt(Request $request,$id){
        // return $request->all();
        if(isset($request->id_raber)){
            $raber = $request->id_raber;
        }else{
            $raber = null;
        }
        $rawat = Rawat::find($id);
        DB::table('rawat_cppt')->insert([
            'tgl'=>date('Y-m-d'),
            'jam'=>date('H:i:s'),
            'subjektif'=>$request->subjektif,
            'objektif'=>$request->objektif,
            'asesmen'=>$request->asesmen,
            'plan'=>$request->plan,
            'no_rm'=>$rawat->no_rm,
            'idrawat'=>$rawat->id,            
            'profesi'=>$request->profesi,
            'idpetugas'=>auth()->user()->id,
            'idruangan'=>$rawat->idruangan,
            'id_raber'=>$raber
        ]);

        return redirect()->back()->with('berhasil','Data Berhasil Di Simpan');
    }

    public function hapus_cppt($id){
        $cppt = DB::table('rawat_cppt')->where('id',$id)->delete();
        return response()->json(['code'=>200,'status'=>'berhasil','message'=>'Data Berhasil Di Hapus']);
        // return redirect()->back()->with('berhasil','Data Berhasil Di Hapus');
    }
    public function hapus_implementasi($id){
        $implementasi = DB::table('rawat_implementasi')->where('id',$id)->delete();
        return response()->json(['code'=>200,'status'=>'berhasil','message'=>'Data Berhasil Di Hapus']);
        // return redirect()->back()->with('berhasil','Data Berhasil Di Hapus');
    }
    public function get_implementasi($id){
        $implementasi = DB::table('rawat_implementasi')->where('id',$id)->first();
        return View::make('rawat-inap.menu.edit-implementasi',compact('implementasi'));
    }
    public function get_cppt($id){
       $cppt = DB::table('rawat_cppt')->where('id',$id)->first();
       $profesi = [
            ['value'=>'Dokter','text'=>'Dokter'],
            ['value'=>'Perawat','text'=>'Perawat'],
            ['value'=>'Bidan','text'=>'Bidan'],
            ['value'=>'Farmasi','text'=>'Farmasi'],
            ['value'=>'Gizi','text'=>'Gizi'],

       ];
       return View::make('rawat-inap.menu.edit-cppt',compact('cppt','profesi'));
    }

    public function post_edit_implementasi(Request $request,$id){
        $implementasi = DB::table('rawat_implementasi')->where('id',$id)->update([
            'jam'=>$request->jam,
            'implementasi'=>$request->implementasi,
        ]);
        return redirect()->back()->with('berhasil','Data Berhasil Di Simpan');
    }
    public function post_edit_cppt(Request $request,$id){
        $cppt = DB::table('rawat_cppt')->where('id',$id)->update([
            'subjektif'=>$request->subjektif,
            'objektif'=>$request->objektif,
            'asesmen'=>$request->asesmen,
            'plan'=>$request->plan,
            'profesi'=>$request->profesi
        ]);
        return redirect()->back()->with('berhasil','Data Berhasil Di Simpan');
    }
    public function ringkasan_pulang($id){
        $rawat = Rawat::find($id);
        $ringakasan_pasien_masuk = DB::table('demo_ringkasan_masuk')->where('idrawat', $id)->first();
        $diagnosa_akhir = DB::table('demo_ranap_dx')->where('idrawat',$id)->first();
        $pemeriksaan_penunjang = DB::table('demo_permintaan_penunjang')->where('idrawat',$id)->get();
        $obat = DB::table('demo_antrian_resep')->where('idrawat',$id)->get();
        $anamnesa_pemeriksaan_fisik = DB::table('demo_ranap_awal_pemeriksaan_fisik')->where('idrawat', $id)->first();
        $soap_radiologi = DB::table('soap_radiologi')->whereNotNull('idhasil')->where('idrawat',$id)->get();
        // dd($kelas_rawat);
        if($anamnesa_pemeriksaan_fisik){
            $pemeriksaan_fisik = json_decode($anamnesa_pemeriksaan_fisik->pemeriksaan_fisik);
            $anamnesa = json_decode($anamnesa_pemeriksaan_fisik->anamnesa);
        }else{
            $pemeriksaan_fisik = null;
            $anamnesa = null;
        }
        $pdf = PDF::loadview('rawat-inap.cetak-ringakasan-pulang',compact('rawat','ringakasan_pasien_masuk','diagnosa_akhir','pemeriksaan_penunjang','obat','pemeriksaan_fisik','anamnesa','soap_radiologi'));
        return $pdf->stream();
    }
    public function detail($id)
    {
        $raber = null;
        $rawat = Rawat::where('id', $id)->first();
        if($rawat->status != 2){
            $disable = 'disabled';
        }else{
            $disable = '';
        }
        $poli = Poli::get();
        $pasien = Pasien::where('no_rm', $rawat->no_rm)->first();
        $ringakasan_pasien_masuk = DB::table('demo_ringkasan_masuk')->where('idrawat', $rawat->id)->whereNull('id_raber')->first();
        $data_pulang = DB::table('data_pulang')->get();
        $obat = Obat::with('satuan')->orderBy('obat.nama_obat', 'asc')->get();
        $tindak_lanjut = TindakLanjut::where('idrawat', $rawat->id)->first();
        $radiologi = DB::table('radiologi_tindakan')->get();
        $lab = DB::table('laboratorium_pemeriksaan')->get();
        $dokter = Dokter::get();
        $dokter_dpjp = Dokter::whereNotNull('idspesialis')->where('status',1)->where('id','!=',$rawat->iddokter)->get();
        $tarif = DB::table('tarif')->where('idjenisrawat', 2)->where('idkelas', $rawat->idkelas)->where('idruangan', $rawat->idruangan)->get();
        $fisio_tindakan = DB::table('tarif')->where('idkategori', 8)->get();
        // dd($tarif);
        $order_obat = DB::table('demo_antrian_resep')->where('idrawat', $id)->whereNull('id_raber')->whereNotNull('obat')->get();
        $order_obat_null = DB::table('demo_antrian_resep')->whereNull('obat')->whereNull('id_raber')->where('status_antrian','!=','Batal')->where('idrawat', $id)->get();
        // dd($order_obat);
        $tarif_all =  DB::table('tarif')->get();
        $order_antrian = DB::table('demo_antrian_resep')->where('idrawat', $id)->whereNull('id_raber')->where('status_antrian', 'Antrian')->orderBy('created_at','desc')->get();
        $list_raber = DB::table('demo_rawat_bersama')->leftjoin('dokter','demo_rawat_bersama.id_dokter','=','dokter.id')
        ->select([
            'demo_rawat_bersama.*',
            'dokter.nama_dokter'
        ])->where('demo_rawat_bersama.idrawat',$id)->get();
        if(count($order_antrian) > 0){
            $disable_order = 'disabled';
        }else{
            $disable_order = '';
        }
        // dd($disable_order);
        $skrining = SkriningGizi::where('idrawat', $id)->whereNull('id_raber')->first();
        $data_operasi = LaporanOperasi::where('idrawat', $rawat->id)->whereNull('id_raber')->get();
        $pemberian_obat = DB::table('demo_pemberian_obat_inap')->where('idrawat', $id)->whereNull('id_raber')->get();
        $diagnosa_akhir = DB::table('demo_ranap_dx')->where('idrawat',$rawat->id)->whereNull('id_raber')->first();
        $cppt = DB::table('rawat_cppt')->where('idrawat', $id)->whereNull('id_raber')->get();
        $implamentasi = DB::table('rawat_implementasi')->where('idrawat', $id)->whereNull('id_raber')->get();
        $list_tindakan = DB::table('demo_trx_tindakan')->where('idrawat', $id)->whereNull('id_raber')->get();
        $penunjang = DB::table('demo_permintaan_penunjang')->where('idrawat', $id)->whereNull('id_raber')->get();
        $kesadaran = DB::table('soap_kesadaran')->get();
        $anamnesa_pemeriksaan_fisik = DB::table('demo_ranap_awal_pemeriksaan_fisik')->whereNull('id_raber')->where('idrawat', $id)->first();
        $kelas_rawat = DB::table('ruangan_kelas')->where('ket',1)->get();
        // dd($kelas_rawat);
        if($anamnesa_pemeriksaan_fisik){
            $pemeriksaan_fisik = json_decode($anamnesa_pemeriksaan_fisik->pemeriksaan_fisik);
            $anamnesa = json_decode($anamnesa_pemeriksaan_fisik->anamnesa);
        }else{
            $pemeriksaan_fisik = null;
            $anamnesa = null;
        }
        // dd($pemeriksaan_fisik);
        return view('rawat-inap.detail', [
            'rawat' => $rawat
        ], compact('pasien', 'ringakasan_pasien_masuk', 'obat', 'tindak_lanjut', 'radiologi', 'lab', 'tarif', 'dokter', 'data_operasi','pemberian_obat','order_obat','cppt','implamentasi','list_tindakan','penunjang','diagnosa_akhir','data_pulang','poli','skrining','kesadaran','anamnesa','pemeriksaan_fisik','disable','disable_order','kelas_rawat','order_obat_null','dokter_dpjp','list_raber','anamnesa_pemeriksaan_fisik','fisio_tindakan','tarif_all','raber'));
    }
    public function detail_raber($id)
    {
        $raber = DB::table('demo_rawat_bersama')->leftjoin('dokter','demo_rawat_bersama.id_dokter','=','dokter.id') ->select([
            'demo_rawat_bersama.*',
            'dokter.nama_dokter'
        ])->where('demo_rawat_bersama.id',$id)->first();
        $rawat = Rawat::where('id', $raber->idrawat)->first();
        if($rawat->status != 2){
            $disable = 'disabled';
        }else{
            $disable = '';
        }
        $poli = Poli::get();
        $pasien = Pasien::where('no_rm', $rawat->no_rm)->first();
        $ringakasan_pasien_masuk = DB::table('demo_ringkasan_masuk')->where('idrawat', $rawat->id)->where('id_raber',$id)->first();
        $data_pulang = DB::table('data_pulang')->get();
        $obat = Obat::with('satuan')->orderBy('obat.nama_obat', 'asc')->get();
        $tindak_lanjut = TindakLanjut::where('idrawat', $rawat->id)->first();
        $radiologi = DB::table('radiologi_tindakan')->get();
        $lab = DB::table('laboratorium_pemeriksaan')->get();
        $dokter = Dokter::get();
        $dokter_dpjp = Dokter::whereNotNull('idspesialis')->where('status',1)->where('id','!=',$rawat->iddokter)->get();
        $tarif = DB::table('tarif')->where('idjenisrawat', 2)->where('idkelas', $rawat->idkelas)->where('idruangan', $rawat->idruangan)->get();
        // dd($tarif);
        $order_obat = DB::table('demo_antrian_resep')->where('idrawat', $rawat->id)->where('id_raber',$id)->whereNotNull('obat')->get();
        $order_obat_null = DB::table('demo_antrian_resep')->whereNull('obat')->where('status_antrian','!=','Batal')->where('idrawat', $rawat->id)->where('id_raber',$id)->get();
        // dd($order_obat);
        $order_antrian = DB::table('demo_antrian_resep')->where('idrawat', $rawat->id)->where('id_raber',$id)->where('status_antrian', 'Antrian')->orderBy('created_at','desc')->get();
        // $raber = DB::table('demo_rawat_bersama')->leftjoin('dokter','demo_rawat_bersama.id_dokter','=','dokter.id')
        // ->select([
        //     'demo_rawat_bersama.*',
        //     'dokter.nama_dokter'
        // ])->where('demo_rawat_bersama.idrawat',$id)->get();
        if(count($order_antrian) >0){
            $disable_order = 'disabled';
        }else{
            $disable_order = '';
        }
        // dd($order_obat);
        $skrining = SkriningGizi::where('idrawat', $id)->first();
        $data_operasi = LaporanOperasi::where('idrawat', $rawat->id)->get();
        $pemberian_obat = DB::table('demo_pemberian_obat_inap')->where('idrawat', $rawat->id)->where('id_raber',$id)->get();
        $diagnosa_akhir = DB::table('demo_ranap_dx')->where('idrawat',$rawat->id)->first();
        $cppt = DB::table('rawat_cppt')->where('idrawat', $rawat->id)->where('id_raber',$id)->get();
        $implamentasi = DB::table('rawat_implementasi')->where('idrawat', $rawat->id)->where('id_raber',$id)->get();
        $list_tindakan = DB::table('demo_trx_tindakan')->where('idrawat', $rawat->id)->where('id_raber',$id)->get();
        $penunjang = DB::table('demo_permintaan_penunjang')->where('idrawat', $rawat->id)->where('id_raber',$id)->get();
        $kesadaran = DB::table('soap_kesadaran')->get();
        $anamnesa_pemeriksaan_fisik = DB::table('demo_ranap_awal_pemeriksaan_fisik')->where('idrawat', $rawat->id)->where('id_raber',$id)->first();
        $kelas_rawat = DB::table('ruangan_kelas')->where('ket',1)->get();
        // dd($kelas_rawat);
        if($anamnesa_pemeriksaan_fisik){
            $pemeriksaan_fisik = json_decode($anamnesa_pemeriksaan_fisik->pemeriksaan_fisik);
            $anamnesa = json_decode($anamnesa_pemeriksaan_fisik->anamnesa);
        }else{
            $pemeriksaan_fisik = null;
            $anamnesa = null;
        }
        // dd($pemeriksaan_fisik);
        return view('rawat-inap.detail-raber', [
            'rawat' => $rawat
        ], compact('pasien', 'ringakasan_pasien_masuk', 'obat', 'tindak_lanjut', 'radiologi', 'lab', 'tarif', 'dokter', 'data_operasi','pemberian_obat','order_obat','cppt','implamentasi','list_tindakan','penunjang','diagnosa_akhir','data_pulang','poli','skrining','kesadaran','anamnesa','pemeriksaan_fisik','disable','disable_order','kelas_rawat','order_obat_null','dokter_dpjp','raber'));
    }
    public function get_penunjang($id){
        $penunjang = DB::table('demo_permintaan_penunjang')->where('id', $id)->first();
        if($penunjang->jenis_penunjang == 'Radiologi'){
            $radiologi = DB::table('radiologi_tindakan')->get();
            return View::make('rawat-inap.menu.edit-penunjang-radiologi',compact('penunjang','radiologi'));
        }elseif($penunjang->jenis_penunjang == 'Lab'){
            $lab = DB::table('laboratorium_pemeriksaan')->get();
            return View::make('rawat-inap.menu.edit-penunjang-lab',compact('penunjang','lab'));
        }else{
            $fisio = DB::table('tarif')->where('idkategori', 8)->get();
            return View::make('rawat-inap.menu.edit-penunjang-fisio',compact('penunjang','fisio'));
        }
            
    }

    public function hapus_penunjang($id){
        $penunjang = DB::table('demo_permintaan_penunjang')->where('status_pemeriksaan','Antrian')->where('id', $id)->delete();   
        return response()->json(['code'=>200,'status'=>'berhasil','message'=>'Data Berhasil Di Hapus']);
    }
    public function update_radiologi(Request $request ,$id){
        $penunjang = DB::table('demo_permintaan_penunjang')->where('id', $id)->first();
        DB::table('demo_permintaan_penunjang')->where('status_pemeriksaan','Antrian')->where('id',$id)->update([
            'pemeriksaan_penunjang' => json_encode($request->radiologi),
            'updated_at' => now(),
        ]);
        return redirect()->back()->with('berhasil','Data Berhasil Di Simpan');

    }
    public function update_lab(Request $request ,$id){
        $penunjang = DB::table('demo_permintaan_penunjang')->where('id', $id)->first();
        DB::table('demo_permintaan_penunjang')->where('status_pemeriksaan','Antrian')->where('id',$id)->update([
            'pemeriksaan_penunjang' => json_encode($request->lab),
            'updated_at' => now(),
        ]);
        return redirect()->back()->with('berhasil','Data Berhasil Di Simpan');

    }

    public function postOrderPenunjang(Request $request, $id)
    {

        // return $request->all();
        $rawat = Rawat::where('id', $id)->first();
        if(isset($request->id_raber)){
            $raber = $request->id_raber;
        }else{
            $raber = null;
        }
        if ($request->radiologi) {
            if ($request->radiologi != 'null' || $request->radiologi != '' || $request->radiologi != null) {
                DB::table('demo_permintaan_penunjang')->insert([
                    'idrawat' => $rawat->id,
                    'idbayar' => $rawat->idbayar,
                    'status_pemeriksaan' => 'Antrian',
                    'no_rm' => $rawat->no_rm,
                    'pemeriksaan_penunjang' => json_encode($request->radiologi),
                    'jenis_penunjang' => 'Radiologi',
                    'peminta' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                    'peminta' => auth()->user()->id,
                    'jenis_rawat' => $rawat->idjenisrawat,
                    'id_raber'=>$raber
                ]);
            }
        }
        
        if ($request->lab) {
            if($request->lab != 'null' || $request->lab != ''  || $request->lab != null){
                DB::table('demo_permintaan_penunjang')->insert([
                    'idrawat' => $rawat->id,
                    'idbayar' => $rawat->idbayar,
                    'status_pemeriksaan' => 'Antrian',
                    'no_rm' => $rawat->no_rm,
                    'pemeriksaan_penunjang' => json_encode($request->lab),
                    'jenis_penunjang' => 'Lab',
                    'peminta' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                    'peminta' => auth()->user()->id,
                    'jenis_rawat' => $rawat->idjenisrawat,
                    'id_raber'=>$raber
                ]);
            }
            
        }
        if ($request->fisio) {
            if($request->fisio != 'null' || $request->fisio != '' || $request->fisio != null){
                DB::table('demo_permintaan_penunjang')->insert([
                    'idrawat' => $rawat->id,
                    'idbayar' => $rawat->idbayar,
                    'status_pemeriksaan' => 'Antrian',
                    'no_rm' => $rawat->no_rm,
                    'pemeriksaan_penunjang' => json_encode($request->fisio),
                    'jenis_penunjang' => 'Fisio',
                    'peminta' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                    'peminta' => auth()->user()->id,
                    'jenis_rawat' => $rawat->idjenisrawat,
                    'id_raber'=>$raber
                ]);
            }
            
        }
        return redirect()->back()->with('berhasil', 'Order Penunjang Di Simpan');
    }
    public function orderObat($id){
        $rawat = Rawat::where('id', $id)->first();
        $pasien = Pasien::where('no_rm', $rawat->no_rm)->first();
        $obat = Obat::with('satuan')->orderBy('obat.nama_obat', 'asc')->where('nama_obat','!=','')->get();
        $order_obat = DB::table('demo_antrian_resep')->where('idrawat', $id)->get();
        $resep_antrian = DB::table('demo_antrian_resep')->where('idrawat', $id)->where('status_antrian', 'Antrian')->orderBy('created_at','desc')->first();
        if(!$resep_antrian){
            return redirect(route('detail.rawat-inap',$rawat->id));
        }
        // dd($resep_antrian);
        $resep_dokter = DB::table('demo_resep_dokter')->where('idrawat', $rawat->id)->whereNull('idantrian')->get();
        $resep = ObatTransaksi::where('no_rm', $rawat->no_rm)->get();
        return view('rawat-inap.order-obat', [
            'rawat' => $rawat
        ], compact('obat','order_obat','pasien','resep_antrian','resep_dokter','resep'));
    }
    public function postSelesaiObat(Request $request){
        // return $request->all();
        $rawat = Rawat::where('id', $request->idrawat)->first();
        $resep_dokter = DB::table('demo_resep_dokter')->where('idrawat', $rawat->id)->whereNull('idantrian')->get();
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
                        'dtd'=>'null',
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
            $no_antrian = DB::table('demo_antrian_resep')->whereDate('created_at', Carbon::today())->where('jenis_rawat', $rawat->idjenisrawat)->count();
            $antrian = DB::table('demo_antrian_resep')->where('id',$request->idresep)->update([
                'obat'=>json_encode($racikan),
                'racikan' => json_encode($racikan),
                'obat' => json_encode($non_racik),
                'updated_at'=>now(),
            ]);
            DB::table('demo_resep_dokter')->where('idrawat', $rawat->id)->whereNull('idantrian')->update([
                'idantrian'=>$request->idresep,
            ]);
        }else{
            return redirect(route('view.rawat-inap-order',$rawat->id))->with('gagal', 'Data Resep Tidak Ada');
        }
        return redirect(route('detail.rawat-inap',$rawat->id))->with('berhasil', 'Data Resep Berhasil Di Kirim');
    }
    public function postOrderObat(Request $request, $id)
    {
        // return $request->all();
        $rawat = Rawat::where('id', $id)->first();
        $no_antrian = DB::table('demo_antrian_resep')->whereDate('created_at', Carbon::today())->where('jenis_rawat', $rawat->idjenisrawat)->count();
        if(isset($request->id_raber)){
            $raber = $request->id_raber;
        }else{
            $raber = null;
        }
        $antrian = DB::table('demo_antrian_resep')->insert([
            'idrawat' => $rawat->id,
            'racikan' => 'null',
            'idbayar' => $rawat->idbayar,
            'status_antrian' => 'Antrian',
            'no_rm' => $rawat->no_rm,
            'idrekap' => '',
            'no_antrian' => $no_antrian + 1,
            'obat' => null,
            'jenis_rawat' => $rawat->idjenisrawat,
            'created_at' => now(),
            'updated_at' => now(),
            'id_raber'=>$raber
        ]);
        // $antrian->save();
        // $rekap = new RekapMedis;
        // $rekap->terapi_obat = json_encode($request->terapi_obat);
        // DB::table('demo_antrian_resep')->insert([
        //     'idrawat' => $rawat->id,
        //     'idbayar' => $rawat->idbayar,
        //     'status_antrian' => 'Antrian',
        //     'no_rm' => $rawat->no_rm,
        //     'obat' => json_encode($request->terapi_obat),
        //     'jenis_rawat' => $rawat->idjenisrawat,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
        return redirect(route('view.rawat-inap-order',$rawat->id))->with('berhasil', 'Order Obat Berhasil Di Simpan');
        // return redirect()->back()->with('berhasil', 'Silahkan Inputkan');
    }
    #post pemeriksaan fisik pasien
    public function postPemeriksaanFisik(Request $request, $id)
    {
        // return $request->all();
        $rawat = Rawat::where('id', $id)->first();
        $anamnesa = new Collection([
            'keluhan_utama' => $request->keluhan_utama,
            'rwt_penyakit_sekarang' => $request->rwt_penyakit_sekarang,
            'rwt_penyakit_dulu' => $request->rwt_penyakit_dulu,
            
        ]);
        $pemeriksaan_fisik = new Collection([
            'kesadaran' => $request->kesadaran,
            'rwt_penyakit_dulu' => $request->rwt_penyakit_dulu,
            'tekanan_darah' => $request->tekanan_darah,
            'nadi' => $request->nadi,
            'pernapasan' => $request->pernapasan,
            'suhu' => $request->suhu,
            'status_neurologis' => $request->status_neurologis,
            'keadaan_umum' => $request->keadaan_umum,
            'leher' => $request->leher,
            'kepala' => $request->kepala,
            'paru' => $request->paru,
            'jantung' => $request->jantung,
            'abdomen' => $request->abdomen,
            'kulit' => $request->kulit,
            'extremitas' => $request->extremitas,
        ]);
        $cek_pemeriksaan_fisik = DB::table('demo_ranap_awal_pemeriksaan_fisik')->where('idrawat', $rawat->id)->first();
        if ($cek_pemeriksaan_fisik) {
            DB::table('demo_ranap_awal_pemeriksaan_fisik')->where('idrawat', $rawat->id)->update([
                'anamnesa' => $anamnesa->toJson(),
                'pemeriksaan_fisik' => $pemeriksaan_fisik->toJson(),
                'updated_at' => now(),
            ]);
            return redirect()->back()->with('berhasil', 'Data Berhasil Di Update');
        }else
        if(isset($request->id_raber)){
            $raber = $request->id_raber;
        }else{
            $raber = null;
        }
        DB::table('demo_ranap_awal_pemeriksaan_fisik')->insert([
            'idrawat' => $rawat->id,
            'anamnesa' => $anamnesa->toJson(),
            'pemeriksaan_fisik' => $pemeriksaan_fisik->toJson(),
            'created_at' => now(),
            'updated_at' => now(),
            'id_raber'=>$raber
        ]);

        return redirect()->back()->with('berhasil', 'Data Berhasil Di Disimpan');
    }
    #post ringkasan pasien
    public function postRingkasan(Request $request, $id)
    {
        $rawat = Rawat::where('id', $id)->first();
        // return $request->all();
        $cek_ringakasan = DB::table('demo_ringkasan_masuk')->where('idrawat', $rawat->id)->first();

        if ($cek_ringakasan) {
            DB::table('demo_ringkasan_masuk')->where('idrawat', $rawat->id)->update([
                'penyakit_utama' => $request->penyakit_utama,
                'penyakit_tambahan' => $request->penyakit_tambahan,
                'tindakan' => $request->tindakan,
                'icd10' => json_encode($request->icdx),
                'icd9' => json_encode($request->icd9),
                'icd10_sekunder' => json_encode($request->icdx_sekunder),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return redirect()->back()->with('berhasil', 'Ringkasan Pasien Berhasil Di Update');
        }
        if(isset($request->id_raber)){
            $raber = $request->id_raber;
        }else{
            $raber = null;
        }
        DB::table('demo_ringkasan_masuk')->insert([
            'idrawat' => $rawat->id,
            'penyakit_utama' => $request->penyakit_utama,
            'penyakit_tambahan' => $request->penyakit_utama,
            'tindakan' => $request->penyakit_utama,
            'icd10' => json_encode($request->icdx),
            'icd9' => json_encode($request->icd9),
            'icd10_sekunder' => json_encode($request->icdx_sekunder),
            'created_at' => now(),
            'updated_at' => now(),
            'id_raber'=>$raber
        ]);

        return redirect()->back()->with('berhasil', 'Ringkasan Pasien Berhasil Di Disimpan');
    }
    
    public function raber($id){
        $raber = DB::table('demo_rawat_bersama',$id);
    }
    public function post_raber(Request $request , $id){
        $rawat = Rawat::where('id', $id)->first();
        $cek_raber = DB::table('demo_rawat_bersama')->where('idrawat', $rawat->id)->where('id_dokter',$rawat->id_dokter)->first();
        if($cek_raber){
            return redirect()->back()->with('gagal', 'Data Sudah Ada');
        }else{
            DB::table('demo_rawat_bersama')->insert([
                'idrawat' => $rawat->id,
                'id_dokter' => $request->id_dokter,
                'tgl_mulai'=>now(),
                'status'=>1
            ]);
        }
        return redirect()->back()->with('berhasil', 'Data Berhasil Di Simpan');
    }
    // public function postRingkasanPulang($id){
    //     $rawat = Rawat::where('id', $id)->first();
    //     $ringkasan = DB::table('demo_ringkasan_masuk')->where('idrawat', $rawat->id)->first();
    //     $diagnosa_akhir = DB::table('demo_ranap_dx')->where('idrawat',$rawat->id)->first();
    //     $antrian_resep_selesai = DB::table('demo_antrian_resep')->where('idrawat', $rawat->id)->where('status_antrian','Selesai')->get();
    //     $penunjang = DB::table('demo_permintaan_penunjang')->where('idrawat', $rawat->id)->get();
    //     $ringkasan_pulang = DB::table('rawat_ringkasanpulang')->first();

    // }
}
