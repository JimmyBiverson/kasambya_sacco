<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fixed_assets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('category'); // building/vehicle/equipment/furniture/computer/other
            $table->date('purchase_date');
            $table->bigInteger('purchase_cost');
            $table->string('depreciation_method'); // straight_line/reducing_balance
            $table->integer('useful_life_years');
            $table->bigInteger('salvage_value')->default(0);
            $table->bigInteger('book_value');
            $table->bigInteger('current_value');
            $table->string('status')->default('active'); // active/disposed/written_off
            $table->string('location')->nullable();
            $table->string('asset_tag')->nullable()->unique();
            $table->foreignId('branch_id')->nullable()->constrained()->nullOnDelete();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fixed_assets');
    }
};
