<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationApprovedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $application;

    public function __construct($application)
    {
        $this->application = $application;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Application Approved')
            ->greeting('Hello')
            ->line('An application was approved: ' . ($this->application->full_name ?? 'Applicant'))
            ->action('View Applications', url(route('admin.applications.index')))
            ->line('Thank you.');
    }

    public function toArray($notifiable)
    {
        return [
            'type' => 'application_approved',
            'application_id' => $this->application->id ?? null,
            'applicant' => $this->application->full_name ?? null,
            'message' => 'A membership application was approved',
        ];
    }
}
