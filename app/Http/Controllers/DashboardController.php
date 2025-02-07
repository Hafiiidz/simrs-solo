<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan\Ruangan;
use App\Models\Ruangan\RuanganBed;
use App\Http\Controllers\Controller;
use App\Models\Ruangan\RuanganKelas;
use App\Helpers\SatusehatResourceHelper;

class DashboardController extends Controller
{
    public function index()
    {
        $ruangan = Ruangan::with('kelas')
            ->withCount('bed','bed_kosong')
            ->where('jenis', 2)
            ->where('status', 1)->get();

        return view('dashboard.index', compact('ruangan'));
    }

    public function getPraktisi(Request $r){
        $nik = $r->nik;
        $nama = $r->nama;
        $response = SatusehatResourceHelper::practitioner_nik_verifikasi($nik);
        // return $response['token'];
        if($response['status'] == 'success'){
            $client = new \GuzzleHttp\Client();
            $response_satset = $client->post('https://117.20.59.250:50000/generate-url', [
            'json' => [
                'agen' => $r->nama,
                'nik_agen' => $r->nik,
                'access_token' => $response['token'],
            ]
            ]);

            $responseBody = json_decode($response_satset->getBody(), true);
            $result = json_decode($responseBody['response'], true);
            
            if(isset($result['metadata']) && $result['metadata']['code'] == '200'){
                return response()->json([
                    'status'=>'success',
                    'url'=>$result['data']['url']
                ]);
            }else{
                return response()->json([
                    'status'=>'error',
                    'message'=>$result['metadata']['message'] ?? 'Unknown error'
                ]);
            }
        }else{
            return $response;
        }
    }
}
