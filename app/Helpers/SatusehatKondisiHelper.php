<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Models\Rawat;
use App\Models\Dokter;
use App\Models\Obat\Obat;
use LZCompressor\LZString;
use App\Helpers\VclaimHelper;
use App\Models\Pasien\Pasien;
use Illuminate\Support\Facades\DB;
use App\Helpers\SatusehatAuthHelper;
use Illuminate\Support\Facades\Http;

class SatusehatKondisiHelper
{

    public static function ssl(){
        if (config('app.env') == 'production') {
            return true;
        } else {
            return false;        }

    }

   public static function create_kondisi($id){
    $rawat = Rawat::find($id);
    $pasien = Pasien::where('no_rm', $rawat->no_rm)->first();
    $rekap_medis = DB::table('demo_detail_rekap_medis')->where('idrawat',$id)->first();
    // return $rekap_medis;
    $diagnosa =  [];
    foreach(json_decode($rekap_medis->icdx) as $value){
        $split = explode(' - ', $value->diagnosa_icdx);
        $diagnosa[] = 
            [
                'system' => 'http://hl7.org/fhir/sid/icd-10',
                'code' => $split[0],
                'display' => $split[1]
            ];
        
    }
    // return $diagnosa;
    $data = [
        'resourceType' => 'Condition',
        'clinicalStatus' => [
            'coding' => [
                [
                    'system' => 'http://terminology.hl7.org/CodeSystem/condition-clinical',
                    'code' => 'active',
                    'display' => 'Active'
                ]
            ]
        ],
        'category' => [
            [
                'coding' => [
                    [
                        'system' => 'http://terminology.hl7.org/CodeSystem/condition-category',
                        'code' => 'encounter-diagnosis',
                        'display' => 'Encounter Diagnosis'
                    ]
                ]
            ]
        ],
        'code' => [
            'coding' => $diagnosa
        ],
        'subject' => [
            'reference' => 'Patient/'.$pasien->ihs,
            'display' => $pasien->nama_pasien
        ],
        'encounter' => [
            'reference' => 'Encounter/'.$rawat->id_encounter,
            'display' => 'Kunjungan '.$pasien->nama_pasien.' '.\Carbon\Carbon::parse($rawat->tglmasuk)->formatLocalized('%A %d %B %Y')
        ]
    ];
    // return $data;
    $url = env('PROD_BASE_URL_SS');
    // return $url;
    $get_token = SatusehatAuthHelper::generate_token();
    $token = $get_token['access_token'];
    $response = Http::withOptions(["verify" => SatusehatAuthHelper::ssl()])
        ->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])->post($url.'/Condition',$data);
    return $response->json();

    // return $data;
    }
}
