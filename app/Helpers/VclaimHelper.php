<?php

namespace App\Helpers;

use App\Models\Obat\Obat;
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
        if (config('app.env') == 'local') {
            $this->url = config('app.url_vclaim_prod');
            $this->consId = config('app.consid_vclaim_prod');
            $this->secretKey = config('app.secretkey_vclaim_prod');
            $this->userKeyVclaim = config('app.userkey_vclaim_prod');
            $this->userKeyAntrol = config('app.userkey_antrol_prod');
            $this->ssl = true;
            $this->url_icare = config('app.url_icare_prod');
            $this->url_antrian = config('app.url_antrian_prod');
        } else {
            $this->url = config('app.url_vclaim_dev');
            $this->consId = config('app.consid_vclaim_dev');
            $this->secretKey = config('app.secretkey_vclaim_dev');
            $this->userKeyVclaim = config('app.userkey_vclaim_dev');
            $this->userKeyAntrol = config('app.userkey_antrol_dev');
            $this->ssl = false;
            $this->url_icare = config('app.url_icare_dev');
            $this->url_antrian = config('app.url_antrian_dev');
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

    public static function getlist_taks(){
        $helper = new VclaimHelper();
        $token = $helper->getTokenAntrol();
        // return $token;
        $response = Http::withHeaders($token['signature'])
            ->withOptions(["verify" => $token['ssl']])
            ->post('https://apijkn.bpjs-kesehatan.go.id/antreanrs/antrean/getlisttask',[
                'kodebooking'=>'RJ2024542430001'
        ]);
        if ($response['metadata']['code'] == '200') {
                $data_response = VclaimHelper::stringDecrypt($token['key'], $response['response']);
                $data_response = VclaimHelper::decompress($data_response);
                $data_response = json_decode($data_response, true);
                return $data_response;
            } else {
                // $this->update_task
                return $response['metadata'];
            }
    }

    public static function update_task($kode_boking,$taksid,$waktu){
        $helper = new VclaimHelper();
        $token = $helper->getTokenAntrol();
        // return $token;
        $response = Http::withHeaders($token['signature'])
            ->withOptions(["verify" => $token['ssl']])
            ->post('https://apijkn.bpjs-kesehatan.go.id/antreanrs/antrean/updatewaktu',[
                'kodebooking'=>'RJ2024542430001',
                "taskid"=> 5,
                "waktu"=> 1707286846000,
        ]);
        return $response;
    }
}
