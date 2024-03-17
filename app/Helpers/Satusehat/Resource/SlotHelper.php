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

class SlotHelper
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
            "resourceType" => "Slot",
            "appointmentType" => [
               "coding" => [
                  [
                     "system" => "http://terminology.hl7.org/CodeSystem/v2-0276",
                     "code" => "ROUTINE",
                     "display" => "Routine appointment"
                  ]
               ]
            ],
            "schedule" => [
               "reference" => "Schedule/683a85cf-27fe-416d-a830-3d21d031e58a"
            ],
            "status" => "free",
            "start" => "2022-10-05T08:00:00+07:00",
            "end" => "2022-10-05T08:15:00+07:00",
            "comment" => "Slot untuk appointment pelayanan pada jam 8.00 WIB s/d 8.15 WIB"
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.SlotHelper::token(),
        ])
        ->post(SlotHelper::url().'/Slot', $data);

        return $response->json();
    }

    public static function searchId($id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.SlotHelper::token(),
        ])
        ->get(SlotHelper::url().'/Slot/' . $id);

        return $response->json();
    }

    public static function update($id){
        $encounter_id = 'dummy123';
        $data = [
            "resourceType" => "Slot",
            "id" => $id,
            "appointmentType" => [
                "coding" => [
                    [
                        "system" => "http://terminology.hl7.org/CodeSystem/v2-0276",
                        "code" => "ROUTINE",
                        "display" => "Routine appointment"
                    ]
                ]
            ],
            "schedule" => [
                "reference" => "Schedule/683a85cf-27fe-416d-a830-3d21d031e58a"
            ],
            "status" => "busy",
            "start" => "2022-10-05T08:00:00+07:00",
            "end" => "2022-10-05T08:15:00+07:00",
            "comment" => "Slot untuk appointment pelayanan pada jam 8.00 WIB s/d 8.15 WIB"
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.SlotHelper::token(),
        ])
        ->put(SlotHelper::url().'/Slot/' . $id, $data);

        return $response->json();
    }
}
