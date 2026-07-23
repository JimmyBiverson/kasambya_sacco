<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dividend_allocations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dividend_id')->constrained()->cascadeOnDelete();
            $table->foreignId('member_id')->constrained()->cascadeOnDelete();
            $table->foreignId('share_account_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('shares_held');
            $table->unsignedBigInteger('amount');
            $table->string('status')->default('pending'); // pending, paid, forfeited
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dividend_allocations');
    }
};
