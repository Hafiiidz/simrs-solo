<?php

namespace App\Models;

use App\Models\RekapMedis\RekapMedis;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TindakLanjut extends Model
{
    use HasFactory;
    protected $table = 'demo_tindak_lanjut';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function rawat(): HasOne
    {
        return $this->hasOne(Rawat::class, 'id', 'idrawat');
    }
    public function rekap(): HasOne
    {
        return $this->hasOne(RekapMedis::class, 'id', 'idrekapmedis');
    }

    public function generateNomorOtomatis()
    {
        $year = date('Y');
        // $time = strtotime(date('Y-m-d H:i:s'));
        $bulan = date('m');
        $kode = 'SPP';
        $get_kode = TindakLanjut::whereYear('created_at', $year)->whereMonth('created_at',$bulan)->first();
        if ($get_kode) {            
            $no_spp = $get_kode->nomor + 1;
        } else {
            $no_spp = 1;
        }
        return $no_spp;
    }
}
