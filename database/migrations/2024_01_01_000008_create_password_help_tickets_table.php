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
        Schema::create('password_help_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_code')->unique()->comment('Unique ticket identification code');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('handled_by')->nullable()->constrained('users')->nullOnDelete();
            $table->text('reason')->comment('Reason for password reset request');
            $table->enum('status', ['pending', 'in_progress', 'completed', 'rejected'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->string('temporary_password')->nullable();
            $table->datetime('resolved_at')->nullable();
            $table->timestamps();
            
            $table->index('ticket_code');
            $table->index(['user_id', 'status']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password_help_tickets');
    }
};