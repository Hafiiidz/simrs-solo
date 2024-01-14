<?php

namespace App\Models\Operasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerawatBedah extends Model
{
    use HasFactory;

    protected $table = 'demo_perawat_bedah';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
