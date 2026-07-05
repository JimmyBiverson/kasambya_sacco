<?php

namespace App\Jobs;

use App\Models\SavingsAccount;
use App\Notifications\JobFailedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class CheckDormancyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 1;

    public function handle(): void
    {
        $cutoff = now()->subDays(180);
        $flagged = 0;

        SavingsAccount::where('status', 'active')
            ->whereDoesntHave('transactions', function ($query) use ($cutoff) {
                $query->where('created_at', '>', $cutoff);
            })
            ->where('created_at', '<', $cutoff)
            ->chunk(100, function ($accounts) use (&$flagged) {
                foreach ($accounts as $account) {
                    $account->update(['status' => 'dormant']);
                    $flagged++;
                }
            });

        Log::info('CheckDormancyJob completed', [
            'flagged_dormant' => $flagged,
            'cutoff_date' => $cutoff->toDateString(),
        ]);
    }

    public function failed(\Throwable $e): void
    {
        Log::error('CheckDormancyJob failed', ['error' => $e->getMessage()]);

        try {
            Notification::route('mail', config('app.admin_email', 'admin@mubendesacco.com'))
                ->notify(new JobFailedNotification(
                    'CheckDormancyJob',
                    $e->getMessage()
                ));
        } catch (\Exception $notifyEx) {
            Log::warning('Failed to send CheckDormancyJob failure notification', ['error' => $notifyEx->getMessage()]);
        }
    }
}
