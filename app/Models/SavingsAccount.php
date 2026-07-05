<?php

namespace App\Models;

use App\Exceptions\DormantAccountException;
use App\Exceptions\InsufficientFundsException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SavingsAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'branch_id',
        'account_number',
        'account_type',
        'balance',
        'interest_rate',
        'target_amount',
        'maturity_date',
        'status',
        'approved_by',
        'approved_at',
    ];

    protected $casts = [
        'maturity_date' => 'date',
        'approved_at' => 'datetime',
        'balance' => 'integer',
        'interest_rate' => 'float',
        'target_amount' => 'integer',
    ];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(SavingsTransaction::class);
    }

    public function deposit(int $amount, ?string $description = null, ?int $processedBy = null): SavingsTransaction
    {
        $oldBalance = $this->balance;
        $this->balance += $amount;
        $this->save();

        return $this->transactions()->create([
            'type' => 'deposit',
            'amount' => $amount,
            'balance_after' => $this->balance,
            'reference' => 'DEP-' . strtoupper(\Illuminate\Support\Str::random(10)),
            'description' => $description,
            'processed_by' => $processedBy,
        ]);
    }

    public function withdraw(int $amount, ?string $description = null, ?int $processedBy = null): SavingsTransaction
    {
        if ($this->status === 'dormant') {
            throw new DormantAccountException();
        }

        if ($this->status === 'frozen') {
            throw new DormantAccountException('Cannot withdraw from a frozen account.');
        }

        if ($this->status === 'closed') {
            throw new DormantAccountException('Cannot withdraw from a closed account.');
        }

        if ($amount > $this->balance) {
            throw new InsufficientFundsException($amount, $this->balance);
        }

        $oldBalance = $this->balance;
        $this->balance -= $amount;
        $this->save();

        return $this->transactions()->create([
            'type' => 'withdrawal',
            'amount' => $amount,
            'balance_after' => $this->balance,
            'reference' => 'WTH-' . strtoupper(\Illuminate\Support\Str::random(10)),
            'description' => $description,
            'processed_by' => $processedBy,
        ]);
    }
}
