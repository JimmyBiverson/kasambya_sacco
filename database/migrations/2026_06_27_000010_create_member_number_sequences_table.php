<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Creates the member_number_sequences table which stores one row per
     * calendar year and tracks the last-used sequence counter. Used by
     * MemberNumberService to generate unique KS-YYYY-NNNNN numbers with
     * DB-level locking to guarantee uniqueness under concurrent calls.
     */
    public function up(): void
    {
        Schema::create('member_number_sequences', function (Blueprint $table) {
            $table->id();
            $table->year('year')->unique();
            $table->unsignedInteger('last_sequence')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_number_sequences');
    }
};
