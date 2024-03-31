<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gizi extends Model
{
    use HasFactory;
    protected $table = 'gizi';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public $timestamps = false;
}
