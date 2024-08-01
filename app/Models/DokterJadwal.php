<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DokterJadwal extends Model
{
    use HasFactory;
    protected $table = 'dokter_jadwal';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public $timestamps = false;


}
