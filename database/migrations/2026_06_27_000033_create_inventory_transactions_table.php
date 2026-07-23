<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('inventory_item_id')->constrained()->cascadeOnDelete();
            $table->string('type'); // in/out/adjustment/transfer
            $table->integer('quantity');
            $table->bigInteger('unit_cost');
            $table->bigInteger('total_cost');
            $table->string('reference')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_transactions');
    }
};
