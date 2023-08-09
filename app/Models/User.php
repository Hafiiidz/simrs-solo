<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $guard = 'web';
    protected $guarded = ['id'];

    public function username()
    {
        return $this->username;
    }

    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    public function detail()
    {
        return $this->belongsTo(UserDetail::class, 'kode_user', 'kode_user');
    }

    public function privilages()
    {
        return $this->belongsTo(UserPrivilages::class, 'idpriv');
    }


}
