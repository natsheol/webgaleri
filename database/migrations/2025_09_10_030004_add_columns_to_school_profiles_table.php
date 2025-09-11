<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('school_profiles', function (Blueprint $table) {
            if (!Schema::hasColumn('school_profiles', 'logo')) {
                $table->string('logo')->nullable();
            }
            if (!Schema::hasColumn('school_profiles', 'about')) {
                $table->text('about');
            }
            if (!Schema::hasColumn('school_profiles', 'vision')) {
                $table->text('vision');
            }
            if (!Schema::hasColumn('school_profiles', 'mission')) {
                $table->text('mission');
            }
            if (!Schema::hasColumn('school_profiles', 'house_banners')) {
                $table->json('house_banners');
            }
        });
    }


    public function down(): void
    {
        Schema::table('school_profiles', function (Blueprint $table) {
            $table->dropColumn(['about', 'vision', 'mission', 'house_banners']);
        });
    }

};
