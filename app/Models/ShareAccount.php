<?php

namespace App\Models;

use App\Exceptions\InsufficientSharesException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShareAccount extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'member_id',
        'branch_id',
        'account_number',
        'total_shares',
        'share_value',
        'balance',
        'status',
    ];

    protected $casts = [
        'total_shares' => 'integer',
        'share_value' => 'integer',
        'balance' => 'integer',
    ];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(ShareTransaction::class);
    }

    public function dividendAllocations(): HasMany
    {
        return $this->hasMany(DividendAllocation::class);
    }

    public function purchaseShares(
        int $shares,
        string $method = null,
        string $reference = null,
        string $description = null,
        int $createdBy = null,
    ): ShareTransaction {
        $amount = $shares * $this->share_value;

        $this->total_shares += $shares;
        $this->balance += $amount;
        $this->save();

        return $this->transactions()->create([
            'type' => 'purchase',
            'shares' => $shares,
            'amount' => $amount,
            'share_value_at_time' => $this->share_value,
            'method' => $method,
            'reference' => $reference,
            'description' => $description,
            'created_by' => $createdBy,
        ]);
    }

    public function refundShares(
        int $shares,
        string $method = null,
        string $reference = null,
        string $description = null,
        int $createdBy = null,
    ): ShareTransaction {
        if ($shares > $this->total_shares) {
            throw new InsufficientSharesException($shares, $this->total_shares);
        }

        $amount = $shares * $this->share_value;

        $this->total_shares -= $shares;
        $this->balance -= $amount;
        $this->save();

        return $this->transactions()->create([
            'type' => 'refund',
            'shares' => $shares,
            'amount' => $amount,
            'share_value_at_time' => $this->share_value,
            'method' => $method,
            'reference' => $reference,
            'description' => $description,
            'created_by' => $createdBy,
        ]);
    }
}
