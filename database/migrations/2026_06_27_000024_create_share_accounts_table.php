<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('share_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->cascadeOnDelete();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->string('account_number')->unique();
            $table->unsignedInteger('total_shares')->default(0);
            $table->unsignedBigInteger('share_value')->default(5000);
            $table->unsignedBigInteger('balance')->default(0);
            $table->enum('status', ['active', 'dormant', 'closed'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('share_accounts');
    }
};
