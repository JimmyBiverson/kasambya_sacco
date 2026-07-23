<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sms_logs', function (Blueprint $table) {
            $table->id();
            $table->string('recipient');
            $table->text('message');
            $table->string('provider')->default('africastalking');
            $table->enum('status', ['pending', 'sent', 'failed'])->default('pending');
            $table->string('reference')->nullable();
            $table->string('external_id')->nullable();
            $table->integer('segments_count')->default(1);
            $table->tinyInteger('attempts')->default(0);
            $table->decimal('cost', 10, 4)->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->text('failure_reason')->nullable();
            $table->nullableMorphs('related');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sms_logs');
    }
};
