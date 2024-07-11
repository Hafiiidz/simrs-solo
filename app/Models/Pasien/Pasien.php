<?php

namespace App\Models\Pasien;

use App\Models\Pasien\Agama;
use App\Models\Pasien\Alamat;
use App\Models\RekapMedis\RekapMedis;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public $timestamps = false;

    /**
     * Get the user associated with the Pasien
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function alamat(): HasOne
    {
        return $this->hasOne(Alamat::class, 'idpasien');
    }
  
    public function agama(): HasOne
    {
        return $this->hasOne(Agama::class, 'id','idagama');
    }

    /**
     * Get the rekapMedis that owns the Pasien
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function RekapMedis(): HasMany
    {
        return $this->HasMany(RekapMedis::class, 'idpasien','id');
    }

    public function genKode()
    {
        $pf = 'P-';
        $max = Pasien::where('kodepasien', 'like', $pf . '%')
            ->max('kodepasien');

        $last = $max ? (int) substr($max, strlen($pf)) + 1 : 1;

        if ($last < 10) {
            $id = $pf . '00000' . $last;
        } elseif ($last < 100) {
            $id = $pf . '0000' . $last;
        } elseif ($last < 1000) {
            $id = $pf . '000' . $last;
        } elseif ($last < 10000) {
            $id = $pf . '00' . $last;
        } elseif ($last < 100000) {
            $id = $pf . '0' . $last;
        } else {
            $id = $pf . $last;
        }

        $this->kodepasien = $id;
    }
}
