<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * JobFailedNotification
 *
 * Dispatched to the Super Admin email when a critical scheduled job
 * (e.g. DailyPenaltyJob, MonthlyInterestJob, BackupDatabaseJob) fails
 * after exhausting all retry attempts.
 */
class JobFailedNotification extends Notification
{
    use Queueable;

    /**
     * @param  string      $jobClass    Fully-qualified class name of the failed job
     * @param  string      $errorMessage  Exception message from the failure
     * @param  array<string, mixed>  $context  Additional contextual data for debugging
     */
    public function __construct(
        public readonly string $jobClass,
        public readonly string $errorMessage,
        public readonly array  $context = [],
    ) {
    }

    /**
     * Delivery channels — mail only for job failure alerts.
     *
     * @param  mixed  $notifiable
     * @return array<string>
     */
    public function via(mixed $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail(mixed $notifiable): MailMessage
    {
        $shortClass = class_basename($this->jobClass);
        $timestamp  = now()->format('Y-m-d H:i:s T');

        $message = (new MailMessage())
            ->subject("[MUBENDE SACCO] Scheduled Job Failed: {$shortClass}")
            ->error()
            ->greeting('⚠️ Scheduled Job Failure Alert')
            ->line("The following scheduled job has failed and requires your attention:")
            ->line("**Job:** `{$this->jobClass}`")
            ->line("**Time:** {$timestamp}")
            ->line("**Error:** {$this->errorMessage}");

        if (! empty($this->context)) {
            $contextLines = [];
            foreach ($this->context as $key => $value) {
                $contextLines[] = "- **{$key}:** " . (is_array($value) ? json_encode($value) : $value);
            }
            $message->line('**Context:**')
                    ->line(implode("\n", $contextLines));
        }

        return $message
            ->line('Please review the application logs and failed_jobs table for full details.')
            ->action('Open Admin Portal', url('/admin'))
            ->salutation("Regards,\nMubende SACCO System");
    }

    /**
     * Serialize for database channel (optional — only if Super Admin uses DB notifications).
     *
     * @param  mixed  $notifiable
     * @return array<string, mixed>
     */
    public function toArray(mixed $notifiable): array
    {
        return [
            'job_class'     => $this->jobClass,
            'error_message' => $this->errorMessage,
            'context'       => $this->context,
            'failed_at'     => now()->toIso8601String(),
        ];
    }
}
