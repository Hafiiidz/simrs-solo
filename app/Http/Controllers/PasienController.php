<?php

namespace App\Http\Controllers;

use Exception;
use Svg\Tag\Rect;
use Carbon\Carbon;
use App\Models\Poli;
use App\Models\Rawat;
use App\Models\Dokter;
use App\Models\Obat\Obat;
use App\Models\DokterKuota;
use App\Models\DokterJadwal;
use Illuminate\Http\Request;
use App\Models\Pasien\Pasien;
use App\Helpers\MakeRequestHelper;
use Illuminate\Support\Facades\DB;
use App\Helpers\Antrol\WsBpjsHelper;
use App\Helpers\Satusehat\Resource\EncounterHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use App\Helpers\SatusehatPasienHelper;
use App\Helpers\Vclaim\VclaimSepHelper;
use App\Helpers\SatusehatResourceHelper;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\Vclaim\VclaimPesertaHelper;
use App\Helpers\Vclaim\VclaimRujukanHelper;
use App\Helpers\Vclaim\VclaimMonitoringHelper;
use App\Helpers\Vclaim\VclaimRencanaKontrolHelper;

class PasienController extends Controller
{

    public function rekammedis_detail($id)
    {
        $pasien = Pasien::find($id);
        $detail_rekap_medis = DB::table('demo_detail_rekap_medis')
            ->select([
                'demo_detail_rekap_medis.*',
            ])
            ->join('rawat', 'rawat.id', '=', 'demo_detail_rekap_medis.idrawat')
            ->where('no_rm', $pasien?->no_rm)
            ->whereIn('rawat.status', [4])
            ->orderBy('id', 'desc')
            ->first();
        $detail_rekap_medis_all = DB::table('demo_detail_rekap_medis')
            ->select([
                'demo_detail_rekap_medis.*',
            ])
            ->join('rawat', 'rawat.id', '=', 'demo_detail_rekap_medis.idrawat')
            ->where('no_rm', $pasien?->no_rm)
            ->whereIn('rawat.status', [4])
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();
        // $pfisik = json_decode($detail_rekap_medis->pemeriksaan_fisik);
        $pemeriksaan_fisik = json_decode($detail_rekap_medis?->pemeriksaan_fisik) ?? 0;
        $terapi_obat = $detail_rekap_medis?->terapi_obat ?? 'null';
        $icdx = $detail_rekap_medis->icdx ?? 'null';
        // return $terapi_obat;
        $obat = Obat::with('satuan')->where('nama_obat', '!=', '')->orderBy('obat.nama_obat', 'asc')->get();
        // return $pemeriksaan_fisik;
        $soap_icdx = DB::table('soap_rajalicdx')
            ->select([
                'soap_rajalicdx.icd10',
                'rawat.tglmasuk',
            ])
            ->join('rawat', 'rawat.id', '=', 'soap_rajalicdx.idrawat')
            ->where('idrm', $pasien?->id)
            ->where('idjenisdiagnosa', 1)
            ->orderBy('soap_rajalicdx.id', 'desc')
            ->limit(3)
            ->get();
        $penunjang = DB::table('demo_permintaan_penunjang')->where('no_rm', $pasien?->no_rm)->where('status_pemeriksaan', 'Selesai')->orderBy('created_at', 'desc')->limit(5)->get();
        $radiologi = DB::table('radiologi_tindakan')->get();
        $lab = DB::table('laboratorium_pemeriksaan')->get();
        $fisio = DB::table('tarif')->where('idkategori', 8)->get();
        if (request()->ajax()) {
            $query = DB::table('rawat')->select([
                'rawat_jenis.jenis', #idjenisrawat
                'rawat_bayar.bayar', #idbayar
                'poli.poli', #idpoli
                'dokter.nama_dokter', #iddokter
                'rawat.id',
                'rawat.tglmasuk',
                'rawat.no_sep',
                'rawat.tglpulang',
                'rawat_status.status'
            ])
                ->join('rawat_jenis', 'rawat.idjenisrawat', '=', 'rawat_jenis.id')
                ->join('rawat_bayar', 'rawat.idbayar', '=', 'rawat_bayar.id')
                ->join('poli', 'rawat.idpoli', '=', 'poli.id')
                ->join('dokter', 'rawat.iddokter', '=', 'dokter.id')
                ->join('rawat_status', 'rawat.status', '=', 'rawat_status.id')
                ->where('no_rm', $pasien->no_rm)
                ->orderBy('tglmasuk', 'desc');

            return DataTables::query($query)->make(true);
        }
        // return $soap_icdx;
        $cek_credential = DB::table('demo_erm_check')->where('pasien_id', $pasien->id)->where('user_id', auth()->user()->id)->whereDate('date_time', date('Y-m-d'))->count();
        
        return view('pasien.detail', compact('cek_credential', 'pasien', 'detail_rekap_medis', 'pemeriksaan_fisik', 'soap_icdx', 'penunjang', 'radiologi', 'lab', 'fisio', 'terapi_obat', 'obat', 'icdx', 'detail_rekap_medis_all'));
    }
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $pasien = Pasien::query()->orderBy('id', 'desc');

            return DataTables::of($pasien)
                ->addColumn('opsi', function (Pasien $pasien) {
                    return '<a href="' . route('pasien.rekammedis_detail', $pasien->id) . '" class="btn btn-sm btn-success">Rekam Medis</a>';
                })
                ->rawColumns(['opsi'])
                ->filter(function ($instance) use ($request) {
                    if ($request->get('no_rm') != '') {
                        $instance->where('no_rm', $request->get('no_rm'));
                    }
                    if ($request->get('nik') != '') {
                        $instance->where('nik', $request->get('nik'));
                    }
                    if ($request->get('no_bpjs') != '') {
                        $instance->where('no_bpjs', $request->get('no_bpjs'));
                    }
                    if ($request->get('nama') != '') {
                        $nama = $request->get('nama');
                        $instance->where('nama_pasien', 'LIKE', "%$nama%");
                    }
                    if (!empty($request->get('search'))) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->get('search');
                            $w->orWhere('no_rm', 'LIKE', "%$search%")
                                ->orWhere('nama_pasien', 'LIKE', "%$search%");
                        });
                    }
                })
                ->make();
        }
        return view('pasien.index');
    }

    function data_keluran($id_kel)
    {
        $data_kelurahan = DB::table('kelurahan')->where('id_kel', $id_kel)->first();
        $data_kecamatan = DB::table('kecamatan')->where('id_kec', $data_kelurahan->id_kec)->first();
        $data_kota = DB::table('kabupaten')->where('id_kab', $data_kecamatan->id_kab)->first();
        $provinsi = DB::table('provinsi')->where('id_prov', $data_kota->id_prov)->first();

        return [
            'id' => $data_kelurahan->id_kel,
            'text' => $data_kelurahan->nama . ', ' . $data_kecamatan->nama . ', ' . $data_kota->nama . ', ' . $provinsi->nama
        ];
    }

    public function cari_kelurahan(Request $request)
    {
        $data_kelurahan = DB::table('kelurahan')->where('nama', 'like', '%' . $request->q . '%')->get();
        $result = [];
        foreach ($data_kelurahan as $key => $value) {
            $result[] = $this->data_keluran($value->id_kel);
        }
        return response()->json([
            'result' => $result
        ]);
    }
    public function tambah_pasien_baru()
    {
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
        return view('pasien.tambah_pasien_baru', [
            'kodepasien' => $pasien->kodepasien
        ], compact('gol_darah', 'data_status', 'data_pekerjaan', 'pasien_penanggungjawab', 'data_agama', 'data_etnis', 'data_pendidikan', 'data_hubungan', 'data_hambatan'));
    }
    public function store(Request $request)
    {
        // return back()->with('gagal', 'gagal');
        // return $request->all();
        // $validatedData = $request->validate([
        //     'no_rm' => 'required|string|max:255',
        //     'nik' => 'required|string|max:255',
        //     'bpjs' => 'required|string|max:255',
        //     'nama_pasien' => 'required|string|max:255',
        //     'jenis_kelamin' => 'required|string|max:1',
        //     'golongan_darah' => 'required|string|max:2',
        //     'tempat_lahir' => 'required|string|max:255',
        //     'tgl_lahir' => 'required|date',
        //     'no_hp' => 'required|string|max:15',
        //     'email' => 'nullable|string|email|max:255',
        //     'kepesertaan_bpjs' => 'required|string|max:255',
        //     'status_pasien' => 'required|string|max:1',
        //     'id_agama' => 'required|integer',
        //     'id_etnis' => 'required|integer',
        //     'id_pendidikan' => 'required|integer',
        //     'id_hubungan_pernikakan' => 'required|integer',
        //     'id_hambatan' => 'required|integer',
        // ]);

        DB::beginTransaction();
        try {
            $no_rm = explode('-', $request->no_rm);
            $data_alamat = MakeRequestHelper::get_prov($request->id_kel);
            $tanggal = date('Y-m-d H:i:s', strtotime('+7 hour', strtotime(date('Y-m-d H:i:s'))));
            $date1 = date_create($request->tgl_lahir);
            $date2 = date_create($tanggal);
            $diff = date_diff($date1, $date2);

            date_default_timezone_set('UTC');
            $tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
            $pasienId = DB::table('pasien')->insertGetId([
                'kodepasien' => $request->no_rm,
                'no_rm' => $no_rm[1],
                'nik' => $request->nik ?? $tStamp . $no_rm[1],
                'no_bpjs' => $request->bpjs ?? $tStamp . $no_rm[1],
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
                'jamdaftar' => date('H:i:s'),
                'kunjungan_terakhir' => date('Y-m-d'),
            ]);

            DB::table('pasien_alamat')->insert([
                'idpasien' => $pasienId,
                'idprov' => $data_alamat['id_prov'],
                'idkab' => $data_alamat['id_kab'],
                'idkel' => $data_alamat['id_kel'],
                'idkec' => $data_alamat['id_kec'],
                'no_rm' => $no_rm[1],
                'alamat' => $request->alamat,
                'updated' => date('Y-m-d H:i:s'),
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
            return redirect(route('pasien.rekammedis_detail', $pasienId))->with('berhasil', 'Data berhasil di input');
        } catch (Exception $e) {
            DB::rollBack();
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
        if ($request->jenis == 'nik') {
            $get_data = VclaimPesertaHelper::getPesertaNIK($request->nik, date('Y-m-d'));
        } else {
            $get_data = VclaimPesertaHelper::getPesertaBPJS($request->nik, date('Y-m-d'));
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

    public function tambah_kunjungan($id, $jenis)
    {
        \Carbon\Carbon::setLocale('id');
        $pasien = Pasien::find($id);
        $poli = Poli::get();
        $cek_finger_print = VclaimSepHelper::get_finger_print($pasien->no_bpjs, date('Y-m-d'));
        // return $cek_finger_print;
        $cek_general_concent = DB::table('demo_consent')->where('idpasien',$pasien->id)->whereDate('period',date('Y-m-d'))->first();
        // return Carbon::();
        return view('pasien.tambah-kunjungan', compact('pasien', 'poli', 'cek_finger_print','cek_general_concent'));
    }

    public function check_password(Request $request)
    {
        $password = $request->input('password');
        $user = Auth::user();

        if (Hash::check($password, $user->password_hash)) {
            $pasien = Pasien::find($request->pasien_id);
            // return $pasien;
            SatusehatPasienHelper::searchPasienByNik($pasien->nik);
            DB::table('demo_erm_check')->insert([
                'user_id' => auth()->user()->id,
                'pasien_id' => $request->pasien_id,
                'date_time' => date('Y-m-d H:i:s'),
                'aksi' => 'Membuka data pasien RM ' . $pasien->no_rm . ''
            ]);
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'fail ' . $password], 401);
        }
    }

    public function pilih_rujukan_faskes(Request $request)
    {
        $hitung_sep = VclaimRujukanHelper::get_jumlah_rujukan($request->rujukan, $request->faskes);
        if ($request->faskes == 1) {
            $get_rujukan = VclaimRujukanHelper::get_rujukan_norujukan($request->rujukan);
        } else {
            $get_rujukan = VclaimRujukanHelper::get_rujukan_norujukan_rs($request->rujukan);
        }
        if ($hitung_sep['response']['jumlahSEP'] > 0) {
            $jumlah_sep = $hitung_sep['response']['jumlahSEP'] + 1;
            $keterangan = 'Peserta ini merupakan peserta terindikasi sebagai Kontrol Ulang/Rujuk Internal. Kunjungan ke- ' . $jumlah_sep . ' Dengan Rujukan yang sama.';
            $data = View::make('pasien.form.rujukan-kunjungan-kontrol', compact('request', 'keterangan', 'get_rujukan'))->render();
        } else {
            $jumlah_sep = $hitung_sep['response']['jumlahSEP'];
            $keterangan = null;
            $data = View::make('pasien.form.rujukan-kunjungan-pertama', compact('request', 'get_rujukan'))->render();
        }

        $get_poli = Poli::where('kode',$get_rujukan['response']['rujukan']['poliRujukan']['kode'])->first();
        $poli = Poli::where('ket',1)->get();
        $options = '';
        foreach ($poli as $p) {
            $selected = $p->id == $get_poli->id ? 'selected' : '';
            $options .= '<option value="' . $p->id . '" ' . $selected . '>' . $p->poli . '</option>';
        }
        return response()->json([
            'status' => 'success',
            'data_rujukan' => $get_rujukan['response'],
            'data_poli_tujuan' => $get_poli,
            'data_poli' => $options,
            'keterangan' => $keterangan,
            'data' => $data
        ]);
    }
    public function get_pilih_dokter(Request $request, $jenis)
    {
        if ($jenis == 2) {
            #bpjs
            $dokter = Dokter::where('kode_dpjp', $request->iddokter)->first();
        } else {
            $dokter = Dokter::where('id', $request->iddokter)->first();
        }

        if ($dokter) {
            return [
                'status' => 'success',
                'data' => [
                    'iddokter' => $dokter->id,
                    'idpoli' => $dokter->idpoli,
                    'nama_dokter' => $dokter->nama_dokter,
                ]

            ];
        } else {
            return [
                'status' => 'failed',
                'data' => null
            ];
        }
    }
    public function get_surat_kontrol(Request $request)
    {
        $bulan = date('m');
        $tahun = date('Y');
        $no_kartu = $request->no_kartu;
        $response = VclaimRencanaKontrolHelper::getDatabynomor($bulan, $tahun, $no_kartu, 2);
        return View::make('pasien.modal.list-surat-kontrol', compact('response'));
    }
    public function get_rujukan_faskes(Request $request)
    {
        if ($request->faskes == 1) {
            $response = VclaimRujukanHelper::get_rujukan_nokartu_multiple($request->no_bpjs);
        } else {
            $response = VclaimRujukanHelper::get_rujukan_nokartu_multiple_rs($request->no_bpjs);
        }
        // return $response['metaData'];
        if (isset($response) && $response['metaData']['code'] == 200) {
            $data = View::make('pasien.table.list-rujukan', compact('response'))->render();
            return response()->json([
                'status' => 'success',
                'code' => $response['metaData']['code'],
                'message' => $response['metaData']['message'],
                'response' => $data
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'code' => $response['metaData']['code'] ?? 201,
                'message' => $response['metaData']['message'] ?? 'Server Error'
            ]);
        }
    }
    public function get_jadwal_dokter(Request $request)
    {
        $poli = Poli::find($request->poli);
        $date = date('Y-m-d');

        // Convert the date to a timestamp
        $timestamp = strtotime($date);

        // Get the numeric representation of the day of the week
        $dayNumber = date('N', $timestamp);
        // $kuota = DB::table('dokter_kuota')->where('idpoli',$request->poli)->where('tgl',$request->tgl)->first();
        if ($request->poli == 1) {
            $poliId = 1;
        } else {
            if ($request->penanggung == 2) {
                $results = WsBpjsHelper::referensi_jadwaldokter($poli->kode, $date);
                // return $poli->kode;
                if ($results['metadata']['code'] == 200) {
                    return View::make('pasien.modal.jadwal-dokter-bpjs', compact('results'));
                }
            }

            $poliId = $poli->id;
        }

        $results = DB::table('dokter_jadwal')
            ->join('dokter', 'dokter.id', '=', 'dokter_jadwal.iddokter')
            ->join('poli', 'poli.id', '=', 'dokter_jadwal.idpoli')
            ->join('hari', 'hari.id', '=', 'dokter_jadwal.idhari')
            ->select(
                'dokter.nama_dokter',
                'poli.poli',
                'hari.hari',
                'dokter_jadwal.iddokter',
                'dokter_jadwal.kuota',
                'dokter_jadwal.jam_mulai',
                'dokter_jadwal.jam_selesai'
            )
            ->where('dokter_jadwal.idpoli', $poliId)
            ->where('dokter.status', 1)
            ->where('dokter_jadwal.idhari', $dayNumber)
            ->get();

        return View::make('pasien.modal.jadwal-dokter', compact('results'));
    }

    public function get_pilih_nomer(Request $request)
    {
        $poli = Poli::where('kode', $request->poli)->first();
        $dokter = Dokter::where('kode_dpjp', $request->dokter)->first();
        $data_poli = Poli::where('ket', 1)->get();
        $sep_asal_kontrol = VclaimRencanaKontrolHelper::getDatabysep($request->sep);
        $text = 'Anda sudah melakukan kunjungan dengan (flaging) prosedur non berkelanjutan (pemeriksaan penunjang) '.$sep_asal_kontrol['response']['poli'].' pada tgl '.$sep_asal_kontrol['response']['tglSep'];
        $options = '';
        foreach ($data_poli as $p) {
            $selected = $p->id == $poli->id ? 'selected' : '';
            $options .= '<option value="' . $p->id . '" ' . $selected . '>' . $p->poli . '</option>';
        }

        return [
            'status' => 'success',
            'data' => [
                'no_surat' => $request->no_surat,
                'tgl_surat' => $request->tglsurat,
                'poli' => $poli->poli,
                'idpoli' => $poli->id,
                'iddokter' => $dokter->id,
                'nama_dokter' => $dokter->nama_dokter,
                'kode_dokter' => $dokter->kode_dpjp,
                'nama_dpjp' => $dokter->nama_dokter,
                'poli_option'=>$options,
                'sep_asal_kontrol'=>$text
            ]
        ];
    }
    public function store_kunjungan(Request $request)
    {
        // return $request->all();
        if ($request->sep == 1) {
            // if ($request->icdx == null) {
            //     return response()->json([
            //         'status' => 'failed',
            //         'message' => 'ICD X Harus diisi'
            //     ]);
            // }
            if ($request->status_kecelakaan == '-') {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Status Kecelakaan Harus diisi'
                ]);
            }
        }
        // return $request->all();
        DB::beginTransaction();

        try {
            $pasien = Pasien::where('no_rm', $request->no_rm)->first();
            $poli = Poli::find($request->idpoli);
            $dokter = Dokter::find($request->iddokter);
            $kode_kunjungan = date('dmY') . rand(1000, 9999);
            if ($request->jenis_rawat == 1) {
                $kode = 'RJ';
                $ruangan = 2;
            } elseif ($request->jenis_rawat == 3) {
                $kode = 'UGD';
                $ruangan = 1;
            }
            $insert_rawat_kunjungan = DB::table('rawat_kunjungan')->insertGetId([
                'idkunjungan' => $kode_kunjungan,
                'no_rm' => $pasien->no_rm,
                'tgl_kunjungan' => date('Y-m-d'),
                'jam_kunjungan' => date('H:i:s'),
                'iduser' => auth()->user()->id,
                'usia_kunjungan' => $pasien->usia_tahun,
                'status' => 1,
                'idpasien' => $pasien->id,
            ]);

            DB::table('transaksi')->insert([
                'idtransaksi' => 'TRX' . date('dmY') . rand(1000, 9999),
                'tgltransaksi' => date('Y-m-d H:i:s'),
                'iduser' => auth()->user()->id,
                'status' => 1,
                'idkunjungan' => $insert_rawat_kunjungan,
                'no_rm' => $pasien->no_rm,
                'tgl_masuk' => $request->tglmasuk,
                'kode_kunjungan' => $kode_kunjungan,
                'idpasien' => $pasien->id,
                'id_bayar' => $request->penanggung
            ]);
            $kode_booking = $kode . date('Ymd') . rand(1000, 9999);
            $antrian = MakeRequestHelper::genAntri($request->idpoli, $request->iddokter, null, $request->tglmasuk);
            $rawat = DB::table('rawat')->insertGetId([
                'idrawat' => $kode_booking,
                'idkunjungan' => $kode_kunjungan,
                'idjenisrawat' => $request->jenis_rawat,
                'no_rm' => $pasien->no_rm,
                'idpoli' => $request->idpoli,
                'iddokter' => $request->iddokter,
                'idruangan' => $ruangan,
                'idbayar' => $request->penanggung,
                'tglmasuk' => $request->tglmasuk . ' ' . date("H:i:s"),
                'status' => 1,
                'icdx' => $request->icdx ?? null,
                'anggota' => $request->anggota ?? 0,
                'no_antrian' => $antrian
            ]);



            // return $dokter_kuota;
            // return $request->penanggung'
            if ($request->jenis_rawat == 1) {

                $date = date('Y-m-d');
                $timestamp = strtotime($date);
                // $dayNumber = 5;
                $dayNumber = date('N', $timestamp);
                $dokter_jadwal = DB::table('dokter_jadwal')->where('iddokter', $request->iddokter)->where('idhari', $dayNumber)->where('idpoli', $request->idpoli)->first();
                $millisecond = Carbon::now()->timestamp * 1000 + Carbon::now()->microsecond / 1000;

                $jadwal = DokterJadwal::where(['iddokter' => $request->iddokter, 'idhari' => $dayNumber])->first();
                // return $jadwal;
                if (!$jadwal) {
                    session()->flash('danger', 'Jadwal Dokter Tidak ditemukan');
                    // return redirect()->back();
                }

                $kuota = DokterKuota::firstOrNew(
                    ['iddokter' => $request->iddokter, 'idhari' => $dayNumber, 'tgl' => date('Y-m-d', strtotime($request->tglmasuk))],
                    ['kuota' => $jadwal->kuota, 'sisa' => $jadwal->kuota, 'terdaftar' => 0, 'status' => 1]
                );

                if ($kuota->sisa > 0) {
                    $kuota->sisa -= 1;
                    $kuota->terdaftar += 1;
                    $kuota->save();
                }

                // Additional actions can be added here

                $dokter_kuota = DB::table('dokter_kuota')->where('iddokter', $request->iddokter)->where('idhari', $dayNumber)->where('idpoli', $request->idpoli)->where('tgl', date('Y-m-d', strtotime($request->tglmasuk)))->first();
                // return $dokter_kuota;
                $data = [
                    "kodebooking" => $kode_booking,
                    "jenispasien" => $request->penanggung == 2 ? 'JKN' : 'NON JKN',
                    "nomorkartu" => $request->penanggung == 2 ? $pasien->no_bpjs : '',
                    "nik" => $pasien->nik,
                    "nohp" => $pasien->nohp ?? 0,
                    "kodepoli" => $poli->kode,
                    "namapoli" => $poli->poli,
                    "pasienbaru" => 0,
                    "norm" => $pasien->no_rm,
                    "tanggalperiksa" => $request->tglmasuk,
                    "kodedokter" => $dokter->kode_dpjp,
                    "namadokter" => $dokter->nama_dokter,
                    "jampraktek" => date('H:i', strtotime($dokter_jadwal->jam_mulai)) . '-' . date('H:i', strtotime($dokter_jadwal->jam_selesai)),
                    "jeniskunjungan" => $request->kunjungan ?? 1,
                    "nomorreferensi" =>  $request->penanggung == 2 ? '0171R0010824K000007' : '0151B1070622P002358',
                    "nomorantrean" => $poli->kode_antrean . '-' . substr($antrian, -3),
                    "angkaantrean" => (int) ltrim(substr($antrian, -3), '0'),
                    "estimasidilayani" => round(microtime(true) * 1000),
                    "sisakuotajkn" =>  $dokter_kuota->sisa ?? $jadwal->kuota - 1,
                    "kuotajkn" => $dokter_kuota->kuota ?? $jadwal->kuota,
                    "sisakuotanonjkn" => $dokter_kuota->sisa ?? $jadwal->kuota - 1,
                    "kuotanonjkn" => $dokter_kuota->kuota ?? $jadwal->kuota,
                    "keterangan" => "Peserta harap 30 menit lebih awal guna pencatatan administrasi."
                ];

                $data_antrian = [
                    "kodebooking" => $kode_booking,
                    "taskid" => 3,
                    "waktu" => round(microtime(true) * 1000),
                ];
                // return $data;
                WsBpjsHelper::post_tambah_antrean($data);
                WsBpjsHelper::post_update_antrean($data_antrian);
            }
            if ($request->sep == 1) {
                if($request->no_rujukan){
                    $rujukan = VclaimRujukanHelper::get_rujukan_norujukan($request->no_rujukan);
                    $tanggal = $rujukan['response']['rujukan']['tglKunjungan'];
                }else{
                    $tanggal = "";
                }
                $icdx = explode(" - ", $request->icdx ?? $request->kode);
                $kode = $icdx[0];
                $nama = $icdx[1];
                $sep_manual = [
                    'request' => [
                        't_sep' => [
                            'noKartu' => $pasien->no_bpjs,
                            'tglSep' => $request->tglmasuk,
                            'ppkPelayanan' => env('KODE_FASKES'),
                            'jnsPelayanan' => 2,
                            "klsRawat" => [
                                "klsRawatHak" => 3,
                                "klsRawatNaik" => "",
                                "pembiayaan" => "",
                                "penanggungJawab" => ""
                            ],
                            'noMR' => $pasien->no_rm,
                            'rujukan' => [
                                "asalRujukan" => $request->faskes ?? 2,
                                "tglRujukan" => $tanggal,
                                "noRujukan" => $request->no_rujukan ?? "",
                                "ppkRujukan" => $request->kode_faskes  ?? ""
                            ],
                            'catatan' => '-',
                            'diagAwal' => $kode,
                            'poli' => [
                                'tujuan' => $poli->kode,
                                'eksekutif' => '0'
                            ],
                            'cob' => [
                                'cob' => '0'
                            ],
                            'katarak' => [
                                'katarak' => '0'
                            ],
                            'jaminan' => [
                                'lakaLantas' => '0',
                                'penjamin' => [
                                    'penjamin' => '0',
                                    'tglKejadian' => '',
                                    'keterangan' => '',
                                    'suplesi' => [
                                        'suplesi' => '0',
                                        'noSepSuplesi' => '0',
                                        'lokasiLaka' => [
                                            'kdPropinsi' => '',
                                            'kdKabupaten' => '',
                                            'kdKecamatan' => ''
                                        ]
                                    ]
                                ]
                            ],
                            "tujuanKunj" =>0,
                            "flagProcedure" => $request->prosedur ?? "",
                            "kdPenunjang" => $request->prosedurTidakBerkelanjutan ?? "",
                            "assesmentPel" => $request->alasanTidakSelesai ?? "",
                            "skdp" => [
                                "noSurat" => $request->no_surat ?? "",
                                "kodeDPJP" => $request->txtkddpjp ?? "",
                            ],
                            "dpjpLayan" => $dokter->kode_dpjp,
                            "noTelp" => $pasien->nohp,
                            "user" => auth()->user()->username
                        ]
                    ]
                ];
                // return $sep_manual;
                $sep = VclaimSepHelper::getInsertSep($sep_manual);
                // return $sep;
                if (isset($sep['metaData']) && $sep['metaData']['code'] != 200) {
                    return response()->json([
                        'status' => 'failed',
                        'message' => $sep['metaData']['message'] ?? 'Server Error'
                    ]);
                }

                DB::table('rawat')->where('id', $rawat)->update([
                    'no_sep' => $sep['response']['sep']['noSep']
                ]);

                EncounterHelper::create($rawat);
                DB::commit();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Data Berhasil disimpan | No SEP : ' . $sep['response']['sep']['noSep']
                ]);
            }
            // return $rawat;
            
            DB::commit();
            EncounterHelper::create($rawat);
            return response()->json([
                'status' => 'success',
                'message' => 'Data Berhasil disimpan'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function show_sep($nomer_sep)
    {
        return View::make('pasien.modal.sep', compact('nomer_sep'));
    }
    public function buat_sep_manual(Request $request)
    {
        $pasien = Pasien::where('no_rm', $request->no_rm)->first();
        return View::make('pasien.form.rujukan-manual', compact('pasien'));
    }
    public function get_histori_pasien(Request $request)
    {
        $now = Carbon::now()->format('Y-m-d');
        $threeMonthsAgo = Carbon::now()->subMonths(2)->format('Y-m-d');
        $getHistoriPelayananPeserta = VclaimMonitoringHelper::getHistoriPelayananPeserta($request->nokartu, $threeMonthsAgo,$now);

        return View::make('pasien.form.histori-pasien', compact('getHistoriPelayananPeserta'));
    }

    public function get_sep_kontrol(Request $request){
        $sep = VclaimRencanaKontrolHelper::getDatabysep($request->sep);
        $split_poli = explode(' - ',$sep['response']['poli']);
        if($sep['response']['jnsPelayanan'] == 'Rawat Jalan'){
            $poli = Poli::where('kode',$split_poli[0])->get();
        }else{
            $poli = Poli::where('ket',1)->get();
        }
        return View::make('pasien.form.form-surat-kontrol', compact('sep','poli'));
    }   

    public function post_form_consent(Request $request){
        DB::beginTransaction();

        try {
            $pasien = Pasien::find($request->idpasien);
            // return $pasien;
            $consent = SatusehatResourceHelper::consent_update($pasien->ihs);
            // return $consent;
            DB::table('demo_consent')->insert([
                'idpasien'=>$pasien->id,
                'general_consent'=>$request->general_consent,
                'created_at'=>date('Y-m-d H:i:s'),
                'user'=>auth()->user()->id,
                'penanggung_jawab'=>$request->penanggung_jawab,
                'period'=>$consent['provision']['period']['start'],
                'consent_id'=>$consent['id'],
            ]);
            // return $consent['provision']['period']['start'];
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Data Berhasil disimpan'
            ]);
        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage()
            ]);
        }
        return $request->all();
    }
}
