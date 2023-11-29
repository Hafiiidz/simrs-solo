<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien\Pasien;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PasienController extends Controller
{
    
    public function index()
    {
        if (request()->ajax()) {
            $pasien = Pasien::query()->orderBy('id','desc');

            return DataTables::of($pasien)
                ->addColumn('opsi', function (Pasien $pasien) {
                    return '<a href="' . route('rekap-medis-index', $pasien->id) . '" class="btn btn-sm btn-success">Rekam Medis</a>';
                })
                ->rawColumns(['opsi'])
                ->make();
        }
        return view('pasien.index');
    }

    function data_keluran($id_kel){
        $data_kelurahan = DB::table('kelurahan')->where('id_kel', $id_kel)->first();
        $data_kecamatan = DB::table('kecamatan')->where('id_kec', $data_kelurahan->id_kec)->first();
        $data_kota = DB::table('kabupaten')->where('id_kab', $data_kecamatan->id_kab)->first();
        $provinsi = DB::table('provinsi')->where('id_prov', $data_kota->id_prov)->first();

        return [
            // 'idkel'=> $data_kelurahan->id_kel,
            // 'idkec'=> $data_kecamatan->id_kec,
            // 'idkab'=> $data_kota->id_kab,
            // 'idprov'=> $provinsi->id_prov,

            // 'provinsi' => $provinsi->nama,
            // 'kelurahan' => $data_kelurahan->nama,
            // 'kecamatan' => $data_kecamatan->nama,
            // 'kota' => $data_kota->nama
            'id'=> $data_kelurahan->id_kel,
            'text'=> $data_kelurahan->nama.', '.$data_kecamatan->nama.', '.$data_kota->nama.', '.$provinsi->nama
        ];
    }

    public function cari_kelurahan(Request $request){
        $data_kelurahan = DB::table('kelurahan')->where('nama','like','%'.$request->q.'%')->get();
        $result = [];
        foreach ($data_kelurahan as $key => $value) {
            $result[] = $this->data_keluran($value->id_kel);
        }
        return response()->json([
            'result' => $result
        ]);
    }

    public function tambah_pasien_baru(){
        $gol_darah = DB::table('data_golongandarah')->get();
        $data_status = DB::table('data_status')->get();
        $data_pekerjaan = DB::table('data_pekerjaan')->get();
        $pasien_penanggungjawab = DB::table('pasien_penanggungjawab')->get();
        $data_agama = DB::table('data_agama')->get();
        $data_etnis = DB::table('data_etnis')->get();
        $data_pendidikan = DB::table('data_pendidikan')->get();
        $data_hubungan = DB::table('data_hubungan')->get();
        $data_hambatan = DB::table('data_hambatan')->get();
        return view('pasien.tambah_pasien_baru',compact('gol_darah','data_status','data_pekerjaan','pasien_penanggungjawab','data_agama','data_etnis','data_pendidikan','data_hubungan','data_hambatan'));
    }
}
