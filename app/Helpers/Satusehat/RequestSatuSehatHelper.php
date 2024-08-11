<?php

namespace App\Helpers\Satusehat;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use App\Helpers\SatusehatAuthHelper;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use App\Helpers\Vclaim\VclaimAuthHelper;
use App\Helpers\Satusehat\Resource\PatientHelper;
use App\Helpers\Satusehat\Resource\LocationHelper;

class RequestSatuSehatHelper
{
    public static function makeRequest($name_request, $method, $url, $data = null, $type = 1)
    {
        // type 
        // 1 = PROD_BASE_URL_SS
        // 2 = PROD_CONSENT_URL_SS
        $startTime = microtime(true);
        if($type == 1){           
            $url_data = env('PROD_CONSENT_URL_SS');
        }else{
            $url_data = env('PROD_BASE_URL_SS');
        }
        $get_token = SatusehatAuthHelper::generate_token();
        $token = $get_token['access_token'];
        // return $url_data.$url;
        if($data){
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                "Authorization" => "Bearer ".$token,
                // Add any additional headers if needed
            ])->withOptions(["verify" => SatusehatAuthHelper::ssl()])->{$method}($url_data.$url, $data);
            $endTime = microtime(true);
            $duration = round($endTime - $startTime, 2);
            DB::table('demo_log_satset')->insert([
                'url'=>$url_data.$url,
                'response'=>json_encode($response->json()),
                'data' => json_encode($data, true),
                'time'=> $duration,
                'created_at'=>date('Y-m-d H:i:s'),
                // 'user'=>auth()->user()->id,
                'name'=>$name_request,
                'method'=>$method,
                'code'=>$response->status()
            ]);
            return $response->json();
        }else{
            $response = Http::withOptions(["verify" => SatusehatAuthHelper::ssl()])
            ->withHeaders([
                "Authorization" => "Bearer ".$token,
            ])
            ->{$method}($url_data.$url);
            $endTime = microtime(true);
            $duration = round($endTime - $startTime, 2);
            DB::table('demo_log_satset')->insert([
                'url'=>$url_data.$url,
                'response'=>json_encode($response->json()),
                'time'=> $duration,
                'created_at'=>date('Y-m-d H:i:s'),
                // 'user'=>auth()->user()->id,
                'name'=>$name_request,
                'method'=>$method,
                'code'=>$response->status()
            ]);
            // return $response->status();
            return  $response->json();
        }
    }
}
