<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loan_approvals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('loan_id');
            $table->unsignedTinyInteger('level');
            $table->unsignedBigInteger('approver_id');
            $table->enum('action', ['approved', 'rejected']);
            $table->text('reason')->nullable();
            $table->timestamp('approved_at');
            $table->timestamps();

            $table->foreign('loan_id')->references('id')->on('loans')->onDelete('cascade');
            $table->foreign('approver_id')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loan_approvals');
    }
};
