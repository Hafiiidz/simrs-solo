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

class LocationHelper
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

    public static function ssl(){
        if (config('app.env') == 'production') {
            return true;
        } else {
            return false;        }

    }

    public static function create(){
        $organisasi = DB::table('organisasi_satusehat')->whereNull('id_location')->get();
        $data_id = [];
        foreach ($organisasi as $o) {
            $data = [
                "resourceType"=> "Location",
                "status"=> "active",
                "name"=> $o->nama_organisasi,
                "description"=>  $o->nama_organisasi,
                "mode"=> "instance",
                "telecom"=> [
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
                    ],
                    [
                        "system"=> "fax",
                        "value"=> "622717791112",
                        "use"=> "work"
                    ]
                ],
                "address"=> [
                    "use"=> "work",
                    "line"=> [
                        "Jl. Tentara Pelajar"
                    ],
                    "city"=> "Kabupaten Karanganyar",
                    "postalCode"=> "57178",
                    "country"=> "ID",
                    "extension"=> [
                        [
                            "url"=> "https=>//fhir.kemkes.go.id/r4/StructureDefinition/administrativeCode",
                            "extension"=> [
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
                                ],
                                [
                                    "url"=> "rt",
                                    "valueCode"=> "1"
                                ],
                                [
                                    "url"=> "rw",
                                    "valueCode"=> "2"
                                ]
                            ]
                        ]
                    ]
                ],
                "physicalType"=> [
                    "coding"=> [
                        [
                            "system"=> "http://terminology.hl7.org/CodeSystem/location-physical-type",
                            "code"=> "ro",
                            "display"=> "Room"
                        ]
                    ]
                ],
                "position"=> [
                    "longitude"=> -6.23115426275766,
                    "latitude"=> 106.83239885393944,
                    "altitude"=> 0
                ],
                "managingOrganization"=> [
                    "reference"=> "Organization/" . LocationHelper::orgId()
                ]
            ];
    
            $response = Http::withOptions(["verify" => SatusehatAuthHelper::ssl()])
            ->withHeaders([
                'Authorization' => 'Bearer '.LocationHelper::token(),
            ])
            ->post(LocationHelper::url().'/Location', $data);

            DB::table('organisasi_satusehat')->where('id',$o->id)->update([
                'id_location'=>$response->json()['id']
            ]);

            $data_id[] = $response->json()['id'];
        }      

        return $data_id;
    }

    public static function searchOrgId($id){

        $response = Http::withOptions(["verify" => SatusehatAuthHelper::ssl()])
        ->withHeaders([
            'Authorization' => 'Bearer '.LocationHelper::token(),
        ])
        ->get(LocationHelper::url().'/Location?organization=' . $id);

        return $response->json();
    }

    public static function searchId($id){
        $response = Http::withOptions(["verify" => SatusehatAuthHelper::ssl()])
        ->withHeaders([
            'Authorization' => 'Bearer '.LocationHelper::token(),
        ])
        ->get(LocationHelper::url().'/Location/' . $id);

        return $response->json();
    }

    public static function update($id){
        $organisasi = DB::table('organisasi_satusehat')->where('id_location',$id)->first();
        $data = [
            "resourceType"=> "Location",
            "id"=> $id,
            "identifier"=> [
                [
                    "system"=> "http://sys-ids.kemkes.go.id/location/". LocationHelper::orgId(),
                    "value"=> $organisasi->nama_organisasi,
                ]
            ],
            "status"=> "active",
            "name"=> $organisasi->nama_organisasi,
            "description"=> $organisasi->nama_organisasi,
            "mode"=> "instance",
            "telecom"=> [
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
                ],
                [
                    "system"=> "fax",
                    "value"=> "622717791112",
                    "use"=> "work"
                ]
            ],
            "address"=> [
                "use"=> "work",
                "line"=> [
                    "Jl. Tentara Pelajar"
                ],
                "city"=> "Kabupaten Karanganyar",
                "postalCode"=> "57178",
                "country"=> "ID",
                "extension"=> [
                    [
                        "url"=> "https=>//fhir.kemkes.go.id/r4/StructureDefinition/administrativeCode",
                        "extension"=> [
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
                            ],
                            [
                                "url"=> "rt",
                                "valueCode"=> "1"
                            ],
                            [
                                "url"=> "rw",
                                "valueCode"=> "2"
                            ]
                        ]
                    ]
                ]
            ],
            "physicalType"=> [
                "coding"=> [
                    [
                        "system"=> "http://terminology.hl7.org/CodeSystem/location-physical-type",
                        "code"=> $organisasi->type,
                        "display"=> "Room"
                    ]
                ]
            ],
            "position"=> [
                "longitude"=> (float) $organisasi->longitude,
                "latitude"=> (float)  $organisasi->latitude,
                "altitude"=> 0
            ],
            "managingOrganization"=> [
                "reference"=> "Organization/" . LocationHelper::orgId()
            ]
        ];
        // return $data;
        $response = Http::withOptions(["verify" => SatusehatAuthHelper::ssl()])
        ->withHeaders([
            'Authorization' => 'Bearer '.LocationHelper::token(),
        ])
        ->put(LocationHelper::url().'/Location/' . $id, $data);

        return $response->json();
    }
}
