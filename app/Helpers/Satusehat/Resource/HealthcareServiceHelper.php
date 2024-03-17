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

class HealthcareServiceHelper
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
            "resourceType" => "HealthcareService",
            "identifier" => [
               [
                  "system" => "http://sys-ids.kemkes.go.id/healthcareservice/" . HealthcareServiceHelper::orgId(),
                  "value" => "HS-19920029"
               ]
            ],
            "active" => true,
            "providedBy" => [
               "reference" => "Organization/" . HealthcareServiceHelper::orgId()
            ],
            "type" => [
               [
                  "coding" => [
                     [
                        "system" => "http://sys-ids.kemkes.go.id/bpjs-poli",
                        "code" => "JAN",
                        "display" => "Poli Jantung"
                     ]
                  ]
               ],
               [
                  "coding" => [
                     [
                        "system" => "http://terminology.hl7.org/CodeSystem/service-type",
                        "code" => "305",
                        "display" => "Counselling"
                     ]
                  ]
               ],
               [
                  "coding" => [
                     [
                        "system" => "http://terminology.hl7.org/CodeSystem/service-type",
                        "code" => "221",
                        "display" => "Surgery - General"
                     ]
                  ]
               ]
            ],
            "specialty" => [
               [
                  "coding" => [
                     [
                        "system" => "http://terminology.kemkes.go.id/CodeSystem/clinical-speciality",
                        "code" => "S001.09",
                        "display" => "Penyakit dalam kardiovaskular "
                     ]
                  ]
               ]
            ],
            "location" => [
               [
                 "reference" => "Location/b017aa54-f1df-4ec2-9d84-8823815d7228",
                 "display" => "Ruang 1A, Poliklinik Bedah Rawat Jalan Terpadu, Lantai 2, Gedung G"
               ]
            ],
            "name" => "Poliklinik Bedah Rawat Jalan Terpadu",
            "program" => [
               [
                  "coding" => [
                     [
                        "system" => "http://terminology.kemkes.go.id/CodeSystem/program",
                        "code" => "1000200",
                        "display" => "Program JKN"
                     ]
                  ]
               ]
            ]
        ];
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.HealthcareServiceHelper::token(),
        ])
        ->post(HealthcareServiceHelper::url().'/HealthcareService', $data);

        return $response->json();
    }

    public static function searchId($id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.HealthcareServiceHelper::token(),
        ])
        ->get(HealthcareServiceHelper::url().'/HealthcareService/' . $id);

        return $response->json();
    }

    public static function searchEncounter($specialty){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.HealthcareServiceHelper::token(),
        ])
        ->get(HealthcareServiceHelper::url().'/HealthcareService?specialty=' . $specialty);

        return $response->json();
    }

    public static function update($id){
        $encounter_id = 'dummy123';
        $data = [
            "resourceType" => "HealthcareService",
            "id" => $id,
            "identifier" => [
               [
                  "system" => "http://sys-ids.kemkes.go.id/healthcareservice/" . HealthcareServiceHelper::orgId(),
                  "value" => "HS-19920029_123"
               ]
            ],
            "active" => true,
            "providedBy" => [
               "reference" => "Organization/" . HealthcareServiceHelper::orgId()
            ],
            "type" => [
               [
                  "coding" => [
                     [
                        "system" => "http://sys-ids.kemkes.go.id/bpjs-poli",
                        "code" => "JAN",
                        "display" => "Poli Jantung"
                     ]
                  ]
               ],
               [
                  "coding" => [
                     [
                        "system" => "http://terminology.hl7.org/CodeSystem/service-type",
                        "code" => "305",
                        "display" => "Counselling"
                     ]
                  ]
               ],
               [
                  "coding" => [
                     [
                        "system" => "http://terminology.hl7.org/CodeSystem/service-type",
                        "code" => "221",
                        "display" => "Surgery - General"
                     ]
                  ]
               ]
            ],
            "specialty" => [
               [
                  "coding" => [
                     [
                        "system" => "http://terminology.kemkes.go.id/CodeSystem/clinical-speciality",
                        "code" => "S001.09",
                        "display" => "Penyakit dalam kardiovaskular "
                     ]
                  ]
               ]
            ],
            "location" => [
               [
                 "reference" => "Location/b017aa54-f1df-4ec2-9d84-8823815d7228",
                 "display" => "Ruang 1A, Poliklinik Bedah Rawat Jalan Terpadu, Lantai 2, Gedung G"
               ]
            ],
            "name" => "Poliklinik Bedah Rawat Jalan Terpadu",
            "program" => [
               [
                  "coding" => [
                     [
                        "system" => "http://terminology.kemkes.go.id/CodeSystem/program",
                        "code" => "1000200",
                        "display" => "Program JKN"
                     ]
                  ]
               ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.HealthcareServiceHelper::token(),
        ])
        ->put(HealthcareServiceHelper::url().'/HealthcareService/' . $id, $data);

        return $response->json();
    }
}
