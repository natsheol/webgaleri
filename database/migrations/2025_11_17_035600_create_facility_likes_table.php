<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('facility_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('facility_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            // Ensure a user can only like a facility once
            $table->unique(['user_id', 'facility_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('facility_likes');
    }
};
