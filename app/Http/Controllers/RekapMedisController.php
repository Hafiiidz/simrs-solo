<?php

namespace App\Http\Controllers;

use App\Helpers\VclaimHelper;
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
use App\Models\Tarif;
use App\Models\TindakLanjut;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Termwind\Components\Raw;

class RekapMedisController extends Controller
{
    public function get_hasil_lab($id)
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
        // return $transaksi;
        // return $rekap_medis;
        $detail = DetailRekapMedis::where('idrekapmedis', $rekap_medis->id)->first();



        if ($request->jenis == 'perawat') {
            $rekap_medis->perawat = 1;
        }elseif($request->jenis == 'bpjs'){
            $rekap_medis->bpjs = 1;
        } else {
            $rekap_medis->dokter = 1;
            $resep_dokter = DB::table('demo_resep_dokter')->where('idrawat', $rawat->id)->get();
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
                            'diminum'=>$rd->diminum,
                            'catatan'=>$rd->catatan,
                            'idresep'=>$rd->id
                        ];
                    }else{
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
                
                $no_antrian = DB::table('demo_antrian_resep')->whereDate('created_at', Carbon::today())->where('jenis_rawat', $rekap_medis->idrawat)->count();
                DB::table('demo_antrian_resep')->insert([
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
            }

            if ($detail->laborat != null || $detail->radiologi != 'null' || $detail->radiologi != '') {
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
            if ($detail->laborat != null || $detail->laborat != 'null' || $detail->laborat != '') {
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

        $rekap_medis->save();

        if ($rekap_medis->perawat == 1 && $rekap_medis->dokter == 1) {
            $rawat = Rawat::find($rekap_medis->idrawat);
            $rawat->status = 4;
            $rawat->save();
            if ($rekap_medis->tindakan != NULL || $rekap_medis->tindakan != 'null') {
                $jumlah = 0;
                // return $rekap_medis->tindakan;
                foreach (json_decode($rekap_medis->tindakan) as $tindakan) {
                    // $jumlah += 2;
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
                    }
                }
                // return $jumlah;
            }
        }
        return redirect()->back()->with('berhasil', 'Pasien Selesai Diperiksa');
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
        $dokter = Dokter::get();
        $tarif = DB::table('tarif')->whereNull('idjenisrawat')->orWhere('idjenisrawat', $rawat->id_jenis_rawat)->whereNull('idpoli')->orWhereIn('idpoli', [auth()->user()->detail->idpoli])->get();
        $soap_tindakan = SoapRajalTindakan::where('idrawat', $id_rawat)->get();
        $resep_dokter = DB::table('demo_resep_dokter')->where('idrawat', $id_rawat)->get();
        $pemeriksaan_lab = LabHasil::where('idrawat', $id_rawat)->get();
        $pemeriksaan_radiologi = RadiologiHasil::where('idrawat', $id_rawat)->get();
        $pemeriksaan_luar = DB::table('demo_rekap_medis_file_penunjang')->where('id_rekap', $id_rawat)->get();
        $riwayat_berobat = RekapMedis::where('idpasien', $pasien->id)->where('idrawat', '!=', $id_rawat)->get();
        // dd($riwayat_berobat);
        return view('rekap-medis.poliklinik', compact('pasien', 'rawat', 'resume_medis', 'resume_detail', 'obat', 'tindak_lanjut', 'radiologi', 'lab', 'tarif', 'dokter', 'soap_tindakan', 'fisio', 'pemeriksaan_lab', 'pemeriksaan_radiologi', 'riwayat_berobat', 'pemeriksaan_luar', 'resep_dokter'));
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
        // return $request->all();
        // $mergedArray = array_merge(json_encode($request->obat), json_encode($request->jumlah_obat,true));
        // return $mergedArray;

        $nama_obat = new Collection([
            'obat'=>$request->obat,
            'jumlah'=>$request->jumlah_obat
        ]);
        // return $nama_obat->toJson();

        // $nama_obat = new Collection([
        //     'nama_obat1'=>$this->get_nama_obat($request->obat1).'-'.$request->jumlah1,
        //     'nama_obat2'=>$this->get_nama_obat($request->obat2).'-'.$request->jumlah2,
        //     'nama_obat3'=>$this->get_nama_obat($request->obat3).'-'.$request->jumlah3,
        // ]);

        // $jumlah = new Collection([
        //     'jumlah1'=>$request->jumlah1,
        //     'jumlah2'=>$request->jumlah2,
        //     'jumlah3'=>$request->jumlah3,
        // ]);

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
        $html .= '<td><a
        class="btn btn-sm btn-danger btn-hapus"
        id="'.$resep.'" href="javascript:void(0)"
        style="cursor:pointer;"">Hapus</a></td>';

        return response()->json(['status'=>'ok','data'=>$html]);
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
        $html .= '<td>'.$request->jumlah_obat.'</td>';
        $html .= '<td>'.$request->dosis_obat.'</td>';
        $html .= '<td>'.$request->takaran_obat.'</td>';
        $html .= '<td>'.json_encode($request->diminum).'</td>';
        $html .= '<td>'.$request->takaran.'</td>';
        $html .= '<td>'.$request->catatan.'</td>';
        $html .= '<td><a
        class="btn btn-sm btn-danger btn-hapus"
        id="'.$resep.'" href="javascript:void(0)"
        style="cursor:pointer;"">Hapus</a></td>';

        $html .= '</tr>';

        return response()->json(['status'=>'ok','data'=>$html]);
    }
}
