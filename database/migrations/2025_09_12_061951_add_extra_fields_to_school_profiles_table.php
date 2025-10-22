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
        Schema::table('school_profiles', function (Blueprint $table) {
            $table->string('hero_image')->nullable()->after('logo');
            $table->integer('founded_year')->nullable()->after('about');
            $table->string('motto')->nullable()->after('founded_year');

            $table->string('founder_name')->nullable()->after('motto');
            $table->integer('founder_birth_year')->nullable()->after('founder_name');
            $table->string('founder_photo')->nullable()->after('founder_birth_year');

            $table->string('headmaster_name')->nullable()->after('founder_photo');
            $table->string('headmaster_photo')->nullable()->after('headmaster_name');

            $table->string('accreditation')->nullable()->after('headmaster_photo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('school_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'hero_image',
                'founded_year',
                'motto',
                'founder_name',
                'founder_birth_year',
                'founder_photo',
                'headmaster_name',
                'headmaster_photo',
                'accreditation',
            ]);
        });
    }
};
