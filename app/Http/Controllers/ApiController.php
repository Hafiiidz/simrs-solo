<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien\Pasien;
use App\Http\Controllers\Controller;
use App\Helpers\SatusehatPasienHelper;
use App\Helpers\SatusehatResourceHelper;
use App\Helpers\Satusehat\Resource\EncounterHelper;
use App\Models\AntrianFarmasi;

class ApiController extends Controller
{
    public function antrian_farmasi(Request $r){
        $antrian = AntrianFarmasi::whereDate('created_at',$r->tgl)
        ->where('status_antrian','Antrian')
        ->get();
        $array = [];
        foreach($antrian as $an){
            $array[] = [
                'nama_pasien'=>$an->pasien?->nama_pasien,
                'status'=>$an->status_antrian == 'Antrian' ? 'Menunggu':$an->status_antrian,
            ];
        }
        return $array;
    }
}