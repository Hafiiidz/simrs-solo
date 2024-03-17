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

class CarePlanHelper
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
            "resourceType" => "CarePlan",
            "status" => "active",
            "intent" => "plan",
            "description" => "Rujuk ke RS Rujukan Tumbuh Kembang level 1",
            "subject" => [
                "reference" => "Patient/100000030004",
                "display" => "Anak Smith"
            ],
            "encounter" => [
                "reference" => "Encounter/" . $encounter_id
            ],
            "created" => "2022-07-26",
            "author" => [
                "reference" => "Practitioner/N10000001"
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.CarePlanHelper::token(),
        ])
        ->post(CarePlanHelper::url().'/CarePlan', $data);

        return $response->json();
    }

    public static function searchId($id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.CarePlanHelper::token(),
        ])
        ->get(CarePlanHelper::url().'/CarePlan/' . $id);

        return $response->json();
    }

    public static function searchSubject($subject){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.CarePlanHelper::token(),
        ])
        ->get(CarePlanHelper::url().'/CarePlan?subject=' . $subject);

        return $response->json();
    }

    public static function update($id){
        $encounter_id = 'dummy123';
        $data = [
            "resourceType" => "CarePlan",
            "id" => $id,
            "status" => "active",
            "intent" => "plan",
            "description" => "Rujuk ke RS Rujukan Tumbuh Kembang ABCDEFG level 1",
            "subject" => [
                "reference" => "Patient/100000030004",
                "display" => "Anak Smith"
            ],
            "encounter" => [
                "reference" => "Encounter/" . $encounter_id
            ],
            "created" => "2022-07-26",
            "author" => [
                "reference" => "Practitioner/N10000001"
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.CarePlanHelper::token(),
        ])
        ->put(CarePlanHelper::url().'/CarePlan/' . $id, $data);

        return $response->json();
    }
}
