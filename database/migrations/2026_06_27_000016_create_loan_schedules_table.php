<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loan_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('loan_id');
            $table->date('due_date');
            $table->unsignedBigInteger('principal_due');
            $table->unsignedBigInteger('interest_due');
            $table->unsignedBigInteger('penalty_due')->default(0);
            $table->unsignedBigInteger('total_due');
            $table->unsignedBigInteger('paid_amount')->default(0);
            $table->enum('status', ['pending', 'partial', 'paid', 'overdue'])->default('pending');
            $table->timestamps();

            $table->foreign('loan_id')->references('id')->on('loans')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loan_schedules');
    }
};
