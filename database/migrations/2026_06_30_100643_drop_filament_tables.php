<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('failed_import_rows');
        Schema::dropIfExists('exports');
        Schema::dropIfExists('imports');
    }

    public function down(): void
    {
        // Not recreating Filament-specific tables on rollback
    }
};
