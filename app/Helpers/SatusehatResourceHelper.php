<?php

namespace App\Helpers;

use App\Models\Rawat;
use App\Models\Dokter;
use App\Models\Obat\Obat;
use LZCompressor\LZString;
use App\Helpers\VclaimHelper;
use App\Models\Pasien\Pasien;
use Illuminate\Support\Facades\DB;
use App\Helpers\SatusehatAuthHelper;
use Illuminate\Support\Facades\Http;

class SatusehatResourceHelper
{

    public static function ssl(){
        if (config('app.env') == 'production') {
            return true;
        } else {
            return false;        }

    }
    #Practitioner
    #NIK
    public static function practitioner_nik($nik){
        $get_token = SatusehatAuthHelper::generate_token();
        $token = $get_token['access_token'];
        $url = env('PROD_BASE_URL_SS');
        // return $url;
        $dokter = Dokter::where('nik',$nik)->first();
        $response = Http::withOptions(["verify" => SatusehatAuthHelper::ssl()])
        ->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])
        ->get($url.'/Practitioner?identifier=https://fhir.kemkes.go.id/id/nik|'.$nik);
        // if($dokter)
        if($response['total'] > 0){
            if($dokter){
                $dokter->kode_ihs = $response['entry'][0]['resource']['id'];
                $dokter->save();
            }
        }
        return $response->json();
    }

    #Search Name, Gender, Birthdate
    public static function practitioner_search($name, $gender, $birthdate){
        $get_token = SatusehatAuthHelper::generate_token();
        $token = $get_token['access_token'];
        $url = env('PROD_BASE_URL_SS');
        // return $url;
        $response = Http::withOptions(["verify" => SatusehatAuthHelper::ssl()])
        ->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])
        ->get($url.'/Practitioner?name='.$name.'&gender='.$gender.'&birthdate='.$birthdate);

        return $response->json();
    }

    #Practitioner - By ID
    public static function practitioner_id($id){
        $get_token = SatusehatAuthHelper::generate_token();
        $token = $get_token['access_token'];
        $url = env('PROD_BASE_URL_SS');
        // return $url;
        $response = Http::withOptions(["verify" => SatusehatAuthHelper::ssl()])
        ->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])
        ->get($url.'/Practitioner/'.$id);

        return $response->json();
    }

    #Organization
    #create
    public static function organization_create(){
        $organisasi = DB::table('organisasi_satusehat')->whereNull('id_satu_sehat')->get();
        // return $organisasi;
        $data_id = [];
        foreach ($organisasi as $o) {
            $data = [
                "resourceType" => "Organization",
                "active" => true,
                "identifier" => [
                    [
                        "use" => "official",
                        "system" => "http://sys-ids.kemkes.go.id/organization/100026489",
                        "value" => $o->nama_organisasi
                    ]
                ],
                "type" => [
                    [
                        "coding" => [
                            [
                                "system" => "http://terminology.hl7.org/CodeSystem/organization-type",
                                "code" => "dept",
                                "display" => "Hospital Department"
                            ]
                        ]
                    ]
                ],
                "name" =>  $o->nama_organisasi,
                "telecom" => [
                    [
                        "system" => "phone",
                        "value" => "+622717791112",
                        "use" => "work"
                    ],
                    [
                        "system" => "email",
                        "value" => "komitemedikrsaudrsiswanto@gmail.com",
                        "use" => "work"
                    ],
                    [
                        "system" => "url",
                        "value" => "www.komitemedikrsaudrsiswanto@gmail.com",
                        "use" => "work"
                    ]
                ],
                "address" => [
                    [
                        "use" => "work",
                        "type" => "both",
                        "line" => [
                            "Jl. Tentara Pelajar"
                        ],
                        "city" => "Kabupaten Karanganyar",
                        "postalCode" => "57178",
                        "country" => "ID",
                        "extension" => [
                            [
                                "url" => "https://fhir.kemkes.go.id/r4/StructureDefinition/administrativeCode",
                                "extension" => [
                                    [
                                        "url" => "province",
                                        "valueCode" => "33"
                                    ],
                                    [
                                        "url" => "city",
                                        "valueCode" => "3372"
                                    ],
                                    [
                                        "url" => "district",
                                        "valueCode" => "331312"
                                    ],
                                    [
                                        "url" => "village",
                                        "valueCode" => "3313122002"
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                "partOf" => [
                    "reference" => "Organization/100026489"
                ]
            ];
            // return $data;
            $get_token = SatusehatAuthHelper::generate_token();
            $token = $get_token['access_token'];
            $url = env('PROD_BASE_URL_SS');
            // return $url;
            $response = Http::withOptions(["verify" => SatusehatAuthHelper::ssl()])
            ->withHeaders([
                'Authorization' => 'Bearer '.$token,
            ])
            ->post($url.'/Organization', $data);
            DB::table('organisasi_satusehat')->where('id',$o->id)->update([
                'id_satu_sehat'=>$response->json()['id']
            ]);

            $data_id[] = $response->json()['id'];
        }
        
        return $data_id;

    }

    #Organization - By ID
    public static function organization_id($id){
        $get_token = SatusehatAuthHelper::generate_token();
        $token = $get_token['access_token'];
        $url = env('PROD_BASE_URL_SS');
        // return $url;
        $response = Http::withOptions(["verify" => SatusehatAuthHelper::ssl()])
        ->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])
        ->get($url.'/Organization/'.$id);

        return $response->json();
    }

    #Organization - Search by PartOf
    public static function organization_search_partof($partof){
        $get_token = SatusehatAuthHelper::generate_token();
        $token = $get_token['access_token'];
        $url = env('PROD_BASE_URL_SS');
        // return $url;
        $response = Http::withOptions(["verify" => SatusehatAuthHelper::ssl()])
        ->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])
        ->get($url.'/Organization?partof='.$partof);

        return $response->json();
    }

    #Consent - Read Consent Service

    public static function consent_read($id){
        $get_token = SatusehatAuthHelper::generate_token();
        $token = $get_token['access_token'];
        $url = env('PROD_CONSENT_URL_SS');
        // return $url;
        $response = Http::withOptions(["verify" => SatusehatAuthHelper::ssl()])
            ->withHeaders([
                'Authorization' => 'Bearer '.$token,
            ])->get($url.'/Consent?patient_id='.$id);
        return $response->json();
    }

    #Consent Update
    public static function consent_update($id){
        $data = [
            "patient_id"=> $id,
            "action"=> "OPTIN",
            "agent"=> "Fikri Ramadhan"
        ];
        // return $data;
        $url = env('PROD_CONSENT_URL_SS');
        // return $url;
        $get_token = SatusehatAuthHelper::generate_token();
        $token = $get_token['access_token'];
        $response = Http::withOptions(["verify" => SatusehatAuthHelper::ssl()])
            ->withHeaders([
                'Authorization' => 'Bearer '.$token,
            ])->post($url.'/Consent',$data);
        return $response->json();
    }
}
