<?php

namespace App\Models\Gizi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsuhanGizi extends Model
{
    use HasFactory;

    protected $table = 'demo_asuhan_gizi';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
