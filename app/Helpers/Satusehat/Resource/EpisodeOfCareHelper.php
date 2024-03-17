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

class EpisodeOfCareHelper
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
            "resourceType" => "EpisodeOfCare",
            "identifier" => [
                [
                    "system" => "http://sys-ids.kemkes.go.id/episode-of-care/" . EpisodeOfCareHelper::orgId(),
                    "value" => "EOC12345"
                ]
            ],
            "status" => "finished",
            "statusHistory" => [
                [
                    "status" => "active",
                    "period" => [
                        "start" => "2022-01-01",
                        "end" => "2022-06-30"
                    ]
                ],
                [
                    "status" => "finished",
                    "period" => [
                        "start" => "2022-06-30",
                        "end" => "2022-06-30"
                    ]
                ]
            ],
            "type" => [
                [
                    "coding" => [
                        [
                            "system" => "http://terminology.kemkes.go.id/CodeSystem/episodeofcare-type",
                            "code" => "TB-SO",
                            "display" => "Tuberkulosis Sensitif Obat"
                        ]
                    ]
                ]
            ],
            "diagnosis" => [
                [
                    "condition" => [
                        "reference" => "Condition/f51d6f8b-0508-4286-9942-0dc196cca59a",
                        "display" => "Tuberculosis of lung, confirmed by sputum microscopy with or without culture"
                    ],
                    "role" => [
                        "coding" => [
                            [
                                "system" => "http://terminology.hl7.org/CodeSystem/diagnosis-role",
                                "code" => "DD",
                                "display" => "Discharged Diagnosis"
                            ]
                        ]
                    ],
                    "rank" => 1
                ]
            ],
            "patient" => [
                "reference" => "Patient/100000030009",
                "display" => "Budi Santoso"
            ],
            "managingOrganization" => [
                "reference" => "Organization/" . EpisodeOfCareHelper::orgId()
            ],
            "period" => [
                "start" => "2012-01-01",
                "end" => "2012-06-30"
            ],
            "careManager" => [
                "reference" => "Practitioner/N10000001",
                "display" => "Dokter Bronsig"
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.EpisodeOfCareHelper::token(),
        ])
        ->post(EpisodeOfCareHelper::url().'/EpisodeOfCare', $data);

        return $response->json();
    }

    public static function searchSubject($subject){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.EpisodeOfCareHelper::token(),
        ])
        ->get(EpisodeOfCareHelper::url().'/EpisodeOfCare?subject=' . $subject);

        return $response->json();
    }

    public static function searchSubjectCaremanager($subject, $care_manager){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.EpisodeOfCareHelper::token(),
        ])
        ->get(EpisodeOfCareHelper::url().'/EpisodeOfCare?subject=' . $subject . '&organization=' . EpisodeOfCareHelper::orgId() . '&care-manager=' . $care_manager);

        return $response->json();
    }

    public static function searchId($id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.EpisodeOfCareHelper::token(),
        ])
        ->get(EpisodeOfCareHelper::url().'/EpisodeOfCare/' . $id);

        return $response->json();
    }

    public static function update($id){
        $encounter_id = 'dummy123';
        $data = [
            "resourceType" => "EpisodeOfCare",
            "id" => "61c138e4-445a-447d-879c-fe3d5f8fb281",

            "identifier" => [
                [
                    "system" => "http://sys-ids.kemkes.go.id/episode-of-care/" . EpisodeOfCareHelper::orgId(),
                    "value" => "EOC12345"
                ]
            ],
            "status" => "waitlist",
            "statusHistory" => [
                [
                    "status" => "active",
                    "period" => [
                        "start" => "2022-01-01",
                        "end" => "2022-06-30"
                    ]
                ],
                [
                    "status" => "finished",
                    "period" => [
                        "start" => "2022-06-30",
                        "end" => "2022-06-30"
                    ]
                ]
            ],
            "type" => [
                [
                    "coding" => [
                        [
                            "system" => "http://terminology.kemkes.go.id/CodeSystem/episodeofcare-type",
                            "code" => "TB-SO",
                            "display" => "Tuberkulosis Sensitif Obat"
                        ]
                    ]
                ]
            ],
            "diagnosis" => [
                [
                    "condition" => [
                        "reference" => "Condition/f51d6f8b-0508-4286-9942-0dc196cca59a",
                        "display" => "Tuberculosis of lung, confirmed by sputum microscopy with or without culture"
                    ],
                    "role" => [
                        "coding" => [
                            [
                                "system" => "http://terminology.hl7.org/CodeSystem/diagnosis-role",
                                "code" => "DD",
                                "display" => "Discharged Diagnosis"
                            ]
                        ]
                    ],
                    "rank" => 1
                ]
            ],
            "patient" => [
                "reference" => "Patient/100000030009",
                "display" => "Budi Santoso"
            ],
            "managingOrganization" => [
                "reference" => "Organization/" . EpisodeOfCareHelper::orgId()
            ],
            "period" => [
                "start" => "2012-01-01",
                "end" => "2012-06-30"
            ],
            "careManager" => [
                "reference" => "Practitioner/" .EpisodeOfCareHelper::orgId(),
                "display" => "Dokter Budiyana Santosa"
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.EpisodeOfCareHelper::token(),
        ])
        ->put(EpisodeOfCareHelper::url().'/EpisodeOfCare/' . $id, $data);

        return $response->json();
    }
}
