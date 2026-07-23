<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('sku')->unique();
            $table->string('category')->nullable();
            $table->text('description')->nullable();
            $table->string('unit_of_measure');
            $table->integer('quantity')->default(0);
            $table->bigInteger('unit_cost')->default(0);
            $table->bigInteger('total_value')->default(0);
            $table->integer('reorder_level')->default(0);
            $table->boolean('is_active')->default(true);
            $table->foreignId('branch_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_items');
    }
};
