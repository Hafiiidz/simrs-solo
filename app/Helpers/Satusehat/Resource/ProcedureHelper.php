<?php

namespace App\Helpers\Satusehat\Resource;

use App\Helpers\Satusehat\RequestSatuSehatHelper;
use App\Models\Rawat;
use App\Models\Dokter;
use App\Models\Obat\Obat;
use LZCompressor\LZString;
use App\Helpers\VclaimHelper;
use App\Models\Pasien\Pasien;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Helpers\SatusehatAuthHelper;

class ProcedureHelper
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

    public static function create($id){
        try{
            $rawat = Rawat::find($id);
            // return $rawat;
            $rekap_medis = DB::table('demo_detail_rekap_medis')->where('idrawat',$rawat->id)->first();
            $encounter_id = $rawat->id_encounter;
    
            $diagnosa =  [];
                foreach(json_decode($rekap_medis->icdx) as $value){
                    $split = explode(' - ', $value->diagnosa_icdx);
                    $diagnosa[] = 
                        [
                            'system' => 'http://hl7.org/fhir/sid/icd-10',
                            'code' => $split[0],
                            'display' => $split[1]
                        ];
                    
                }
            $prosedur =  [];
                foreach(json_decode($rekap_medis->icd9) as $value9){
                    $split9 = explode(' - ', $value9->diagnosa_icd9);
                    $prosedur[] = 
                        [
                            'system' => 'http://hl7.org/fhir/sid/icd-9-cm',
                            'code' => $split9[0],
                            'display' => $split9[1]
                        ];
                    
                }
            $data = [
                "resourceType" => "Procedure",
                "status" => "completed",
                "category" => [
                    "coding" => [
                        [
                            "system" => "http://snomed.info/sct",
                            "code" => "103693007",
                            "display" => "Diagnostic procedure"
                        ]
                    ],
                    "text" => "Diagnostic procedure"
                ],
                "code" => [
                    "coding" => $prosedur
                ],
                "subject" => [
                    "reference" => "Patient/".$rawat->pasien->ihs,
                    "display" => $rawat->pasien->nama_pasien
                ],
                "encounter" => [
                    "reference" => "Encounter/" . $encounter_id,
                    "display" => "Tindakan Pada ".$rawat->pasien->nama_pasien
                ],
                "performedPeriod" => [
                    "start" =>  date('Y-m-d')."T".date('H:i:s')."+07:00",
                    "end" => date('Y-m-d')."T".date('H:i:s')."+07:00"
                ],
                "performer" => [
                    [
                        "actor" => [
                            "reference" => "Practitioner/".$rawat->dokter->kode_ihs,
                            "display" => $rawat->dokter->nama_dokter
                        ]
                    ]
                ],
                "reasonCode" => [
                    [
                        "coding" => $diagnosa
                    ]
                ],
                // "bodySite" => [
                //     [
                //         "coding" => [
                //             [
                //                 "system" => "http://snomed.info/sct",
                //                 "code" => "302551006",
                //                 "display" => "Entire Thorax"
                //             ]
                //         ]
                //     ]
                // ],
                "note" => [
                    [
                        "text" => "-"
                    ]
                ]
            ];
            // return $data;
            // $response = Http::withOptions(["verify" => false])
            // ->withHeaders([
            //     'Authorization' => 'Bearer '.ProcedureHelper::token(),
            // ])
            // ->post(ProcedureHelper::url().'/Procedure', $data);
            
            $response = RequestSatuSehatHelper::makeRequest('create-prosedur','post','/Procedure',$data,2);
            return $response;
        }catch(\Exception $e){
            return [
                'error' => $e->getMessage(),
            ];
        }

    }

    public static function searchSubject($subject){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ProcedureHelper::token(),
        ])
        ->get(ProcedureHelper::url().'/Procedure?subject=' . $subject);

        return $response->json();
    }

    public static function searchSubjectEncounter($subject, $encounter_id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ProcedureHelper::token(),
        ])
        ->get(ProcedureHelper::url().'/Procedure?subject=' . $subject . '&encounter=' . $encounter_id);

        return $response->json();
    }

    public static function searchEncounter($encounter_id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ProcedureHelper::token(),
        ])
        ->get(ProcedureHelper::url().'/Procedure?encounter=' . $encounter_id);

        return $response->json();
    }

    public static function searchId($id){
        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ProcedureHelper::token(),
        ])
        ->get(ProcedureHelper::url().'/Procedure/' . $id);

        return $response->json();
    }

    public static function update($id){
        $encounter_id = 'dummy123';
        $data = [
            "resourceType" => "Procedure",
            "id" => $id,
            "status" => "completed",
            "category" => [
                "coding" => [
                    [
                        "system" => "http://snomed.info/sct",
                        "code" => "103693007",
                        "display" => "Diagnostic procedure"
                    ]
                ],
                "text" => "Diagnostic procedure"
            ],
            "code" => [
                "coding" => [
                    [
                        "system" => "http://hl7.org/fhir/sid/icd-9-cm",
                        "code" => "87.44",
                        "display" => "Routine chest x-ray, so described"
                    ]
                ]
            ],
            "subject" => [
                "reference" => "Patient/P00030004",
                "display" => "Budi Santoso"
            ],
            "encounter" => [
                "reference" => "Encounter/" . $encounter_id,
                "display" => "Tindakan Rontgen Dada Budi Santoso pada Selasa tanggal 14 Juni 2022"
            ],
            "performedPeriod" => [
                "start" => "2022-06-14T13:31:00+01:00",
                "end" => "2022-06-14T14:27:00+01:00"
            ],
            "performer" => [
                [
                    "actor" => [
                        "reference" => "Practitioner/N10000001",
                        "display" => "Dokter Bronsig"
                    ]
                ]
            ],
            "reasonCode" => [
                [
                    "coding" => [
                        [
                            "system" => "http://hl7.org/fhir/sid/icd-10",
                            "code" => "A15.0",
                            "display" => "Tuberculosis of lung, confirmed by sputum microscopy with or without culture"
                        ]
                    ]
                ]
            ],
            "bodySite" => [
                [
                    "coding" => [
                        [
                            "system" => "http://snomed.info/sct",
                            "code" => "302551006",
                            "display" => "Entire Thorax"
                        ]
                    ]
                ]
            ],
            "note" => [
                [
                    "text" => "Rontgen thorax melihat perluasan infiltrat dan kavitas."
                ]
            ]
        ];

        $response = Http::withOptions(["verify" => false])
        ->withHeaders([
            'Authorization' => 'Bearer '.ProcedureHelper::token(),
        ])
        ->put(ProcedureHelper::url().'/Procedure/' . $id, $data);

        return $response->json();
    }
}
