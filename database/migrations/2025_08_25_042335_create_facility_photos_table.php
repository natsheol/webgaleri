<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('facility_photos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image');
            $table->unsignedBigInteger('facility_category_id'); 
            $table->timestamps();
        
            $table->foreign('facility_category_id')
                  ->references('id')
                  ->on('facility_categories')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('facility_photos');
    }
};
