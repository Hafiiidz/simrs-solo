<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DokterKuota extends Model
{
    use HasFactory;
    protected $table = 'dokter_kuota';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public $timestamps = false;


}
