<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pasien\Pasien;
use App\Models\Poli;
use App\Models\Rawat;
use App\Models\TindakLanjut;
use Illuminate\Http\Request;

class TindakLanjutController extends Controller
{
    public function index(Request $request)
    {
        $rawat = Rawat::find($request->idrawat);
        $pasien = Pasien::with('alamat')->where('no_rm', $rawat->no_rm)->first();
        $poli = Poli::where('ket',1)->get();
        $dokter = Dokter::whereNotNull('idspesialis')->get();
        return view('tindak-lanjut.index', compact('pasien', 'rawat', 'poli', 'dokter'));
    }
    public function post_tindak_lanjut(Request $request,$id){
        // return $request->all();
        $tindak_lanjut = new TindakLanjut();
        $tindak_lanjut->idrawat = $id;
        $tindak_lanjut->idrekapmedis = $request->idrekapmedis;
        $tindak_lanjut->tindak_lanjut = $request->rencana_tindak_lanjut;
        $tindak_lanjut->tgl_tindak_lanjut = $request->tgl_kontrol;
        $tindak_lanjut->catatan = $request->catatan;
        $tindak_lanjut->poli_rujuk = $request->poli_rujuk;
        $tindak_lanjut->tujuan_tindak_lanjut = $request->tujuan_rujuk;
        $tindak_lanjut->nomor = $tindak_lanjut->generateNomorOtomatis();
        $tindak_lanjut->save();

        return redirect(route('rekam-medis-poli', $id))->with('success', 'Data berhasil disimpan');
    }
    public function aksi_tindak_lanjut($id)
    {
        $poli = Poli::where('ket',1)->get();
        $dokter = Dokter::whereNotNull('idspesialis')->get();
        switch ($id) {
            case "Kontrol Kembali":
                return view('tindak-lanjut.partial.kontrol', compact('poli', 'dokter'));
                break;
            case "Dirujuk":
                return view('tindak-lanjut.partial.rujuk', compact('poli', 'dokter'));
                break;
            case "Dirawat":
                return view('tindak-lanjut.partial.rawat', compact('poli', 'dokter'));
                break;
        }
    }
}
