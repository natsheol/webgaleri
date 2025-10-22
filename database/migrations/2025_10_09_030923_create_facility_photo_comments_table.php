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
        Schema::create('facility_photo_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('facility_photo_id')->constrained('facility_photos')->onDelete('cascade');
            $table->string('name', 100)->nullable();
            $table->text('content');
            $table->boolean('is_approved')->default(true);
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();
            
            $table->index('facility_photo_id');
            $table->index('is_approved');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facility_photo_comments');
    }
};
