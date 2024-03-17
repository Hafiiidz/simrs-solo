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

class PatientHelper
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
    public static function ssl(){
        if (config('app.env') == 'production') {
            return true;
        } else {
            return false;        }

    }

    public static function createNik(){

        $data = [
            "resourceType" => "Patient",
            "meta" => [
               "profile" => [
                  "https://fhir.kemkes.go.id/r4/StructureDefinition/Patient"
               ]
            ],
            "identifier" => [
               [
                  "use" => "official",
                  "system" => "https://fhir.kemkes.go.id/id/nik",
                  "value" => "123214213"
               ]
            //    ,[
            //       "use" => "official",
            //       "system" => "https://fhir.kemkes.go.id/id/paspor",
            //       "value" => "A01111222"
            //    ],
            //    [
            //       "use" => "official",
            //       "system" => "https://fhir.kemkes.go.id/id/kk",
            //       "value" => "367400001111111"
            //    ]
            ],
            "active" => true,
            "name" => [
               [
                  "use" => "official",
                  "text" => "John Smith"
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
            "birthDate" => "1945-11-17",
            "deceasedBoolean" => false,
            "address" => [
               [
                  "use" => "home",
                  "line" => [
                     "Gd. Prof. Dr. Sujudi Lt.5, Jl. H.R. Rasuna Said Blok X5 Kav. 4-9 Kuningan"
                  ],
                  "city" => "Jakarta",
                  "postalCode" => "12950",
                  "country" => "ID",
                  "extension" => [
                     [
                        "url" => "https://fhir.kemkes.go.id/r4/StructureDefinition/administrativeCode",
                        "extension" => [
                           [
                              "url" => "province",
                              "valueCode" => "10"
                           ],
                           [
                              "url" => "city",
                              "valueCode" => "1010"
                           ],
                           [
                              "url" => "district",
                              "valueCode" => "1010101"
                           ],
                           [
                              "url" => "village",
                              "valueCode" => "1010101101"
                           ],
                           [
                              "url" => "rt",
                              "valueCode" => "2"
                           ],
                           [
                              "url" => "rw",
                              "valueCode" => "2"
                           ]
                        ]
                     ]
                  ]
               ]
            ],
            "maritalStatus" => [
               "coding" => [
                  [
                     "system" => "http://terminology.hl7.org/CodeSystem/v3-MaritalStatus",
                     "code" => "M",
                     "display" => "Married"
                  ]
               ],
               "text" => "Married"
            ],
            "multipleBirthInteger" => 0,
            "contact" => [
               [
                  "relationship" => [
                     [
                        "coding" => [
                           [
                              "system" => "http://terminology.hl7.org/CodeSystem/v2-0131",
                              "code" => "C"
                           ]
                        ]
                     ]
                  ],
                  "name" => [
                     "use" => "official",
                     "text" => "Jane Smith"
                  ],
                  "telecom" => [
                     [
                        "system" => "phone",
                        "value" => "0690383372",
                        "use" => "mobile"
                     ]
                  ]
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
            ],
            "extension" => [
               [
                  "url" => "https://fhir.kemkes.go.id/r4/StructureDefinition/birthPlace",
                  "valueAddress" => [
                     "city" => "Bandung",
                     "country" => "ID"
                  ]
               ],
               [
                  "url" => "https://fhir.kemkes.go.id/r4/StructureDefinition/citizenshipStatus",
                  "valueCode" => "WNI"
               ]
            ]
        ];

        $response = Http::withOptions(["verify" => SatusehatAuthHelper::ssl()])
        ->withHeaders([
            'Authorization' => 'Bearer '.PatientHelper::token(),
        ])
        ->post(PatientHelper::url().'/Patient', $data);

        return $response->json();
    }

    public static function searchNik($nik){
        $response = Http::withOptions(["verify" => SatusehatAuthHelper::ssl()])
        ->withHeaders([
            'Authorization' => 'Bearer '.PatientHelper::token(),
        ])
        ->get(LocationHelper::url().'/Patient?identifier=https://fhir.kemkes.go.id/id/nik|' . $nik);

        return $response->json();
    }

    public static function searchNameBirthNik($nama, $tanggal, $nik){
        $response = Http::withOptions(["verify" => SatusehatAuthHelper::ssl()])
        ->withHeaders([
            'Authorization' => 'Bearer '.PatientHelper::token(),
        ])
        ->get(LocationHelper::url().'/Patient?name='. $nama .'&birthdate='. $tanggal .'&identifier=https://fhir.kemkes.go.id/id/nik|'. $nik);

        return $response->json();
    }

    public static function searchNameBirthGender($nama, $tanggal, $gender){
        $response = Http::withOptions(["verify" => SatusehatAuthHelper::ssl()])
        ->withHeaders([
            'Authorization' => 'Bearer '.PatientHelper::token(),
        ])
        ->get(LocationHelper::url().'/Patient?name='. $nama .'&birthdate='. $tanggal .'&gender='. $gender);

        return $response->json();
    }

    public static function searchId($id){
        $response = Http::withOptions(["verify" => SatusehatAuthHelper::ssl()])
        ->withHeaders([
            'Authorization' => 'Bearer '.PatientHelper::token(),
        ])
        ->get(LocationHelper::url().'/Patient/' . $id);

        return $response->json();
    }

    public static function createMotherNik(){
        $data = [
            "resourceType" => "Patient",
            "meta" => [
                "profile" => [
                    "https://fhir.kemkes.go.id/r4/StructureDefinition/Patient"
                ]
            ],
            "identifier" => [
                [
                    "use" => "official",
                    "system" => "https://fhir.kemkes.go.id/id/nik-ibu",
                    "value" => "2132222213214213"
                ]
            ],
            "active" => true,
            "name" => [
                [
                    "use" => "official",
                    "text" => "John Smith Dummy 213"
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
            "birthDate" => "2024-03-01",
            "deceasedBoolean" => false,
            "address" => [
                [
                    "use" => "home",
                    "line" => [
                        "Gd. Prof. Dr. Sujudi Lt.5, Jl. H.R. Rasuna Said Blok X5 Kav. 4-9 Kuningan"
                    ],
                    "city" => "Jakarta",
                    "postalCode" => "12950",
                    "country" => "ID",
                    "extension" => [
                        [
                            "url" => "https://fhir.kemkes.go.id/r4/StructureDefinition/administrativeCode",
                            "extension" => [
                                [
                                    "url" => "province",
                                    "valueCode" => "10"
                                ],
                                [
                                    "url" => "city",
                                    "valueCode" => "1010"
                                ],
                                [
                                    "url" => "district",
                                    "valueCode" => "1010101"
                                ],
                                [
                                    "url" => "village",
                                    "valueCode" => "1010101101"
                                ],
                                [
                                    "url" => "rt",
                                    "valueCode" => "2"
                                ],
                                [
                                    "url" => "rw",
                                    "valueCode" => "2"
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            "maritalStatus" => [
                "coding" => [
                    [
                        "system" => "http://terminology.hl7.org/CodeSystem/v3-MaritalStatus",
                        "code" => "M",
                        "display" => "Married"
                    ]
                ],
                "text" => "Married"
            ],
            "multipleBirthInteger" => 0,
            "contact" => [
                [
                    "relationship" => [
                        [
                            "coding" => [
                                [
                                    "system" => "http://terminology.hl7.org/CodeSystem/v2-0131",
                                    "code" => "C"
                                ]
                            ]
                        ]
                    ],
                    "name" => [
                        "use" => "official",
                        "text" => "Jane Smith"
                    ],
                    "telecom" => [
                        [
                            "system" => "phone",
                            "value" => "0690383372",
                            "use" => "mobile"
                        ]
                    ]
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
            ],
            "extension" => [
                [
                    "url" => "https://fhir.kemkes.go.id/r4/StructureDefinition/birthPlace",
                    "valueAddress" => [
                        "city" => "Bandung",
                        "country" => "ID"
                    ]
                ],
                [
                    "url" => "https://fhir.kemkes.go.id/r4/StructureDefinition/citizenshipStatus",
                    "valueCode" => "WNI"
                ]
            ]
        ];

        $response = Http::withOptions(["verify" => SatusehatAuthHelper::ssl()])
        ->withHeaders([
            'Authorization' => 'Bearer '.PatientHelper::token(),
        ])
        ->post(PatientHelper::url().'/Patient', $data);

        return $response->json();
    }

    public static function searchMotherNik($nik){
        $response = Http::withOptions(["verify" => SatusehatAuthHelper::ssl()])
        ->withHeaders([
            'Authorization' => 'Bearer '.PatientHelper::token(),
        ])
        ->get(LocationHelper::url().'/Patient?identifier=https://fhir.kemkes.go.id/id/nik-ibu|' . $nik);

        return $response->json();
    }
}
