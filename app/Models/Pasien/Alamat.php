<?php

namespace App\Models\Pasien;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Pasien\Pasien;

class Alamat extends Model
{
    use HasFactory;

    protected $table = 'pasien_alamat';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    /**
     * Get the user that owns the Alamat
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class);
    }
}
