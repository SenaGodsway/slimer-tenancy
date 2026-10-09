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
      Schema::create('documents', function (Blueprint $table) {
        $table->id();
        $table->foreignId('admin_id')->nullable()->constrained('admins')->nullOnDelete();

        $table->string('type')->default('content'); // content | attachment
        $table->string('category')->nullable();      // sla | contract | policy, etc.

        $table->string('title')->unique();
        $table->string('slug')->nullable();
        $table->longText('content')->nullable();

        // file attachment metadata
        $table->string('document_disk')->nullable();
        $table->string('document_path')->nullable();
        $table->string('document_name')->nullable();     // original filename
        $table->string('mime_type')->nullable();
        $table->unsignedBigInteger('document_size')->nullable();

        $table->string('status')->default('active');    

        // versioning — matters for legal/contract documents
        $table->unsignedInteger('version')->default(1);
        $table->timestamp('effective_from')->nullable();
        $table->timestamp('effective_to')->nullable();

        $table->timestamps();
        $table->softDeletes();
        $table->index('slug');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
