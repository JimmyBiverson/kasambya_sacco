<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'sku',
        'category',
        'description',
        'unit_of_measure',
        'quantity',
        'unit_cost',
        'total_value',
        'reorder_level',
        'is_active',
        'branch_id',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_cost' => 'integer',
        'total_value' => 'integer',
        'reorder_level' => 'integer',
        'is_active' => 'boolean',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(InventoryTransaction::class);
    }

    public function currentValue(): int
    {
        return $this->quantity * $this->unit_cost;
    }
}
