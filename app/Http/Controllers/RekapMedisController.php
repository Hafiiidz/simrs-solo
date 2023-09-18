<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;
use App\Models\RekapMedis\RekapMedis;
use App\Models\RekapMedis\Kategori;
use App\Models\Pasien\Pasien;

class RekapMedisController extends Controller
{
    public function index($id_pasien)
    {
        $pasien = Pasien::with('alamat')->find($id_pasien);
        $kategori = Kategori::get();

        if (request()->ajax()) {
            $rekap = RekapMedis::with('kategori')->where('idpasien', $id_pasien);

            return DataTables::of($rekap)
            ->addColumn('kategori', function(RekapMedis $rekap) {
                return $rekap->kategori->nama;
            })
            ->addColumn('tanggal', function(RekapMedis $rekap) {
                return Carbon::parse($rekap->created_at)->translatedFormat('l, d F Y');
            })
            ->addColumn('opsi', function(RekapMedis $rekap) {
                return '<a href="'. route('rekap-medis-show', $rekap->id) .'" class="btn btn-sm btn-success">Detail</a>';
            })
            ->rawColumns(['kategori','tanggal','opsi'])
            ->addIndexColumn()
            ->make();
        }

        return view('rekap-medis.index', compact('pasien','kategori'));
    }

    public function create(Request $request)
    {
        $pasien = Pasien::with('alamat')->find($request->id_pasien);
        $kategori = Kategori::find($request->kategori);
        return view('rekap-medis.create', compact('pasien','kategori'));
    }

    public function store(Request $request, $id_pasien)
    {

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
        ]);

        $riwayat_kesehatan = new Collection([
            'riwayat_1' => $request->riwayat_1,
            'riwayat_2' => $request->riwayat_2,
            'riwayat_3' => $request->riwayat_3,
            'riwayat_4' => $request->riwayat_4,
        ]);

        $rekap = new RekapMedis;
        $rekap->idpasien = $id_pasien;
        $rekap->idkategori = $request->kategori;
        $rekap->diagnosa = $request->diagnosa;
        $rekap->anamnesa = $request->anamnesa;
        $rekap->obat_yang_dikonsumsi = $request->obat_yang_dikonsumsi;
        $rekap->alergi = $alergi->toJson();
        $rekap->pasien_sedang = $request->pasien_sedang;
        $rekap->pemeriksaan_fisik = $pemeriksaan_fisik->toJson();
        $rekap->riwayat_kesehatan = $riwayat_kesehatan->toJson();
        $rekap->rencana_pemeriksaan = $request->rencana_pemeriksaan;
        $rekap->terapi = $request->terapi;
        $rekap->save();

        return redirect()->route('rekap-medis-index', $id_pasien)->with('berhasil','Data Rekap Medis Pasien Berhasil Di Simpan!');
    }

    public function show($id)
    {
        $rekap = RekapMedis::with('pasien','pasien.alamat','kategori')->find($id);
        $alergi = json_decode($rekap->alergi);
        $pfisik = json_decode($rekap->pemeriksaan_fisik);
        $rkesehatan = json_decode($rekap->riwayat_kesehatan);

        return view('rekap-medis.show', compact('rekap','alergi','pfisik','rkesehatan'));
    }

    public function update(Request $request, $id)
    {
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
        ]);

        $riwayat_kesehatan = new Collection([
            'riwayat_1' => $request->riwayat_1,
            'riwayat_2' => $request->riwayat_2,
            'riwayat_3' => $request->riwayat_3,
            'riwayat_4' => $request->riwayat_4,
        ]);

        $rekap = RekapMedis::find($id);
        $rekap->idkategori = $request->kategori;
        $rekap->diagnosa = $request->diagnosa;
        $rekap->anamnesa = $request->anamnesa;
        $rekap->obat_yang_dikonsumsi = $request->obat_yang_dikonsumsi;
        $rekap->alergi = $alergi->toJson();
        $rekap->pasien_sedang = $request->pasien_sedang;
        $rekap->pemeriksaan_fisik = $pemeriksaan_fisik->toJson();
        $rekap->riwayat_kesehatan = $riwayat_kesehatan->toJson();
        $rekap->rencana_pemeriksaan = $request->rencana_pemeriksaan;
        $rekap->terapi = $request->terapi;
        $rekap->save();

        return redirect()->route('rekap-medis-index', $rekap->idpasien)->with('berhasil','Data Rekap Medis Pasien Berhasil Di Simpan!');
    }
}
