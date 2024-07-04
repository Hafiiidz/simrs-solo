<?php

// app/Jobs/ProcessPasienJob.php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Jobs\SatusehatUpdatePasienJob;

class ProcessPasienJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $pasien;

    public function __construct($pasien)
    {
        $this->pasien = $pasien;
    }

    public function handle()
    {
        foreach ($this->pasien as $r) {
            SatusehatUpdatePasienJob::dispatch($r->nik);
        }
    }
}