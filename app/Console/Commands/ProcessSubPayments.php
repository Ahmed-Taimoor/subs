<?php

namespace App\Console\Commands;

use App\Models\PurchaseSlot;
use Illuminate\Console\Command;

class ProcessSubPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-sub-payments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $date = '2024-09-19';
        $all_slots = PurchaseSlot::where('charge_date',$date)->where('status',false)->get();
        foreach($all_slots as $item)
        {
            // dd($item->purchaseItem->user->wallet_balance);
            // dd($item->purchaseItem);
            if($item->purchaseItem->user->wallet_balance > $item->amount)
            {
                dd($item);
            }
            else{

            }

        }
    }
}
