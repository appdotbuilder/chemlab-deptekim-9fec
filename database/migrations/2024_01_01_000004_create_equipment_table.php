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
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('asset_code')->unique()->comment('Unique asset identification code');
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->foreignId('lab_id')->constrained('labs')->cascadeOnDelete();
            $table->text('description')->nullable();
            $table->json('technical_specifications')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('model')->nullable();
            $table->string('serial_number')->nullable();
            $table->year('year_acquired')->nullable();
            $table->enum('condition', ['excellent', 'good', 'fair', 'poor', 'needs_repair'])->default('good');
            $table->enum('availability_status', ['available', 'borrowed', 'maintenance', 'retired'])->default('available');
            $table->json('calibration_schedule')->nullable()->comment('Maintenance and calibration schedules');
            $table->text('risk_assessment')->nullable();
            $table->json('required_ppe')->nullable()->comment('Required Personal Protective Equipment');
            $table->json('sds_links')->nullable()->comment('Safety Data Sheet links');
            $table->json('images')->nullable()->comment('Equipment images');
            $table->text('qr_code_path')->nullable()->comment('Generated QR code file path');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index('asset_code');
            $table->index(['category_id', 'lab_id']);
            $table->index('availability_status');
            $table->index('condition');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};