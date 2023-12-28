<?php

namespace App\Http\Controllers;

use App\Models\AntrianFarmasi;
use App\Models\Obat\Obat;
use App\Models\ObatTransaksi;
use App\Models\Pasien\Pasien;
use App\Models\Rawat;
use App\Models\RekapMedis\RekapMedis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class FarmasiController extends Controller
{
    public function antrian_resep()
    {
        //     $resep_rajal_umum = AntrianFarmasi::with('pasien','rawat')->where('jenis_rawat',1)->where('idbayar',1)->where('status_antrian','Antrian')->get();
        $resep_rajal = AntrianFarmasi::with('pasien', 'rawat')->where('jenis_rawat', 1)->where('status_antrian', 'Antrian')->orderby('id', 'asc')->get();

        $resep_ugd = AntrianFarmasi::with('pasien', 'rawat')->where('jenis_rawat', 3)->where('status_antrian', 'Antrian')->get();
        // $resep_ugd_bpjs = AntrianFarmasi::with('pasien','rawat')->where('jenis_rawat',3)->where('idbayar',2)->where('status_antrian','Antrian')->get();

        $resep_ranap = AntrianFarmasi::with('pasien', 'rawat')->where('jenis_rawat', 2)->where('status_antrian', 'Antrian')->get();
        // $resep_ranap_bpjs = AntrianFarmasi::with('pasien','rawat')->where('jenis_rawat',2)->where('idbayar',2)->where('status_antrian','Antrian')->get();

        // $total_antrian = count($resep_rajal) + count($resep_ugd) + count($resep_ranap);
        $total_antrian = count($resep_rajal) + count($resep_ugd) + count($resep_ranap);
        
        $transaksi_bayar = DB::table('transaksi_bayar')->orderBy('urutan', 'asc')->get();
        return view('farmasi.antrian-resep', compact('resep_rajal', 'resep_ugd', 'resep_ranap', 'transaksi_bayar','total_antrian'));
    }

    public function updateResep(Request $request)
    {
        $total_obat = 0;
        foreach($request->terapi_obat as $val){
            $obat = Obat::find($val['obat']);
            $total_obat += $obat->harga_jual * $val['pemberian_obat'];
        }

        $antrian = AntrianFarmasi::find($request->idantrian);
        $antrian->obat = json_encode($request->terapi_obat);
        $antrian->save();

        return response()->json([
            'status' => 'true',
            'total' => $total_obat
        ]);
    }

    public function post_resep(Request $request, $id)
    {
        // return $request->all();
        $antrian = AntrianFarmasi::find($id);
        $rawat = Rawat::find($antrian->idrawat);
        $pasien = Pasien::where('no_rm', $rawat->no_rm)->first();
        #simpan transaksi resep
        $obat_transaksi = new ObatTransaksi();
        $obat_transaksi->idrawat = $rawat->id;
        $obat_transaksi->no_rm = $rawat->no_rm;
        $obat_transaksi->tgl = date('Y-m-d');
        $obat_transaksi->idjenisrawat = $rawat->idjenisrawat;
        $obat_transaksi->jam = date('H:i:s');
        $obat_transaksi->kode_resep = 'RI' . date('Ymd') . rand(000000, 99999);
        $obat_transaksi->idjenis = 1;
        $obat_transaksi->save();

        #simpan resep
        $total_obat = 0;
        foreach ($request->terapi_obat as $to) {
            $obat = Obat::find($to['obat']);
            $total_obat += $obat->harga_jual * $to['pemberian_obat'];
            DB::table('obat_transaksi_detail')->insert([
                'idtrx' => $obat_transaksi->id,
                'nama_obat' => $obat->nama_obat,
                'idobat' => $to['obat'],
                'qty' => $to['pemberian_obat'],
                'harga' => $obat->harga_jual,
                'signa' => $to['signa1'] . 'x' . $to['signa2'],
                'total' => $obat->harga_jual * $to['pemberian_obat'],
                'idbayar' => $to['jenis_obat'],
            ]);
        }
        $obat_transaksi_save = ObatTransaksi::find($obat_transaksi->id);
        $obat_transaksi_save->total_harga = $total_obat;
        $obat_transaksi_save->save();

        $antrian->status_antrian = 'Selesai';
        $antrian->save();
        return back()->with('berhasil', 'Resep Berhasil Di Simpan');
    }

    public function status_rajal($id)
    {
        $rawat = Rawat::find($id);
        $pasien = Pasien::where('no_rm', $rawat->no_rm)->first();
        $antrian = AntrianFarmasi::where('idrawat', $id)->first();
        $rekap_medis = RekapMedis::where('idrawat', $id)->first();
        $obat = Obat::get();
        $transaksi_bayar = DB::table('transaksi_bayar')->orderBy('urutan', 'asc')->get();

        $resep = ObatTransaksi::where('idrawat', $id)->get();
        return view('farmasi.status-rajal', compact('rawat', 'pasien', 'antrian', 'rekap_medis', 'obat', 'transaksi_bayar', 'resep'));
    }
    public function status_ranap($id)
    {
        $rawat = Rawat::find($id);
        $pasien = Pasien::where('no_rm', $rawat->no_rm)->first();
        $antrian = AntrianFarmasi::where('idrawat', $id)->first();
        $obat = Obat::get();
        $transaksi_bayar = DB::table('transaksi_bayar')->orderBy('urutan', 'asc')->get();
        $pemberian_obat = DB::table('demo_pemberian_obat_inap')->where('idrawat', $id)->get();
        $pemberian_obat_injeksi = DB::table('demo_pemberian_obat_inap')->where('idrawat', $id)->where('jenis', 'Injeksi')->get();
        $pemberian_obat_non_injeksi = DB::table('demo_pemberian_obat_inap')->where('idrawat', $id)->where('jenis', 'Non Injeksi')->get();
        $cppt = DB::table('rawat_cppt')->where('idrawat', $id)->get();
        $resep = ObatTransaksi::where('idrawat', $id)->get();
        return view('farmasi.status-ranap', compact('rawat', 'pasien', 'antrian', 'obat', 'transaksi_bayar', 'resep', 'pemberian_obat', 'pemberian_obat_injeksi', 'pemberian_obat_non_injeksi', 'cppt'));
    }
    public function post_pemberian(Request $request, $id)
    {
        // return $request->all();
        $rawat = Rawat::find($id);

        DB::table('demo_pemberian_obat_inap')->insert([
            'idrawat' => $rawat->id,
            'jenis' => $request->jenis_pemberian,
            'tgl' => $request->tgl,
            'pemberian_obat' => json_encode($request->pemberian_obat),
            'created_at' => now(),
            'updated_at' => now(),
            'user' => auth()->user()->id,
        ]);
        return redirect()->back()->with('berhasil', 'Data Pemberian Obat Berhasil Di Simpan');
    }

    public function list_obat()
    {
        if (request()->ajax()) {
            $query = Obat::orderBy('abjad', 'asc');
            return DataTables::eloquent($query)->make(true);
        }
        return view('farmasi.list-obat');
    }
    public function list_resep()
    {
        if (request()->ajax()) {
            $query = ObatTransaksi::with('rawat', 'rawat.pasien')->orderBy('id', 'desc');
            return DataTables::eloquent($query)
                ->addColumn('dokter', function ($item) {
                    return $item->rawat->dokter->nama_dokter;
                })
                ->addColumn('poli', function ($item) {
                    return $item->rawat->poli->poli;
                })
                ->addColumn('penanggung', function ($item) {
                    return $item->rawat->bayar->bayar;
                })
                ->addColumn('action', function ($item) {
                    if ($item->idjenisrawat == 2) {
                        return '
                    <a href="' . route('farmasi.status-ranap', $item->idrawat) . '" class="btn btn-sm btn-primary">Lihat</a>
                    ';
                    } else {
                        return '
                <a href="' . route('farmasi.status-rajal', $item->idrawat) . '" class="btn btn-sm btn-primary">Lihat</a>
                ';
                    }
                })
                ->rawColumns(['action', 'dokter', 'poli', 'penanggung'])
                ->make(true);
        }
        return view('farmasi.list-resep');
    }
    public function list_pasien_rawat()
    {

        if (request()->ajax()) {
            $query = Rawat::with('pasien', 'bayar')->where('idjenisrawat', 2)->where('status', 2)->orderBy('id', 'asc');
            return DataTables::eloquent($query)
                ->addColumn('dokter', function ($item) {
                    return $item->dokter->nama_dokter;
                })
                ->addColumn('action', function ($item) {
                    return '
                <a href="' . route('farmasi.status-ranap', $item->id) . '" class="btn btn-sm btn-primary">Lihat</a>
                ';
                })
                ->rawColumns(['action', 'terisi'])
                ->make(true);
        }
        return view('farmasi.list-pasien-rawat');
    }

    public function cetakResepTempo($id)
    {
        $resep = AntrianFarmasi::find($id);
        $rawat = Rawat::find($resep->idrawat);
        $pasien = Pasien::where('no_rm', $rawat->no_rm)->first();
        $obat = Obat::get();
        $pdf = PDF::loadview('farmasi.cetak.resep-tempo', compact('resep', 'rawat', 'pasien', 'obat'));
        $customPaper = array(0,0,323.15,790.866);
        $pdf->setPaper($customPaper);
        return $pdf->stream();
    }
    public function cetakResep($id)
    {
        $resep = ObatTransaksi::where('id', $id)->first();
        $rawat = Rawat::find($resep->idrawat);
        $pasien = Pasien::where('no_rm', $rawat->no_rm)->first();
        $detail_resep = DB::table('obat_transaksi_detail')->where('idtrx',$resep->id)->get();

        $pdf = PDF::loadview('farmasi.cetak.resep', compact('resep', 'rawat', 'pasien','detail_resep'));
        $customPaper = array(0,0,323.15,790.866);
        $pdf->setPaper($customPaper);
        return $pdf->stream();
    }

    public function cetakTiket($id)
    {
        $resep = ObatTransaksi::where('id', $id)->first();
        $rawat = Rawat::find($resep->idrawat);
        $pasien = Pasien::select('pasien.*','pasien_alamat.alamat')
            ->leftJoin('pasien_alamat','pasien.id','=','pasien_alamat.idpasien')->where('pasien.no_rm', $rawat->no_rm)->first();
        $detail_resep = DB::table('obat_transaksi_detail')->where('idtrx',$resep->id)->get();

        $pdf = PDF::loadview('farmasi.cetak.tiket', compact('resep', 'rawat', 'pasien','detail_resep'));
        $customPaper = array(0,0,170.079,198.425);
        $pdf->setPaper($customPaper);
        return $pdf->stream();
    }
}
