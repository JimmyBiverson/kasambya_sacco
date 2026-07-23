<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            if (!Schema::hasColumn('applications', 'address')) {
                $table->string('address', 500)->nullable()->after('phone');
            }
            if (!Schema::hasColumn('applications', 'date_of_birth')) {
                $table->date('date_of_birth')->nullable()->after('address');
            }
            if (!Schema::hasColumn('applications', 'occupation')) {
                $table->string('occupation', 255)->nullable()->after('date_of_birth');
            }
            if (!Schema::hasColumn('applications', 'employer')) {
                $table->string('employer', 255)->nullable()->after('occupation');
            }
            if (!Schema::hasColumn('applications', 'monthly_income')) {
                $table->decimal('monthly_income', 15, 2)->nullable()->after('employer');
            }
        });
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $columns = ['address', 'date_of_birth', 'occupation', 'employer', 'monthly_income'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('applications', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
