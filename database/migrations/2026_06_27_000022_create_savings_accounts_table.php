<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('savings_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->cascadeOnDelete();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->string('account_number')->unique();
            $table->enum('account_type', ['Normal', 'Emergency', 'Holiday', 'Children', 'Education', 'Target', 'FixedDeposit', 'Locked']);
            $table->unsignedBigInteger('balance')->default(0);
            $table->decimal('interest_rate', 5, 4)->default(0);
            $table->unsignedBigInteger('target_amount')->nullable();
            $table->date('maturity_date')->nullable();
            $table->enum('status', ['active', 'dormant', 'closed', 'frozen'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('savings_accounts');
    }
};
