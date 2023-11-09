<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bayar extends Model
{
    use HasFactory;
    protected $table = 'rawat_bayar';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function rawat(): BelongsTo
    {
        return $this->belongsTo(Rawat::class);
    }
}
