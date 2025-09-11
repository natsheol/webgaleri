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
        Schema::create('school_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('School Profile');
            $table->string('logo')->nullable();
            $table->text('about');
            $table->text('vision');
            $table->text('mission');
            $table->json('house_banners'); // array berisi ['house'=>'Gryffindor', 'image'=>'...', 'total_students'=>...]
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_profiles');
    }
};
