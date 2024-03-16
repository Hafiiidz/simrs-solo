<?php

namespace App\Helpers\Satusehat\Resource;

use App\Models\Rawat;
use App\Models\Dokter;
use App\Models\Obat\Obat;
use LZCompressor\LZString;
use App\Helpers\VclaimHelper;
use App\Models\Pasien\Pasien;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Helpers\SatusehatAuthHelper;

class EncounterHelper
{
    public static function token(){
        $get_token = SatusehatAuthHelper::generate_token();
        return $get_token['access_token'];
    }

    public static function url(){
        return env('PROD_BASE_URL_SS');
    }

    public static function orgId(){
        return 100026489;
    }

    public static function create(){

        $data = [
            "resourceType"=> "Encounter",
            "identifier"=> [
                [
                    "system"=> "http://sys-ids.kemkes.go.id/encounter/100026489",
                    "value"=> "RJL2024009"
                ]
            ],
            "status"=> "arrived",
            "class"=> [
                "system"=> "http://terminology.hl7.org/CodeSystem/v3-ActCode",
                "code"=> "AMB",
                "display"=> "ambulatory"
            ],
            "subject"=> [
                "reference"=> "Patient/P01133936352",
                "display"=> "Fikri Ramadhan"
            ],
            "participant"=> [
                [
                    "type"=> [
                        [
                            "coding"=> [
                                [
                                    "system"=> "http://terminology.hl7.org/CodeSystem/v3-ParticipationType",
                                    "code"=> "ATND",
                                    "display"=> "attender"
                                ]
                            ]
                        ]
                    ],
                    "individual"=> [
                        "reference"=> "Practitioner/10010107883",
                        "display"=> "INDITO ADJIE"
                    ]
                ]
            ],
            "period"=> [
                "start"=> date('Y-m-d')."T".date('H:i:s')."+07:00"
            ],
            "location"=> [
                [
                    "location"=> [
                        "reference"=> "Location/359f5ff7-61cc-4d43-b11b-b947c3ff450e",
                        "display"=> "MINMED"
                    ]
                ]
            ],
            "statusHistory"=> [
                [
                    "status"=> "arrived",
                    "period"=> [
                        "start"=> date('Y-m-d')."T".date('H:i:s')."+07:00"
                    ]
                ]
            ],
            "serviceProvider"=> [
                "reference"=> "Organization/100026489"
            ],
           
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.EncounterHelper::token(),
        ])
        ->post(EncounterHelper::url().'/Encounter', $data);

        return $response->json();
    }
}
