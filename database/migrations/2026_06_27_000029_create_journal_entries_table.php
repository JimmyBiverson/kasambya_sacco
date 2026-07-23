<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('journal_entries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->string('reference')->unique();
            $table->text('description')->nullable();
            $table->foreignId('posted_by')->constrained('users');
            $table->boolean('is_posted')->default(true);
            $table->foreignId('reversal_of')->nullable()->constrained('journal_entries')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('journal_entries');
    }
};
