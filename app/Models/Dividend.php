<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dividend extends Model
{
    use HasFactory;

    protected $fillable = [
        'financial_year',
        'total_amount',
        'per_share_rate',
        'declaration_date',
        'payment_date',
        'status',
        'notes',
        'declared_by',
    ];

    protected $casts = [
        'total_amount' => 'integer',
        'per_share_rate' => 'integer',
        'declaration_date' => 'date',
        'payment_date' => 'date',
    ];

    public function allocations(): HasMany
    {
        return $this->hasMany(DividendAllocation::class);
    }

    public function declarer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'declared_by');
    }
}
