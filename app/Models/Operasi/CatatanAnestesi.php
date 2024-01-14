<?php

namespace App\Models\Operasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Operasi\laporanOperasi;

class CatatanAnestesi extends Model
{
    use HasFactory;

    protected $table = 'demo_catatan_anestesi';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function laporanOperasi(): HasOne
    {
        return $this->hasOne(laporanOperasi::class, 'id','laporan_operasi_id');
    }
}
