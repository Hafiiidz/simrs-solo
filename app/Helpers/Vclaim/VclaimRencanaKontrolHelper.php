<?php

namespace App\Helpers\Vclaim;

use LZCompressor\LZString;
use App\Helpers\MakeRequestHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Helpers\Vclaim\VclaimAuthHelper;

class VclaimRencanaKontrolHelper
{
    public static function getInsert($post_data=null)
    {
        if($post_data == null){
            $post_data = [
                "request"=> [
                    "noSEP"=>"0301R0111018V000006",
                    "kodeDokter"=>"12345",
                    "poliKontrol"=>"INT",
                    "tglRencanaKontrol"=>"2021-03-20",
                    "user"=>"ws"
                ]
            ];
        }      
        // return json_encode($post_data);
        try {
            $response = MakeRequestHelper::makeRequest('post','/RencanaKontrol/insert',$post_data);
            return $response;           
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function getUpdate($post_data)
    {
     
        try {
            $response = MakeRequestHelper::makeRequest('put','/RencanaKontrol/Update',$post_data);
            return $response;           
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function getInsertSpri()
    {
        
        try {
            $token = VclaimAuthHelper::getToken();
            // return $token;
            $post_data = array(
                "request"=> array(
                    "noKartu"=>"0000570582369",
                    "kodeDokter"=>'227186',
                    "poliKontrol"=>"INT",
                    "tglRencanaKontrol"=>"2024-07-03",
                    "user"=>"wss"
                )
            );
            $response = Http::withHeaders($token['signature'])
            ->withOptions(["verify" => $token['ssl']])
            ->post(config('app.url_vclaim_prod').'RencanaKontrol/InsertSPRI',json_encode($post_data));
            // $response = MakeRequestHelper::makeRequest('post','/RencanaKontrol/InsertSPRI',json_encode($post_data));
            return $response;           
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }

}
