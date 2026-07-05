<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payroll_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('payroll_run_id')->constrained()->cascadeOnDelete();
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
            $table->bigInteger('gross_pay');
            $table->bigInteger('basic_pay');
            $table->bigInteger('allowances')->default(0);
            $table->bigInteger('deductions')->default(0);
            $table->bigInteger('paye')->default(0);
            $table->bigInteger('nssf_employee')->default(0);
            $table->bigInteger('nssf_employer')->default(0);
            $table->bigInteger('net_pay');
            $table->bigInteger('overtime_pay')->default(0);
            $table->bigInteger('bonus')->default(0);
            $table->integer('hours_worked')->nullable();
            $table->string('status'); // draft / computed / paid
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payroll_items');
    }
};
