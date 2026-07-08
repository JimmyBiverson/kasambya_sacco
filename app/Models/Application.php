<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'address',
        'date_of_birth',
        'occupation',
        'employer',
        'monthly_income',
        'product_type',
        'account_type',
        'message',
        'status',
    ];
}
