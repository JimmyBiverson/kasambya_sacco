<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'address',
        'district',
        'region',
        'phone',
        'email',
        'manager_name',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }

    public function savingsAccounts(): HasMany
    {
        return $this->hasMany(SavingsAccount::class);
    }

    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }
}
