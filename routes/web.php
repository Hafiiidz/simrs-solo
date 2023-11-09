<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\RekapMedisController;
use App\Http\Controllers\DetailRekapMedisController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->name('login');

//auth
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/index', function () {
    return view('layouts.index');
})->middleware('auth');

//Laporan
Route::prefix('/laporan')->group(function () {
    Route::get('/', [LaporanController::class, 'index']);
});

//pasien
Route::prefix('/pasien')->group(function () {
    Route::get('/', [PasienController::class, 'index']);
    //Rekap Medis
    Route::prefix('/rekap-medis')->group(function () {
        Route::get('/{id_pasien}/show', [RekapMedisController::class, 'index'])->name('rekap-medis-index');
        Route::post('/store}', [RekapMedisController::class, 'store'])->name('rekap-medis-store');
        Route::prefix('/detail')->group(function () {
            Route::get('/{id_rekapmedis}/index', [DetailRekapMedisController::class, 'index'])->name('detail-rekap-medis-index');
            Route::get('/create', [DetailRekapMedisController::class, 'create'])->name('detail-rekap-medis-create');
            Route::post('/{id_rekapmedis}/store', [DetailRekapMedisController::class, 'store'])->name('detail-rekap-medis-store');
            Route::get('/show/{id}', [DetailRekapMedisController::class, 'show'])->name('detail-rekap-medis-show');
            Route::post('/{id_pasien}/update', [DetailRekapMedisController::class, 'update'])->name('detail-rekap-medis-update');
            Route::get('/cetak/{id}', [DetailRekapMedisController::class, 'cetak'])->name('detail-rekap-medis-cetak');
        });
    });
});

