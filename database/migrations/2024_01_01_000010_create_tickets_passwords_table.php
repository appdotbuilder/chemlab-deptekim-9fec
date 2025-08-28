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
        Schema::create('tickets_passwords', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_code')->unique();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('status')->default('open');
            $table->unsignedBigInteger('handler_id')->nullable();
            $table->text('reason');
            $table->text('admin_notes')->nullable();
            $table->string('temporary_password')->nullable();
            $table->datetime('resolved_at')->nullable();
            $table->timestamps();
            
            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('handler_id')->references('id')->on('users')->onDelete('set null');
            
            // Indexes for performance
            $table->index('ticket_code');
            $table->index('user_id');
            $table->index('status');
            $table->index(['status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets_passwords');
    }
};