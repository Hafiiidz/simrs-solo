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
use PDF;

class DetailRekapMedisController extends Controller
{
    public function index($id_rekapmedis)
    {
        $data = RekapMedis::find($id_rekapmedis);
        $pasien = Pasien::with('alamat')->find($data->idpasien);
        $kategori = Kategori::find($data->idkategori);

        if (request()->ajax()) {
            $detail = DetailRekapMedis::with('rekapMedis.kategori')->where('idrekapmedis', $id_rekapmedis);

            return DataTables::of($detail)
            ->addColumn('kategori', function(DetailRekapMedis $detail) {
                return $detail->rekapMedis->kategori->nama;
            })
            ->addColumn('tanggal', function(DetailRekapMedis $detail) {
                return Carbon::parse($detail->created_at)->translatedFormat('l, d F Y');
            })
            ->addColumn('opsi', function(DetailRekapMedis $detail) {
                $html = '';
                $html .= '<a href="'. route('detail-rekap-medis-show', $detail->id) .'" class="btn btn-sm btn-success">Detail</a>';
                $html .= '&nbsp;&nbsp;<a href="'. route('detail-rekap-medis-cetak', $detail->id) .'" class="btn btn-sm btn-danger" target="_blank">PDF</a>';
                return $html;
            })
            ->rawColumns(['kategori','tanggal','opsi'])
            ->addIndexColumn()
            ->make();
        }

        return view('detail-rekap-medis.index', compact('pasien','kategori','id_rekapmedis','data'));
    }

    public function create(Request $request)
    {
        $data = RekapMedis::find($request->id_rekapmedis);
        $pasien = Pasien::with('alamat')->find($data->idpasien);
        $kategori = Kategori::find($data->idkategori);
        $obat = Obat::with('satuan')->where('obat.idjenis', 1)->orderBy('obat.nama_obat','asc')->get();
        return view('detail-rekap-medis.create', compact('pasien','kategori','data','obat'));
    }

    public function store(Request $request, $id_rekapmedis)
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

        $rekap = new DetailRekapMedis;
        $rekap->idrekapmedis = $id_rekapmedis;
        $rekap->diagnosa = $request->diagnosa;
        $rekap->anamnesa = $request->anamnesa;
        $rekap->obat_yang_dikonsumsi = $request->obat_yang_dikonsumsi;
        $rekap->alergi = $alergi->toJson();
        $rekap->pasien_sedang = $request->pasien_sedang;
        $rekap->pemeriksaan_fisik = $pemeriksaan_fisik->toJson();
        $rekap->riwayat_kesehatan = $riwayat_kesehatan->toJson();
        $rekap->rencana_pemeriksaan = $request->rencana_pemeriksaan;
        $rekap->terapi_obat = json_encode($request->terapi_obat);
        $rekap->terapi = $request->terapi;
        $rekap->save();

        return redirect()->route('detail-rekap-medis-index', $id_rekapmedis)->with('berhasil','Data Rekap Medis Pasien Berhasil Di Simpan!');
    }

    public function show($id)
    {
        $rekap = DetailRekapMedis::with('rekapMedis.pasien','rekapMedis.pasien.alamat','rekapMedis.kategori')->find($id);
        $alergi = json_decode($rekap->alergi);
        $pfisik = json_decode($rekap->pemeriksaan_fisik);
        $rkesehatan = json_decode($rekap->riwayat_kesehatan);
        $obat = Obat::with('satuan')->where('obat.idjenis', 1)->orderBy('obat.nama_obat','asc')->get();

        return view('detail-rekap-medis.show', compact('rekap','alergi','pfisik','rkesehatan','obat'));
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

        $rekap = DetailRekapMedis::find($id);
        $rekap->diagnosa = $request->diagnosa;
        $rekap->anamnesa = $request->anamnesa;
        $rekap->obat_yang_dikonsumsi = $request->obat_yang_dikonsumsi;
        $rekap->alergi = $alergi->toJson();
        $rekap->pasien_sedang = $request->pasien_sedang;
        $rekap->pemeriksaan_fisik = $pemeriksaan_fisik->toJson();
        $rekap->riwayat_kesehatan = $riwayat_kesehatan->toJson();
        $rekap->rencana_pemeriksaan = $request->rencana_pemeriksaan;
        $rekap->terapi_obat = json_encode($request->terapi_obat);
        $rekap->terapi = $request->terapi;
        $rekap->save();

        return redirect()->route('detail-rekap-medis-index', $rekap->idrekapmedis)->with('berhasil','Data Rekap Medis Pasien Berhasil Di Simpan!');
    }

    public function cetak($id){

        $data = DetailRekapMedis::with('rekapMedis','rekapMedis.kategori','rekapMedis.pasien')->find($id);

        $alergi = json_decode($data->alergi);
        $pfisik = json_decode($data->pemeriksaan_fisik);
        $rkesehatan = json_decode($data->riwayat_kesehatan);
        $obat = Obat::with('satuan')->where('obat.idjenis', 1)->orderBy('obat.nama_obat','asc')->get();

        $pdf = PDF::loadview('detail-rekap-medis.cetak', compact('data','alergi','pfisik','rkesehatan','obat'));
        return $pdf->stream();
    	// return $pdf->download('rekap-medis.pdf');
        // return view('detail-rekap-medis.cetak');
    }
}
