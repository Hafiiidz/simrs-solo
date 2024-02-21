<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bhp extends Model
{
    use HasFactory;
    protected $table = 'demo_template_bhp';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = false;
}
