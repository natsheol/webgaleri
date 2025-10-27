<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hogwarts_prophets', function (Blueprint $table) {
            $table->unsignedBigInteger('view_count')->default(0)->after('image');
        });
    }

    public function down(): void
    {
        Schema::table('hogwarts_prophets', function (Blueprint $table) {
            $table->dropColumn('view_count');
        });
    }
};
