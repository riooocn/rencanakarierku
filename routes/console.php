<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('accounts:deactivate-expired', function () {
    $count = \App\Models\User::where('status', 'active')
        ->whereNotNull('expires_at')
        ->where('expires_at', '<=', now())
        ->update(['status' => 'inactive']);

    $this->info("Deactivated {$count} expired account(s).");
})->purpose('Automatically deactivate accounts that have passed their expiry date');

Schedule::command('accounts:deactivate-expired')->daily();
