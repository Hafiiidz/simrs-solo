<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserDetail extends Model
{
    use HasFactory;

    protected $table = 'user_detail';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasMany(User::class);
    }
    
    public function dokter_detail()
    {
        return $this->hasOne(Dokter::class,'id','iddokter');
    }
}
