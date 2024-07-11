<?php

namespace App\Models\Pasien;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Pasien\Pasien;

class Agama extends Model
{
    use HasFactory;

    protected $table = 'data_agama';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    /**
     * Get the user that owns the Alamat
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
   
}
