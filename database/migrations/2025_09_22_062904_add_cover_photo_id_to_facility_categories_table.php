<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('facility_categories', function (Blueprint $table) {
            $table->foreignId('cover_photo_id')->nullable()->constrained('facility_photos')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('facility_categories', function (Blueprint $table) {
            $table->dropForeign(['cover_photo_id']);
            $table->dropColumn('cover_photo_id');
        });
    }
};
