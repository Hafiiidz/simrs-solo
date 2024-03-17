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

class DiagnosticReportHelper
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
            "resourceType" => "DiagnosticReport",
            "identifier" => [
                [
                    "system" => "http://sys-ids.kemkes.go.id/diagnostic/". DiagnosticReportHelper::orgId() ."/lab",
                    "use" => "official",
                    "value" => "5234342"
                ]
            ],
            "status" => "final",
            "category" => [
                [
                    "coding" => [
                        [
                            "system" => "http://terminology.hl7.org/CodeSystem/v2-0074",
                            "code" => "MB",
                            "display" => "Microbiology"
                        ]
                    ]
                ]
            ],
            "code" => [
                "coding" => [
                    [
                        "system" => "http://loinc.org",
                        "code" => "11477-7",
                        "display" => "Microscopic observation [Identifier] in Sputum by Acid fast stain"
                    ]
                ]
            ],
            "subject" => [
                "reference" => "Patient/100000030009"
            ],
            "encounter" => [
                "reference" => "Encounter/[[Encounter_uuid]]"
            ],
            "effectiveDateTime" => "2012-12-01T12:00:00+01:00",
            "issued" => "2012-12-01T12:00:00+01:00",
            "performer" => [
                [
                    "reference" => "Practitioner/N10000001"
                ],
                [
                    "reference" => "Organization/" . DiagnosticReportHelper::orgId()
                ]
            ],
            "result" => [
                [
                    "reference" => "Observation/dc0b1b9c-d2c8-4830-b8bb-d73c68174f02"
                ]
            ],
            "specimen" => [
                [
                    "reference" => "Specimen/3095e36e-1624-487e-9ee4-737387e7b55f"
                ]
            ],
            "conclusionCode" => [
                [
                    "coding" => [
                        [
                            "system" => "http://snomed.info/sct",
                            "code" => "260347006",
                            "display" => "+"
                        ]
                    ]
                ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.DiagnosticReportHelper::token(),
        ])
        ->post(DiagnosticReportHelper::url().'/DiagnosticReport', $data);

        return $response->json();
    }

    public static function searchSubject($subject){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.DiagnosticReportHelper::token(),
        ])
        ->get(DiagnosticReportHelper::url().'/DiagnosticReport?subject=' . $subject);

        return $response->json();
    }

    public static function searchSubjectEncounter($subject, $encounter_id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.DiagnosticReportHelper::token(),
        ])
        ->get(DiagnosticReportHelper::url().'/DiagnosticReport?subject=' . $subject . '&encounter=' . $encounter_id);

        return $response->json();
    }

    public static function searchEncounter($encounter_id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.DiagnosticReportHelper::token(),
        ])
        ->get(DiagnosticReportHelper::url().'/DiagnosticReport?encounter=' . $encounter_id);

        return $response->json();
    }

    public static function searchSubjectSpecimen($specimen, $subject){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.DiagnosticReportHelper::token(),
        ])
        ->get(DiagnosticReportHelper::url().'/DiagnosticReport?specimen=' . $specimen . '&subject=' . $subject);

        return $response->json();
    }

    public static function searchId($id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.DiagnosticReportHelper::token(),
        ])
        ->get(DiagnosticReportHelper::url().'/DiagnosticReport/' . $id);

        return $response->json();
    }

    public static function update($id){
        $encounter_id = 'dummy123';
        $data = [
            "resourceType"=> "DiagnosticReport",
            "id"=> $id,
            "identifier"=> [
                [
                    "system"=> "http://sys-ids.kemkes.go.id/diagnostic/". DiagnosticReportHelper::orgId() ."/lab",
                    "use"=> "official",
                    "value"=> "5234342"
                ]
            ],
            "status"=> "final",
            "category"=> [
                [
                    "coding"=> [
                        [
                            "system"=> "http://terminology.hl7.org/CodeSystem/v2-0074",
                            "code"=> "MB",
                            "display"=> "Microbiology"
                        ]
                    ]
                ]
            ],
            "code"=> [
                "coding"=> [
                    [
                        "system"=> "http://loinc.org",
                        "code"=> "11477-7",
                        "display"=> "Microscopic observation [Identifier] in Sputum by Acid fast stain"
                    ]
                ]
            ],
            "subject"=> [
                "reference"=> "Patient/100000030009"
            ],
            "encounter"=> [
                "reference"=> "Encounter/[[Encounter_uuid]]"
            ],
            "effectiveDateTime"=> "2012-12-01T12:00:00+01:00",
            "issued"=> "2012-12-01T12:00:00+01:00",
            "performer"=> [
                [
                    "reference"=> "Practitioner/N10000001"
                ],
                [
                    "reference"=> "Organization/" . DiagnosticReportHelper::orgId()
                ]
            ],
            "result"=> [
                [
                    "reference"=> "Observation/dc0b1b9c-d2c8-4830-b8bb-d73c68174f02"
                ]
            ],
            "specimen"=> [
                [
                    "reference"=> "Specimen/3095e36e-1624-487e-9ee4-737387e7b55f"
                ]
            ],
            "conclusionCode"=> [
                [
                    "coding"=> [
                        [
                            "system"=> "http://snomed.info/sct",
                            "code"=> "2667000",
                            "display"=> "Absent"
                        ]
                    ]
                ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.DiagnosticReportHelper::token(),
        ])
        ->put(DiagnosticReportHelper::url().'/DiagnosticReport/' . $id, $data);

        return $response->json();
    }
}
