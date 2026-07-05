<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoanRepayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id',
        'amount',
        'principal_paid',
        'interest_paid',
        'penalty_paid',
        'balance',
        'payment_method',
        'reference',
        'paid_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    // -----------------------------------------------------------------
    // Relationships
    // -----------------------------------------------------------------

    public function loan(): BelongsTo
    {
        return $this->belongsTo(Loan::class);
    }
}
