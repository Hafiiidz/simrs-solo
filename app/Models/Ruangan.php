<?php

namespace App\Models;

use App\Models\Pasien\Pasien;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ruangan extends Model
{
    use HasFactory;
    protected $table ='ruangan';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public $timestamps = false;

}
