<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SoapRajalTindakan extends Model
{
    use HasFactory;
    protected $table = 'soap_rajaltindakan';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected $timestamp = false;

    public function tarif(): HasOne
    {
        return $this->hasOne(Tarif::class, 'id','idtindakan');
    }
}
