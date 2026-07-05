<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payroll_runs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('period_start');
            $table->date('period_end');
            $table->date('payment_date');
            $table->bigInteger('total_gross');
            $table->bigInteger('total_deductions');
            $table->bigInteger('total_net');
            $table->bigInteger('total_paye');
            $table->bigInteger('total_nssf');
            $table->bigInteger('total_employer_nssf');
            $table->string('status'); // draft / approved / paid / cancelled
            $table->foreignId('processed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payroll_runs');
    }
};
