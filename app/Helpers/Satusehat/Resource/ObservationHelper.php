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

class ObservationHelper
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
            "resourceType" => "Observation",
            "status" => "final",
            "category" => [
                [
                    "coding" => [
                        [
                            "system" => "http://terminology.hl7.org/CodeSystem/observation-category",
                            "code" => "vital-signs",
                            "display" => "Vital Signs"
                        ]
                    ]
                ]
            ],
            "code" => [
                "coding" => [
                    [
                        "system" => "http://loinc.org",
                        "code" => "8867-4",
                        "display" => "Heart rate"
                    ]
                ]
            ],
            "subject" => [
                "reference" => "Patient/100000030009"
            ],
            "performer" => [
                [
                    "reference" => "Practitioner/N10000001"
                ]
            ],
            "encounter" => [
                "reference" => "Encounter/". $encounter_id,
                "display" => "Pemeriksaan Fisik Nadi Budi Santoso di hari Selasa, 14 Juni 2022"
            ],
            "effectiveDateTime" => "2022-07-14",
            "issued" => "2022-07-14T14:27:00+07:00",
            "valueQuantity" => [
                "value" => 80,
                "unit" => "beats/minute",
                "system" => "http://unitsofmeasure.org",
                "code" => "/min"
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ObservationHelper::token(),
        ])
        ->post(ObservationHelper::url().'/Observation', $data);

        return $response->json();
    }

    public static function searchSubject($subject){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ObservationHelper::token(),
        ])
        ->get(ObservationHelper::url().'/Observation?subject=' . $subject);

        return $response->json();
    }

    public static function searchSubjectEncounter($subject, $encounter_id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ObservationHelper::token(),
        ])
        ->get(ObservationHelper::url().'/Observation?subject=' . $subject . '&encounter=' . $encounter_id);

        return $response->json();
    }

    public static function searchEncounter($encounter_id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ObservationHelper::token(),
        ])
        ->get(ObservationHelper::url().'/Observation?encounter=' . $encounter_id);

        return $response->json();
    }

    public static function searchBasedOn($based_on, $encounter_id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ObservationHelper::token(),
        ])
        ->get(ObservationHelper::url().'/Observation?based-on=' . $based_on . '&subject=' . $encounter_id);

        return $response->json();
    }

    public static function searchId($id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ObservationHelper::token(),
        ])
        ->get(ObservationHelper::url().'/Observation/' . $id);

        return $response->json();
    }

    public static function update($id){
        $encounter_id = 'dummy123';

        $data = [
            "resourceType" => "Observation",
            "status" => "final",
            "id" => "40a8c3c0-89fb-4ed3-b646-399c6a909d8a",
            "category" => [
                [
                    "coding" => [
                        [
                            "system" => "http://terminology.hl7.org/CodeSystem/observation-category",
                            "code" => "vital-signs",
                            "display" => "Vital Signs"
                        ]
                    ]
                ]
            ],
            "code" => [
                "coding" => [
                    [
                        "system" => "http://loinc.org",
                        "code" => "9279-1",
                        "display" => "Respiratory rate"
                    ]
                ]
            ],
            "subject" => [
                "reference" => "Patient/100000030009"
            ],
            "encounter" => [
                "reference" => "Encounter/" . $encounter_id,
                "display" => "Pemeriksaan Fisik Pernafasan Budi Santoso di hari Selasa, 14 Juni 2022"
            ],
            "effectiveDateTime" => "2022-07-14",
            "issued" => "2022-07-14T14:27:00+07:00",
            "valueQuantity" => [
                "value" => 22,
                "unit" => "breaths/minute",
                "system" => "http://unitsofmeasure.org",
                "code" => "/min"
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ObservationHelper::token(),
        ])
        ->put(ObservationHelper::url().'/Observation/' . $id, $data);

        return $response->json();
    }
}
