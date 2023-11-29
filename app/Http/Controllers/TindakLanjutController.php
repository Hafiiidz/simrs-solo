<?php

namespace App\Http\Controllers;

use App\Models\Pasien\Pasien;
use App\Models\Rawat;
use App\Models\TindakLanjut;
use Illuminate\Http\Request;

class TindakLanjutController extends Controller
{
    public function index(Request $request)
    {
        $rawat = Rawat::find($request->idrawat);
        $pasien = Pasien::with('alamat')->where('no_rm', $rawat->no_rm)->first();
        return view('tindak-lanjut.index', compact('pasien', 'rawat'));
    }
    public function post_tindak_lanjut(Request $request,$id){
        $tindak_lanjut = new TindakLanjut();
        $tindak_lanjut->idrawat = $id;
        $tindak_lanjut->idrekapmedis = $request->idrekapmedis;
        $tindak_lanjut->tindak_lanjut = $request->rencana_tindak_lanjut;
        $tindak_lanjut->tindak_lanjut = $request->rencana_tindak_lanjut;
        $tindak_lanjut->tgl_tindak_lanjut = $request->tgl_kontrol;
        $tindak_lanjut->catatan = $request->catatan;
        $tindak_lanjut->nomor = $tindak_lanjut->generateNomorOtomatis();
        $tindak_lanjut->save();

        return redirect(route('rekam-medis-poli', $id))->with('success', 'Data berhasil disimpan');
    }
    public function aksi_tindak_lanjut($id)
    {
        switch ($id) {
            case "Kontrol Kembali":
                return view('tindak-lanjut.partial.kontrol');
                break;
            case "Dirujuk":
                return view('tindak-lanjut.partial.rujuk');
                break;
            case "Dirawat":
                return view('tindak-lanjut.partial.rawat');
                break;
        }
    }
}
