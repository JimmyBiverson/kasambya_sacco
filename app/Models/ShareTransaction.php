<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShareTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'share_account_id',
        'type',
        'shares',
        'amount',
        'share_value_at_time',
        'method',
        'reference',
        'description',
        'created_by',
    ];

    protected $casts = [
        'shares' => 'integer',
        'amount' => 'integer',
        'share_value_at_time' => 'integer',
    ];

    public function shareAccount(): BelongsTo
    {
        return $this->belongsTo(ShareAccount::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
