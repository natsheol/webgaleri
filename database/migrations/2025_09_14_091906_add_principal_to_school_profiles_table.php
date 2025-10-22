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
        $table->string('principal_name')->nullable();
        $table->string('principal_photo')->nullable();
        $table->text('principal_message')->nullable();
    });
}

};
