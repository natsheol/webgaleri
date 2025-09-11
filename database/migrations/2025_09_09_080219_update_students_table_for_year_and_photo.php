<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // ganti email jadi year
            $table->renameColumn('email', 'year');
            
            // tambah column foto
            $table->string('photo')->nullable()->after('name');
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->renameColumn('year', 'email');
            $table->dropColumn('photo');
        });
    }
};

