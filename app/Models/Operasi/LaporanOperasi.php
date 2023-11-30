<?php

namespace App\Models\Operasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Rawat;

class LaporanOperasi extends Model
{
    use HasFactory;

    protected $table = 'demo_laporan_operasi';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function rawat(): HasOne
    {
        return $this->hasOne(Rawat::class, 'id','idrawat');
    }
}
