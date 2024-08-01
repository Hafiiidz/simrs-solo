<?php

namespace App\Helpers\Antrol;

use App\Helpers\MakeRequestHelper;
use LZCompressor\LZString;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class WsBpjsHelper
{
    public static function referensi_poli(){       
        try {
            $response = MakeRequestHelper::makeRequest('get-antrean-referensi-poli','get','/ref/poli',null,2);
            return $response;           
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function referensi_dokter(){       
        try {
            $response = MakeRequestHelper::makeRequest('get-antrean-referensi-dokter','get','/ref/dokter',null,2);
            return $response;           
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function referensi_jadwaldokter($kode,$tgl){       
        try {
            $response = MakeRequestHelper::makeRequest('get-antrean-referensi-dokter','get','/jadwaldokter/kodepoli/'.$kode.'/tanggal/'.$tgl,null,2);
            return $response;           
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function referensi_poli_fp(){       
        try {
            $response = MakeRequestHelper::makeRequest('get-antrean-referensi-poli-fp','get','/ref/poli/fp',null,2);
            return $response;           
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function referensi_pasien_fp($no_jenis,$noidentitas){       
        try {
            $response = MakeRequestHelper::makeRequest('get-antrean-referensi-pasien-fp','get','/ref/pasien/fp/identitas/'.$no_jenis.'/noidentitas/'.$noidentitas,null,2);
            return $response;           
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function post_list_taks($kode_booking){       
        try {
            $data = [
                'kodebooking'=>$kode_booking,
            ];
            $response = MakeRequestHelper::makeRequest('post-list-taks','post','/antrean/getlisttask',$data,2);
            return $response;           
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function get_dashboard_tgl($tanggal,$jenis_waktu){       
        try {
            $response = MakeRequestHelper::makeRequest('dashboard-tgl','get','/dashboard/waktutunggu/tanggal/'.$tanggal.'/waktu/'.$jenis_waktu,null,3);
            return $response;           
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function get_antrean_tgl($tanggal){       
        try {
            $response = MakeRequestHelper::makeRequest('antrean-tgl','get','/antrean/pendaftaran/tanggal/'.$tanggal,null,2);
            return $response;           
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function get_antrean_kode($kode){       
        try {
            $response = MakeRequestHelper::makeRequest('antrean-kode','get','/antrean/pendaftaran/kodebooking/'.$kode,null,2);
            return $response;           
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function get_antrean_belum(){       
        try {
            $response = MakeRequestHelper::makeRequest('antrean-belum','get','/antrean/pendaftaran/aktif',null,2);
            return $response;           
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }

    public static function post_tambah_antrean($data){
        try {
            $response = MakeRequestHelper::makeRequest('post-tambah-antrian','post','/antrean/add',$data,2);
            return $response;           
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function post_update_antrean($data){
        try {
            $response = MakeRequestHelper::makeRequest('post-update-antrian','post','/antrean/updatewaktu',$data,2);
            return $response;           
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
}