<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('investments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type'); // fixed_deposit/treasury_bill/bond/equity/other
            $table->string('name');
            $table->text('description')->nullable();
            $table->bigInteger('amount');
            $table->decimal('rate', 5, 2);
            $table->date('start_date');
            $table->date('maturity_date');
            $table->bigInteger('interest_earned')->default(0);
            $table->bigInteger('total_return')->nullable();
            $table->string('status')->default('active'); // active/matured/rolled_over/closed
            $table->foreignId('branch_id')->nullable()->constrained()->nullOnDelete();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('investments');
    }
};
