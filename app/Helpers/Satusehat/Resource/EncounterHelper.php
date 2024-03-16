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
        return env('STG_BASE_URL_SS');
    }

    public static function orgId(){
        return 100026489;
    }

    public static function create(){

        $data = [
            "resourceType"=> "Encounter",
            "status"=> "arrived",
            "class"=> [
                "system"=> "http=>//terminology.hl7.org/CodeSystem/v3-ActCode",
                "code"=> "AMB",
                "display"=> "ambulatory"
            ],
            "subject"=> [
                "reference"=> "Patient/100000030009",
                "display"=> "Budi Santoso"
            ],
            "participant"=> [
                [
                    "type"=> [
                        [
                            "coding"=> [
                                [
                                    "system"=> "http=>//terminology.hl7.org/CodeSystem/v3-ParticipationType",
                                    "code"=> "ATND",
                                    "display"=> "attender"
                                ]
                            ]
                        ]
                    ],
                    "individual"=> [
                        "reference"=> "Practitioner/N10000001",
                        "display"=> "Dokter Bronsig"
                    ]
                ]
            ],
            "period"=> [
                "start"=> "2022-06-14T07:00:00+07:00"
            ],
            "location"=> [
                [
                    "location"=> [
                        "reference"=> "Location/b017aa54-f1df-4ec2-9d84-8823815d7228",
                        "display"=> "Ruang 1A, Poliklinik Bedah Rawat Jalan Terpadu, Lantai 2, Gedung G"
                    ]
                ]
            ],
            "statusHistory"=> [
                [
                    "status"=> "arrived",
                    "period"=> [
                        "start"=> "2022-06-14T07:00:00+07:00"
                    ]
                ]
            ],
            "serviceProvider"=> [
                "reference"=> "Organization/" . EncounterHelper::orgId()
            ],
            "identifier"=> [
                [
                    "system"=> "http=>//sys-ids.kemkes.go.id/encounter/" . EncounterHelper::orgId(),
                    "value"=> "P20240001"
                ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.EncounterHelper::token(),
        ])
        ->post(EncounterHelper::url().'/Encounter', $data);

        return $response->json();
    }
}
