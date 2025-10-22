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
        Schema::create('hogwarts_prophet_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hogwarts_prophet_id')->constrained('hogwarts_prophets')->onDelete('cascade');
            $table->string('name', 100)->nullable();
            $table->text('content');
            $table->boolean('is_approved')->default(true);
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();
            
            $table->index('hogwarts_prophet_id');
            $table->index('is_approved');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hogwarts_prophet_comments');
    }
};
