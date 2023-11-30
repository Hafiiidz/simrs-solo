<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabHasil extends Model
{
    use HasFactory;
    protected $table = 'laboratorium_hasil';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public $timestamps = false;
}
