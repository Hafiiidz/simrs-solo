<?php

namespace App\Http\Controllers;

use App\Helpers\Vclaim\VclaimRujukanHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

class RujukanBpjsController extends Controller
{
    public function index(){

        if(request()->ajax()){
            $start = Carbon::now()->startOfMonth()->format('Y-m-d');;
            $end = Carbon::now()->endOfMonth()->format('Y-m-d');;
            $data = VclaimRujukanHelper::list_rujukan_luar_rs($start,$end);
            
            if($data['metaData']['code'] == 200){
                $datas = $data['response']['list'];
    
                // $data3= $datas->tojson();
                return DataTables::of($datas)->make(true);
            }
        }
        return view('rujukan-bpjs.index');       

        // return $data;
    }
}
