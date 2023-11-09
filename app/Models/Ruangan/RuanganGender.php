<?php

namespace App\Models\Ruangan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ruangan\Ruangan;

class RuanganGender extends Model
{
    use HasFactory;

    protected $table = 'ruangan_gender';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

}
