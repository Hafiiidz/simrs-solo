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

class SatusehatAuthHelper
{
    public static function ssl(){
        if (config('app.env') == 'production') {
            return true;
        } else {
            return false;        }

    }
    public static function generate_token(){
        $url = env('PROD_AUTH_URL_SS');
        // return $url;
        $response = Http::asForm()->withOptions(["verify" => SatusehatAuthHelper::ssl()])->post($url.'/accesstoken?grant_type=client_credentials', [
            'client_id' =>env('PROD_CLIENT_ID_SS'),
            'client_secret' =>env('PROD_CLIENT_SECRET_SS')
        ]);

        return $response->json();
    }
}
