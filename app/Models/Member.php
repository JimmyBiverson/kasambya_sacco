<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'membership_number',
        'full_name',
        'dob',
        'gender',
        'national_id',
        'passport_number',
        'photo',
        'address',
        'district',
        'phone',
        'email',
        'occupation',
        'employer',
        'monthly_income',
        'next_of_kin_name',
        'next_of_kin_phone',
        'next_of_kin_relationship',
        'category',
        'branch_id',
        'status',
        'blacklist_reason',
        'blacklisted_by',
        'blacklisted_at',
        'joined_at',
        'qr_code_path',
    ];

    protected $casts = [
        'dob'            => 'date',
        'joined_at'      => 'date',
        'blacklisted_at' => 'datetime',
        'monthly_income' => 'integer',
    ];

    // -----------------------------------------------------------------
    // Relationships
    // -----------------------------------------------------------------

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(MemberDocument::class);
    }

    public function beneficiaries(): HasMany
    {
        return $this->hasMany(MemberBeneficiary::class);
    }

    /**
     * Guarantor records where this member is the borrower.
     */
    public function guarantors(): HasMany
    {
        return $this->hasMany(MemberGuarantor::class, 'member_id');
    }

    /**
     * Guarantor records where this member is acting as guarantor for others.
     */
    public function guarantorFor(): HasMany
    {
        return $this->hasMany(MemberGuarantor::class, 'guarantor_member_id');
    }

    public function notes(): HasMany
    {
        return $this->hasMany(MemberNote::class);
    }

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }

    public function savingsAccounts(): HasMany
    {
        return $this->hasMany(SavingsAccount::class);
    }

    public function shareAccounts(): HasMany
    {
        return $this->hasMany(ShareAccount::class);
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    public function mobileMoneyTransactions(): HasMany
    {
        return $this->hasMany(MobileMoneyTransaction::class);
    }
}
