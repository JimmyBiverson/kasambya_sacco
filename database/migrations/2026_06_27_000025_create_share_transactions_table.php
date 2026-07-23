<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('share_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('share_account_id')->constrained()->cascadeOnDelete();
            $table->string('type'); // purchase, refund, transfer_in, transfer_out
            $table->unsignedInteger('shares');
            $table->unsignedBigInteger('amount');
            $table->unsignedBigInteger('share_value_at_time');
            $table->string('method')->nullable(); // cash, bank, mobile_money, dividend
            $table->string('reference')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('share_transactions');
    }
};
