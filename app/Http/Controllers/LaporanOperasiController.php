<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Bhp;
use App\Models\Rawat;
use App\Models\Tarif;
use App\Models\Dokter;
use Illuminate\Http\Request;
use App\Models\Pasien\Pasien;
use Illuminate\Support\Carbon;
use App\Models\TemplateAnastesi;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Operasi\LaporanOperasi;
use App\Models\Operasi\CatatanAnestesi;
use App\Models\Template\TemplateOperasi;
use Yajra\DataTables\Facades\DataTables;

class LaporanOperasiController extends Controller
{
    public function index()
    {
        $data = LaporanOperasi::with('rawat','rawat.pasien')->orderBy('tgl_operasi','desc');

        if (request()->ajax()) {

            return DataTables::eloquent($data)
            ->addColumn('opsi', function(LaporanOperasi $data) {
                return '
                    <a href="'. route('edit.operasi', $data->id) .'" class="btn btn-sm btn-success">Detail</a>
                    <a href="'. route('cetak-laporan.operasi', $data->id) .'" class="btn btn-sm btn-info" target="_blank">Print</a>
                ';
            })
            ->addColumn('no_rm', function(LaporanOperasi $data) {
                return $data->rawat->no_rm;
            })
            ->addColumn('tanggal', function (LaporanOperasi $data) {
                return Carbon::parse($data->tgl_operasi)->translatedFormat('l, d F Y');
            })
            ->addColumn('status', function (LaporanOperasi $data) {
                return '<span class="badge badge-secondary">'. $data->status .'</span<';
            })
            ->rawColumns(['opsi','tanggal','status','no_rm'])
            
            ->addIndexColumn()
            ->make();

        }

        return view('operasi.index');
    }

    public function store(Request $request)
    {
        $operasi = new LaporanOperasi;
        if(isset($request->id_raber)){
         $operasi->id_raber = $request->id_raber;   
        }
        $operasi->idrawat = $request->idrawat;
        $operasi->tgl_operasi = $request->tgl_operasi;
        $operasi->diagnosis_prabedah = $request->diagnosis_prabedah;
        $operasi->save();

        return redirect()->back()->with('berhasil', 'Data Berhasil Ditambahkan');
    }

    public function show($id)
    {
        $data = LaporanOperasi::with('rawat','rawat.pasien')->where('id', $id)->first();

        return view('operasi.show', compact('data'));
    }
    public function delete_tindakan_ok($id){
        DB::beginTransaction();
        try {
            $data = DB::table('operasi_tindakan')->where('id',$id)->first();
            $transaksi = DB::table('transaksi')->where('id',$data->idtrx)->first();
            $transaksi_detail = DB::table('transaksi_detail_rinci')->where('idtransaksi',$transaksi->id)->where('idtarif',$data->idtindakan)->where('idrawat',$data->idrawat)->delete();
            $delete = DB::table('operasi_tindakan')->where('id',$id)->delete();
            DB::commit();
            return redirect()->back()->with('berhasil','Data Berhasil Dihapus!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('gagal','Data Gagal Disimpan! '.$e->getMessage());
        }
        
    }
    public function post_tindakan_ok(Request $request,$id){
        // return $request->all();
        $rawat = Rawat::find($id);
        $rawat_kunjungan = DB::table('rawat_kunjungan')->where('idkunjungan',$rawat?->idkunjungan)->first();
        $transaksi = DB::table('transaksi')->where('idkunjungan',$rawat_kunjungan?->id)->first();
        // return $transaksi;
        DB::beginTransaction();
        try {
            foreach($request->asisten as $tindakan){
                $tarif = DB::table('tarif')->where('id',$tindakan['tindakan_bedah'])->first();
                $data = [
                    'idrawat'=>$id,
                    'no_rm'=>$rawat->no_rm,
                    'tgl'=>date('Y-m-d'),
                    'idtindakan'=>$tindakan['tindakan_bedah'],
                    'iddokter'=>$tindakan['dokter_tindakan'],
                    'idtrx'=>$transaksi->id,
                    'idbayar'=>$rawat->idbayar,
                    'keterangan_tindakan'=>$tindakan['keterangan'],
                    'harga_tindakan'=>$tarif->tarif,
                ];
                DB::table('operasi_tindakan')->insert($data);
                DB::table('transaksi_detail_rinci')->insert([
                    'idtransaksi'=>$transaksi->id,
                    'idtarif'=>$tindakan['tindakan_bedah'],
                    'idrawat'=>$id,
                    'tarif'=>$tarif->tarif,
                    'iddokter'=>$tindakan['dokter_tindakan'],
                    'idbayar'=>$rawat->idbayar,
                    'jumlah'=>1,
                    'idpaket'=>0,
                    'tgl'=>date('Y-m-d')
                ]);
            }
            DB::commit();
            return redirect()->back()->with('berhasil','Data Berhasil Disimpan!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('gagal','Data Gagal Disimpan! '.$e->getMessage());
        }
       
    }
    public function bhp($id,$operasi){
        $data = LaporanOperasi::with('rawat','rawat.pasien')->where('id', $operasi)->first();
        $operasi_tindakan = DB::table('operasi_tindakan')->where('id',$id)->first();
        $rawat = Rawat::find($operasi_tindakan->idrawat);
        // $bhp = DB::table('operasi_tindakan_bhp')->where('idoperasi',$operasi_tindakan->id)->get();
        // $list_bhp = DB::table('demo_template_bhp')->get();
        $implan = Bhp::where('jenis','Implan')->get();
        // return count($implan);
        $bhp = Bhp::where('jenis','BHP')->get();
        
        $total_bhp = DB::table('operasi_tindakan_bhp')->where('idoperasi',$operasi_tindakan->id)->where('idtindakan',$operasi_tindakan->idtindakan)->sum('harga');
        // dd($bhp);
        return view('operasi.bhp',compact('operasi_tindakan','rawat','implan','bhp','total_bhp','data'));
    }

    #create fungsi simpan bhp
    public function post_bhp_ok(Request $request,$id){
        // dd($request->all());
        // return $request->all();
        // dd($request->all());
        DB::beginTransaction();

        try {
            $bhp = $request->bhp;
            $implan = $request->implan;
            $operasi_tindakan = DB::table('operasi_tindakan')->where('id',$id)->first();
            if($bhp){
                foreach ($bhp as $b) {                 

                    if($b['jumlah'] != null){
                        $cek_bhp = DB::table('operasi_tindakan_bhp')->where('nama_obat',$b['nama'])->where('idoperasi',$operasi_tindakan->id)->where('idtindakan',$operasi_tindakan->idtindakan)->first();
                        if($cek_bhp){
                            #update
                            $data = [
                                'jumlah'=>$b['jumlah'],
                                'satuan'=>$b['satuan'],
                                'harga'=>$b['harga'] * $b['jumlah'],
                                'nama_obat'=>$b['nama'],
                            ];
                            DB::table('operasi_tindakan_bhp')->where('id',$cek_bhp->id)->update($data);
                        }else{
                            #insert
                            $data = [
                                'idoperasi'=>$operasi_tindakan->id,
                                'idtindakan'=>$operasi_tindakan->idtindakan,
                                'iddokter'=>$operasi_tindakan->iddokter,
                                'nama_obat'=>$b['nama'],
                                'jumlah'=>$b['jumlah'],
                                'satuan'=>$b['satuan'],
                                'harga'=>$b['harga'] * $b['jumlah'],
                                'status'=>1,
                                'tgl'=>date('Y-m-d')
                            ];
                            DB::table('operasi_tindakan_bhp')->insert($data);
                        }
                    }
                }
            }
            if($implan){
                foreach ($implan as $i) {
                    
                    $barang = Bhp::find($i['id']);
                    if(isset($i['jumlah']) && $i['jumlah'] != null){
                        $cek_bhp = DB::table('operasi_tindakan_bhp')->where('nama_obat',$barang->nama_barang)->where('idoperasi',$operasi_tindakan->id)->where('idtindakan',$operasi_tindakan->idtindakan)->first();
                        if($cek_bhp){
                            #update
                            
                            $data = [
                                'jumlah'=>$i['jumlah'],
                                'satuan'=>$barang->satuan,
                                'harga'=>$barang->harga * $i['jumlah'],
                                'nama_obat'=> $barang->nama_barang,
                            ];
                            DB::table('operasi_tindakan_bhp')->where('id',$cek_bhp->id)->update($data);
                        }else{
                            #insert
                            $data = [
                                'idoperasi'=>$operasi_tindakan->id,
                                'idtindakan'=>$operasi_tindakan->idtindakan,
                                'iddokter'=>$operasi_tindakan->iddokter,
                                'nama_obat'=>$barang->nama_barang,
                                'jumlah'=>$i['jumlah'] ,
                                'satuan'=>$barang->satuan,
                                'harga'=>$barang->harga* $i['jumlah'],
                                'status'=>1,
                                'tgl'=>date('Y-m-d')
                            ];
                            DB::table('operasi_tindakan_bhp')->insert($data);
                        }
                    }
                }
            }

            #total_bhp
            $total_bhp = DB::table('operasi_tindakan_bhp')->where('idoperasi',$operasi_tindakan->id)->where('idtindakan',$operasi_tindakan->idtindakan)->sum('harga');
            $update_operasi = [
                'harga_bhp'=>$total_bhp,
                'harga_total'=>$operasi_tindakan->harga_tindakan + $total_bhp,
            ];
            DB::table('operasi_tindakan')->where('id',$operasi_tindakan->id)->update($update_operasi);
            $transaksi_detail = DB::table('transaksi_detail_rinci')->where('idtransaksi',$operasi_tindakan->idtrx)->where('idtarif',$operasi_tindakan->idtindakan)->where('idrawat',$operasi_tindakan->idrawat)->update([
                'tarif'=>$operasi_tindakan->harga_tindakan + $total_bhp
            ]);

            DB::commit();
            return redirect()->back()->with('berhasil','Data Berhasil Disimpan! Total BHP : '.number_format($total_bhp,0,',','.'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('gagal','Data Gagal Disimpan! '.$e->getMessage());
        }
    }

    public function edit($id)
    {
        $data = LaporanOperasi::with('rawat','rawat.pasien')->where('id', $id)->first();
        
        $dokter = Dokter::get();
        $tarif = Tarif::get();
        $tindakan = DB::table('operasi_tindakan')
        ->join('rawat','rawat.id','=','operasi_tindakan.idrawat')
        ->join('dokter','dokter.id','=','operasi_tindakan.iddokter')
        ->select([
            'operasi_tindakan.*',
            'dokter.nama_dokter',
        ])
        ->where('operasi_tindakan.idrawat',$data->idrawat)->get();
        $sign_in = DB::table('demo_checklist_sign_in')->get();
        $sign_out = DB::table('demo_checklist_sign_out')->get();
        $time_out = DB::table('demo_checklist_time_out')->get();
        $catatan = CatatanAnestesi::where('laporan_operasi_id', $id)->first();
        if($catatan == null){
            $catatan = new CatatanAnestesi;
            $catatan->laporan_operasi_id = $id;
            $catatan->save();
        }
        $template = TemplateOperasi::where('status', 1)->get();
        $template_anastesi = TemplateAnastesi::where('status', 1)->get();

        // dd($tindakan);
        return view('operasi.edit', compact('data','dokter','tindakan','tarif','catatan','template','sign_in','sign_out','time_out','template_anastesi'));
    }

    public function update(Request $request, $id)
    {
        // return $request->all();
        $jaringan = new Collection([
            'jaringan_kultur' => $request->jaringan_kultur,
            'macam_jaringan' => ($request->jaringan_kultur == 1) ? $request->macam_jaringan : ''
        ]);
        $time_out  = $request->time_out;
        $sign_in = $request->sign_in;
        $sign_out = $request->sign_out;
        
        $checklist = new Collection([
            'time_out' => $time_out,
            'sign_in' => $sign_in,
            'sign_out' => $sign_out
        ]);
        // return $checklist;
        // return $request->all();
        $data = LaporanOperasi::find($id);
        $data->tgl_operasi = $request->tgl_operasi;
        $data->mulai_jam = $request->mulai_jam;
        $data->selesai_jam = $request->selesai_jam;
        $data->lama_operasi = $request->lama_operasi;
        $data->dokter_bedah = json_encode($request->dokter_bedah);
        $data->perawat_bedah = json_encode($request->perawat_bedah);
        $data->asisten = json_encode($request->asisten);
        $data->diagnosis_prabedah = $request->diagnosis_prabedah;
        $data->jenis_operasi = $request->jenis_operasi;
        $data->diagnosis_pasca_bedah = $request->diagnosis_pasca_bedah;
        $data->tindakan_bedah = json_encode($request->tindakan_bedah);
        $data->ahli_anastesi = json_encode($request->ahli_anastesi);
        $data->obat_anastesi = json_encode($request->obat_anastesi);
        $data->jumlah_pendarahan = $request->jumlah_pendarahan;
        $data->kamar_operasi = $request->kamar_operasi;
        $data->uraian_pembedahan = $request->uraian_pembedahan;
        $data->detail_operasi = $request->detail_operasi;
        $data->penata_anastesi  = json_encode($request->penata_anastesi);
        $data->indikasi_operasi = $request->indikasi_operasi;
        $data->posisi = $request->posisi;
        $data->implant = $request->implant;
        $data->jenis_anastesi = $request->jenis_anastesi;
        $data->jumlah_darah_masuk = $request->jumlah_darah_masuk;
        $data->instruksi_post_operasi = $request->instruksi_post_operasi;
        $data->jaringan = $jaringan;
        $data->komplikasi = $request->komplikasi;
        $data->desinfektan_kulit = $request->desinfektan_kulit;
        $data->checklist = $checklist;
        $data->save();

        if($request->nama_template){
            $template = new TemplateOperasi;

            $template->nama = $request->nama_template;
            $template->dokter_bedah = json_encode($request->dokter_bedah);
            $template->perawat_bedah = json_encode($request->perawat_bedah);
            $template->asisten = json_encode($request->asisten);
            $template->desinfektan_kulit = $request->desinfektan_kulit;
            $template->kamar_operasi = $request->kamar_operasi;
            $template->jenis_operasi = $request->jenis_operasi;
            $template->detail_operasi = $request->detail_operasi;
            $template->diagnosis_pasca_bedah = $request->diagnosis_pasca_bedah;
            $template->tindakan_bedah = json_encode($request->tindakan_bedah);
            $template->jenis_anestesi = $request->jenis_anastesi;
            $template->indikasi_operasi = $request->indikasi_operasi;
            $template->implant = $request->implant;
            $template->uraian_pembedahan = $request->uraian_pembedahan;
            $template->post_operasi = $request->instruksi_post_operasi;

            $template->save();
        }

        return redirect()->route('index.operasi')->with('berhasil','Data Berhasil Disimpan!');
    }

    public function updateStatus(Request $request, $id)
    {
        $data = LaporanOperasi::find($id);
        $data->status = $request->status;
        $data->save();

        return redirect()->route('index.operasi')->with('berhasil','Status Berhasil Disimpan!');
    }

    public function cetakLaporan($id)
    {
        $data = LaporanOperasi::with('rawat','rawat.pasien')->where('id', $id)->first();

        // dd(json_decode($data->dokter_bedah)[0]->dokter_bedah);

        $pdf = PDF::loadview('operasi.cetak.laporan', compact('data'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream();
    }

    public function postAnestesi(Request $request)
    {
        $stadia = new Collection([
            'anestesi' => $request->anestesi,
            'operasi' => $request->operasi,
            'respirasi' => $request->respirasi
        ]);
        $anestesi = [
            'laporan_operasi_id' => $request->laporan_operasi_id,
            'tanggal' => $request->tanggal,
            'status_fisik' => $request->status_fisik,
            'teknik_anestesi' => $request->teknik_anestesis,
            'posisi' => $request->posisi,
            'premedikasi' => $request->premedikasi,
            'pemberian' => $request->pemberian,
            'jam' => $request->jam,
            'efek' => $request->efek,
            'obat_anestesi' => json_encode($request->obat_anestesi_catatan),
            'spo2' => json_encode($request->spo2),
            'nadi' => json_encode($request->nadi),
            'rr' => json_encode($request->rr),
            'o2' => json_encode($request->o2),
            'n2o' => json_encode($request->n2o),
            'isoflurane' => json_encode($request->isoflurane),
            'sevoflurane' => json_encode($request->sevoflurane),
            'infus' => json_encode($request->infus),
            'medikasi' => json_encode($request->medikasi),
            'stadia' => $stadia,
            'jumlah_medikasi' => $request->jumlah_medikasi,
            'jumlah_cairan' => $request->jumlah_cairan,
            'catatan' => $request->catatan,
            'pendarahan' => $request->pendarahan,
            'urine' => $request->urine,
            'lama_anestesi' => $request->lama_anestesi,
            'pra_anestesi' => $request->pra_anestesi,
            'post_anestesi' => $request->post_anestesi
        ];
        $data = CatatanAnestesi::where('laporan_operasi_id', $request->laporan_operasi_id)->first();
        if($request->nama_template){
            $data = new TemplateAnastesi;
            $data->obat_anestesi =  json_encode($request->obat_anestesi_catatan);
            $data->nama = $request->nama_template ;
            $data->teknik_anestesi = $request->teknik_anestesi;
            $data->premedikasi = $request->premedikasi;
            $data->pemberian = $request->pemberian;
            $data->efek = $request->efek;
            $data->stadia = $stadia;
            $data->catatan = $request->catatan;
            $data->lama_anestesi = $request->lama_anestesi;
            $data->pra_anestesi = $request->pra_anestesi;
            $data->post_anestesi = $request->post_anestesi;
            $data->status = 1;
            $data->save();
        }
        if($data){
            CatatanAnestesi::find($data->id)->update($anestesi);

            return redirect()->back()->with('berhasil','Data Berhasil Disimpan!');
        }

        CatatanAnestesi::insert($anestesi);
        return redirect()->back()->with('berhasil','Data Berhasil Disimpan!');
    }

    public function cetakAnestesi($id)
    {
        $data = CatatanAnestesi::find($id);
        $operasi = LaporanOperasi::with('rawat','rawat.pasien')->where('id', $data->laporan_operasi_id)->first();

        $pdf = PDF::loadview('operasi.cetak.anestesi', compact('data','operasi'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream();
    }
}
