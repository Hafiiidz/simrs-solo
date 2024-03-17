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

class CompositionHelper
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

    public static function EdukasiDiet($encounter_id){

        $data = [
            "resourceType" => "Composition",
            "identifier" => [
                "system" => "http://sys-ids.kemkes.go.id/composition/" . CompositionHelper::orgId(),
                "value" => "P20240001"
            ],
            "status" => "final",
            "type" => [
                "coding" => [
                    [
                        "system" => "http://loinc.org",
                        "code" => "18842-5",
                        "display" => "Discharge summary"
                    ]
                ]
            ],
            "category" => [
                [
                    "coding" => [
                        [
                            "system" => "http://loinc.org",
                            "code" => "LP173421-1",
                            "display" => "Report"
                        ]
                    ]
                ]
            ],
            "subject" => [
                "reference" => "Patient/100000030009",
                "display" => "Budi Santoso"
            ],
            "encounter" => [
                "reference" => "Encounter/" . $encounter_id,
                "display" => "Kunjungan Budi Santoso di hari Selasa, 14 Juni 2022"
            ],
            "date" => "2022-06-14",
            "author" => [
                [
                    "reference" => "Practitioner/N10000001",
                    "display" => "Dokter Bronsig"
                ]
            ],
            "title" => "Resume Medis Rawat Jalan",
            "custodian" => [
                "reference" => "Organization/[[Org_id]]"
            ],
            "section" => [
                [
                    "code" => [
                        "coding" => [
                            [
                                "system" => "http://loinc.org",
                                "code" => "42344-2",
                                "display" => "Discharge diet (narrative)"
                            ]
                        ]
                    ],
                    "text" => [
                        "status" => "additional",
                        "div" => "Rekomendasi diet rendah lemak, rendah kalori"
                    ]
                ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.CompositionHelper::token(),
        ])
        ->post(CompositionHelper::url().'/Composition', $data);

        return $response->json();
    }

    public static function searchSubject($subject){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.CompositionHelper::token(),
        ])
        ->get(CompositionHelper::url().'/Composition?subject=' . $subject);

        return $response->json();
    }

    public static function searchSubjectEncounter($subject, $encounter_id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.CompositionHelper::token(),
        ])
        ->get(CompositionHelper::url().'/Composition?subject=' . $subject . '&encounter=' . $encounter_id);

        return $response->json();
    }

    public static function searchEncounter($encounter_id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.CompositionHelper::token(),
        ])
        ->get(CompositionHelper::url().'/Composition?encounter=' . $encounter_id);

        return $response->json();
    }

    public static function searchId($id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.CompositionHelper::token(),
        ])
        ->get(CompositionHelper::url().'/Composition/' . $id);

        return $response->json();
    }

    public static function update($id){

        $data = [
            "resourceType" => "Composition",
            "id" => $id,
            "identifier" => [
                "system" => "http://sys-ids.kemkes.go.id/composition/"  . CompositionHelper::orgId(),
                "value" => "P20240001"
            ],
            "status" => "final",
            "type" => [
                "coding" => [
                    [
                        "system" => "http://loinc.org",
                        "code" => "18842-5",
                        "display" => "Discharge summary"
                    ]
                ]
            ],
            "category" => [
                [
                    "coding" => [
                        [
                            "system" => "http://loinc.org",
                            "code" => "LP173421-1",
                            "display" => "Report"
                        ]
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
            ],
            "date" => "2022-06-14",
            "author" => [
                [
                    "reference" => "Practitioner/N10000001",
                    "display" => "Dokter Bronsig"
                ]
            ],
            "title" => "Resume Medis Rawat Jalan",
            "custodian" => [
                "reference" => "Organization/[[Org_id]]"
            ],
            "section" => [
                [
                    "code" => [
                        "coding" => [
                            [
                                "system" => "http://loinc.org",
                                "code" => "42344-2",
                                "display" => "Discharge diet (narrative)"
                            ]
                        ]
                    ],
                    "text" => [
                        "status" => "additional",
                        "div" => "Rekomendasi diet rendah karbohidrat"
                    ]
                ]
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
