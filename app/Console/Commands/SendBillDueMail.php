<?php

namespace App\Console\Commands;

use App\Jobs\BillDueMailSendJob;
use Illuminate\Console\Command;

class SendBillDueMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-bill-due-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notifications for bills due within 5 days.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        dispatch(new BillDueMailSendJob());
        $this->info('BillDueMailSendJob dispatched successfully!');
    }
}
