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

class SatusehatPasienHelper
{
    #Pasien
    #search by nik
    public static function ssl(){
        if (config('app.env') == 'production') {
            return true;
        } else {
            return false;        }

    }
    public static function searchPasienByNik($nik){
        $pasien = Pasien::where('nik',$nik)->first();
        $get_token = SatusehatAuthHelper::generate_token();
        $token = $get_token['access_token'];
        $url = env('PROD_BASE_URL_SS');
        $response = Http::withOptions(["verify" => SatusehatAuthHelper::ssl()])
        ->withHeaders([
            'Authorization' => 'Bearer '.$token,
        ])
        ->get($url.'/Patient?identifier=https://fhir.kemkes.go.id/id/nik|'.$nik);
        if($response['total'] > 0){
            
            // $consent = SatusehatResourceHelper::consent_update($pasien->ihs);
            // return $consent;
            if($pasien){
                $pasien->ihs = $response['entry'][0]['resource']['id'];
                $pasien->save();
            }
        }
       
        return $response->json();
    }
    #Patient - Search Name, Gender, Birthdate
    public static function searchPasien($name, $gender, $birthdate){
        $get_token = SatusehatAuthHelper::generate_token();
        $token = $get_token['access_token'];
        $url = env('PROD_BASE_URL_SS');
        $response = Http::withOptions(["verify" => SatusehatAuthHelper::ssl()])
        ->withHeaders([
            "Authorization" => "Bearer ".$token,
        ])
        ->get($url.'/Patient?name='.$name.'&birthdate='.$birthdate.'&gender='.$gender);
        return $response->json();
    }

    #Patient - By ID
    public static function pasien_id($id){
        $get_token = SatusehatAuthHelper::generate_token();
        $token = $get_token['access_token'];
        $url = env('PROD_BASE_URL_SS');
        $response = Http::withOptions(["verify" => SatusehatAuthHelper::ssl()])
        ->withHeaders([
            "Authorization" => "Bearer ".$token,
        ])
        ->get($url.'/Patient/'.$id);
        return $response->json();
    }

    public static function add_pasien($id){
        $get_token = SatusehatAuthHelper::generate_token();
        $token = $get_token['access_token'];
        $url = env('PROD_BASE_URL_SS');
        $pasien = Pasien::where('no_rm',$id)->first();
        $pasien_alamat = DB::table('pasien_alamat')->where('idpasien',$pasien->id)->first();
        if(!$pasien){
            return 'Data tidak ada';
        }else{
            if($pasien->jenis_kelamin == 'L'){
                $jenis_kelamin = 'male';
            }else{
                $jenis_kelamin = 'famale';
            }
            switch ($pasien->idhubungn) {
                case 1:
                    $hubungan = 'Married';
                    $kode_hub = "M";
                    break;
                case 2:
                    $hubungan = 'unmarried';
                    $kode_hub = "U";
                    break;
                case 3:
                    $hubungan = 'Divorced';
                    $kode_hub = "D";
                    break;
                case 4:
                    $hubungan = 'Widowed';
                    $kode_hub = "W";
                    break;
                default:
                    $hubungan = 'Never Married';
                    $kode_hub = "S";
                    break;
            }
            $data =  [
                'resourceType' => 'Patient',
                'meta' => [
                    'profile' => [
                        'https://fhir.kemkes.go.id/r4/StructureDefinition/Patient'
                    ]
                ],
                'identifier' => [
                    [
                        'use' => 'official',
                        'system' => 'https://fhir.kemkes.go.id/id/nik',
                        'value' => $pasien?->nik
                    ],
                    // [
                    //     'use' => 'official',
                    //     'system' => 'https://fhir.kemkes.go.id/id/paspor',
                    //     'value' => '-'
                    // ],
                    [
                        'use' => 'official',
                        'system' => 'https://fhir.kemkes.go.id/id/kk',
                        'value' => '-'
                    ]
                ],
                'active' => true,
                'name' => [
                    [
                        'use' => 'official',
                        'text' => $pasien->nama_pasien
                    ]
                ],
                'telecom' => [
                    [
                        'system' => 'phone',
                        'value' => $pasien->nohp,
                        'use' => 'mobile'
                    ],
                    [
                        'system' => 'phone',
                        'value' => '-',
                        'use' => 'home'
                    ],
                    [
                        'system' => 'email',
                        'value' => $pasien->email,
                        'use' => 'home'
                    ]
                ],
                'gender' => $jenis_kelamin,
                'birthDate' => $pasien->tgllahir,
                'deceasedBoolean' => true,
                'address' => [
                    [
                        'use' => 'home',
                        'line' => [
                            $pasien_alamat?->alamat
                        ],
                        'city' => VclaimHelper::getKota($pasien_alamat?->idkab),
                        'postalCode' => '12950',
                        'country' => 'ID',
                        'extension' => [
                            [
                                'url' => 'https://fhir.kemkes.go.id/r4/StructureDefinition/administrativeCode',
                                'extension' => [
                                    [
                                        'url' => 'province',
                                        'valueCode' => $pasien_alamat?->idprov
                                    ],
                                    [
                                        'url' => 'city',
                                        'valueCode' => $pasien_alamat?->idkab
                                    ],
                                    [
                                        'url' => 'district',
                                        'valueCode' => $pasien_alamat?->idkec
                                    ],
                                    [
                                        'url' => 'village',
                                        'valueCode' => $pasien_alamat?->idkel
                                    ],
                                    [
                                        'url' => 'rt',
                                        'valueCode' => '-'
                                    ],
                                    [
                                        'url' => 'rw',
                                        'valueCode' => '-'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                'maritalStatus' => [
                    'coding' => [
                        [
                            'system' => 'http://terminology.hl7.org/CodeSystem/v3-MaritalStatus',
                            'code' => $kode_hub,
                            'display' => $hubungan
                        ]
                    ],
                    'text' => $hubungan
                ],
                // 'multipleBirthBoolean' => false,
                'multipleBirthInteger' => false,
                'contact' => [
                    [
                        'relationship' => [
                            [
                                'coding' => [
                                    [
                                        'system' => 'http://terminology.hl7.org/CodeSystem/v2-0131',
                                        'code' => 'CP'
                                    ]
                                ]
                            ]
                        ],
                        'name' => [
                            'use' => 'official',
                            'text' => $pasien->penanggung_jawab
                        ],
                        'telecom' => [
                            [
                                'system' => 'phone',
                                'value' => $pasien->nohp_penanggungjawab,
                                'use' => 'mobile'
                            ]
                        ]
                    ]
                ],
                'communication' => [
                    [
                        'language' => [
                            'coding' => [
                                [
                                    'system' => 'urn:ietf:bcp:47',
                                    'code' => 'id-ID',
                                    'display' => 'Indonesian'
                                ]
                            ],
                            'text' => 'Indonesian'
                        ],
                        'preferred' => true
                    ]
                ],
                'extension' => [
                    [
                        'url' => 'https://fhir.kemkes.go.id/r4/StructureDefinition/birthPlace',
                        'valueAddress' => [
                            'city' => $pasien->tempat_lahir,
                            'country' => 'ID'
                        ]
                    ],
                    [
                        'url' => 'https://fhir.kemkes.go.id/r4/StructureDefinition/citizenshipStatus',
                        'valueCode' => 'WNI'
                    ]
                ]
            ];
            // return $data;

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                "Authorization" => "Bearer ".$token,
                // Add any additional headers if needed
            ])->withOptions(["verify" => SatusehatAuthHelper::ssl()])->post($url.'/Patient', $data);
            return $response->json();
        }
    }

}
