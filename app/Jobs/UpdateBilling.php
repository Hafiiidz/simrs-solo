<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class UpdateBilling implements ShouldQueue
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
        $data = DB::table('soap_rajalicdx')
        ->join('rawat', 'soap_rajalicdx.idrawat', '=', 'rawat.id')
        ->leftJoin('transaksi_detail_bill', 'rawat.id', '=', 'transaksi_detail_bill.idrawat')
        ->select(
            'rawat.id as rawat_id',
            'rawat.status',
            'transaksi_detail_bill.tarif',
            'soap_rajalicdx.icd10'
        )
        ->where('soap_rajalicdx.idjenisrawat', 3)
        ->where('rawat.idbayar', 2)
        ->whereBetween('rawat.tglmasuk', ['2023-01-01 00:00:00', '2023-12-31 23:59:59'])
        ->whereIn('rawat.status', [2, 4])
        ->where('soap_rajalicdx.icd10', $this->id)
        ->get();
        
        $lanjut_ranap = 0;
        $tidak_lanjut_ranap = 0;
        $billing_lanjut = 0;
        $billing_tidak_lanjut = 0;

        foreach ($data as $d) {
            if ($d->status == 2) {
                // $lanjut_ranap++;
                $billing_lanjut += $d->tarif;
            } elseif ($d->status == 4) {
                // $tidak_lanjut_ranap++;
                $billing_tidak_lanjut += $d->tarif;
            }
        }
        DB::table('table_satu')->where('icd10',$this->id)->update([
            'billing_lanjut_ranap'=>$billing_lanjut,
            'billing_tidak_lanjut'=>$billing_tidak_lanjut,
        ]);

    }
}
