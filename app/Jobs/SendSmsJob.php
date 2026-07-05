<?php

namespace App\Jobs;

use App\Models\SmsLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;

    public array $backoff = [300, 300, 300];

    public function __construct(
        public readonly string $phone,
        public readonly string $message,
        public readonly ?int   $logId = null,
    ) {
    }

    public function handle(): void
    {
        $provider = config('services.sms.provider', 'africastalking');

        try {
            if ($provider === 'africastalking') {
                $this->sendViaAfricasTalking();
            } else {
                Log::warning("SendSmsJob: Unsupported SMS provider '{$provider}'. Message not sent.", [
                    'phone' => $this->phone,
                ]);
            }

            $this->updateLog('sent', null);
        } catch (\Throwable $e) {
            $this->incrementAttempts();
            throw $e;
        }
    }

    public function failed(\Throwable $exception): void
    {
        Log::error('SendSmsJob permanently failed', [
            'phone'  => $this->phone,
            'log_id' => $this->logId,
            'error'  => $exception->getMessage(),
        ]);

        $this->updateLog('failed', $exception->getMessage());
    }

    private function sendViaAfricasTalking(): void
    {
        $username = config('services.africastalking.username');
        $apiKey   = config('services.africastalking.api_key');
        $senderId = config('services.africastalking.sender_id', 'MUBENDE SACCO');

        if (empty($username) || empty($apiKey)) {
            Log::warning("SendSmsJob: Africa's Talking credentials not configured. Skipping.");
            return;
        }

        $at  = new \AfricasTalking\SDK\AfricasTalking($username, $apiKey);
        $sms = $at->sms();

        $response = $sms->send([
            'to'      => $this->phone,
            'message' => $this->message,
            'from'    => $senderId,
        ]);

        $responseData = json_decode(json_encode($response), true);
        $this->updateLogWithResponse($responseData);
    }

    private function updateLog(string $status, ?string $failureReason): void
    {
        if (!$this->logId) {
            return;
        }

        try {
            SmsLog::where('id', $this->logId)->update([
                'status'         => $status,
                'failure_reason' => $failureReason,
                'sent_at'        => $status === 'sent' ? now() : null,
            ]);
        } catch (\Throwable $e) {
            Log::warning("SendSmsJob: Could not update SmsLog #{$this->logId}: " . $e->getMessage());
        }
    }

    private function updateLogWithResponse(array $response): void
    {
        if (!$this->logId) {
            return;
        }

        try {
            $recipients = $response['data']['Recipients'] ?? [];

            if (!empty($recipients)) {
                $recipient = $recipients[0];
                $status    = ($recipient['status'] ?? '') === 'Success' ? 'sent' : 'failed';
                $cost      = isset($recipient['cost']) ? (float) str_replace('UGX ', '', $recipient['cost']) : null;

                SmsLog::where('id', $this->logId)->update([
                    'status'          => $status,
                    'external_id'     => $recipient['messageId'] ?? null,
                    'segments_count'  => $recipient['numberOfParts'] ?? 1,
                    'cost'            => $cost,
                    'sent_at'         => $status === 'sent' ? now() : null,
                    'failure_reason'  => $status === 'failed' ? ($recipient['status'] ?? 'Unknown') : null,
                ]);
            }
        } catch (\Throwable $e) {
            Log::warning("SendSmsJob: Could not update SmsLog #{$this->logId} with response: " . $e->getMessage());
        }
    }

    private function incrementAttempts(): void
    {
        if (!$this->logId) {
            return;
        }

        try {
            SmsLog::where('id', $this->logId)
                ->where('attempts', '<', 3)
                ->increment('attempts');
        } catch (\Throwable $e) {
            Log::warning("SendSmsJob: Could not increment attempts on SmsLog #{$this->logId}: " . $e->getMessage());
        }
    }
}
