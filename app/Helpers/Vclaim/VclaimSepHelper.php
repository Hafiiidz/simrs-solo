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
}