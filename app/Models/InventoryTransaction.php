<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InventoryTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_item_id',
        'type',
        'quantity',
        'unit_cost',
        'total_cost',
        'reference',
        'description',
        'created_by',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_cost' => 'integer',
        'total_cost' => 'integer',
    ];

    public function inventoryItem(): BelongsTo
    {
        return $this->belongsTo(InventoryItem::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
