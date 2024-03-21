<?php

namespace App\Helpers\Satusehat\Resource;

use App\Models\Rawat;
use App\Models\Dokter;
use App\Models\Obat\Obat;
use LZCompressor\LZString;
use App\Helpers\VclaimHelper;
use App\Models\Pasien\Pasien;
use Illuminate\Support\Facades\DB;
use App\Helpers\SatusehatAuthHelper;
use Illuminate\Support\Facades\Http;
use App\Helpers\SatusehatPasienHelper;
use App\Helpers\Satusehat\Resource\EncounterHelper;

class EncounterHelper
{
    public static function token(){
        $get_token = SatusehatAuthHelper::generate_token();
        return $get_token['access_token'];
    }

    public static function url(){
        return env('PROD_BASE_URL_SS');
    }
    public static function ssl(){
        if (config('app.env') == 'production') {
            return true;
        } else {
            return false;        }

    }
    public static function orgId(){
        return 100026488;
    }

    public static function create($idrawat){
        $rawat = Rawat::find($idrawat);
        $pasien = Pasien::where('no_rm',$rawat->no_rm)->first();
        // return $pasien;
        // SatusehatPasienHelper::searchPasienByNik($pasien->nik);
        // return $rawat;
        #get_lokasi rawat
        if($rawat->idjenisrawat == 2){
            $organisasi_lokasi = DB::table('organisasi_satusehat')->where('id_ruangan', $rawat->ruangan?->unit_ruangan)->first();
        }else{
            $organisasi_lokasi = DB::table('organisasi_satusehat')->where('id_ruangan', $rawat->poli->kode)->first();
        }

        // return $organisasi_lokasi;

        $data = [
            "resourceType"=> "Encounter",
            "identifier"=> [
                [
                    "system"=> "http://sys-ids.kemkes.go.id/encounter/100026488",
                    "value"=> $rawat->idrawat
                ]
            ],
            "status"=> "arrived",
            "class"=> [
                "system"=> "http://terminology.hl7.org/CodeSystem/v3-ActCode",
                "code"=> "AMB",
                "display"=> "ambulatory"
            ],
            "subject"=> [
                "reference"=> "Patient/".$pasien?->ihs,
                "display"=> $pasien?->nama_pasien
            ],
            "participant"=> [
                [
                    "type"=> [
                        [
                            "coding"=> [
                                [
                                    "system"=> "http://terminology.hl7.org/CodeSystem/v3-ParticipationType",
                                    "code"=> "ATND",
                                    "display"=> "attender"
                                ]
                            ]
                        ]
                    ],
                    "individual"=> [
                        "reference"=> "Practitioner/".$rawat->dokter?->kode_ihs,
                        "display"=> $rawat->dokter?->nama_dokter
                    ]
                ]
            ],
            "period"=> [
                "start"=> date('Y-m-d')."T".date('H:i:s')."+07:00"
            ],
            "location"=> [
                [
                    "location"=> [
                        "reference"=> "Location/".$organisasi_lokasi->id_location,
                        "display"=> $organisasi_lokasi->nama_organisasi
                    ]
                ]
            ],
            "statusHistory"=> [
                [
                    "status"=> "arrived",
                    "period"=> [
                        "start"=> date('Y-m-d')."T".date('H:i:s')."+07:00"
                    ]
                ]
            ],
            "serviceProvider"=> [
                "reference"=> "Organization/100026488"
            ],

        ];

        $response = Http::withOptions(["verify" => SatusehatAuthHelper::ssl()])
        ->withHeaders([
            'Authorization' => 'Bearer '.EncounterHelper::token(),
        ])
        ->post(EncounterHelper::url().'/Encounter', $data);
        $rawat->id_encounter = $response->json()['id'];
        $rawat->save();
        return $response->json();
    }

    #search by id
    public static function searchId($id){
        $response = Http::withOptions(["verify" => SatusehatAuthHelper::ssl()])
        ->withHeaders(['Authorization'=> 'Bearer '.EncounterHelper::token()])
        ->get(EncounterHelper::url().'/Encounter/'.$id);
        return $response->json();
    }

    #search by subject
    public static function searchSubject($id){
        $rawat = Rawat::where('id',$id)->first();
        $pasien = Pasien::where('no_rm',$rawat->no_rm)->first();
        $response = Http::withOptions(["verify" => SatusehatAuthHelper::ssl()])
        ->withHeaders(['Authorization'=> 'Bearer '.EncounterHelper::token()])
        ->get(EncounterHelper::url().'/Encounter?subject='.$pasien->ihs);
        return $response->json();
    }

    #update progress
    public static function updateInProgress($id){
        $rawat = Rawat::where('id_encounter',$id)->first();
        $pasien = Pasien::where('no_rm',$rawat->no_rm)->first();
        if($rawat->idjenisrawat == 2){
            $organisasi_lokasi = DB::table('organisasi_satusehat')->where('id_ruangan', $rawat->ruangan?->unit_ruangan)->first();
        }else{
            $organisasi_lokasi = DB::table('organisasi_satusehat')->where('id_ruangan', $rawat->poli->kode)->first();
        }
        $data = [
            'resourceType' => 'Encounter',
            'id' => $id,
            "identifier"=> [
                [
                    "system"=> "http://sys-ids.kemkes.go.id/encounter/100026488",
                    "value"=> $rawat->idrawat
                ]
            ],
            "status"=> "arrived",
            "class"=> [
                "system"=> "http://terminology.hl7.org/CodeSystem/v3-ActCode",
                "code"=> "AMB",
                "display"=> "ambulatory"
            ],
            "subject"=> [
                "reference"=> "Patient/".$pasien?->ihs,
                "display"=> $pasien?->nama_pasien
            ],
            "participant"=> [
                [
                    "type"=> [
                        [
                            "coding"=> [
                                [
                                    "system"=> "http://terminology.hl7.org/CodeSystem/v3-ParticipationType",
                                    "code"=> "ATND",
                                    "display"=> "attender"
                                ]
                            ]
                        ]
                    ],
                    "individual"=> [
                        "reference"=> "Practitioner/".$rawat->dokter?->kode_ihs,
                        "display"=> $rawat->dokter?->nama_dokter
                    ]
                ]
            ],
            'period' => [
                'start' =>  date('Y-m-d')."T".date('H:i:s')."+07:00",
                'end' =>  date('Y-m-d')."T".date('H:i:s')."+07:00"
            ],
            "location"=> [
                [
                    "location"=> [
                        "reference"=> "Location/".$organisasi_lokasi->id_location,
                        "display"=> $organisasi_lokasi->nama_organisasi
                    ]
                ]
            ],
            'statusHistory' => [
                // [
                //     'status' => 'arrived',
                //     'period' => [
                //         'start' => '2022-06-14T07:00:00+07:00',
                //         'end' => '2022-06-14T08:00:00+07:00'
                //     ]
                // ],
                [
                    'status' => 'in-progress',
                    'period' => [
                        'start' => date('Y-m-d')."T".date('H:i:s')."+07:00",
                        'end' =>  date('Y-m-d')."T".date('H:i:s')."+07:00"
                    ]
                ]
            ],
            'serviceProvider' => [
                'reference' => 'Organization/100026488'
            ]
        ];

        $response = Http::withOptions(["verify" => SatusehatAuthHelper::ssl()])
        ->withHeaders(['Authorization'=> 'Bearer '.EncounterHelper::token()])
        ->put(EncounterHelper::url().'/Encounter/'.$id, $data);
        return $response->json();
    }

}
