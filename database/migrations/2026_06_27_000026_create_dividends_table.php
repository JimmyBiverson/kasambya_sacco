<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dividends', function (Blueprint $table) {
            $table->id();
            $table->string('financial_year'); // e.g. "2025/2026"
            $table->unsignedBigInteger('total_amount');
            $table->unsignedBigInteger('per_share_rate');
            $table->date('declaration_date');
            $table->date('payment_date')->nullable();
            $table->string('status'); // declared, processing, paid, cancelled
            $table->text('notes')->nullable();
            $table->foreignId('declared_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dividends');
    }
};
