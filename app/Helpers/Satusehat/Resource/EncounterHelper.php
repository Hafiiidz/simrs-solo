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

class EncounterHelper
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
            "resourceType"=> "Encounter",
            "identifier"=> [
                [
                    "system"=> "http://sys-ids.kemkes.go.id/encounter/100026489",
                    "value"=> "RJL2024009"
                ]
            ],
            "status"=> "arrived",
            "class"=> [
                "system"=> "http://terminology.hl7.org/CodeSystem/v3-ActCode",
                "code"=> "AMB",
                "display"=> "ambulatory"
            ],
            "subject"=> [
                "reference"=> "Patient/P01133936352",
                "display"=> "Fikri Ramadhan"
            ],
            "participant"=> [
                [
                    "type"=> [
                        [
                            "coding"=> [
                                [
                                    "system"=> "http://terminology.hl7.org/CodeSystem/v3-ParticipationType",
                                    "code"=> "ATND",
                                    "display"=> "attender"
                                ]
                            ]
                        ]
                    ],
                    "individual"=> [
                        "reference"=> "Practitioner/10010107883",
                        "display"=> "INDITO ADJIE"
                    ]
                ]
            ],
            "period"=> [
                "start"=> date('Y-m-d')."T".date('H:i:s')."+07:00"
            ],
            "location"=> [
                [
                    "location"=> [
                        "reference"=> "Location/359f5ff7-61cc-4d43-b11b-b947c3ff450e",
                        "display"=> "MINMED"
                    ]
                ]
            ],
            "statusHistory"=> [
                [
                    "status"=> "arrived",
                    "period"=> [
                        "start"=> date('Y-m-d')."T".date('H:i:s')."+07:00"
                    ]
                ]
            ],
            "serviceProvider"=> [
                "reference"=> "Organization/100026489"
            ],

        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.EncounterHelper::token(),
        ])
        ->post(EncounterHelper::url().'/Encounter', $data);

        return $response->json();
    }

    public static function searchId($id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.EncounterHelper::token(),
        ])
        ->get(EncounterHelper::url().'/Encounter/' . $id);

        return $response->json();
    }

    public static function searchSubject($subject){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.EncounterHelper::token(),
        ])
        ->get(EncounterHelper::url().'/Encounter?subject=' . $subject);

        return $response->json();
    }

    public static function updateInprogress($id){
        $data = [
            "resourceType" => "Encounter",
            "id" => $id,
            "identifier" => [
              [
                "system" => "http://sys-ids.kemkes.go.id/encounter/" . EncounterHelper::orgId(),
                "value" => "P20240001"
              ]
            ],
            "status" => "in-progress",
            "class" => [
              "system" => "http://terminology.hl7.org/CodeSystem/v3-ActCode",
              "code" => "AMB",
              "display" => "ambulatory"
            ],
            "subject" => [
              "reference" => "Patient/100000030009",
              "display" => "Budi Santoso"
            ],
            "participant" => [
              [
                "type" => [
                  [
                    "coding" => [
                      [
                        "system" => "http://terminology.hl7.org/CodeSystem/v3-ParticipationType",
                        "code" => "ATND",
                        "display" => "attender"
                      ]
                    ]
                  ]
                ],
                "individual" => [
                  "reference" => "Practitioner/N10000001",
                  "display" => "Dokter Bronsig"
                ]
              ]
            ],
            "period" => [
              "start" => "2022-06-14T07:00:00+07:00",
              "end" => "2022-06-14T09:00:00+07:00"
            ],
            "location" => [
              [
                "location" => [
                  "reference" => "Location/ef011065-38c9-46f8-9c35-d1fe68966a3e",
                  "display" => "Ruang 1A, Poliklinik Rawat Jalan"
                ]
              ]
            ],
            "statusHistory" => [
              [
                "status" => "arrived",
                "period" => [
                  "start" => "2022-06-14T07:00:00+07:00",
                  "end" => "2022-06-14T08:00:00+07:00"
                ]
              ],
              [
                "status" => "in-progress",
                "period" => [
                  "start" => "2022-06-14T08:00:00+07:00",
                  "end" => "2022-06-14T09:00:00+07:00"
                ]
              ]
            ],
            "serviceProvider" => [
              "reference" =>"Organization/". EncounterHelper::orgId()
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.EncounterHelper::token(),
        ])
        ->post(EncounterHelper::url().'/Encounter/' . $id, $data);

        return $response->json();
    }

    public static function updateDischarge($id){

        $data = [
            "resourceType" => "Encounter",
            "id" => $id,
            "identifier" => [
                [
                    "system" => "http://sys-ids.kemkes.go.id/encounter/" . EncounterHelper::orgId(),
                    "value" => "P20240001"
                ]
            ],
            "status" => "in-progress",
            "class" => [
                "system" => "http://terminology.hl7.org/CodeSystem/v3-ActCode",
                "code" => "AMB",
                "display" => "ambulatory"
            ],
            "subject" => [
                "reference" => "Patient/100000030009",
                "display" => "Budi Santoso"
            ],
            "participant" => [
                [
                    "type" => [
                        [
                            "coding" => [
                                [
                                    "system" => "http://terminology.hl7.org/CodeSystem/v3-ParticipationType",
                                    "code" => "ATND",
                                    "display" => "attender"
                                ]
                            ]
                        ]
                    ],
                    "individual" => [
                        "reference" => "Practitioner/N10000001",
                        "display" => "Dokter Bronsig"
                    ]
                ]
            ],
            "period" => [
                "start" => "2022-06-14T07:00:00+07:00",
                "end" => "2022-06-14T09:00:00+07:00"
            ],
            "location" => [
                [
                    "location" => [
                        "reference" => "Location/ef011065-38c9-46f8-9c35-d1fe68966a3e",
                        "display" => "Ruang 1A, Poliklinik Rawat Jalan"
                    ]
                ]
            ],
            "statusHistory" => [
                [
                    "status" => "arrived",
                    "period" => [
                        "start" => "2022-06-14T07:00:00+07:00",
                        "end" => "2022-06-14T08:00:00+07:00"
                    ]
                ],
                [
                    "status" => "in-progress",
                    "period" => [
                        "start" => "2022-06-14T08:00:00+07:00",
                        "end" => "2022-06-14T09:00:00+07:00"
                    ]
                ]
            ],
            "hospitalization" => [
                "dischargeDisposition" => [
                    "coding" => [
                        [
                            "system" => "http://terminology.hl7.org/CodeSystem/discharge-disposition",
                            "code" => "home",
                            "display" => "Home"
                        ]
                    ],
                    "text" => "Anjuran dokter untuk pulang dan kontrol kembali 1 bulan setelah minum obat"
                ]
            ],
            "serviceProvider" => [
                "reference" => "Organization/" . EncounterHelper::orgId()
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.EncounterHelper::token(),
        ])
        ->post(EncounterHelper::url().'/Encounter/' . $id, $data);

        return $response->json();
    }

    public static function updateFinished($id){

        $data = [
            "resourceType"=> "Encounter",
            "id"=> $id,
            "identifier"=> [
              [
                "system"=> "http://sys-ids.kemkes.go.id/encounter/" . EncounterHelper::orgId(),
                "value"=> "P20240001"
              ]
            ],
            "status"=> "finished",
            "class"=> [
              "system"=> "http://terminology.hl7.org/CodeSystem/v3-ActCode",
              "code"=> "AMB",
              "display"=> "ambulatory"
            ],
            "subject"=> [
              "reference"=> "Patient/100000030009",
              "display"=> "Budi Santoso"
            ],
            "participant"=> [
              [
                "type"=> [
                  [
                    "coding"=> [
                      [
                        "system"=> "http://terminology.hl7.org/CodeSystem/v3-ParticipationType",
                        "code"=> "ATND",
                        "display"=> "attender"
                      ]
                    ]
                  ]
                ],
                "individual"=> [
                  "reference"=> "Practitioner/N10000001",
                  "display"=> "Dokter Bronsig"
                ]
              ]
            ],
            "period"=> [
              "start"=> "2022-06-14T07:00:00+07:00",
              "end"=> "2022-06-14T09:00:00+07:00"
            ],
            "location"=> [
              [
                "location"=> [
                  "reference"=> "Location/ef011065-38c9-46f8-9c35-d1fe68966a3e",
                  "display"=> "Ruang 1A, Poliklinik Rawat Jalan"
                ]
              ]
            ],
            "diagnosis"=> [
              [
                "condition"=> [
                  "reference"=> "Condition/4bbbe654-14f5-4ab3-a36e-a1e307f67bb8",
                  "display"=> "Tuberculosis of lung, confirmed by sputum microscopy with or without culture"
                ],
                "use"=> [
                  "coding"=> [
                    [
                      "system"=> "http://terminology.hl7.org/CodeSystem/diagnosis-role",
                      "code"=> "DD",
                      "display"=> "Discharge diagnosis"
                    ]
                  ]
                ],
                "rank"=> 1
              ],
              [
                "condition"=> [
                  "reference"=> "Condition/666970c2-d79f-4242-89f9-d0ffab9e36cf",
                  "display"=> "Non-insulin-dependent diabetes mellitus without complications"
                ],
                "use"=> [
                  "coding"=> [
                    [
                      "system"=> "http://terminology.hl7.org/CodeSystem/diagnosis-role",
                      "code"=> "DD",
                      "display"=> "Discharge diagnosis"
                    ]
                  ]
                ],
                "rank"=> 2
              ]
            ],
            "statusHistory"=> [
              [
                "status"=> "arrived",
                "period"=> [
                  "start"=> "2022-06-14T07:00:00+07:00",
                  "end"=> "2022-06-14T08:00:00+07:00"
                ]
              ],
              [
                "status"=> "in-progress",
                "period"=> [
                  "start"=> "2022-06-14T08:00:00+07:00",
                  "end"=> "2022-06-14T09:00:00+07:00"
                ]
              ],
              [
                "status"=> "finished",
                "period"=> [
                  "start"=> "2022-06-14T09:00:00+07:00",
                  "end"=> "2022-06-14T09:00:00+07:00"
                ]
              ]
            ],
            "serviceProvider"=> [
              "reference"=>"Organization/"  . EncounterHelper::orgId()
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.EncounterHelper::token(),
        ])
        ->post(EncounterHelper::url().'/Encounter/' . $id, $data);

        return $response->json();
    }
}
