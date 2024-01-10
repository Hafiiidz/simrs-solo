<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;
use App\Models\RekapMedis\RekapMedis;
use App\Models\RekapMedis\DetailRekapMedis;
use App\Models\RekapMedis\Kategori;
use App\Models\Pasien\Pasien;
use App\Models\Obat\Obat;
use App\Models\Rawat;
use App\Models\TindakLanjut;
use Illuminate\Support\Facades\DB;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Svg\Tag\Rect;

class DetailRekapMedisController extends Controller
{
    public function post_sbar(Request $request,$id){
        $cek_sbar = DB::table('demo_sbar')->where('idrawat',$id)->first();
        if($cek_sbar){
            $sbar = DB::table('demo_sbar')->where('idrawat',$id)->update([
                'situation' => $request->situation,
                'background' => $request->background,
                'assesmen' => $request->assesment,
                'rekomendation' => $request->recomendation,
                'intruksi' => $request->intruksi,
                'updated_at'=>now(),
            ]);
        }else{
            DB::table('demo_sbar')->insert([
                'situation' => $request->situation,
                'background' => $request->background,
                'assesmen' => $request->assesment,
                'rekomendation' => $request->recomendation,
                'intruksi' => $request->intruksi,
                'updated_at'=>now(),
                'idrawat'=>$id
            ]);

        }
        return redirect()->route('rekam-medis-poli', $id)->with('berhasil', 'Data Rekam Medis Pasien Berhasil Di Simpan!');
    }
    public function index($id_rekapmedis)
    {
        $data = RekapMedis::find($id_rekapmedis);
        $pasien = Pasien::with('alamat')->find($data->idpasien);
        $kategori = Kategori::find($data->idkategori);

        if (request()->ajax()) {
            $detail = DetailRekapMedis::with('rekapMedis.kategori')->where('idrekapmedis', $id_rekapmedis);

            return DataTables::of($detail)
                ->addColumn('kategori', function (DetailRekapMedis $detail) {
                    return $detail->rekapMedis->kategori->nama;
                })
                ->addColumn('tanggal', function (DetailRekapMedis $detail) {
                    return Carbon::parse($detail->created_at)->translatedFormat('l, d F Y');
                })
                ->addColumn('opsi', function (DetailRekapMedis $detail) {
                    $html = '';
                    $html .= '<a href="' . route('detail-rekap-medis-show', $detail->id) . '" class="btn btn-sm btn-success">Detail</a>';
                    $html .= '&nbsp;&nbsp;<a href="' . route('detail-rekap-medis-cetak', $detail->id) . '" class="btn btn-sm btn-danger" target="_blank">PDF</a>';
                    return $html;
                })
                ->rawColumns(['kategori', 'tanggal', 'opsi'])
                ->addIndexColumn()
                ->make();
        }

        return view('detail-rekap-medis.index', compact('pasien', 'kategori', 'id_rekapmedis', 'data'));
    }

    public function create(Request $request)
    {
        $data = RekapMedis::find($request->id_rekapmedis);
        $pasien = Pasien::with('alamat')->find($data->idpasien);
        $kategori = Kategori::find($data->idkategori);
        $obat = Obat::with('satuan')->where('nama_obat', '!=', '')->orderBy('obat.nama_obat', 'asc')->get();
       
        // return view('detail-rekap-medis.create', compact('pasien', 'kategori', 'data', 'obat'));
    }

    
    public function store(Request $request, $id_rekapmedis)
    {

        // return $request->all();
        $alergi = new Collection([
            'value_obat' => $request->value_obat,
            'value_makanan' => $request->value_makanan,
            'value_lain' => $request->value_lain,
        ]);

        $pemeriksaan_fisik = new Collection([
            'tekanan_darah' => $request->tekanan_darah,
            'nadi' => $request->nadi,
            'pernapasan' => $request->pernapasan,
            'suhu' => $request->suhu,
            'berat_badan' => $request->berat_badan,
            'tinggi_badan' => $request->tinggi_badan,
            'bmi' => $request->bmi,
            'spo2' => $request->spo2,
        ]);

        $riwayat_kesehatan = new Collection([
            'riwayat_1' => $request->riwayat_1,
            'riwayat_2' => $request->riwayat_2,
            'riwayat_3' => $request->riwayat_3,
            'riwayat_4' => $request->riwayat_4,
            'value_riwayat_1' => $request->value_riwayat_1,
            'value_riwayat_2' => $request->value_riwayat_2,
            'value_riwayat_3' => $request->value_riwayat_3,
            'value_riwayat_4' => $request->value_riwayat_4,
        ]);



        $rekap_medis = RekapMedis::find($id_rekapmedis);
        $rekap = new DetailRekapMedis;
        $rawat = Rawat::find($rekap_medis->idrawat);
        if($rawat->idpoli == 12){
            $pemeriksaan_fisio = new Collection([
                'pemeriksaan_fisik' => $request->pemeriksaan_fisik,
                'pemeriksaan_uji_fungsi' => $request->pemeriksaan_uji_fungsi,
                'tata_laksana' => $request->tata_laksana,
                'anjuran' => $request->anjuran,
                'evaluasi' => $request->evaluasi,
            ]);
            $rekap->pemeriksaan_fisio = $pemeriksaan_fisio->toJson();
        }

        
        $rekap->triase = $request->triase;
        $rekap->idrekapmedis = $id_rekapmedis;
        $rekap->diagnosa = $request->diagnosa;
        $rekap->anamnesa = $request->anamnesa;
        $rekap->pemeriksaan_fisik_dokter = $request->pemeriksaan_fisik;
        $rekap->anamnesa_dokter = $request->anamnesa_dokter;
        $rekap->obat_yang_dikonsumsi = $request->obat_yang_dikonsumsi;
        $rekap->alergi = $alergi->toJson();
        $rekap->pasien_sedang = $request->pasien_sedang;
        $rekap->pemeriksaan_fisik = $pemeriksaan_fisik->toJson();
        $rekap->riwayat_kesehatan = $riwayat_kesehatan->toJson();
        $rekap->rencana_pemeriksaan = $request->rencana_pemeriksaan;
        $rekap->terapi_obat = json_encode($request->terapi_obat);
        $rekap->radiologi = json_encode($request->radiologi);
        $rekap->laborat = json_encode($request->lab);
        $rekap->fisio = json_encode($request->fisio);
        $rekap->icdx = json_encode($request->icdx);
        $rekap->prosedur = $request->tindakan_prc;
        $rekap->icd9 = json_encode($request->icd9);
        $rekap->kategori_penyakit = $request->kategori_penyakit;
        $rekap->terapi = $request->terapi;
        $rekap->idrawat = $rekap_medis->idrawat;
        $rekap->save();

        return redirect()->route('rekam-medis-poli', $rekap_medis->idrawat)->with('berhasil', 'Data Rekam Medis Pasien Berhasil Di Simpan!');
    }

    public function show($id)
    {
        $rekap = DetailRekapMedis::with('rekapMedis.pasien', 'rekapMedis.pasien.alamat', 'rekapMedis.kategori')->find($id);
        $alergi = json_decode($rekap->alergi);
        $pfisik = json_decode($rekap->pemeriksaan_fisik);
        $rkesehatan = json_decode($rekap->riwayat_kesehatan);
        $pemeriksaan_fisio  = json_decode($rekap->pemeriksaan_fisio);
        $obat = Obat::with('satuan')->where('nama_obat', '!=', '')->orderBy('obat.nama_obat', 'asc')->get();
        $kategori_diagnosa = DB::table('kategori_diagnosa')->get();
        $radiologi = DB::table('radiologi_tindakan')->get();
        $lab = DB::table('laboratorium_pemeriksaan')->get();
        $fisio = DB::table('tarif')->where('idkategori',8)->get();
        $rawat = Rawat::find($rekap->idrawat);
        // dd($lab);
        return view('detail-rekap-medis.show', compact('rekap', 'alergi', 'pfisik', 'rkesehatan', 'obat', 'kategori_diagnosa', 'radiologi', 'lab', 'fisio','rawat','pemeriksaan_fisio'));
    }

    public function update(Request $request, $id)
    {
        // return $request->all();


        $rekap = DetailRekapMedis::find($id);
        $rawat = Rawat::find($rekap->idrawat);
        if (auth()->user()->idpriv == 7) {
            $rekap->diagnosa = $request->diagnosa;
            $rekap->anamnesa_dokter = $request->anamnesa_dokter;
            $rekap->pemeriksaan_fisik_dokter = $request->pemeriksaan_fisik;
            $rekap->rencana_pemeriksaan = $request->rencana_pemeriksaan;
            if ($request->terapi_obat) {
                $rekap->terapi_obat = json_encode($request->terapi_obat);
            } else {
                $rekap->terapi_obat = 'null';
            }
            if ($request->radiologi) {
                $rekap->radiologi = json_encode($request->radiologi);
            } else {
                $rekap->radiologi = 'null';
            }
            if ($request->lab) {
                $rekap->laborat = json_encode($request->lab);
            } else {
                $rekap->laborat = 'null';
            }
            // if ($request->icdx) {
            //     $rekap->icdx = json_encode($request->icdx);
            // } else {
            //     $rekap->icdx = 'null';
            // }
            // if ($request->icd9) {
            //     $rekap->icd9 = json_encode($request->icd9);
            // } else {
            //     $rekap->icd9 = 'null';
            // }
            if ($request->fisio) {
                $rekap->fisio = json_encode($request->fisio);
            } else {
                $rekap->fisio = 'null';
            }
            $rekap->terapi = $request->terapi;
            $rekap->prosedur = $request->tindakan_prc;
            if($rawat->idpoli == 12){
                $pemeriksaan_fisio = new Collection([
                    'pemeriksaan_fisik' => $request->pemeriksaan_fisik,
                    'pemeriksaan_uji_fungsi' => $request->pemeriksaan_uji_fungsi,
                    'tata_laksana' => $request->tata_laksana,
                    'anjuran' => $request->anjuran,
                    'evaluasi' => $request->evaluasi,
                ]);
                $rekap->pemeriksaan_fisio = $pemeriksaan_fisio->toJson();
            }
        } elseif (auth()->user()->idpriv == 14 || auth()->user()->idpriv == 18 || auth()->user()->idpriv == 29) {
            $rekap->anamnesa = $request->anamnesa;
            $alergi = new Collection([
                'value_obat' => $request->value_obat,
                'value_makanan' => $request->value_makanan,
                'value_lain' => $request->value_lain,
            ]);

            $pemeriksaan_fisik = new Collection([
                'tekanan_darah' => $request->tekanan_darah,
                'nadi' => $request->nadi,
                'pernapasan' => $request->pernapasan,
                'suhu' => $request->suhu,
                'berat_badan' => $request->berat_badan,
                'tinggi_badan' => $request->tinggi_badan,
                'bmi' => $request->bmi,
                'spo2' => $request->spo2,
            ]);

            $riwayat_kesehatan = new Collection([
                'riwayat_1' => $request->riwayat_1,
                'riwayat_2' => $request->riwayat_2,
                'riwayat_3' => $request->riwayat_3,
                'riwayat_4' => $request->riwayat_4,
                'value_riwayat_1' => $request->value_riwayat_1,
                'value_riwayat_2' => $request->value_riwayat_2,
                'value_riwayat_3' => $request->value_riwayat_3,
                'value_riwayat_4' => $request->value_riwayat_4,
            ]);



            $rekap->obat_yang_dikonsumsi = $request->obat_yang_dikonsumsi;
            $rekap->alergi = $alergi->toJson();
            $rekap->pasien_sedang = $request->pasien_sedang;
            $rekap->pemeriksaan_fisik = $pemeriksaan_fisik->toJson();
            $rekap->riwayat_kesehatan = $riwayat_kesehatan->toJson();
        }else{
            $rekap->diagnosa = $request->diagnosa;
            if ($request->icdx) {
                $rekap->icdx = json_encode($request->icdx);
            } else {
                $rekap->icdx = 'null';
            }
            if ($request->icd9) {
                $rekap->icd9 = json_encode($request->icd9);
            } else {
                $rekap->icd9 = 'null';
            }
        }

        $rekap->save();

        return redirect()->route('rekam-medis-poli', $rekap->idrawat)->with('berhasil', 'Data Rekam Medis Pasien Berhasil Di Simpan!');
    }

    public function cetak($id)
    {

        $data = DetailRekapMedis::with('rekapMedis', 'rekapMedis.kategori', 'rekapMedis.pasien')->find($id);
        $rawat = Rawat::find($data->idrawat);
        $alergi = json_decode($data->alergi);
        $pfisik = json_decode($data->pemeriksaan_fisik);
        $rkesehatan = json_decode($data->riwayat_kesehatan);
        $obat = Obat::with('satuan')->where('obat.idjenis', 1)->orderBy('obat.nama_obat', 'asc')->get();
        $tindak_lanjut = TindakLanjut::where('idrawat', $rawat->id)->first();
        $qr = QrCode::size(150)
        ->backgroundColor(255, 255, 255)
        ->color(0, 0, 0)
        ->margin(1)
        ->generate(
            '"'.$rawat->dokter->nama_dokter.'"',
        );
        // return $qr;
        $pdf = PDF::loadview('detail-rekap-medis.cetak', compact('data', 'alergi', 'pfisik', 'rkesehatan', 'obat', 'rawat', 'tindak_lanjut', 'qr'));
        return $pdf->stream();
        // return $pdf->download('rekap-medis.pdf');
        // return view('detail-rekap-medis.cetak');
    }
    public function cetak_resep($id)
    {

        $data = DetailRekapMedis::with('rekapMedis', 'rekapMedis.kategori', 'rekapMedis.pasien')->find($id);
        $rawat = Rawat::find($data->idrawat);
        $alergi = json_decode($data->alergi);
        $pfisik = json_decode($data->pemeriksaan_fisik);
        $rkesehatan = json_decode($data->riwayat_kesehatan);
        $obat = Obat::with('satuan')->where('obat.idjenis', 1)->orderBy('obat.nama_obat', 'asc')->get();
        $qr = QrCode::size(150)
        ->backgroundColor(255, 255, 255)
        ->color(0, 0, 0)
        ->margin(1)
        ->generate(
            '"'.$rawat->dokter->nama_dokter.'"',
        );
        $pdf = PDF::loadview('detail-rekap-medis.cetak-resep', compact('data', 'alergi', 'pfisik', 'rkesehatan', 'obat', 'rawat', 'qr'));
        return $pdf->stream();
        // return $pdf->download('rekap-medis.pdf');
        // return view('detail-rekap-medis.cetak');
    }

    
}
