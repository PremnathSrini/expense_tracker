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
                $user = User::where('id',$bill->user_id)->first();
                $user->notify(new BillDueNotification($user,$bill));
                Log::info("Notification sent successfully to user {$user->id} for bill {$bill->id}");
            }catch(Throwable $exception){
                Log::error('Error processing job', [
                    'bill_id' => $bill->id,
                    'exception_message' => $exception->getMessage(),
                    'trace' => $exception->getTraceAsString(),
                ]);
            }
        }

    }
}
