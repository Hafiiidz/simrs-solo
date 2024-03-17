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

class AllergyIntoleranceHelper
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
            "resourceType"=> "AllergyIntolerance",
            "identifier"=> [
                [
                    "system"=> "http://sys-ids.kemkes.go.id/allergy/". AllergyIntoleranceHelper::orgId(),
                    "use"=> "official",
                    "value"=> "98457729"
                ]
            ],
            "clinicalStatus"=> [
                "coding"=> [
                    [
                        "system"=> "http://terminology.hl7.org/CodeSystem/allergyintolerance-clinical",
                        "code"=> "active",
                        "display"=> "Active"
                    ]
                ]
            ],
            "verificationStatus"=> [
                "coding"=> [
                    [
                        "system"=> "http://terminology.hl7.org/CodeSystem/allergyintolerance-verification",
                        "code"=> "confirmed",
                        "display"=> "Confirmed"
                    ]
                ]
            ],
            "category"=> [
                "food"
            ],
            "code"=> [
                "coding"=> [
                    [
                        "system"=> "http://snomed.info/sct",
                        "code"=> "89811004",
                        "display"=> "Gluten"
                    ]
                ],
                "text"=> "Alergi bahan gluten, khususnya ketika makan roti gandum"
            ],
            "patient"=> [
                "reference"=> "Patient/100000030009",
                "display"=> "Budi Santoso"
            ],
            "encounter"=> [
                "reference"=> "Encounter/" . $encounter_id,
                "display"=> "Kunjungan Budi Santoso di hari Selasa, 14 Juni 2022"
            ],
            "recordedDate"=> "2022-06-14T15:37:31+07:00",
            "recorder"=> [
                "reference"=> "Practitioner/N10000001"
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.AllergyIntoleranceHelper::token(),
        ])
        ->post(AllergyIntoleranceHelper::url().'/AllergyIntolerance', $data);

        return $response->json();
    }

    public static function searchPatientCode($patient, $code){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.AllergyIntoleranceHelper::token(),
        ])
        ->get(AllergyIntoleranceHelper::url().'/AllergyIntolerance?patient=' . $patient . '&code=' . $code);

        return $response->json();
    }

    public static function searchId($id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.AllergyIntoleranceHelper::token(),
        ])
        ->get(AllergyIntoleranceHelper::url().'/AllergyIntolerance/' . $id);

        return $response->json();
    }

    public static function update($id){
        $encounter_id = 'dummy123';
        $data = [
            "resourceType" => "AllergyIntolerance",
            "id" => $id,
            "identifier" => [
                [
                    "system" => "http://sys-ids.kemkes.go.id/allergy/[[Org_id]]",
                    "use" => "official",
                    "value" => "98457729"
                ]
            ],
            "clinicalStatus" => [
                "coding" => [
                    [
                        "system" => "http://terminology.hl7.org/CodeSystem/allergyintolerance-clinical",
                        "code" => "resolved",
                        "display" => "resolved"
                    ]
                ]
            ],
            "verificationStatus" => [
                "coding" => [
                    [
                        "system" => "http://terminology.hl7.org/CodeSystem/allergyintolerance-verification",
                        "code" => "confirmed",
                        "display" => "Confirmed"
                    ]
                ]
            ],
            "category" => [
                "food"
            ],
            "code" => [
                "coding" => [
                    [
                        "system" => "http://snomed.info/sct",
                        "code" => "89811004",
                        "display" => "Gluten"
                    ]
                ],
                "text" => "Alergi bahan gluten, khususnya ketika makan roti gandum"
            ],
            "patient" => [
                "reference" => "Patient/100000030009",
                "display" => "Budi Santoso"
            ],
            "encounter" => [
                "reference" => "Encounter/". $encounter_id,
                "display" => "Kunjungan Budi Santoso di hari Selasa, 14 Juni 2022"
            ],
            "recordedDate" => "2022-06-14T15:37:31+07:00",
            "recorder" => [
                "reference" => "Practitioner/N10000001"
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.AllergyIntoleranceHelper::token(),
        ])
        ->put(AllergyIntoleranceHelper::url().'/AllergyIntolerance/' . $id, $data);

        return $response->json();
    }
}
