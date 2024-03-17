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

class ClinicalImpressionHelper
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
            "resourceType" => "ClinicalImpression",
            "identifier" => [
                [
                    "system" => "http://sys-ids.kemkes.go.id/clinicalimpression/" . ClinicalImpressionHelper::orgId(),
                    "use" => "official",
                    "value" => "Prognosis_000123"
                ]
            ],
            "status" => "completed",
            "description" => "Bapak Budi Santoso terdiagnosa TB, dan tidak menunjukkan adanya resistensi obat",
            "subject" => [
                "reference" => "Patient/100000030009",
                "display" => "Budi Santoso"
            ],
            "encounter" => [
                "reference" => "Encounter/" . $encounter_id,
                "display" => "Kunjungan Budi Santoso di hari Selasa, 14 Juni 2022"
            ],
            "effectiveDateTime" => "2022-06-14T15:37:31+07:00",
            "date" => "2022-06-14T15:15:31+07:00",
            "assessor" => [
                "reference" => "Practitioner/N10000001"
            ],
            "problem" => [
                [
                    "reference" => "Condition/f2bc12fe-0ab2-4e5c-a3cd-32c66150cbe9"
                ]
            ],
            "investigation" => [
                [
                    "code" => [
                        "text" => "Pemeriksaan Sputum BTA"
                    ],
                    "item" => [
                        [
                            "reference" => "DiagnosticReport/a0fa6244-7638-43ba-bbc2-2af954761540"
                        ],
                        [
                            "reference" => "Observation/56819f05-28b9-43c2-b0d1-3785768aa886"
                        ]
                    ]
                ]
            ],
            "summary" => "Prognosis terhadap gejala klinis dan terkonfirmasi Tuberculosis",
            "finding" => [
                [
                    "itemCodeableConcept" => [
                        "coding" => [
                            [
                                "system" => "http://hl7.org/fhir/sid/icd-10",
                                "code" => "A15.0",
                                "display" => "Tuberculosis of lung, confirmed by sputum microscopy with or without culture"
                            ]
                        ]
                    ],
                    "itemReference" => [
                        "reference" => "Condition/f2bc12fe-0ab2-4e5c-a3cd-32c66150cbe9"
                    ]
                ]
            ],
            "prognosisCodeableConcept" => [
                [
                    "coding" => [
                        [
                            "system" => "http://snomed.info/sct",
                            "code" => "170968001",
                            "display" => "Prognosis good"
                        ]
                    ]
                ]
            ]
        ];
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ClinicalImpressionHelper::token(),
        ])
        ->post(ClinicalImpressionHelper::url().'/ClinicalImpression', $data);

        return $response->json();
    }

    public static function searchSubjectEncounter($subject, $encounter_id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ClinicalImpressionHelper::token(),
        ])
        ->get(ClinicalImpressionHelper::url().'/ClinicalImpression?subject=' . $subject . '&encounter=' . $encounter_id);

        return $response->json();
    }

    public static function searchId($id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ClinicalImpressionHelper::token(),
        ])
        ->get(ClinicalImpressionHelper::url().'/ClinicalImpression/' . $id);

        return $response->json();
    }

    public static function update($id){
        $encounter_id = 'dummy123';
        $data = [
            "resourceType" => "ClinicalImpression",
            "id" => $id,
            "identifier" => [
                [
                    "system" => "http://sys-ids.kemkes.go.id/clinicalimpression/". ClinicalImpressionHelper::orgId(),
                    "use" => "official",
                    "value" => "Prognosis_000123"
                ]
            ],
            "status" => "completed",
            "description" => "Bapak Budi Santoso terdiagnosa TB, dan tidak menunjukkan adanya resistensi obat",
            "subject" => [
                "reference" => "Patient/100000030009",
                "display" => "Budi Santoso"
            ],
            "encounter" => [
                "reference" => "Encounter/" . $encounter_id,
                "display" => "Kunjungan Budi Santoso di hari Selasa, 14 Juni 2022"
            ],
            "effectiveDateTime" => "2022-06-14T15:37:31+07:00",
            "date" => "2022-06-14T15:15:31+07:00",
            "assessor" => [
                "reference" => "Practitioner/N10000001"
            ],
            "problem" => [
                [
                    "reference" => "Condition/f2bc12fe-0ab2-4e5c-a3cd-32c66150cbe9"
                ]
            ],
            "investigation" => [
                [
                    "code" => [
                        "text" => "Pemeriksaan Sputum BTA"
                    ],
                    "item" => [
                        [
                            "reference" => "DiagnosticReport/a0fa6244-7638-43ba-bbc2-2af954761540"
                        ],
                        [
                            "reference" => "Observation/56819f05-28b9-43c2-b0d1-3785768aa886"
                        ]
                    ]
                ]
            ],
            "summary" => "Prognosis terhadap gejala klinis dan terkonfirmasi Tuberculosis",
            "finding" => [
                [
                    "itemCodeableConcept" => [
                        "coding" => [
                            [
                                "system" => "http://hl7.org/fhir/sid/icd-10",
                                "code" => "A15.0",
                                "display" => "Tuberculosis of lung, confirmed by sputum microscopy with or without culture"
                            ]
                        ]
                    ],
                    "itemReference" => [
                        "reference" => "Condition/f2bc12fe-0ab2-4e5c-a3cd-32c66150cbe9"
                    ]
                ]
            ],
            "prognosisCodeableConcept" => [
                [
                    "coding" => [
                        [
                            "system" => "http://snomed.info/sct",
                            "code" => "65872000",
                            "display" => "Fair prognosis"
                        ]
                    ]
                ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ClinicalImpressionHelper::token(),
        ])
        ->put(ClinicalImpressionHelper::url().'/ClinicalImpression/' . $id, $data);

        return $response->json();
    }
}
