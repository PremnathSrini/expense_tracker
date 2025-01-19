<?php

namespace App\Jobs;

use App\Models\Bill;
use App\Models\User;
use App\Notifications\BillDueNotification;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Throwable;

class BillDueMailSendJob implements ShouldQueue
{
    use Queueable,InteractsWithQueue,Dispatchable,SerializesModels;


    /**
     * Create a new job instance.
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {   

        $bills = Bill::where('due_date','<=',Carbon::now()->addDays(5))
                        ->where('is_paid','0')
                        ->get();

        foreach($bills as $bill){
            try{
                $user = User::findOrFail($bill->user_id);
                $user->notify(new BillDueNotification($user,$bill));
                Log::info('Notification has been notified');
            }catch(Throwable $exception){
                Log::error('Job handle error '.['exception' => $exception->getMessage()]);
            }
        }
        
    }
}
