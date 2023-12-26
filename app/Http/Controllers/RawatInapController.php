<?php

namespace App\Http\Controllers;

use App\Models\Rawat;
use App\Models\Dokter;
use App\Models\Obat\Obat;
use App\Models\TindakLanjut;
use Illuminate\Http\Request;
use App\Models\Pasien\Pasien;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Operasi\LaporanOperasi;

class RawatInapController extends Controller
{
    public function index()
    {
        // if(request()->ajax())
        // {
        //     $query = DB::table('ruangan')
        //     ->select('ruangan.*','ruangan_kelas.id as id_kelas','ruangan_kelas.kelas as nama_kelas')
        //     ->leftJoin('ruangan_kelas','ruangan_kelas.id','=','ruangan.idkelas')
        //     ->where('status',1)
        //     ->where('jenis',2)
        //     ->orderBy('id_kelas','asc');
        //     return DataTables::query($query)
        //     ->addColumn('terisi', function($item){
        //         $rawat_bed = DB::table('ruangan_bed')->where('idruangan',$item->id)->where('status',1)->where('terisi',1)->count();
        //         return $rawat_bed;
        //     })
        //     ->addColumn('action', function($item){
        //         return '
        //         <a href="'.route('view.rawat-inap', $item->id).'" class="btn btn-sm btn-primary">Lihat Bed</a>
        //         ';
        //     })
        //     ->rawColumns(['action','terisi'])->make(true);
        // }
        // return view('rawat-inap.index');
        if (request()->ajax()) {
            if (auth()->user()->detail->dokter == 1) {
                $query = Rawat::with('pasien', 'bayar')
                    ->where('idjenisrawat', 2)
                    ->where('iddokter', auth()->user()->detail->iddokter)
                    ->where('status', 2);
            } else {
                $query = Rawat::with('pasien', 'bayar')
                    ->where('idjenisrawat', 2)
                    ->where('idruangan', auth()->user()->detail->idruangan)
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
    public function pengkajian_kebidanan($id)
    {
        $rawat = Rawat::with('pasien', 'bayar')->where('id', $id)->first();
        $pasien = Pasien::where('no_rm', $rawat->no_rm)->first();
        return view('rawat-inap.pengkajian-kebidanan', [
            'rawat' => $rawat
        ], compact('pasien'));
    }
    public function detail($id)
    {
        $rawat = Rawat::with('pasien', 'bayar')->where('id', $id)->first();
        $pasien = Pasien::where('no_rm', $rawat->no_rm)->first();
        $ringakasan_pasien_masuk = DB::table('demo_ringkasan_masuk')->where('idrawat', $rawat->id)->first();

        $obat = Obat::with('satuan')->where('obat.idjenis', 1)->orderBy('obat.nama_obat', 'asc')->get();
        $tindak_lanjut = TindakLanjut::where('idrawat', $rawat->idrawat)->first();
        $radiologi = DB::table('radiologi_tindakan')->get();
        $lab = DB::table('laboratorium_pemeriksaan')->get();
        $dokter = Dokter::get();
        $tarif = DB::table('tarif')->whereNull('idjenisrawat')->orWhere('idjenisrawat', $rawat->id_jenis_rawat)->whereNull('idpoli')->orWhereIn('idkelas', [$rawat->idkelas])->get();

        $data_operasi = LaporanOperasi::where('idrawat', $rawat->id)->get();

        return view('rawat-inap.detail', [
            'rawat' => $rawat
        ], compact('pasien', 'ringakasan_pasien_masuk', 'obat', 'tindak_lanjut', 'radiologi', 'lab', 'tarif', 'dokter', 'data_operasi'));
    }
    public function postOrderPenunjang(Request $request, $id)
    {

        $rawat = Rawat::where('id', $id)->first();
        if ($request->radiologi != 'null' || $request->radiologi != '') {
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

            ]);
        }
        if ($request->lab != 'null' || $request->lab != '') {
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

            ]);
        }
        return redirect()->back()->with('berhasil', 'Order Penunjang Di Simpan');
    }
    public function postOrderObat(Request $request, $id)
    {
        // return $request->all();
        $rawat = Rawat::where('id', $id)->first();
        // $rekap->terapi_obat = json_encode($request->terapi_obat);
        DB::table('demo_antrian_resep')->insert([
            'idrawat' => $rawat->id,
            'idbayar' => $rawat->idbayar,
            'status_antrian' => 'Antrian',
            'no_rm' => $rawat->no_rm,
            'obat' => json_encode($request->terapi_obat),
            'jenis_rawat' => $rawat->idjenisrawat,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('berhasil', 'Order Obat Berhasil Di Simpan');
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
            'keadaan_umum' => $request->keadaan_umum,
            'kepala' => $request->kepala,
            'paru' => $request->paru,
            'jantung' => $request->jantung,
            'abdomen' => $request->abdomen,
            'kulit' => $request->kulit,
            'extremitas' => $request->extremitas,
        ]);

        DB::table('demo_ranap_awal_pemeriksaan_fisik')->insert([
            'idrawat' => $rawat->id,
            'anamnesa' => $anamnesa->toJson(),
            'pemeriksaan_fisik' => $pemeriksaan_fisik->toJson(),
            'created_at' => now(),
            'updated_at' => now(),
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
        ]);

        return redirect()->back()->with('berhasil', 'Ringkasan Pasien Berhasil Di Disimpan');
    }
}
