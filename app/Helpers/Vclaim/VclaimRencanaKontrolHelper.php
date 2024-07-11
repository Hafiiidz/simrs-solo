<?php

namespace App\Helpers\Vclaim;

use LZCompressor\LZString;
use App\Helpers\MakeRequestHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Helpers\Vclaim\VclaimAuthHelper;
use GuzzleHttp\Client;

class VclaimRencanaKontrolHelper
{
    public static function getInsert($post_data = null)
    {
        if ($post_data == null) {
            $post_data = [
                "request" => [
                    "noSEP" => "0301R0111018V000006",
                    "kodeDokter" => "227186",
                    "poliKontrol" => "INT",
                    "tglRencanaKontrol" => "2024-07-11",
                    "user" => "ws"
                ]
            ];
        }
        // return json_encode($post_data);
        try {
            $response = MakeRequestHelper::makeRequest('post', '/RencanaKontrol/insert', $post_data);
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
            $response = MakeRequestHelper::makeRequest('put', '/RencanaKontrol/Update', $post_data);
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
            $post_data = array(
                "request" => array(
                    "noKartu" => "0000570582369",
                    "kodeDokter" => '227186',
                    "poliKontrol" => "INT",
                    "tglRencanaKontrol" => "2024-07-11",
                    "user" => "wss"
                )
            );

            return MakeRequestHelper::makeRequest('POST', 'RencanaKontrol/InsertSPRI', $post_data);
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
}
