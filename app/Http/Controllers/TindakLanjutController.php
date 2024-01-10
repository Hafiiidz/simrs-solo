<?php

namespace App\Http\Controllers;

use App\Helpers\VclaimHelper;
use App\Models\Dokter;
use App\Models\Pasien\Pasien;
use App\Models\Poli;
use App\Models\Rawat;
use App\Models\TindakLanjut;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class TindakLanjutController extends Controller
{
    public function index(Request $request)
    {
        $rawat = Rawat::find($request->idrawat);
        $pasien = Pasien::with('alamat')->where('no_rm', $rawat->no_rm)->first();
        $poli = Poli::where('ket', 1)->get();
        $dokter = Dokter::whereNotNull('idspesialis')->get();
        return view('tindak-lanjut.index', compact('pasien', 'rawat', 'poli', 'dokter'));
    }
    public function post_tindak_lanjut(Request $request, $id)
    {
        // return $request->all();
        $rawat = Rawat::find($id);
        $tindak_lanjut = new TindakLanjut();
        $tindak_lanjut->idrawat = $id;
        $tindak_lanjut->idrekapmedis = $request->idrekapmedis;
        $tindak_lanjut->tindak_lanjut = $request->rencana_tindak_lanjut;
        $tindak_lanjut->catatan = $request->catatan;
        if ($request->rencana_tindak_lanjut == 'Kontrol Kembali') {
            $tindak_lanjut->poli_rujuk = $rawat->poli->kode;
            $tindak_lanjut->tujuan_tindak_lanjut = NULL;
            $tindak_lanjut->tgl_tindak_lanjut = $request->tgl_kontrol;
        } elseif ($request->rencana_tindak_lanjut == 'Dirujuk') {
            $tindak_lanjut->poli_rujuk = $request->poli_rujuk;
            $tindak_lanjut->tujuan_tindak_lanjut = $request->tujuan_rujuk;
            $tindak_lanjut->tgl_tindak_lanjut = $request->tgl_kontrol_rujuk;
            $tindak_lanjut->operasi = NULL;
            $tindak_lanjut->tindakan_operasi = NULL;
            $tindak_lanjut->iddokter = NULL;
        } elseif ($request->rencana_tindak_lanjut == 'Dirawat') {
            if($request->iddokter == null){
                return redirect()->back()->with('gagal', 'Dokter harus diisi');
            }
            $tindak_lanjut->poli_rujuk = NULL;
            $tindak_lanjut->tgl_tindak_lanjut = $request->tgl_rawat;
            $tindak_lanjut->tujuan_tindak_lanjut = NULL;
            $tindak_lanjut->operasi = $request->operasi;
            $tindak_lanjut->tindakan_operasi = $request->value_operasi;
            $tindak_lanjut->iddokter = $request->iddokter;
        } elseif ($request->rencana_tindak_lanjut == 'Interm') {
            $tindak_lanjut->poli_rujuk = $request->poli_rujuk;
            $tindak_lanjut->tgl_tindak_lanjut = $request->tgl_kontrol_intem;
            $tindak_lanjut->operasi = NULL;
            $tindak_lanjut->tindakan_operasi = NULL;
            $tindak_lanjut->iddokter = NULL;
            $tindak_lanjut->tujuan_tindak_lanjut = "Rujuk Interm";
        }elseif ($request->rencana_tindak_lanjut == 'Prb') {
            $prb = new Collection([
                'alasan' => $request->alasan,
                'rencana_selanjutnya' => $request->rencana_selanjutnya,
            ]);
            $tindak_lanjut->poli_rujuk = $rawat->poli->kode;
            $tindak_lanjut->tgl_tindak_lanjut = $request->tgl_kontrol;
            $tindak_lanjut->operasi = NULL;
            $tindak_lanjut->tindakan_operasi = NULL;
            $tindak_lanjut->iddokter = NULL;
            $tindak_lanjut->prb = $prb;
            $tindak_lanjut->tujuan_tindak_lanjut = "Prb";

        }elseif($request->rencana_tindak_lanjut == 'Meninggal') {
            $tindak_lanjut->tgl_tindak_lanjut = $request->tgl_kontrol;
        } 
        
        $tindak_lanjut->nomor = $tindak_lanjut->generateNomorOtomatis();
        $tindak_lanjut->save();

        // if ($rawat->idbayar == 2) {
        //     if ($request->rencana_tindak_lanjut == 'Kontrol Kembali') {
        //         #insert SKPD
        //     } elseif ($request->rencana_tindak_lanjut == 'Dirujuk') {
        //         #insert rujukan
        //     } elseif ($request->rencana_tindak_lanjut == 'Dirawat') {
        //         #insert SPRI rawat inap
        //     } elseif ($request->rencana_tindak_lanjut == 'Interm') {
        //         #insert SKPD interm
        //     } elseif ($request->rencana_tindak_lanjut == 'Prb') {
        //         # insert prb
        //     }
        // }

        return redirect(route('rekam-medis-poli', $id))->with('berhasil', 'Data berhasil disimpan');
    }
    public function aksi_tindak_lanjut($id)
    {
        $poli = Poli::where('ket', 1)->get();
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

    public function edit_tindak_lanjut($id)
    {
        $tindak_lanjut = TindakLanjut::find($id);
        $rawat = Rawat::find($tindak_lanjut->idrawat);
        $pasien = Pasien::with('alamat')->where('no_rm', $rawat->no_rm)->first();
        $poli_interm = Poli::where('ket', 1)->get();
        $kode_faskes = explode('-', $tindak_lanjut->tujuan_tindak_lanjut);
        $poli = VclaimHelper::getFaskesSpesialistik($kode_faskes[0], $tindak_lanjut->tgl_tindak_lanjut);
        $dokter = Dokter::whereNotNull('idspesialis')->get();
        // dd($poli);
        // $dokter = Dokter::whereNotNull('idspesialis')->get();
        return view('tindak-lanjut.edit', compact('pasien', 'rawat', 'poli', 'tindak_lanjut', 'dokter', 'poli_interm'));
    }
    public function hapus_tindak_lanjut(Request $request)
    {
        $tindak_lanjut = TindakLanjut::find($request->id);
        $rawat = Rawat::find($tindak_lanjut->idrawat);
        $tindak_lanjut->delete();
        return redirect(route('rekam-medis-poli', $rawat->id))->with('berhasil', 'Data berhasil dihapus');
    }

    public function post_edit_tindak_lanjut(Request $request, $id)
    {
        // return $request->all();
        $tindak_lanjut = TindakLanjut::find($request->id);
        $rawat = Rawat::find($tindak_lanjut->idrawat);

        $tindak_lanjut->tindak_lanjut = $request->rencana_tindak_lanjut;
        $tindak_lanjut->tgl_tindak_lanjut = $request->tgl_kontrol;
        $tindak_lanjut->catatan = $request->catatan;
        if ($request->rencana_tindak_lanjut == 'Kontrol Kembali') {
            $tindak_lanjut->poli_rujuk = $rawat->poli->kode;
            $tindak_lanjut->tujuan_tindak_lanjut = NULL;
        } elseif ($request->rencana_tindak_lanjut == 'Dirujuk') {
            $tindak_lanjut->poli_rujuk = $request->poli_rujuk;
            $tindak_lanjut->tujuan_tindak_lanjut = $request->tujuan_rujuk;
            $tindak_lanjut->operasi = NULL;
            $tindak_lanjut->tindakan_operasi = NULL;
            $tindak_lanjut->iddokter = NULL;
        } elseif ($request->rencana_tindak_lanjut == 'Dirawat') {
            if($request->iddokter == null){
                return redirect()->back()->with('gagal', 'Dokter harus diisi');
            }
            $tindak_lanjut->poli_rujuk = NULL;
            $tindak_lanjut->tujuan_tindak_lanjut = NULL;
            $tindak_lanjut->operasi = $request->operasi;
            $tindak_lanjut->tindakan_operasi = $request->value_operasi;
            $tindak_lanjut->iddokter = $request->iddokter;
        } elseif ($request->rencana_tindak_lanjut == 'Interm') {
            $tindak_lanjut->poli_rujuk = $request->poli_rujuk;
            $tindak_lanjut->tgl_tindak_lanjut = $request->tgl_kontrol_intem;
            $tindak_lanjut->operasi = NULL;
            $tindak_lanjut->tindakan_operasi = NULL;
            $tindak_lanjut->iddokter = NULL;
            $tindak_lanjut->tujuan_tindak_lanjut = "Rujuk Interm";
        } elseif ($request->rencana_tindak_lanjut == 'Prb') {
            # insert prb
        }


        $tindak_lanjut->save();


        if ($rawat->idbayar == 2) {
            if ($request->rencana_tindak_lanjut == 'Kontrol Kembali') {
                #insert SKPD
            } elseif ($request->rencana_tindak_lanjut == 'Dirujuk') {
                #insert rujukan
            } elseif ($request->rencana_tindak_lanjut == 'Dirawat') {
                #insert SPRI rawat inap
            } elseif ($request->rencana_tindak_lanjut == 'Interm') {
                #insert SKPD interm
            } elseif ($request->rencana_tindak_lanjut == 'Prb') {
                # insert prb
            }
        }

        return redirect(route('rekam-medis-poli', $rawat->id))->with('berhasil', 'Data berhasil disimpan');
    }
}
