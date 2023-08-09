<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserPrivilages extends Model
{
    use HasFactory;

    protected $table = 'user_privilages';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
