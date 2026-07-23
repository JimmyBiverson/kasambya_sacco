<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('member_guarantors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');           // the borrower
            $table->unsignedBigInteger('guarantor_member_id'); // the guaranteeing member
            $table->unsignedBigInteger('max_amount');          // UGX
            $table->enum('status', ['pending', 'active', 'released'])->default('pending');
            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('members')->cascadeOnDelete();
            $table->foreign('guarantor_member_id')->references('id')->on('members');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('member_guarantors');
    }
};
