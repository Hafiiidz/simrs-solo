<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\LabHasil;
use App\Models\PermintaanPenunjang;
use App\Models\RadiologiHasil;
use App\Models\Rawat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PenunjangController extends Controller
{
    public function antrian($jenis)
    {

        $penunjang_rajal = PermintaanPenunjang::with('pasien', 'rawat')->where('status_pemeriksaan', 'Antrian')->where('jenis_penunjang', $jenis)->where('jenis_rawat', 1)->where('pemeriksaan_penunjang','!=','null')->whereDate('created_at', date('Y-m-d'))->get();
        $penunjang_ranap = PermintaanPenunjang::with('pasien', 'rawat')->where('status_pemeriksaan', 'Antrian')->where('jenis_penunjang', $jenis)->where('jenis_rawat', 2)->where('pemeriksaan_penunjang','!=','null')->whereDate('created_at', date('Y-m-d'))->get();
        $penunjang_ugd = PermintaanPenunjang::with('pasien', 'rawat')->where('status_pemeriksaan', 'Antrian')->where('jenis_penunjang', $jenis)->where('jenis_rawat', 3)->where('pemeriksaan_penunjang','!=','null')->whereDate('created_at', date('Y-m-d'))->get();

        $radiologi = DB::table('radiologi_tindakan')->get();
        $lab = DB::table('laboratorium_pemeriksaan')->get();
        $fisio = DB::table('tarif')->where('idkategori', 8)->get();

        return view(
            'penunjang.antrian',
            [
                'jenis' => $jenis
            ],
            compact('radiologi', 'lab', 'fisio', 'penunjang_rajal', 'penunjang_ranap', 'penunjang_ugd')
        );
    }

    public function detail_penunjang($id, $jenis)
    {
        $rawat = Rawat::with('pasien')->where('id', $id)->first();
        $penunjang = PermintaanPenunjang::with('pasien', 'rawat')->where('idrawat', $id)->where('status_pemeriksaan', 'Antrian')->where('jenis_penunjang', $jenis)->first();
        $list_penunjang = PermintaanPenunjang::with('pasien', 'rawat')->where('idrawat', $id)->where('status_pemeriksaan', 'Selesai')->where('jenis_penunjang', $jenis)->get();
        if ($jenis == 'Lab') {
            $dokter = Dokter::where('idspesialis', 8)->get();
        } elseif ($jenis == 'Radiologi') {
            $dokter = Dokter::where('idspesialis', 6)->get();
        } else {
            $dokter = Dokter::where('idspesialis', 14)->get();
        }
        $radiologi = DB::table('radiologi_tindakan')->get();
        $lab = DB::table('laboratorium_pemeriksaan')->get();
        $fisio = DB::table('tarif')->where('idkategori', 8)->get();
        $pemeriksaan_lab = LabHasil::where('idrawat', $id)->get();
        $pemeriksaan_radiologi = RadiologiHasil::where('idrawat', $id)->get();
        $pemeriksaan_fisio = DB::table('tindakan_fisio')->where('idrawat', $id)->get();

        return view('penunjang.detail', [
            'jenis' => $jenis
        ], compact('rawat', 'penunjang', 'list_penunjang', 'dokter', 'radiologi', 'lab', 'fisio', 'pemeriksaan_lab', 'pemeriksaan_radiologi', 'pemeriksaan_fisio'));
    }

    public function kerjakan_rad(Request $request, $id)
    {
        // return $request->all();
        $permintaan = PermintaanPenunjang::find($id);
        $rawat = Rawat::find($permintaan->idrawat);

        $hasil = new RadiologiHasil();
        $hasil->idrawat = $permintaan->idrawat;
        $hasil->idhasil = 'RAD' . date('Ymd') . rand(1000000, 9999999);
        $hasil->tgl_hasil = date('Y-m-d H:i:s');
        $hasil->iddokter = $request->dokter_pemeriksa;
        $hasil->idpetugas = auth()->user()->id;
        $hasil->status = 1;
        $hasil->save();

        if ($request->radiologi) {
            foreach ($request->radiologi as $rad) {
                $rad2 = DB::table('radiologi_tindakan')->where('id', $rad['tindakan_rad'])->first();
                $data = [
                    'idhasil' => $hasil->id,
                    'status' => 1,
                    'idrawat' => $rawat->id,
                    'idjenisrawat' => $rawat->idjenisrawat,
                    'idradiologi' => $rad2->idrad,
                    'idpelayanan' => $rad2->idpelayanan,
                    'idbayar' => $rawat->idbayar,
                    'kat_pasien' => $rawat->kat_pasien,
                    'idpengantar' => $permintaan->id,
                    'idtindakan' => $rad['tindakan_rad'],
                    'keterangan' => $rad['catatan'],
                    'klinis' => $rad['klinis'],
                ];
                DB::table('radiologi_hasildetail')->insert($data);
            }
        }
        $permintaan->status_pemeriksaan = 'Pemeriksaan';
        $permintaan->save();
        return back()->with('berhasil', 'Berhasil Membuat Hasil Pemeriksaan');
    }
    public function kerjakan_fisio(Request $request, $id)
    {
        $permintaan = PermintaanPenunjang::find($id);
        $rawat = Rawat::find($permintaan->idrawat);
        // return $request->all();
        if ($request->fisio) {
            foreach ($request->fisio as $fisio) {
                $data = [
                    'idrawat' => $rawat->id,
                    'idtindakan' => $fisio['tindakan_fisio'],
                    'idtindakan' => $fisio['tindakan_fisio'],
                    'iddokter'=>$request->dokter_pemeriksa,
                    'status'=>1,
                    'tgl'=>date('Y-m-d'),
                    'idbayar'=>$rawat->idbayar,
                    'iddokterpeminta'=>$rawat->iddokter,
                    'perawat'=>auth()->user()->id,
                ];

                DB::table('tindakan_fisio')->insert($data);
            }
        }
        $permintaan->status_pemeriksaan = 'Pemeriksaan';
        $permintaan->save();
        return back()->with('berhasil', 'Berhasil Membuat Hasil Pemeriksaan');
    }
    public function kerjakan_lab(Request $request, $id)
    {
        // return $request->all();
        $permintaan = PermintaanPenunjang::find($id);
        $rawat = Rawat::find($permintaan->idrawat);

        $hasil = new LabHasil();
        $hasil->idrawat = $permintaan->idrawat;
        $hasil->labid = 'LAB' . date('Ymd') . rand(1000000, 9999999);
        $hasil->tgl_hasil = date('Y-m-d H:i:s');
        $hasil->tgl_permintaan = $permintaan->created_at;
        $hasil->iddokter = $request->dokter_pemeriksa;
        $hasil->idpetugas = auth()->user()->id;
        $hasil->status = 1;
        $hasil->save();

        if ($request->lab) {
            foreach ($request->lab as $lab) {
                $lab2 = DB::table('laboratorium_pemeriksaan')->where('id', $lab['tindakan_lab'])->first();
                $data = [
                    'idhasil' => $hasil->id,
                    'nama_pemeriksaan' => $lab2->nama_pemeriksaan,
                    'status' => 1,
                    'no_rm' => $rawat->no_rm,
                    'idbayar' => $rawat->idbayar,
                    'kat_pasien' => $rawat->kat_pasien,
                    'idpengantar' => $permintaan->id,
                    'idpemeriksaan' => $lab['tindakan_lab'],
                ];
                DB::table('laboratorium_hasildetail')->insert($data);
            }
        }

        $permintaan->status_pemeriksaan = 'Pemeriksaan';
        $permintaan->save();
        return back()->with('berhasil', 'Berhasil Membuat Hasil Pemeriksaan');
    }

    public function post_data_hasil_fisio(Request $request, $id){
        $pemeriksaan = DB::table('tindakan_fisio')->where('id', $id)->first();
        // return $request->all();
        $tarif = DB::table('tarif')->where('id',$pemeriksaan->idtindakan)->first();
        $rawat = Rawat::find($pemeriksaan->idrawat);
        $transaksi = DB::table('transaksi')->where('kode_kunjungan', $rawat->idkunjungan)->first();
        if($pemeriksaan->status == 1){
            DB::table('transaksi_detail_rinci')->insert([
                'idbayar' => $rawat->idbayar,
                'iddokter' => $pemeriksaan->iddokter,
                'idpaket' => 0,
                'idjenis' => 0,
                'idrawat' => $rawat->id,
                'idtransaksi' => $transaksi->id,
                'idtarif' => $tarif->id,
                'tarif' => $tarif->tarif,
                'idtindakan' => $tarif->kat_tindakan,
                'tgl' => now(),
            ]);
        }
        

        $data = [
            'keterangan'=>$request->hasil,
            'status'=>2,
        ];
        DB::table('tindakan_fisio')->where('id', $id)->update($data);
        return redirect()->back()->with('berhasil', 'Berhasil Update Hasil Pemeriksaan');
    }
    public function post_data_hasil_rad(Request $request, $id)
    {
        // return $request->all();
        $pemeriksaan = DB::table('radiologi_hasildetail')->where('id', $id)->first();
        $data_pemeriksaan = RadiologiHasil::find($pemeriksaan->idhasil);
        $rawat = Rawat::find($data_pemeriksaan->idrawat);
        $transaksi = DB::table('transaksi')->where('kode_kunjungan', $rawat->idkunjungan)->first();
        if($pemeriksaan->status == 1){
            $tindakan = DB::table('radiologi_tindakan')->where('id', $pemeriksaan->idtindakan)->first();
            // dd($tindakan);
            if($tindakan->idtindakan != null){
                $tarif = DB::table('tarif')->where('id',$tindakan->idtindakan)->first();
                DB::table('transaksi_detail_rinci')->insert([
                    'idbayar' => $rawat->idbayar,
                    'iddokter' => $data_pemeriksaan->iddokter,
                    'idpaket' => 0,
                    'idjenis' => 0,
                    'idrawat' => $rawat->id,
                    'idtransaksi' => $transaksi->id,
                    'idtarif' => $tarif->id,
                    'tarif' => $tarif->tarif,
                    'idtindakan' => $tarif->kat_tindakan,
                    'tgl' => now(),
                ]);
            }
        }
        $data = [
            'klinis' => $request->klinis,
            'hasil' => $request->hasil,
            'kesan' => $request->kesan,
            'keterangan' => $request->keterangan,
            'status' => '2'
        ];
        DB::table('radiologi_hasildetail')->where('id', $id)->update($data);
        return redirect()->back()->with('berhasil', 'Berhasil Update Hasil Pemeriksaan');
    }
    public function post_data_hasil_lab(Request $request, $id)
    {
        // return $request->all();
        $pemeriksaan = DB::table('laboratorium_hasildetail')->where('id', $id)->first();
        $data_pemeriksaan = LabHasil::find($pemeriksaan->idhasil);
        $rawat = Rawat::find($data_pemeriksaan->idrawat);
        $transaksi = DB::table('transaksi')->where('kode_kunjungan', $rawat->idkunjungan)->first();
        if ($request->lab) {
            foreach ($request->lab as $lab) {
                // $lab2 = DB::table('laboratorium_pemeriksaan')->where('id',$lab['tindakan_lab'])->first();
                $data = [
                    'iditem' => $lab['id_item'],
                    'item' => $lab['item'],
                    'hasil' => $lab['hasil'],
                    'nilai_rujukan' => $lab['nilai_normal'],
                    'satuan' => $lab['satuan'],
                    'idpemeriksaan' => $pemeriksaan->idpemeriksaan,
                    'idlayanan' => $pemeriksaan->id,
                    'idhasil' => $pemeriksaan->idhasil,
                ];
                DB::table('lab_hasil')->insert($data);
            }
            $periksa = DB::table('laboratorium_pemeriksaan')->where('id',$pemeriksaan->idpemeriksaan)->first();
            // dd($periksa);
            $tarif = DB::table('tarif')->where('id',$periksa->idtarif)->first();
            DB::table('transaksi_detail_rinci')->insert([
                'idbayar' => $rawat->idbayar,
                'iddokter' => $data_pemeriksaan->iddokter,
                'idpaket' => 0,
                'idjenis' => 0,
                'idrawat' => $rawat->id,
                'idtransaksi' => $transaksi->id,
                'idtarif' => $tarif->id,
                'tarif' => $tarif->tarif,
                'idtindakan' => $tarif->kat_tindakan,
                'tgl' => now(),
            ]);

        }
        DB::table('laboratorium_hasildetail')->where('id', $id)->update([
            'status' => '2'
        ]);

        return redirect()->route('penunjang.detail', ['id' => $rawat->id, 'jenis' => 'Lab'])->with('berhasil', 'Berhasil Membuat Hasil Pemeriksaan');
    }
    public function lihat_hasil_lab($id, $idpemeriksaan)
    {
        $pemeriksaan = DB::table('laboratorium_hasildetail')->where('id', $id)->first();
        $data_pemeriksaan = LabHasil::find($pemeriksaan->idhasil);
        $rawat = Rawat::find($data_pemeriksaan->idrawat);
        $lab_form = DB::table('lab_hasil')->where('idlayanan', $pemeriksaan->id)->get();
        // return $lab_form;
        return view('penunjang.input_hasil_lab', compact('pemeriksaan', 'rawat', 'lab_form'));
    }
    public function input_hasil_fisio($id, $idpemeriksaan){
        $pemeriksaan = DB::table('tindakan_fisio')->where('id', $id)->first();

        $rawat = Rawat::find($pemeriksaan->idrawat);
        $tindakan = DB::table('tarif')->where('id', $pemeriksaan->idtindakan)->first();
        return view('penunjang.input-hasil-fisio', compact('pemeriksaan', 'rawat', 'tindakan'));
    }
    public function input_hasil_lab($id, $idpemeriksaan)
    {
        $pemeriksaan = DB::table('laboratorium_hasildetail')->where('id', $id)->first();
        $data_pemeriksaan = LabHasil::find($pemeriksaan->idhasil);
        $rawat = Rawat::find($data_pemeriksaan->idrawat);
        $lab_form = DB::table('laboratorium_form')->where('idpemeriksaan', $idpemeriksaan)->orderBy('urutan', 'asc')->get();
        // return $lab_form;
        return view('penunjang.input_hasil_lab', compact('pemeriksaan', 'rawat', 'lab_form'));
    }
    public function input_hasil_radiologi($id, $idpemeriksaan)
    {
        $pemeriksaan = DB::table('radiologi_hasildetail')->where('id', $id)->first();
        $data_pemeriksaan = LabHasil::find($pemeriksaan->idhasil);
        $rawat = Rawat::find($pemeriksaan->idrawat);
        $tindakan = DB::table('radiologi_tindakan')->where('id', $pemeriksaan->idtindakan)->first();
        $template_radiologi = DB::table('radiologi_hasildetail')->where('template', 1)->where('status', 2)->orderBy('id', 'desc')->get();
        $foto = DB::table('radiologi_hasilfoto')->where('idhasil', $pemeriksaan->id)->get();
        // return $lab_form;
        return view('penunjang.input_hasil_radiologi', compact('pemeriksaan', 'rawat', 'tindakan', 'template_radiologi', 'foto'));
    }

    public function post_foto_rad(Request $request, $id)
    {
        // return $request->all();
        $pemeriksaan = DB::table('radiologi_hasildetail')->where('id', $id)->first();
        $foto = $request->file('foto_radiologi');
        $fileName = time() . 'Rad_' . $pemeriksaan->idhasil . '.' . $foto->extension();

        $filenameWithExt = $foto->getClientOriginalName();
        $extension = $foto->getClientOriginalExtension();
        $filenameSimpan = time() . 'foto-rad' . '_' . $pemeriksaan->id . '_' . time() . '.' . $extension;

        $foto->storeAs('public/' . 'foto-rad', $filenameSimpan);
        DB::table('radiologi_hasilfoto')->insert([
            'idhasil' => $pemeriksaan->id,
            'foto' => $filenameSimpan,
            'nofoto' => $request->nofoto,

        ]);
        // $filePath = $file->storeAs('uploads-rad', $fileName, 'public');

        return redirect()->back()->with('berhasil', 'Berhasil Update Hasil Pemeriksaan');
    }

    public function cetakRadiologi($id)
    {
        $pemeriksaan = DB::table('radiologi_hasildetail')->where('id', $id)->first();
        $rawat = Rawat::find($pemeriksaan->idrawat);

        $pdf = PDF::loadview('penunjang.cetak.radiologi', compact('pemeriksaan', 'rawat'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream();
    }
}
