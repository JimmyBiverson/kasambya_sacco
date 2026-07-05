<?php

namespace App\Jobs;

use App\Notifications\JobFailedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class BackupDatabaseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 1;

    public function handle(): void
    {
        $dbName = config('database.connections.mysql.database');
        $dbUser = config('database.connections.mysql.username');
        $dbPass = config('database.connections.mysql.password');
        $dbHost = config('database.connections.mysql.host');

        $timestamp = now()->format('Y-m-d_H-i-s');
        $filename = "backup_{$dbName}_{$timestamp}.sql.gz";
        $backupDir = storage_path('app/backups');

        if (!is_dir($backupDir)) {
            mkdir($backupDir, 0755, true);
        }

        $path = "{$backupDir}/{$filename}";

        $command = sprintf(
            'mysqldump --host=%s --user=%s --password=%s --single-transaction --routines --triggers %s | gzip > %s',
            escapeshellarg($dbHost),
            escapeshellarg($dbUser),
            escapeshellarg($dbPass),
            escapeshellarg($dbName),
            escapeshellarg($path)
        );

        $output = null;
        $resultCode = null;

        exec($command, $output, $resultCode);

        if ($resultCode !== 0) {
            throw new \RuntimeException("Database backup failed with exit code {$resultCode}: " . implode("\n", $output ?? []));
        }

        Log::info('Database backup created successfully', ['filename' => $filename, 'size' => filesize($path)]);

        $this->pruneOldBackups($backupDir);
    }

    private function pruneOldBackups(string $backupDir): void
    {
        $files = collect(scandir($backupDir))
            ->filter(fn (string $f) => str_starts_with($f, 'backup_') && str_ends_with($f, '.sql.gz'))
            ->sort()
            ->values();

        $dailyCutoff = now()->subDays(30);
        $weeklyCutoff = now()->subWeeks(12);
        $monthlyCutoff = now()->subMonths(12);
        $filesToDelete = [];

        foreach ($files as $file) {
            preg_match('/backup_.*_(\d{4}-\d{2}-\d{2})_/', $file, $matches);
            if (empty($matches[1])) continue;

            $fileDate = \Carbon\Carbon::parse($matches[1]);

            if ($fileDate->lt($monthlyCutoff)) {
                $filesToDelete[] = $file;
            } elseif ($fileDate->lt($weeklyCutoff)) {
                // Keep at most 12 monthly
                $monthlyFiles = collect($filesToDelete)
                    ->filter(fn ($f) => str_contains($f, $fileDate->format('Y-m')));
                if ($monthlyFiles->isNotEmpty()) {
                    $filesToDelete[] = $file;
                }
            } elseif ($fileDate->lt($dailyCutoff)) {
                // Keep at most 12 weekly
                $weekNum = $fileDate->isoWeek();
                $weeklyFiles = collect($filesToDelete)
                    ->filter(fn ($f) => str_contains($f, "week{$weekNum}"));
                if ($weeklyFiles->isNotEmpty()) {
                    $filesToDelete[] = $file;
                }
            }
        }

        foreach ($filesToDelete as $file) {
            $path = "{$backupDir}/{$file}";
            if (file_exists($path)) {
                unlink($path);
                Log::info('Pruned old backup', ['filename' => $file]);
            }
        }
    }

    public function failed(\Throwable $e): void
    {
        Log::error('BackupDatabaseJob failed', ['error' => $e->getMessage()]);

        try {
            Notification::route('mail', config('app.admin_email', 'admin@mubendesacco.com'))
                ->notify(new JobFailedNotification(
                    'BackupDatabaseJob',
                    $e->getMessage()
                ));
        } catch (\Exception $notifyEx) {
            Log::warning('Failed to send backup failure notification', ['error' => $notifyEx->getMessage()]);
        }
    }
}
