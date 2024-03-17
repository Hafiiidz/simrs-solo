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

class ServiceRequestHelper
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

    public static function createNonRujukan(){
        $encounter_id = 'dummy123';
        $data = [
            "resourceType" => "ServiceRequest",
            "identifier" => [
                [
                    "system" => "http://sys-ids.kemkes.go.id/servicerequest/" . ServiceRequestHelper::orgId(),
                    "value" => "00001"
                ]
            ],
            "status" => "active",
            "intent" => "original-order",
            "priority" => "routine",
            "category" => [
                [
                    "coding" => [
                        [
                            "system" => "http://snomed.info/sct",
                            "code" => "108252007",
                            "display" => "Laboratory procedure"
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
                ],
                "text" => "Pemeriksaan Sputum BTA"
            ],
            "subject" => [
                "reference" => "Patient/100000030009"
            ],
            "encounter" => [
                "reference" => "Encounter/" . $encounter_id,
                "display" => "Permintaan BTA Sputum Budi Santoso di hari Selasa, 14 Juni 2022 pukul 09:30 WIB"
            ],
            "occurrenceDateTime" => "2022-06-14T09:30:27+07:00",
            "authoredOn" => "2022-06-13T12:30:27+07:00",
            "requester" => [
                "reference" => "Practitioner/N10000001",
                "display" => "Dokter Bronsig"
            ],
            "performer" => [
                [
                    "reference" => "Practitioner/N10000005",
                    "display" => "Fatma"
                ]
            ],
            "reasonCode" => [
                [
                    "text" => "Periksa jika ada kemungkinan Tuberculosis"
                ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ServiceRequestHelper::token(),
        ])
        ->post(ServiceRequestHelper::url().'/ServiceRequest', $data);

        return $response->json();
    }

    public static function createRujukanKontrol(){
        $encounter_id = 'dummy123';
        $data = [
            "resourceType" => "ServiceRequest",
            "identifier" => [
                [
                    "system" => "http://sys-ids.kemkes.go.id/servicerequest/" . ServiceRequestHelper::orgId() ,
                    "value" => "00001"
                ]
            ],
            "status" => "active",
            "intent" => "original-order",
            "priority" => "routine",
            "category" => [
                [
                    "coding" => [
                        [
                            "system" => "http://snomed.info/sct",
                            "code" => "306098008",
                            "display" => "Self-referral"
                        ]
                    ]
                ],
                [
                    "coding" => [
                        [
                            "system" => "http://snomed.info/sct",
                            "code" => "11429006",
                            "display" => "Consultation"
                        ]
                    ]
                ]
            ],
            "code" => [
                "coding" => [
                    [
                        "system" => "http://snomed.info/sct",
                        "code" => "185389009",
                        "display" => "Follow-up visit"
                    ]
                ],
                "text" => "Kontrol rutin regimen TB bulan ke-2"
            ],
            "subject" => [
                "reference" => "Patient/100000030009"
            ],
            "encounter" => [
                "reference" => "Encounter/" . $encounter_id,
                "display" => "Kunjungan Budi Santoso di hari Selasa, 14 Juni 2022"
            ],
            "occurrenceDateTime" => "2022-07-14",
            "authoredOn" => "2022-06-14T09:30:27+07:00",
            "requester" => [
                "reference" => "Practitioner/N10000001",
                "display" => "Dokter Bronsig"
            ],
            "performer" => [
                [
                    "reference" => "Practitioner/N10000005",
                    "display" => "Fatma"
                ]
            ],
            "reasonCode" => [
                [
                    "coding" => [
                        [
                            "system" => "http://hl7.org/fhir/sid/icd-10",
                            "code" => "A15.0",
                            "display" => "Tuberculosis of lung, confirmed by sputum microscopy with or without culture"
                        ]
                    ],
                    "text" => "Kontrol rutin bulanan"
                ]
            ],
            "locationCode" => [
                [
                    "coding" => [
                        [
                            "system" => "http://terminology.hl7.org/CodeSystem/v3-RoleCode",
                            "code" => "OF",
                            "display" => "Outpatient Facility"
                        ]
                    ]
                ]
            ],
            "locationReference" => [
                [
                    "reference" => "Location/ef011065-38c9-46f8-9c35-d1fe68966a3e",
                    "display" => "Ruang 1A, Poliklinik Rawat Jalan"
                ]
            ],
            "patientInstruction" => "Kontrol setelah 1 bulan minum obat anti tuberkulosis. Dalam keadaan darurat dapat menghubungi hotline RS di nomor 14045"
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ServiceRequestHelper::token(),
        ])
        ->post(ServiceRequestHelper::url().'/ServiceRequest', $data);

        return $response->json();
    }

    public static function createRujukanRadiologi(){
        $encounter_id = 'dummy123';
        $data = [
            "resourceType" => "ServiceRequest",
            "identifier" => [
                [
                    "system" => "http://sys-ids.kemkes.go.id/servicerequest/" . ServiceRequestHelper::orgId(),
                    "value" => "00001"
                ]
            ],
            "status" => "active",
            "intent" => "original-order",
            "priority" => "routine",
            "category" => [
                [
                    "coding" => [
                        [
                            "system" => "http://snomed.info/sct",
                            "code" => "3457005",
                            "display" => "Patient referral"
                        ]
                    ]
                ],
                [
                    "coding" => [
                        [
                            "system" => "http://snomed.info/sct",
                            "code" => "363679005",
                            "display" => "Imaging"
                        ]
                    ]
                ]
            ],
            "code" => [
                "coding" => [
                    [
                        "system" => "http://loinc.org",
                        "code" => "79103-8",
                        "display" => "CT Abdomen W contrast IV"
                    ]
                ],
                "text" => "Pemeriksaan CT Scan Abdomen Atas"
            ],
            "subject" => [
                "reference" => "Patient/100000030009"
            ],
            "encounter" => [
                "reference" => "Encounter/" . $encounter_id,
                "display" => "Kunjungan Budi Santoso di hari Selasa, 14 Juni 2022"
            ],
            "occurrenceDateTime" => "2022-07-14",
            "authoredOn" => "2022-06-14T09:30:27+07:00",
            "requester" => [
                "reference" => "Practitioner/N10000001",
                "display" => "Dokter Bronsig"
            ],
            "performer" => [
                [
                    "reference" => "Practitioner/N10000005",
                    "display" => "Fatma"
                ]
            ],
            "reasonCode" => [
                [
                    "coding" => [
                        [
                            "system" => "http://hl7.org/fhir/sid/icd-10",
                            "code" => "A15.0",
                            "display" => "Tuberculosis of lung, confirmed by sputum microscopy with or without culture"
                        ]
                    ],
                    "text" => "Kontrol rutin bulanan"
                ]
            ],
            "locationCode" => [
                [
                    "coding" => [
                        [
                            "system" => "http://terminology.hl7.org/CodeSystem/v3-RoleCode",
                            "code" => "OF",
                            "display" => "Outpatient Facility"
                        ]
                    ]
                ]
            ],
            "locationReference" => [
                [
                    "reference" => "Location/ef011065-38c9-46f8-9c35-d1fe68966a3e",
                    "display" => "Ruang 1A, Poliklinik Rawat Jalan"
                ]
            ],
            "patientInstruction" => "Kontrol setelah 1 bulan minum obat anti tuberkulosis. Dalam keadaan darurat dapat menghubungi hotline RS di nomor 14045"
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ServiceRequestHelper::token(),
        ])
        ->post(ServiceRequestHelper::url().'/ServiceRequest', $data);

        return $response->json();
    }

    public static function searchIdentifier($identifier){
        $identifier = 'http://sys-ids.kemkes.go.id/acsn/'. ServiceRequestHelper::orgId() .'|21120054';
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ServiceRequestHelper::token(),
        ])
        ->get(ServiceRequestHelper::url().'/ServiceRequest?identifier=' . $identifier);

        return $response->json();
    }

    public static function searchSubject($subject){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ServiceRequestHelper::token(),
        ])
        ->get(ServiceRequestHelper::url().'/ServiceRequest?subject=' . $subject);

        return $response->json();
    }

    public static function searchSubjectEncounter($subject, $encounter_id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ServiceRequestHelper::token(),
        ])
        ->get(ServiceRequestHelper::url().'/ServiceRequest?subject=' . $subject . '&encounter=' . $encounter_id);

        return $response->json();
    }

    public static function searchEncounter($encounter_id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ServiceRequestHelper::token(),
        ])
        ->get(ServiceRequestHelper::url().'/ServiceRequest?encounter=' . $encounter_id);

        return $response->json();
    }

    public static function searchId($id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ServiceRequestHelper::token(),
        ])
        ->get(ServiceRequestHelper::url().'/ServiceRequest/' . $id);

        return $response->json();
    }

    public static function searchNomorRujukan($identifier){
        $identifier = 'http://sys-ids.kemkes.go.id/referral-number|1000000005';
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ServiceRequestHelper::token(),
        ])
        ->get(ServiceRequestHelper::url().'/ServiceRequest?identifier=' . $identifier);

        return $response->json();
    }

    public static function update($id){
        $encounter_id = 'dummy123';
        $data = [
            "resourceType" => "ServiceRequest",
            "id" => $id,
            "identifier" => [
                [
                    "system" => "http://sys-ids.kemkes.go.id/servicerequest/" . ServiceRequestHelper::orgId(),
                    "value" => "00001"
                ]
            ],
            "status" => "active",
            "intent" => "original-order",
            "priority" => "routine",
            "category" => [
                [
                    "coding" => [
                        [
                            "system" => "http://snomed.info/sct",
                            "code" => "108252007",
                            "display" => "Laboratory procedure"
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
                ],
                "text" => "Pemeriksaan Sputum BTA"
            ],
            "subject" => [
                "reference" => "Patient/100000030009"
            ],
            "encounter" => [
                "reference" => "Encounter/" . $encounter_id,
                "display" => "Permintaan BTA Sputum Budi Santoso di hari Selasa, 14 Juni 2022 pukul 09:30 WIB"
            ],
            "occurrenceDateTime" => "2022-06-14T09:30:27+07:00",
            "authoredOn" => "2022-06-13T12:30:27+07:00",
            "requester" => [
                "reference" => "Practitioner/N10000001",
                "display" => "Dokter Bronsig"
            ],
            "performer" => [
                [
                    "reference" => "Practitioner/N10000005",
                    "display" => "Fatma"
                ]
            ],
            "reasonCode" => [
                [
                    "text" => "Periksa jika ada kemungkinan Tuberculosis"
                ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ServiceRequestHelper::token(),
        ])
        ->put(ServiceRequestHelper::url().'/ServiceRequest/' . $id, $data);

        return $response->json();
    }
}
