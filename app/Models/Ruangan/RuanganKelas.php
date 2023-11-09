<?php

namespace App\Models\Ruangan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuanganKelas extends Model
{
    use HasFactory;

    protected $table = 'ruangan_kelas';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
