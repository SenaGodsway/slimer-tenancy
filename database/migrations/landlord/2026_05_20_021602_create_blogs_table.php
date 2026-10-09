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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable();
            $table->foreignId('admin_id')->nullable();
            $table->string('title')->unique();
            $table->string('slug')->unique()->nullable();
            $table->string('banner')->nullable();
            $table->string('image_caption')->nullable();
            $table->string('summary')->nullable();
            $table->string('keywords')->nullable();
            $table->longText('content')->nullable();
            $table->string('source')->nullable();
            $table->string('contributor')->nullable();
            $table->string('status')->default('active');
            $table->unsignedBigInteger('views')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
