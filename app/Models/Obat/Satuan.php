<?php

namespace App\Models\Obat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Satuan extends Model
{
    use HasFactory;

    protected $table = 'obat_satuan';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
