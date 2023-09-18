<?php

namespace App\Models\RekapMedis;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\RekapMedis\RekapMedis;


class Kategori extends Model
{
    use HasFactory;

    protected $table = 'demo_m_kategori_rekap_medis';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    /**
     * Get all of the comments for the Kategori
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rekapMedis(): HasMany
    {
        return $this->hasMany(RekapMedis::class);
    }
}
