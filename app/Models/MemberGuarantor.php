<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MemberGuarantor extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'guarantor_member_id',
        'max_amount',
        'status',
    ];

    protected $casts = [
        'max_amount' => 'integer',
    ];

    /**
     * The member who is borrowing (the one being guaranteed).
     */
    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    /**
     * The member who is acting as guarantor.
     */
    public function guarantorMember(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'guarantor_member_id');
    }
}
