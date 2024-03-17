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

class MedicationHelper
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
        $encounter_id = 'dummy_123';
        $data = [
            "resourceType" => "Medication",
            "meta" => [
                "profile" => [
                    "https://fhir.kemkes.go.id/r4/StructureDefinition/Medication"
                ]
            ],
            "identifier" => [
                [
                    "system" => "http://sys-ids.kemkes.go.id/medication/" . MedicationHelper::orgId(),
                    "use" => "official",
                    "value" => "123456789"
                ]
            ],
            "code" => [
                "coding" => [
                    [
                        "system" => "http://sys-ids.kemkes.go.id/kfa",
                        "code" => "93001019",
                        "display" => "Obat Anti Tuberculosis / Rifampicin 150 mg / Isoniazid 75 mg / Pyrazinamide 400 mg / Ethambutol 275 mg Kaplet Salut Selaput (KIMIA FARMA)"
                    ]
                ]
            ],
            "status" => "active",
            "manufacturer" => [
                "reference" => "Organization/900001"
            ],
            "form" => [
                "coding" => [
                    [
                        "system" => "http://terminology.kemkes.go.id/CodeSystem/medication-form",
                        "code" => "BS023",
                        "display" => "Kaplet Salut Selaput"
                    ]
                ]
            ],
            "ingredient" => [
                [
                    "itemCodeableConcept" => [
                        "coding" => [
                            [
                                "system" => "http://sys-ids.kemkes.go.id/kfa",
                                "code" => "91000330",
                                "display" => "Rifampin"
                            ]
                        ]
                    ],
                    "isActive" => true,
                    "strength" => [
                        "numerator" => [
                            "value" => 150,
                            "system" => "http://unitsofmeasure.org",
                            "code" => "mg"
                        ],
                        "denominator" => [
                            "value" => 1,
                            "system" => "http://terminology.hl7.org/CodeSystem/v3-orderableDrugForm",
                            "code" => "TAB"
                        ]
                    ]
                ],
                [
                    "itemCodeableConcept" => [
                        "coding" => [
                            [
                                "system" => "http://sys-ids.kemkes.go.id/kfa",
                                "code" => "91000328",
                                "display" => "Isoniazid"
                            ]
                        ]
                    ],
                    "isActive" => true,
                    "strength" => [
                        "numerator" => [
                            "value" => 75,
                            "system" => "http://unitsofmeasure.org",
                            "code" => "mg"
                        ],
                        "denominator" => [
                            "value" => 1,
                            "system" => "http://terminology.hl7.org/CodeSystem/v3-orderableDrugForm",
                            "code" => "TAB"
                        ]
                    ]
                ],
                [
                    "itemCodeableConcept" => [
                        "coding" => [
                            [
                                "system" => "http://sys-ids.kemkes.go.id/kfa",
                                "code" => "91000329",
                                "display" => "Pyrazinamide"
                            ]
                        ]
                    ],
                    "isActive" => true,
                    "strength" => [
                        "numerator" => [
                            "value" => 400,
                            "system" => "http://unitsofmeasure.org",
                            "code" => "mg"
                        ],
                        "denominator" => [
                            "value" => 1,
                            "system" => "http://terminology.hl7.org/CodeSystem/v3-orderableDrugForm",
                            "code" => "TAB"
                        ]
                    ]
                ],
                [
                    "itemCodeableConcept" => [
                        "coding" => [
                            [
                                "system" => "http://sys-ids.kemkes.go.id/kfa",
                                "code" => "91000288",
                                "display" => "Ethambutol"
                            ]
                        ]
                    ],
                    "isActive" => true,
                    "strength" => [
                        "numerator" => [
                            "value" => 275,
                            "system" => "http://unitsofmeasure.org",
                            "code" => "mg"
                        ],
                        "denominator" => [
                            "value" => 1,
                            "system" => "http://terminology.hl7.org/CodeSystem/v3-orderableDrugForm",
                            "code" => "TAB"
                        ]
                    ]
                ]
            ],
            "extension" => [
                [
                    "url" => "https://fhir.kemkes.go.id/r4/StructureDefinition/MedicationType",
                    "valueCodeableConcept" => [
                        "coding" => [
                            [
                                "system" => "http://terminology.kemkes.go.id/CodeSystem/medication-type",
                                "code" => "NC",
                                "display" => "Non-compound"
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.MedicationHelper::token(),
        ])
        ->post(MedicationHelper::url().'/Medication', $data);

        return $response->json();
    }

    public static function searchId($id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.MedicationHelper::token(),
        ])
        ->get(MedicationHelper::url().'/Medication/' . $id);

        return $response->json();
    }

    public static function update($id){
        $encounter_id = 'dummy123';
        $data = [
            "resourceType" => "Medication",
            "id" => "8f299a19-5887-4b8e-90a2-c2c15ecbe1d1",
            "meta" => [
                "profile" => [
                    "https://fhir.kemkes.go.id/r4/StructureDefinition/Medication"
                ]
            ],
            "identifier" => [
                [
                    "system" => "http://sys-ids.kemkes.go.id/medication/" . MedicationHelper::orgId(),
                    "use" => "official",
                    "value" => "123456789"
                ]
            ],
            "code" => [
                "coding" => [
                    [
                        "system" => "http://sys-ids.kemkes.go.id/kfa",
                        "display" => "Obat Kapsul TB Bintang Toedjoe"
                    ]
                ]
            ],
            "status" => "active",
            "manufacturer" => [
                "reference" => "Organization/900001"
            ],
            "form" => [
                "coding" => [
                    [
                        "system" => "http://terminology.kemkes.go.id/CodeSystem/medication-form",
                        "code" => "BS019",
                        "display" => "Kapsul"
                    ]
                ]
            ],
            "ingredient" => [
                [
                    "itemCodeableConcept" => [
                        "coding" => [
                            [
                                "system" => "http://sys-ids.kemkes.go.id/kfa",
                                "code" => "91000330",
                                "display" => "Rifampin"
                            ]
                        ]
                    ],
                    "isActive" => true,
                    "strength" => [
                        "numerator" => [
                            "value" => 150,
                            "system" => "http://unitsofmeasure.org",
                            "code" => "mg"
                        ],
                        "denominator" => [
                            "value" => 1,
                            "system" => "http://terminology.hl7.org/CodeSystem/v3-orderableDrugForm",
                            "code" => "TAB"
                        ]
                    ]
                ],
                [
                    "itemCodeableConcept" => [
                        "coding" => [
                            [
                                "system" => "http://sys-ids.kemkes.go.id/kfa",
                                "code" => "91000328",
                                "display" => "Isoniazid"
                            ]
                        ]
                    ],
                    "isActive" => true,
                    "strength" => [
                        "numerator" => [
                            "value" => 75,
                            "system" => "http://unitsofmeasure.org",
                            "code" => "mg"
                        ],
                        "denominator" => [
                            "value" => 1,
                            "system" => "http://terminology.hl7.org/CodeSystem/v3-orderableDrugForm",
                            "code" => "TAB"
                        ]
                    ]
                ],
                [
                    "itemCodeableConcept" => [
                        "coding" => [
                            [
                                "system" => "http://sys-ids.kemkes.go.id/kfa",
                                "code" => "91000329",
                                "display" => "Pyrazinamide"
                            ]
                        ]
                    ],
                    "isActive" => true,
                    "strength" => [
                        "numerator" => [
                            "value" => 400,
                            "system" => "http://unitsofmeasure.org",
                            "code" => "mg"
                        ],
                        "denominator" => [
                            "value" => 1,
                            "system" => "http://terminology.hl7.org/CodeSystem/v3-orderableDrugForm",
                            "code" => "TAB"
                        ]
                    ]
                ],
                [
                    "itemCodeableConcept" => [
                        "coding" => [
                            [
                                "system" => "http://sys-ids.kemkes.go.id/kfa",
                                "code" => "91000288",
                                "display" => "Ethambutol"
                            ]
                        ]
                    ],
                    "isActive" => true,
                    "strength" => [
                        "numerator" => [
                            "value" => 275,
                            "system" => "http://unitsofmeasure.org",
                            "code" => "mg"
                        ],
                        "denominator" => [
                            "value" => 1,
                            "system" => "http://terminology.hl7.org/CodeSystem/v3-orderableDrugForm",
                            "code" => "TAB"
                        ]
                    ]
                ]
            ],
            "extension" => [
                [
                    "url" => "https://fhir.kemkes.go.id/r4/StructureDefinition/MedicationType",
                    "valueCodeableConcept" => [
                        "coding" => [
                            [
                                "system" => "http://terminology.kemkes.go.id/CodeSystem/medication-type",
                                "code" => "NC",
                                "display" => "Non-compound"
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.MedicationHelper::token(),
        ])
        ->put(MedicationHelper::url().'/Medication/' . $id, $data);

        return $response->json();
    }
}
