<?php

namespace App\Helpers;

use App\Models\Rawat;
use App\Models\Dokter;
use App\Models\Obat\Obat;
use LZCompressor\LZString;
use App\Helpers\VclaimHelper;
use App\Models\Pasien\Pasien;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class VclaimHelper
{

    protected $url;
    protected $url_icare;
    protected $consId;
    protected $secretKey;
    protected $userKeyVclaim;
    protected $userKeyAntrol;
    protected $ssl;
    protected $url_antrian;

    public function __construct()
    {
        if (config('app.env') == 'production') {
            $this->url = config('app.url_vclaim_prod');
            $this->consId = config('app.consid_vclaim_prod');
            $this->secretKey = config('app.secretkey_vclaim_prod');
            $this->userKeyVclaim = config('app.userkey_vclaim_prod');
            $this->userKeyAntrol = config('app.userkey_antrol_prod');
            $this->ssl = true;
            $this->url_icare = config('app.url_icare_prod');
            $this->url_antrian = config('app.url_antrian_prod');
        } else {
            $this->url = config('app.url_vclaim_prod');
            $this->consId = config('app.consid_vclaim_prod');
            $this->secretKey = config('app.secretkey_vclaim_prod');
            $this->userKeyVclaim = config('app.userkey_vclaim_prod');
            $this->userKeyAntrol = config('app.userkey_antrol_prod');
            $this->ssl = false;
            $this->url_icare = config('app.url_icare_prod');
            $this->url_antrian = config('app.url_antrian_prod');
        }
    }

    public static function cek_signa($resep,$signa){
        // $array = ["P","S","SO","M"];
        if($resep == 'null' || $resep == null || $resep == ''){
            return false;
        }else{
            if(in_array($signa,json_decode($resep))){
                return true;
            }else{
                return false;
            }
        }

        
    }
    public static function get_signa($signa){
        switch($signa){
            case 'P':
                return 'Pagi';
            case 'S':
                return 'Siang';
            case 'SO':
                return 'Sore';
            case 'M':
                return 'Malam';
        }
    }
    public static function get_data_obat($idobat){
        $obat = Obat::where('id',$idobat)->first();
        return $obat?->nama_obat;
    }
    public static function get_harga_obat($idobat,$jenis){
        $obat = Obat::where('id',$idobat)->first();
        if($jenis == '1'){
            return $obat?->harga_jual;
        }else{
            return $obat?->harga_beli;
        }
    }

    public static function stringDecrypt($key, $string)
    {

        $encrypt_method = 'AES-256-CBC';
        $key_hash = hex2bin(hash('sha256', $key));
        $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);
        return $output;
    }
    public static function decompress($string)
    {
        return \LZCompressor\LZString::decompressFromEncodedURIComponent($string);
    }

    public function getTokenAntrol(){
        try {
            date_default_timezone_set('UTC');
            $tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
            $signature = hash_hmac('sha256', $this->consId . "&" . $tStamp, $this->secretKey, true);
            $encodedSignature = base64_encode($signature);

            return [
                'signature' => [
                    'X-cons-id' => $this->consId,
                    'X-timestamp' => $tStamp,
                    'X-signature' => $encodedSignature,
                    'user_key' => $this->userKeyAntrol,
                ],
                'ssl' => $this->ssl,
                'key' => $this->consId . $this->secretKey . $tStamp
            ];
        } catch (\Exception $e) {
            // Handle exception, log or rethrow as needed
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public function getToken()
    {
        try {
            date_default_timezone_set('UTC');
            $tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
            $signature = hash_hmac('sha256', $this->consId . "&" . $tStamp, $this->secretKey, true);
            $encodedSignature = base64_encode($signature);

            return [
                'signature' => [
                    'X-cons-id' => $this->consId,
                    'X-timestamp' => $tStamp,
                    'X-signature' => $encodedSignature,
                    'user_key' => $this->userKeyVclaim,
                ],
                'ssl' => $this->ssl,
                'key' => $this->consId . $this->secretKey . $tStamp
            ];
        } catch (\Exception $e) {
            // Handle exception, log or rethrow as needed
            return [
                'error' => $e->getMessage(),
            ];
        }
    }

    #get peserta BPJS
    public static function getPesertaBPJS($noKartu, $tgl)
    {
        try {
            $helper = new VclaimHelper();
            $token = $helper->getToken();

            $response = Http::withHeaders($token['signature'])
                ->withOptions(["verify" => $token['ssl']])
                ->get($helper->url . '/Peserta/nokartu/' . $noKartu . '/tglSEP/' . $tgl);

            if ($response['metaData']['code'] == '200') {
                $data_response = VclaimHelper::stringDecrypt($token['key'], $response['response']);
                $data_response = VclaimHelper::decompress($data_response);
                $data_response = json_decode($data_response, true);
                return $data_response;
            } else {
                return $response['metaData'];
            }
        } catch (\Exception $e) {
            // Handle exception, log or rethrow as needed
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    #get peserta NIK
    public static function getPesertaNIK($nik, $tgl)
    {
        try {
            $helper = new VclaimHelper();
            $token = $helper->getToken();

            $response = Http::withHeaders($token['signature'])
                ->withOptions(["verify" => $token['ssl']])
                ->get($helper->url . '/Peserta/nik/' . $nik . '/tglSEP/' . $tgl);

            if ($response['metaData']['code'] == '200') {
                $data_response = VclaimHelper::stringDecrypt($token['key'], $response['response']);
                $data_response = VclaimHelper::decompress($data_response);
                $data_response = json_decode($data_response, true);
                return $data_response;
            } else {
                return $response['metaData'];
            }
        } catch (\Exception $e) {
            // Handle exception, log or rethrow as needed
            return [
                'error' => $e->getMessage(),
            ];
        }
    }

    #get Dokter
    public static function getDokterSimrs($id){
        $dokter = Dokter::find($id);
        return $dokter?->nama_dokter;
    }
    public static function getDokter($jenis_layanan, $tglPelayanan, $spesialis)
    {
        try {
            $helper = new VclaimHelper();
            $token = $helper->getToken();

            $response = Http::withHeaders($token['signature'])
                ->withOptions(["verify" => $token['ssl']])
                ->get($helper->url . '/referensi/dokter/pelayanan/'.$jenis_layanan.'/tglPelayanan/'.$tglPelayanan.'/Spesialis/'.$spesialis);

            if ($response['metaData']['code'] == '200') {
                $data_response = VclaimHelper::stringDecrypt($token['key'], $response['response']);
                $data_response = VclaimHelper::decompress($data_response);
                $data_response = json_decode($data_response, true);
                return $data_response;
            } else {
                return $response['metaData'];
            }
        } catch (\Exception $e) {
            // Handle exception, log or rethrow as needed
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    #rujukan vclaim
    public static function rujukan_vlaim_one($bpjs)
    {
        try {
            $helper = new VclaimHelper();
            $token = $helper->getToken();

            $response = Http::withHeaders($token['signature'])
                ->withOptions(["verify" => $token['ssl']])
                ->get($helper->url . '/Rujukan/RS/Peserta/'.$bpjs);

            if ($response['metaData']['code'] == '200') {
                $data_response = VclaimHelper::stringDecrypt($token['key'], $response['response']);
                $data_response = VclaimHelper::decompress($data_response);
                $data_response = json_decode($data_response, true);
                return $data_response;
            } else {
                return $response['metaData'];
            }
        } catch (\Exception $e) {
            // Handle exception, log or rethrow as needed
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    #icare 
    public static function postIcare($id,$bpjs)
    {
        // $helper = new VclaimHelper();
        // return $helper->url_icare.'/api/rs/validate';
 
        try {
            $helper = new VclaimHelper();
            $token = $helper->getToken();

            $response = Http::withHeaders($token['signature'])
                ->withOptions(["verify" =>$token['ssl']])
                ->post('https://apijkn.bpjs-kesehatan.go.id/wsihs/api/rs/validate', [
                    "param" => $bpjs,
                    "kodedokter" => (int) $id
                ]);

            if ($response['metaData']['code'] == '200') {
                $data_response = VclaimHelper::stringDecrypt($token['key'], $response['response']);
                $data_response = VclaimHelper::decompress($data_response);
                $data_response = json_decode($data_response, true);
                return $data_response;
            } else {
                return $response['metaData'];
            }
            // if ($response['metaData']['code'] == '200') {
            //     $data_response = VclaimHelper::stringDecrypt($token['key'], $response['response']);
            //     $data_response = VclaimHelper::decompress($data_response);
            //     $data_response = json_decode($data_response, true);
            //     return $data_response;
            // } else {
            //     return $response['metaData'];
            // }
        } catch (\Exception $e) {
            // Handle exception, log or rethrow as needed
            return [
                'error' => $e->getMessage(),
            ];
        }
    }

    public static function getFaskesSpesialistik($kode_faskes,$tgl){
        try {
            $helper = new VclaimHelper();
            $token = $helper->getToken();

            $response = Http::withHeaders($token['signature'])
                ->withOptions(["verify" => $token['ssl']])
                ->get($helper->url . '/Rujukan/ListSpesialistik/PPKRujukan/'.$kode_faskes.'/TglRujukan/'.$tgl);

            if ($response['metaData']['code'] == '200') {
                $data_response = VclaimHelper::stringDecrypt($token['key'], $response['response']);
                $data_response = VclaimHelper::decompress($data_response);
                $data_response = json_decode($data_response, true);
                return $data_response;
            } else {
                return $response['metaData'];
            }
        } catch (\Exception $e) {
            // Handle exception, log or rethrow as needed
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function getFaskesSarana($kode_faskes){
        try {
            $helper = new VclaimHelper();
            $token = $helper->getToken();

            $response = Http::withHeaders($token['signature'])
                ->withOptions(["verify" => $token['ssl']])
                ->get($helper->url . '/Rujukan/ListSarana/PPKRujukan/'.$kode_faskes);

            if ($response['metaData']['code'] == '200') {
                $data_response = VclaimHelper::stringDecrypt($token['key'], $response['response']);
                $data_response = VclaimHelper::decompress($data_response);
                $data_response = json_decode($data_response, true);
                return $data_response;
            } else {
                return $response['metaData'];
            }
        } catch (\Exception $e) {
            // Handle exception, log or rethrow as needed
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function getFaskes($nama_faskes){
        $helper = new VclaimHelper();
        $token = $helper->getToken();
        // return $helper->url;
        $response = Http::withHeaders($token['signature'])
            ->withOptions(["verify" => false])
            ->get($helper->url . '/referensi/faskes/rsau/2');
        // return $token;
        try {
            $helper = new VclaimHelper();
            $token = $helper->getToken();

            $response = Http::withHeaders($token['signature'])
                ->withOptions(["verify" => false])
                ->get($helper->url . '/referensi/faskes/'.$nama_faskes.'/2');
            // return $response;
            if ($response['metaData']['code'] == '200') {
                $data_response = VclaimHelper::stringDecrypt($token['key'], $response['response']);
                $data_response = VclaimHelper::decompress($data_response);
                $data_response = json_decode($data_response, true);
                $data =[];
                foreach($data_response['faskes'] as $faskes){
                    $data[] = [
                        'id'=>$faskes['kode'].'-'.$faskes['nama'],
                        'nama'=>$faskes['nama'],
                    ];
                }
                return $data;
            } else {
                return $response['metaData'];
            }
        } catch (\Exception $e) {
            // Handle exception, log or rethrow as needed
            return [
                'error' => $e->getMessage(),
            ];
        }
    }

    public static function getlist_taks($kode){
        $rawat = Rawat::where('idrawat',$kode)->first();
        if(!$rawat){
            return response()->json([
                'kode'=>201,
                'message' => 'Rawat Tidak Ditemukan',
            ], 404);
        }
        $helper = new VclaimHelper();
        $token = $helper->getTokenAntrol();
        // return  $token['ssl'];
        // return $token;
        $response = Http::withHeaders($token['signature'])
            ->withOptions(["verify" => $token['ssl']])
            ->post('https://apijkn.bpjs-kesehatan.go.id/antreanrs/antrean/getlisttask',[
                'kodebooking'=>$kode
        ]);
        if ($response['metadata']['code'] == '200') {
                $data_response = VclaimHelper::stringDecrypt($token['key'], $response['response']);
                $data_response = VclaimHelper::decompress($data_response);
                $data_response = json_decode($data_response, true);
                return $data_response;
            } else {
                // $this->update_task
                // return $helper->add_antrian($rawat->id);
                return $response['metadata'];
            }
    }

    public static function update_task($kode_boking,$taksid,$waktu){
        $rawat = Rawat::where('idrawat',$kode_boking)->first();
        if($rawat){
            $cek_demo = DB::table('demo_task_id')->where('kode_rawat',$rawat->idrawat)->where('task',$taksid)->first();
            if($cek_demo){
                $demo_task_id = DB::table('demo_task_id')->where('kode_rawat',$rawat->idrawat)->where('task',$taksid)->update([
                    'waktu'=>date('Y-m-d H:i:s'),
                    'status'=>0,
                    'microtime'=>$waktu,
                ]);
            }else{
            $demo_task_id = DB::table('demo_task_id')->insert([
                'idrawat'=>$rawat->id,
                'kode_rawat'=>$rawat->idrawat,
                'task'=>$taksid,
                'waktu'=>date('Y-m-d H:i:s'),
                'status'=>0,
                'microtime'=>$waktu,
            ]);
         }
        }
        // return $kode_boking;
        // $helper = new VclaimHelper();
        // $token = $helper->getTokenAntrol();
        // // return $token;
        // $response = Http::withHeaders($token['signature'])
        //     ->withOptions(["verify" => $token['ssl']])
        //     ->post('https://apijkn.bpjs-kesehatan.go.id/antreanrs/antrean/updatewaktu',[
        //         'kodebooking'=>$kode_boking,
        //         "taskid"=> $taksid,
        //         "waktu"=> $waktu,
        // ]);
        // return $response;
    }
    public static function add_antrian($idrawat){
        $rawat = Rawat::find($idrawat);
        // return strtotime($rawat->tglmasuk).'000';
        if(!$rawat){
            return response()->json([
                'kode'=>201,
                'message' => 'Rawat Tidak Ditemukan',
            ], 404);
        }
        
        try {
            $helper = new VclaimHelper();
            $token = $helper->getTokenAntrol();
            // return $token;
            
            $pasien = Pasien::where('no_rm',$rawat->no_rm)->first();
            // return $helper->rujukan_vlaim_one($pasien->no_bpjs);
            if($rawat->idbayar == 2){
                $jenis_pasien = 'JKN';
                $bpjs = $pasien->no_bpjs;
            }else{
                $jenis_pasien = 'NON JKN';
                $bpjs ='';
            }
            if($rawat->kunjungan == 1){
                $kunjungan = 1;
                $nomorreferensi = '0151B1070622P002358' ;
            }else{
                $kunjungan = 3;
                $nomorreferensi = '0151B1070622P002358';
                //$pelayanan->no_rujukan = $nomorreferensi;
            }
            $dokter_kuota = DB::table('dokter_kuota')->where('iddokter',$rawat->iddokter)->where('tgl',date('Y-m-d',strtotime($rawat->tglmasuk)))->where('idpoli',$rawat->idpoli)->first();
            $data_json = $helper->get_jadwal_poli($rawat->dokter?->kode_dpjp,$rawat->poli?->kode,date('Y-m-d',strtotime($rawat->tglmasuk)));
            // return $data_json->jadwal;
            if(!$data_json){
                return [
                    'kode'=>201,
                    'message' => 'Jadwal Dokter Tidak Ditemukan',
                ];
            }
            // $data_json = json_decode($data_json);
            $jam = explode("-", $data_json->jadwal);
            $jam_buka = $jam[0];
            date_default_timezone_set("Asia/Jakarta");
            $angantrean = (int) ltrim(substr($rawat->no_antrian,-3), '0');
            $tambah = (25*$angantrean);
            date_default_timezone_set("Asia/Jakarta");
            $tanggalperiksa =date('Y-m-d',strtotime($rawat->tglmasuk));
            $jam_dilayani = date("H:i:s", strtotime("+".$tambah." minutes", strtotime($jam_buka)));
            $dilayani = date('Y-m-d H:i:s',strtotime($tanggalperiksa.' '.$jam_dilayani));
            $fix = strtotime($dilayani,strtotime('-7 hour')).'000';
            // return $fix;
            $response = Http::withHeaders($token['signature'])
                ->withOptions(["verify" => $token['ssl']])
                ->post('https://apijkn.bpjs-kesehatan.go.id/antreanrs/antrean/add',[
                    "kodebooking"=> $rawat->idrawat,
                    "jenispasien"=> $jenis_pasien,
                    "nomorkartu"=>$bpjs,
                    "nik"=> $pasien->nik,
                    "nohp"=> $pasien->nohp,
                    "kodepoli"=> $rawat->poli->kode,
                    "namapoli"=> $rawat->poli->poli,
                    "pasienbaru"=> 0,
                    "norm"=> $rawat->no_rm,
                    "tanggalperiksa"=> date('Y-m-d',strtotime($rawat->tglmasuk)),
                    "kodedokter"=> $rawat->dokter->kode_dpjp,
                    "namadokter"=> $rawat->dokter->nama_dokter,
                    "jampraktek"=> $data_json->jadwal,
                    "jeniskunjungan"=> $kunjungan ,
                    "nomorreferensi"=> $nomorreferensi,
                    "nomorantrean"=> $rawat->poli->kode_antrean.'-'.substr($rawat->no_antrian,-3),
                    "angkaantrean"=> (int) ltrim(substr($rawat->no_antrian,-3), '0'),
                    "estimasidilayani"=> (int) $fix,
                    "sisakuotajkn"=>  $dokter_kuota->sisa,
                    "kuotajkn"=> $dokter_kuota->kuota,
                    "sisakuotanonjkn"=> $dokter_kuota->sisa,
                    "kuotanonjkn"=> $dokter_kuota->kuota,
                    "keterangan"=> "Peserta harap 30 menit lebih awal guna pencatatan administrasi.",
            ]);

            $taks_id = $helper->update_task($rawat->idrawat,3,strtotime($rawat->tglmasuk).'000');
            return $response;
        } catch (\Exception $e) {
            // Handle exception, log or rethrow as needed
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function searchForId($dokter,$array) {
		
        foreach ($array as $key => $val) {
            if ($val['kodedokter'] == $dokter) {
                $data_json = json_encode($val, true);
                return $data_json;
            }
        }
        return false;
     }
    
     
    public static function get_jadwal_poli($kode_dokter,$kode_poli,$tgl){
       
        // return $token;
        try {
            $helper = new VclaimHelper();
            $token = $helper->getTokenAntrol();
            // return $helper->url;
            $response = Http::withHeaders($token['signature'])
                ->withOptions(["verify" => $token['ssl']])
                ->get('https://apijkn.bpjs-kesehatan.go.id/antreanrs/jadwaldokter/kodepoli/'.$kode_poli.'/tanggal/'.$tgl);
            // return $response;
            if ($response['metadata']['code'] == '200') {
                $data_response = VclaimHelper::stringDecrypt($token['key'], $response['response']);
                $data_response = VclaimHelper::decompress($data_response);
                $data_response = json_decode($data_response, true);
                $hasil =  $helper->searchForId($kode_dokter,$data_response);
                if($hasil){
                    return json_decode($hasil);
                }else{
                    return false;
                }
            } else {
                return $response['metadata'];
            }
        } catch (\Exception $e) {
            // Handle exception, log or rethrow as needed
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
}
