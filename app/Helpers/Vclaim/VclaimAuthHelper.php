<?php

namespace App\Helpers\Vclaim;

use LZCompressor\LZString;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class VclaimAuthHelper
{
    public static function stringDecrypt($key, $string)
    {

        $encrypt_method = 'AES-256-CBC';
        $key_hash = hex2bin(hash('sha256', $key));
        $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);
        return $output;
    }
    public static function decompress($string)
    {
        return \LZCompressor\LZString::decompressFromEncodedURIComponent($string);
    }

    public static function getTokenAntrol(){
        try {
            date_default_timezone_set('UTC');
            $tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
            $signature = hash_hmac('sha256',  config('app.consid_vclaim_prod') . "&" . $tStamp, config('app.secretkey_vclaim_prod'), true);
            $encodedSignature = base64_encode($signature);

            return [
                'signature' => [
                    'X-cons-id' =>  config('app.consid_vclaim_prod'),
                    'X-timestamp' => $tStamp,
                    'X-signature' => $encodedSignature,
                    'user_key' => config('app.userkey_antrol_prod'),
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'ssl' => false,
                'key' =>  config('app.consid_vclaim_prod') . config('app.secretkey_vclaim_prod') . $tStamp
            ];
        } catch (\Exception $e) {
            // Handle exception, log or rethrow as needed
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
    public static function getToken(){
        try {
            date_default_timezone_set('UTC');
            $tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
            $signature = hash_hmac('sha256',  config('app.consid_vclaim_prod') . "&" . $tStamp, config('app.secretkey_vclaim_prod'), true);
            $encodedSignature = base64_encode($signature);

            return [
                'signature' => [
                    'X-cons-id' =>  config('app.consid_vclaim_prod'),
                    'X-timestamp' => $tStamp,
                    'X-signature' => $encodedSignature,
                    'user_key' => config('app.userkey_vclaim_prod'),
                    "Content-Type" => "application/x-www-form-urlencoded"
                ],
                'ssl' => false,
                'key' =>  config('app.consid_vclaim_prod') . config('app.secretkey_vclaim_prod') . $tStamp
            ];
        } catch (\Exception $e) {
            // Handle exception, log or rethrow as needed
            return [
                'error' => $e->getMessage(),
            ];
        }
    }
}