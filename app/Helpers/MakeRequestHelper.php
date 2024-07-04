<?php

namespace App\Helpers;
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
            $response = Http::withHeaders($token['signature'])
            ->withOptions(["verify" => $token['ssl']])
            ->{$method}(config('app.url_vclaim_prod').$url,$data);
            // return $response;
        
        } else {
            $response = Http::withHeaders($token['signature'])
            ->withOptions(["verify" => $token['ssl']])
            ->{$method}(config('app.url_vclaim_prod').$url);

        }

        if ($response->status() == 200) {
            // return $response['response'];
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
    
        // if ($response->status() == 401) {
        //     session()->forget('sso.token');
        //     return redirect()->route('login');
        // }
    
        return $response;
    }

    // public static function permissions($aksi){
    //     $permissions = session()->get('sso.permissions');
    //     if (in_array($aksi, $permissions)) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
}