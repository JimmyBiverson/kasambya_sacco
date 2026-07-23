<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JournalEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'reference',
        'description',
        'posted_by',
        'is_posted',
        'reversal_of',
    ];

    protected $casts = [
        'date' => 'date',
        'is_posted' => 'boolean',
    ];

    public function poster(): BelongsTo
    {
        return $this->belongsTo(User::class, 'posted_by');
    }

    public function lines(): HasMany
    {
        return $this->hasMany(JournalEntryLine::class);
    }

    public function reversalOf(): BelongsTo
    {
        return $this->belongsTo(self::class, 'reversal_of');
    }

    public function totalDebit(): int
    {
        return (int) $this->lines()->sum('debit');
    }

    public function totalCredit(): int
    {
        return (int) $this->lines()->sum('credit');
    }

    public function isBalanced(): bool
    {
        return $this->totalDebit() === $this->totalCredit();
    }
}
