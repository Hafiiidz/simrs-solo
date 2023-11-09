<?php

namespace App\Models\Ruangan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Ruangan\Ruangan;
use App\Models\Ruangan\RuanganJenis;

class RuanganBed extends Model
{
    use HasFactory;

    protected $table = 'ruangan_bed';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public $timestamps = false;


    /**
     * Get the ruangan associated with the RuanganBed
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ruangan(): HasOne
    {
        return $this->hasOne(Ruangan::class, 'id', 'idruangan');
    }

    public function jenisRuangan(): HasOne
    {
        return $this->hasOne(RuanganJenis::class, 'id', 'idjenis');
    }
}
