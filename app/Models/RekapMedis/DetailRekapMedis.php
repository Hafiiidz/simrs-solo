<?php

namespace App\Models\RekapMedis;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\RekapMedis\RekapMedis;
use Auth;

class DetailRekapMedis extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'demo_detail_rekap_medis';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->useLogName('Rekam Medis')
            ->setDescriptionForEvent(fn(string $eventName) =>"Detail Rekam Medis {$eventName} Oleh: " . Auth::user()->detail->nama);
    }

    /**
     * Get the rekapMedis that owns the DetailRekapMedis
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rekapMedis(): BelongsTo
    {
        return $this->belongsTo(RekapMedis::class,'idrekapmedis','id');
    }

}
