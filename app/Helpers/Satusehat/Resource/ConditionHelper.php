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

class ConditionHelper
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

    public static function createDiagnosis(){
        $encounter_id = 'dummy123';

        $data = [
            "resourceType"=> "Condition",
            "clinicalStatus"=> [
               "coding"=> [
                  [
                     "system"=> "http://terminology.hl7.org/CodeSystem/condition-clinical",
                     "code"=> "active",
                     "display"=> "Active"
                  ]
               ]
            ],
            "category"=> [
               [
                  "coding"=> [
                     [
                        "system"=> "http://terminology.hl7.org/CodeSystem/condition-category",
                        "code"=> "encounter-diagnosis",
                        "display"=> "Encounter Diagnosis"
                     ]
                  ]
               ]
            ],
            "code"=> [
               "coding"=> [
                  [
                     "system"=> "http://hl7.org/fhir/sid/icd-10",
                     "code"=> "K35.8",
                     "display"=> "Acute appendicitis, other and unspecified"
                  ]
               ]
            ],
            "subject"=> [
               "reference"=> "Patient/100000030009",
               "display"=> "Budi Santoso"
            ],
            "encounter"=> [
               "reference"=> "Encounter/" . $encounter_id,
               "display"=> "Kunjungan Budi Santoso di hari Selasa, 14 Juni 2022"
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ConditionHelper::token(),
        ])
        ->post(ConditionHelper::url().'/Condition', $data);

        return $response->json();
    }

    public static function createFaskes(){
        $encounter_id = 'dummy123';

        $data = [
            "resourceType" => "Condition",
            "clinicalStatus" => [
                "coding" => [
                    [
                        "system" => "http://terminology.hl7.org/CodeSystem/condition-clinical",
                        "code" => "active",
                        "display" => "Active"
                    ]
                ]
            ],
            "category" => [
                [
                    "coding" => [
                        [
                            "system" => "http://terminology.hl7.org/CodeSystem/condition-category",
                            "code" => "encounter-diagnosis",
                            "display" => "Encounter Diagnosis"
                        ]
                    ]
                ]
            ],
            "code" => [
                "coding" => [
                    [
                        "system" => "http://snomed.info/sct",
                        "code" => "359746009",
                        "display" => "Patient's condition stable"
                    ]
                ]
            ],
            "subject" => [
                "reference" => "Patient/100000030009",
                "display" => "Budi Santoso"
            ],
            "encounter" => [
                "reference" => "Encounter/". $encounter_id,
                "display" => "Kunjungan Budi Santoso di hari Selasa, 14 Juni 2022"
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ConditionHelper::token(),
        ])
        ->post(ConditionHelper::url().'/Condition', $data);

        return $response->json();
    }

    public static function searchSubject($subject){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ConditionHelper::token(),
        ])
        ->get(ConditionHelper::url().'/Condition?subject=' . $subject);

        return $response->json();
    }

    public static function searchSubjectEncounter($subject, $encounter_id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ConditionHelper::token(),
        ])
        ->get(ConditionHelper::url().'/Condition?subject=' . $subject . '&encounter=' . $encounter_id);

        return $response->json();
    }

    public static function searchEncounter($encounter_id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ConditionHelper::token(),
        ])
        ->get(ConditionHelper::url().'/Condition?encounter=' . $encounter_id);

        return $response->json();
    }

    public static function searchId($id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ConditionHelper::token(),
        ])
        ->get(ConditionHelper::url().'/Condition/' . $id);

        return $response->json();
    }

    public static function update($id){

        $data = [
            "resourceType" => "Condition",
            "id" => "f1369adf-26f6-47a5-90f2-ce08442639aa",
            "clinicalStatus" => [
                "coding" => [
                    [
                        "system" => "http://terminology.hl7.org/CodeSystem/condition-clinical",
                        "code" => "remission",
                        "display" => "Remission"
                    ]
                ]
            ],
            "category" => [
                [
                    "coding" => [
                        [
                            "system" => "http://terminology.hl7.org/CodeSystem/condition-category",
                            "code" => "encounter-diagnosis",
                            "display" => "Encounter Diagnosis"
                        ]
                    ]
                ]
            ],
            "code" => [
                "coding" => [
                    [
                        "system" => "http://hl7.org/fhir/sid/icd-10",
                        "code" => "K35.8",
                        "display" => "Acute appendicitis, other and unspecified"
                    ]
                ]
            ],
            "subject" => [
                "reference" => "Patient/100000030009",
                "display" => "Budi Santoso"
            ],
            "encounter" => [
                "reference" => "Encounter/[[Encounter_uuid]]",
                "display" => "Kunjungan Budi Santoso di hari Selasa, 14 Juni 2022"
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ConditionHelper::token(),
        ])
        ->put(ConditionHelper::url().'/Condition/' . $id, $data);

        return $response->json();
    }
}
