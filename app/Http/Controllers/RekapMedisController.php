<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\LabHasil;
use App\Models\Obat\Obat;
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
use App\Models\TindakLanjut;
use Illuminate\Support\Facades\DB;

class RekapMedisController extends Controller
{
    public function selesai_poli(Request $request , $id){
        $rekap_medis = RekapMedis::where('id',$id)->first();
        $detail = DetailRekapMedis::where('idrekapmedis',$rekap_medis->id)->first();
        if($request->jenis == 'perawat'){
            $rekap_medis->perawat = 1;
        }else{
            $rekap_medis->dokter = 1;
            if($detail->terapi_obat != 'null' || $detail->terapi_obat != ''){
                DB::table('demo_antrian_resep')->insert([
                    'idrawat'=>$rekap_medis->idrawat,
                    'idbayar'=>$rekap_medis->rawat->idbayar,
                    'status_antrian'=>'Antrian',
                    'no_rm'=>$rekap_medis->rawat->no_rm,
                    'idrekap'=>$rekap_medis->id,
                    'obat'=>$detail->terapi_obat,
                    'jenis_rawat'=>$rekap_medis->rawat->idjenisrawat,
                    'created_at'=>now(),
                    'updated_at'=>now(),
                ]);
            }

            if($detail->radiologi != 'null' || $detail->radiologi != ''){
                DB::table('demo_permintaan_penunjang')->insert([
                    'idrawat'=>$rekap_medis->idrawat,
                    'idbayar'=>$rekap_medis->rawat->idbayar,
                    'status_pemeriksaan'=>'Antrian',
                    'no_rm'=>$rekap_medis->rawat->no_rm,
                    'pemeriksaan_penunjang'=>$detail->radiologi,
                    'jenis_penunjang'=>'Radiologi',
                    'peminta'=>now(),
                    'created_at'=>now(),
                    'updated_at'=>now(),
                    'peminta'=>auth()->user()->id,
                    'jenis_rawat'=>$rekap_medis->rawat->idjenisrawat,  
                    'idrekap'=>$rekap_medis->id,                  
                ]);
            }
            if($detail->laborat != 'null' || $detail->laborat != ''){
                DB::table('demo_permintaan_penunjang')->insert([
                    'idrawat'=>$rekap_medis->idrawat,
                    'idbayar'=>$rekap_medis->rawat->idbayar,
                    'status_pemeriksaan'=>'Antrian',
                    'no_rm'=>$rekap_medis->rawat->no_rm,
                    'pemeriksaan_penunjang'=>$detail->laborat,
                    'jenis_penunjang'=>'Lab',
                    'peminta'=>now(),
                    'created_at'=>now(),
                    'updated_at'=>now(),
                    'peminta'=>auth()->user()->id,
                    'jenis_rawat'=>$rekap_medis->rawat->idjenisrawat,  
                    'idrekap'=>$rekap_medis->id,                  
                ]);
            }
            if($detail->fisio != 'null' || $detail->fisio != ''){
                DB::table('demo_permintaan_penunjang')->insert([
                    'idrawat'=>$rekap_medis->idrawat,
                    'idbayar'=>$rekap_medis->rawat->idbayar,
                    'status_pemeriksaan'=>'Antrian',
                    'no_rm'=>$rekap_medis->rawat->no_rm,
                    'pemeriksaan_penunjang'=>$detail->fisio,
                    'jenis_penunjang'=>'Fisio',
                    'peminta'=>now(),
                    'created_at'=>now(),
                    'updated_at'=>now(),
                    'peminta'=>auth()->user()->id,
                    'jenis_rawat'=>$rekap_medis->rawat->idjenisrawat,  
                    'idrekap'=>$rekap_medis->id,                  
                ]);
            }
        }

        $rekap_medis->save();
        
        if($rekap_medis->perawat == 1 && $rekap_medis->dokter == 1){
            $rawat = Rawat::find($rekap_medis->idrawat);
            $rawat->status = 4;
            $rawat->save();
        }
        return redirect()->back()->with('berhasil','Pasien Selesai Diperiksa');
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
            $rekap = RekapMedis::with('kategori')->where('idpasien', $pasien->id);

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
        $obat = Obat::with('satuan')->orderBy('obat.nama_obat', 'asc')->get();
        $tindak_lanjut = TindakLanjut::where('idrawat', $id_rawat)->first();
        $radiologi = DB::table('radiologi_tindakan')->get();
        $lab = DB::table('laboratorium_pemeriksaan')->get();
        $fisio = DB::table('tarif')->where('idkategori',8)->get();
        $dokter = Dokter::get();
        $tarif = DB::table('tarif')->whereNull('idjenisrawat')->orWhere('idjenisrawat', $rawat->id_jenis_rawat)->whereNull('idpoli')->orWhereIn('idpoli', [auth()->user()->detail->idpoli])->get();
        $soap_tindakan = SoapRajalTindakan::where('idrawat', $id_rawat)->get();

        $pemeriksaan_lab = LabHasil::where('idrawat', $id_rawat)->get();
        $pemeriksaan_radiologi = RadiologiHasil::where('idrawat', $id_rawat)->get();

        return view('rekap-medis.poliklinik', compact('pasien', 'rawat', 'resume_medis', 'resume_detail', 'obat', 'tindak_lanjut', 'radiologi', 'lab', 'tarif', 'dokter', 'soap_tindakan','fisio','pemeriksaan_lab','pemeriksaan_radiologi'));
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

    public function input_resume_poli(Request $request)
    {
        $rawat = Rawat::find($request->idrawat);
        $rawat->status = 3;
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
        $obat = Obat::with('satuan')->where('nama_obat','!=','')->orderBy('obat.nama_obat', 'asc')->get();

        $kategori = Kategori::find($data->idkategori);
        $kategori_diagnosa = DB::table('kategori_diagnosa')->get();
        $radiologi = DB::table('radiologi_tindakan')->get();
        $lab = DB::table('laboratorium_pemeriksaan')->get();
        $fisio = DB::table('tarif')->where('idkategori', 8)->get();
        return view('detail-rekap-medis.create', compact('pasien', 'kategori', 'data', 'obat', 'kategori_diagnosa', 'radiologi', 'lab','rawat','triase','fisio'));

        // return redirect(route('detail-rekap-medis-show',$detail_resume->id))->with('berhasil','Data Resume Berhasil Ditambahkan');
    }

    public function input_tindakan(Request $request, $id)
    {
        $rawat = RekapMedis::where('idrawat',$id)->first();
        $rawat->tindakan = json_encode($request->tindakan_repeater);
        $rawat->save();
        return redirect()->back()->with('berhasil', 'Data Tindakan Berhasil Ditambahkan');


        // $transakai = DB::table('transaksi')->where('kode_kunjungan', $rawat->idkunjungan)->first();
        // if ($transakai) {
        //     if ($request->tindakan_repeater) {
        //         foreach ($request->tindakan_repeater as $tindakan) {
        //             for ($x = 1; $x <= $tindakan['jumlah']; $x++) {
        //                 $soap = DB::table('soap_rajaltindakan')->insert([
        //                     'idrawat' => $rawat->id,
        //                     'idkunjungan' => $rawat->idkunjungan,
        //                     'idtindakan' => $tindakan['tindakan'],
        //                     'no_rm' => $rawat->no_rm,
        //                     'tgltindakan' => date('Y-m-d'),
        //                     'iddokter' => $tindakan['dokter'],
        //                     'idbayar' => $rawat->idbayar
        //                 ]);
        //                 if ($soap) {
        //                     $tarif = DB::table('tarif')->where('id', $tindakan['tindakan'])->first();
        //                     $tarif_trx = DB::table('transaksi_detail_rinci')->insert([
        //                         'idjenis' => 0,
        //                         'idrawat' => $rawat->id,
        //                         'idtransaksi' => $transakai->id,
        //                         'idtarif' => $tarif->id,
        //                         'tarif' => $tarif->tarif,
        //                         'idtindakan' => $tarif->kat_tindakan,
        //                         'tgl' => now(),
        //                         'iddokter' => $tindakan['dokter'],
        //                         'idbayar' => $rawat->idbayar,
        //                         'idpaket' => $tarif->paket == 1 ? '1' : '0'
        //                     ]);
        //                 }
        //             }
                    
        //         }
        //     }
        // }
        
    }
}
