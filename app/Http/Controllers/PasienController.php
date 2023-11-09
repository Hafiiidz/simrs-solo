<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien\Pasien;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PasienController extends Controller
{
    
    public function index()
    {
        if (request()->ajax()) {
            $pasien = Pasien::query();

            return DataTables::of($pasien)
                ->addColumn('opsi', function (Pasien $pasien) {
                    return '<a href="' . route('rekap-medis-index', $pasien->id) . '" class="btn btn-sm btn-success">Rekam Medis</a>';
                })
                ->rawColumns(['opsi'])
                ->make();
        }
        return view('pasien.index');
    }
}
