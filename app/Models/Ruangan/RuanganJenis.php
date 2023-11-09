<?php

namespace App\Models\Ruangan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuanganJenis extends Model
{
    use HasFactory;

    protected $table = 'ruangan_jenis';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
