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

class ImagingStudyHelper
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
            "resourceType" => "ImagingStudy",
            "identifier" => [
              [
                "use" => "usual",
                "type" => [
                  "coding" => [
                    [
                      "system" => "http://terminology.hl7.org/CodeSystem/v2-0203",
                      "code" => "ACSN"
                    ]
                  ]
                ],
                "system" => "http://sys-ids.kemkes.go.id/acsn/" . ImagingStudyHelper::orgId(),
                "value" => "210610114146"
              ],
              [
                "system" => "urn:dicom:uid",
                "value" => "urn:oid:2.16.380.31256.1.2449191199178232.20210610114926906"
              ]
            ],
            "status" => "available",
            "modality" => [
              [
                "system" => "http://dicom.nema.org/resources/ontology/DCM",
                "code" => "OP"
              ]
            ],
            "subject" => [
              "reference" => "Patient/100000030009"
            ],
            "started" => "2021-06-10T11:41:46+07:00",
            "basedOn" => [
              [
                "reference" => "ServiceRequest/83218f28-0027-4d3d-9981-94517f14223e"
              ]
            ],
            "numberOfSeries" => 1,
            "numberOfInstances" => 1,
            "series" => [
              [
                "uid" => "2.16.380.31256.1.2449191199178232.20210610114926922.1",
                "number" => 1,
                "modality" => [
                  "system" => "http://dicom.nema.org/resources/ontology/DCM",
                  "code" => "OP"
                ],
                "numberOfInstances" => 1,
                "started" => "2021-06-10T11:45:01+07:00",
                "instance" => [
                  [
                    "uid" => "2.16.380.31256.1.2449191199178232.20210610114930875.1.1",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.77.1.5.1"
                    ],
                    "number" => 7,
                    "title" => "ORIGINAL\\PRIMARY"
                  ]
                ]
              ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ImagingStudyHelper::token(),
        ])
        ->post(ImagingStudyHelper::url().'/ImagingStudy', $data);

        return $response->json();
    }

    public static function searchIdentifier($identifier){
        $identifier = 'http://sys-ids.kemkes.go.id/acsn/10000004|MR.221102.062';
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ImagingStudyHelper::token(),
        ])
        ->get(ImagingStudyHelper::url().'/ImagingStudy?identifier=' . $identifier);

        return $response->json();
    }

    public static function update($id){
        $encounter_id = 'dummy123';
        $data = [
            "resourceType" => "ImagingStudy",
            "id" => $id,
            "identifier" => [
              [
                "use" => "usual",
                "type" => [
                  "coding" => [
                    [
                      "system" => "http://terminology.hl7.org/CodeSystem/v2-0203",
                      "code" => "ACSN"
                    ]
                  ]
                ],
                "system" => "http://sys-ids.kemkes.go.id/acsn/[[Org_id]]",
                "value" => "MR.221102.062"
              ],
              [
                "system" => "urn:dicom:uid",
                "value" => "urn:oid:1.2.826.0.1.3680043.9.7307.1.20221102062"
              ]
            ],
            "status" => "available",
            "modality" => [
              [
                "system" => "http://dicom.nema.org/resources/ontology/DCM",
                "code" => "MR"
              ]
            ],
            "subject" => [
              "reference" => "Patient/100000030009"
            ],
            "started" => "2022-11-02T13:37:38+07:00",
            "basedOn" => [
              [
                "reference" => "ServiceRequest/cf498c0e-86e1-457e-b464-fe0ed8948da2"
              ]
            ],
            "numberOfSeries" => 6,
            "numberOfInstances" => 73,
            "description" => "E018 - MRI Lumbosacral",
            "series" => [
              [
                "uid" => "1.2.840.113619.2.388.14436926.9266122.15378.1667174756.530",
                "number" => 7,
                "modality" => [
                  "system" => "http://dicom.nema.org/resources/ontology/DCM",
                  "code" => "MR"
                ],
                "description" => "Sag T1",
                "numberOfInstances" => 12,
                "started" => "2022-11-02T13:52:06+07:00",
                "instance" => [
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.9",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 4,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.8",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 3,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.15",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 10,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.14",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 9,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.16",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 11,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.17",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 12,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.13",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 8,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.12",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 7,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.10",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 5,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.11",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 6,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.6",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 1,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.7",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 2,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ]
                ]
              ],
              [
                "uid" => "1.2.840.113619.2.388.14436926.9266122.15378.1667174756.531",
                "number" => 8,
                "modality" => [
                  "system" => "http://dicom.nema.org/resources/ontology/DCM",
                  "code" => "MR"
                ],
                "description" => "Ax T2",
                "numberOfInstances" => 15,
                "started" => "2022-11-02T13:55:31+07:00",
                "instance" => [
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.155",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 6,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.154",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 5,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.156",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 7,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.157",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 8,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.153",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 4,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.152",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 3,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.150",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 1,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.151",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 2,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.160",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 11,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.161",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 12,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.163",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 14,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.162",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 13,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.159",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 10,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.164",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 15,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.158",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 9,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ]
                ]
              ],
              [
                "uid" => "1.2.840.113619.2.388.14436926.9266122.15378.1667174756.529",
                "number" => 6,
                "modality" => [
                  "system" => "http://dicom.nema.org/resources/ontology/DCM",
                  "code" => "MR"
                ],
                "description" => "Sag T2",
                "numberOfInstances" => 12,
                "started" => "2022-11-02T13:47:41+07:00",
                "instance" => [
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174787.868",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 7,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174787.869",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 8,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174787.867",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 6,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174787.873",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 12,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174787.872",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 11,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174787.866",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 5,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174787.870",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 9,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174787.864",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 3,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174787.865",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 4,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174787.871",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 10,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174787.862",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 1,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174787.863",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 2,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ]
                ]
              ],
              [
                "uid" => "1.2.840.113619.2.388.14436926.9266122.15378.1667174756.533",
                "number" => 10,
                "modality" => [
                  "system" => "http://dicom.nema.org/resources/ontology/DCM",
                  "code" => "MR"
                ],
                "description" => "Myelo 2D",
                "numberOfInstances" => 4,
                "started" => "2022-11-02T14:01:54+07:00",
                "instance" => [
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.446",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 3,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.447",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 4,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.445",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 2,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.444",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 1,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ]
                ]
              ],
              [
                "uid" => "1.2.840.113619.2.388.14436926.9266122.15378.1667174756.532",
                "number" => 9,
                "modality" => [
                  "system" => "http://dicom.nema.org/resources/ontology/DCM",
                  "code" => "MR"
                ],
                "description" => "Ax T1",
                "numberOfInstances" => 15,
                "started" => "2022-11-02T13:58:46+07:00",
                "instance" => [
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.297",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 1,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.308",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 8,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.309",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 10,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.301",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 9,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.300",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 7,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.302",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 11,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.303",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 13,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.298",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 3,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.307",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 6,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.306",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 4,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.299",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 5,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.310",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 12,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.304",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 15,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.305",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 2,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.388.14436926.9266122.13603.1667174788.311",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 14,
                    "title" => "ORIGINAL\\PRIMARY\\OTHER"
                  ]
                ]
              ],
              [
                "uid" => "1.2.840.113619.2.233.242211435144138.452.1667372646300.1",
                "number" => 400,
                "modality" => [
                  "system" => "http://dicom.nema.org/resources/ontology/DCM",
                  "code" => "MR"
                ],
                "description" => "Sag T2 Pasting",
                "numberOfInstances" => 15,
                "started" => "2022-11-02T14:04:06+07:00",
                "instance" => [
                  [
                    "uid" => "1.2.840.113619.2.233.242211435144138.452.1667372646363.2",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 1,
                    "title" => "DERIVED\\SECONDARY\\PASTED"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.233.242211435144138.452.1667372646383.7",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 6,
                    "title" => "DERIVED\\SECONDARY\\PASTED"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.233.242211435144138.452.1667372646381.6",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 5,
                    "title" => "DERIVED\\SECONDARY\\PASTED"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.233.242211435144138.452.1667372646379.5",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 4,
                    "title" => "DERIVED\\SECONDARY\\PASTED"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.233.242211435144138.452.1667372646393.12",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 11,
                    "title" => "DERIVED\\SECONDARY\\PASTED"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.233.242211435144138.452.1667372646371.3",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 2,
                    "title" => "DERIVED\\SECONDARY\\PASTED"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.233.242211435144138.452.1667372646377.4",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 3,
                    "title" => "DERIVED\\SECONDARY\\PASTED"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.233.242211435144138.452.1667372646391.11",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 10,
                    "title" => "DERIVED\\SECONDARY\\PASTED"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.233.242211435144138.452.1667372646395.13",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 12,
                    "title" => "DERIVED\\SECONDARY\\PASTED"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.233.242211435144138.452.1667372646397.14",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 13,
                    "title" => "DERIVED\\SECONDARY\\PASTED"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.233.242211435144138.452.1667372646401.16",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 15,
                    "title" => "DERIVED\\SECONDARY\\PASTED"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.233.242211435144138.452.1667372646389.10",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 9,
                    "title" => "DERIVED\\SECONDARY\\PASTED"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.233.242211435144138.452.1667372646399.15",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 14,
                    "title" => "DERIVED\\SECONDARY\\PASTED"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.233.242211435144138.452.1667372646385.8",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 7,
                    "title" => "DERIVED\\SECONDARY\\PASTED"
                  ],
                  [
                    "uid" => "1.2.840.113619.2.233.242211435144138.452.1667372646387.9",
                    "sopClass" => [
                      "system" => "urn:ietf:rfc:3986",
                      "code" => "urn:oid:1.2.840.10008.5.1.4.1.1.4"
                    ],
                    "number" => 8,
                    "title" => "DERIVED\\SECONDARY\\PASTED"
                  ]
                ]
              ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ImagingStudyHelper::token(),
        ])
        ->put(ImagingStudyHelper::url().'/ImagingStudy/' . $id, $data);

        return $response->json();
    }
}
