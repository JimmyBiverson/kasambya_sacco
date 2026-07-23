<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FixedAsset extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'category',
        'purchase_date',
        'purchase_cost',
        'depreciation_method',
        'useful_life_years',
        'salvage_value',
        'book_value',
        'current_value',
        'status',
        'location',
        'asset_tag',
        'branch_id',
        'notes',
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'purchase_cost' => 'integer',
        'salvage_value' => 'integer',
        'book_value' => 'integer',
        'current_value' => 'integer',
        'useful_life_years' => 'integer',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function calculateDepreciation(): array
    {
        $calculator = app(\App\Services\DepreciationCalculatorService::class);

        if ($this->depreciation_method === 'straight_line') {
            $annualDepreciation = $calculator->straightLine(
                $this->purchase_cost,
                $this->salvage_value,
                $this->useful_life_years
            );
        } else {
            $annualDepreciation = $calculator->reducingBalance(
                $this->book_value
            );
        }

        $monthlyDepreciation = $calculator->monthlyDepreciation($annualDepreciation);

        return [
            'annual_depreciation' => $annualDepreciation,
            'monthly_depreciation' => $monthlyDepreciation,
            'remaining_value' => max(0, $this->book_value - $annualDepreciation),
        ];
    }
}
