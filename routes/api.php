<?php

use App\Http\Controllers\SatuSehatApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('get-data-ss/{nik}',  [SatuSehatApiController::class,'get_data_ss'])->name('get-data-ss');
Route::get('consent-update/{rm}',  [SatuSehatApiController::class,'consent_update'])->name('consent-update');