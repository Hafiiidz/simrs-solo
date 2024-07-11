<?php

namespace App\Helpers;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use App\Helpers\Vclaim\VclaimAuthHelper;

class MakeRequestHelper
{
    public static function makeRequest($method, $url, $data = null ,$token_jenis=1) {
        // return $data;
        if($token_jenis == 1){
            $token = VclaimAuthHelper::getToken();
        }else{
            $token = VclaimAuthHelper::getTokenAntrol();
        }
        
        if ($data) {
            $client = new Client();
            $response = $client->request($method, config('app.url_vclaim_prod').$url, [
                'headers' =>$token['signature'],
                'json' => $data
            ]);
            if ($response->getStatusCode() == 200) {
                // return $response['response'];
                $responseBody = $response->getBody();
                $responseData = json_decode($responseBody, true);
                $data_response = VclaimAuthHelper::stringDecrypt($token['key'], $responseData['response']);
                $data_response = VclaimAuthHelper::decompress($data_response);
                $data_response = json_decode($data_response, true);
                return [
                    'metaData'=>$responseData['metaData'],
                    'response'=>$data_response,
                ];
            } else {
                return json_decode($response->getBody(),true);
            }        
            return $response;
        } else {
            $response = Http::withHeaders($token['signature'])
            ->withOptions(["verify" => $token['ssl']])
            ->{$method}(config('app.url_vclaim_prod').$url);

        }

        if ($response->status() == 200) {
            $data_response = VclaimAuthHelper::stringDecrypt($token['key'], $response['response']);
            $data_response = VclaimAuthHelper::decompress($data_response);
            $data_response = json_decode($data_response, true);
            return [
                'metaData'=>$response['metaData'],
				'response'=>$data_response,
            ];
        } else {
            return $response;
        }
    
        return $response;
    }

    public static function get_prov($idkel){
        $kelurahan = DB::table('kelurahan')->where('id_kel',$idkel)->first();
        $kecamatan = DB::table('kecamatan')->where('id_kec',$kelurahan?->id_kec)->first();
        $kabupaten = DB::table('kabupaten')->where('id_kab',$kecamatan?->id_kab)->first();
        $provinsi = DB::table('provinsi')->where('id_prov',$kabupaten?->id_prov)->first();

        return [
            'id_kel'=>$idkel,
            'id_kec'=>$kecamatan->id_kec,
            'id_kab'=>$kabupaten->id_kab,
            'id_prov'=>$provinsi->id_prov,
        ];
    }

}