<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('house_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('house_id')->constrained('houses')->onDelete('cascade');
            $table->year('year');
            $table->integer('total_students')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('house_students');
    }
};
