<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('member_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');
            $table->enum('type', ['NationalID', 'Passport', 'EmploymentLetter', 'Other']);
            $table->string('file_path');
            $table->date('expiry_date')->nullable();
            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('members')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('member_documents');
    }
};
