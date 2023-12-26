<?php

namespace App\Models\Gizi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkriningGizi extends Model
{
    use HasFactory;

    protected $table = 'demo_skrining_gizi';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
