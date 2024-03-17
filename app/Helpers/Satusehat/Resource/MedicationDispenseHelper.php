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

class MedicationDispenseHelper
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
            "resourceType" => "MedicationDispense",
            "identifier" => [
                [
                    "system" => "http://sys-ids.kemkes.go.id/prescription/" . MedicationDispenseHelper::orgId(),
                    "use" => "official",
                    "value" => "123456788"
                ],
                [
                    "system" => "http://sys-ids.kemkes.go.id/prescription-item/" . MedicationDispenseHelper::orgId(),
                    "use" => "official",
                    "value" => "123456788-1"
                ]
            ],
            "status" => "completed",
            "category" => [
                "coding" => [
                    [
                        "system" => "http://terminology.hl7.org/fhir/CodeSystem/medicationdispense-category",
                        "code" => "outpatient",
                        "display" => "Outpatient"
                    ]
                ]
            ],
            "medicationReference" => [
                "reference" => "Medication/2b78a453-dd36-4d5f-8264-d575e3321a8b",
                "display" => "Obat Anti Tuberculosis / Rifampicin 150 mg / Isoniazid 75 mg / Pyrazinamide 400 mg / Ethambutol 275 mg Kaplet Salut Selaput (KIMIA FARMA)"
            ],
            "subject" => [
                "reference" => "Patient/100000030009",
                "display" => "Budi Santoso"
            ],
            "context" => [
                "reference" => "Encounter/" . $encounter_id
            ],
            "performer" => [
                [
                    "actor" => [
                        "reference" => "Practitioner/N10000003",
                        "display" => "John Miller"
                    ]
                ]
            ],
            "location" => [
                "reference" => "Location/52e135eb-1956-4871-ba13-e833e662484d",
                "display" => "Apotek RSUD Jati Asih"
            ],
            "authorizingPrescription" => [
                [
                    "reference" => "MedicationRequest/b5293e6d-31c6-4111-8214-609ae5890838"
                ]
            ],
            "quantity" => [
                "system" => "http://terminology.hl7.org/CodeSystem/v3-orderableDrugForm",
                "code" => "TAB",
                "value" => 120
            ],
            "daysSupply" => [
                "value" => 30,
                "unit" => "Day",
                "system" => "http://unitsofmeasure.org",
                "code" => "d"
            ],
            "whenPrepared" => "2022-01-15T10:20:00Z",
            "whenHandedOver" => "2022-01-15T16:20:00Z",
            "dosageInstruction" => [
                [
                    "sequence" => 1,
                    "text" => "Diminum 4 tablet sekali dalam sehari",
                    "timing" => [
                        "repeat" => [
                            "frequency" => 1,
                            "period" => 1,
                            "periodUnit" => "d"
                        ]
                    ],
                    "doseAndRate" => [
                        [
                            "type" => [
                                "coding" => [
                                    [
                                        "system" => "http://terminology.hl7.org/CodeSystem/dose-rate-type",
                                        "code" => "ordered",
                                        "display" => "Ordered"
                                    ]
                                ]
                            ],
                            "doseQuantity" => [
                                "value" => 4,
                                "unit" => "TAB",
                                "system" => "http://terminology.hl7.org/CodeSystem/v3-orderableDrugForm",
                                "code" => "TAB"
                            ]
                        ]
                    ]
                ]
            ]
        ];


        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.MedicationDispenseHelper::token(),
        ])
        ->post(MedicationDispenseHelper::url().'/MedicationDispense', $data);

        return $response->json();
    }

    public static function searchSubject($subject){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.MedicationDispenseHelper::token(),
        ])
        ->get(MedicationDispenseHelper::url().'/MedicationDispense?subject=' . $subject);

        return $response->json();
    }

    public static function searchSubjectEncounter($subject, $encounter_id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.MedicationDispenseHelper::token(),
        ])
        ->get(MedicationDispenseHelper::url().'/MedicationDispense?subject=' . $subject . '&encounter=' . $encounter_id);

        return $response->json();
    }

    public static function searchSubjectPrescription($subject, $prescription){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.MedicationDispenseHelper::token(),
        ])
        ->get(MedicationDispenseHelper::url().'/MedicationDispense?subject=' . $subject . '&prescription=' . $prescription);

        return $response->json();
    }

    public static function searchId($id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.MedicationDispenseHelper::token(),
        ])
        ->get(MedicationDispenseHelper::url().'/MedicationDispense/' . $id);

        return $response->json();
    }

    public static function update($id){
        $encounter_id = 'dummy123';
        $data = [
            "resourceType" => "MedicationDispense",
            "id" => $id,
            "identifier" => [
                [
                    "system" => "http://sys-ids.kemkes.go.id/prescription/" . MedicationDispenseHelper::orgId(),
                    "use" => "official",
                    "value" => "123456788"
                ],
                [
                    "system" => "http://sys-ids.kemkes.go.id/prescription-item/" . MedicationDispenseHelper::orgId(),
                    "use" => "official",
                    "value" => "123456788-1"
                ]
            ],
            "status" => "in-progress",
            "category" => [
                "coding" => [
                    [
                        "system" => "http://terminology.hl7.org/fhir/CodeSystem/medicationdispense-category",
                        "code" => "outpatient",
                        "display" => "Outpatient"
                    ]
                ]
            ],
            "medicationReference" => [
                "reference" => "Medication/2b78a453-dd36-4d5f-8264-d575e3321a8b",
                "display" => "Obat Anti Tuberculosis / Rifampicin 150 mg / Isoniazid 75 mg / Pyrazinamide 400 mg / Ethambutol 275 mg Kaplet Salut Selaput (KIMIA FARMA)"
            ],
            "subject" => [
                "reference" => "Patient/100000030009",
                "display" => "Budi Santoso"
            ],
            "context" => [
                "reference" => "Encounter/" . $encounter_id
            ],
            "performer" => [
                [
                    "actor" => [
                        "reference" => "Practitioner/N10000003",
                        "display" => "John Miller"
                    ]
                ]
            ],
            "location" => [
                "reference" => "Location/52e135eb-1956-4871-ba13-e833e662484d",
                "display" => "Apotek RSUD Jati Asih"
            ],
            "authorizingPrescription" => [
                [
                    "reference" => "MedicationRequest/b5293e6d-31c6-4111-8214-609ae5890838"
                ]
            ],
            "quantity" => [
                "system" => "http://terminology.hl7.org/CodeSystem/v3-orderableDrugForm",
                "code" => "TAB",
                "value" => 120
            ],
            "daysSupply" => [
                "value" => 30,
                "unit" => "Day",
                "system" => "http://unitsofmeasure.org",
                "code" => "d"
            ],
            "whenPrepared" => "2022-01-15T10:20:00Z",
            "whenHandedOver" => "2022-01-15T16:20:00Z",
            "dosageInstruction" => [
                [
                    "sequence" => 1,
                    "text" => "Diminum 4 tablet sekali dalam sehari",
                    "timing" => [
                        "repeat" => [
                            "frequency" => 1,
                            "period" => 1,
                            "periodUnit" => "d"
                        ]
                    ],
                    "doseAndRate" => [
                        [
                            "type" => [
                                "coding" => [
                                    [
                                        "system" => "http://terminology.hl7.org/CodeSystem/dose-rate-type",
                                        "code" => "ordered",
                                        "display" => "Ordered"
                                    ]
                                ]
                            ],
                            "doseQuantity" => [
                                "value" => 4,
                                "unit" => "TAB",
                                "system" => "http://terminology.hl7.org/CodeSystem/v3-orderableDrugForm",
                                "code" => "TAB"
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.MedicationDispenseHelper::token(),
        ])
        ->put(MedicationDispenseHelper::url().'/MedicationDispense/' . $id, $data);

        return $response->json();
    }
}
