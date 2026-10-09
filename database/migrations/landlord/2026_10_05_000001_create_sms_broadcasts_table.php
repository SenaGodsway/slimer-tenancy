<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('pgsql')->create('landlord.sms_broadcasts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->nullable();
            $table->string('title')->unique();
            $table->text('message');
            $table->enum('recipient_mode', ['all', 'selected'])->default('all');
            $table->json('recipient_ids')->nullable();
            $table->unsignedInteger('recipient_count')->default(0);
            $table->enum('status', ['draft', 'queued', 'sent', 'failed'])->default('draft');
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::connection('pgsql')->dropIfExists('landlord.sms_broadcasts');
    }
};
