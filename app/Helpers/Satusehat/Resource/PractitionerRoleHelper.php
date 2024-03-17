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

class PractitionerRoleHelper
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
            "resourceType" => "PractitionerRole",
            "active" => true,
            "practitioner" => [
                "reference" => "Practitioner/N10000001",
                "display" => "Dokter Bronsig"
            ],
            "organization" => [
                "reference" => "Organization/". PractitionerRoleHelper::orgId()
            ],
            "code" => [
                [
                    "coding" => [
                        [
                            "system" => "http://terminology.hl7.org/CodeSystem/practitioner-role",
                            "code" => "doctor",
                            "display" => "Doctor"
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
            "healthcareService" => [
                [
                    "reference" => "HealthcareService/8cfb2d6f-dc20-4068-9113-805d426a6f17"
                ]
            ],
            "telecom" => [
                [
                    "system" => "phone",
                    "value" => "(021) 14045",
                    "use" => "work"
                ],
                [
                    "system" => "email",
                    "value" => "doctor.bronsig@dto.kemkes.go.id",
                    "use" => "work"
                ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.PractitionerRoleHelper::token(),
        ])
        ->post(PractitionerRoleHelper::url().'/PractitionerRole', $data);

        return $response->json();
    }

    public static function searchId($id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.PractitionerRoleHelper::token(),
        ])
        ->get(PractitionerRoleHelper::url().'/PractitionerRole/' . $id);

        return $response->json();
    }

    public static function searchPractitioner($practitioner){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.PractitionerRoleHelper::token(),
        ])
        ->get(PractitionerRoleHelper::url().'/PractitionerRoleHelper?practitioner=' . $practitioner);

        return $response->json();
    }

    public static function searchPractitionerOrganization($practitioner){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.PractitionerRoleHelper::token(),
        ])
        ->get(PractitionerRoleHelper::url().'/PractitionerRoleHelper?practitioner=' . $practitioner . '&organization=' . PractitionerRoleHelper::orgId());

        return $response->json();
    }

    public static function update($id){
        $encounter_id = 'dummy123';
        $data = [
            "resourceType" => "PractitionerRole",
            "id" => $id,
            "active" => true,
            "practitioner" => [
                "reference" => "Practitioner/N10000001",
                "display" => "Dokter Bronsig"
            ],
            "organization" => [
                "reference" => "Organization/" . PractitionerRoleHelper::orgId()
            ],
            "code" => [
                [
                    "coding" => [
                        [
                            "system" => "http://terminology.hl7.org/CodeSystem/practitioner-role",
                            "code" => "doctor",
                            "display" => "Doctor"
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
            "healthcareService" => [
                [
                    "reference" => "HealthcareService/8cfb2d6f-dc20-4068-9113-805d426a6f17"
                ]
            ],
            "telecom" => [
                [
                    "system" => "phone",
                    "value" => "(021) 14045 I'm Lovin It",
                    "use" => "work"
                ],
                [
                    "system" => "email",
                    "value" => "doctor.bronsig@dto.kemkes.go.id",
                    "use" => "work"
                ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.PractitionerRoleHelper::token(),
        ])
        ->put(PractitionerRoleHelper::url().'/PractitionerRoleHelper/' . $id, $data);

        return $response->json();
    }

}
