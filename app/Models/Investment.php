<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Investment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'type',
        'name',
        'description',
        'amount',
        'rate',
        'start_date',
        'maturity_date',
        'interest_earned',
        'total_return',
        'status',
        'branch_id',
        'notes',
    ];

    protected $casts = [
        'amount' => 'integer',
        'rate' => 'float',
        'interest_earned' => 'integer',
        'total_return' => 'integer',
        'start_date' => 'date',
        'maturity_date' => 'date',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
}
