<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Rawat;
use App\Models\Pasien\Pasien;
use App\Models\Gizi\EvaluasiGizi;
use App\Models\Gizi\AsuhanGizi;
use App\Models\Gizi\CpptGizi;
use App\Models\Gizi\SkriningGizi;
use Auth;

class GiziController extends Controller
{
    public function index()
    {
        $data = Rawat::with('pasien')->where('idjenisrawat', 2);

        if (request()->ajax()) {
            return DataTables::eloquent($data)
            ->addColumn('opsi', function(Rawat $data) {
                return '
                    <a href="'. route('show.gizi', $data->id) .'" class="btn btn-sm btn-success">Detail</a>
                ';
            })
            ->rawColumns(['opsi'])
            ->addIndexColumn()
            ->make();
        }

        return view('gizi.index');
    }

    public function show($id)
    {
        $rawat = Rawat::with('pasien','bayar')->where('id',$id)->first();
        $pasien = Pasien::where('no_rm',$rawat->no_rm)->first();
        $evaluasi = EvaluasiGizi::with('user','user.detail')->where('idrawat', $id)->get();
        $asuhan = AsuhanGizi::where('idrawat', $id)->first();
        $cppt = CpptGizi::with('user','user.detail')->where('idrawat', $id)->get();
        $skrining = SkriningGizi::where('idrawat', $id)->first();
        return view('gizi.show', compact('rawat','pasien','evaluasi','asuhan','cppt','skrining'));
    }

    public function storeEvaluasi(Request $request)
    {
        $data = new EvaluasiGizi;
        $data->idrawat = $request->idrawat;
        $data->tanggal = $request->tanggal;
        $data->monitoring_evaluasi = $request->monitoring_evaluasi;
        $data->idpetugas = Auth::user()->id;
        $data->save();

        return redirect()->back()->with('berhasil','Data Evaluasi Berhasil Di Simpan!');
    }

    public function storeAsuhan(Request $request)
    {
        $antropometri = new Collection([
            'bb' => $request->bb,
            'tb_pb' => $request->tb_pb,
            'imt' => $request->imt,
            'lla' => $request->lla,
            'rl' => $request->rl
        ]);

        $alergi_makanan = new Collection([
            'telur' => $request->telur,
            'susu_sapi' => $request->susu_sapi,
            'kacang_tanah' => $request->kacang_tanah,
            'gluten' => $request->gluten,
            'udang' => $request->udang,
            'ikan' => $request->ikan,
            'almond' => $request->almond,
        ]);

        $intervensi_gizi = new Collection([
            'tujuan' => $request->tujuan,
            'target' => $request->target,
        ]);

        $data = AsuhanGizi::where('idrawat', $request->idrawat)->first();

        if($data){

            $data->idrawat = $request->idrawat;
            $data->tanggal = $request->tanggal;
            $data->diagnosis_medis = $request->diagnosis_medis;
            $data->antropometri = $antropometri;
            $data->biokimia = $request->biokimia;
            $data->klinik = $request->klinik;
            $data->riwayat_gizi = $request->riwayat_gizi;
            $data->alergi_makanan = $alergi_makanan;
            $data->pola_makan = $request->pola_makan;
            $data->riwayat_personal = $request->riwayat_personal;
            $data->diagnosa_gizi = $request->diagnosa_gizi;
            $data->intervensi_gizi = $intervensi_gizi;
            $data->save();

            return redirect()->back()->with('berhasil','Data Asuhan Gizi Berhasil Di Ubah!');
        }

        $data = new AsuhanGizi;
        $data->idrawat = $request->idrawat;
        $data->tanggal = $request->tanggal;
        $data->diagnosis_medis = $request->diagnosis_medis;
        $data->antropometri = $antropometri;
        $data->biokimia = $request->biokimia;
        $data->klinik = $request->klinik;
        $data->riwayat_gizi = $request->riwayat_gizi;
        $data->alergi_makanan = $alergi_makanan;
        $data->pola_makan = $request->pola_makan;
        $data->riwayat_personal = $request->riwayat_personal;
        $data->diagnosa_gizi = $request->diagnosa_gizi;
        $data->intervensi_gizi = $intervensi_gizi;
        $data->save();

        return redirect()->back()->with('berhasil','Data Asuhan Gizi Berhasil Di Simpan!');
    }

    public function storeCppt(Request $request)
    {
        $hasil = new Collection([
            'a' => $request->cppt_a,
            'd' => $request->cppt_d,
            'i' => $request->cppt_i,
            'm' => $request->cppt_m,
            'e' => $request->cppt_e
        ]);

        $data = new CpptGizi;
        $data->idrawat = $request->idrawat;
        $data->idpetugas = auth()->user()->id;
        $data->tanggal = date('Y-m-d H:i:s');
        $data->profesi = $request->profesi;
        $data->hasil = $hasil;
        $data->save();

        return redirect()->back()->with('berhasil','Data CPPT Berhasil Di Simpan!');
    }

    public function storeSkrining(Request $request)
    {
        $skrining = new Collection([
            'parameter_1' => $request->parameter_1,
            'parameter_2' => $request->parameter_2,
            'ya' => ($request->parameter_1 == 3) ? $request->ya : ''
        ]);

        $data = SkriningGizi::where('idrawat', $request->idrawat)->first();

        if($data){
            $data->skrining = $skrining;
            $data->save();
            return redirect()->back()->with('berhasil','Data CPPT Berhasil Di Ubah!');
        }

        $data = new SkriningGizi;
        $data->idrawat = $request->idrawat;
        $data->skrining = $skrining;
        $data->save();

        return redirect()->back()->with('berhasil','Data CPPT Berhasil Di Simpan!');
    }
}
