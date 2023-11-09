<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan\Ruangan;
use App\Models\Ruangan\RuanganBed;
use App\Models\Ruangan\RuanganKelas;

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
}
