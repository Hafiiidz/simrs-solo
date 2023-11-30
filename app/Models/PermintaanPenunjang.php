<?php

namespace App\Models;

use App\Models\Pasien\Pasien;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanPenunjang extends Model
{
    use HasFactory;
    protected $table = 'demo_permintaan_penunjang';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function pasien()
    {
        return $this->hasOne(Pasien::class, 'no_rm','no_rm');
    }
    public function rawat()
    {
        return $this->hasOne(Rawat::class, 'id','idrawat');
    }
}
