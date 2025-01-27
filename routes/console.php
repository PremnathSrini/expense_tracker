<?php

use App\Jobs\BillDueMailSendJob;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Artisan::command('app:send-bill-due-mail',function(){
//     Artisan::call('app:send-bill-due-mail');
//     $this->info('Bill due mail command executed!');
// });

Schedule::command('app:send-bill-due-mail')->dailyAt('11:30');
