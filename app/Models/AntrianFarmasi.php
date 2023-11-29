<?php

namespace App\Models;

use App\Models\Pasien\Pasien;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AntrianFarmasi extends Model
{
    use HasFactory;
    protected $table = 'demo_antrian_resep';
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
