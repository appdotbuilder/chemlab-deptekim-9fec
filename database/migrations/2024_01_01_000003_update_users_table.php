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
        Schema::table('users', function (Blueprint $table) {
            $table->string('nim')->nullable()->comment('Student ID number');
            $table->string('phone')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'active'])->default('pending');
            $table->text('verification_notes')->nullable();
            $table->foreignId('lab_id')->nullable()->constrained('labs')->cascadeOnDelete();
            $table->boolean('must_change_password')->default(false);
            $table->timestamp('last_login_at')->nullable();
            
            $table->index('nim');
            $table->index('status');
            $table->index('lab_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['lab_id']);
            $table->dropIndex(['nim']);
            $table->dropIndex(['status']);
            $table->dropIndex(['lab_id']);
            $table->dropColumn([
                'nim', 'phone', 'status', 'verification_notes', 'lab_id', 
                'must_change_password', 'last_login_at'
            ]);
        });
    }
};