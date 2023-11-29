<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObatTransaksi extends Model
{
    use HasFactory;
    protected $table = 'obat_transaksi';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function rawat()
    {
        return $this->hasOne(Rawat::class, 'id','idrawat');
    }
}
