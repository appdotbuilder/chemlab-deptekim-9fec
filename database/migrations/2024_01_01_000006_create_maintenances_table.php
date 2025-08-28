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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipment_id')->constrained('equipment')->cascadeOnDelete();
            $table->foreignId('performed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('type', ['calibration', 'repair', 'inspection', 'cleaning', 'upgrade'])->default('inspection');
            $table->text('description');
            $table->datetime('scheduled_date');
            $table->datetime('completed_date')->nullable();
            $table->enum('status', ['scheduled', 'in_progress', 'completed', 'cancelled'])->default('scheduled');
            $table->text('notes')->nullable();
            $table->decimal('cost', 10, 2)->nullable();
            $table->string('vendor')->nullable();
            $table->json('documents')->nullable()->comment('Maintenance documents and certificates');
            $table->datetime('next_maintenance_date')->nullable();
            $table->timestamps();
            
            $table->index(['equipment_id', 'status']);
            $table->index('scheduled_date');
            $table->index('status');
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};