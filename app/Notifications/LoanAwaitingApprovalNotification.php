<?php

namespace App\Notifications;

use App\Models\Loan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LoanAwaitingApprovalNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @param  Loan  $loan  The loan application awaiting approval.
     */
    public function __construct(public readonly Loan $loan)
    {
    }

    /**
     * Delivery channels for this notification.
     *
     * @param  mixed  $notifiable
     * @return array<string>
     */
    public function via(mixed $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail(mixed $notifiable): MailMessage
    {
        $loan           = $this->loan;
        $applicationNo  = $loan->application_number;
        $memberName     = $loan->member?->full_name ?? 'N/A';
        $amount         = number_format($loan->applied_amount);
        $adminUrl       = url('/admin/loans/' . $loan->id);

        return (new MailMessage())
            ->subject("Loan Application Awaiting Your Approval — {$applicationNo}")
            ->greeting("Hello {$notifiable->name},")
            ->line("A new loan application requires your approval.")
            ->line("**Application Number:** {$applicationNo}")
            ->line("**Member:** {$memberName}")
            ->line("**Amount Applied:** UGX {$amount}")
            ->action('Review Loan Application', $adminUrl)
            ->line('Please log in to the admin portal to approve or reject this application.')
            ->salutation("Regards,\nMubende SACCO");
    }

    /**
     * Store notification data in the database.
     *
     * @param  mixed  $notifiable
     * @return array<string, mixed>
     */
    public function toArray(mixed $notifiable): array
    {
        $loan = $this->loan;

        return [
            'loan_id'            => $loan->id,
            'application_number' => $loan->application_number,
            'member_name'        => $loan->member?->full_name,
            'applied_amount'     => $loan->applied_amount,
            'status'             => $loan->status,
            'url'                => '/admin/loans/' . $loan->id,
        ];
    }
}
