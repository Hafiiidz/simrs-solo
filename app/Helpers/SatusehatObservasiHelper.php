<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Models\Rawat;
use App\Models\Dokter;
use App\Models\Obat\Obat;
use LZCompressor\LZString;
use App\Helpers\VclaimHelper;
use App\Models\Pasien\Pasien;
use Illuminate\Support\Facades\DB;
use App\Helpers\SatusehatAuthHelper;
use Illuminate\Support\Facades\Http;

class SatusehatObservasiHelper
{
    #Observation - Create

   
    public static function set_ttv($code,$display,$value,$unit,$code_unit,$ihs,$encounter_id,$name,$dokter){
        $data = [
            'resourceType' => 'Observation',
            'status' => 'final',
            'category' => [
                [
                    'coding' => [
                        [
                            'system' => 'http://terminology.hl7.org/CodeSystem/observation-category',
                            'code' => 'vital-signs',
                            'display' => 'Vital Signs'
                        ]
                    ]
                ]
            ],
            'code' => [
                'coding' => [
                    [
                        'system' => 'http://loinc.org',
                        'code' => $code,
                        'display' => $display
                    ]
                ]
            ],
            'subject' => [
                'reference' => 'Patient/'.$ihs,
                'display'=> $name
            ],
            'encounter' => [
                'reference' => 'Encounter/'.$encounter_id,
                'display' => 'Kunjungan '.$encounter_id
            ],
            "performer"=> [
                [
                    "reference"=> "Practitioner/".$dokter,
                ]
            ],
            'effectiveDateTime' => Carbon::now()->format('Y-m-d\TH:i:s\Z'),
            'valueQuantity' => [
                'value' => floatval($value),
                'unit' => $unit,
                'system' => 'http://unitsofmeasure.org',
                'code' => $code_unit
            ]
        ];
        $get_token = SatusehatAuthHelper::generate_token();
        $token = $get_token['access_token'];
        $url = env('PROD_BASE_URL_SS');
        $response = Http::withOptions(["verify" => SatusehatAuthHelper::ssl()])
        ->withHeaders([
            'Authorization' => 'Bearer '.$token,
            'Content-Type' => 'application/fhir+json'
        ])
        ->post($url.'/Observation', $data);
        return $response->json();
    }
    public static function create($id){
        $rawat = Rawat::find($id);
        $pasien = Pasien::where('no_rm', $rawat->no_rm)->first();
        $rekap_medis = DB::table('demo_detail_rekap_medis')->where('idrawat',$id)->first();
        
      
        // return $tekanan_darah;
        if($rekap_medis->pemeriksaan_fisik != null || $rekap_medis->pemeriksaan_fisik != 'null'){
            $pemeriksaan_fisik = json_decode($rekap_medis->pemeriksaan_fisik);

            $suhu = self::set_ttv('8310-5','Body temperature',str_replace(',','.',$pemeriksaan_fisik->suhu),'Cel','Cel',$pasien->ihs,$rawat->id_encounter,$pasien->nama_pasien,$rawat->dokter->kode_ihs);
            $nadi = self::set_ttv('8867-4','Heart rate',str_replace(',','.',$pemeriksaan_fisik->nadi),'beats/minute','/min',$pasien->ihs,$rawat->id_encounter,$pasien->nama_pasien,$rawat->dokter->kode_ihs);
            $pernapasan = self::set_ttv('9279-1','Respiratory rate',str_replace(',','.',$pemeriksaan_fisik->pernapasan),'beats/minute','/min',$pasien->ihs,$rawat->id_encounter,$pasien->nama_pasien,$rawat->dokter->kode_ihs);
            $tekanan_darah = json_decode($rekap_medis->pemeriksaan_fisik);
            if($tekanan_darah->tekanan_darah != null){
                $tekanan_darah = explode('/',$tekanan_darah->tekanan_darah);
                $systolic = self::set_ttv('8480-6','Systolic blood pressure',$tekanan_darah[0],'millimeter of mercury','mm[Hg]',$pasien->ihs,$rawat->id_encounter,$pasien->nama_pasien,$rawat->dokter->kode_ihs);
                $diastolic = self::set_ttv('8462-4','Diastolic blood pressure',$tekanan_darah[1],'millimeter of mercury','mm[Hg]',$pasien->ihs,$rawat->id_encounter,$pasien->nama_pasien,$rawat->dokter->kode_ihs);
            }else{
                $systolic = 0;
                $diastolic = 0;
            }
            
            $rawat->obs = 1;
            $rawat->save();
        }
        
    }
    
}
