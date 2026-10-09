<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('pgsql')->create('landlord.sms_feedbacks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('broadcast_id')->nullable();
            $table->foreignId('tenant_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('status')->nullable();
            $table->string('message_id')->nullable();
            $table->string('reference')->nullable();
            $table->string('transaction_type')->default('landlord-custom');
            $table->json('data')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::connection('pgsql')->dropIfExists('landlord.sms_feedbacks');
    }
};
