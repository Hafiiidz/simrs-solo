<?php

namespace App\Jobs;

use App\Models\Rawat;
use App\Helpers\SatusehatKondisiHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendSatuSehatJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $id;
    /**
     * Create a new job instance.
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
       
        SatusehatKondisiHelper::create_kondisi($this->id);
    }
}
