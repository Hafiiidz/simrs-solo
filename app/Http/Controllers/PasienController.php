<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Obat\Obat;
use Illuminate\Http\Request;
use App\Models\Pasien\Pasien;
use App\Helpers\MakeRequestHelper;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Helpers\SatusehatPasienHelper;
use App\Helpers\SatusehatResourceHelper;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\Vclaim\VclaimPesertaHelper;

class PasienController extends Controller
{
    
    public function rekammedis_detail($id){
        $pasien = Pasien::find($id);
        $detail_rekap_medis = DB::table('demo_detail_rekap_medis')
        ->select([
            'demo_detail_rekap_medis.*',
        ])
        ->join('rawat','rawat.id','=','demo_detail_rekap_medis.idrawat')
        ->where('no_rm',$pasien?->no_rm)
        ->whereIn('rawat.status',[4])
        ->orderBy('id','desc')
        ->first();
        $detail_rekap_medis_all = DB::table('demo_detail_rekap_medis')
        ->select([
            'demo_detail_rekap_medis.*',
        ])
        ->join('rawat','rawat.id','=','demo_detail_rekap_medis.idrawat')
        ->where('no_rm',$pasien?->no_rm)
        ->whereIn('rawat.status',[4])
        ->orderBy('id','desc')
        ->limit(5)
        ->get();
        // $pfisik = json_decode($detail_rekap_medis->pemeriksaan_fisik);
        $pemeriksaan_fisik = json_decode($detail_rekap_medis?->pemeriksaan_fisik) ?? 0;
        $terapi_obat = $detail_rekap_medis?->terapi_obat ?? 'null';
        $icdx = $detail_rekap_medis->icdx ?? 'null';
        // return $terapi_obat;
        $obat = Obat::with('satuan')->where('nama_obat','!=','')->orderBy('obat.nama_obat', 'asc')->get();
        // return $pemeriksaan_fisik;
        $soap_icdx = DB::table('soap_rajalicdx')
        ->select([
            'soap_rajalicdx.icd10',
            'rawat.tglmasuk',
        ])
        ->join('rawat','rawat.id','=','soap_rajalicdx.idrawat')
        ->where('idrm',$pasien?->id)
        ->where('idjenisdiagnosa',1)
        ->orderBy('soap_rajalicdx.id','desc')
        ->limit(3)
        ->get();
        $penunjang = DB::table('demo_permintaan_penunjang')->where('no_rm', $pasien?->no_rm)->where('status_pemeriksaan','Selesai')->orderBy('created_at','desc')->limit(5)->get();
        $radiologi = DB::table('radiologi_tindakan')->get();
        $lab = DB::table('laboratorium_pemeriksaan')->get();
        $fisio = DB::table('tarif')->where('idkategori', 8)->get();
        if(request()->ajax()){
            $query = DB::table('rawat')->select([
                'rawat_jenis.jenis', #idjenisrawat
                'rawat_bayar.bayar',#idbayar
                'poli.poli',#idpoli
                'dokter.nama_dokter',#iddokter
                'rawat.id',
                'rawat.tglmasuk',
                'rawat.tglpulang',
                'rawat_status.status'#status
            ])
            ->join('rawat_jenis', 'rawat.idjenisrawat', '=', 'rawat_jenis.id')
            ->join('rawat_bayar', 'rawat.idbayar', '=', 'rawat_bayar.id')
            ->join('poli', 'rawat.idpoli', '=', 'poli.id')
            ->join('dokter', 'rawat.iddokter', '=', 'dokter.id')
            ->join('rawat_status', 'rawat.status', '=', 'rawat_status.id')
            ->where('no_rm',$pasien->no_rm)
            ->orderBy('tglmasuk','desc')
            ;

            return DataTables::query($query)->make(true);
        }
        // return $soap_icdx;
        return view('pasien.detail',compact('pasien','detail_rekap_medis','pemeriksaan_fisik','soap_icdx','penunjang','radiologi','lab','fisio','terapi_obat','obat','icdx','detail_rekap_medis_all'));
    }
    public function index()
    {
        if (request()->ajax()) {
            $pasien = Pasien::query()->orderBy('id','desc');

            return DataTables::of($pasien)
                ->addColumn('opsi', function (Pasien $pasien) {
                    return '<a href="' . route('pasien.rekammedis_detail', $pasien->id) . '" class="btn btn-sm btn-success">Rekam Medis</a>';
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
        $pasien = new Pasien();
        $pasien->genKode();

        $gol_darah = DB::table('data_golongandarah')->get();
        $data_status = DB::table('data_status')->get();
        $data_pekerjaan = DB::table('data_pekerjaan')->get();
        $pasien_penanggungjawab = DB::table('pasien_penanggungjawab')->get();
        $data_agama = DB::table('data_agama')->get();
        $data_etnis = DB::table('data_etnis')->get();
        $data_pendidikan = DB::table('data_pendidikan')->get();
        $data_hubungan = DB::table('data_hubungan')->get();
        $data_hambatan = DB::table('data_hambatan')->get();
        return view('pasien.tambah_pasien_baru',[
            'kodepasien'=>$pasien->kodepasien
        ],compact('gol_darah','data_status','data_pekerjaan','pasien_penanggungjawab','data_agama','data_etnis','data_pendidikan','data_hubungan','data_hambatan'));
    }
    public function store(Request $request){
        // return $request->all();
        $validatedData = $request->validate([
            'no_rm' => 'required|string|max:255',
            'nik' => 'required|string|max:255',
            'bpjs' => 'required|string|max:255',
            'nama_pasien' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:1',
            'golongan_darah' => 'required|string|max:2',
            'tempat_lahir' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'no_hp' => 'required|string|max:15',
            'email' => 'nullable|string|email|max:255',
            'kepesertaan_bpjs' => 'required|string|max:255',
            'status_pasien' => 'required|string|max:1',
            'id_agama' => 'required|integer',
            'id_etnis' => 'required|integer',
            'id_pendidikan' => 'required|integer',
            'id_hubungan_pernikakan' => 'required|integer',
            'id_hambatan' => 'required|integer',
        ]);

        DB::beginTransaction();
        try {
            $no_rm = explode('-', $request->no_rm);
            $data_alamat = MakeRequestHelper::get_prov($request->id_kel);
            $tanggal = date('Y-m-d H:i:s',strtotime('+7 hour',strtotime(date('Y-m-d H:i:s'))));				
            $date1=date_create($request->tgl_lahir);
            $date2=date_create($tanggal);
            $diff=date_diff($date1,$date2);

            date_default_timezone_set('UTC');
            $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
            $pasienId = DB::table('pasien')->insertGetId([
                'kodepasien' => $request->no_rm,
                'no_rm' => $no_rm[1],
                'nik' => $request->nik ?? $tStamp.$no_rm[1],
                'no_bpjs' => $request->bpjs ?? $tStamp.$no_rm[1],
                'nama_pasien' => $request->nama_pasien,
                'jenis_kelamin' => $request->jenis_kelamin,
                'idgolongan_darah' => $request->golongan_darah,
                'tempat_lahir' => $request->tempat_lahir,
                'tgllahir' => $request->tgl_lahir,
                'nohp' => $request->no_hp,
                'email' => $request->email,
                'kepesertaan_bpjs' => $request->kepesertaan_bpjs,
                'status_pasien' => $request->status_pasien,
                'idagama' => $request->id_agama,
                'idetnis' => $request->id_etnis,
                'idpendidikan' => $request->id_pendidikan,
                'idhubungan' => $request->id_hubungan_pernikakan,
                'idhambatan' => $request->id_hambatan,
                'penanggung_jawab' => $request->penanggung_jawab,
                'idsb_penanggungjawab' => $request->hubungan,
                'nohp_penanggungjawab' => $request->no_tlp_penanggung_jawab,
                'alamat_penanggunjawab' => $request->alamat_penanggung_jawab,
                'pangkat' => $request->pangkat,
                'kesatuan' => $request->kesatuan,
                'nrp' => $request->nrp,
                'idpekerjaan' => $request->id_pekerjaan,
                'barulahir' => $request->baru_lahir,
                'pasien_lama' => $request->pasien_lama,
                'usia_tahun' => $diff->format("%y"),
                'usia_bulan' => $diff->format("%m"),
                'usia_hari' => $diff->format("%d"),
                'jamdaftar'=>date('H:i:s'),
                'kunjungan_terakhir'=>date('Y-m-d'),
            ]);

            DB::table('pasien_alamat')->insert([
                'idpasien' => $pasienId,
                'idprov' => $data_alamat['id_prov'],
                'idkab' => $data_alamat['id_kab'],
                'idkel' => $data_alamat['id_kel'],
                'idkec' => $data_alamat['id_kec'],
                'no_rm' => $no_rm[1],
                'alamat' => $request->alamat,
                'updated' => now(),
                'user_update' => auth()->user()->id,
                'utama' => 1
            ]);

            DB::table('pasien_status')->insert([
                'idpasien' => $pasienId,
                'idstatus' => $request->status_pasien,
                'pangkat' => $request->pangkat,
                'kesatuan' => $request->kesatuan,
                'nrp' => $request->nrp,
                'keterangan' => $request->keterangan,
                'no_rm' => $no_rm[1],
            ]);

            $get_satu_sehat = SatusehatPasienHelper::searchPasienNik($request->nik);
            if (isset($get_satu_sehat['total']) && $get_satu_sehat['total'] > 0) {
                Pasien::find($pasienId)->update([
                    'ihs' => $get_satu_sehat['entry'][0]['resource']['id']
                ]);
            } else {
                SatusehatPasienHelper::add_pasien($no_rm[1]);
            }

            DB::commit();
            return redirect(route('rekap-medis-index',$pasienId))->with('berhasil', 'Data berhasil di input');
        } catch (Exception $e) {
            DB::rollBack();
            return  $e->getMessage();
            return back()->with('gagal', $e->getMessage());
        }
    }

    

    public function get_bpjs_by_nik(Request $request)
    {
        // $getPeserta = VclaimPesertaHelper::getPesertaBPJS($request->nik,date('Y-m-d'));
        // return $getPeserta;
        // Validasi input
        $request->validate([
            'nik' => 'required|string|max:16'
        ]);
        $nik = $request->nik;
        if($request->jenis == 'nik'){
            $get_data = VclaimPesertaHelper::getPesertaNIK($request->nik,date('Y-m-d'));
        }else{
            $get_data = VclaimPesertaHelper::getPesertaBPJS($request->nik,date('Y-m-d'));
        }
        
        if (isset($get_data['metaData']['code']) && $get_data['metaData']['code'] == '200') {
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $get_data['response']
            ], 200);
        } else {
            $statusCode = isset($get_data['metaData']['code']) ? (int) $get_data['metaData']['code'] : 500;
            $message = isset($get_data['metaData']['message']) ? $get_data['metaData']['message'] : 'Terjadi kesalahan';
            return response()->json([
                'status' => false,
                'message' => $message
            ], $statusCode);
        }

    }
    
}
