<?php

namespace App\Helpers\Vclaim;

use LZCompressor\LZString;
use App\Helpers\MakeRequestHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Helpers\Vclaim\VclaimAuthHelper;

class VclaimReferensiHelper
{
    public static function getDiagnosa($kode)
    {
        try {
            $response = MakeRequestHelper::makeRequest('get-diagnosa','get','/referensi/diagnosa/'.$kode);
            return $response;           
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function getPoli($poli)
    {
        try {
            $response = MakeRequestHelper::makeRequest('get-poli','get','referensi/poli/'.$poli);
            return $response;           
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function getFaskes($nama,$jenis)
    {
        try {
            $response = MakeRequestHelper::makeRequest('get-faskes','get','/referensi/faskes/'.$nama.'/'.$jenis);
            return $response;           
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function getDPJP($jenis_pelayanan,$tgl_pelayanan,$kode_spesialis) // (Pencarian data dokter DPJP untuk pengisian DPJP Layan)
    {
        try {
            $response = MakeRequestHelper::makeRequest('get-dpjp','get','/referensi/dokter/pelayanan/'.$jenis_pelayanan.'/tglPelayanan/'.$tgl_pelayanan.'/Spesialis/'.$kode_spesialis);
            return $response;           
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function getProvinsi()
    {
        try {
            $response = MakeRequestHelper::makeRequest('get-provinsi','get','/referensi/propinsi/');
            return $response;           
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function getKabupaten($id)
    {
        try {
            $response = MakeRequestHelper::makeRequest('get-kabupaten','get','/referensi/kabupaten/propinsi/'.$id);
            return $response;           
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function getKecamatan($id)
    {
        try {
            $response = MakeRequestHelper::makeRequest('get-kecamatan','get','/referensi/kecamatan/kabupaten/'.$id);
            return $response;           
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function getDiagnosaprb()
    {
        try {
            $response = MakeRequestHelper::makeRequest('get-diagnosa-prb','get','/referensi/diagnosaprb');
            return $response;           
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function getObatPrb($nama_obat)
    {
        try {
            $response = MakeRequestHelper::makeRequest('get-bat-prb','get','/referensi/obatprb/'.$nama_obat);
            return $response;           
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function getProcedure($kode)
    {
        try {
            $response = MakeRequestHelper::makeRequest('get-procedure','get','/referensi/procedure/'.$kode);
            return $response;           
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function getKelasRawat()
    {
        try {
            $response = MakeRequestHelper::makeRequest('get-kelas-rawat','get','/referensi/kelasrawat');
            return $response;           
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function getDokter($kode)
    {
        try {
            $response = MakeRequestHelper::makeRequest('get-dokter','get','/referensi/dokter/'.$kode);
            return $response;           
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function getSpesialistik()
    {
        try {
            $response = MakeRequestHelper::makeRequest('get-spesialistik','get','/referensi/spesialistik');
            return $response;           
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function getRuangRawat()
    {
        try {
            $response = MakeRequestHelper::makeRequest('get-ruang-rawat','get','/referensi/ruangrawat');
            return $response;           
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function getCaraKeluar()
    {
        try {
            $response = MakeRequestHelper::makeRequest('get-cara-keluar','get','/referensi/carakeluar');
            return $response;           
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function getPascaPulang()
    {
        try {
            $response = MakeRequestHelper::makeRequest('get-pasca-pulang','get','/referensi/pascapulang');
            return $response;           
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
}
