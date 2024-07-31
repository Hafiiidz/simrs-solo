<?php

namespace App\Helpers\Vclaim;

use LZCompressor\LZString;
use App\Helpers\MakeRequestHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Helpers\Vclaim\VclaimAuthHelper;

class VclaimPesertaHelper
{
    public static function getPesertaBPJS($noKartu, $tgl)
    {
        try {
            $response = MakeRequestHelper::makeRequest('get-peserta-bpjs','get','/Peserta/nokartu/' . $noKartu . '/tglSEP/' . $tgl);
            return $response;           
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function getPesertaNIK($nik, $tgl)
    {
        try {
            $response = MakeRequestHelper::makeRequest('get-peserta-nik','get','/Peserta/nik/' . $nik . '/tglSEP/' . $tgl);
            return $response;           
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
}