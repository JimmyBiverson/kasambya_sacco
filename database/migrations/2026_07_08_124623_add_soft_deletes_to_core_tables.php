<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $tables = ['members', 'loans', 'savings_accounts', 'applications', 'loan_repayments', 'loan_schedules'];

        foreach ($tables as $table) {
            if (! Schema::hasColumn($table, 'deleted_at')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->softDeletes();
                });
            }
        }
    }

    public function down(): void
    {
        // Intentionally not dropping soft deletes here — data preservation is the goal.
    }
};
