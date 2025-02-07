<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien\Pasien;
use App\Models\AntrianFarmasi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Helpers\SatusehatPasienHelper;
use App\Helpers\SatusehatResourceHelper;
use App\Helpers\Satusehat\Resource\EncounterHelper;

class ApiController extends Controller
{
    public function antrian_farmasi(Request $r){
        $antrian = AntrianFarmasi::whereDate('created_at',$r->tgl)
        ->where('status_antrian','Antrian')
        ->get();
        $array = [];
        foreach($antrian as $an){
            $array[] = [
                'nama_pasien'=>$an->pasien?->nama_pasien,
                'status'=>$an->status_antrian == 'Antrian' ? 'Menunggu':$an->status_antrian,
            ];
        }
        return $array;
    }

    public function getPraktisi(Request $r){
        $nik = $r->nik;
        $nama = $r->nama;
        $response = SatusehatResourceHelper::practitioner_nik_verifikasi($nik);
        // return $response['token'];
        if($response['status'] == 'success'){
            $client = new \GuzzleHttp\Client();
            $response_satset = $client->post('http://117.20.59.250:5000/generate-url', [
            'json' => [
                'agen' => $r->nama,
                'nik_agen' => $r->nik,
                'access_token' => $response['token'],
            ]
            ]);

            $responseBody = json_decode($response_satset->getBody(), true);
            $result = json_decode($responseBody['response'], true);
            
            if(isset($result['metadata']) && $result['metadata']['code'] == '200'){
                return response()->json([
                    'status'=>'success',
                    'url'=>$result['data']['url']
                ]);
            }else{
                return response()->json([
                    'status'=>'error',
                    'message'=>$result['metadata']['message'] ?? 'Unknown error'
                ]);
            }
        }else{
            return $response;
        }
    }
}