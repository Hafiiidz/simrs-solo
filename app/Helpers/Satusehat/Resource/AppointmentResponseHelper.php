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

class AppointmentResponseHelper
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
            "resourceType" => "AppointmentResponse",
            "appointment" => [
              "reference" => "Appointment/0e0f2ff3-cf5c-48d8-9db2-b0f710fe514a"
            ],
            "actor" => [
              "reference" => "HealthcareService/8cfb2d6f-dc20-4068-9113-805d426a6f17",
              "display" => "Poliklinik Bedah Rawat Jalan Terpadu"
            ],
            "participantStatus" => "accepted",
            "comment" => "A-12"
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.AppointmentResponseHelper::token(),
        ])
        ->post(AppointmentResponseHelper::url().'/AppointmentResponse', $data);

        return $response->json();
    }

    public static function searchId($id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.AppointmentResponseHelper::token(),
        ])
        ->get(AppointmentResponseHelper::url().'/AppointmentResponse/' . $id);

        return $response->json();
    }

    public static function searchSubject($appointment){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.AppointmentResponseHelper::token(),
        ])
        ->get(AppointmentResponseHelper::url().'/AppointmentResponse?appointment=' . $appointment);

        return $response->json();
    }

    public static function update($id){
        $encounter_id = 'dummy123';
        $data = [
            "resourceType" => "AppointmentResponse",
            "id" => $id,
            "appointment" => [
              "reference" => "Appointment/0e0f2ff3-cf5c-48d8-9db2-b0f710fe514a"
            ],
            "actor" => [
              "reference" => "HealthcareService/8cfb2d6f-dc20-4068-9113-805d426a6f17",
              "display" => "Poliklinik Bedah Rawat Jalan Terpadu"
            ],
            "participantStatus" => "declined",
            "comment" => "A-14"
        ];
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.AppointmentResponseHelper::token(),
        ])
        ->put(AppointmentResponseHelper::url().'/AppointmentResponse/' . $id, $data);

        return $response->json();
    }
}
