<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use App\Helpers\Vclaim\VclaimAuthHelper;

class MakeRequestHelper
{
    public static function makeRequest($name_request, $method, $url, $data = null, $token_jenis = 1)
    {
        // return $token_jenis;
        if ($token_jenis == 1) {
            $token = VclaimAuthHelper::getToken();
            $url_request = config('app.url_vclaim_prod');
            $metadata = 'metaData';
           
        } else {
            $token = VclaimAuthHelper::getTokenAntrol();
            $url_request = config('app.url_antrian_prod');
            $metadata = 'metadata';
            // return $metadata;
        }
        // return $url_request;
        $startTime = microtime(true);


        if ($data) {
            if ($token_jenis != 1) {
                $response = Http::withHeaders($token['signature'])
                    ->withOptions(["verify" => $token['ssl']])
                    ->{$method}($url_request . $url, $data);
                $endTime = microtime(true);
                $duration = round($endTime - $startTime, 2);
                DB::table('demo_log_request_bpjs')->insert([
                    'url' => $url_request . $url,
                    'name' => $name_request,
                    'methhod' => $method,
                    'data' => json_encode($data, true),
                    'time_request' => $duration,
                    'response' => $response,
                    'created_at' => date('Y-m-d H:i:s'),
                    'message' => $response[$metadata]['message'] ?? 0,
                    'code' => $response->getStatusCode(),
                ]);
                if ($response->status() == 200) {
                    if(isset($response['response'])){
                        $data_response = VclaimAuthHelper::stringDecrypt($token['key'], $response['response']);
                        $data_response = VclaimAuthHelper::decompress($data_response);
                        $data_response = json_decode($data_response, true);
                        return [
                            'metaData' => $response[$metadata],
                            'response' => $data_response,
                            'duration' => $duration,
                        ];
                    }else{
                        return [
                            'metaData' => $response[$metadata],
                            'duration' => $duration,
                        ];
                    }
                    
                } else {
                    return $response;
                }
            }
            $client = new Client();
            $response = $client->request($method, $url_request . $url, [
                'verify' => false,
                'headers' => $token['signature'],
                'json' => $data
            ]);
            $endTime = microtime(true);
            $duration = round($endTime - $startTime, 2);
            $responseBody = $response->getBody();
            $responseData = json_decode($responseBody, true);
            DB::table('demo_log_request_bpjs')->insert([
                'url' => $url_request . $url,
                'name' => $name_request,
                'methhod' => $method,
                'data' => json_encode($data['request'], true),
                'time_request' => $duration,
                'created_at' => date('Y-m-d H:i:s'),
                'response' => isset($responseData[$metadata]) ? json_encode($responseData[$metadata], true) : '0',
                'message' => $responseData[$metadata]['message'] ?? 'Server Lost',
                'code' => $response->getStatusCode(),
            ]);


            if ($response->getStatusCode() == 200) {
                // return $response['response'];

                $data_response = VclaimAuthHelper::stringDecrypt($token['key'], $responseData['response']);
                $data_response = VclaimAuthHelper::decompress($data_response);
                $data_response = json_decode($data_response, true);
                return [
                    'metaData' => $responseData[$metadata],
                    'response' => $data_response,
                    'duration' => $duration,
                ];
            } else {
                return json_decode($response->getBody(), true);
            }
            return $response;
        } else {
            $response = Http::withHeaders($token['signature'])
                ->withOptions(["verify" => $token['ssl']])
                ->{$method}($url_request . $url);

            $endTime = microtime(true);
            $duration = round($endTime - $startTime, 2);
            DB::table('demo_log_request_bpjs')->insert([
                'url' => $url_request . $url,
                'name' => $name_request,
                'methhod' => $method,
                'time_request' => $duration,
                'response' => $response ?? 0,
                'created_at' => date('Y-m-d H:i:s'),
                'message' => $response[$metadata]['message'] ?? 0,
                'code' => $response->getStatusCode(),
            ]);
            if ($response->status() == 200) {
                if ($response[$metadata]['code'] == 200) {
                    if ($token_jenis == 3) {
                        return $response;
                    }
                    $data_response = VclaimAuthHelper::stringDecrypt($token['key'], $response['response']);
                    $data_response = VclaimAuthHelper::decompress($data_response);
                    $data_response = json_decode($data_response, true);
                    return [
                        'metaData' => $response[$metadata],
                        'response' => $data_response,
                        'duration' => $duration,
                    ];
                } else {
                    return $response;
                }
            } else {
                return $response;
            }
        }
    }

    public static function get_prov($idkel)
    {
        $kelurahan = DB::table('kelurahan')->where('id_kel', $idkel)->first();
        $kecamatan = DB::table('kecamatan')->where('id_kec', $kelurahan?->id_kec)->first();
        $kabupaten = DB::table('kabupaten')->where('id_kab', $kecamatan?->id_kab)->first();
        $provinsi = DB::table('provinsi')->where('id_prov', $kabupaten?->id_prov)->first();

        return [
            'id_kel' => $idkel,
            'id_kec' => $kecamatan->id_kec,
            'id_kab' => $kabupaten->id_kab,
            'id_prov' => $provinsi->id_prov,
        ];
    }

    public static function genAntri($pf, $iddokter, $ang, $daftar)
    {
        $tgl = date('Ymd', strtotime($daftar));

        $max = DB::table('rawat')
            ->where('idpoli', 'like', $pf)
            ->where('anggota', 0)
            ->where('status', '<>', 5)
            ->whereDate('tglmasuk', '=', $daftar)
            ->max(DB::raw('CAST(SUBSTRING(no_antrian, LENGTH(no_antrian) - 3, 4) AS UNSIGNED)'));

        $last = $max + 1;

        if ($last < 10) {
            $id = $tgl . $pf . $iddokter . '000' . $last;
        } elseif ($last < 100) {
            $id = $tgl . $pf . $iddokter . '00' . $last;
        } elseif ($last < 1000) {
            $id = $tgl . $pf . $iddokter . '0' . $last;
        } else {
            $id = $tgl . $pf . $iddokter . $last;
        }

        return $id;
    }
}
