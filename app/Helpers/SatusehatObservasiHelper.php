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

class SatusehatObservasiHelper
{
    #Observation - Create
    public static function create($id){
        $rawat = Rawat::find($id);
        $pasien = Pasien::where('no_rm', $rawat->no_rm)->first();
        $rekap_medis = DB::table('demo_detail_rekap_medis')->where('idrawat',$id)->first();
        $data = [
            'resourceType' => 'Observation',
            'status' => 'final',
            'category' => [
                [
                    'coding' => [
                        [
                            'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                            'code' => 'vital-signs',
                            'display' => 'Vital Signs'
                        ]
                    ]
                ]
            ],
            'code' => [
                'coding' => [
                    [
                        'system' => 'http://loinc.org',
                        'code' => '8867-4',
                        'display' => 'Heart rate'
                    ]
                ]
            ],
            'subject' => [
                'reference' => 'Patient/'.$pasien->kode_ihs
            ],
            'encounter' => [
                'reference' => 'Encounter/'.$rawat->kode_ihs
            ],
            'effectiveDateTime' => Carbon::now()->format('Y-m-d\TH:i:s\Z'),
            'valueQuantity' => [
                'value' => 36.5,
                'unit' => 'Cel',
                'system' => 'http://unitsofmeasure.org',
                'code' => 'Cel'
            ]
        ];
        $get_token = SatusehatAuthHelper::generate_token();
        $token = $get_token['access_token'];
        $url = env('PROD_BASE_URL_SS');
        $response = Http::withOptions(["verify" => SatusehatAuthHelper::ssl()])
        ->withHeaders([
            'Authorization' => 'Bearer '.$token,
            'Content-Type' => 'application/fhir+json'
        ])
        ->post($url.'/Observation', $data);
        return $response->json();
    }   
}