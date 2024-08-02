<?php

namespace App\Helpers\Vclaim;

use LZCompressor\LZString;
use App\Helpers\MakeRequestHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class VclaimSepHelper
{
    public static function get_finger_print($noKartu,$tglPelayanan){
        try {
            $response = MakeRequestHelper::makeRequest('get-finger-print','get','/SEP/FingerPrint/Peserta/'.$noKartu.'/TglPelayanan/'.$tglPelayanan);
            return $response;           
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function getInsertSep($data)
    {
        try {
            return MakeRequestHelper::makeRequest('post-insest-sep','post', '/SEP/2.0/insert', $data);
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function getDeleteSep($data)
    {
        try {
            return MakeRequestHelper::makeRequest('delete-sep','delete', '/SEP/2.0//Delete', $data);
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
}