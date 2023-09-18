<?php

namespace App\Models\RekapMedis;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\RekapMedis\Kategori;
use App\Models\Pasien\Pasien;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Auth;

class RekapMedis extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'demo_rekap_medis';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->useLogName('Rekap Medis')
            ->setDescriptionForEvent(fn(string $eventName) =>"Rekap Medis {$eventName} Oleh: " . Auth::user()->detail->nama);
    }

    /**
     * Get the kategori that owns the RekapMedis
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'idkategori');
    }

   /**
    * Get all of the pasien for the RekapMedis
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function pasien(): BelongsTo
   {
       return $this->BelongsTo(Pasien::class, 'idpasien', 'id');
   }
}
