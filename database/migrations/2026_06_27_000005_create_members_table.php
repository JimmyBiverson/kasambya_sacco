<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('membership_number')->unique();
            $table->string('full_name');
            $table->date('dob');
            $table->enum('gender', ['M', 'F', 'Other']);
            $table->string('national_id')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('photo')->nullable();
            $table->text('address')->nullable();
            $table->string('district')->nullable();
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('occupation')->nullable();
            $table->string('employer')->nullable();
            $table->unsignedBigInteger('monthly_income')->nullable();
            $table->string('next_of_kin_name')->nullable();
            $table->string('next_of_kin_phone')->nullable();
            $table->string('next_of_kin_relationship')->nullable();
            $table->enum('category', ['Regular', 'Associate', 'Institutional', 'Group']);
            $table->unsignedBigInteger('branch_id');
            $table->enum('status', ['pending', 'active', 'dormant', 'suspended', 'blacklisted', 'deceased'])->default('pending');
            $table->text('blacklist_reason')->nullable();
            $table->unsignedBigInteger('blacklisted_by')->nullable();
            $table->timestamp('blacklisted_at')->nullable();
            $table->date('joined_at')->nullable();
            $table->string('qr_code_path')->nullable();
            $table->timestamps();

            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('blacklisted_by')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
