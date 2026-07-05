<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PayrollItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'payroll_run_id',
        'employee_id',
        'gross_pay',
        'basic_pay',
        'allowances',
        'deductions',
        'paye',
        'nssf_employee',
        'nssf_employer',
        'net_pay',
        'overtime_pay',
        'bonus',
        'hours_worked',
        'status',
    ];

    protected $casts = [
        'gross_pay' => 'integer',
        'basic_pay' => 'integer',
        'allowances' => 'integer',
        'deductions' => 'integer',
        'paye' => 'integer',
        'nssf_employee' => 'integer',
        'nssf_employer' => 'integer',
        'net_pay' => 'integer',
        'overtime_pay' => 'integer',
        'bonus' => 'integer',
        'hours_worked' => 'integer',
    ];

    public function payrollRun(): BelongsTo
    {
        return $this->belongsTo(PayrollRun::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
