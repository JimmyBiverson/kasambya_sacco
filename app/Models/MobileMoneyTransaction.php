<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MobileMoneyTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'savings_account_id',
        'member_id',
        'type',
        'provider',
        'phone_number',
        'amount',
        'fee',
        'reference',
        'external_reference',
        'description',
        'status',
        'initiated_by',
        'processed_at',
        'failure_reason',
    ];

    protected $casts = [
        'amount'       => 'integer',
        'fee'          => 'integer',
        'processed_at' => 'datetime',
    ];

    public function savingsAccount(): BelongsTo
    {
        return $this->belongsTo(SavingsAccount::class);
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function initiator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'initiated_by');
    }

    public function markAsSuccess(string $externalRef): void
    {
        $this->update([
            'status'             => 'success',
            'external_reference' => $externalRef,
            'processed_at'       => now(),
        ]);
    }

    public function markAsFailed(string $reason): void
    {
        $this->update([
            'status'         => 'failed',
            'failure_reason' => $reason,
            'processed_at'   => now(),
        ]);
    }
}
