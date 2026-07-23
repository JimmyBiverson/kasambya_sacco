<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('loan_product_id');
            $table->unsignedBigInteger('branch_id');
            $table->string('application_number')->unique();
            $table->unsignedBigInteger('applied_amount');
            $table->unsignedBigInteger('approved_amount')->nullable();
            $table->unsignedBigInteger('disbursed_amount')->nullable();
            $table->unsignedSmallInteger('term_months');
            $table->decimal('interest_rate', 5, 4);
            $table->text('purpose')->nullable();
            $table->enum('disbursement_method', ['cash', 'bank', 'mtn_momo', 'airtel_money']);
            $table->enum('status', [
                'draft',
                'pending',
                'under_review',
                'approved',
                'rejected',
                'disbursed',
                'active',
                'overdue',
                'restructured',
                'written_off',
                'closed',
            ])->default('draft');
            $table->unsignedSmallInteger('credit_score')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->timestamp('disbursed_at')->nullable();
            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('members');
            $table->foreign('loan_product_id')->references('id')->on('loan_products');
            $table->foreign('branch_id')->references('id')->on('branches');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
