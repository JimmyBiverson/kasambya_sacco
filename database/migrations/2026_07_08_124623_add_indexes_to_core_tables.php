<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // --- Foreign key indexes on raw unsignedBigInteger columns ---
        Schema::table('members', function (Blueprint $table) {
            $table->index('branch_id');
            $table->index('blacklisted_by');
        });

        Schema::table('loans', function (Blueprint $table) {
            $table->index('member_id');
            $table->index('loan_product_id');
            $table->index('branch_id');
            $table->index('status');
        });

        Schema::table('loan_repayments', function (Blueprint $table) {
            $table->index('loan_id');
        });

        Schema::table('loan_schedules', function (Blueprint $table) {
            $table->index('loan_id');
        });

        Schema::table('member_documents', function (Blueprint $table) {
            $table->index('member_id');
        });

        Schema::table('member_beneficiaries', function (Blueprint $table) {
            $table->index('member_id');
        });

        Schema::table('member_guarantors', function (Blueprint $table) {
            $table->index('member_id');
            $table->index('guarantor_member_id');
        });

        Schema::table('member_notes', function (Blueprint $table) {
            $table->index('member_id');
            $table->index('user_id');
        });

        Schema::table('loan_collaterals', function (Blueprint $table) {
            $table->index('loan_id');
        });

        Schema::table('loan_approvals', function (Blueprint $table) {
            $table->index('loan_id');
            $table->index('approver_id');
        });

        Schema::table('departments', function (Blueprint $table) {
            $table->index('head_of_department_id');
        });

        // --- Frequently-queried filter / sort columns ---
        Schema::table('members', function (Blueprint $table) {
            $table->index('status');
            $table->index('category');
            $table->index('joined_at');
        });

        Schema::table('savings_accounts', function (Blueprint $table) {
            $table->index('status');
            $table->index('account_type');
        });

        Schema::table('loan_schedules', function (Blueprint $table) {
            $table->index('due_date');
            $table->index('status');
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->index('status');
        });

        Schema::table('audit_logs', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('action');
            $table->index('model_type');
            $table->index('model_id');
        });
    }

    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropIndex(['branch_id']);
            $table->dropIndex(['blacklisted_by']);
            $table->dropIndex(['status']);
            $table->dropIndex(['category']);
            $table->dropIndex(['joined_at']);
        });

        Schema::table('loans', function (Blueprint $table) {
            $table->dropIndex(['member_id']);
            $table->dropIndex(['loan_product_id']);
            $table->dropIndex(['branch_id']);
            $table->dropIndex(['status']);
        });

        Schema::table('loan_repayments', function (Blueprint $table) {
            $table->dropIndex(['loan_id']);
        });

        Schema::table('loan_schedules', function (Blueprint $table) {
            $table->dropIndex(['loan_id']);
            $table->dropIndex(['due_date']);
            $table->dropIndex(['status']);
        });

        Schema::table('member_documents', function (Blueprint $table) {
            $table->dropIndex(['member_id']);
        });

        Schema::table('member_beneficiaries', function (Blueprint $table) {
            $table->dropIndex(['member_id']);
        });

        Schema::table('member_guarantors', function (Blueprint $table) {
            $table->dropIndex(['member_id']);
            $table->dropIndex(['guarantor_member_id']);
        });

        Schema::table('member_notes', function (Blueprint $table) {
            $table->dropIndex(['member_id']);
            $table->dropIndex(['user_id']);
        });

        Schema::table('loan_collaterals', function (Blueprint $table) {
            $table->dropIndex(['loan_id']);
        });

        Schema::table('loan_approvals', function (Blueprint $table) {
            $table->dropIndex(['loan_id']);
            $table->dropIndex(['approver_id']);
        });

        Schema::table('departments', function (Blueprint $table) {
            $table->dropIndex(['head_of_department_id']);
        });

        Schema::table('savings_accounts', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['account_type']);
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->dropIndex(['status']);
        });

        Schema::table('audit_logs', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['action']);
            $table->dropIndex(['model_type']);
            $table->dropIndex(['model_id']);
        });
    }
};
