<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SmsLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipient',
        'message',
        'provider',
        'status',
        'reference',
        'external_id',
        'segments_count',
        'attempts',
        'cost',
        'sent_at',
        'delivered_at',
        'failure_reason',
        'related_type',
        'related_id',
        'created_by',
    ];

    protected $casts = [
        'sent_at'      => 'datetime',
        'delivered_at' => 'datetime',
        'cost'         => 'decimal:4',
    ];

    public function related(): MorphTo
    {
        return $this->morphTo();
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
