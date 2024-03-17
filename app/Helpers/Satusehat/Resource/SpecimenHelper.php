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

class SpecimenHelper
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

        $data = [
            "resourceType" => "Specimen",
            "identifier" => [
                [
                    "system" => "http://sys-ids.kemkes.go.id/specimen/" . SpecimenHelper::orgId(),
                    "value" => "00001",
                    "assigner" => [
                        "reference" => "Organization/" . SpecimenHelper::orgId()
                    ]
                ]
            ],
            "status" => "available",
            "type" => [
                "coding" => [
                    [
                        "system" => "http://snomed.info/sct",
                        "code" => "119294007",
                        "display" => "Dried blood specimen"
                    ]
                ]
            ],
            "collection" => [
                "collectedDateTime" => "2022-06-14T08:15:00+07:00",
                "extension" => [
                    [
                        "url" => "https://fhir.kemkes.go.id/r4/StructureDefinition/CollectorOrganization",
                        "valueReference" => [
                            "reference" => "Organization/" . SpecimenHelper::orgId()
                        ]
                    ]
                ]
            ],
            "subject" => [
                "reference" => "Patient/100000030009",
                "display" => "Budi Santoso"
            ],
            "request" => [
                [
                    "reference" => "ServiceRequest/61419a9c-51f9-4491-a6d0-e40e7c0eb7ab"
                ]
            ],
            "receivedTime" => "2022-06-14T08:25:00+07:00",
            "extension" => [
                [
                    "url" => "https://fhir.kemkes.go.id/r4/StructureDefinition/TransportedTime",
                    "valueDateTime" => "2022-06-14T08:23:00+07:00"
                ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.SpecimenHelper::token(),
        ])
        ->post(SpecimenHelper::url().'/Specimen', $data);

        return $response->json();
    }

    public static function updateRujukan($id){
        $encounter_id = 'dummy123';
        $data = [
            "resourceType" => "Specimen",
            "id" => $id,
            "identifier" => [
                [
                    "system" => "http://sys-ids.kemkes.go.id/specimen/" . SpecimenHelper::orgId(),
                    "value" => "00001",
                    "assigner" => [
                        "reference" => "Organization/" . SpecimenHelper::orgId()
                    ]
                ]
            ],
            "status" => "available",
            "type" => [
                "coding" => [
                    [
                        "system" => "http://snomed.info/sct",
                        "code" => "119294007",
                        "display" => "Dried blood specimen"
                    ]
                ]
            ],
            "collection" => [
                "collectedDateTime" => "2022-06-14T08:15:00+07:00",
                "extension" => [
                    [
                        "url" => "https://fhir.kemkes.go.id/r4/StructureDefinition/CollectorOrganization",
                        "valueReference" => [
                            "reference" => "Organization/" . SpecimenHelper::orgId()
                        ]
                    ]
                ]
            ],
            "subject" => [
                "reference" => "Patient/100000030004",
                "display" => "Budi Santoso"
            ],
            "request" => [
                [
                    "reference" => "ServiceRequest/61419a9c-51f9-4491-a6d0-e40e7c0eb7ab"
                ]
            ],
            "receivedTime" => "2022-06-14T08:25:00+07:00",
            "extension" => [
                [
                    "url" => "https://fhir.kemkes.go.id/r4/StructureDefinition/TransportedTime",
                    "valueDateTime" => "2022-06-14T08:23:00+07:00"
                ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.SpecimenHelper::token(),
        ])
        ->put(SpecimenHelper::url().'/Specimen/' . $id, $data);

        return $response->json();
    }

    public static function searchId($id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.SpecimenHelper::token(),
        ])
        ->get(SpecimenHelper::url().'/Specimen/' . $id);

        return $response->json();
    }

    public static function searchSubject($subject){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.SpecimenHelper::token(),
        ])
        ->get(SpecimenHelper::url().'/Specimen?subject=' . $subject);

        return $response->json();
    }

    public static function searchRequest($request){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.SpecimenHelper::token(),
        ])
        ->get(SpecimenHelper::url().'/Specimen?request=' . $request);

        return $response->json();
    }

    public static function searchSubjectCollector($subject, $collector){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.SpecimenHelper::token(),
        ])
        ->get(SpecimenHelper::url().'/Specimen?subject=' . $subject . '&collector=' . $collector);

        return $response->json();
    }

    public static function searchSubjectCollected($subject, $collected){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.SpecimenHelper::token(),
        ])
        ->get(SpecimenHelper::url().'/Specimen?subject=' . $subject . '&collected=' . $collected);

        return $response->json();
    }

    public static function searchIdentifierRequest($identifier, $request){
        $identifier = 'http://sys-ids.kemkes.go.id/specimen-acsn|1000000004';
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.SpecimenHelper::token(),
        ])
        ->get(SpecimenHelper::url().'/Specimen?identifier=' . $identifier . '&reque$request=' . $request);

        return $response->json();
    }

    public static function update($id){
        $encounter_id = 'dummy123';
        $data = [
            "resourceType" => "Specimen",
            "id" => $id,
            "identifier" => [
                [
                    "system" => "http://sys-ids.kemkes.go.id/specimen/" . SpecimenHelper::orgId(),
                    "value" => "00001",
                    "assigner" => [
                        "reference" => "Organization/" . SpecimenHelper::orgId()
                    ]
                ]
            ],
            "status" => "unsatisfactory",
            "type" => [
                "coding" => [
                    [
                        "system" => "http://snomed.info/sct",
                        "code" => "119297000",
                        "display" => "Blood specimen"
                    ]
                ]
            ],
            "collection" => [
                "method" => [
                    "coding" => [
                        [
                            "system" => "http://snomed.info/sct",
                            "code" => "82078001",
                            "display" => "Collection of blood specimen for laboratory"
                        ]
                    ]
                ],
                "collectedDateTime" => "2022-06-14T08:15:00+07:00"
            ],
            "subject" => [
                "reference" => "Patient/100000030009",
                "display" => "Budi Santoso"
            ],
            "request" => [
                [
                    "reference" => "ServiceRequest/65b8a884-7a79-41e1-96ab-3fc30837ac66"
                ]
            ],
            "receivedTime" => "2022-06-14T08:25:00+07:00"
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.SpecimenHelper::token(),
        ])
        ->put(SpecimenHelper::url().'/Specimen/' . $id, $data);

        return $response->json();
    }
}
