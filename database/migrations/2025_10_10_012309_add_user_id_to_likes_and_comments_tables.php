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
        // Add user_id to facility_photo_likes (no foreign key constraint - can be user or admin)
        Schema::table('facility_photo_likes', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
        });

        // Add user_id to facility_photo_comments
        Schema::table('facility_photo_comments', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
        });

        // Add user_id to hogwarts_prophet_likes
        Schema::table('hogwarts_prophet_likes', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
        });

        // Add user_id to hogwarts_prophet_comments
        Schema::table('hogwarts_prophet_comments', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
        });

        // Add user_id to achievement_likes
        Schema::table('achievement_likes', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
        });

        // Add user_id to achievement_comments
        Schema::table('achievement_comments', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('facility_photo_likes', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });

        Schema::table('facility_photo_comments', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });

        Schema::table('hogwarts_prophet_likes', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });

        Schema::table('hogwarts_prophet_comments', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });

        Schema::table('achievement_likes', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });

        Schema::table('achievement_comments', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
};
