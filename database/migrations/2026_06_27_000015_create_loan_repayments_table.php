<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loan_repayments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('loan_id');
            $table->unsignedBigInteger('amount');
            $table->unsignedBigInteger('principal_paid');
            $table->unsignedBigInteger('interest_paid');
            $table->unsignedBigInteger('penalty_paid')->default(0);
            $table->unsignedBigInteger('balance');
            $table->string('payment_method');
            $table->string('reference')->nullable();
            $table->timestamp('paid_at');
            $table->timestamps();

            $table->foreign('loan_id')->references('id')->on('loans')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loan_repayments');
    }
};
