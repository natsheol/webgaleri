<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('professors', function (Blueprint $table) {
            if (Schema::hasColumn('professors', 'email')) {
                $table->dropColumn('email'); // hapus email kalau udah gak dipakai
            }
            $table->string('position')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('professors', function (Blueprint $table) {
            $table->string('email')->nullable();
            $table->dropColumn('position');
        });
    }

};
