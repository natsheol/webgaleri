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
        Schema::create('hogwarts_prophet_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hogwarts_prophet_id')->constrained('hogwarts_prophets')->onDelete('cascade');
            $table->string('session_id', 100);
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();
            
            // Prevent duplicate likes from same session
            $table->unique(['hogwarts_prophet_id', 'session_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hogwarts_prophet_likes');
    }
};
