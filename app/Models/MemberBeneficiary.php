<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MemberBeneficiary extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'name',
        'relationship',
        'phone',
        'percentage_share',
        'national_id',
    ];

    protected $casts = [
        'percentage_share' => 'decimal:2',
    ];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
}
