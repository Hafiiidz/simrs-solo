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
use App\Helpers\Satusehat\RequestSatuSehatHelper;
// use App\Helpers\Satusehat\Resource\EncounterHelper;

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
        return 100026489;
    }

    public static function create($idrawat){
        
        try{
            $rawat = Rawat::find($idrawat);
            // return $rawat;
            $pasien = Pasien::where('no_rm',$rawat->no_rm)->first();
            
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
                        "system"=> "http://sys-ids.kemkes.go.id/encounter/100026489",
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
                    "start"=> date('Y-m-d',strtotime($rawat->tglmasuk))."T".date('H:i:s',strtotime($rawat->tglmasuk))."+07:00"
                ],
                "location"=> [
                    [
                        "location"=> [
                            "reference"=> "Location/".$organisasi_lokasi?->id_location,
                            "display"=> $organisasi_lokasi?->nama_organisasi
                        ]
                    ]
                ],
                "statusHistory"=> [
                    [
                        "status"=> "arrived",
                        "period"=> [
                            "start"=> date('Y-m-d',strtotime($rawat->tglmasuk))."T".date('H:i:s',strtotime($rawat->tglmasuk))."+07:00"
                        ]
                    ]
                ],
                "serviceProvider"=> [
                    "reference"=> "Organization/100026489"
                ],

            ];
            // return $data;
            $response = RequestSatuSehatHelper::makeRequest('create-encounter','post','/Encounter',$data,2);
            if(isset($response['id'])){
                $rawat->id_encounter = $response['id'] ?? '';
                $rawat->save();
            }
            
            if(isset($response['text']) && $response['text']['status'] == 'generated'){
                $encounter = EncounterHelper::searchSubject($rawat->id);
                return $encounter;
                $rawat->id_encounter = $encounter['resource']['id'] ?? '';
                $rawat->save();
            }
            return $response;
        }catch(\Exception $e){
            return [
                'error' => $e->getMessage(),
            ];
        }
        
       
        
    }

    #search by id
    public static function searchId($id){
        try{
            $response = RequestSatuSehatHelper::makeRequest('search-encounter-byid','get','/Encounter/'.$id,null,2);
            return $response;
        }catch(\Exception $e){
            return [
                'error' => $e->getMessage(),
            ];
        }
        // $response = Http::withOptions(["verify" => SatusehatAuthHelper::ssl()])
        // ->withHeaders(['Authorization'=> 'Bearer '.EncounterHelper::token()])
        // ->get(EncounterHelper::url().'/Encounter/'.$id);
        // return $response->json();
    }

    #search by subject
    public static function searchSubject($id){
        try{
            $rawat = Rawat::where('id',$id)->first();
            $pasien = Pasien::where('no_rm',$rawat->no_rm)->first();
            $response = RequestSatuSehatHelper::makeRequest('search-encounter-bysubject','get','/Encounter?subject='.$pasien->ihs,null,2);
            $responseCollect = collect($response['entry'])->filter(function ($item) use ($rawat) {
                // return 
                $isSameDate = \Carbon\Carbon::parse($item['resource']['period']['start'])->isSameDay($rawat->tglmasuk);
                $hasIdentifier = collect($item['resource']['identifier'])->contains(function ($identifier) use ($rawat) {
                    return $identifier['system'] === 'http://sys-ids.kemkes.go.id/encounter/100026489' &&
                           $identifier['value'] === $rawat->idrawat;
                });
                return $isSameDate && $hasIdentifier;
            })->first();
            return $responseCollect;
        }catch(\Exception $e){
            return [
                'error' => $e->getMessage(),
            ];
        }
        // $rawat = Rawat::where('id',$id)->first();
        // $pasien = Pasien::where('no_rm',$rawat->no_rm)->first();
        // $response = Http::withOptions(["verify" => SatusehatAuthHelper::ssl()])
        // ->withHeaders(['Authorization'=> 'Bearer '.EncounterHelper::token()])
        // ->get(EncounterHelper::url().'/Encounter?subject='.$pasien->ihs);
        // return $response->json();
    }

    #update progress
    public static function updateInProgress($id){
        try{
            $rawat = Rawat::where('id_encounter',$id)->first();
            $pasien = Pasien::where('no_rm',$rawat->no_rm)->first();
            $encounter = EncounterHelper::searchSubject($rawat->id);
            $arrived = collect($encounter['resource']['statusHistory'])->where('status','arrived')->first();
            // return $arrived['period']['start'];
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
                        "system"=> "http://sys-ids.kemkes.go.id/encounter/100026489",
                        "value"=> $rawat->idrawat
                    ]
                ],
                "status"=> "in-progress",
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
                    'start' =>  date('Y-m-d',strtotime($rawat->tglmasuk))."T".date('H:i:s',strtotime($rawat->tglmasuk))."+07:00",
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
                    [
                        "status"=> "arrived",
                        "period"=> [
                            "start"=> $arrived['period']['start'],
                            'end' =>  date('Y-m-d')."T".date('H:i:s')."+07:00"
                        ]
                    ],
                    [
                        'status' => 'in-progress',
                        'period' => [
                            'start' => date('Y-m-d')."T".date('H:i:s')."+07:00",
                            'end' =>  date('Y-m-d')."T".date('H:i:s')."+07:00"
                        ]
                    ]
                ],
                'serviceProvider' => [
                    'reference' => 'Organization/100026489'
                ]
            ];
            $response = RequestSatuSehatHelper::makeRequest('update-encounter','put','/Encounter/'.$id,$data,2);
            return $response;
        }catch(\Exception $e){
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function updateFinised($id){
        try{
            $rawat = Rawat::where('id_encounter',$id)->first();
            $pasien = Pasien::where('no_rm',$rawat->no_rm)->first();
            $encounter = EncounterHelper::searchSubject($rawat->id);
            $arrived = collect($encounter['resource']['statusHistory'])->where('status','arrived')->first();
            $in_progres = collect($encounter['resource']['statusHistory'])->where('status','in-progress')->first();
            // return $in_progres;
            // return $arrived['period']['start'];
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
                        "system"=> "http://sys-ids.kemkes.go.id/encounter/100026489",
                        "value"=> $rawat->idrawat
                    ]
                ],
                "status"=> "finished",
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
                    'start' =>  date('Y-m-d',strtotime($rawat->tglmasuk))."T".date('H:i:s',strtotime($rawat->tglmasuk))."+07:00",
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
                    [
                        "status"=> "arrived",
                        "period"=> [
                            "start"=> $arrived['period']['start'],
                            "end"=> $arrived['period']['end'],
                        ]
                    ],
                    [
                        'status' => 'in-progress',
                        'period' => [
                            'start' =>$in_progres['period']['start'],
                            'end' =>  date('Y-m-d')."T".date('H:i:s')."+07:00"
                        ]
                    ],
                    [
                        'status' => 'finished',
                        'period' => [
                            'start' =>date('Y-m-d')."T".date('H:i:s')."+07:00",
                            'end' =>  date('Y-m-d')."T".date('H:i:s')."+07:00"
                        ]
                    ]
                ],
                // "hospitalization"=> [
                //     "dischargeDisposition"=> [
                //         "coding"=> [
                //             [
                //                 "system"=> "http://terminology.hl7.org/CodeSystem/discharge-disposition",
                //                 "code"=> "home",
                //                 "display"=> "Home"
                //             ]
                //         ],
                //         "text" => "Anjuran dokter untuk pulang dan kontrol kembali 1 bulan setelah minum obat"
                //     ]
                // ],
                'serviceProvider' => [
                    'reference' => 'Organization/100026489'
                ]
            ];
            $response = RequestSatuSehatHelper::makeRequest('update-encounter','put','/Encounter/'.$id,$data,2);
            return $response;
        }catch(\Exception $e){
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function updatedischargeDisposition($id){
        try{
            $rawat = Rawat::where('id_encounter',$id)->first();
            $pasien = Pasien::where('no_rm',$rawat->no_rm)->first();
            $encounter = EncounterHelper::searchSubject($rawat->id);
            $arrived = collect($encounter['resource']['statusHistory'])->where('status','arrived')->first();
            $in_progres = collect($encounter['resource']['statusHistory'])->where('status','in-progress')->first();
            // return $in_progres;
            // return $arrived['period']['start'];
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
                        "system"=> "http://sys-ids.kemkes.go.id/encounter/100026489",
                        "value"=> $rawat->idrawat
                    ]
                ],
                "status"=> "in-progress",
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
                    'start' =>  date('Y-m-d',strtotime($rawat->tglmasuk))."T".date('H:i:s',strtotime($rawat->tglmasuk))."+07:00",
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
                    [
                        "status"=> "arrived",
                        "period"=> [
                            "start"=> $arrived['period']['start'],
                            "end"=> $arrived['period']['end'],
                        ]
                    ],
                    [
                        'status' => 'in-progress',
                        'period' => [
                            'start' =>$in_progres['period']['start'],
                            'end' =>  date('Y-m-d')."T".date('H:i:s')."+07:00"
                        ]
                    ]
                ],
                "hospitalization"=> [
                    "dischargeDisposition"=> [
                        "coding"=> [
                            [
                                "system"=> "http://terminology.hl7.org/CodeSystem/discharge-disposition",
                                "code"=> "home",
                                "display"=> "Home"
                            ]
                        ],
                        "text" => "Anjuran dokter untuk pulang dan kontrol kembali 1 bulan setelah minum obat"
                    ]
                ],
                'serviceProvider' => [
                    'reference' => 'Organization/100026489'
                ]
            ];
            $response = RequestSatuSehatHelper::makeRequest('update-encounter','put','/Encounter/'.$id,$data,2);
            return $response;
        }catch(\Exception $e){
            return [
                'error' => $e->getMessage(),
            ];
        }
    }

}
