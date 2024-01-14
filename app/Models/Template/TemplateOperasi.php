<?php

namespace App\Models\Template;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateOperasi extends Model
{
    use HasFactory;

    protected $table = 'demo_template_operasi';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
