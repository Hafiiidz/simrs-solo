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

class FamilyMemberHistoryHelper
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
            "resourceType" => "FamilyMemberHistory",
            "status" => "completed",
            "relationship" => [
                "coding" => [
                    [
                        "system" => "http://snomed.info/sct",
                        "code" => "38048003",
                        "display" => "Uncle"
                    ]
                ]
            ],
            "deceasedBoolean" => true,
            "patient" => [
                "reference" => "Patient/P02280547535",
                "display" => "patient 6"
            ],
            "condition" => [
                [
                    "code" => [
                        "coding" => [
                            [
                                "system" => "http://snomed.info/sct",
                                "code" => "115665000",
                                "display" => "Atopy"
                            ]
                        ]
                    ],
                    "outcome" => [
                        "coding" => [
                            [
                                "system" => "http://snomed.info/sct",
                                "code" => "419099009",
                                "display" => "Died"
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.FamilyMemberHistoryHelper::token(),
        ])
        ->post(FamilyMemberHistoryHelper::url().'/FamilyMemberHistory', $data);

        return $response->json();
    }

    public static function searchId($id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.FamilyMemberHistoryHelper::token(),
        ])
        ->get(FamilyMemberHistoryHelper::url().'/FamilyMemberHistory/' . $id);

        return $response->json();
    }

    public static function searchSubject($relationship, $patient){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.FamilyMemberHistoryHelper::token(),
        ])
        ->get(FamilyMemberHistoryHelper::url().'/FamilyMemberHistory?relationship=' . $subject . '&patient=' . $patient);

        return $response->json();
    }

    public static function update($id){
        $encounter_id = 'dummy123';
        $data = [
            "resourceType" => "FamilyMemberHistory",
            "id" => $id,
            "status" => "completed",
            "relationship" => [
                "coding" => [
                    [
                        "system" => "http://snomed.info/sct",
                        "code" => "72705000",
                        "display" => "Mother"
                    ]
                ]
            ],
            "deceasedBoolean" => true,
            "patient" => [
                "reference" => "Patient/P02280547535",
                "display" => "patient 6"
            ],
            "condition" => [
                [
                    "code" => [
                        "coding" => [
                            [
                                "system" => "http://snomed.info/sct",
                                "code" => "115665000",
                                "display" => "Atopy"
                            ]
                        ]
                    ],
                    "outcome" => [
                        "coding" => [
                            [
                                "system" => "http://snomed.info/sct",
                                "code" => "419099009",
                                "display" => "Died"
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.FamilyMemberHistoryHelper::token(),
        ])
        ->put(FamilyMemberHistoryHelper::url().'/FamilyMemberHistory/' . $id, $data);

        return $response->json();
    }
}
