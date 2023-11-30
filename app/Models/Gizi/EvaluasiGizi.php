<?php

namespace App\Models\Gizi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\User;

class EvaluasiGizi extends Model
{
    use HasFactory;

    protected $table = 'demo_evaluasi_gizi';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id','idpetugas');
    }
}
