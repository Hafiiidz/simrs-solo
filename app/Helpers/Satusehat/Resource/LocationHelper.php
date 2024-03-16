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

class LocationHelper
{
    public static function token(){
        $get_token = SatusehatAuthHelper::generate_token();
        return $get_token['access_token'];
    }

    public static function url(){
        return env('STG_BASE_URL_SS');
    }

    public static function orgId(){
        return 100026489;
    }

    public static function create(){

        $data = [
            "resourceType"=> "Location",
            // "identifier"=> [
            //     [
            //         "system"=> "http=>//sys-ids.kemkes.go.id/location/" . LocationHelper::orgId(),
            //         "value"=> "1"
            //     ]
            // ],
            "status"=> "active",
            "name"=> "Ruangan-1",
            "description"=> "Deskripsi dummy",
            "mode"=> "instance",
            "telecom"=> [
                [
                    "system"=> "phone",
                    "value"=> "2328",
                    "use"=> "work"
                ],
                [
                    "system"=> "fax",
                    "value"=> "2329",
                    "use"=> "work"
                ],
                [
                    "system"=> "email",
                    "value"=> "second wing admissions"
                ],
                [
                    "system"=> "url",
                    "value"=> "http=>//sampleorg.com/southwing",
                    "use"=> "work"
                ]
            ],
            "address"=> [
                "use"=> "work",
                "line"=> [
                    "Gd. Prof. Dr. Sujudi Lt.5, Jl. H.R. Rasuna Said Blok X5 Kav. 4-9 Kuningan"
                ],
                "city"=> "Jakarta",
                "postalCode"=> "12950",
                "country"=> "ID",
                "extension"=> [
                    [
                        "url"=> "https=>//fhir.kemkes.go.id/r4/StructureDefinition/administrativeCode",
                        "extension"=> [
                            [
                                "url"=> "province",
                                "valueCode"=> "10"
                            ],
                            [
                                "url"=> "city",
                                "valueCode"=> "1010"
                            ],
                            [
                                "url"=> "district",
                                "valueCode"=> "1010101"
                            ],
                            [
                                "url"=> "village",
                                "valueCode"=> "1010101101"
                            ],
                            [
                                "url"=> "rt",
                                "valueCode"=> "1"
                            ],
                            [
                                "url"=> "rw",
                                "valueCode"=> "2"
                            ]
                        ]
                    ]
                ]
            ],
            // "physicalType"=> [
            //     "coding"=> [
            //         [
            //             "system"=> "http=>//terminology.hl7.org/CodeSystem/location-physical-type",
            //             "code"=> "ro",
            //             "display"=> "Room"
            //         ]
            //     ]
            // ],
            "position"=> [
                "longitude"=> -6.23115426275766,
                "latitude"=> 106.83239885393944,
                "altitude"=> 0
            ],
            "managingOrganization"=> [
                "reference"=> "Organization/" . LocationHelper::orgId()
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.LocationHelper::token(),
        ])
        ->post(LocationHelper::url().'/Location', $data);

        return $response->json();
    }

    public static function searchOrgId($id){

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.LocationHelper::token(),
        ])
        ->get(LocationHelper::url().'/Location?organization=' . $id);

        return $response->json();
    }

    public static function searchId($id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.LocationHelper::token(),
        ])
        ->get(LocationHelper::url().'/Location/' . $id);

        return $response->json();
    }

    public static function update($id){
        $data = [
            "resourceType"=> "Location",
            "id"=> $id,
            // "identifier"=> [
            //     [
            //         "system"=> "http=>//sys-ids.kemkes.go.id/location/" . LocationHelper::orgId(),
            //         "value"=> "1"
            //     ]
            // ],
            "status"=> "active",
            "name"=> "Ruangan-UPDATE",
            "description"=> "Deskripsi dummy",
            "mode"=> "instance",
            "telecom"=> [
                [
                    "system"=> "phone",
                    "value"=> "2328",
                    "use"=> "work"
                ],
                [
                    "system"=> "fax",
                    "value"=> "2329",
                    "use"=> "work"
                ],
                [
                    "system"=> "email",
                    "value"=> "second wing admissions"
                ],
                [
                    "system"=> "url",
                    "value"=> "http=>//sampleorg.com/southwing",
                    "use"=> "work"
                ]
            ],
            "address"=> [
                "use"=> "work",
                "line"=> [
                    "Gd. Prof. Dr. Sujudi Lt.5, Jl. H.R. Rasuna Said Blok X5 Kav. 4-9 Kuningan"
                ],
                "city"=> "Jakarta",
                "postalCode"=> "12950",
                "country"=> "ID",
                "extension"=> [
                    [
                        "url"=> "https=>//fhir.kemkes.go.id/r4/StructureDefinition/administrativeCode",
                        "extension"=> [
                            [
                                "url"=> "province",
                                "valueCode"=> "10"
                            ],
                            [
                                "url"=> "city",
                                "valueCode"=> "1010"
                            ],
                            [
                                "url"=> "district",
                                "valueCode"=> "1010101"
                            ],
                            [
                                "url"=> "village",
                                "valueCode"=> "1010101101"
                            ],
                            [
                                "url"=> "rt",
                                "valueCode"=> "1"
                            ],
                            [
                                "url"=> "rw",
                                "valueCode"=> "2"
                            ]
                        ]
                    ]
                ]
            ],
            // "physicalType"=> [
            //     "coding"=> [
            //         [
            //             "system"=> "http=>//terminology.hl7.org/CodeSystem/location-physical-type",
            //             "code"=> "ro",
            //             "display"=> "Room"
            //         ]
            //     ]
            // ],
            "position"=> [
                "longitude"=> -6.23115426275766,
                "latitude"=> 106.83239885393944,
                "altitude"=> 0
            ],
            "managingOrganization"=> [
                "reference"=> "Organization/" . LocationHelper::orgId()
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.LocationHelper::token(),
        ])
        ->put(LocationHelper::url().'/Location/' . $id, $data);

        return $response->json();
    }
}
