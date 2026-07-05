<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loan_collaterals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('loan_id');
            $table->string('type');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('estimated_value');
            $table->string('document_path')->nullable();
            $table->timestamps();

            $table->foreign('loan_id')->references('id')->on('loans')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loan_collaterals');
    }
};
