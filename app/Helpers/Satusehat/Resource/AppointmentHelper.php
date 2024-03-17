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

class AppointmentHelper
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
            "resourceType" => "Appointment",
            "identifier" => [
               [
                  "system" => "http://sys-ids.kemkes.go.id/cha-appointment",
                  "value" => "123"
               ]
            ],
            "status" => "proposed",
            "appointmentType" => [
               "coding" => [
                  [
                     "system" => "http://terminology.hl7.org/CodeSystem/v2-0276",
                     "code" => "ROUTINE",
                     "display" => "Routine appointment"
                  ]
               ]
            ],
            "basedOn" => [
               [
                  "reference" => "ServiceRequest/e668bf96-b330-44c8-a2ea-0f6bdf388bf1"
               ]
            ],
            "slot" => [
               [
                  "reference" => "Slot/6ced63df-93c3-4148-bbfd-af741b373993"
               ]
            ],
            "created" => "2022-09-24T08:00:00+07:00",
            "participant" => [
               [
                  "actor" => [
                     "reference" => "Patient/100000030009",
                     "display" => "Budi Santoso"
                  ],
                  "status" => "accepted"
               ],
               [
                  "actor" => [
                     "reference" => "HealthcareService/8cfb2d6f-dc20-4068-9113-805d426a6f17",
                     "display" => "Poliklinik Bedah Rawat Jalan Terpadu"
                  ],
                  "status" => "needs-action"
               ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.AppointmentHelper::token(),
        ])
        ->post(AppointmentHelper::url().'/Appointment', $data);

        return $response->json();
    }

    public static function searchActor($actor){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.AppointmentHelper::token(),
        ])
        ->get(AppointmentHelper::url().'/Appointment?actor=' . $actor);

        return $response->json();
    }

    public static function searchId($id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.AppointmentHelper::token(),
        ])
        ->get(AppointmentHelper::url().'/Appointment/' . $id);

        return $response->json();
    }

    public static function update($id){
        $encounter_id = 'dummy123';
        $data = [
            "resourceType" => "Appointment",
            "id" => $id,
            "identifier" => [
               [
                  "system" => "http://sys-ids.kemkes.go.id/cha-appointment",
                  "value" => "123"
               ]
            ],
            "status" => "proposed",
            "appointmentType" => [
               "coding" => [
                  [
                     "system" => "http://terminology.hl7.org/CodeSystem/v2-0276",
                     "code" => "ROUTINE",
                     "display" => "Routine appointment"
                  ]
               ]
            ],
            "basedOn" => [
               [
                  "reference" => "ServiceRequest/e668bf96-b330-44c8-a2ea-0f6bdf388bf1"
               ]
            ],
            "slot" => [
               [
                  "reference" => "Slot/6ced63df-93c3-4148-bbfd-af741b373993"
               ]
            ],
            "created" => "2022-09-24T08:00:00+07:00",
            "participant" => [
               [
                  "actor" => [
                     "reference" => "Patient/100000030009",
                     "display" => "Budi Santoso"
                  ],
                  "status" => "declined"
               ],
               [
                  "actor" => [
                     "reference" => "HealthcareService/8cfb2d6f-dc20-4068-9113-805d426a6f17",
                     "display" => "Poliklinik Bedah Rawat Jalan Terpadu"
                  ],
                  "status" => "needs-action"
               ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.AppointmentHelper::token(),
        ])
        ->put(AppointmentHelper::url().'/Appointment/' . $id, $data);

        return $response->json();
    }
}
