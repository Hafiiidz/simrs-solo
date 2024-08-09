<?php

namespace App\Helpers\Vclaim;

use LZCompressor\LZString;
use App\Helpers\MakeRequestHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class VclaimMonitoringHelper
{
    public static function getHistoriPelayananPeserta($noKartu, $tglMulai, $tglAkhir)
    {
        try {
            $response = MakeRequestHelper::makeRequest('get-histori-pelayanan-peserta','get','/monitoring/HistoriPelayanan/NoKartu/'.$noKartu.'/tglMulai/'.$tglMulai.'/tglAkhir/'.$tglAkhir);
            return $response;           
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
}