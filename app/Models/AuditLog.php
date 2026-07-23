<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * AuditLog — immutable append-only record of every admin portal action.
 *
 * No updated_at column. Mass-assignment guarded against updates by design.
 */
class AuditLog extends Model
{
    /**
     * Disable updated_at — audit rows are immutable.
     */
    public const UPDATED_AT = null;

    protected $fillable = [
        'user_id',
        'username',
        'ip_address',
        'action',
        'model_type',
        'model_id',
        'old_values',
        'new_values',
    ];

    protected $casts = [
        'old_values' => 'array',
        'new_values' => 'array',
    ];

    // -------------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------------

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
