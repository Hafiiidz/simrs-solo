<?php

namespace App\Models;

use App\Models\Pasien\Pasien;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Rawat extends Model
{
    use HasFactory;
    protected $table = 'rawat';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function poli(): HasOne
    {
        return $this->hasOne(Poli::class, 'id','idpoli');
    }
    
    public function dokter(): HasOne
    {
        return $this->hasOne(Dokter::class, 'id','iddokter');
    }

    public function bayar(): HasOne
    {
        return $this->hasOne(Bayar::class, 'id','idbayar');
    }
    public function pasien(): HasOne
    {
        return $this->hasOne(Pasien::class, 'no_rm','no_rm');
    }
    public function ruangan(): HasOne
    {
        return $this->hasOne(Ruangan::class, 'id','idruangan');
    }
}
