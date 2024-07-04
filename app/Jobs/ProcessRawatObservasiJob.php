<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Jobs\SatuseharObservasiJob;

class ProcessRawatObservasiJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $rawat;

    public function __construct($rawat)
    {
        $this->rawat = $rawat;
    }

    public function handle()
    {
        foreach ($this->rawat as $r) {
            SatuseharObservasiJob::dispatch($r->id);
        }
    }
}
