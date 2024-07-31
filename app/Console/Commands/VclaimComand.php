<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\Vclaim\VclaimAuthHelper;
use App\Helpers\Vclaim\VclaimPesertaHelper;
use App\Helpers\Vclaim\VclaimReferensiHelper;
use App\Helpers\Vclaim\VclaimRencanaKontrolHelper;

class VclaimComand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:vclaim';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comand Vclaim';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        #peserta
        $getPeserta = VclaimPesertaHelper::getPesertaBPJS('0000570582369',date('Y-m-d'));
        $getPesertaNik = VclaimPesertaHelper::getPesertaNIK('3313121806430001',date('Y-m-d'));
        #endpeserta

        #referensi
        $getDiagnosa = VclaimReferensiHelper::getDiagnosa('A01');
        $getPoli = VclaimReferensiHelper::getPoli('ANA');
        $getFaskes = VclaimReferensiHelper::getFaskes('Sulaiman',2);
        $getDPJP = VclaimReferensiHelper::getDPJP(1,'2024-06-25','INT');
        $getDiagnosaprb = VclaimReferensiHelper::getDiagnosaprb();
        $getObatPrb = VclaimReferensiHelper::getObatPrb('Insulin');
        $getProcedure = VclaimReferensiHelper::getProcedure('382.2');
        $getDokter = VclaimReferensiHelper::getDokter('Suharto');
        
        
        $getInsert = VclaimRencanaKontrolHelper::getInsert();


        dd($getPeserta);
    }
}
