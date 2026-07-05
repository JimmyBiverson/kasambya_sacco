<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoanApproval extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id',
        'level',
        'approver_id',
        'action',
        'reason',
        'approved_at',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
    ];

    // -----------------------------------------------------------------
    // Relationships
    // -----------------------------------------------------------------

    public function loan(): BelongsTo
    {
        return $this->belongsTo(Loan::class);
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approver_id');
    }
}
