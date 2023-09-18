<?php

namespace App\Models\Pasien;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Pasien\Alamat;
use App\Models\RekapMedis\RekapMedis;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    /**
     * Get the user associated with the Pasien
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function alamat(): HasOne
    {
        return $this->hasOne(Alamat::class, 'idpasien');
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
}
