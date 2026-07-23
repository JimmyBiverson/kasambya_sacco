<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('member_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('employee_number')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('position');
            $table->bigInteger('salary');
            $table->string('bank_account')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('nssf_number')->nullable();
            $table->string('tin')->nullable();
            $table->string('employment_type'); // permanent / contract / intern
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('status'); // active / suspended / terminated
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('departments', function (Blueprint $table) {
            $table->foreign('head_of_department_id')->references('id')->on('employees')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('departments', function (Blueprint $table) {
            $table->dropForeign(['head_of_department_id']);
        });

        Schema::dropIfExists('employees');
    }
};
