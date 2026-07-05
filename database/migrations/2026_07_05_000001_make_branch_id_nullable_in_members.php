<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Note: changing column nullability may require doctrine/dbal package.
        Schema::table('members', function (Blueprint $table) {
            $table->unsignedBigInteger('branch_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->unsignedBigInteger('branch_id')->nullable(false)->change();
        });
    }
};
