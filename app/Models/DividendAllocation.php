<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DividendAllocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'dividend_id',
        'member_id',
        'share_account_id',
        'shares_held',
        'amount',
        'status',
        'paid_at',
    ];

    protected $casts = [
        'shares_held' => 'integer',
        'amount' => 'integer',
        'paid_at' => 'datetime',
    ];

    public function dividend(): BelongsTo
    {
        return $this->belongsTo(Dividend::class);
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function shareAccount(): BelongsTo
    {
        return $this->belongsTo(ShareAccount::class);
    }
}
