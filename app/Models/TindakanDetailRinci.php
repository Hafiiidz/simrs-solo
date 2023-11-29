<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TindakanDetailRinci extends Model
{
    use HasFactory;
    protected $table = 'transaksi_detail_rinci';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected $timestamp = false;
}
