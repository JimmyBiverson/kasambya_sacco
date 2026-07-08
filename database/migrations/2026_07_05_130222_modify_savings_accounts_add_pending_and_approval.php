<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE savings_accounts MODIFY COLUMN status ENUM('pending','active','dormant','closed','frozen') NOT NULL DEFAULT 'pending'");

        Schema::table('savings_accounts', function (Blueprint $table) {
            if (!Schema::hasColumn('savings_accounts', 'approved_by')) {
                $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            }
            if (!Schema::hasColumn('savings_accounts', 'approved_at')) {
                $table->timestamp('approved_at')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('savings_accounts', function (Blueprint $table) {
            $table->dropColumn(['approved_by', 'approved_at']);
        });

        DB::statement("ALTER TABLE savings_accounts MODIFY COLUMN status ENUM('active','dormant','closed','frozen') NOT NULL DEFAULT 'active'");
    }
};
