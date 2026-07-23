<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LoanProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
        'min_amount',
        'max_amount',
        'min_term',
        'max_term',
        'interest_rate',
        'interest_method',
        'penalty_rate',
        'grace_period',
        'processing_fee',
        'insurance_fee',
        'max_loan_to_savings',
        'max_loan_to_share',
        'collateral_required',
        'category',
        'approval_levels',
        'is_active',
    ];

    protected $casts = [
        'approval_levels'    => 'array',
        'is_active'          => 'boolean',
        'collateral_required' => 'boolean',
    ];

    // -----------------------------------------------------------------
    // Relationships
    // -----------------------------------------------------------------

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }
}
