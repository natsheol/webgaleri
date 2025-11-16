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
        // Add columns to hogwarts_prophets
        Schema::table('hogwarts_prophets', function (Blueprint $table) {
            $table->boolean('is_archived')->default(false)->after('image');
            $table->boolean('is_public')->default(true)->after('is_archived');
        });

        // Add columns to achievements
        Schema::table('achievements', function (Blueprint $table) {
            $table->boolean('is_archived')->default(false)->after('image');
            $table->boolean('is_public')->default(true)->after('is_archived');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hogwarts_prophets', function (Blueprint $table) {
            $table->dropColumn(['is_archived', 'is_public']);
        });

        Schema::table('achievements', function (Blueprint $table) {
            $table->dropColumn(['is_archived', 'is_public']);
        });
    }
};
