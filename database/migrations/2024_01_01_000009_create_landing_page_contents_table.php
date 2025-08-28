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
        Schema::create('landing_page_contents', function (Blueprint $table) {
            $table->id();
            $table->string('hero_title');
            $table->text('hero_subtitle')->nullable();
            $table->string('hero_image_path')->nullable();
            $table->longText('description')->nullable();
            $table->longText('usage_guide')->nullable();
            $table->longText('demo_content')->nullable();
            $table->longText('faqs')->nullable()->comment('JSON formatted FAQs');
            $table->text('contact_information')->nullable();
            $table->string('user_guide_link')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landing_page_contents');
    }
};