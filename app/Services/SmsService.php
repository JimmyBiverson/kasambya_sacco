<?php

namespace App\Services;

use App\Jobs\SendSmsJob;
use App\Models\SmsLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class SmsService
{
    /**
     * Queue an SMS message for delivery via the configured provider.
     */
    public function send(string $phone, string $message, ?Model $related = null): SmsLog
    {
        if (empty(trim($phone))) {
            Log::warning('SmsService::send() called with an empty phone number.', [
                'message' => $message,
            ]);

            return new SmsLog();
        }

        $log = SmsLog::create([
            'recipient'  => $phone,
            'message'    => $message,
            'provider'   => config('services.sms.provider', 'africastalking'),
            'status'     => 'pending',
            'related_type' => $related?->getMorphClass(),
            'related_id'   => $related?->getKey(),
            'created_by' => auth()->id(),
        ]);

        SendSmsJob::dispatch($phone, $message, $log->id);

        return $log;
    }

    /**
     * Send a loan disbursement confirmation SMS.
     */
    public function sendDisbursementConfirmation(
        string $phone,
        string $memberName,
        int    $amount,
        string $firstDueDate,
        string $applicationNo,
    ): SmsLog {
        $formattedAmount = number_format($amount);
        $message = "Dear {$memberName}, your loan of UGX {$formattedAmount} "
            . "(Ref: {$applicationNo}) has been disbursed. "
            . "First repayment due: {$firstDueDate}. "
            . "Thank you for choosing Mubende SACCO.";

        return $this->send($phone, $message);
    }

    /**
     * Send a loan approval notification SMS to the member.
     */
    public function sendApprovalNotice(string $phone, string $name, string $appNo, int $amount): SmsLog
    {
        $formattedAmount = number_format($amount);
        $message = "Dear {$name}, your loan application {$appNo} for UGX {$formattedAmount} "
            . "has been approved. Disbursement will follow shortly. - Mubende SACCO";

        return $this->send($phone, $message);
    }

    /**
     * Send a loan rejection notification SMS to the member.
     */
    public function sendRejectionNotice(string $phone, string $name, string $appNo, string $reason): SmsLog
    {
        $shortReason = mb_substr($reason, 0, 80);
        $message = "Dear {$name}, your loan application {$appNo} has been declined. "
            . "Reason: {$shortReason}. "
            . "Contact us for details. - Mubende SACCO";

        return $this->send($phone, $message);
    }
}
