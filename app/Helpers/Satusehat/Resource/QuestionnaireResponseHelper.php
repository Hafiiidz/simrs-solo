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

class QuestionnaireResponseHelper
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
        $encounter_id = 'dummy123';
        $data = [
            "resourceType" => "QuestionnaireResponse",
            "questionnaire" => "https://fhir.kemkes.go.id/Questionnaire/Q0002",
            "status" => "completed",
            "subject" => [
                "reference" => "Patient/P02280547535",
                "display" => "patient 6"
            ],
            "encounter" => [
                "reference" => "Encounter/" . $encounter_id
            ],
            "authored" => "2022-07-26T10:00:00+07:00",
            "author" => [
                "reference" => "Practitioner/N10000001"
            ],
            "source" => [
                "reference" => "Patient/P02280547535"
            ],
            "item" => [
                [
                    "linkId" => "1",
                    "text" => "Status Kesejahteraan",
                    "answer" => [
                        [
                            "valueCoding" => [
                                "system" => "http://terminology.kemkes.go.id/CodeSystem/keluarga-sejahtera",
                                "code" => "KPS",
                                "display" => "Keluarga Pra Sejahtera (KPS)"
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.QuestionnaireResponseHelper::token(),
        ])
        ->post(QuestionnaireResponseHelper::url().'/QuestionnaireResponse', $data);

        return $response->json();
    }

    public static function update($id){
        $encounter_id = 'dummy123';
        $data = [
            "resourceType" => "QuestionnaireResponse",
            "id" => $id,
            "questionnaire" => "https://fhir.kemkes.go.id/Questionnaire/Q0002",
            "status" => "completed",
            "subject" => [
                "reference" => "Patient/P02280547535",
                "display" => "patient 6"
            ],
            "encounter" => [
                "reference" => "Encounter/" . $encounter_id
            ],
            "authored" => "2022-07-26T10:00:00+07:00",
            "author" => [
                "reference" => "Practitioner/N10000001"
            ],
            "source" => [
                "reference" => "Patient/P02280547535"
            ],
            "item" => [
                [
                    "linkId" => "1",
                    "text" => "Status Kesejahteraan",
                    "answer" => [
                        [
                            "valueCoding" => [
                                "system" => "http://terminology.kemkes.go.id/CodeSystem/keluarga-sejahtera",
                                "code" => "KPS",
                                "display" => "Keluarga Pra Sejahtera (KPS)"
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.QuestionnaireResponseHelper::token(),
        ])
        ->put(QuestionnaireResponseHelper::url().'/QuestionnaireResponse/' . $id, $data);

        return $response->json();
    }

    public static function searchSubject($encounter, $patient){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.QuestionnaireResponseHelper::token(),
        ])
        ->get(QuestionnaireResponseHelper::url().'/QuestionnaireResponse?encounter=' . $encounter . '&patient=' . $patient);

        return $response->json();
    }

    public static function searchId($id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.QuestionnaireResponseHelper::token(),
        ])
        ->get(QuestionnaireResponseHelper::url().'/QuestionnaireResponse/' . $id);

        return $response->json();
    }
}
