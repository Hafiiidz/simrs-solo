<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien\Pasien;
use App\Http\Controllers\Controller;
use App\Helpers\SatusehatPasienHelper;
use App\Helpers\SatusehatResourceHelper;
use App\Helpers\Satusehat\Resource\EncounterHelper;

class SatuSehatApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function encounter_progres($idencounter){
        return EncounterHelper::updateInProgress($idencounter);
    }
    public function encounter_create($idrawat){
        return EncounterHelper::create($idrawat);
    }
    public function consent_update($rm){
        $pasien = Pasien::where('no_rm',$rm)->first();
        // return $pasien;
        return SatusehatResourceHelper::consent_update($pasien->ihs);
    }
    public function get_data_ss($nik)
    {
        // return $nik;
        return SatusehatPasienHelper::searchPasienByNik($nik);
    }
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
