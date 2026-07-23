<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loan_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('min_amount');
            $table->unsignedBigInteger('max_amount');
            $table->unsignedSmallInteger('min_term'); // months
            $table->unsignedSmallInteger('max_term'); // months
            $table->decimal('interest_rate', 5, 4);
            $table->enum('interest_method', ['flat', 'reducing', 'compound']);
            $table->decimal('penalty_rate', 8, 6); // % per day
            $table->unsignedSmallInteger('grace_period')->default(0); // days
            $table->decimal('processing_fee', 5, 4)->default(0);
            $table->decimal('insurance_fee', 5, 4)->default(0);
            $table->decimal('max_loan_to_savings', 5, 2)->nullable();
            $table->decimal('max_loan_to_share', 5, 2)->nullable();
            $table->boolean('collateral_required')->default(false);
            $table->enum('category', [
                'Agriculture',
                'BodaBoda',
                'Salary',
                'Business',
                'Group',
                'Emergency',
                'SchoolFees',
                'Housing',
                'Transport',
                'General',
            ]);
            $table->json('approval_levels')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loan_products');
    }
};
