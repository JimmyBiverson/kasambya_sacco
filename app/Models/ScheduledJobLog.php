<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduledJobLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_class',
        'name',
        'cron_expression',
        'last_run_at',
        'last_run_status',
        'next_run_at',
    ];

    protected $casts = [
        'last_run_at' => 'datetime',
        'next_run_at' => 'datetime',
    ];
}
