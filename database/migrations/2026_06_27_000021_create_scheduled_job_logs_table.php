<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scheduled_job_logs', function (Blueprint $table) {
            $table->id();
            $table->string('job_class');
            $table->string('name');
            $table->string('cron_expression');
            $table->timestamp('last_run_at')->nullable();
            $table->string('last_run_status')->nullable();
            $table->timestamp('next_run_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scheduled_job_logs');
    }
};
