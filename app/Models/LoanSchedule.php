<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoanSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id',
        'due_date',
        'principal_due',
        'interest_due',
        'penalty_due',
        'total_due',
        'paid_amount',
        'status',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    // -----------------------------------------------------------------
    // Relationships
    // -----------------------------------------------------------------

    public function loan(): BelongsTo
    {
        return $this->belongsTo(Loan::class);
    }
}
