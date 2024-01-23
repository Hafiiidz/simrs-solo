<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateAnastesi extends Model
{
    use HasFactory;
    protected $table = 'demo_catatan_anastesi_template';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
