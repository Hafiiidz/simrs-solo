<?php

namespace App\Models\Ruangan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Ruangan\RuanganBed;
use App\Models\Ruangan\RuanganKelas;
use App\Models\Ruangan\RuanganJenis;
use App\Models\Ruangan\RuanganGender;


class Ruangan extends Model
{
    use HasFactory;

    protected $table = 'ruangan';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public $timestamps = false;


    public function kelas(): HasOne
    {
        return $this->hasOne(RuanganKelas::class, 'id', 'idkelas');
    }

    public function bed(): HasMany
    {
        return $this->hasMany(RuanganBed::class, 'idruangan', 'id')->where('status', 1);
    }

    public function bed_kosong(): HasMany
    {
        return $this->hasMany(RuanganBed::class, 'idruangan', 'id')->where('status', 1)->where('terisi', 0);
    }

    public function jenisRuangan(): HasOne
    {
        return $this->hasOne(RuanganJenis::class, 'id', 'idjenis');
    }

    public function genderRuangan(): HasOne
    {
        return $this->hasOne(RuanganGender::class, 'id', 'gender');
    }
}
