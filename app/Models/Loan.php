<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'loan_product_id',
        'branch_id',
        'application_number',
        'applied_amount',
        'approved_amount',
        'disbursed_amount',
        'term_months',
        'interest_rate',
        'purpose',
        'disbursement_method',
        'status',
        'credit_score',
        'rejection_reason',
        'disbursed_at',
    ];

    protected $casts = [
        'disbursed_at' => 'datetime',
    ];

    // -----------------------------------------------------------------
    // Relationships
    // -----------------------------------------------------------------

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function loanProduct(): BelongsTo
    {
        return $this->belongsTo(LoanProduct::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function collaterals(): HasMany
    {
        return $this->hasMany(LoanCollateral::class);
    }

    public function approvals(): HasMany
    {
        return $this->hasMany(LoanApproval::class);
    }

    public function repayments(): HasMany
    {
        return $this->hasMany(LoanRepayment::class);
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(LoanSchedule::class);
    }
}
