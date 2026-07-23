<?php

use App\Jobs\BackupDatabaseJob;
use App\Jobs\CheckDormancyJob;
use App\Jobs\DailyPenaltyJob;
use App\Jobs\MonthlyInterestJob;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

/*
|--------------------------------------------------------------------------
| SACCO Scheduled Jobs
|--------------------------------------------------------------------------
|
| All critical background jobs are registered here. Ensure the scheduler
| is running on the server:  * * * * * php artisan schedule:run >> /dev/null 2>&1
|
*/

// Daily at 00:30 — scan overdue loan schedules beyond grace period;
// compute and post penalty + accrued interest Journal Entries.
// Requirements: 6.9, 6.10
Schedule::job(DailyPenaltyJob::class)->dailyAt('00:30');

// Daily at 02:00 — compress database dump, store to disk, prune old backups.
// Requirements: 19.1, 19.2
Schedule::job(BackupDatabaseJob::class)->dailyAt('02:00');

// 1st of month at 01:00 — post savings interest for all active accounts.
// Requirements: 7.5
Schedule::job(MonthlyInterestJob::class)->monthlyOn(1, '01:00');

// Daily at 03:00 — flag accounts with no transactions for ≥ 180 days as dormant.
// Requirements: 7.7
Schedule::job(CheckDormancyJob::class)->dailyAt('03:00');
