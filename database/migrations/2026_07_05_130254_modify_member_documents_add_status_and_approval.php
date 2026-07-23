<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('member_documents', function (Blueprint $table) {
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('file_path');
            $table->text('rejection_reason')->nullable()->after('status');
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete()->after('rejection_reason');
            $table->timestamp('approved_at')->nullable()->after('approved_by');
        });
    }

    public function down(): void
    {
        Schema::table('member_documents', function (Blueprint $table) {
            $table->dropColumn(['status', 'rejection_reason', 'approved_by', 'approved_at']);
        });
    }
};
