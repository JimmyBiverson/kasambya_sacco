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

    public $tries = 3;

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

        $myCnf = tempnam(sys_get_temp_dir(), 'mycnf_');
        file_put_contents($myCnf, "[client]\nhost=\"{$dbHost}\"\nuser=\"{$dbUser}\"\npassword=\"{$dbPass}\"\n");

        $command = sprintf(
            'mysqldump --defaults-extra-file=%s --single-transaction --routines --triggers %s | gzip > %s',
            escapeshellarg($myCnf),
            escapeshellarg($dbName),
            escapeshellarg($path)
        );

        $output = null;
        $resultCode = null;

        exec($command, $output, $resultCode);

        unlink($myCnf);

        if ($resultCode !== 0) {
            throw new \RuntimeException("Database backup failed with exit code {$resultCode}: " . implode("\n", $output ?? []));
        }

        Log::info('Database backup created successfully', ['filename' => $filename, 'size' => filesize($path)]);

        $this->pruneOldBackups($backupDir);
    }

    private function pruneOldBackups(string $backupDir): void
    {
        $allFiles = collect(scandir($backupDir))
            ->filter(fn (string $f) => str_starts_with($f, 'backup_') && str_ends_with($f, '.sql.gz'))
            ->sort()
            ->values();

        $toKeep = collect();

        foreach ($allFiles as $file) {
            preg_match('/backup_.*_(\d{4}-\d{2}-\d{2})_/', $file, $matches);
            if (empty($matches[1])) continue;
            $fileDate = \Carbon\Carbon::parse($matches[1]);

            if ($fileDate->gte(now()->subDays(30))) {
                $toKeep->push($file);
            } elseif ($fileDate->gte(now()->subWeeks(12))) {
                $weekKey = $fileDate->format('Y-W');
                if (!$toKeep->contains(fn($f) => str_contains($f, $weekKey))) {
                    $toKeep->push($file);
                }
            } elseif ($fileDate->gte(now()->subMonths(12))) {
                $monthKey = $fileDate->format('Y-m');
                if (!$toKeep->contains(fn($f) => str_contains($f, $monthKey))) {
                    $toKeep->push($file);
                }
            }
        }

        $toDelete = $allFiles->diff($toKeep);

        foreach ($toDelete as $file) {
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
