<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    use HasFactory;
    protected $table = 'tarif';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected $timestamp = false;
}
