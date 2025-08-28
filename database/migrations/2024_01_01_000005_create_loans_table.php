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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('loan_code')->unique()->comment('Unique loan identification code');
            $table->foreignId('borrower_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('equipment_id')->constrained('equipment')->cascadeOnDelete();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->datetime('requested_start_date');
            $table->datetime('requested_end_date');
            $table->datetime('actual_start_date')->nullable();
            $table->datetime('actual_end_date')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'checked_out', 'returned', 'overdue'])->default('pending');
            $table->text('purpose')->nullable()->comment('Reason for borrowing');
            $table->text('jsa_document_path')->nullable()->comment('Job Safety Analysis PDF path');
            $table->json('initial_condition_photos')->nullable();
            $table->json('final_condition_photos')->nullable();
            $table->json('initial_checklist')->nullable()->comment('Check-out condition checklist');
            $table->json('final_checklist')->nullable()->comment('Check-in condition checklist');
            $table->text('approval_notes')->nullable();
            $table->text('rejection_notes')->nullable();
            $table->text('return_notes')->nullable();
            $table->boolean('is_overdue')->default(false);
            $table->integer('overdue_days')->default(0);
            $table->boolean('penalty_applied')->default(false);
            $table->timestamps();
            
            $table->index('loan_code');
            $table->index(['borrower_id', 'status']);
            $table->index(['equipment_id', 'status']);
            $table->index('status');
            $table->index('is_overdue');
            $table->index(['requested_start_date', 'requested_end_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};