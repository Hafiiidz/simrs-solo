<?php

namespace App\Helpers\Satusehat\Resource\Immunization;

use App\Models\Rawat;
use App\Models\Dokter;
use App\Models\Obat\Obat;
use LZCompressor\LZString;
use App\Helpers\VclaimHelper;
use App\Models\Pasien\Pasien;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Helpers\SatusehatAuthHelper;

class ImmunizationHelper
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

    public static function searchDatePatient($date, $patient){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ImmunizationHelper::token(),
        ])
        ->get(ImmunizationHelper::url().'/Immunization?date=' . $date . '&patient=' . $patient);

        return $response->json();
    }

    public static function searchId($id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ImmunizationHelper::token(),
        ])
        ->get(ImmunizationHelper::url().'/Immunization/' . $id);

        return $response->json();
    }

    public static function update($id){
        $encounter_id = 'dummy123';
        $data = [
            "resourceType" => "Immunization",
            "id" => $id,
            "status" => "not-done",
            "vaccineCode" => [
                "coding" => [
                    [
                        "system" => "http://sys-ids.kemkes.go.id/kfa",
                        "code" => "93001282",
                        "display" => "Vaksin DTP - HB - Hib 0,5 mL (PENTABIO, 1)"
                    ],
                    [
                        "system" => "http://sys-ids.kemkes.go.id/kfa",
                        "code" => "VG17",
                        "display" => "HIB"
                    ],
                    [
                        "system" => "http://hl7.org/fhir/sid/cvx",
                        "code" => "102",
                        "display" => "DTP-Hib-Hep B"
                    ]
                ]
            ],
            "patient" => [
                "reference" => "Patient/100000030009",
                "display" => "Budi Santoso"
            ],
            "encounter" => [
                "reference" => "Encounter/8a224d91-5132-47d0-ae35-0fc70f24a776"
            ],
            "occurrenceDateTime" => "2022-01-10",
            "recorded" => "2022-01-10",
            "primarySource" => true,
            "location" => [
                "reference" => "Location/ef011065-38c9-46f8-9c35-d1fe68966a3e",
                "display" => "Ruang 1A, Poliklinik Rawat Jalan"
            ],
            "lotNumber" => "202009007",
            "route" => [
                "coding" => [
                    [
                        "system" => "http://www.whocc.no/atc",
                        "code" => "inj.intramuscular",
                        "display" => "Injection Intramuscular"
                    ]
                ]
            ],
            "doseQuantity" => [
                "value" => 1,
                "unit" => "mL",
                "system" => "http://unitsofmeasure.org",
                "code" => "ml"
            ],
            "performer" => [
                [
                    "function" => [
                        "coding" => [
                            [
                                "system" => "http://terminology.hl7.org/CodeSystem/v2-0443",
                                "code" => "AP",
                                "display" => "Administering Provider"
                            ]
                        ]
                    ],
                    "actor" => [
                        "reference" => "Practitioner/N10000001"
                    ]
                ]
            ],
            "reasonCode" => [
                [
                    "coding" => [
                        [
                            "system" => "http://terminology.kemkes.go.id/CodeSystem/immunization-reason",
                            "code" => "IM-Dasar",
                            "display" => "Imunisasi Program Rutin Dasar"
                        ],
                        [
                            "system" => "http://terminology.kemkes.go.id/CodeSystem/immunization-routine-timing",
                            "code" => "IM-Ideal",
                            "display" => "Imunisasi Ideal"
                        ]
                    ]
                ]
            ],
            "protocolApplied" => [
                [
                    "doseNumberPositiveInt" => 1
                ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ImmunizationHelper::token(),
        ])
        ->put(ImmunizationHelper::url().'/Immunization/' . $id, $data);

        return $response->json();
    }

    #Variasi Pelaporan
    public static function createOlehNakes(){

        $data = [
            "resourceType" => "Immunization",
            "status" => "completed",
            "vaccineCode" => [
                "coding" => [
                    [
                        "system" => "http://sys-ids.kemkes.go.id/kfa",
                        "code" => "93001282",
                        "display" => "Vaksin DTP - HB - Hib 0,5 mL (PENTABIO, 1)"
                    ],
                    [
                        "system" => "http://sys-ids.kemkes.go.id/kfa",
                        "code" => "VG17",
                        "display" => "HIB"
                    ],
                    [
                        "system" => "http://sys-ids.kemkes.go.id/kfa",
                        "code" => "VG45",
                        "display" => "HepB"
                    ],
                    [
                        "system" => "http://sys-ids.kemkes.go.id/kfa",
                        "code" => "VG107",
                        "display" => "DTAP"
                    ],
                    [
                        "system" => "http://hl7.org/fhir/sid/cvx",
                        "code" => "198",
                        "display" => "DTP-hepB-Hib Pentavalent Non-US"
                    ]
                ]
            ],
            "patient" => [
                "reference" => "Patient/100000030009",
                "display" => "Budi Santoso"
            ],
            "encounter" => [
                "reference" => "Encounter/8a224d91-5132-47d0-ae35-0fc70f24a776"
            ],
            "occurrenceDateTime" => "2022-01-10",
            "recorded" => "2022-01-10",
            "primarySource" => true,
            "location" => [
                "reference" => "Location/ef011065-38c9-46f8-9c35-d1fe68966a3e",
                "display" => "Ruang 1A, Poliklinik Rawat Jalan"
            ],
            "lotNumber" => "202009007",
            "route" => [
                "coding" => [
                    [
                        "system" => "http://www.whocc.no/atc",
                        "code" => "inj.intramuscular",
                        "display" => "Injection Intramuscular"
                    ]
                ]
            ],
            "doseQuantity" => [
                "value" => 1,
                "unit" => "mL",
                "system" => "http://unitsofmeasure.org",
                "code" => "ml"
            ],
            "performer" => [
                [
                    "function" => [
                        "coding" => [
                            [
                                "system" => "http://terminology.hl7.org/CodeSystem/v2-0443",
                                "code" => "AP",
                                "display" => "Administering Provider"
                            ]
                        ]
                    ],
                    "actor" => [
                        "reference" => "Practitioner/N10000001"
                    ]
                ]
            ],
            "reasonCode" => [
                [
                    "coding" => [
                        [
                            "system" => "http://terminology.kemkes.go.id/CodeSystem/immunization-reason",
                            "code" => "IM-Dasar",
                            "display" => "Imunisasi Program Rutin Dasar"
                        ],
                        [
                            "system" => "http://terminology.kemkes.go.id/CodeSystem/immunization-routine-timing",
                            "code" => "IM-Ideal",
                            "display" => "Imunisasi Ideal"
                        ]
                    ]
                ]
            ],
            "protocolApplied" => [
                [
                    "doseNumberPositiveInt" => 1
                ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ImmunizationHelper::token(),
        ])
        ->post(ImmunizationHelper::url().'/Immunization', $data);

        return $response->json();
    }

    public static function createImunisasiTolakPasien(){

        $data = [
            "resourceType" => "Immunization",
            "status" => "not-done",
            "vaccineCode" => [
                "coding" => [
                    [
                        "system" => "http://sys-ids.kemkes.go.id/kfa",
                        "code" => "93001282",
                        "display" => "Vaksin DTP - HB - Hib 0,5 mL (PENTABIO, 1)"
                    ],
                    [
                        "system" => "http://sys-ids.kemkes.go.id/kfa",
                        "code" => "VG17",
                        "display" => "HIB"
                    ],
                    [
                        "system" => "http://sys-ids.kemkes.go.id/kfa",
                        "code" => "VG45",
                        "display" => "HepB"
                    ],
                    [
                        "system" => "http://sys-ids.kemkes.go.id/kfa",
                        "code" => "VG107",
                        "display" => "DTAP"
                    ],
                    [
                        "system" => "http://hl7.org/fhir/sid/cvx",
                        "code" => "198",
                        "display" => "DTP-hepB-Hib Pentavalent Non-US"
                    ]
                ]
            ],
            "statusReason" => [
                "coding" => [
                    [
                        "system" => "http://terminology.hl7.org/CodeSystem/v3-ActReason",
                        "code" => "MEDPREC",
                        "display" => "medical precaution"
                    ]
                ],
                "text" => "Anak sedang demam"
            ],
            "patient" => [
                "reference" => "Patient/100000030009",
                "display" => "Budi Santoso"
            ],
            "encounter" => [
                "reference" => "Encounter/8a224d91-5132-47d0-ae35-0fc70f24a776"
            ],
            "occurrenceDateTime" => "2022-01-10",
            "recorded" => "2022-01-10",
            "primarySource" => true,
            "location" => [
                "reference" => "Location/ef011065-38c9-46f8-9c35-d1fe68966a3e",
                "display" => "Ruang 1A, Poliklinik Rawat Jalan"
            ],
            "performer" => [
                [
                    "function" => [
                        "coding" => [
                            [
                                "system" => "http://terminology.hl7.org/CodeSystem/v2-0443",
                                "code" => "AP",
                                "display" => "Administering Provider"
                            ]
                        ]
                    ],
                    "actor" => [
                        "reference" => "Practitioner/N10000001"
                    ]
                ]
            ],
            "reasonCode" => [
                [
                    "coding" => [
                        [
                            "system" => "http://terminology.kemkes.go.id/CodeSystem/immunization-reason",
                            "code" => "IM-Dasar",
                            "display" => "Imunisasi Program Rutin Dasar"
                        ],
                        [
                            "system" => "http://terminology.kemkes.go.id/CodeSystem/immunization-routine-timing",
                            "code" => "IM-Ideal",
                            "display" => "Imunisasi Ideal"
                        ]
                    ]
                ]
            ],
            "protocolApplied" => [
                [
                    "doseNumberPositiveInt" => 1
                ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ImmunizationHelper::token(),
        ])
        ->post(ImmunizationHelper::url().'/Immunization', $data);

        return $response->json();
    }

    public static function createKipi(){

        $data = [
            "resourceType" => "Observation",
            "identifier" => [
                [
                    "system" => "http://sys-ids.kemkes.go.id/observation/[[Org_id]]",
                    "value" => "O111111"
                ]
            ],
            "status" => "final",
            "category" => [
                [
                    "coding" => [
                        [
                            "system" => "http://terminology.hl7.org/CodeSystem/observation-category",
                            "code" => "exam",
                            "display" => "exam"
                        ]
                    ]
                ]
            ],
            "code" => [
                "coding" => [
                    [
                        "system" => "http://loinc.org",
                        "code" => "31044-1",
                        "display" => "Immunization reaction"
                    ]
                ]
            ],
            "subject" => [
                "reference" => "Patient/100000030009"
            ],
            "encounter" => [
                "reference" => "Encounter/8a224d91-5132-47d0-ae35-0fc70f24a776"
            ],
            "effectiveDateTime" => "2022-01-13",
            "issued" => "2022-01-13T15:30:10+01:00",
            "performer" => [
                [
                    "reference" => "Practitioner/N10000001"
                ],
                [
                    "reference" => "Organization/" . ImmunizationHelper::orgId()
                ]
            ],
            "valueCodeableConcept" => [
                "coding" => [
                    [
                        "system" => "http://loinc.org",
                        "code" => "LA7460-4",
                        "display" => "Pain"
                    ]
                ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ImmunizationHelper::token(),
        ])
        ->post(ImmunizationHelper::url().'/Observation', $data);

        return $response->json();
    }

    public static function createKipiNakes(){

        $data = [
            "resourceType" => "Immunization",
            "status" => "completed",
            "vaccineCode" => [
                "coding" => [
                    [
                        "system" => "http://sys-ids.kemkes.go.id/kfa",
                        "code" => "93001282",
                        "display" => "Vaksin DTP - HB - Hib 0,5 mL (PENTABIO, 1)"
                    ],
                    [
                        "system" => "http://sys-ids.kemkes.go.id/kfa",
                        "code" => "VG17",
                        "display" => "HIB"
                    ],
                    [
                        "system" => "http://sys-ids.kemkes.go.id/kfa",
                        "code" => "VG45",
                        "display" => "HepB"
                    ],
                    [
                        "system" => "http://sys-ids.kemkes.go.id/kfa",
                        "code" => "VG107",
                        "display" => "DTAP"
                    ],
                    [
                        "system" => "http://hl7.org/fhir/sid/cvx",
                        "code" => "198",
                        "display" => "DTP-hepB-Hib Pentavalent Non-US"
                    ]
                ]
            ],
            "patient" => [
                "reference" => "Patient/100000030009",
                "display" => "Budi Santoso"
            ],
            "encounter" => [
                "reference" => "Encounter/8a224d91-5132-47d0-ae35-0fc70f24a776"
            ],
            "occurrenceDateTime" => "2022-01-10",
            "recorded" => "2022-01-10",
            "reaction" => [
                [
                    "date" => "2022-01-13",
                    "detail" => [
                        "reference" => "Observation/b4c387fa-a541-4688-992b-7e2077419a39",
                        "display" => "Pain"
                    ],
                    "reported" => false
                ]
            ],
            "primarySource" => true,
            "location" => [
                "reference" => "Location/ef011065-38c9-46f8-9c35-d1fe68966a3e",
                "display" => "Ruang 1A, Poliklinik Rawat Jalan"
            ],
            "lotNumber" => "202009007",
            "route" => [
                "coding" => [
                    [
                        "system" => "http://www.whocc.no/atc",
                        "code" => "inj.intramuscular",
                        "display" => "Injection Intramuscular"
                    ]
                ]
            ],
            "doseQuantity" => [
                "value" => 1,
                "unit" => "mL",
                "system" => "http://unitsofmeasure.org",
                "code" => "ml"
            ],
            "performer" => [
                [
                    "function" => [
                        "coding" => [
                            [
                                "system" => "http://terminology.hl7.org/CodeSystem/v2-0443",
                                "code" => "AP",
                                "display" => "Administering Provider"
                            ]
                        ]
                    ],
                    "actor" => [
                        "reference" => "Practitioner/N10000001"
                    ]
                ]
            ],
            "reasonCode" => [
                [
                    "coding" => [
                        [
                            "system" => "http://terminology.kemkes.go.id/CodeSystem/immunization-reason",
                            "code" => "IM-Dasar",
                            "display" => "Imunisasi Program Rutin Dasar"
                        ],
                        [
                            "system" => "http://terminology.kemkes.go.id/CodeSystem/immunization-routine-timing",
                            "code" => "IM-Ideal",
                            "display" => "Imunisasi Ideal"
                        ]
                    ]
                ]
            ],
            "protocolApplied" => [
                [
                    "doseNumberPositiveInt" => 1
                ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ImmunizationHelper::token(),
        ])
        ->post(ImmunizationHelper::url().'/Immunization', $data);

        return $response->json();
    }

    public static function createPasienNakes(){

        $data = [
            "resourceType" => "Immunization",
            "status" => "completed",
            "vaccineCode" => [
                "coding" => [
                    [
                        "system" => "http://sys-ids.kemkes.go.id/kfa",
                        "code" => "93001282",
                        "display" => "Vaksin DTP - HB - Hib 0,5 mL (PENTABIO, 1)"
                    ],
                    [
                        "system" => "http://sys-ids.kemkes.go.id/kfa",
                        "code" => "VG17",
                        "display" => "HIB"
                    ],
                    [
                        "system" => "http://sys-ids.kemkes.go.id/kfa",
                        "code" => "VG45",
                        "display" => "HepB"
                    ],
                    [
                        "system" => "http://sys-ids.kemkes.go.id/kfa",
                        "code" => "VG107",
                        "display" => "DTAP"
                    ],
                    [
                        "system" => "http://hl7.org/fhir/sid/cvx",
                        "code" => "198",
                        "display" => "DTP-hepB-Hib Pentavalent Non-US"
                    ]
                ]
            ],
            "patient" => [
                "reference" => "Patient/100000030009",
                "display" => "Budi Santoso"
            ],
            "encounter" => [
                "reference" => "Encounter/8a224d91-5132-47d0-ae35-0fc70f24a776"
            ],
            "occurrenceDateTime" => "2022-01-10",
            "recorded" => "2022-01-10",
            "reaction" => [
                [
                    "date" => "2022-01-13",
                    "reported" => true
                ]
            ],
            "primarySource" => true,
            "location" => [
                "reference" => "Location/ef011065-38c9-46f8-9c35-d1fe68966a3e",
                "display" => "Ruang 1A, Poliklinik Rawat Jalan"
            ],
            "lotNumber" => "202009007",
            "route" => [
                "coding" => [
                    [
                        "system" => "http://www.whocc.no/atc",
                        "code" => "inj.intramuscular",
                        "display" => "Injection Intramuscular"
                    ]
                ]
            ],
            "doseQuantity" => [
                "value" => 1,
                "unit" => "mL",
                "system" => "http://unitsofmeasure.org",
                "code" => "ml"
            ],
            "performer" => [
                [
                    "function" => [
                        "coding" => [
                            [
                                "system" => "http://terminology.hl7.org/CodeSystem/v2-0443",
                                "code" => "AP",
                                "display" => "Administering Provider"
                            ]
                        ]
                    ],
                    "actor" => [
                        "reference" => "Practitioner/N10000001"
                    ]
                ]
            ],
            "reasonCode" => [
                [
                    "coding" => [
                        [
                            "system" => "http://terminology.kemkes.go.id/CodeSystem/immunization-reason",
                            "code" => "IM-Dasar",
                            "display" => "Imunisasi Program Rutin Dasar"
                        ],
                        [
                            "system" => "http://terminology.kemkes.go.id/CodeSystem/immunization-routine-timing",
                            "code" => "IM-Ideal",
                            "display" => "Imunisasi Ideal"
                        ]
                    ]
                ]
            ],
            "protocolApplied" => [
                [
                    "doseNumberPositiveInt" => 1
                ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ImmunizationHelper::token(),
        ])
        ->post(ImmunizationHelper::url().'/Immunization', $data);

        return $response->json();
    }

    public static function createRiwayat(){

        $data = [
            "resourceType" => "Immunization",
            "status" => "completed",
            "vaccineCode" => [
                "coding" => [
                    [
                        "system" => "http://sys-ids.kemkes.go.id/kfa",
                        "code" => "VG89",
                        "display" => "POLIO"
                    ],
                    [
                        "system" => "http://hl7.org/fhir/sid/cvx",
                        "code" => "10",
                        "display" => "IPV"
                    ]
                ]
            ],
            "patient" => [
                "reference" => "Patient/100000030009",
                "display" => "Budi Santoso"
            ],
            "occurrenceDateTime" => "2022-01-10",
            "recorded" => "2022-01-17",
            "primarySource" => false,
            "reportOrigin" => [
                "coding" => [
                    [
                        "system" => "http://terminology.hl7.org/CodeSystem/immunization-origin",
                        "code" => "provider",
                        "display" => "Other Provider"
                    ]
                ]
            ],
            "performer" => [
                [
                    "function" => [
                        "coding" => [
                            [
                                "system" => "http://terminology.hl7.org/CodeSystem/v2-0443",
                                "code" => "EP",
                                "display" => "Entering Provider (probably not the same as transcriptionist?)"
                            ]
                        ],
                        "text" => "Kader Sri M"
                    ],
                    "actor" => [
                        "reference" => "Organization/[[Org_id]]"
                    ]
                ]
            ],
            "reasonCode" => [
                [
                    "coding" => [
                        [
                            "system" => "http://terminology.kemkes.go.id/CodeSystem/immunization-reason",
                            "code" => "IM-Dasar",
                            "display" => "Imunisasi Program Rutin Dasar"
                        ],
                        [
                            "system" => "http://terminology.kemkes.go.id/CodeSystem/immunization-routine-timing",
                            "code" => "IM-Ideal",
                            "display" => "Imunisasi Ideal"
                        ]
                    ]
                ]
            ],
            "protocolApplied" => [
                [
                    "doseNumberPositiveInt" => 1
                ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ImmunizationHelper::token(),
        ])
        ->post(ImmunizationHelper::url().'/Immunization', $data);

        return $response->json();
    }

    public static function createReport(){

        $data = [
            "resourceType" => "Immunization",
            "status" => "completed",
            "vaccineCode" => [
                "coding" => [
                    [
                        "system" => "http://sys-ids.kemkes.go.id/kfa",
                        "code" => "VG89",
                        "display" => "POLIO"
                    ],
                    [
                        "system" => "http://hl7.org/fhir/sid/cvx",
                        "code" => "10",
                        "display" => "IPV"
                    ]
                ]
            ],
            "patient" => [
                "reference" => "Patient/100000030009",
                "display" => "Budi Santoso"
            ],
            "occurrenceDateTime" => "2022-01-10",
            "recorded" => "2022-02-10",
            "primarySource" => false,
            "reportOrigin" => [
                "coding" => [
                    [
                        "system" => "http://terminology.hl7.org/CodeSystem/immunization-origin",
                        "code" => "recall",
                        "display" => "Parent/Guardian/Patient Recall"
                    ]
                ]
            ],
            "performer" => [
                [
                    "function" => [
                        "coding" => [
                            [
                                "system" => "http://terminology.hl7.org/CodeSystem/v2-0443",
                                "code" => "AP",
                                "display" => "Administering Provider"
                            ]
                        ]
                    ],
                    "actor" => [
                        "reference" => "Practitioner/N10000001",
                        "display" => "Dokter Bronsig"
                    ]
                ]
            ],
            "reasonCode" => [
                [
                    "coding" => [
                        [
                            "system" => "http://terminology.kemkes.go.id/CodeSystem/immunization-reason",
                            "code" => "IM-Dasar",
                            "display" => "Imunisasi Program Rutin Dasar"
                        ],
                        [
                            "system" => "http://terminology.kemkes.go.id/CodeSystem/immunization-routine-timing",
                            "code" => "IM-Ideal",
                            "display" => "Imunisasi Ideal"
                        ]
                    ]
                ]
            ],
            "location" => [
                "display" => "PUSKESMAS XYZ"
            ],
            "protocolApplied" => [
                [
                    "doseNumberPositiveInt" => 1
                ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ImmunizationHelper::token(),
        ])
        ->post(ImmunizationHelper::url().'/Immunization', $data);

        return $response->json();
    }

    #Variasi Jenis Vaksin
    public static function createPilihan(){

        $data = [
            "resourceType" => "Immunization",
            "status" => "completed",
            "vaccineCode" => [
                "coding" => [
                    [
                        "system" => "http://sys-ids.kemkes.go.id/kfa",
                        "code" => "VG122",
                        "display" => "ROTAVIRUS"
                    ]
                ]
            ],
            "patient" => [
                "reference" => "Patient/100000030009",
                "display" => "Budi Santoso"
            ],
            "occurrenceDateTime" => "2022-01-10",
            "recorded" => "2022-02-10",
            "primarySource" => false,
            "reportOrigin" => [
                "coding" => [
                    [
                        "system" => "http://terminology.hl7.org/CodeSystem/immunization-origin",
                        "code" => "recall",
                        "display" => "Parent/Guardian/Patient Recall"
                    ]
                ]
            ],
            "performer" => [
                [
                    "function" => [
                        "coding" => [
                            [
                                "system" => "http://terminology.hl7.org/CodeSystem/v2-0443",
                                "code" => "AP",
                                "display" => "Administering Provider"
                            ]
                        ]
                    ],
                    "actor" => [
                        "reference" => "Practitioner/N10000001",
                        "display" => "Dokter Bronsig"
                    ]
                ]
            ],
            "reasonCode" => [
                [
                    "coding" => [
                        [
                            "system" => "http://terminology.kemkes.go.id/CodeSystem/immunization-reason",
                            "code" => "IM-Pilihan",
                            "display" => "Imunisasi Pilihan"
                        ]
                    ]
                ]
            ],
            "location" => [
                "display" => "PUSKESMAS XYZ"
            ],
            "protocolApplied" => [
                [
                    "doseNumberPositiveInt" => 1
                ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ImmunizationHelper::token(),
        ])
        ->post(ImmunizationHelper::url().'/Immunization', $data);

        return $response->json();
    }

    public static function createKhusus(){

        $data = [
            "resourceType" => "Immunization",
            "status" => "completed",
            "vaccineCode" => [
                "coding" => [
                    [
                        "system" => "http://sys-ids.kemkes.go.id/kfa",
                        "code" => "VG90",
                        "display" => "RABIES"
                    ]
                ]
            ],
            "patient" => [
                "reference" => "Patient/100000030009",
                "display" => "Budi Santoso"
            ],
            "occurrenceDateTime" => "2022-01-10",
            "recorded" => "2022-02-10",
            "primarySource" => false,
            "reportOrigin" => [
                "coding" => [
                    [
                        "system" => "http://terminology.hl7.org/CodeSystem/immunization-origin",
                        "code" => "recall",
                        "display" => "Parent/Guardian/Patient Recall"
                    ]
                ]
            ],
            "performer" => [
                [
                    "function" => [
                        "coding" => [
                            [
                                "system" => "http://terminology.hl7.org/CodeSystem/v2-0443",
                                "code" => "AP",
                                "display" => "Administering Provider"
                            ]
                        ]
                    ],
                    "actor" => [
                        "reference" => "Practitioner/N10000001",
                        "display" => "Dokter Bronsig"
                    ]
                ]
            ],
            "reasonCode" => [
                [
                    "coding" => [
                        [
                            "system" => "http://terminology.kemkes.go.id/CodeSystem/immunization-reason",
                            "code" => "IM-Khusus",
                            "display" => "Imunisasi Program Khusus"
                        ]
                    ]
                ]
            ],
            "location" => [
                "display" => "PUSKESMAS XYZ"
            ],
            "protocolApplied" => [
                [
                    "doseNumberPositiveInt" => 1
                ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ImmunizationHelper::token(),
        ])
        ->post(ImmunizationHelper::url().'/Immunization', $data);

        return $response->json();
    }

    public static function createDasar(){

        $data = [
            "resourceType" => "Immunization",
            "status" => "completed",
            "vaccineCode" => [
                "coding" => [
                    [
                        "system" => "http://sys-ids.kemkes.go.id/kfa",
                        "code" => "VG17",
                        "display" => "HIB"
                    ],
                    [
                        "system" => "http://sys-ids.kemkes.go.id/kfa",
                        "code" => "VG45",
                        "display" => "HepB"
                    ],
                    [
                        "system" => "http://sys-ids.kemkes.go.id/kfa",
                        "code" => "VG107",
                        "display" => "DTAP"
                    ],
                    [
                        "system" => "http://hl7.org/fhir/sid/cvx",
                        "code" => "102",
                        "display" => "DTP-Hib-Hep B"
                    ]
                ]
            ],
            "patient" => [
                "reference" => "Patient/100000030009",
                "display" => "Budi Santoso"
            ],
            "occurrenceDateTime" => "2022-01-10",
            "recorded" => "2022-02-10",
            "primarySource" => false,
            "reportOrigin" => [
                "coding" => [
                    [
                        "system" => "http://terminology.hl7.org/CodeSystem/immunization-origin",
                        "code" => "recall",
                        "display" => "Parent/Guardian/Patient Recall"
                    ]
                ]
            ],
            "performer" => [
                [
                    "function" => [
                        "coding" => [
                            [
                                "system" => "http://terminology.hl7.org/CodeSystem/v2-0443",
                                "code" => "AP",
                                "display" => "Administering Provider"
                            ]
                        ]
                    ],
                    "actor" => [
                        "reference" => "Practitioner/N10000001",
                        "display" => "Dokter Bronsig"
                    ]
                ]
            ],
            "reasonCode" => [
                [
                    "coding" => [
                        [
                            "system" => "http://terminology.kemkes.go.id/CodeSystem/immunization-reason",
                            "code" => "IM-Dasar",
                            "display" => "Imunisasi Program Rutin Dasar"
                        ],
                        [
                            "system" => "http://terminology.kemkes.go.id/CodeSystem/immunization-routine-timing",
                            "code" => "IM-Ideal",
                            "display" => "Imunisasi Ideal"
                        ]
                    ]
                ]
            ],
            "location" => [
                "display" => "PUSKESMAS XYZ"
            ],
            "protocolApplied" => [
                [
                    "doseNumberPositiveInt" => 1
                ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ImmunizationHelper::token(),
        ])
        ->post(ImmunizationHelper::url().'/Immunization', $data);

        return $response->json();
    }

    public static function createBaduta(){

        $data = [
            "resourceType" => "Immunization",
            "status" => "completed",
            "vaccineCode" => [
                "coding" => [
                    [
                        "system" => "http://sys-ids.kemkes.go.id/kfa",
                        "code" => "VG03",
                        "display" => "MMR"
                    ],
                    [
                        "system" => "http://hl7.org/fhir/sid/cvx",
                        "code" => "04",
                        "display" => "M/R"
                    ]
                ]
            ],
            "patient" => [
                "reference" => "Patient/100000030009",
                "display" => "Budi Santoso"
            ],
            "occurrenceDateTime" => "2022-01-10",
            "recorded" => "2022-02-10",
            "primarySource" => false,
            "reportOrigin" => [
                "coding" => [
                    [
                        "system" => "http://terminology.hl7.org/CodeSystem/immunization-origin",
                        "code" => "recall",
                        "display" => "Parent/Guardian/Patient Recall"
                    ]
                ]
            ],
            "performer" => [
                [
                    "function" => [
                        "coding" => [
                            [
                                "system" => "http://terminology.hl7.org/CodeSystem/v2-0443",
                                "code" => "AP",
                                "display" => "Administering Provider"
                            ]
                        ]
                    ],
                    "actor" => [
                        "reference" => "Practitioner/N10000001",
                        "display" => "Dokter Bronsig"
                    ]
                ]
            ],
            "reasonCode" => [
                [
                    "coding" => [
                        [
                            "system" => "http://terminology.kemkes.go.id/CodeSystem/immunization-reason",
                            "code" => "IM-Baduta",
                            "display" => "Imunisasi Program Rutin Lanjutan Baduta"
                        ],
                        [
                            "system" => "http://terminology.kemkes.go.id/CodeSystem/immunization-routine-timing",
                            "code" => "IM-Ideal",
                            "display" => "Imunisasi Ideal"
                        ]
                    ]
                ]
            ],
            "location" => [
                "display" => "PUSKESMAS XYZ"
            ],
            "protocolApplied" => [
                [
                    "doseNumberPositiveInt" => 2
                ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ImmunizationHelper::token(),
        ])
        ->post(ImmunizationHelper::url().'/Immunization', $data);

        return $response->json();
    }
}
