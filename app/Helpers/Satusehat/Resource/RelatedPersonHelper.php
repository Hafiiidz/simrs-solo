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

class RelatedPersonHelper
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
            "resourceType" => "RelatedPerson",
            "meta" => [
                "profile" => [
                    "https://fhir.kemkes.go.id/r4/StructureDefinition/RelatedPerson"
                ]
            ],
            "identifier" => [
                [
                    "use" => "official",
                    "system" => "https://fhir.kemkes.go.id/id/nik",
                    "value" => "367400001111222"
                ]
            ],
            "active" => true,
            "relationship" => [
                [
                    "coding" => [
                        [
                            "system" => "http://terminology.hl7.org/CodeSystem/v3-RoleCode",
                            "code" => "NMTH",
                            "display" => "natural mother"
                        ]
                    ],
                    "text" => "Natural Mother"
                ]
            ],
            "patient" => [
                "reference" => "Patient/P02029102701"
            ],
            "name" => [
                [
                    "use" => "official",
                    "text" => "Jane Smith"
                ]
            ],
            "telecom" => [
                [
                    "system" => "phone",
                    "value" => "08123456789",
                    "use" => "mobile"
                ],
                [
                    "system" => "phone",
                    "value" => "+622123456789",
                    "use" => "home"
                ],
                [
                    "system" => "email",
                    "value" => "john.smith@xyz.com",
                    "use" => "home"
                ]
            ],
            "gender" => "female",
            "birthDate" => "2023-03-08",
            "address" => [
                [
                    "use" => "home",
                    "line" => [
                        "Gd. Prof. Dr. Sujudi Lt.5, Jl. H.R. Rasuna Said Blok X5 Kav. 4-9 Kuningan"
                    ],
                    "city" => "Jakarta",
                    "postalCode" => "12950",
                    "country" => "ID"
                ]
            ],
            "communication" => [
                [
                    "language" => [
                        "coding" => [
                            [
                                "system" => "urn:ietf:bcp:47",
                                "code" => "id-ID",
                                "display" => "Indonesian"
                            ]
                        ],
                        "text" => "Indonesian"
                    ],
                    "preferred" => true
                ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.RelatedPersonHelper::token(),
        ])
        ->post(RelatedPersonHelper::url().'/RelatedPerson', $data);

        return $response->json();
    }

    public static function update($id){
        $encounter_id = 'dummy123';
        $data = [
            "resourceType" => "RelatedPerson",
            "id" => $id,
            "meta" => [
                "profile" => [
                    "https://fhir.kemkes.go.id/r4/StructureDefinition/RelatedPerson"
                ]
            ],
            "identifier" => [
                [
                    "use" => "official",
                    "system" => "https://fhir.kemkes.go.id/id/nik",
                    "value" => "367400001111222"
                ]
            ],
            "active" => true,
            "relationship" => [
                [
                    "coding" => [
                        [
                            "system" => "http://terminology.hl7.org/CodeSystem/v3-RoleCode",
                            "code" => "NMTH",
                            "display" => "natural mother"
                        ]
                    ],
                    "text" => "Natural Mother"
                ]
            ],
            "patient" => [
                "reference" => "Patient/P02029102701"
            ],
            "name" => [
                [
                    "use" => "official",
                    "text" => "Jane Smith"
                ]
            ],
            "telecom" => [
                [
                    "system" => "phone",
                    "value" => "08123456789",
                    "use" => "mobile"
                ],
                [
                    "system" => "phone",
                    "value" => "+622123456789",
                    "use" => "home"
                ],
                [
                    "system" => "email",
                    "value" => "john.smith@xyz.com",
                    "use" => "home"
                ]
            ],
            "gender" => "female",
            "birthDate" => "2023-03-08",
            "address" => [
                [
                    "use" => "home",
                    "line" => [
                        "Gd. Prof. Dr. Sujudi Lt.5, Jl. H.R. Rasuna Said Blok X5 Kav. 4-9 Kuningan"
                    ],
                    "city" => "Jakarta",
                    "postalCode" => "12950",
                    "country" => "ID"
                ]
            ],
            "communication" => [
                [
                    "language" => [
                        "coding" => [
                            [
                                "system" => "urn:ietf:bcp:47",
                                "code" => "id-ID",
                                "display" => "Indonesian"
                            ]
                        ],
                        "text" => "Indonesian"
                    ],
                    "preferred" => true
                ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.RelatedPersonHelper::token(),
        ])
        ->put(RelatedPersonHelper::url().'/RelatedPerson/' . $id, $data);

        return $response->json();
    }

    public static function searchNik($identifier){
        $identifier = 'https://fhir.kemkes.go.id/id/nik|367400001111222';
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.RelatedPersonHelper::token(),
        ])
        ->get(RelatedPersonHelper::url().'/RelatedPerson?identifier=' . $identifier);

        return $response->json();
    }

}
